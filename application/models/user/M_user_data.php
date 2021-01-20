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
            $data = $this->input->post();

            $data_insert = array(
                'nombre'       => $data['name-reg'],
                'apellido'     => $data['lastname-reg'],
                'cif'          => strtoupper($data['cif-reg']),
                'pass'         => $data['pass-reg'],
                'direccion'    => $data['address-reg'],
                'codigo_postal'=> $data['postal-reg'],
                'localidad'    => $data['city-reg'],
                'telefono'     => $data['phone-reg'],
                'email'        => $data['email-reg'],
                'tipo'         => 1
            );
            
            $this->db->insert('usuario', $data_insert);
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