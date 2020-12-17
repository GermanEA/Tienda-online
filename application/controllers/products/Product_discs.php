<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_discs extends CI_Controller {

	public function index()	{
		$this->load->model('products/M_product');
		$this->loadViewsInit();
		
	}

	public function loadViewsInit() {
		$page_data['page_content'] = 'products/v_product_discs';
		$page_data['page_sidebar_left'] = 'layouts/sidebar_left';
		$page_data['custom_js'] = array('/public/assets/js/ajax-filter.js');
		$page_data['product_list'] = $this->M_product->getProductListFilter();
		$page_data['discs'] = $this->M_product->getProduct(2);
		
        $this->load->view('/layouts/main', $page_data);
	}
}