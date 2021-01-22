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
                     ->where('email', $email)
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result();                
            } else {
                return NULL;
            }
        }

        public function getUserShowData() {
            $select = 'email AS Email, nombre as Nombre, apellido as Apellido, cif as DNI/NIE/CIF, direccion AS Dirección, codigo_postal AS Código postal, localidad AS Localidad, telefono AS Teléfono';

            $query = $this->db->select($select)
                     ->from('usuario')
                     ->where('id_usuario', $this->session->id_usuario)
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->row_array();                
            } else {
                return NULL;
            }
        }

        public function getUserShowDataNoEmail() {
            $select = 'nombre as Nombre, apellido as Apellido, cif as DNI/NIE/CIF, direccion AS Dirección, codigo_postal AS Código postal, localidad AS Localidad, telefono AS Teléfono';

            $query = $this->db->select($select)
                     ->from('usuario')
                     ->where('id_usuario', $this->session->id_usuario)
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->row_array();                
            } else {
                return NULL;
            }
        }

        public function insertUser() {
            $data = $this->input->post();

            $data_insert = array(
                'nombre'          => $data['name-reg'],
                'apellido'        => $data['lastname-reg'],
                'cif'             => strtoupper($data['cif-reg']),
                'pass'            => $data['pass-reg'],
                'direccion'       => $data['address-reg'],
                'codigo_postal'   => $data['postal-reg'],
                'localidad'       => $data['city-reg'],
                'telefono'        => $data['phone-reg'],
                'email'           => strtolower($data['email-reg']),
                'id_tipo_usuario' => 2
            );
            
            $this->db->insert('usuario', $data_insert);
        }

        public function updateUser($data, $id_usuario) {

            $data_query = [
                'nombre' => $data['Nombre'],
                'apellido' => $data['Apellido'],
                'cif' => strtoupper($data['DNI/NIE/CIF']),
                'direccion' => $data['Dirección'],
                'codigo_postal' => $data['Código_postal'],
                'localidad' => $data['Localidad'],
                'telefono' => $data['Teléfono']
            ];

            $this->db->where('id_usuario', $id_usuario)
                     ->update('usuario', $data_query);
        }

        public function updateUserAnonimus($data, $id_usuario) {

            $data_query = [
                'nombre'          => $data['name-reg'],
                'apellido'        => $data['lastname-reg'],
                'cif'             => strtoupper($data['cif-reg']),
                'pass'            => $data['pass-reg'],
                'direccion'       => $data['address-reg'],
                'codigo_postal'   => $data['postal-reg'],
                'localidad'       => $data['city-reg'],
                'telefono'        => $data['phone-reg'],
                'email'           => strtolower($data['email-reg']),
                'id_tipo_usuario' => 2
            ];

            $this->db->where('id_usuario', $id_usuario)
                     ->update('usuario', $data_query);
        }
    }
    
?>