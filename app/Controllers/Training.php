<?php

namespace App\Controllers;
use App\Models\TrainingModel;
use App\Models\ProjectModel;
use App\Models\ResourcePersonModel;
use App\Models\TrainingResourcePersonModel;
use App\Models\TrainingDocsModel;
use App\Models\TrainingExpenditureModel;
use App\Models\FileregisteryModel;

class Training extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['type_of_training'] = json_decode(get_config(21),TRUE);
        $this->data['category'] = json_decode('{"1": "4P","2": "Youth","3": "4P & Youth"}',TRUE);
        $this->data['training_status'] = json_decode('	{"1": "Planned","2": "Completed","3": "Cancelled"}',TRUE);
        $this->data['organized_by'] = json_decode('{"1": "Promoter","2": "PMU","3": "PFI","4": "FO"}',TRUE);
        $this->data['expenditure_type'] = json_decode('{"1": "Refreshment & Foods","2": "Travel Expenses","3": "Resource Persons","4": "Other"}',TRUE);

        track();
    }

    public function list_all()
	{
        auth_rd();
        $this->data['active_module'] = "/training/list_all/";
        $this->data['csrf'] = 1;
        
        $entity_model = new TrainingModel();
        $this->data['list_all'] = $entity_model->select("training.*,project.project_name")
                            ->join('project', 'project.id = training.id_project', 'left')
                            ->where($this->get_filter())
                            ->findAll();

        return view('training/list_all',$this->data);
    }

    public function add_edit($id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/training/add_edit/";
        $this->data['csrf'] = 1;
        
        $entity_model = new TrainingModel();
        $project_model = new ProjectModel();
        $this->data['id'] = $id;      
        
        $this->data['record'] = $entity_model->find($id);
        $this->data['project_list'] = $project_model->findAll();

        $this->process_form_add_edit($id);        

        return view('training/add_edit',$this->data);
    }

    private function process_form_add_edit($id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new TrainingModel();

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit($id));
          
            $this->data['details'] = [
                'id_project' => $this->request->getVar('id_project'),
                'training_name' => $this->request->getVar('training_name'),
                'start_date' => $this->request->getVar('start_date'),
                'end_date' => $this->request->getVar('end_date'),
                'objective' => $this->request->getVar('objective'),
                'type_of_training' => $this->request->getVar('type_of_training'),
                'category' => $this->request->getVar('category'),
                'training_status' => $this->request->getVar('training_status'),
                'organized_by' => $this->request->getVar('organized_by'),
                'organizer_name' => $this->request->getVar('organizer_name'),
                'participants_male' => $this->request->getVar('participants_male'),
                'participants_female' => $this->request->getVar('participants_female'),
                'participants_gender_not_specified' => $this->request->getVar('participants_gender_not_specified'),
                'no_guest_attendees' => $this->request->getVar('no_guest_attendees'),
                'key_points_discussed' => $this->request->getVar('key_points_discussed'),
            ];

            if($validation->withRequest($this->request)->run())
            { 
                if(!isset($this->data['record']['id']))
                {
                    $entity_model->insert($this->data['details']);
                    $this->data['id'] = $entity_model->getInsertID();
                    header("Location:" . base_url("/training/list_all")); 
                    die;
                }
                else
                {
                    $entity_model->update($id,$this->data['details']);
                    header("Location:" . base_url("/training/list_all")); 
                    die;
                }                

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
            'training_name' => [
                'label'  => 'Training Name',
                'rules'  => 'required|min_length[3]',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                    'min_length' => '{field} must have minimum of 3 letters.',
                ]
            ],
            'id_project' => [
                'label'  => 'Project',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'start_date' => [
                'label'  => 'Start date',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'end_date' => [
                'label'  => 'End date',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'objective' => [
                'label'  => 'Objective',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'type_of_training' => [
                'label'  => 'Type of training',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'category' => [
                'label'  => 'Category',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'training_status' => [
                'label'  => 'Training status',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'organized_by' => [
                'label'  => 'Organized by',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],            
            'organizer_name' => [
                'label'  => 'Organizer name',
                'rules'  => 'required|max_length[64]',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                    'min_length' => "{field} can't have more than 64 letters.",
                ]
            ],
            'participants_male' => [
                'label'  => 'Participant male',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'participants_female' => [
                'label'  => 'Participant female',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'no_guest_attendees' => [
                'label'  => 'Number of guest attendees',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'key_points_discussed' => [
                'label'  => 'Key points discussed',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
        ];
        
    }

    public function resource_add_edit($id=0,$resid=0)
	{
        auth_rd();
        $this->data['csrf'] = 1;
        
        $entity_model = new ResourcePersonModel();
        
        $this->data['id'] = $id;
        $this->data['resid'] = $resid;      
        
        $this->data['record'] = $entity_model->find($resid);  

        $this->process_form_resource_add_edit($id,$resid);  
        
        $this->data['list_all'] = $entity_model->select("resource_person.*,training.training_name")
                            ->join('training_resource_person', 'resource_person.id = training_resource_person.id_resource', 'left')
                            ->join('training', 'training.id = training_resource_person.id_training', 'left')
                            ->where('training.id',$id)
                            ->findAll();

        return view('training/resource_add_edit',$this->data);
    }

    private function process_form_resource_add_edit($id=0,$resid=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new ResourcePersonModel();

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_resource_entity_add_edit($id,$resid));
          
            $this->data['details'] = [
                'resource_name' => $this->request->getVar('resource_name'),
                'designation' => $this->request->getVar('designation'),
                'work_place' => $this->request->getVar('work_place'),
                'remarks' => $this->request->getVar('remarks'),
            ];

            if($validation->withRequest($this->request)->run())
            { 
                if(!isset($this->data['record']['id']))
                {
                    $entity_model->insert($this->data['details']);
                    $this->data['resid'] = $entity_model->getInsertID();

                    $rp_model = new TrainingResourcePersonModel();
                    $this->data['link_data'] = [
                        'id_training' => $id,
                        'id_resource' => $this->data['resid'],
                    ];
                    $rp_model->insert($this->data['link_data']);

                    // header("Location:" . base_url("/training/resource_add_edit/" . $this->data['id'] . "/" . $this->data['resid'])); 
                    header("Location:" . base_url("/training/resource_add_edit/" . $this->data['id'])); 
                    die;
                }
                else
                {
                    $entity_model->update($resid,$this->data['details']);
                    header("Location:" . base_url("/training/resource_add_edit/" . $this->data['id'])); 
                    die;
                }  
                
                $this->data['record'] = $entity_model->find($resid);
            }
            else
            {
                $this->data['record'] = $_POST;
            }

            $validation->listErrors();
        }
    }

    private function validation_rules_resource_entity_add_edit($id)
	{
        define("VALIDATION_MANDATORY_MSG", "{field} is mandatory.");

        return [
            'resource_name' => [
                'label'  => 'Project',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'designation' => [
                'label'  => 'Start date',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'work_place' => [
                'label'  => 'End date',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ]
        ];
        
    }

    public function resource_delete($id=0,$resid=0)
    {
        $entity_model = new ResourcePersonModel();
        $rp_model = new TrainingResourcePersonModel();

        $rp_model->where('id_training = ' . $id . ' AND id_resource = ' . $resid)->delete();
        $entity_model->delete($resid);
        header("Location:" . base_url("/training/resource_add_edit/" . $id)); 
        die;
    }

    public function expenditure_add_edit($id=0,$resid=0)
	{
        auth_rd();
        $this->data['csrf'] = 1;
        
        $entity_model = new TrainingExpenditureModel();

        $this->data['id'] = $id;
        $this->data['resid'] = $resid;      
        
        $this->data['record'] = $entity_model->find($resid);      

        $this->process_form_expenditure_add_edit($id,$resid);  
        
        $this->data['list_all'] = $entity_model->select("training_expenditure.*,training.training_name")
                            ->join('training', 'training.id = training_expenditure.id_training', 'left')
                            ->where('training_expenditure.id_training',$id)
                            ->findAll();

        return view('training/expenditure_add_edit',$this->data);
    }

    private function process_form_expenditure_add_edit($id=0,$resid=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new TrainingExpenditureModel();

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_expenditure_entity_add_edit($id,$resid));
          
            $this->data['details'] = [
                'expenditure_type' => $this->request->getVar('expenditure_type'),
                'amount' => $this->request->getVar('amount'),
                'id_training' => $id,
            ];

            if($validation->withRequest($this->request)->run())
            { 
                if(!isset($this->data['record']['id']))
                {
                    $entity_model->insert($this->data['details']);
                    $this->data['resid'] = $entity_model->getInsertID();

                    header("Location:" . base_url("/training/expenditure_add_edit/" . $this->data['id'])); 
                    die;
                }
                else
                {
                    $entity_model->update($resid,$this->data['details']);
                    header("Location:" . base_url("/training/expenditure_add_edit/" . $this->data['id'])); 
                    die;
                }  
                
                $this->data['record'] = $entity_model->find($resid);
            }
            else
            {
                $this->data['record'] = $_POST;
            }

            $validation->listErrors();
        }
    }

    private function validation_rules_expenditure_entity_add_edit($id)
	{
        define("VALIDATION_MANDATORY_MSG", "{field} is mandatory.");

        return [
            'expenditure_type' => [
                'label'  => 'Expenditure type',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'amount' => [
                'label'  => 'Amount',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
        ];
        
    }

    public function expenditure_delete($id=0,$resid=0)
    {
        $entity_model = new TrainingExpenditureModel();

        $entity_model->delete($resid);
        header("Location:" . base_url("/training/expenditure_add_edit/" . $id)); 
        die;
    }

    public function docs_add_edit($id=0,$resid=0)
	{
        auth_rd();
        $this->data['csrf'] = 1;
        
        $entity_model = new TrainingDocsModel();

        $this->data['id'] = $id;
        $this->data['resid'] = $resid;      
        
        $this->data['record'] = $entity_model->select("training_docs.*,training.training_name,file_registry.relative_path")
                            ->join('training', 'training.id = training_docs.id_training', 'left')
                            ->join('file_registry', 'file_registry.id = training_docs.doc_path', 'left')
                            ->where('training_docs.id',$resid)
                            ->first();     

        $this->process_form_docs_add_edit($id,$resid);  
        
        $this->data['list_all'] = $entity_model->select("training_docs.*,training.training_name,file_registry.relative_path")
                            ->join('training', 'training.id = training_docs.id_training', 'left')
                            ->join('file_registry', 'file_registry.id = training_docs.doc_path', 'left')
                            ->where('training_docs.id_training',$id)
                            ->findAll();

        return view('training/docs_add_edit',$this->data);
    }

    private function process_form_docs_add_edit($id=0,$resid=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        if(isset($this->data['record']['doc_path']))
        {
            $doc_path = $this->data['record']['doc_path'];
        }
        else
        {
            $doc_path = 1;
        }

        $entity_model = new TrainingDocsModel();
        $reg_model = new FileregisteryModel();

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_docs_entity_add_edit($id,$resid));
          
            if(is_file($_FILES["img"]["tmp_name"]))
            {
                $path = $_FILES['img']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $sub_path = "public/resource/training_docs/" . md5($path . time()) . "." . $ext;
                $target_file = ROOTPATH . $sub_path;
                if(move_uploaded_file($_FILES["img"]["tmp_name"], $target_file)) 
                {
                    $this->data['file_registery'] = [
                        'added_on' => time(),
                        'relative_path' => '/' . $sub_path,
                        'ref_table' => 'training_docs',
                        'status' => 1,
                    ];

                    if($doc_path > 1)
                    {
                        @unlink(substr(ROOTPATH,0,-1) . $this->data['record']['relative_path']);
                        $doc_path_old = $doc_path;
                        s3_delete(substr($this->data['record']['relative_path'],1));
                    }

                    $reg_model->insert($this->data['file_registery']);
                    $doc_path = $reg_model->getInsertID();

                    s3_upload($target_file,$sub_path);
                    @unlink($target_file);
                }
            }

            $this->data['details'] = [
                'doc_type' => $this->request->getVar('doc_type'),
                'remarks' => $this->request->getVar('remarks'),
                'id_training' => $id,
                'doc_path' => $doc_path,
            ];

            if($validation->withRequest($this->request)->run())
            {
                if(!isset($this->data['record']['id']))
                {
                    $entity_model->insert($this->data['details']);
                    $this->data['resid'] = $entity_model->getInsertID();

                    header("Location:" . base_url("/training/docs_add_edit/" . $this->data['id'])); 
                    die;
                }
                else
                {
                    $entity_model->update($resid,$this->data['details']);
                    header("Location:" . base_url("/training/docs_add_edit/" . $this->data['id'])); 
                    die;
                }  
                
                $this->data['record'] = $entity_model->find($resid);
            }
            else
            {
                $this->data['record'] = $_POST;                
            }           

            $validation->listErrors();
        }
    }

    private function validation_rules_docs_entity_add_edit($id)
	{
        define("VALIDATION_MANDATORY_MSG", "{field} is mandatory.");

        return [
            'doc_type' => [
                'label'  => 'Doc type',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'remarks' => [
                'label'  => 'Remarks',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
        ];
        
    }

    public function docs_delete($id=0,$resid=0)
    {
        $entity_model = new TrainingDocsModel();

        $this->data['record'] = $entity_model->select("training_docs.*,training.training_name,file_registry.relative_path	")
                            ->join('training', 'training.id = training_docs.id_training', 'left')
                            ->join('file_registry', 'file_registry.id = training_docs.doc_path', 'left')
                            ->where('training_docs.id',$resid)
                            ->first(); 

        if($this->data['record']['doc_path'] > 1)
        {
            @unlink(substr(ROOTPATH,0,-1) . $this->data['record']['relative_path']);
            s3_delete(substr($this->data['record']['relative_path'],1));
        }

        $reg_model = new FileregisteryModel();
        $this->data['file_registery'] = [
            'status' => 0,
        ];
        $reg_model->update($this->data['record']['doc_path'],$this->data['file_registery']);

        $entity_model->delete($resid);
        header("Location:" . base_url("/training/docs_add_edit/" . $id)); 
        die;
    }

    public function delete($id=0)
    {
        $entity_model = new TrainingModel();

        $entity_model->delete($id);
        header("Location:" . base_url("/training/list_all/")); 
        die;
    }

    private function get_filter()
    {
        $where = "training.created_at IS NOT NULL";

        $field_name = "training_name";
        if(isset($_POST[$field_name]) && strlen(trim($_POST[$field_name])) > 0)
        {
            $where .= " AND training." . $field_name . " LIKE '%" . trim($_POST[$field_name]) . "%'";
        }

        $field_name = "project_name";
        if(isset($_POST[$field_name]) && strlen(trim($_POST[$field_name])) > 0)
        {
            $where .= " AND project." . $field_name . " LIKE '%" . trim($_POST[$field_name]) . "%'";
        }

        $field_name = "type_of_training";
        if(isset($_POST[$field_name]) && strlen(trim($_POST[$field_name])) > 0)
        {
            $where .= " AND training." . $field_name . " LIKE '%" . trim($_POST[$field_name]) . "%'";
        }

        return $where;
    }
}