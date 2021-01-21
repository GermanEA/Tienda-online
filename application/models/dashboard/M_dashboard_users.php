<?php
    class M_dashboard_users extends CI_Model {

        public function countAllUsers() {
            return $this->db->count_all('usuario');
        }

        public function getUsersPages($limit, $start) {

            $select = 'u.id_usuario AS ID, u.nombre AS Nombre, u.apellido AS Apellido, u.cif AS DNI/NIE/CIF, u.pass AS Password, u.direccion AS Dirección, u.codigo_postal AS Código postal, u.localidad AS Localidad, u.telefono AS Teléfono, u.email AS Email, t.nombre AS Tipo usuario';

            $query = $this->db->select($select)
                     ->from('usuario AS u')
                     ->join('tipo_usuario AS t', 'u.id_tipo_usuario = t.id_tipo_usuario')
                     ->order_by('u.id_usuario', 'ASC')
                     ->limit($limit, $start)
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result_array();                
            } else {
                return NULL;
            }
        }

        public function getUsersAjaxWords($words, $limit) {

            $select = 'u.id_usuario AS ID, u.nombre AS Nombre, u.apellido AS Apellido, u.cif AS DNI/NIE/CIF, u.pass AS Password, u.direccion AS Dirección, u.codigo_postal AS Código postal, u.localidad AS Localidad, u.telefono AS Teléfono, u.email AS Email, t.nombre AS Tipo usuario';

            $query = $this->db->select($select)
                     ->from('usuario AS u')
                     ->join('tipo_usuario AS t', 'u.id_tipo_usuario = t.id_tipo_usuario')
                     ->like('u.email', $words['words'])
                     ->order_by('u.id_usuario', 'ASC')
                     ->limit($limit)
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result_array();                
            } else {
                return NULL;
            }
        }

        public function getUserSingle($id) {

            $select = 'u.id_usuario AS ID, u.nombre AS Nombre, u.apellido AS Apellido, u.cif AS DNI/NIE/CIF, u.pass AS Password, u.direccion AS Dirección, u.codigo_postal AS Código postal, u.localidad AS Localidad, u.telefono AS Teléfono, u.email AS Email, t.nombre AS Tipo usuario';

            $query = $this->db->select($select)
                     ->from('usuario AS u')
                     ->join('tipo_usuario AS t', 'u.id_tipo_usuario = t.id_tipo_usuario')
                     ->where('u.id_usuario', $id)
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->row_array();                
            } else {
                return NULL;
            }
        }

        public function getUserEmail($email) {

            $select = 'u.id_usuario AS ID, u.nombre AS Nombre, u.apellido AS Apellido, u.cif AS DNI/NIE/CIF, u.pass AS Password, u.direccion AS Dirección, u.codigo_postal AS Código postal, u.localidad AS Localidad, u.telefono AS Teléfono, u.email AS Email, t.nombre AS Tipo usuario';

            $query = $this->db->select($select)
                     ->from('usuario AS u')
                     ->join('tipo_usuario AS t', 'u.id_tipo_usuario = t.id_tipo_usuario')
                     ->where('u.email', $email)
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
                'cif' => strtoupper($data['cif']),
                'direccion' => $data['direccion'],
                'codigo_postal' => $data['codigo-postal'],
                'localidad' => $data['localidad'],
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
            $select = 'u.id_usuario AS ID, u.nombre AS Nombre, u.apellido AS Apellido, u.cif AS DNI/NIE/CIF, u.pass AS Password, u.direccion AS Dirección, u.codigo_postal AS Código postal, u.localidad AS Localidad, u.telefono AS Teléfono, u.email AS Email, t.nombre AS Tipo usuario';

            $query = $this->db->select($select)
                     ->from('usuario AS u')
                     ->join('tipo_usuario AS t', 'u.id_tipo_usuario = t.id_tipo_usuario')
                     ->order_by('u.id_usuario', 'ASC')
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
                'cif' => strtoupper($data['cif']),
                'pass' => $data['pass'],
                'direccion' => $data['direccion'],
                'codigo_postal' => $data['codigo-postal'],
                'localidad' => $data['localidad'],
                'telefono' => $data['telefono'],
                'email' => strtolower($data['email']),
                'id_tipo_usuario' => $data['tipo']
            );

            $this->db->insert('usuario', $data_insert);
        }

        public function showTypeUsers() {
            $query = $this->db->select('*')
                     ->from('tipo_usuario')
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result_array();                
            } else {
                return NULL;
            }
        }
  
    }
?>