<?php

namespace App\Controllers;
use App\Models\EoiApplicantModel;
use App\Models\DistrictModel;

class Eoi_applicant extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['eoi_type'] = json_decode('{"1":"Grant Only", "2":"Loan Only", "3":"Grant & Loan"}',TRUE);
        $this->data['eoi_status'] = json_decode('{"1":"Planned", "2":"Published", "3":"Closed", "4":"BP Accepted"}',TRUE);
        $this->data['status_color'] = array(1=>"warning",2=>"default",3=>"primary",4=>"success",5=>"purple");

        track();
    }

    public function list_all()
	{
        auth_rd(103);
        $this->data['active_module'] = "/eoi_applicant/list_all/";
        $this->data['csrf'] = 1;
        
        $entity_model = new EoiApplicantModel();

        $this->data['list_all'] = $entity_model->select("eoi_applicant.*,district.district")
                            ->join('district', 'district.id = eoi_applicant.district_id', 'left')
                            ->findAll();

        return view('eoi_applicant/list_all',$this->data);
    }

    public function view($id=0)
	{
        auth_rd(104);
        $this->data['active_module'] = "/eoi_applicant/add_edit/";
        $this->data['csrf'] = 1;
        
        $entity_model = new EoiApplicantModel();
        $district_model = new DistrictModel();
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $entity_model->select("*")
                            ->where("id", $id)
                            ->first();  
        $this->data['district_list'] = $district_model->orderBy('district asc')->findAll();

        $this->process_form_add_edit($id);        

        return view('eoi_applicant/add_edit',$this->data);
    }

    public function add_edit($id=0)
	{
        // auth_rd();
        ($id == 0) ? auth_rd(105) : auth_rd(106); // add, edit 
        $this->data['active_module'] = "/eoi_applicant/add_edit/";
        $this->data['csrf'] = 1;
        
        $entity_model = new EoiApplicantModel();
        $district_model = new DistrictModel();
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $entity_model->select("*")
                            ->where("id", $id)
                            ->first();  
        $this->data['district_list'] = $district_model->orderBy('district asc')->findAll();

        $this->process_form_add_edit($id);        

        return view('eoi_applicant/add_edit',$this->data);
    }

    private function process_form_add_edit($id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new EoiApplicantModel();

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit($id));
          
            $this->data['details'] = [
                'title_of_applicant' => $this->request->getVar('title_of_applicant'),
                'first_name' => $this->request->getVar('first_name'),
                'last_name' => $this->request->getVar('last_name'),
                'address' => $this->request->getVar('address'),
                'district_id' => $this->request->getVar('district_id'),
                'contact_no_land' => $this->request->getVar('contact_no_land'),
                'contact_no_mobile' => $this->request->getVar('contact_no_mobile'),
                'email' => $this->request->getVar('email'),
                'nature_of_business' => $this->request->getVar('nature_of_business'),
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
                
                header("Location:" . base_url("/eoi_applicant/list_all/")); 
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
            'title_of_applicant' => [
                'label'  => 'Title of applicant',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'first_name' => [
                'label'  => 'First name',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'last_name' => [
                'label'  => 'Last name',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'address' => [
                'label'  => 'Address',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'contact_no_land' => [
                'label'  => 'Contact no land',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'nature_of_business' => [
                'label'  => 'Nature of business	',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
        ];
        
    }

    public function delete($id=0)
    {
        auth_rd(107);
        $entity_model = new EoiApplicantModel();

        $entity_model->delete($id);
        header("Location:" . base_url("/eoi_applicant/list_all/")); 
        die;
    }
}