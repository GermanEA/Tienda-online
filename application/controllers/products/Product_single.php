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
		$page_data['custom_js'] = array('/public/assets/js/single-product.js');
		$page_data['product'] = $this->M_product->getProductSingle($data['codigo']);
		$page_data['size'] = $this->M_product->getProductSize($data['tipo']);

		if( $page_data['size'] == NULL) {
			$page_data['stock'] = $this->M_product->getStockByProduct($page_data['product'][0]->id_producto)->stock;
		} else {
			$page_data['stock'] = NULL;
		}

		$this->load->view('/layouts/main', $page_data);
	}

	public function getStock() {
		$data = $this->input->post();
		$return = $this->M_product->getStockByProductAndSize($data['cp'], $data['ct'])->stock;
		
		echo $return;
	}
}