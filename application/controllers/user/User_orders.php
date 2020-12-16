<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_orders extends CI_Controller {

	public function index()	{
		$this->load->model('user/M_user_orders');
		$this->loadViewsInit();		
	}

	public function loadViewsInit() {
		$page_data['list_orders'] = $this->M_user_orders->getOrders();
		$page_data['page_content'] = 'user/v_user_orders';

		$this->load->view('/layouts/main', $page_data);
	}

	public function orderDetails() {
		$this->load->model('user/M_user_orders');
		$id_venta = $_POST['id_venta'];
		$page_data['order_details'] = $this->M_user_orders->getOrderDetails($id_venta);
		$page_data['page_content'] = 'user/v_user_order_detail';

		$this->load->view('/layouts/main', $page_data);
	}

	

}