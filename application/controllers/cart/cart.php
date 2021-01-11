<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cart extends CI_Controller {

	public function __construct() {
		parent::__construct();
		
		// $this->load->model('cart/M_cart');
	}	

	public function index()	{
		$this->loadViewsInit();		
	}

	public function loadViewsInit() {
		$page_data['page_content'] = 'cart/v_cart';
		
        $this->load->view('/layouts/main', $page_data);
    }
    
    public function addCartProduct() {
        $data = $this->input->post();

        $data_cart = array(
            'id'    => $data['id'],
            'qty'   => $data['qty'],
            'price' => $data['price'],
            'name'  => $data['name'],
            'size'  => $data['size'],
            'image' => $data['image']
        );

        $this->cart->insert($data_cart);

        echo '<?xml version="1.0" encoding="utf-8"?>';
        echo '<response>'.$this->cart->total_items().'</response>';
    }

    public function removeProduct() {
        $data = $this->input->post();

        $this->cart->remove($data['rowid']);
        $this->index();
    }

    public function showCartProduct() {
        $this->load->view('/cart/v_cart_modal');
    }
}