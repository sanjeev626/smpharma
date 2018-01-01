<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Sale Controller
 * @sale Controller
 * @subsale Controller
 * Date created:June 01, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class Sale extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Sale_model');
        $this->load->model('general_model');
        $this->load->model('date_model');
    }

    public function index(){
        $data['title'] = '.:: Sale ::.';
        $data['page_header'] = 'Point of Sale';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Sale';
        $data['panel_title'] = 'Sale';
        $data['main'] = 'sale';
        //$data['organisation_type'] =$this->general_model->getAll('dropdown','fid = 6','','id,dropvalue');

        $this->load->view('home', $data);
    }

    public function addSale()
    {
        $this->Sale_model->add_sales();
        $this->session->set_flashdata('success', 'New Sale added Successfully...');
        redirect(base_url() . 'admin/sale', 'refresh');
    }

    public function listSale(){

        $config['base_url'] = base_url() . 'admin/sale/listSale';
        $config['uri_segment'] = 3;
        $config['per_page'] = 50;

        /* Bootstrap Pagination  */

        $config['full_tag_open'] = "<ul class='pagination'>";
        $config['full_tag_close'] ="</ul>";
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = "<li>";
        $config['next_tagl_close'] = "</li>";
        $config['prev_tag_open'] = "<li>";
        $config['prev_tagl_close'] = "</li>";
        $config['first_tag_open'] = "<li>";
        $config['first_tagl_close'] = "</li>";
        $config['last_tag_open'] = "<li>";
        $config['last_tagl_close'] = "</li>";

        /* End of Bootstrap Pagination */

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        
        //$config['total_rows'] = $this->db->count_all('tbl_medicine');
        $config['total_rows'] = 50;
        $data['sales_info'] = $this->Sale_model->get_all_sales($config['per_page'], $page);
        

        $this->pagination->initialize($config);

        $data['title'] = '.:: List Sale ::.';
        $data['page_header'] = 'List Sale';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Medicine';
        $data['panel_title'] = 'Sale List';
        $data['page'] = $page;
        $data['main'] = 'sales_listall';
        //$data['organisation_type'] =$this->general_model->getAll('dropdown','fid = 6','','id,dropvalue');

        $this->load->view('home', $data);
    }  

    function get_medicines_stock(){
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->Sale_model->get_medicine_stock($q);
        }
    }
}

/* End of file Sale.php
 * Location: ./application/modules/admin/controllers/Sale.php */