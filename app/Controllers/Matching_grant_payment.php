<?php

namespace App\Controllers;
use App\Models\MatchingGrantPaymentModel;
use App\Models\MatchingGrantActivityModel;

class Matching_grant_payment extends BaseController
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
        $this->data['active_module'] = "/matching_grant_payment/list_all/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $entity_model = new MatchingGrantPaymentModel();

        $this->data['list_all'] = $entity_model->select("matching_grant_payment.*,matching_grant_activity.activity")
                            ->join('matching_grant_activity', 'matching_grant_activity.id = matching_grant_payment.matching_grant_development_id', 'left')
                            ->where($this->get_filter())
                            ->findAll();

        return view('matching_grant_payment/list_all',$this->data);
    }

    public function add_edit($entity_id=0,$id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/matching_grant_payment/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $entity_model = new MatchingGrantPaymentModel();
        $activity_model = new MatchingGrantActivityModel();
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $entity_model->select("*")
                            ->where("id", $id)
                            ->first();  

        $this->data['matching_grant_activity'] = $activity_model->select("*")
                            ->findAll();  

        $this->process_form_add_edit($entity_id,$id);        

        return view('matching_grant_payment/add_edit',$this->data);
    }

    private function process_form_add_edit($entity_id=0,$id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new MatchingGrantPaymentModel();

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit($id));

            $this->data['details'] = [
                'matching_grant_development_id' => $entity_id,
                'payment_date' => $this->request->getVar('payment_date'),
                'matching_grant_development_id' => $this->request->getVar('matching_grant_development_id'),
                'payment_amount' => $this->request->getVar('payment_amount'),
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
                
                header("Location:" . base_url("/matching_grant_payment/list_all/" . $entity_id . "/")); 
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
            'payment_date' => [
                'label'  => 'Payment date',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'matching_grant_development_id' => [
                'label'  => 'Off farm activity',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'payment_amount' => [
                'label'  => 'Payment amount',
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

    public function delete($entity_id=0,$id=0)
    {
        $this->data['entity_id'] = $entity_id;
        $entity_model = new MatchingGrantPaymentModel();

        $entity_model->delete($id);
        header("Location:" . base_url("/matching_grant_payment/list_all/" . $entity_id)); 
        die;
    }

    private function get_filter()
    {
        $where = 'matching_grant_payment.matching_grant_development_id =' . $this->data['entity_id'];

        $field_name = "payment_date";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND matching_grant_payment." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "payment_amount";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND matching_grant_payment." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "remarks";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND matching_grant_payment." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        return $where;
    }
}