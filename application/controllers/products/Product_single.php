<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_single extends CI_Controller {

	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('products/M_product');
	}
	

	public function index()	{
		$this->loadViewsInit();		
	}

	public function loadViewsInit() {
        $data = $this->input->post();

		$page_data['page_content'] = 'products/v_product_single';
		$page_data['product'] = $this->M_product->getProductSingle($data['codigo']);
        $page_data['size'] = $this->M_product->getProductSize($data['tipo']);

        $this->load->view('/layouts/main', $page_data);
	}
}