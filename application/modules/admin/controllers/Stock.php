<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Stock Controller
 * @stock Controller
 * @substock Controller
 * Date created:June 01, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class Stock extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Stock_model');
        $this->load->model('general_model');
        $this->load->model('date_model');
    }

    public function index(){

        $config['base_url'] = base_url() . 'admin/Stock';
        //$config['uri_segment'] = 3;
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

        
        $config['total_rows'] = $this->db->count_all('tbl_stock');
        $data['stock_info'] = $this->Stock_model->get_all_stock($config['per_page'], $page);
        

        $this->pagination->initialize($config);

        $data['title'] = '.:: Stock ::.';
        $data['page_header'] = 'Stock';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Stock';
        $data['panel_title'] = 'Stock';
        $data['page'] = $page;
        $data['main'] = 'stock_view';
        //$data['organisation_type'] =$this->general_model->getAll('dropdown','fid = 6','','id,dropvalue');

        $this->load->view('home', $data);
    }

    public function near_expiry($from_date='',$to_date=''){
        if(empty($from_date))
            $from_date = date('Y-m-d');
        if(empty($to_date))
            $to_date = date('Y-m-d', strtotime($from_date. ' + 180 days'));


        $config['base_url'] = base_url() . 'admin/stock/near_expiry';
        //$config['uri_segment'] = 3;
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

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        
        $config['total_rows'] = $this->Stock_model->get_all_near_expiry($config['per_page'], $page,$from_date,$to_date,'1');
        $data['stock_info'] = $this->Stock_model->get_all_near_expiry($config['per_page'], $page,$from_date,$to_date);
        

        $this->pagination->initialize($config);

        $data['title'] = '.:: Near Expiry Medicines ::.';
        $data['page_header'] = 'Near Expiry Medicines ';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Near Expiry Medicines';
        $data['panel_title'] = 'View Near Expiry Medicines ';
        $data['page'] = $page;
        $data['main'] = 'near_expiry';
        //$data['stock_info'] = $this->Stock_model->get_all_near_expiry($from_date,$to_date);

        $this->load->view('home', $data);
    }

    public function expired(){
        $config['base_url'] = base_url() . 'admin/stock/expired';
        //$config['uri_segment'] = 3;
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

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;

        
        $config['total_rows'] = $this->Stock_model->get_all_expired($config['per_page'], $page,'1');
        $data['stock_info'] = $this->Stock_model->get_all_expired($config['per_page'], $page);
        

        $this->pagination->initialize($config);

        $data['title'] = '.:: Expired Medicines ::.';
        $data['page_header'] = 'Expired Medicines ';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Expired Medicines';
        $data['panel_title'] = 'View Expired Medicines ';
        $data['page'] = $page;
        $data['main'] = 'expired';
        //$data['stock_info'] = $this->Stock_model->get_all_near_expiry($from_date,$to_date);

        $this->load->view('home', $data);
    }

    public function deleteStock($sid){

        if (!isset($pid))
            redirect(base_url() . 'admin/Stock');

        if (!is_numeric($pid))
            redirect(base_url() . 'admin/Stock');

        $this->Stock_model->delete_stock($pid);
        $this->session->set_flashdata('success', 'Stock Deleted Successfully...');
        redirect(base_url() . 'admin/Stock', 'refresh');
    }

    public function listAll($pid){

        if (!isset($pid))
            redirect(base_url() . 'admin/Stock');

        if (!is_numeric($pid))
            redirect(base_url() . 'admin/Stock');

        $data['title'] = '.:: VIEW Stock ::.';
        $data['page_header'] = 'View Stock ';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Stock';
        $data['panel_title'] = 'View Stock  ';
        $data['main'] = 'stock_show_list';
        $data['stock_info'] = $this->Stock_model->get_all_by_aid($pid);

        $this->load->view('home', $data);
    }

    public function add(){
        $data['title'] = '.:: ADD Stock ::.';
        $data['page_header'] = 'View Stock ';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Stock';
        $data['panel_title'] = 'Add Stock  '; 
        $order_by = 'fullname ASC'; 
        $data['supplier_list'] =$this->general_model->getAll('tbl_supplier','',$order_by,'id,fullname'); 
        $data['main'] = 'stock_add_edit';
        //echo "lang = ".$this->session->lang;
        $this->load->view('home', $data);
    }

    public function addStock(){
        //print_r($_POST);
        $this->form_validation->set_rules('supplierName', 'supplierName', 'required');
        //echo $this->session->lang;
        if (FALSE == $this->form_validation->run()) {
            $data['title'] = '.:: ADD Stock ::.';
            $data['page_header'] = 'Stock';
            $data['page_header_icone'] = 'fa-product-hunt';
            $data['nav'] = 'Stock';
            $data['panel_title'] = 'Add Stock ';
            
            $data['main'] = 'stock_add_edit';

            $this->load->view('home', $data);

        } else {

            $pid = $this->Stock_model->add_stock();
            $this->session->set_flashdata('success', 'Stock added Successfully...');
            redirect(base_url() . 'admin/Stock/add', 'refresh');
        }
    }  

    public function edit($id){

        if (!isset($id))
            redirect(base_url() . 'admin/Stock');

        if (!is_numeric($id))
            redirect(base_url() . 'admin/Stock');

        $data['title'] = '.:: EDIT Stock ::.';
        $data['page_header'] = 'Stock';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Stock';
        $data['panel_title'] = 'Edit Stock ';
        $where = array('parent_id'=>'0');  
        $order_by = 'fullname ASC'; 
        $stock_detail = $this->general_model->getById('tbl_stock','id',$id);
        $data['stock_detail'] = $stock_detail;
        //print_r($stock_detail);
        
        $creditmemo_id = 0;
        if(isset($stock_detail->creditmemo_id))
            $creditmemo_id = $stock_detail->creditmemo_id;
        //echo $creditmemo_id;
        $creditmemo = $this->general_model->getAllById('tbl_creditmemo', 'id', $creditmemo_id, 'id');
        $data['creditmemo'] = $creditmemo;

        $distributor_id = 0;
        if(isset($creditmemo->distributor_id))
            $distributor_id = $creditmemo->distributor_id;
        $data['distributorname'] = $this->general_model->getFieldValue('tbl_supplier', 'fullname', 'id', $distributor_id);

        $stockInfo = $this->Stock_model->getAllStockInfo($creditmemo_id);
        $data['stockInfo'] = $stockInfo;

        $data['main'] = 'stock_add_edit';

        $this->load->view('home', $data);
    }

    public function editStock($mid){

        if (!isset($mid))
            redirect(base_url() . 'admin/Stock');

        if (!is_numeric($mid))
            redirect(base_url() . 'admin/Stock');

        
        $this->form_validation->set_rules('stock_name', 'stock_name', 'required');

        if (FALSE == $this->form_validation->run()) {
            $data['title'] = '.:: EDIT Stock ::.';
            $data['page_header'] = 'Stock';
            $data['page_header_icone'] = 'fa-product-hunt';
            $data['nav'] = 'Stock';
            $data['panel_title'] = 'Edit Stock ';
            $data['Stock_detail'] = $this->general_model->getById('tbl_stock','id',$mid);
            $data['main'] = 'edit/'.$mid;

            $this->load->view('home', $data);

        } else {

            $this->Stock_model->update_stock($mid);
            $this->session->set_flashdata('success', 'Stock Updated Successfully...');
            redirect(base_url() . 'admin/Stock/edit/'.$mid, 'refresh');
        }
    }

    function get_stocks(){
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->Stock_model->get_stock($q);
        }
    }

    function medicineSearch()
    {
        $medicine_id = $this->uri->segment('4');
        //echo $medicine_id;
        $data['title'] = '.:: Stock : Medicine Search ::.';
        $data['page_header'] = 'Medicine Search ';
        $data['page_header_icone'] = 'fa-search';
        $data['nav'] = 'Stock';
        $data['panel_title'] = 'Medicine Search';
        $data['searchKeyword'] = $this->general_model->getFieldValue('tbl_medicine', 'medicine_name', 'id', $medicine_id);
        $data['stockSearch'] = $this->Stock_model->getStockMedicine($medicine_id);

        $data['main'] = 'stock_search';
        $this->load->view('home', $data);

    }

    function invoiceSearch()
    {
        $invoice_id = $this->uri->segment('4');
        //echo $medicine_id;
        $data['title'] = '.:: Stock : Invoice Search ::.';
        $data['page_header'] = 'Invoice Search ';
        $data['page_header_icone'] = 'fa-search';
        $data['nav'] = 'Stock';
        $data['panel_title'] = 'Invoice Search';
        $data['searchKeyword'] = $this->general_model->getFieldValue('tbl_creditmemo', 'invoice_no', 'id', $invoice_id);
        $data['stockSearch'] = $this->Stock_model->getStockInvoice($invoice_id);

        $data['main'] = 'stock_search';
        $this->load->view('home', $data);
    }

    function distributorSearch()
    {
        $supplier_id = $this->uri->segment('4');
        //echo $medicine_id;
        $data['title'] = '.:: Stock : Distributor Search ::.';
        $data['page_header'] = 'Distributor Search ';
        $data['page_header_icone'] = 'fa-search';
        $data['nav'] = 'Stock';
        $data['panel_title'] = 'Distributor Search';
        $data['searchKeyword'] = $this->general_model->getFieldValue('tbl_supplier', 'fullname', 'id', $supplier_id);
        $data['stockSearch'] = $this->Stock_model->getStockSupplier($supplier_id);
        $data['main'] = 'stock_search';
        $this->load->view('home', $data);
    }

    function updateMedicineId()
    {
        $data['title'] = '.:: Stock : Update Medicine ID ::.';
        $data['page_header'] = 'Update Medicine ID ';
        $data['page_header_icone'] = 'fa-search';
        $data['nav'] = 'Stock';
        $data['panel_title'] = 'Update Medicine ID';
        $data['stockInfo'] = $this->Stock_model->getAllMedicinesFromStock();

        $data['main'] = 'update_medicine_id';
        $this->load->view('home', $data);
    }



    function updateNewMedicineId()
    {
        $data['title'] = '.:: Stock : Update Medicine ID ::.';
        $data['page_header'] = 'Update Medicine ID ';
        $data['page_header_icone'] = 'fa-search';
        $data['nav'] = 'Stock';
        $data['panel_title'] = 'Update Medicine ID';
        $data['stockInfo'] = $this->Stock_model->getAllNewMedicinesFromStock();

        $data['main'] = 'update_new_medicine_id';
        $this->load->view('home', $data);
    }

    function test()
    {
        echo "this is a test";
    }
}

/* End of file Stock.php
 * Location: ./application/modules/admin/controllers/Stock.php */