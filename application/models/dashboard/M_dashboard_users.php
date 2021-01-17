<?php
    class M_dashboard_users extends CI_Model {

        public function countAllUsers() {
            return $this->db->count_all('usuario');
        }

        public function getUsersPages($limit, $start) {

            $select = 'id_usuario AS ID, nombre AS Nombre, apellido AS Apellido, direccion AS Dirección, codigo_postal AS Código postal, telefono AS Teléfono, email AS Email, tipo AS Tipo usuario';

            $query = $this->db->select($select)
                     ->from('usuario')
                     ->order_by('id_usuario', 'ASC')
                     ->limit($limit, $start)
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result_array();                
            } else {
                return NULL;
            }
        }

        public function getUsersAjaxWords($words, $limit) {

            $select = 'id_usuario AS ID, nombre AS Nombre, apellido AS Apellido, direccion AS Dirección, codigo_postal AS Código postal, telefono AS Teléfono, email AS Email, tipo AS Tipo usuario';

            $query = $this->db->select($select)
                     ->from('usuario')
                     ->like('email', $words['words'])
                     ->order_by('id_usuario', 'ASC')
                     ->limit($limit)
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result_array();                
            } else {
                return NULL;
            }
        }

        public function getUserSingle($id) {

            $select = 'id_usuario AS ID, nombre AS Nombre, apellido AS Apellido, direccion AS Dirección, codigo_postal AS Código postal, telefono AS Teléfono, email AS Email, tipo AS Tipo usuario';

            $query = $this->db->select($select)
                     ->from('usuario')
                     ->where('id_usuario', $id)
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->row_array();                
            } else {
                return NULL;
            }
        }
        
        public function modifyUser($data) {
            $data_update = array(
                'nombre' => $data['nombre'],
                'apellido' => $data['apellido'],
                'direccion' => $data['direccion'],
                'codigo_postal' => $data['codigo-postal'],
                'telefono' => $data['telefono']
            );
            
            $this->db->where('id_usuario', $data['id'])
            ->update('usuario', $data_update);
        }
        
        public function cancelUser($id) {
            $this->db->where('id_usuario', $id);
            $this->db->delete('usuario');
        }
            
        public function getUserLastOne() {
            $select = 'id_usuario AS ID, nombre AS Nombre, apellido AS Apellido, pass AS Password, direccion AS Dirección, codigo_postal AS Código postal, telefono AS Teléfono, email AS Email, tipo AS Tipo usuario';

            $query = $this->db->select($select)
                     ->from('usuario')
                     ->order_by('id_usuario', 'ASC')
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->last_row('array');                
            } else {
                return NULL;
            }
        }

        public function addUser($data) {
            $data_insert = array(
                'id_usuario' => $data['id'],
                'nombre' => $data['nombre'],
                'apellido' => $data['apellido'],
                'pass' => $data['pass'],
                'direccion' => $data['direccion'],
                'codigo_postal' => $data['codigo-postal'],
                'telefono' => $data['telefono'],
                'email' => $data['email'],
                'tipo' => $data['tipo']
            );

            $this->db->insert('usuario', $data_insert);
        }
  
    }
?>