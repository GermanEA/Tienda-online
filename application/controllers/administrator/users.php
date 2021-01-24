<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {

	public function __construct() {
        parent::__construct();
    
        $this->load->model('dashboard/M_dashboard_users');
        $this->load->library('pagination');
        $this->load->helper('form');
	}

	public function index()	{
		$this->showAllUsers();		
    }

    public function showAllUsers() {
        /* CONFIGURANDO LA PAGINACIÓN */
        $limit_per_page = 15;
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
        $total_rows = $this->M_dashboard_users->countAllUsers();

        if( $total_rows > 0 ) {
            $config = array(
                'base_url' => base_url('administrator/users/showAllUsers'),
                'total_rows' => $total_rows,
                'per_page' => $limit_per_page,
            );

            $this->pagination->initialize($config);
            $page_data['links'] = $this->pagination->create_links();
        }
        /* FIN PAGINACIÓN */

        $page_data['page_content'] = '/administrator/v_users_template';
		$page_data['title_page'] = 'Listado de usuarios';
		$page_data['title_category'] = 'Gestión de usuarios';
		$page_data['modify'] = 'Modificar';
		// $page_data['cancel'] = 'Eliminar';
        $page_data['search'] = true;
        $page_data['custom_js'] = array(
			'/public/assets/js/ajax-users.js'
		);
		$page_data['users'] = $this->M_dashboard_users->getUsersPages($limit_per_page, $page*$limit_per_page);
		if($page_data['users'] != NULL ) {
			$page_data['users_header'] = $this->getL2Keys($page_data['users']);
        }        

		$this->load->view('/administrator/v_dashboard', $page_data);
    }

    public function searchAjax() {
        if( !empty( $_POST ) ) {
			$postData = $this->input->post();
			$this->session->postDataUser = $postData;
		} else {
			$postData = $this->session->postDataUser;
        }
        
        /* CONFIGURANDO LA PAGINACIÓN */
        $limit_per_page = 15;
        $page = ($this->uri->segment(4)) ? ($this->uri->segment(4) - 1) : 0;
		$total_rows = $this->M_dashboard_users->countAllUsers();

        if( $total_rows > 0 ) {
            $config = array(
                'base_url' => base_url('administrator/users/searchAjax'),
                'total_rows' => $total_rows,
                'per_page' => $limit_per_page,
            );

            $this->pagination->initialize($config);
            // $page_data['links'] = $this->pagination->create_links();
        }
		/* FIN PAGINACIÓN */

		$page_data['users'] = $this->M_dashboard_users->getUsersAjaxWords($postData, $limit_per_page, $page*$limit_per_page);
		$page_data['modify'] = 'Modificar';
		$page_data['cancel'] = 'Eliminar';
		$page_data['custom_js'] = array(
			'/public/assets/js/modal.js'
		);

		if($page_data['users'] != NULL ) {
			$page_data['users_header'] = $this->getL2Keys($page_data['users']);
		}
		
		$this->load->view('/administrator/v_users_ajax', $page_data);
    }

    public function chooseBtn() {
        $data = $this->input->post();
        
		if( isset($data['modify-id']) ) {
			$this->modifyUser($data['modify-id']);
		}

		if( isset($data['cancel-id']) ) {
			$this->cancelUser($data['cancel-id']);
		}
    }

    public function modifyUser($id) {
        $page_data['page_content'] = '/administrator/v_users_modify';
		$page_data['title_page'] = 'Modificar usuario';
		$page_data['title_category'] = 'Gestión de usuarios';
        $page_data['users'] = $this->M_dashboard_users->getUserSingle($id);

		$this->load->view('/administrator/v_dashboard', $page_data);
    }

    public function modifyUserConfirm() {
        $data = $this->input->post();

        $this->M_dashboard_users->modifyUser($data);

        redirect(base_url('administrator/users/showAllUsers'));
    }

    public function cancelUser($id) {
        $this->M_dashboard_users->cancelUser($id);
        
        redirect(base_url('administrator/users/showAllUsers'));
    }

    public function addUser() {
        $page_data['page_content'] = '/administrator/v_users_add';
		$page_data['title_page'] = 'Añadir usuario';
        $page_data['title_category'] = 'Gestión de usuarios';
        $page_data['users'] = $this->M_dashboard_users->getUserLastOne();
        $page_data['type_users'] = $this->M_dashboard_users->showTypeUsers();
        
        $this->load->view('/administrator/v_dashboard', $page_data);
    }    

    public function addUserError($page_data) {
		$page_data['page_content'] = '/administrator/v_users_add';
		$page_data['title_page'] = 'Añadir usuario';
        $page_data['title_category'] = 'Gestión de usuarios';
        $page_data['users'] = $this->M_dashboard_users->getUserLastOne();
        $page_data['type_users'] = $this->M_dashboard_users->showTypeUsers();
        
        $this->load->view('/administrator/v_dashboard', $page_data);
	}

    public function addUserConfirm() {
        $data = $this->input->post();
        $user_in_db = $this->M_dashboard_users->getUserEmail(strtolower($data['email']));

        if( $user_in_db == NULL ) {
            $this->M_dashboard_users->addUser($data);
    
            redirect(base_url('administrator/users/showAllUsers'));
        } else {
            $page_data['error_message'] = "El correo ya está asociado a un usuario.";
            $this->addUserError($page_data);
        }

    }

    public function getL2Keys($array) {
		$result = array();
		
		foreach($array as $key) {
			$result = array_merge($result, $key);
		}

		return array_keys($result);
	}    
}