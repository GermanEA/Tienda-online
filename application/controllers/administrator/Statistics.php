<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Statistics extends CI_Controller {

    public function __construct() {
        parent::__construct();

        // $this->load->model('dashboard/M_statistics');
    }

    public function index()	{
        $this->general();		
    }

    public function general() {
        $page_data['page_content'] = '/administrator/v_statistics_template';
        $page_data['title_page'] = 'Estadísticas generales';
        $page_data['title_category'] = 'Estadísticas';        
		$page_data['custom_js'] = array ('/public/assets/js/statistics.js');

        $this->load->view('/administrator/v_dashboard', $page_data);
    }
}