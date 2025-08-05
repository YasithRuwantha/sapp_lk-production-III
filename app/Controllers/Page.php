<?php

namespace App\Controllers;

class Page extends BaseController
{
    private $data;

    public function __construct()
    {
        $this->data = array();
        
        helper('cano'); //Constructer won't auto load helpers. So manual load required.
        $this->data["db"] = \Config\Database::connect(); 

        track();
    }

    public function cookie()
	{
        /**
         * Building breadcrumb fo selected action
         */
        $this->data['breadcrumb'] = array(
            array('label'=>'Home','url'=>base_url()),
            array('label'=>'Pages','url'=>base_url("/page/cookie")),
            array('label'=>'Cookie Policy')
        ); 

        return view('page/cookie',$this->data);
    }

    public function privacy()
	{
        $this->data['active_module'] = "/page/privacy/";
        return view('page/privacy',$this->data);
    }
}