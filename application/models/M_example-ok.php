<?php
    class M_example extends CI_Model {

        public function addUser() {
            
            $array = array(
                "nombre"   => "German",
                "apellido" => "Estrade",
                "pass"     => "1234",
                "email"    => "nox_ger@hotmail.com",
                "tipo"     => 0
            );

            $this->db->insert("usuario", $array);
        }
    
        public function getUsers() {

            $this->db->select('*');
            $this->db->from('usuario');
            $this->db->where("id_usuario", 5);

            $query = $this->db->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result();
            } else {
                return NULL;
            }
            
            
        }
    }
    
?>