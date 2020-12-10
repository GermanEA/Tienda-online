<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_shirt extends CI_Controller {

	public function index()	{
		$this->load->model('products/M_product');
		$this->loadViewsInit();
		
	}

	public function loadViewsInit() {
		$page_data['page_content'] = 'products/v_product_shirt';
		$page_data['shirt'] = $this->M_product->getProduct('CAMISETA');
        $this->load->view('/layouts/main', $page_data);
	}
}