<?php

namespace App\Controllers;
use App\Models\EoiApplicationModel;
use App\Models\EoiModel;
use App\Models\EoiApplicantModel;

class Eoi_application extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['eoi_application_status'] = json_decode(get_config(34),TRUE);

        track();
    }

    public function list_all($eoi_id=0)
	{
        auth_rd(97);
        $this->data['active_module'] = "/eoi_application/list_all/";
        $this->data['csrf'] = 1;
        $this->data['eoi_id'] = $eoi_id;
        
        $entity_model = new EoiApplicationModel();
        $applicant_model = new EoiApplicantModel();

        $this->data['list_all'] = $entity_model->select("eoi_application.*,eoi_applicant.first_name,eoi_applicant.last_name,eoi.eoi_name")
                            ->join('eoi', 'eoi_application.eoi_id = eoi.id', 'left')
                            ->join('eoi_applicant', 'eoi_application.eoi_applicant_id = eoi_applicant.id', 'left')
                            ->where($this->get_filter($eoi_id))
                            ->findAll();
        $this->data['applicant_list'] = $applicant_model->findAll();

        return view('eoi_application/list_all',$this->data);
    }

    public function view($eoi_id=0,$id=0)
	{
        auth_rd(98);
        $this->data['active_module'] = "/eoi_application/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['eoi_id'] = $eoi_id;
        
        $entity_model = new EoiApplicationModel();
        $applicant_model = new EoiApplicantModel();
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $entity_model->select("*")
                            ->where("id", $id)
                            ->first();  
        $this->data['applicant_list'] = $applicant_model->findAll();

        $this->process_form_add_edit($eoi_id,$id);        

        return view('eoi_application/add_edit',$this->data);
    }


    public function add_edit($eoi_id=0,$id=0)
	{
        // auth_rd();
        ($id == 0) ? auth_rd(99) : auth_rd(100); // Add : Edit
        $this->data['active_module'] = "/eoi_application/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['eoi_id'] = $eoi_id;
        
        $entity_model = new EoiApplicationModel();
        $applicant_model = new EoiApplicantModel();
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $entity_model->select("*")
                            ->where("id", $id)
                            ->first();  
        $this->data['applicant_list'] = $applicant_model->findAll();

        $this->process_form_add_edit($eoi_id,$id);        

        return view('eoi_application/add_edit',$this->data);
    }

    private function process_form_add_edit($eoi_id=0,$id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new EoiApplicationModel();

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit($id));
          
            $this->data['details'] = [
                'eoi_id' => $eoi_id,
                'eoi_applicant_id' => $this->request->getVar('eoi_applicant_id'),
                'bp_application_acknowladgement_date' => $this->request->getVar('bp_application_acknowladgement_date'),
                'bp_reg_date' => $this->request->getVar('bp_reg_date'),
                'shortlist_date' => $this->request->getVar('shortlist_date'),
                'shortlist_marks' => $this->request->getVar('shortlist_marks'),
                'initial_discussion_date' => $this->request->getVar('initial_discussion_date'),
                '1st_imc_meeting_date' => $this->request->getVar('1st_imc_meeting_date'),
                '1st_imc_remarks' => $this->request->getVar('1st_imc_remarks'),
                'feasibility_study_visit_date' => $this->request->getVar('feasibility_study_visit_date'),
                'feasibility_study_completion_date' => $this->request->getVar('feasibility_study_completion_date'),
                '2nd_imc_meeting_date' => $this->request->getVar('2nd_imc_meeting_date'),
                '2nd_imc_remarks' => $this->request->getVar('2nd_imc_remarks'),
                'bp_submission_date' => $this->request->getVar('bp_submission_date'),
                '3rd_imc_meeting_date' => $this->request->getVar('3rd_imc_meeting_date'),
                '3rd_imc_remarks' => $this->request->getVar('3rd_imc_remarks'),
                'bpec_meeting_date' => $this->request->getVar('bpec_meeting_date'),
                'bpec_remarks' => $this->request->getVar('bpec_remarks'),
                'eoi_application_status' => $this->request->getVar('eoi_application_status'),
                'remarks' => $this->request->getVar('remarks'),
                'final_bp_submission_mc_date' => $this->request->getVar('final_bp_submission_mc_date'),
                'bpec_approval_date' => $this->request->getVar('bpec_approval_date'),
                'nsc_approval_date' => $this->request->getVar('nsc_approval_date'),
                'ifad_approval_date' => $this->request->getVar('ifad_approval_date'),
                'agreement_signed_date' => $this->request->getVar('agreement_signed_date'),
                'implementation_start_date' => $this->request->getVar('implementation_start_date'),
            ];
            

            if($validation->withRequest($this->request)->run())
            { 
                if(!isset($this->data['record']['id']))
                {
                    $entity_model->insert($this->data['details']);
                    $this->data['id'] = $entity_model->getInsertID();

                    header("Location:" . base_url("/eoi_application/list_all/" . $eoi_id . "/" . $this->data['id'])); 
                    die;
                }
                else
                {
                    $entity_model->update($id,$this->data['details']);
                }                

                $this->data['record'] = $entity_model->find($id);
                header("Location:" . base_url("/eoi_application/list_all/" . $eoi_id . "/" . $this->data['id'])); 
                die;
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
            'eoi_applicant_id' => [
                'label'  => 'Applicant',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ]
        ];
        
    }

    public function delete($eoi_id=0,$id=0)
    {
        auth_rd(101);
        $this->data['eoi_id'] = $eoi_id;
        $entity_model = new EoiApplicationModel();

        $entity_model->delete($id);
        header("Location:" . base_url("/eoi_application/list_all/" . $eoi_id)); 
        die;
    }

    private function get_filter($eoi_id)
    {
        $where = "eoi_application.eoi_id = ".$eoi_id;

        $field_name = "eoi_name";
        if(isset($_POST[$field_name]) && strlen(trim($_POST[$field_name])) > 0)
        {
            $where .= " AND eoi." . $field_name . " LIKE '%" . trim($_POST[$field_name]) . "%'";
        }

        $field_name = "full_name";
        $field_first_name = "eoi_applicant.first_name";
        $field_last_name = "eoi_applicant.last_name";
        if(isset($_POST[$field_name]) && strlen(trim($_POST[$field_name])) > 0)
        {
            $where .= " AND CONCAT(".$field_first_name.",' ',".$field_last_name . ") LIKE '%" . trim($_POST[$field_name]) . "%'";
        }

        return $where;
    }
}