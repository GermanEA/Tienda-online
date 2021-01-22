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
		$page_data['pack'] = $this->M_product->getStockByType(1);
		$page_data['discs'] = $this->M_product->getStockByType(2);
		$page_data['caps'] = $this->M_product->getStockByType(5);
		$page_data['others'] = $this->M_product->getStockByType(6);

		$stock_array = array();

		if( $page_data['size_shirt'] != NULL ) {
			foreach( $page_data['search'] as $row ){
				foreach( $page_data['size_shirt'] as $row_size ){
					if( $row->codigo_producto == $row_size->codigo_producto ){
						$stock_array[$row->codigo_producto] = $row_size->codigo_talla;
					}
				}
			}
		}

		if( $page_data['size_sweetshirt'] != NULL ) {
			foreach( $page_data['search'] as $row ){
				foreach( $page_data['size_sweetshirt'] as $row_size ){
					if( $row->codigo_producto == $row_size->codigo_producto ){
						$stock_array[$row->codigo_producto] = $row_size->codigo_talla;
					}
				}
			}
		}

		if($page_data['pack'] != NULL) {
			foreach( $page_data['search'] as $row ){
				foreach( $page_data['pack'] as $row_stock ){
					if( $row->codigo_producto == $row_stock->codigo_producto ){
						$stock_array[$row->codigo_producto] = $row_stock->stock;
					}
				}
			}
		}

		if($page_data['discs'] != NULL) {
			foreach( $page_data['search'] as $row ){
				foreach( $page_data['discs'] as $row_stock ){
					if( $row->codigo_producto == $row_stock->codigo_producto ){
						$stock_array[$row->codigo_producto] = $row_stock->stock;
					}
				}
			}
		}

		if($page_data['caps'] != NULL) {
			foreach( $page_data['search'] as $row ){
				foreach( $page_data['caps'] as $row_stock ){
					if( $row->codigo_producto == $row_stock->codigo_producto ){
						$stock_array[$row->codigo_producto] = $row_stock->stock;
					}
				}
			}
		}

		if($page_data['others'] != NULL) {
			foreach( $page_data['search'] as $row ){
				foreach( $page_data['others'] as $row_stock ){
					if( $row->codigo_producto == $row_stock->codigo_producto ){
						$stock_array[$row->codigo_producto] = $row_stock->stock;
					}
				}
			}
		}

		$page_data['stock'] = $stock_array;
        
        $this->load->view('/products/v_product_search', $page_data);
	}

	public function searchAjax() {
		$postData = $this->input->post();

		$page_data['search'] = $this->M_product->getProductAjaxWords($postData);
		
		$this->load->view('products/v_product_search_bar', $page_data);
	}
}