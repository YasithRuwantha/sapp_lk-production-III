<?php

namespace App\Controllers;

class Home extends BaseController
{
	public function __construct()
    {
		helper("array");
	}
	
	public function index()
	{
		if(isset($_SESSION['user']['id']))
        {
            header("Location:" . base_url("/dashboard/default/")); 
            die;
        }
		return view('home/login');
	}
}
