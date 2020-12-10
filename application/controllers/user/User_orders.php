<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_orders extends CI_Controller {

	public function index()	{
		$this->loadViewsInit();		
	}

	public function loadViewsInit() {
		$page_data['page_content'] = 'user/v_user_orders';
		$this->load->view('/layouts/main', $page_data);
	}	

}