<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_data extends CI_Controller {

	public function index()	{
		$this->loadViewsInit();	
	}

	public function loadViewsInit() {
		$page_data['page_content'] = 'user/v_user_data';
        $this->load->view('/layouts/main', $page_data);
	}

	public function changeData() {
		$page_data['page_content'] = 'user/v_user_change';
        $this->load->view('/layouts/main', $page_data);
	}

}