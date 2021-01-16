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
		$page_data['modify'] = 'Modificar';
		$page_data['cancel'] = 'Anular';
		$page_data['details'] = 'Detalles';
		$page_data['search'] = true;
		$page_data['custom_js'] = array(
			'/public/assets/js/ajax-orders.js',
			'/public/assets/js/modal.js',
		);
		$page_data['orders'] = $this->M_dashboard_order->getOrderAll();
		if($page_data['orders'] != NULL ) {
			$page_data['order_header'] = $this->getL2Keys($page_data['orders']);
		}

		$this->load->view('/administrator/v_dashboard', $page_data);
	}

	public function searchAjax() {
		$postData = $this->input->post();

		$page_data['orders'] = $this->M_dashboard_order->getOrderAjaxWords($postData);
		$page_data['modify'] = 'Modificar';
		$page_data['cancel'] = 'Anular';
		$page_data['details'] = 'Detalles';
		$page_data['custom_js'] = array(
			'/public/assets/js/modal.js'
		);

		if($page_data['orders'] != NULL ) {
			$page_data['order_header'] = $this->getL2Keys($page_data['orders']);
		}
		
		$this->load->view('/administrator/v_orders_ajax', $page_data);
	}

	public function showPending() {
		$page_data['page_content'] = '/administrator/v_orders_template';
		$page_data['title_page'] = 'Pedidos pendientes';
		$page_data['title_category'] = 'Gestión de pedidos';
		$page_data['confirm'] = 'Entregado';
		$page_data['cancel'] = 'Anular';
		$page_data['details'] = 'Detalles';
		$page_data['custom_js'] = array(
			'/public/assets/js/modal.js'
		);
		$page_data['orders'] = $this->M_dashboard_order->getPendingOrder();
		if($page_data['orders'] != NULL ) {
			$page_data['order_header'] = $this->getL2Keys($page_data['orders']);
		}

		$this->load->view('/administrator/v_dashboard', $page_data);
	}

	public function chooseBtn() {
		$data = $this->input->post();

		if( isset($data['send-id']) ) {
			$this->sendPending($data['send-id']);
		}

		if( isset($data['modify-id']) ) {
			$this->modifyOrder($data['modify-id']);
		}

		if( isset($data['cancel-id']) ) {
			$this->cancelOrder($data['cancel-id']);
		}
	}

	public function sendPending($id) {
		$this->M_dashboard_order->changeSendPending($id);

		redirect(base_url('administrator/dashboard/showPending'));
	}

	public function modifyOrder($id) {
		$page_data['page_content'] = '/administrator/v_order_modify';
		$page_data['title_page'] = 'Modificar pedido';
		$page_data['title_category'] = 'Gestión de pedidos';
		$page_data['order'] = $this->M_dashboard_order->getOrderSingle($id);

		$this->load->view('/administrator/v_dashboard', $page_data);
	}

	public function cancelOrder($id) {
		$this->M_dashboard_order->cancelOrder($id);

		redirect(base_url('administrator/dashboard'));
	}

	public function detailsOrder() {
		$data = $this->input->post();
		$id = $data['id'];
		// $page_data['page_content'] = '/administrator/v_order_details';
		$page_data['title_page'] = 'Detalles del pedido';
		$page_data['title_category'] = 'Gestión de pedidos';
		$page_data['order_details'] = $this->M_dashboard_order->getOrderDetails($id);

		$this->load->view('/administrator/v_order_details', $page_data);
	}

	public function modifyOrderConfirm() {
		$data = $this->input->post();

		$this->M_dashboard_order->modifyOrder($data);

		redirect(base_url('administrator/dashboard'));
	}	

	public function showDelivered() {
		$page_data['page_content'] = '/administrator/v_orders_template';
		$page_data['title_page'] = 'Pedidos entregados';
		$page_data['title_category'] = 'Gestión de pedidos';
		$page_data['details'] = 'Detalles';
		$page_data['custom_js'] = array(
			'/public/assets/js/modal.js'
		);
		$page_data['orders'] = $this->M_dashboard_order->getDeliverOrder();
		if($page_data['orders'] != NULL ) {
			$page_data['order_header'] = $this->getL2Keys($page_data['orders']);
		}

		$this->load->view('/administrator/v_dashboard', $page_data);
	}

	public function showCancel() {
		$page_data['page_content'] = '/administrator/v_orders_template';
		$page_data['title_page'] = 'Pedidos anulados';
		$page_data['title_category'] = 'Gestión de pedidos';
		$page_data['details'] = 'Detalles';
		$page_data['custom_js'] = array(
			'/public/assets/js/modal.js'
		);
		$page_data['orders'] = $this->M_dashboard_order->getCancelOrder();
		if($page_data['orders'] != NULL ) {
			$page_data['order_header'] = $this->getL2Keys($page_data['orders']);
		}

		$this->load->view('/administrator/v_dashboard', $page_data);
	}

	public function showByDate() {
		$page_data['page_content'] = '/administrator/v_orders_template';
		$page_data['title_page'] = 'Búsqueda por fecha de pedido';
		$page_data['title_category'] = 'Gestión de pedidos';
		$page_data['modify'] = 'Modificar';
		$page_data['cancel'] = 'Anular';
		$page_data['details'] = 'Detalles';
		$page_data['search_date'] = true;
		$page_data['custom_js'] = array(
			'/public/assets/js/ajax-orders-date.js',
			'/public/assets/js/modal.js'
		);
		$page_data['orders'] = $this->M_dashboard_order->getOrderAll();
		if($page_data['orders'] != NULL ) {
			$page_data['order_header'] = $this->getL2Keys($page_data['orders']);
		}	

		$this->load->view('/administrator/v_dashboard', $page_data);
	}

	public function searchAjaxDate() {
		$postData = $this->input->post();

		$page_data['orders'] = $this->M_dashboard_order->getOrderAjaxDate($postData);
		$page_data['modify'] = 'Modificar';
		$page_data['cancel'] = 'Anular';
		$page_data['details'] = 'Detalles';
		$page_data['custom_js'] = array(
			'/public/assets/js/modal.js'
		);

		if($page_data['orders'] != NULL ) {
			$page_data['order_header'] = $this->getL2Keys($page_data['orders']);
		}
		
		$this->load->view('/administrator/v_orders_ajax', $page_data);
	}
	
	public function getL2Keys($array) {
		$result = array();
		
		foreach($array as $key) {
			$result = array_merge($result, $key);
		}

		return array_keys($result);
	}
}