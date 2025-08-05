<?php

namespace App\Controllers;
use App\Models\ProcurementBidModel;
use App\Models\ProcurementModel;
use App\Models\FileregisteryModel;
use App\Models\LinkProcurementBidFileModel;
use App\Models\LinkProcurementBidModel;

class Procurement_bid extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        $this->data['status'] = json_decode('{"1":"BID Accepted", "2":"BID Rejected", "3":"BID Not Considered", "4":"BID Awarded"}',TRUE);

        $this->data['entity_model'] = new ProcurementBidModel();
        $this->data['entity_model_1'] = new LinkProcurementBidModel();  
        
        $this->data['reg_model'] = new FileregisteryModel();
        $this->data['link_model'] = new LinkProcurementBidFileModel();
        
        track();
    }

    public function list_all($entity_id=0,$category=1)
	{
        auth_rd();
        $this->data['active_module'] = "/procurement_bid/list_all/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;

       
        $this->data['list_all'] = $this->data['entity_model']->select("procurement_bid.*")
                            ->join('link_procurement_bid', 'procurement_bid.id = link_procurement_bid.bid_id', 'left')
                            ->join('procurement', 'procurement.id = link_procurement_bid.procurement_id', 'left')                            
                            ->where($this->get_filter())
                            ->findAll();
                            
        return view('procurement_bid/list_all',$this->data);
    }

    public function add_edit($entity_id=0,$id=0)
	{
        auth_rd();
        $this->data['active_module'] = "/procurement_bid/add_edit/";
        $this->data['csrf'] = 1;
        $this->data['entity_id'] = $entity_id;
        
        $this->data['id'] = $id;
        
        $this->data['record'] = $this->data['entity_model']->select("*")
                            ->where("id", $id)
                            ->first();  
        
        $this->process_form_add_edit($entity_id,$id);   
        
        $this->data['list_docs'] = $this->data['link_model']->select("file_registry.*")
                            ->join('file_registry', 'file_registry.id = link_procurement_bid_file.file_id', 'left')
                            ->where("link_procurement_bid_file.procurement_bid_id",$id)
                            ->findAll();

        return view('procurement_bid/add_edit',$this->data);
    }

    private function process_form_add_edit($entity_id=0,$id=0)
    {
        $validation =  \Config\Services::validation();
        $this->data['validation'] = $validation;

        if(isset($_POST['csrf']))
        {
            $validation->setRules($this->validation_rules_entity_add_edit($id));

            $loan_disbursement_entity = $this->request->getVar('loan_disbursement_entity');
          
            $this->data['details'] = [
                'item' => $this->request->getVar('item'),
                'supplier' => $this->request->getVar('supplier'),
                'cost' => $this->request->getVar('cost'),
                'status' => $this->request->getVar('status'),
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

                $this->data['link_record'] = $this->data['entity_model_1']->select("*")
                            ->where("bid_id", $this->data['id'])
                            ->where("procurement_id", $this->data['entity_id'])
                            ->first();  

                if(!isset($this->data['link_record']['procurement_id']))
                {
                    $this->data['link_details'] = [
                        'bid_id' => $this->data['id'],
                        'procurement_id' => $this->data['entity_id'],
                    ];
                    $this->data['entity_model_1']->insert($this->data['link_details']);
                }

                $total = count($_FILES['img']['name']);

                for( $i=0 ; $i < $total ; $i++ ) {
                    if(is_file($_FILES["img"]["tmp_name"][$i])) 
                    {
                        $path = $_FILES['img']['name'][$i];
                        $ext = pathinfo($path, PATHINFO_EXTENSION);
                        $sub_path = "public/resource/procurement/" . md5($path . time()) . "." . $ext;
                        $target_file = ROOTPATH . $sub_path;
                        if(move_uploaded_file($_FILES["img"]["tmp_name"][$i], $target_file)) 
                        {
                            $this->data['file_registery'] = [
                                'added_on' => time(),
                                'relative_path' => '/' . $sub_path,
                                'ref_table' => 'procurement_bid',
                                'file_name' => $path,
                                'status' => 1,
                            ];

                            $this->data['reg_model']->insert($this->data['file_registery']);
                            $file_id = $this->data['reg_model']->getInsertID();

                            $this->data['file_link'] = [
                                'procurement_bid_id' => $this->data['id'],
                                'file_id' => $file_id,
                            ];

                            $this->data['link_model']->insert($this->data['file_link']);
                            $link_id = $this->data['link_model']->getInsertID();

                            s3_upload($target_file,$sub_path);
                        }
                    }
                }
                
                header("Location:" . base_url("/procurement_bid/list_all/" . $entity_id . "/" . $id . "/")); 
                die;

                $this->data['record'] = $this->data['entity_model']->find($id);
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
            'item' => [
                'label'  => 'Item',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'supplier' => [
                'label'  => 'Supplier',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'cost' => [
                'label'  => 'Cost',
                'rules'  => 'required',
                'errors' => [
                    'required' => VALIDATION_MANDATORY_MSG
                ]
            ],
            'status' => [
                'label'  => 'Status',
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

        $this->data['entity_model_1']->where('procurement_id', $entity_id)->where('bid_id', $id)->delete();
        $this->data['entity_model']->delete($id);
        header("Location:" . base_url("/procurement_bid/list_all/" . $entity_id)); 
        die;
    }

    private function get_filter()
    {
        $where = "procurement_bid.created_at IS NOT NULL AND link_procurement_bid.procurement_id =" . $this->data['entity_id'];

        $field_name = "item";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND procurement_bid." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        $field_name = "supplier";
        if(isset($_GET[$field_name]) && strlen(trim($_GET[$field_name])) > 0)
        {
            $where .= " AND procurement_bid." . $field_name . " LIKE '%" . trim($_GET[$field_name]) . "%'";
        }

        return $where;
    }
}