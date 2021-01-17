<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Sizes extends CI_Controller {

	public function __construct() {
        parent::__construct();
    
		$this->load->model('dashboard/M_dashboard_sizes');
	}

	public function index()	{
		$this->showAllSizes();		
    }

    public function showAllSizes() {
        $page_data['page_content'] = '/administrator/v_sizes_template';
		$page_data['title_page'] = 'Listado de tallas';
		$page_data['title_category'] = 'Gestión de tallas';
		$page_data['modify'] = 'Modificar';
		// $page_data['cancel'] = 'Eliminar';
		$page_data['sizes'] = $this->M_dashboard_sizes->getSizesAll();
		if($page_data['sizes'] != NULL ) {
			$page_data['sizes_header'] = $this->getL2Keys($page_data['sizes']);
        }        

		$this->load->view('/administrator/v_dashboard', $page_data);
    }

    public function chooseBtn() {
        $data = $this->input->post();
        
		if( isset($data['modify-id']) ) {
			$this->modifySizes($data['modify-id']);
		}

		// if( isset($data['cancel-id']) ) {
		// 	$this->cancelSize($data['cancel-id']);
		// }
    }

    public function modifySizes($id) {
        $page_data['page_content'] = '/administrator/v_sizes_modify';
		$page_data['title_page'] = 'Modificar talla';
		$page_data['title_category'] = 'Gestión de tallas';
        $page_data['sizes'] = $this->M_dashboard_sizes->getSizesSingle($id);

		$this->load->view('/administrator/v_dashboard', $page_data);
    }

    public function modifySizesConfirm() {
        $data = $this->input->post();

        $this->M_dashboard_sizes->modifySize($data);

        redirect(base_url('administrator/sizes/showAllSizes'));
    }

    // public function cancelSize($id) {
    //     $this->M_dashboard_sizes->cancelSize($id);
        
    //     redirect(base_url('administrator/sizes/showAllSizes'));
    // }

    public function addSize() {
        $page_data['page_content'] = '/administrator/v_sizes_add';
		$page_data['title_page'] = 'Añadir talla';
        $page_data['title_category'] = 'Gestión de tallas';
        $page_data['sizes'] = $this->M_dashboard_sizes->getSizesLastOne();
        
        $this->load->view('/administrator/v_dashboard', $page_data);
    }

    public function addSizeConfirm() {
        $data = $this->input->post();

        $this->M_dashboard_sizes->addSize($data);

        redirect(base_url('administrator/sizes/showAllSizes'));
    }

    public function getL2Keys($array) {
		$result = array();
		
		foreach($array as $key) {
			$result = array_merge($result, $key);
		}

		return array_keys($result);
	}    
}