<?php

namespace App\Controllers;
use App\Models\NscPaperModel;
use App\Models\FileregisteryModel;
use App\Models\LinkNscPaperFileModel;


class Nsc_paper extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['disbursement_status'] = json_decode(get_config(23),TRUE);

        track();
    }

    public function list_all($entity_id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/nsc_paper/list_all/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $entity_model = new NscPaperModel();

        $this->data['list_all'] = $entity_model->select("nsc_paper.*,nsc_meeting.nsc_meeting_no")
                            ->join('nsc_meeting', 'nsc_meeting.id = nsc_paper.nsc_meeting_id', 'left')
                            ->where($this->get_filter())
                            ->findAll();

        return view('nsc_paper/list_all',$this->data);
    }

    public function add_edit($entity_id=0,$id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/nsc_paper/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $entity_model = new NscPaperModel();
        $link_model = new LinkNscPaperFileModel();
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $entity_model->select("*")
                            ->where("id", $id)
                            ->first();  

        $this->data['list_docs'] = $link_model->select("file_registry.*")
                            ->join('file_registry', 'file_registry.id = link_nsc_paper_file.file_id', 'left')
                            ->where("link_nsc_paper_file.nsc_paper_id",$id)
                            ->findAll();

        $this->process_form_add_edit($entity_id,$id);        

        return view('nsc_paper/add_edit',$this->data);
    }

    private function process_form_add_edit($entity_id=0,$id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new NscPaperModel();

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit($id));

            $this->data['details'] = [
                'nsc_meeting_id' => $entity_id,
                'nsc_paper_no' => $this->request->getVar('nsc_paper_no'),
                'subject' => $this->request->getVar('subject'),
                'matter_discussed' => $this->request->getVar('matter_discussed'),
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
                $link_model = new LinkNscPaperFileModel();

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
                                'file_name' => $path,
                                'status' => 1,
                            ];

                            $reg_model->insert($this->data['file_registery']);
                            $file_id = $reg_model->getInsertID();

                            $this->data['file_link'] = [
                                'nsc_paper_id' => $this->data['id'],
                                'file_id' => $file_id,
                            ];

                            $link_model->insert($this->data['file_link']);
                            $link_id = $reg_model->getInsertID();

                            s3_upload($target_file,$sub_path);
                        }
                    }
                }
                
                header("Location:" . base_url("/nsc_paper/list_all/" . $entity_id . "/")); 
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
            'nsc_paper_no' => [
                'label'  => 'Paper no',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'subject' => [
                'label'  => 'Subject',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'matter_discussed' => [
                'label'  => 'Matter discussed',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
        ];
        
    }

    public function delete($entity_id=0,$id=0)
    {
        $this->data['entity_id'] = $entity_id;
        $entity_model = new NscPaperModel();

        $entity_model->delete($id);
        header("Location:" . base_url("/nsc_paper/list_all/" . $entity_id)); 
        die;
    }

    private function get_filter()
    {
        $where = 'nsc_paper.nsc_meeting_id =' . $this->data['entity_id'];

        if(isset($_GET['nsc_paper_no']) && strlen(trim($_GET['nsc_paper_no'])) > 0)
        {
            $where .= " AND nsc_paper.nsc_paper_no LIKE '%" . trim($_GET['nsc_paper_no']) . "%'";
        }

        if(isset($_GET['subject']) && strlen(trim($_GET['subject'])) > 0)
        {
            $where .= " AND nsc_paper.subject LIKE '%" . trim($_GET['subject']) . "%'";
        }

        if(isset($_GET['matter_discussed']) && strlen(trim($_GET['matter_discussed'])) > 0)
        {
            $where .= " AND nsc_paper.matter_discussed LIKE '%" . trim($_GET['matter_discussed']) . "%'";
        }

        return $where;
    }
}