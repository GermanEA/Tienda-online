<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Product extends CI_Controller {

	public function __construct() {
		parent::__construct();
        
		$this->load->model('dashboard/M_dashboard_product');
        $this->load->library('pagination');
	}

	public function index()	{
		$this->showAllProduct();		
    }

    public function showAllProduct() {
        /* CONFIGURANDO LA PAGINACIÓN */
        $limit_per_page = 15;
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
        $total_rows = $this->M_dashboard_product->countAllProducts();

        if( $total_rows > 0 ) {
            $config = array(
                'base_url' => base_url('administrator/product/showAllProduct'),
                'total_rows' => $total_rows,
                'per_page' => $limit_per_page,
            );

            $this->pagination->initialize($config);
            $page_data['links'] = $this->pagination->create_links();
        }
        /* FIN PAGINACIÓN */
        
        $page_data['page_content'] = '/administrator/v_products_template';
		$page_data['title_page'] = 'Listado de productos';
		$page_data['title_category'] = 'Gestión de productos';
		$page_data['modify'] = 'Modificar';
		$page_data['cancel'] = 'Eliminar';
        $page_data['search'] = true;
        $page_data['custom_js'] = array(
			'/public/assets/js/ajax-products.js'
		);
		$page_data['products'] = $this->M_dashboard_product->getProductPages($limit_per_page, $page*$limit_per_page);
		if($page_data['products'] != NULL ) {
			$page_data['product_header'] = $this->getL2Keys($page_data['products']);
        }        

		$this->load->view('/administrator/v_dashboard', $page_data);
    }

    public function searchAjax() {
        $postData = $this->input->post();

        $limit_result = 15;

		$page_data['products'] = $this->M_dashboard_product->getOrderAjaxWords($postData, $limit_result);
		$page_data['modify'] = 'Modificar';
		$page_data['cancel'] = 'Eliminar';
		$page_data['custom_js'] = array(
			'/public/assets/js/modal.js'
		);

		if($page_data['products'] != NULL ) {
			$page_data['product_header'] = $this->getL2Keys($page_data['products']);
		}
		
		$this->load->view('/administrator/v_products_ajax', $page_data);
    }

    public function chooseBtn() {
        $data = $this->input->post();
        
		if( isset($data['modify-id']) ) {
			$this->modifyProduct($data['modify-id']);
		}

		if( isset($data['cancel-id']) ) {
			$this->cancelProduct($data['cancel-id']);
		}
    }
    
    public function modifyProduct($id) {
        $page_data['page_content'] = '/administrator/v_product_modify';
		$page_data['title_page'] = 'Modificar producto';
		$page_data['title_category'] = 'Gestión de productos';
        $page_data['product'] = $this->M_dashboard_product->getProductSingle($id);
        $page_data['sizes'] = $this->M_dashboard_product->getSizes();
        $page_data['product_type'] = $this->M_dashboard_product->getProductType();

		$this->load->view('/administrator/v_dashboard', $page_data);
    }

    public function modifyProductConfirm() {
        $data = $this->input->post();

		$this->M_dashboard_product->modifyProduct($data);

		redirect(base_url('administrator/product/showAllProduct'));
	}

    public function cancelProduct($id) {
        /* 
            ESTA FUNCIÓN NO ELIMINA EL PRODUCTO DE LA BBDD SINO PONE EL STOCK A CERO
            PARA PODER VOLVER A UTILIZARLO SIN TENER QUE DARLO DE ALTA
        */ 
        $this->M_dashboard_product->cancelProduct($id);

        redirect(base_url('administrator/product/showAllProduct'));
    }

    public function getL2Keys($array) {
		$result = array();
		
		foreach($array as $key) {
			$result = array_merge($result, $key);
		}

		return array_keys($result);
	}
}