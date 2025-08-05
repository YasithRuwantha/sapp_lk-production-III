<?php

namespace App\Controllers;
use App\Models\QueryTemplateModel;
use App\Models\ProjectModel;

class Dashboard extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 
        track();
    }

    public function underconstruction()
	{
        auth_rd();
        $this->data['active_module'] = "/dashboard/underconstruction/";
        $this->data['csrf'] = 1;
        
        $entity_model = new QueryTemplateModel();        

        return view('dashboard/404',$this->data);
    }

    public function default()
	{
        auth_rd();
        $this->data['active_module'] = "/dashboard/default/";
        $this->data['csrf'] = 1;
        
        $entity_model = new QueryTemplateModel();        

        return view('dashboard/default',$this->data);
    }

    public function farmer_summary()
	{
        auth_rd();
        $this->data['active_module'] = "/dashboard/farmer_summary/";
        $this->data['csrf'] = 1;
        
        $entity_model = new QueryTemplateModel();        

        return view('dashboard/farmer_summary',$this->data);
    }

    public function project_location()
	{
        auth_rd();
        $this->data['active_module'] = "/dashboard/project_location/";
        $this->data['csrf'] = 1;
        
        $entity_model = new QueryTemplateModel();        

        return view('dashboard/project_location',$this->data);
    }

    public function farm_location()
	{
        auth_rd();
        $this->data['active_module'] = "/dashboard/farm_location/";
        $this->data['csrf'] = 1;
        
        $entity_model = new QueryTemplateModel();        

        return view('dashboard/farm_location',$this->data);
    }

    public function promoter_summary()
	{
        auth_rd();
        $this->data['active_module'] = "/dashboard/promoter_summary/";
        $this->data['csrf'] = 1;
        
        $entity_model = new QueryTemplateModel();        

        return view('dashboard/promoter_summary',$this->data);
    }

    public function training_summary()
	{
        auth_rd();
        $this->data['active_module'] = "/dashboard/training_summary/";
        $this->data['csrf'] = 1;
        
        $entity_model = new QueryTemplateModel();        

        return view('dashboard/training_summary',$this->data);
    }

    public function project()
	{
        auth_rd();
        $this->data['active_module'] = "/dashboard/project/";
        $this->data['filters'] = json_decode(get_config(92),TRUE);
        $this->data['csrf'] = 1;
        
        $entity_model = new QueryTemplateModel();      
        $project_model = new ProjectModel();  

        if(isset($_GET['p-id']))
        {
            $this->data['record'] = $project_model->find($_GET['p-id']);
        }

        return view('dashboard/project_single',$this->data);
    }
}