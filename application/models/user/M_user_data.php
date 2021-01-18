<?php
    class M_user_data extends CI_Model {

        public function getUsers($campo) {
            if( isset($_POST[$campo]) ) {
                $email = $_POST[$campo];
            } else {
                $email = $campo;
            }

            $query = $this->db->select('*')
                     ->from('usuario')
                     ->where("email", $email)
                     ->get();

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
                'cif'          => strtoupper($_POST['cif-reg']),
                'pass'         => $_POST['pass-reg'],
                'direccion'    => $_POST['address-reg'],
                'codigo_postal'=> $_POST['postal-reg'],
                'telefono'     => $_POST['phone-reg'],
                'email'        => $_POST['email-reg'],
                'tipo'         => 1
            );
            
            $this->db->insert('usuario', $data);
        }

        public function updateUser($data, $id_usuario) {

            $data_query = [
                'nombre' => $data['name-change'],
                'apellido' => $data['lname-change'],
                'direccion' => $data['address-change'],
                'codigo_postal' => $data['postal-change'],
                'telefono' => $data['phone-change']
            ];

            $this->db->where('id_usuario', $id_usuario)
                     ->update('usuario', $data_query);
        }
    }
    
?>