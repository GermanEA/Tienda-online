<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class User_data extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		$this->load->model('user/M_user_data');
		$this->load->library('dni');
	}

	public function index()	{
		$this->loadViewsInit();	
	}

	public function loadViewsInit() {
		$page_data['page_content'] = 'user/v_user_data';		
		$page_data['user'] = $this->M_user_data->getUserShowData();
        $this->load->view('/layouts/main', $page_data);
	}

	public function loadViewsInitError($page_data) {
		$page_data['page_content'] = 'user/v_user_change';
		$page_data['user'] = $this->M_user_data->getUserShowData();
        $this->load->view('/layouts/main', $page_data);
	}

	public function changeView() {
		$page_data['page_content'] = 'user/v_user_change';
		$page_data['user'] = $this->M_user_data->getUserShowDataNoEmail();
        $this->load->view('/layouts/main', $page_data);
	}

	public function changeData() {
		$data = $this->input->post();

		if( preg_match('/^[A-z]{2,25}$/', $data['Nombre']) !=1 ) {
			$page_data['error_change'] = "El nombre no es válido. Debe comprender entre 2 y 25 caracteres.";
			$this->loadViewsInitError($page_data);
		} else if( preg_match('/^[A-z]{2,25}$/', $data['Apellido']) !=1 ) {
			$page_data['error_change'] = "El apellido no es válido. Debe comprender entre 2 y 25 caracteres.";
			$this->loadViewsInitError($page_data);
		} else if( $this->dni->typeDni($data['DNI/NIE/CIF']) == 'dni' && !$this->dni->isValidDni($data['DNI/NIE/CIF']) ) {
			$page_data['error_change'] = "El DNI no es válido.";
			$this->loadViewsInitError($page_data);
		} else if( $this->dni->typeDni($data['DNI/NIE/CIF']) == 'nie' && !$this->dni->isValidNie($data['DNI/NIE/CIF']) ) {
			$page_data['error_change'] = "El NIE no es válido.";
			$this->loadViewsInitError($page_data);
		} else if( $this->dni->typeDni($data['DNI/NIE/CIF']) == 'cif' && !$this->dni->isValidCif($data['DNI/NIE/CIF']) ) {
			$page_data['error_change'] = "El CIF no es válido.";
			$this->loadViewsInitError($page_data); 		
		} else if( strlen($data['Dirección']) < 1 || strlen($data['Dirección']) > 50 ) {
			$page_data['error_change'] = "La dirección no es válida.";
			$this->loadViewsInitError($page_data);
		} else if( preg_match('/^[0-9]{5}$/', $data['Código_postal']) !=1 ) {
			$page_data['error_change'] = "El código postal no es válido.";
			$this->loadViewsInitError($page_data);
		} else if( strlen($data['Localidad']) < 1 || strlen($data['Localidad']) > 50 ) {
			$page_data['error_reg'] = "La localidad no es válida.";
			$page_data['modal_open'] = true;
			$this->loadViewsInitError($page_data);
		} else if( preg_match('/^[0-9]{9}$/', $data['Teléfono']) !=1 ) {
			$page_data['error_change'] = "El teléfono no es válido.";
			$this->loadViewsInitError($page_data);
		} else {
			$this->M_user_data->updateUser($data, $this->session->id_usuario);
			
			$this->session->nombre = $data['Nombre'];
			$this->session->apellido = $data['Apellido'];
			$this->session->cif = $data['DNI/NIE/CIF'];
			$this->session->direccion = $data['Dirección'];
			$this->session->codigo_postal = $data['Código_postal'];
			$this->session->localidad = $data['Localidad'];
			$this->session->telefono = $data['Teléfono'];

			$this->index();
		}
	}

}