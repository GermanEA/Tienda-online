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
		$page_data['user'] = $this->M_user_data->getUserShowData();
        $this->load->view('/layouts/main', $page_data);
	}

	public function changeData() {
		$data = $this->input->post();

		$pattern_dni = '/^\d{8}[a-zA-Z]$/';
		$pattern_cif = '/^([ABCDEFGHJKLMNPQRSUVW])(\d{7})([0-9A-J])$/';
		$pattern_nie = '/^[xyzXYZ]\d{7,8}[a-zA-Z]$/';

		if( preg_match('/^[A-z]{2,25}$/', $data['Nombre']) !=1 ) {
			$page_data['error_change'] = "El nombre no es válido. Debe comprender entre 2 y 25 caracteres.";
			$this->loadViewsInitError($page_data);
		} else if( preg_match('/^[A-z]{2,25}$/', $data['Apellido']) !=1 ) {
			$page_data['error_change'] = "El apellido no es válido. Debe comprender entre 2 y 25 caracteres.";
			$this->loadViewsInitError($page_data);
		} else if( preg_match($pattern_dni, $data['DNI/NIE/CIF']) == 1 && !$this->isValidDni($data['DNI/NIE/CIF']) ) {
			$page_data['error_change'] = "El DNI no es válido.";
			$this->loadViewsInitError($page_data);
		} else if( preg_match($pattern_nie, $data['DNI/NIE/CIF']) == 1 && !$this->isValidNie($data['DNI/NIE/CIF']) ) {
			$page_data['error_change'] = "El NIE no es válido.";
			$this->loadViewsInitError($page_data);
		} else if( preg_match($pattern_cif, $data['DNI/NIE/CIF']) == 1 && !$this->isValidCif($data['DNI/NIE/CIF']) ) {
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