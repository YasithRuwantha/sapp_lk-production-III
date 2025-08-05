<?php

namespace App\Controllers;
use App\Models\FixedAssertRegistryModel;
use App\Models\OwnerFixedAssertModel;
use App\Models\UserModel;
use phpDocumentor\Reflection\Types\This;

class Fixed_assert extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['ownership_status'] = json_decode(get_config(73),TRUE);
        $this->data['type_of_asset'] = json_decode(get_config(30),TRUE);

        track();
    }

    public function list_all()
	{
        auth_rd();
        $this->data['active_module'] = "/fixed_assert/list_all/";
        $this->data['csrf'] = 1;
        
        $entity_model = new FixedAssertRegistryModel();
        $this->data['list_all'] = $entity_model->select("fixed_asset_registry.*,fixed_asset_owner.ownership_status,user.fname,user.lname")
                            ->join('fixed_asset_owner', 'fixed_asset_registry.id = fixed_asset_owner.fixed_asset_registry_id AND fixed_asset_owner.ownership_status != 3', 'left')
                            ->join('user', 'user.id = fixed_asset_owner.user_id', 'left')
                            ->where($this->get_filter())
                            ->findAll();

        return view('fixed_assert/list_all',$this->data);
    }

    public function list_mine()
	{
        auth_rd();
        $this->data['active_module'] = "/fixed_assert/list_all/";
        $this->data['csrf'] = 1;
        
        $entity_model = new FixedAssertRegistryModel();
        $this->data['list_all'] = $entity_model->select("fixed_asset_registry.*,fixed_asset_owner.ownership_status,user.fname,user.lname")
                            ->join('fixed_asset_owner', 'fixed_asset_registry.id = fixed_asset_owner.fixed_asset_registry_id AND fixed_asset_owner.ownership_status != 3', 'left')
                            ->join('user', 'user.id = fixed_asset_owner.user_id', 'left')
                            ->where('fixed_asset_owner.user_id',$_SESSION['user']['id'])
                            ->findAll();

        return view('fixed_assert/list_mine',$this->data);
    }

    public function add_edit($id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/fixed_assert/add_edit/";
        $this->data['csrf'] = 1;

        $this->data['latest_working_status'] = array(1=> "To be replaced", 2 => "Poor", 3 => "Average", 4 => "Good" );
        
        $entity_model = new FixedAssertRegistryModel();
        $user_model = new UserModel();
        $owner_model = new OwnerFixedAssertModel();
        
        $this->data['user_list'] = $user_model->where("user_type",1)->findAll();
        $this->data['id'] = $id;      
        
        $this->data['record'] = $entity_model->select("fixed_asset_registry.*,fixed_asset_owner.ownership_status,fixed_asset_owner.ownership_transfer_date,fixed_asset_owner.user_id,fixed_asset_owner.remarks,user.fname,user.lname")
                            ->join('fixed_asset_owner', 'fixed_asset_registry.id = fixed_asset_owner.fixed_asset_registry_id AND fixed_asset_owner.ownership_status != 3', 'left')
                            ->join('user', 'user.id = fixed_asset_owner.user_id', 'left')
                            ->where("fixed_asset_registry.id", $id)
                            ->first(); 

        $this->process_form_add_edit($id);        

        return view('fixed_assert/add_edit',$this->data);
    }

    private function process_form_add_edit($id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        $entity_model = new FixedAssertRegistryModel();
        $owner_model = new OwnerFixedAssertModel();

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit($id));
          
            $this->data['details'] = [
                'sapp_serial_no' => $this->request->getVar('sapp_serial_no'),
                'description' => $this->request->getVar('description'),
                'manufactor_serial_no' => $this->request->getVar('manufactor_serial_no'),
                'asset_code' => $this->request->getVar('asset_code'),
                'type_of_asset' => $this->request->getVar('type_of_asset'),
                'latest_working_status' => $this->request->getVar('latest_working_status'),
                'remarks' => $this->request->getVar('remarks'),
                'price' => $this->request->getVar('price'),
                'folio_no' => $this->request->getVar('folio_no'),
                'grn_no' => $this->request->getVar('grn_no'),
                'supplier_name' => $this->request->getVar('supplier_name'),
                'disposal_date' => $this->request->getVar('disposal_date'),
                'disposal_remark' => $this->request->getVar('disposal_remark'),
                'voucher_no' => $this->request->getVar('voucher_no'),
            ];
            

            if($validation->withRequest($this->request)->run())
            { 
                if(!isset($this->data['record']['id']))
                {
                    $entity_model->insert($this->data['details']);
                    $this->data['id'] = $entity_model->getInsertID();

                    $this->data['owner_details'] = [
                        'ownership_transfer_date' => $this->request->getVar('ownership_transfer_date'),
                        'ownership_status' => $this->request->getVar('ownership_status'),
                        'user_id' => $this->request->getVar('user_id'),
                        'remarks' => $this->request->getVar('remarks'),
                        'fixed_asset_registry_id' => $this->data['id'],
                    ];

                    $owner_model->insert($this->data['owner_details']);                    
                }
                else
                {
                    $entity_model->update($id,$this->data['details']);

                    $owner_model->where('user_id', $this->request->getVar('user_id'))->where('fixed_asset_registry_id', $id)->delete();
                    $owner_model->purgeDeleted();

                    $owner = $owner_model->select("*")
                            ->where("fixed_asset_registry_id", $id)
                            ->orderBy('id', 'desc')
                            ->first();  

                    if(isset($owner['id']))
                    {
                        $owner_details = [
                            'ownership_transfer_date' => $this->request->getVar('ownership_transfer_date'),
                            'ownership_status' => 3,
                        ];
                        $owner_model->update($owner['id'],$owner_details);
                    }

                    $this->data['owner_details'] = [
                        'ownership_transfer_date' => $this->request->getVar('ownership_transfer_date'),
                        'ownership_status' => $this->request->getVar('ownership_status'),
                        'user_id' => $this->request->getVar('user_id'),
                        'remarks' => $this->request->getVar('remarks'),
                        'fixed_asset_registry_id' => $id,
                    ];

                    $owner_model->insert($this->data['owner_details']);
                }                

                $this->data['record'] = $entity_model->find($id);

                header("Location:" . base_url("/fixed_assert/list_all/")); 
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
            'sapp_serial_no' => [
                'label'  => 'Serial number',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'description' => [
                'label'  => 'Description',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'manufactor_serial_no' => [
                'label'  => 'Manufacture serial no',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'asset_code' => [
                'label'  => 'Assert code',
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
            'price' => [
                'label'  => 'Price',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'folio_no' => [
                'label'  => 'Folio number',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'grn_no' => [
                'label'  => 'GRN number',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],            
            'supplier_name' => [
                'label'  => 'Supplier name',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG,
                ]
            ],
            'voucher_no' => [
                'label'  => 'Voucher number',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'user_id' => [
                'label'  => 'Current / Last owner',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'ownership_status' => [
                'label'  => 'Ownership status',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'ownership_transfer_date' => [
                'label'  => 'Ownership transfer date',
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
        $entity_model = new FixedAssertRegistryModel();
        $owner_model = new OwnerFixedAssertModel();

        $owner_model->where('fixed_asset_registry_id', $id)->delete();
        $entity_model->delete($id);
        header("Location:" . base_url("/fixed_assert/list_all/")); 
        die;
    }

    private function get_filter()
    {
        $where = "fixed_asset_registry.created_at IS NOT NULL";

        $field_name = "sapp_serial_no";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND fixed_asset_registry." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "description";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND fixed_asset_registry." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "manufactor_serial_no";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND fixed_asset_registry." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "asset_code";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND fixed_asset_registry." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        return $where;
    }
}