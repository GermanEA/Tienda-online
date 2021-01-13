<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('dashboard/M_dashboard_order');
	}

	public function index()	{
		$this->loadViewsInit();		
	}

	public function loadViewsInit() {
		$page_data['page_content'] = '/administrator/v_orders_template';
		$page_data['title_page'] = 'Listado de pedidos';
		$page_data['title_category'] = 'Gestión de pedidos';
		$page_data['search'] = true;
		$page_data['custom_js'] = array('/public/assets/js/ajax-orders.js');
		$page_data['orders'] = $this->M_dashboard_order->getOrderAll();
		$page_data['order_header'] = $this->getL2Keys($page_data['orders']);

		$this->load->view('/administrator/v_dashboard', $page_data);
	}

	public function searchAjax() {
		$postData = $this->input->post();

		$page_data['orders'] = $this->M_dashboard_order->getOrderAjaxWords($postData);

		if($page_data['orders'] != NULL ) {
			$page_data['order_header'] = $this->getL2Keys($page_data['orders']);
		}
		
		$this->load->view('/administrator/v_orders_ajax', $page_data);
	}

	public function showPending() {
		$page_data['page_content'] = '/administrator/v_orders_template';
		$page_data['title_page'] = 'Pedidos pendientes';
		$page_data['title_category'] = 'Gestión de pedidos';
		$page_data['orders'] = $this->M_dashboard_order->getPendingOrder();
		$page_data['order_header'] = $this->getL2Keys($page_data['orders']);

		$this->load->view('/administrator/v_dashboard', $page_data);
	}

	public function showDelivered() {
		$page_data['page_content'] = '/administrator/v_orders_template';
		$page_data['title_page'] = 'Pedidos entregados';
		$page_data['title_category'] = 'Gestión de pedidos';
		$page_data['orders'] = $this->M_dashboard_order->getDeliverOrder();
		$page_data['order_header'] = $this->getL2Keys($page_data['orders']);

		$this->load->view('/administrator/v_dashboard', $page_data);
	}
	
	public function getL2Keys($array) {
		$result = array();
		
		foreach($array as $key) {
			$result = array_merge($result, $key);
		}

		return array_keys($result);
	}
}