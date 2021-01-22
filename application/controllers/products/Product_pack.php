<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product_pack extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('products/M_product');
	}	

	public function index()	{
		$this->loadViewsInit();
		
	}

	public function loadViewsInit() {
		$page_data['page_content'] = 'products/v_product_template';
		$page_data['page_sidebar_left'] = 'layouts/sidebar_left';
		$page_data['custom_js'] = array ('/public/assets/js/ajax-filter.js');
		$page_data['product_list'] = $this->M_product->getProductListFilter();
		$page_data['product'] = $this->M_product->getProduct(1);
		$page_data['stocks'] = $this->M_product->getStockByType(1);

		$stock_array = array();

		if($page_data['stocks'] != NULL) {
			foreach( $page_data['product'] as $row ){
				foreach( $page_data['stocks'] as $row_stock ){
					if( $row->codigo_producto == $row_stock->codigo_producto ){
						$stock_array[$row->codigo_producto] = $row_stock->stock;
					}
				}
			}
		}

		$page_data['stock'] = $stock_array;

        $this->load->view('/layouts/main', $page_data);
	}
}