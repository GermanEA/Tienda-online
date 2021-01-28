<?php
    class M_dashboard_product extends CI_Model {

        public function countAllProducts() {
            return $this->db->count_all('producto');
        }

        public function getProductAll() {

            $select = 'p.id_producto AS ID, p.codigo_producto AS Código producto, p.descripcion AS Descripción, p.material as Material, t.codigo_talla AS Talla, p.precio AS Precio, p.color AS Color, p.stock AS Stock, p.imagen AS Imagen, tp.tipo_producto AS Tipo producto';

            $query = $this->db->select($select)
                     ->from('producto AS p')
                     ->join('tipo_producto AS tp', 'p.id_tipo_producto = tp.id_tipo_producto', 'left')
                     ->join('talla AS t', 'p.id_talla = t.id_talla', 'left')
                     ->order_by('p.id_producto', 'DESC')
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result_array();                
            } else {
                return NULL;
            }
        }

        public function getProductLastOne() {

            $select = 'p.id_producto AS ID, p.codigo_producto AS Código producto, p.descripcion AS Descripción, p.material as Material, t.codigo_talla AS Talla, p.precio AS Precio, p.color AS Color, p.stock AS Stock, p.imagen AS Imagen, tp.tipo_producto AS Tipo producto';

            $query = $this->db->select($select)
                     ->from('producto AS p')
                     ->join('tipo_producto AS tp', 'p.id_tipo_producto = tp.id_tipo_producto', 'left')
                     ->join('talla AS t', 'p.id_talla = t.id_talla', 'left')
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->last_row('array');                
            } else {
                return NULL;
            }
        }

        public function getProductPages($limit, $start) {

            $select = 'p.id_producto AS ID, p.codigo_producto AS Código producto, p.descripcion AS Descripción, p.material as Material, t.codigo_talla AS Talla, p.precio AS Precio, p.color AS Color, p.stock AS Stock, p.imagen AS Imagen, tp.tipo_producto AS Tipo producto';

            $query = $this->db->select($select)
                     ->from('producto AS p')
                     ->join('tipo_producto AS tp', 'p.id_tipo_producto = tp.id_tipo_producto', 'left')
                     ->join('talla AS t', 'p.id_talla = t.id_talla', 'left')
                     ->order_by('p.id_producto', 'ASC')
                     ->limit($limit, $start)
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result_array();                
            } else {
                return NULL;
            }
        }

        public function getProductAjaxWords($words, $limit, $start) {

            $select = 'p.id_producto AS ID, p.codigo_producto AS Código producto, p.descripcion AS Descripción, p.material as Material, t.codigo_talla AS Talla, p.precio AS Precio, p.color AS Color, p.stock AS Stock, p.imagen AS Imagen, tp.tipo_producto AS Tipo producto';

            $query = $this->db->select($select)
                     ->from('producto AS p')
                     ->join('tipo_producto AS tp', 'p.id_tipo_producto = tp.id_tipo_producto', 'left')
                     ->join('talla AS t', 'p.id_talla = t.id_talla', 'left')
                     ->like('p.descripcion', $words['words'])
                     ->order_by('p.id_producto', 'ASC')
                     ->limit($limit, $start)
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result_array();                
            } else {
                return NULL;
            }
        }

        public function getProductSingle($id) {

            $select = 'p.id_producto AS ID, p.codigo_producto AS Código producto, p.descripcion AS Descripción, p.material as Material, t.codigo_talla AS Talla, p.precio AS Precio, p.color AS Color, p.stock AS Stock, p.imagen AS Imagen, tp.tipo_producto AS Tipo producto';

            $query = $this->db->select($select)
                     ->from('producto AS p')
                     ->join('tipo_producto AS tp', 'p.id_tipo_producto = tp.id_tipo_producto', 'left')
                     ->join('talla AS t', 'p.id_talla = t.id_talla', 'left')
                     ->where('p.id_producto', $id)
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->row_array();                
            } else {
                return NULL;
            }
        }

        public function modifyProduct($data) {
            $talla = NULL;
            $material = NULL;
            $color = NULL;
            $sizes = $this->getSizesAll();
            $product_type = $this->getProductTypeAll();

            if( isset($data['talla']) ) {
                $talla = $this->getSizesId($sizes, $data);
            }
            
            if( isset($data['material']) ) {
                $material = $data['material'];
            }
            
            if( isset($data['color']) ) {
                $color = $data['color'];
            }

            $product_type = $this->getProductTypeId($product_type, $data);

            $data_update = array(
                'descripcion' => $data['descripcion'],
                'material' => $material,
                'id_talla' => $talla,
                'precio' => $data['precio'],
                'color' => $color,
                'stock' => $data['stock'],
                'id_tipo_producto' => $product_type,
            );

            if( isset($data['imagen']) ) {
                if( $data['imagen'] != '' ) {
                    $data_update['imagen'] = 'public/assets/img/productos/' . $data['imagen'];
                }
            }

            
            $this->db->where('id_producto', $data['id'])
                     ->update('producto', $data_update);
        }

        public function addProduct($data) {
            $talla = NULL;
            $sizes = $this->getSizesAll();
            $product_type = $this->getProductTypeAll();
            $talla = $this->getSizesId($sizes, $data);
            $product_type = $this->getProductTypeId($product_type, $data);

            $data_insert = array(
                'id_producto' => $data['id'],
                'codigo_producto' => $data['codigo-producto'],
                'descripcion' => $data['descripcion'],
                'material' => $data['material'],
                'id_talla' => $talla,
                'precio' => $data['precio'],
                'color' => $data['color'],
                'stock' => $data['stock'],
                'id_tipo_producto' => $product_type,
            );

            if( isset($data['imagen']) ) {
                if( $data['imagen'] != '' ) {
                    $data_insert['imagen'] = 'public/assets/img/productos/' . $data['imagen'];
                }
            }

            $this->db->insert('producto', $data_insert);
   
        }

        public function getSizesId($array, $data) {
            var_dump($data['talla']);

            if( $data['talla'] == 'NULL' || $data['talla'] == NULL ) {                
                $array = NULL;

            } else {
                foreach($array as $size) {
                    if( $size['codigo_talla'] == $data['talla']) {
                        $array = $size['id_talla'];
                    }
                }                
            }

            return $array;
        }

        public function getProductTypeId($array, $data) {
            foreach($array as $product) {
                if( $product['tipo_producto'] == $data['tipo-producto']) {
                    $array = $product['id_tipo_producto'];
                }
            }

            return $array;
        }

        public function getSizes() {
            $query = $this->db->select('codigo_talla')
                     ->from('talla')
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result_array();                
            } else {
                return NULL;
            }
        }

        public function getSizesAll() {
            $query = $this->db->select('*')
                     ->from('talla')
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result_array();                
            } else {
                return NULL;
            }
        }

        public function getProductType() {
            $query = $this->db->select('tipo_producto')
                     ->from('tipo_producto')
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result_array();                
            } else {
                return NULL;
            }
        }

        public function getProductTypeAll() {
            $query = $this->db->select('*')
                     ->from('tipo_producto')
                     ->get();

            if ( $query->num_rows() > 0 ) {
                return $query->result_array();                
            } else {
                return NULL;
            }
        }

        public function cancelProduct($id) {
            $data = array(
                'stock' => 0
            );

            $this->db->where('id_producto', $id)
                     ->update('producto', $data);
        }
    } 
?>