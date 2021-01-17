<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Category extends CI_Controller {

	public function __construct() {
        parent::__construct();
    
		$this->load->model('dashboard/M_dashboard_category');
	}

	public function index()	{
		$this->showAllCategory();		
    }

    public function showAllCategory() {
        $page_data['page_content'] = '/administrator/v_category_template';
		$page_data['title_page'] = 'Listado de categorías';
		$page_data['title_category'] = 'Gestión de categorías';
		$page_data['modify'] = 'Modificar';
		// $page_data['cancel'] = 'Eliminar';
		$page_data['category'] = $this->M_dashboard_category->getCategoryAll();
		if($page_data['category'] != NULL ) {
			$page_data['category_header'] = $this->getL2Keys($page_data['category']);
        }        

		$this->load->view('/administrator/v_dashboard', $page_data);
    }

    public function chooseBtn() {
        $data = $this->input->post();
        
		if( isset($data['modify-id']) ) {
			$this->modifyCategory($data['modify-id']);
		}

		// if( isset($data['cancel-id']) ) {
		// 	$this->cancelCategory($data['cancel-id']);
		// }
    }

    public function modifyCategory($id) {
        $page_data['page_content'] = '/administrator/v_category_modify';
		$page_data['title_page'] = 'Modificar categoría';
		$page_data['title_category'] = 'Gestión de categorías';
        $page_data['category'] = $this->M_dashboard_category->getCategorySingle($id);

		$this->load->view('/administrator/v_dashboard', $page_data);
    }

    public function modifyCategoryConfirm() {
        $data = $this->input->post();

        $this->M_dashboard_category->modifyCategory($data);

        redirect(base_url('administrator/category/showAllCategory'));
    }

    // public function cancelCategory($id) {
    //     $this->M_dashboard_category->cancelCategory($id);
        
    //     redirect(base_url('administrator/category/showAllCategory'));
    // }

    public function addCategory() {
        $page_data['page_content'] = '/administrator/v_category_add';
		$page_data['title_page'] = 'Añadir categoría';
        $page_data['title_category'] = 'Gestión de categorías';
        $page_data['category'] = $this->M_dashboard_category->getCategoryLastOne();
        
        $this->load->view('/administrator/v_dashboard', $page_data);
    }

    public function addCategoryConfirm() {
        $data = $this->input->post();

        $this->M_dashboard_category->addCategory($data);

        redirect(base_url('administrator/category/showAllCategory'));
    }

    public function getL2Keys($array) {
		$result = array();
		
		foreach($array as $key) {
			$result = array_merge($result, $key);
		}

		return array_keys($result);
	}    
}