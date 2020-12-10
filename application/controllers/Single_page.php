<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Single_page extends CI_Controller {

	public function index()	{
		$this->load->helper('email');
		
		$this->loadViewsInit();						
	}

	public function loadViewsInit() {
		$page_data['page_content'] = 'v_single_page';
		$this->load->view('/layouts/main', $page_data);
	}

	public function loadViewsInitError($page_data) {
		$page_data['page_content'] = 'v_single_page';
		$this->load->view('/layouts/main', $page_data);
	}	
	
	public function login() {	
		$passForm = $_POST['pass'];

        if( isset($_POST['btn-log']) ){
			$user = $this->M_user_data->getUsers('email');
		}
		
		if( isset($user) ) {
			if( $passForm != $user[0]->pass) {			
				$page_data['error_log'] = "La contraseña no es correcta.";
				$page_data['modal_open'] = true;
				$this->loadViewsInitError($page_data);
			} else {
				if( $user[0]->tipo == 0) {
					echo "administrador"; 
					$this->load->view('/administrator/dashboard');
				} else {
					$this->session->logged = true;

					foreach( $user[0] as $key => $value ) {
						$this->session->$key = $value;
					}

					$this->loadViewsInit();
				}
			}
		} else {
			if( empty($_POST['email']) ){
				$page_data['error_log'] = "No has introducido un correo.";
				$page_data['modal_open'] = true;
				$this->loadViewsInitError($page_data);
			} else {
				$page_data['error_log'] = "El correo no está asociado a ninguna cuenta.";
				$page_data['modal_open'] = true;
				$this->loadViewsInitError($page_data);
			}
		}
	}

	public function registerUser() {
		if( isset($_POST['btn-reg'])) {
			//COMPROBAR QUE NO EXISTE EL USUARIO EN LA BD
			$user = $this->M_user_data->getUsers('email-reg');
			
			if( !empty($user) ){
				$page_data['error_reg'] = "Lo sentimos ya existe un usuario asociado a ese correo.";
				$page_data['modal_open'] = true;
				$this->loadViewsInitError($page_data);
			} else {
				//Insertar en la base de datos
				$this->M_user_data->insertUser();

				//Redirige despúes del registro;
				$this->redirectAfterRegister('email-reg');
			}
		}
	}

	public function redirectAfterRegister($email) {
		$user = $this->M_user_data->getUsers($email);

		foreach( $user[0] as $key => $value ) {
			$this->session->$key = $value;
		}

		$this->session->logged = true;
		$this->loadViewsInit();
	}
	
	public function logOut() {
		$this->session->logged = false;
		$this->session->sess_destroy();		
		$this->loadViewsInit();
	}
}