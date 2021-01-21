<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_orders extends CI_Controller {

	
	public function __construct() {
		parent::__construct();
		
		$this->load->model('user/M_user_orders');
	}
	

	public function index()	{
		$this->loadViewsInit();	
	}

	public function loadViewsInit() {
		$page_data['list_orders'] = $this->M_user_orders->getOrders();
		$page_data['page_content'] = 'user/v_user_orders';

		$this->load->view('/layouts/main', $page_data);
	}

	public function orderDetails() {
		if(!isset($_POST['id_venta'])){
			redirect('/user/user_orders', 'location', 301);
		} else {			
			$id_venta = $_POST['id_venta'];
			$page_data['order_details'] = $this->M_user_orders->getOrderDetails($id_venta);
			$page_data['page_content'] = 'user/v_user_order_detail';
			$page_data['total_sin_gastos'] = 0;

			foreach( $page_data['order_details'] as $key) {
				$page_data['total_sin_gastos'] += $key->total;
			}
	
			$this->load->view('/layouts/main', $page_data);
		}
	}

	

}