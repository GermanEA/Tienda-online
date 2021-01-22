<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_search extends CI_Controller {

	
	public function __construct() {
		parent::__construct();

		$this->load->model('products/M_product');
	}	

	public function index()	{
		
		$this->loadViewsInit();		
	}

	public function loadViewsInit() {
        $postData = $this->input->post();

		$page_data['search'] = $this->M_product->getProductAjax($postData);
		$page_data['size_shirt'] = $this->M_product->getProductSize(3);
		$page_data['size_sweetshirt'] = $this->M_product->getProductSize(4);

		$size_array = array();

		foreach( $page_data['product'] as $row ){
			foreach( $page_data['size'] as $row_size ){
				if( $row->codigo_producto == $row_size->codigo_producto ){
					$size_array[$row->codigo_producto] = $row_size->codigo_talla;
				}
			}
		}

		$page_data['stock'] = $size_array;
        
        $this->load->view('/products/v_product_search', $page_data);
	}

	public function searchAjax() {
		$postData = $this->input->post();

		$page_data['search'] = $this->M_product->getProductAjaxWords($postData);
		
		$this->load->view('products/v_product_search_bar', $page_data);
	}
}