<?php

namespace App\Controllers;
use App\Models\MatchingGrantDevelopmentModel;
use App\Models\NscPaperModel;
use App\Models\ProjectModel;
use App\Models\FileregisteryModel;
use App\Models\LinkMatchingGrantDevelopmentFileModel;
use App\Models\GeographicLocationsModel;

class Matching_grant_development extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['status_nsc_approval'] = json_decode('{"1":"Approved", "2":"Not approved"}',TRUE);

        $this->data['geo_model'] = new GeographicLocationsModel(); //GEO class

        track();
    }

    public function list_all()
	{
        auth_rd(151);
        $this->data['active_module'] = "/matching_grant_development/list_all/";
        $this->data['csrf'] = 1;
        
        $entity_model = new MatchingGrantDevelopmentModel();
        $project_model = new ProjectModel();
        $paper_model = new NscPaperModel();

        $this->data['list_all'] = $entity_model->select("matching_grant_development.*")
                            ->where($this->get_filter())
                            ->findAll();

        $this->data['project_id'] = $project_model->select("*")->findAll();
        $this->data['nsc_paper_id'] = $paper_model->select("*")->findAll();
     
        return view('matching_grant_development/list_all',$this->data);
    }

    public function view($id=0)
	{
        auth_rd(152);
        $this->data['active_module'] = "/matching_grant_development/add_edit/";
        $this->data['csrf'] = 1;
        
        $entity_model = new MatchingGrantDevelopmentModel();
        $link_model = new LinkMatchingGrantDevelopmentFileModel();
        $project_model = new ProjectModel();
        $paper_model = new NscPaperModel();
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $entity_model->select("*")
                            ->where("id", $id)
                            ->first();  

        $this->data['list_docs'] = $link_model->select("file_registry.*")
                            ->join('file_registry', 'file_registry.id = link_matching_grant_development_file.file_id', 'left')
                            ->where("link_matching_grant_development_file.matching_grant_development_id",$id)
                            ->findAll();

        $this->data['project_id'] = $project_model->select("*")->findAll();
        $this->data['nsc_paper_id'] = $paper_model->select("*")->findAll();

        $this->data['geo_data'] = $this->data['geo_model']->select("*")->where("entity_table","matching_grant_development")->where("entity_id",$id)->first(); //GEO data
        
        $this->process_form_add_edit($id); 

        return view('matching_grant_development/add_edit',$this->data);
    }

    public function add_edit($id=0)
	{
        // auth_rd();
        ($id == 0) ? auth_rd(153) : auth_rd(154); // add : edit
        $this->data['active_module'] = "/matching_grant_development/add_edit/";
        $this->data['csrf'] = 1;
        
        $entity_model = new MatchingGrantDevelopmentModel();
        $link_model = new LinkMatchingGrantDevelopmentFileModel();
        $project_model = new ProjectModel();
        $paper_model = new NscPaperModel();
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $entity_model->select("*")
                            ->where("id", $id)
                            ->first();  

        $this->data['list_docs'] = $link_model->select("file_registry.*")
                            ->join('file_registry', 'file_registry.id = link_matching_grant_development_file.file_id', 'left')
                            ->where("link_matching_grant_development_file.matching_grant_development_id",$id)
                            ->findAll();

        $this->data['project_id'] = $project_model->select("*")->findAll();
        $this->data['nsc_paper_id'] = $paper_model->select("*")->findAll();

        $this->data['geo_data'] = $this->data['geo_model']->select("*")->where("entity_table","matching_grant_development")->where("entity_id",$id)->first(); //GEO data
        
        $this->process_form_add_edit($id); 

        return view('matching_grant_development/add_edit',$this->data);
    }

    private function process_form_add_edit($id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new MatchingGrantDevelopmentModel();

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit($id));

            $loan_disbursement_entity = $this->request->getVar('loan_disbursement_entity');
          
            $this->data['details'] = [
                'matching_grant_dev_name' => $this->request->getVar('matching_grant_dev_name'),
                'project_id' => $this->request->getVar('project_id'),
                'no_direct_benificiary' => $this->request->getVar('no_direct_benificiary'),
                'no_indirect_benificiary' => $this->request->getVar('no_indirect_benificiary'),
                'nsc_paper_id' => $this->request->getVar('nsc_paper_id'),
                'status_nsc_approval' => $this->request->getVar('status_nsc_approval'),
                'remarks' => $this->request->getVar('remarks'),
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
                $link_model = new LinkMatchingGrantDevelopmentFileModel();

                $total = count($_FILES['img']['name']);

                for( $i=0 ; $i < $total ; $i++ ) {
                    if(is_file($_FILES["img"]["tmp_name"][$i])) 
                    {
                        $path = $_FILES['img']['name'][$i];
                        $ext = pathinfo($path, PATHINFO_EXTENSION);
                        $sub_path = "public/resource/matching_grant/" . md5($path . time()) . "." . $ext;
                        $target_file = ROOTPATH . $sub_path;
                        if(move_uploaded_file($_FILES["img"]["tmp_name"][$i], $target_file)) 
                        {
                            $this->data['file_registery'] = [
                                'added_on' => time(),
                                'relative_path' => '/' . $sub_path,
                                'ref_table' => 'matching_grant_development',
                                'file_name' => $path,
                                'status' => 1,
                            ];

                            $reg_model->insert($this->data['file_registery']);
                            $file_id = $reg_model->getInsertID();

                            $this->data['file_link'] = [
                                'matching_grant_development_id' => $this->data['id'],
                                'file_id' => $file_id,
                            ];

                            $link_model->insert($this->data['file_link']);
                            $link_id = $reg_model->getInsertID();

                            s3_upload($target_file,$sub_path);
                        }
                    }
                }

                /**
                 * GEO data related code
                 */
                $this->data['geo_details'] = [
                    'entity_table' => "matching_grant_development",
                    'entity_id' => $this->data['id'],
                    'lat' => $this->request->getVar('lat'),
                    'lng' => $this->request->getVar('lng'),
                    'altitude' => $this->request->getVar('altitude'),
                ];                

                if(!isset($this->data['geo_data']['id']))
                {
                    $this->data['geo_model']->insert($this->data['geo_details']);
                }
                else
                {
                    $this->data['geo_model']->update($this->data['geo_data']['id'],$this->data['geo_details']);
                    if(isset($_POST['altitude']))
                {
                    $this->data['geo_data']['lat'] = $_POST['lat'];
                    $this->data['geo_data']['lng'] = $_POST['lng'];
                    $this->data['geo_data']['altitude'] = $_POST['altitude'];
                }
                }
                
                header("Location:" . base_url("/matching_grant_development/list_all/")); 
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
            'matching_grant_dev_name' => [
                'label'  => 'Matching grant dev name',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'project_id' => [
                'label'  => 'Project',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'no_direct_benificiary' => [
                'label'  => 'No of direct benificiary',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'no_indirect_benificiary' => [
                'label'  => 'No of indirect benificiary',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'nsc_paper_id' => [
                'label'  => 'NSC paper',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'status_nsc_approval' => [
                'label'  => 'Status NSC approval',
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

    public function delete($id=0)
    {
        auth_rd(155);
        $entity_model = new MatchingGrantDevelopmentModel();

        $entity_model->delete($id);
        header("Location:" . base_url("/matching_grant_development/list_all/")); 
        die;
    }

    private function get_filter()
    {
        $where = "matching_grant_development.created_at IS NOT NULL";

        $field_name = "matching_grant_dev_name";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND matching_grant_development." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "nsc_paper_id";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND matching_grant_development." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "nsc_paper_id";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND matching_grant_development." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "implementation_ajency";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND matching_grant_development." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        return $where;
    }
}