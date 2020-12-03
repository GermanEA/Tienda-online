<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Single_page extends CI_Controller {

	

	public function index()	{
		$this->load->helper('url');

		$this->load->view('V_single_page');
		
	}

	

	

}