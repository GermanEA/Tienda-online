<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dashboard extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('dashboard/M_dashboard_order');
		$this->load->library('pagination');
	}

	public function index()	{
		$this->showAllOrders();		
	}

	public function showAllOrders() {
		/* CONFIGURANDO LA PAGINACIÓN */
        $limit_per_page = 15;
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
		$total_rows = $this->M_dashboard_order->countAllOrders();

        if( $total_rows > 0 ) {
            $config = array(
                'base_url' => base_url('administrator/dashboard/showAllOrders'),
                'total_rows' => $total_rows,
                'per_page' => $limit_per_page,
            );

            $this->pagination->initialize($config);
            $page_data['links'] = $this->pagination->create_links();
        }
        /* FIN PAGINACIÓN */


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
		$page_data['orders'] = $this->M_dashboard_order->getOrderPages($limit_per_page, $page*$limit_per_page);
		if($page_data['orders'] != NULL ) {
			$page_data['order_header'] = $this->getL2Keys($page_data['orders']);
		}

		$this->load->view('/administrator/v_dashboard', $page_data);
	}

	public function searchAjax() {
		if( !empty( $_POST ) ) {
			$postData = $this->input->post();
			$this->session->postDataOrder = $postData;
		} else {
			$postData = $this->session->postDataOrder;
		}
		
		/* CONFIGURANDO LA PAGINACIÓN */
        $limit_per_page = 15;
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
		$total_rows = $this->M_dashboard_order->countAllOrders();

        if( $total_rows > 0 ) {
            $config = array(
                'base_url' => base_url('administrator/dashboard/searchAjax'),
                'total_rows' => $total_rows,
                'per_page' => $limit_per_page,
            );

            $this->pagination->initialize($config);
            // $page_data['links'] = $this->pagination->create_links();
        }
		/* FIN PAGINACIÓN */
		
		$page_data['orders'] = $this->M_dashboard_order->getOrderAjaxWords($postData, $limit_per_page, $page*$limit_per_page);
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
		/* CONFIGURANDO LA PAGINACIÓN */
        $limit_per_page = 15;
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
		$total_rows = $this->M_dashboard_order->countAllPending();

        if( $total_rows > 0 ) {
            $config = array(
                'base_url' => base_url('administrator/dashboard/showPending'),
                'total_rows' => $total_rows,
                'per_page' => $limit_per_page,
            );

            $this->pagination->initialize($config);
            $page_data['links'] = $this->pagination->create_links();
        }
		/* FIN PAGINACIÓN */
		
		$page_data['page_content'] = '/administrator/v_orders_template';
		$page_data['title_page'] = 'Pedidos pendientes';
		$page_data['title_category'] = 'Gestión de pedidos';
		$page_data['confirm'] = 'Entregado';
		$page_data['cancel'] = 'Anular';
		$page_data['details'] = 'Detalles';
		$page_data['custom_js'] = array(
			'/public/assets/js/modal.js'
		);
		$page_data['orders'] = $this->M_dashboard_order->getPendingOrder($limit_per_page, $page*$limit_per_page);
		if($page_data['orders'] != NULL ) {
			$page_data['order_header'] = $this->getL2Keys($page_data['orders']);
		}

		$this->load->view('/administrator/v_dashboard', $page_data);
	}

	public function chooseBtn() {
		$data = $this->input->post();

		if( isset($data['confirm-id']) ) {
			$this->sendPending($data['confirm-id']);
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
		$page_data['total_sin_gastos'] = 0;

		foreach( $page_data['order_details'] as $key) {
			$page_data['total_sin_gastos'] += $key->total;
		}

		$this->load->view('/administrator/v_order_details', $page_data);
	}

	public function modifyOrderConfirm() {
		$data = $this->input->post();

		$this->M_dashboard_order->modifyOrder($data);

		redirect(base_url('administrator/dashboard'));
	}	

	public function showDelivered() {
		/* CONFIGURANDO LA PAGINACIÓN */
        $limit_per_page = 15;
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
		$total_rows = $this->M_dashboard_order->countAllDeliver();

        if( $total_rows > 0 ) {
            $config = array(
                'base_url' => base_url('administrator/dashboard/showDelivered'),
                'total_rows' => $total_rows,
                'per_page' => $limit_per_page,
            );

            $this->pagination->initialize($config);
            $page_data['links'] = $this->pagination->create_links();
        }
		/* FIN PAGINACIÓN */

		$page_data['page_content'] = '/administrator/v_orders_template';
		$page_data['title_page'] = 'Pedidos entregados';
		$page_data['title_category'] = 'Gestión de pedidos';
		$page_data['details'] = 'Detalles';
		$page_data['custom_js'] = array(
			'/public/assets/js/modal.js'
		);
		$page_data['orders'] = $this->M_dashboard_order->getDeliverOrder($limit_per_page, $page*$limit_per_page);
		if($page_data['orders'] != NULL ) {
			$page_data['order_header'] = $this->getL2Keys($page_data['orders']);
		}

		$this->load->view('/administrator/v_dashboard', $page_data);
	}

	public function showCancel() {
		/* CONFIGURANDO LA PAGINACIÓN */
        $limit_per_page = 15;
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
		$total_rows = $this->M_dashboard_order->countAllCancel();

        if( $total_rows > 0 ) {
            $config = array(
                'base_url' => base_url('administrator/dashboard/showCancel'),
                'total_rows' => $total_rows,
                'per_page' => $limit_per_page,
            );

            $this->pagination->initialize($config);
            $page_data['links'] = $this->pagination->create_links();
        }
		/* FIN PAGINACIÓN */

		$page_data['page_content'] = '/administrator/v_orders_template';
		$page_data['title_page'] = 'Pedidos anulados';
		$page_data['title_category'] = 'Gestión de pedidos';
		$page_data['details'] = 'Detalles';
		$page_data['custom_js'] = array(
			'/public/assets/js/modal.js'
		);
		$page_data['orders'] = $this->M_dashboard_order->getCancelOrder($limit_per_page, $page*$limit_per_page);
		if($page_data['orders'] != NULL ) {
			$page_data['order_header'] = $this->getL2Keys($page_data['orders']);
		}

		$this->load->view('/administrator/v_dashboard', $page_data);
	}

	public function showByDate() {
		/* CONFIGURANDO LA PAGINACIÓN */
        $limit_per_page = 15;
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
		$total_rows = $this->M_dashboard_order->countAllOrders();

        if( $total_rows > 0 ) {
            $config = array(
                'base_url' => base_url('administrator/dashboard/showByDate'),
                'total_rows' => $total_rows,
                'per_page' => $limit_per_page,
            );

            $this->pagination->initialize($config);
            $page_data['links'] = $this->pagination->create_links();
        }
		/* FIN PAGINACIÓN */

		$page_data['page_content'] = '/administrator/v_orders_template';
		$page_data['title_page'] = 'Búsqueda por fecha de pedido';
		$page_data['title_category'] = 'Gestión de pedidos';
		$page_data['modify'] = 'Modificar';
		$page_data['cancel'] = 'Anular';
		$page_data['details'] = 'Detalles';
		$page_data['search_date'] = true;
		$page_data['custom_js'] = array(
			'/public/assets/js/modal.js'
		);
		$page_data['orders'] = $this->M_dashboard_order->getOrderPages($limit_per_page, $page*$limit_per_page);
		if($page_data['orders'] != NULL ) {
			$page_data['order_header'] = $this->getL2Keys($page_data['orders']);
		}	

		$this->load->view('/administrator/v_dashboard', $page_data);
	}

	public function searchAjaxDate() {
		if( !empty( $_POST ) ) {
			$postData = $this->input->post();
			$this->session->postDataDate = $postData;
		} else {
			$postData = $this->session->postDataDate;
		}
		
		/* CONFIGURANDO LA PAGINACIÓN */
		$total_rows = $this->M_dashboard_order->countOrdersDate($postData);
        $limit_per_page = 15;
		$page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;

        if( $total_rows > 0 ) {
            $config = array(
                'base_url' => base_url('administrator/dashboard/searchAjaxDate'),
                'total_rows' => $total_rows,
                'per_page' => $limit_per_page,
            );

            $this->pagination->initialize($config);
            $page_data['links'] = $this->pagination->create_links();
        }
        /* FIN PAGINACIÓN */

		$page_data['page_content'] = '/administrator/v_orders_template';
		$page_data['title_page'] = 'Búsqueda por fecha de pedido';
		$page_data['title_category'] = 'Gestión de pedidos';
		$page_data['modify'] = 'Modificar';
		$page_data['cancel'] = 'Anular';
		$page_data['details'] = 'Detalles';		
		$page_data['search_date'] = true;
		$page_data['custom_js'] = array(
			'/public/assets/js/modal.js'
		);
		
		$page_data['orders'] = $this->M_dashboard_order->getOrderAjaxDate($postData, $limit_per_page, $page*$limit_per_page);
		if($page_data['orders'] != NULL ) {
			$page_data['order_header'] = $this->getL2Keys($page_data['orders']);
		}
		
		$this->load->view('/administrator/v_dashboard', $page_data);
		// $this->load->view('/administrator/v_orders_ajax', $page_data);
	}
	
	public function getL2Keys($array) {
		$result = array();
		
		foreach($array as $key) {
			$result = array_merge($result, $key);
		}

		return array_keys($result);
	}
}