<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Single_page extends CI_Controller {

	public function index()	{
		$this->load->helper('email');

		if(isset($_COOKIE['email']) && isset($_COOKIE['pass'])) {
			$this->loginCookie();
		}
		
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
		$email = $_POST['email'];	
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
				$this->session->logged = true;

				foreach( $user[0] as $key => $value ) {
					$this->session->$key = $value;
				}

				if(isset($_POST['connect']) && $_POST['connect'] == 'connect') {
					set_cookie('email', $email, 259200);
					set_cookie('pass', $passForm, 259200);
				}

				if( $user[0]->id_tipo_usuario == 1) {				
					redirect(base_url('/administrator/dashboard'), 'location', 301);
				} else {
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
			$data = $this->input->post();

			$pattern_dni = '/^\d{8}[a-zA-Z]$/';
  			$pattern_cif = '/^([ABCDEFGHJKLMNPQRSUVW])(\d{7})([0-9A-J])$/';
			$pattern_nie = '/^[xyzXYZ]\d{7,8}[a-zA-Z]$/';
			$cif = $data['cif-reg'];
			
			if( !empty($user) ){
				$page_data['error_reg'] = "Lo sentimos ya existe un usuario asociado a ese correo.";
				$page_data['modal_open'] = true;
				$this->loadViewsInitError($page_data);

			//COMPROBACIONES ANTES DE INSERTAR EN LA BASE DE DATOS
			} else if( preg_match('/^[A-z]{2,25}$/', $data['name-reg']) !=1 ) {
				$page_data['error_reg'] = "El nombre es demasiado largo.";
				$page_data['modal_open'] = true;
				$this->loadViewsInitError($page_data);
			} else if( preg_match('/^[A-z]{2,25}$/', $data['lastname-reg']) !=1 ) {
				$page_data['error_reg'] = "El apellido es demasiado largo.";
				$page_data['modal_open'] = true;
				$this->loadViewsInitError($page_data);
			} else if( preg_match($pattern_dni, $cif) == 1 && !$this->isValidDni($cif) ) {
				$page_data['error_reg'] = "El DNI no es válido.";
				$page_data['modal_open'] = true;
				$this->loadViewsInitError($page_data);
			} else if( preg_match($pattern_nie, $cif) == 1 && !$this->isValidNie($cif) ) {
				$page_data['error_reg'] = "El NIE no es válido.";
				$page_data['modal_open'] = true;
				$this->loadViewsInitError($page_data);
			} else if( preg_match($pattern_cif, $cif) == 1 && !$this->isValidCif($cif) ) {
				$page_data['error_reg'] = "El CIF no es válido.";
				$page_data['modal_open'] = true;
				$this->loadViewsInitError($page_data);
			} else if( preg_match('/\S+@\S+\.\S+/', $data['email-reg']) !=1 ) {
				$page_data['error_reg'] = "El correo no es válido.";
				$page_data['modal_open'] = true;
				$this->loadViewsInitError($page_data);
			} else if( strlen($data['pass-reg']) < 4 || strlen($data['pass-reg']) > 8) {
				$page_data['error_reg'] = "La contraseña no es válida.";
				$page_data['modal_open'] = true;
				$this->loadViewsInitError($page_data);
			} else if( $data['pass-reg'] != $data['pass-reg-r'] ) {
				$page_data['error_reg'] = "Las contraseñas no coinciden.";
				$page_data['modal_open'] = true;
				$this->loadViewsInitError($page_data);
			} else if( strlen($data['address-reg']) < 1 || strlen($data['address-reg']) > 50 ) {
				$page_data['error_reg'] = "La dirección no es válida.";
				$page_data['modal_open'] = true;
				$this->loadViewsInitError($page_data);
			} else if( preg_match('/^[0-9]{5}$/', $data['postal-reg']) !=1 ) {
				$page_data['error_reg'] = "El código postal no es válido.";
				$page_data['modal_open'] = true;
				$this->loadViewsInitError($page_data);
			}  else if( strlen($data['city-reg']) < 1 || strlen($data['city-reg']) > 50 ) {
				$page_data['error_reg'] = "La localidad no es válida.";
				$page_data['modal_open'] = true;
				$this->loadViewsInitError($page_data);
			} else if( preg_match('/^[0-9]{9}$/', $data['phone-reg']) !=1 ) {
				$page_data['error_reg'] = "El teléfono no es válido.";
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

	public function loginCookie() {
		$email_cookie = get_cookie('email');
    	$pass_cookie = get_cookie('pass');
		$user = $this->M_user_data->getUsers($email_cookie);
		
		if( isset($user) ) {
			
			if( $user[0]->pass == $pass_cookie) {
				$this->session->logged = true;
	
				foreach( $user[0] as $key => $value ) {
					$this->session->$key = $value;
				}
				
				if( $this->session->id_tipo_usuario == 1 ) {			
					redirect(base_url('/administrator/dashboard'), 'location', 301);
				} else {
					$this->loadViewsInit();
				}
			} else {
				delete_cookie('email');
				delete_cookie('pass');
				$this->loadViewsInit();
			}
		} else {
			delete_cookie('email');
			delete_cookie('pass');
			$this->loadViewsInit();
		}
	}	
	
	public function logOut() {
		$this->session->sess_destroy();
		delete_cookie('email');
		delete_cookie('pass');		
		$this->session->logged = false;
		redirect(base_url(), 'location', 301);
	}

	public function isValidDni($dni) {
		$control = 'TRWAGMYFPDXBNJZSQVHLCKET';
		$number = substr($dni, 0, 8);
		$letter = substr($dni, -1);
		$remainder = $number % 23;
        $letterControl = substr($control, $remainder, 1);
        
        if(strtoupper($letter) != $letterControl) {
            return false;
        } else {
            return true;
        }
	}

	public function isValidNie($nie) {
		$control = 'TRWAGMYFPDXBNJZSQVHLCKET';
		$number = substr($nie, 1, 7);
        $letter = substr($nie, -1);
        $letterFirst = substr($nie, 0, 1);
        $controlCheck = array(
            'X' => 0,
            'Y' => 1,
            'Z' => 2
        );

        foreach( $controlCheck as $key => $value ) {
            if( strtoupper($letterFirst) == $key ) {
                $number = $value . $number; 
            }
        }

		$remainder = $number % 23;
        $letterControl = substr($control, $remainder, 1);
        
        if( strtoupper($letter) != $letterControl ) {
            return false;
        } else {
            return true;
        }
	}

	public function isValidCif($cif) {
		$number = substr($cif, 1, 7);
        $letter = substr($cif, -1);
        $letter_first = substr($cif, 0, 1);
        $control_check = array(
			0 => 'J',
			1 => 'A',
			2 => 'B',
			3 => 'C',
			4 => 'D',
			5 => 'E',
			6 => 'F',
			7 => 'G',
			8 => 'H',
			9 => 'I'
		);

        $array = str_split($number);
        $sum_par = 0;
        $sum_impar = 0;

        foreach( $array as $key => $value ) {
            if( ($key % 2) == 0 ) {
                $array_impar = str_split($value * 2);

                foreach( $array_impar as $num ) {
                    $sum_impar += $num;
                }
            } else {
                $sum_par += $value;
            }
        }

        $sum_total = $sum_par + $sum_impar;
        $digito_unidades = substr($sum_total, -1);
        $dato_final = 0;
        $dato_final_letra = '';

        if( $digito_unidades != 0 ) {
            $dato_final = 10 - $digito_unidades;
        }

        foreach( $control_check as $key => $value ) {
            if( $dato_final == $key ) {
                $dato_final_letra = $value;
            }
        }

        $result = false;
        if( preg_match('/[ABEH]/', $letter_first) == 1 ) {
            if( $dato_final == $letter ) {
                $result = true;
            }
        } else if( preg_match('/[NPQRSW]/', $letter_first) == 1 ) {
            if( $dato_final_letra == $letter ) {
                $result = true;
            }
        } else {
            if( $dato_final_letra == $letter || $dato_final == $letter ) {
                $result = true;
            }
        }

        return $result;    
	}
}