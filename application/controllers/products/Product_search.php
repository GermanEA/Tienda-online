<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_search extends CI_Controller {

	public function index()	{
		$this->load->model('products/M_product');
		$this->loadViewsInit();		
	}

	public function loadViewsInit() {
        $postData = $this->input->post();

		$page_data['search'] = $this->M_product->getProductAjax($postData);
		$page_data['size_shirt'] = $this->M_product->getProductSize(3);
		$page_data['size_sweetshirt'] = $this->M_product->getProductSize(4);
        
        $this->load->view('/products/v_product_search', $page_data);
	}

	public function searchAjax() {
		$postData = $this->input->post();

		$this->load->model('products/M_product');

		$page_data['page_content'] = 'products/v_product_search';
		$page_data['page_sidebar_left'] = 'layouts/sidebar_left';
		$page_data['custom_js'] = array ('/public/assets/js/ajax-filter.js');
		$page_data['search'] = $this->M_product->getProductAjaxWords($postData);
		$page_data['product_list'] = $this->M_product->getProductListFilter();
		$page_data['size_shirt'] = $this->M_product->getProductSize(3);
		$page_data['size_sweetshirt'] = $this->M_product->getProductSize(4);


		$this->load->view('/products/v_product_search', $page_data);

		// $this->load->view('/layouts/main', $page_data);
	}
}