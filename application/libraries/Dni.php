<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Dni {

    public function typeDni($dni) {        
        $pattern_dni = '/^\d{8}[a-zA-Z]$/';
		$pattern_cif = '/^([ABCDEFGHJKLMNPQRSUVW])(\d{7})([0-9A-J])$/';
        $pattern_nie = '/^[xyzXYZ]\d{7,8}[a-zA-Z]$/';
        
        if( preg_match($pattern_dni, $dni) == 1 ) {
            return 'dni';
        } else if( preg_match($pattern_cif, $dni) == 1 ) {
            return 'cif';
        } else if( preg_match($pattern_nie, $dni) == 1 ) {
            return 'nie';
        } else {
            return false;
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

?>