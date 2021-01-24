<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Invoice extends CI_Controller {

    public function __construct() {
        parent::__construct();
    
		$this->load->model('dashboard/M_dashboard_invoice');
        $this->load->library('pagination');
	}

	public function index()	{
		$this->showAllInvoice();		
    }

    public function showAllInvoice() {
        /* CONFIGURANDO LA PAGINACIÓN */
        $limit_per_page = 15;
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
        $total_rows = $this->M_dashboard_invoice->countAllInvoice();

        if( $total_rows > 0 ) {
            $config = array(
                'base_url' => base_url('administrator/invoice/showAllInvoice'),
                'total_rows' => $total_rows,
                'per_page' => $limit_per_page,
            );

            $this->pagination->initialize($config);
            $page_data['links'] = $this->pagination->create_links();
        }
        /* FIN PAGINACIÓN */
        
        $page_data['page_content'] = '/administrator/v_invoice_template';
		$page_data['title_page'] = 'Listado de facturas';
		$page_data['title_category'] = 'Gestión de facturas y envíos';
		$page_data['confirm'] = 'Ver factura';
        // $page_data['search'] = false;
        // $page_data['custom_js'] = array(
		// 	'/public/assets/js/ajax-invoice.js'
		// );
		$page_data['invoice'] = $this->M_dashboard_invoice->getInvoicePages($limit_per_page, $page*$limit_per_page);
		if($page_data['invoice'] != NULL ) {
			$page_data['invoice_header'] = $this->getL2Keys($page_data['invoice']);
        }        

		$this->load->view('/administrator/v_dashboard', $page_data);
    }

    public function showAllShipping() {
        /* CONFIGURANDO LA PAGINACIÓN */
        $limit_per_page = 15;
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
        $total_rows = $this->M_dashboard_invoice->countAllShipping();

        if( $total_rows > 0 ) {
            $config = array(
                'base_url' => base_url('administrator/invoice/showAllShipping'),
                'total_rows' => $total_rows,
                'per_page' => $limit_per_page,
            );

            $this->pagination->initialize($config);
            $page_data['links'] = $this->pagination->create_links();
        }
        /* FIN PAGINACIÓN */
        
        $page_data['page_content'] = '/administrator/v_invoice_template';
		$page_data['title_page'] = 'Listado de envíos';
		$page_data['title_category'] = 'Gestión de facturas y envíos';
		$page_data['modify'] = 'Ver envío';
        // $page_data['search'] = false;
        // $page_data['custom_js'] = array(
		// 	'/public/assets/js/ajax-shipping.js'
		// );
		$page_data['invoice'] = $this->M_dashboard_invoice->getShippingPages($limit_per_page, $page*$limit_per_page);
		if($page_data['invoice'] != NULL ) {
			$page_data['invoice_header'] = $this->getL2Keys($page_data['invoice']);
        }        

		$this->load->view('/administrator/v_dashboard', $page_data);
    }

    public function chooseBtn() {
        $data = $this->input->post();
        
        if( isset($data['confirm-id']) ) {
            $this->showSingleInvoice($data['confirm-id']);
        }

		if( isset($data['modify-id']) ) {
			$this->showSingleShipping($data['modify-id']);
        }        
    }

    public function showSingleInvoice($id) {
        $page_data['page_content'] = '/administrator/v_invoice_single';
        $page_data['title_page'] = 'Listado de facturas';
        $page_data['title_category'] = 'Gestión de facturas y envíos';
        $page_data['invoice'] = $this->M_dashboard_invoice->getSingleInvoice($id);
        
        $this->load->view('/administrator/v_dashboard', $page_data);
    }

    public function showSingleShipping($id) {
        $page_data['page_content'] = '/administrator/v_invoice_shipping';
        $page_data['title_page'] = 'Listado de envío';        
        $page_data['title_category'] = 'Gestión de facturas y envíos';
        $page_data['invoice'] = $this->M_dashboard_invoice->getSingleShipping($id);
        
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
?>