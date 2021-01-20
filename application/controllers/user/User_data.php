<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_data extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('user/M_user_data');
	}

	public function index()	{
		$this->loadViewsInit();	
	}

	public function loadViewsInit() {
		$page_data['page_content'] = 'user/v_user_data';
        $this->load->view('/layouts/main', $page_data);
	}

	public function loadViewsInitError($page_data) {
		$page_data['page_content'] = 'user/v_user_change';
        $this->load->view('/layouts/main', $page_data);
	}

	public function changeView() {
		$page_data['page_content'] = 'user/v_user_change';
        $this->load->view('/layouts/main', $page_data);
	}

	public function changeData() {
		$data = $this->input->post();

		if( preg_match('/^[A-z]{2,25}$/', $data['name-change']) !=1 ) {
			$page_data['error_change'] = "El nombre no es válido. Debe comprender entre 2 y 25 caracteres.";
			$this->loadViewsInitError($page_data);
		} else if( preg_match('/^[A-z]{2,25}$/', $data['lname-change']) !=1 ) {
			$page_data['error_change'] = "El apellido no es válido. Debe comprender entre 2 y 25 caracteres.";
			$this->loadViewsInitError($page_data);
		} else if( strlen($data['address-change']) < 1 || strlen($data['address-change']) > 50 ) {
			$page_data['error_change'] = "La dirección no es válida.";
			$this->loadViewsInitError($page_data);
		} else if( preg_match('/^[0-9]{5}$/', $data['postal-change']) !=1 ) {
			$page_data['error_change'] = "El código postal no es válido.";
			$this->loadViewsInitError($page_data);
		} else if( preg_match('/^[0-9]{9}$/', $data['phone-change']) !=1 ) {
			$page_data['error_change'] = "El teléfono no es válido.";
			$this->loadViewsInitError($page_data);
		} else {
			$this->M_user_data->updateUser($data, $this->session->id_usuario);
			
			$this->session->nombre = $data['name-change'];
			$this->session->apellido = $data['lname-change'];
			$this->session->direccion = $data['address-change'];
			$this->session->codigo_postal = $data['postal-change'];
			$this->session->telefono = $data['phone-change'];

			$this->index();
		}
	}

}