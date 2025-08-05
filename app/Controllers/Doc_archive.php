<?php

namespace App\Controllers;
use App\Models\DocArchiveModel;
use App\Models\UserModel;
use App\Models\ProjectModel;
use App\Models\FileregisteryModel;
use App\Models\LinkDocArchiveFileModel;

class Doc_archive extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['category'] = json_decode(get_config(56),TRUE);

        $this->data['entity_model'] = new DocArchiveModel();
        $this->data['entity_model_1'] = new UserModel();
        $this->data['entity_model_2'] = new ProjectModel();

        $this->data['reg_model'] = new FileregisteryModel();
        $this->data['link_model'] = new LinkDocArchiveFileModel();


        track();
    }

    public function list_all()
	{
        auth_rd();
        $this->data['active_module'] = "/doc_archive/list_all/";
        $this->data['csrf'] = 1;
        
        $this->data['list_all'] = $this->data['entity_model']->select("doc_archive.*,user.fname,user.lname,project.project_name")
                            ->join('user', 'user.id = doc_archive.uploaded_by', 'left')
                            ->join('project', 'project.id = doc_archive.project_id', 'left')
                            ->where($this->get_filter())
                            ->findAll(5000,0);

        $this->data['uploaded_by'] = $this->data['entity_model_1']->select("*")->findAll(5000,0);
        $this->data['project_id'] = $this->data['entity_model_2']->select("*")->findAll(5000,0);
    
        return view('doc_archive/list_all',$this->data);
    }

    public function add_edit($id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/doc_archive/add_edit/";
        $this->data['csrf'] = 1;
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $this->data['entity_model']->select("*")
                            ->where("id", $id)
                            ->first();  

        $this->data['uploaded_by'] = $this->data['entity_model_1']->select("*")->findAll(5000,0);
        $this->data['project_id'] = $this->data['entity_model_2']->select("*")->findAll(5000,0);

        $this->data['list_docs'] = $this->data['link_model']->select("file_registry.*")
                            ->join('file_registry', 'file_registry.id = link_doc_archive_file.file_id', 'left')
                            ->where("link_doc_archive_file.doc_archive_id",$id)
                            ->findAll();
        
        $this->process_form_add_edit($id);        

        return view('doc_archive/add_edit',$this->data);
    }

    private function process_form_add_edit($id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit());

            $loan_disbursement_entity = $this->request->getVar('loan_disbursement_entity');
          
            $this->data['details'] = [
                'category' => $this->request->getVar('category'),
                'project_id' => $this->request->getVar('project_id'),
                'description' => $this->request->getVar('description'),
                'uploaded_by' => $_SESSION['user']['id'],
            ];            

            if($validation->withRequest($this->request)->run())
            { 
                if(!isset($this->data['record']['id']))
                {
                    $this->data['entity_model']->insert($this->data['details']);
                    $this->data['id'] = $this->data['entity_model']->getInsertID();
                }
                else
                {
                    $this->data['entity_model']->update($id,$this->data['details']);
                }   

                $reg_model = new FileregisteryModel();
                
                $total = count($_FILES['img']['name']);

                for( $i=0 ; $i < $total ; $i++ ) {
                    if(is_file($_FILES["img"]["tmp_name"][$i])) 
                    {
                        $path = $_FILES['img']['name'][$i];
                        $ext = pathinfo($path, PATHINFO_EXTENSION);
                        $sub_path = "public/resource/doc_archive/" . md5($path . time()) . "." . $ext;
                        $target_file = ROOTPATH . $sub_path;
                        if(move_uploaded_file($_FILES["img"]["tmp_name"][$i], $target_file)) 
                        {
                            $this->data['file_registery'] = [
                                'added_on' => time(),
                                'relative_path' => '/' . $sub_path,
                                'ref_table' => 'doc_archive',
                                'file_name' => $path,
                                'status' => 1,
                            ];

                            $this->data['reg_model']->insert($this->data['file_registery']);
                            $file_id = $this->data['reg_model']->getInsertID();

                            $this->data['file_link'] = [
                                'doc_archive_id' => $this->data['id'],
                                'file_id' => $file_id,
                            ];

                            $this->data['link_model']->insert($this->data['file_link']);
                            $link_id = $this->data['link_model']->getInsertID();

                            s3_upload($target_file,$sub_path);
                        }
                    }
                }
                
                header("Location:" . base_url("/doc_archive/list_all/")); 
                die;

                $this->data['record'] = $this->data['entity_model']->find($id);
            }
            else
            {
                //echo $validation->listErrors(); die;
                $this->data['record'] = $_POST;
            }

            $validation->listErrors();
        }
    }

    private function validation_rules_entity_add_edit()
	{
        define("VALIDATION_MANDATORY_MSG", "{field} is mandatory.");

        return [
            'category' => [
                'label'  => ucfirst(str_replace("_"," ","category")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'project_id' => [
                'label'  => ucfirst(str_replace("_"," ","project")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'description' => [
                'label'  => ucfirst(str_replace("_"," ","description")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
        ];
        
    }

    public function delete($id=0)
    {
        $this->data['entity_model']->delete($id);
        header("Location:" . base_url("/doc_archive/list_all/")); 
        die;
    }

    private function get_filter()
    {
        $where = "doc_archive.created_at IS NOT NULL";

        $field_name = "category";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND doc_archive." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "project_id";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND doc_archive." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "description";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND doc_archive." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "uploaded_by";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND doc_archive." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        return $where;
    }
}