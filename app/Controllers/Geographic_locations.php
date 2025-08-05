<?php

namespace App\Controllers;
use App\Models\GeographicLocationsModel;


class Geographic_locations extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['entity_model'] = new GeographicLocationsModel();

        $this->data['parent_menue'] = array("project"=>"project","off_farm_development"=>"off_farm_development","matching_grant_development"=>"matching_grant_development");
        
        track();
    }

    public function list_all($table="",$entity_id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/geographic_locations/list_all/";
        $this->data['csrf'] = 1;
        $this->data['table'] = $table;
        $this->data['entity_id'] = $entity_id;

       
        $this->data['list_all'] = $this->data['entity_model']->select("geographic_locations.*")                        
                            ->where($this->get_filter())
                            ->findAll();
                            
        return view('geographic_locations/list_all',$this->data);
    }

    public function add_edit($table="",$entity_id=0,$id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/geographic_locations/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        $this->data['table'] = $table;
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $this->data['entity_model']->select("*")
                            ->where("id", $id)
                            ->first();  
        
        $this->process_form_add_edit($table,$entity_id,$id);   
        
        return view('geographic_locations/add_edit',$this->data);
    }

    private function process_form_add_edit($table="",$entity_id=0,$id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit());

            $loan_disbursement_entity = $this->request->getVar('loan_disbursement_entity');
          
            $this->data['details'] = [
                'entity_table' => $table,
                'entity_id' => $entity_id,
                'label' => $this->request->getVar('label'),
                'lat' => $this->request->getVar('lat'),
                'lng' => $this->request->getVar('lng'),
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
                
                header("Location:" . base_url("/geographic_locations/list_all/" . $table . "/" . $entity_id . "/" . $id . "/")); 
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
            'lat' => [
                'label'  => ucfirst(str_replace("_"," ","latitude")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'lng' => [
                'label'  => ucfirst(str_replace("_"," ","longitude")),
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
        ];
        
    }

    public function delete($table="",$entity_id=0,$id=0)
    {
        $this->data['entity_id'] = $entity_id;

        $this->data['entity_model']->delete($id);
        header("Location:" . base_url("/geographic_locations/list_all/" . $table . "/" . $entity_id)); 
        die;
    }

    private function get_filter()
    {
        $where = "geographic_locations.created_at IS NOT NULL AND geographic_locations.entity_id =" . $this->data['entity_id'] . " AND geographic_locations.entity_table LIKE '" . $this->data['table'] . "'";

        $field_name = "label";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND geographic_locations." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        return $where;
    }
}