<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_pack extends CI_Controller {

	public function index()	{
		$this->load->model('products/M_product');
		$this->loadViewsInit();		
	}

	public function loadViewsInit() {
		$page_data['page_content'] = 'products/v_product_pack';
		$page_data['page_sidebar_left'] = 'layouts/sidebar_left';
		$page_data['custom_js'] = array ('/public/assets/js/ajax-filter.js');
		$page_data['product_list'] = $this->M_product->getProductListFilter();
		$page_data['pack'] = $this->M_product->getProduct(1);

        $this->load->view('/layouts/main', $page_data);
	}
}