<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function index()	{		
		$this->loadViewsInit();						
	}

	public function loadViewsInit() {
		$page_data['page_content'] = '/administrator/v_all_products';
		$this->load->view('/administrator/v_dashboard', $page_data);
    }
}