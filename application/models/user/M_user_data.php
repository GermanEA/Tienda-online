<?php
    class M_user_data extends CI_Model {

        public function getUsers($campo) {
            $query = $this->db->select('*')->from('usuario')->where("email", $_POST[$campo])->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result();                
            } else {
                return NULL;
            }
        }

        public function insertUser() {

            $data = array(
                'nombre'       => $_POST['name-reg'],
                'apellido'     => $_POST['lastname-reg'],
                'pass'         => $_POST['pass-reg'],
                'direccion'    => $_POST['address-reg'],
                'codigo_postal'=> $_POST['postal-reg'],
                'telefono'     => $_POST['phone-reg'],
                'email'        => $_POST['email-reg'],
                'tipo'         => 1
            );
            
            $this->db->insert('usuario', $data);
        }

        public function changeName() {
            
        }
    }
    
?>