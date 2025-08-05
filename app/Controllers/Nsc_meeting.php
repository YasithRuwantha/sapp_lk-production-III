<?php

namespace App\Controllers;
use App\Models\NscMeetingModel;
use App\Models\FileregisteryModel;
use App\Models\LinkNscFileModel;

class Nsc_meeting extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['role'] = json_decode(get_config(22),TRUE);

        track();
    }

    public function list_all()
	{
        auth_rd();
        $this->data['active_module'] = "/nsc_meeting/list_all/";
        $this->data['csrf'] = 1;
        
        $entity_model = new NscMeetingModel();

        $this->data['list_all'] = $entity_model->select("nsc_meeting.*")
                            ->where($this->get_filter())
                            ->findAll();
     
        return view('nsc_meeting/list_all',$this->data);
    }

    public function add_edit($id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/nsc_meeting/add_edit/";
        $this->data['csrf'] = 1;
        
        $entity_model = new NscMeetingModel();
        $link_model = new LinkNscFileModel();
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $entity_model->select("*")
                            ->where("id", $id)
                            ->first();  

        $this->data['list_docs'] = $link_model->select("file_registry.*")
                            ->join('file_registry', 'file_registry.id = link_nsc_file.file_id', 'left')
                            ->where("link_nsc_file.nsc_meeting_id",$id)
                            ->findAll();
        
        $this->process_form_add_edit($id);        

        return view('nsc_meeting/add_edit',$this->data);
    }

    private function process_form_add_edit($id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new NscMeetingModel();

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit($id));

            $loan_disbursement_entity = $this->request->getVar('loan_disbursement_entity');
          
            $this->data['details'] = [
                'nsc_meeting_no' => $this->request->getVar('nsc_meeting_no'),
                'nsc_meeting_date' => $this->request->getVar('nsc_meeting_date'),
            ];
            

            if($validation->withRequest($this->request)->run())
            { 
                if(!isset($this->data['record']['id']))
                {
                    $entity_model->insert($this->data['details']);
                    $this->data['id'] = $entity_model->getInsertID();
                }
                else
                {
                    $entity_model->update($id,$this->data['details']);
                }   


                $reg_model = new FileregisteryModel();
                $link_model = new LinkNscFileModel();

                $total = count($_FILES['img']['name']);

                for( $i=0 ; $i < $total ; $i++ ) {
                    if(is_file($_FILES["img"]["tmp_name"][$i])) 
                    {
                        $path = $_FILES['img']['name'][$i];
                        $ext = pathinfo($path, PATHINFO_EXTENSION);
                        $sub_path = "public/resource/nsc/" . md5($path . time()) . "." . $ext;
                        $target_file = ROOTPATH . $sub_path;
                        if(move_uploaded_file($_FILES["img"]["tmp_name"][$i], $target_file)) 
                        {
                            $this->data['file_registery'] = [
                                'added_on' => time(),
                                'relative_path' => '/' . $sub_path,
                                'ref_table' => 'nsc_meeting',
                                'status' => 1,
                            ];

                            $reg_model->insert($this->data['file_registery']);
                            $file_id = $reg_model->getInsertID();

                            $this->data['file_link'] = [
                                'nsc_meeting_id' => $this->data['id'],
                                'file_id' => $file_id,
                            ];

                            $link_model->insert($this->data['file_link']);
                            $link_id = $reg_model->getInsertID();

                            s3_upload($target_file,$sub_path);
                        }
                    }
                }
                
                header("Location:" . base_url("/nsc_meeting/list_all/")); 
                die;

                $this->data['record'] = $entity_model->find($id);
            }
            else
            {
                $this->data['record'] = $_POST;
            }

            $validation->listErrors();
        }
    }

    private function validation_rules_entity_add_edit($id)
	{
        define("VALIDATION_MANDATORY_MSG", "{field} is mandatory.");

        return [
            'nsc_meeting_no' => [
                'label'  => 'NSC meeting no',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'nsc_meeting_date' => [
                'label'  => 'NSC meting date',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
        ];
        
    }

    public function delete($id=0)
    {
        $entity_model = new NscMeetingModel();

        $entity_model->delete($id);
        header("Location:" . base_url("/nsc_meeting/list_all/")); 
        die;
    }

    private function get_filter()
    {
        $where = "nsc_meeting.created_at IS NOT NULL";

        if(isset($_GET['nsc_meeting_no']) && strlen(trim($_GET['nsc_meeting_no'])) > 0)
        {
            $where .= " AND nsc_meeting.nsc_meeting_no LIKE '%" . trim($_GET['nsc_meeting_no']) . "%'";
        }

        if(isset($_GET['nsc_meeting_date']) && strlen(trim($_GET['nsc_meeting_date'])) > 0)
        {
            $where .= " AND nsc_meeting.nsc_meeting_date LIKE '%" . trim($_GET['nsc_meeting_date']) . "%'";
        }

        return $where;
    }
}