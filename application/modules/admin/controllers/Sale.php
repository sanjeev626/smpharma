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

    public function editTempSale()
    {
        $data['title'] = '.:: Edit Sale ::.';
        $data['page_header'] = 'Edit  Sale';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Edit Sale';
        $data['panel_title'] = 'Edit Sale';
        $tempsales_id = $this->uri->segment(4);
        $data['tempsales_id'] = $tempsales_id;
        $data['tempsales'] = $this->Sale_model->getTempSale($tempsales_id);
        $data['temporders'] = $this->Sale_model->getTempOrder($tempsales_id);
        $data['main'] = 'tempsale_edit';
        $this->load->view('home', $data);
    }

    function addTempSale()
    {
        //print_r($_POST);
        $tempsale_id = $this->Sale_model->insertTempSale();
        $this->session->set_flashdata('success', 'New Sale added Successfully...');
        redirect(base_url() . 'admin/sale/showTempSale/'.$tempsale_id, 'refresh');
    }

    function showTempSale()
    {
        $data['title'] = '.:: Sales Details ::.';
        $data['page_header'] = 'Sales Details';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Sale';
        $data['panel_title'] = 'Sales - Details';
        $tempsales_id = $this->uri->segment(4);
        $data['tempsales_id'] = $tempsales_id;
        $data['tempsales'] = $this->Sale_model->getTempSale($tempsales_id);
        $data['temporders'] = $this->Sale_model->getTempOrder($tempsales_id);
        $data['main'] = 'tempsale_show';

        $this->load->view('home', $data);             
    }

    function completeSales()
    {
        $tempsales_id = $this->uri->segment(4);
        //echo $tempsales_id;
        $data['tempsales_id'] = $tempsales_id;
        $this->Sale_model->moveTempSale($tempsales_id);
        //$data['main'] = 'tempsale_show';

        $this->session->set_flashdata('success', 'Sales completed Successfully...');
        redirect(base_url() . 'admin/sale/listSales/', 'refresh');

    }

    public function listSales(){
        $from_date='';
        $to_date='';
        $keywords='';
        if(isset($_POST['keywords']))
            $keywords = $_POST['keywords'];

        if(isset($_POST['sale_date']))
            $from_date = $_POST['sale_date'];

        if(isset($_POST['sale_date_to']))
            $to_date = $_POST['sale_date_to'];

        $data['sales_info'] = $this->Sale_model->get_all_sales($from_date,$to_date,$keywords);
        
        $data['title'] = '.:: List Sale ::.';
        $data['page_header'] = 'List Sale';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Medicine';
        $data['panel_title'] = 'Sale List';
        $data['sale_date'] = $from_date;
        $data['sale_date_to'] = $to_date;
        $data['main'] = 'sales_listall';
        //$data['organisation_type'] =$this->general_model->getAll('dropdown','fid = 6','','id,dropvalue');

        $this->load->view('home', $data);
    } 

    function showSales()
    {
        $data['title'] = '.:: Sales Details ::.';
        $data['page_header'] = 'Sales Details';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Sale';
        $data['panel_title'] = 'Sales - Details';
        $sales_id = $this->uri->segment(4);
        $data['sales_id'] = $sales_id;
        $data['sales'] = $this->Sale_model->getSale($sales_id);
        $data['orders'] = $this->Sale_model->getOrder($sales_id);
        $data['main'] = 'sales_single';

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