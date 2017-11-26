<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Supplier Controller
 * @supplier Controller
 * @subsupplier Controller
 * Date created:June 01, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class Supplier extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Supplier_model');
        $this->load->model('general_model');
    }

    public function index(){

        $config['base_url'] = base_url() . 'admin/Supplier';
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

        
        $config['total_rows'] = $this->db->count_all('tbl_supplier');
        $data['supplier_info'] = $this->Supplier_model->get_all_supplier($config['per_page'], $page);
        

        $this->pagination->initialize($config);

        $data['title'] = '.:: Supplier ::.';
        $data['page_header'] = 'Supplier';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Supplier';
        $data['panel_title'] = 'Supplier List';
        $data['page'] = $page;
        $data['main'] = 'supplier_listall';
        //$data['organisation_type'] =$this->general_model->getAll('dropdown','fid = 6','','id,dropvalue');

        $this->load->view('home', $data);
    }

    public function deleteSupplier($pid){

        if (!isset($pid))
            redirect(base_url() . 'admin/Supplier');

        if (!is_numeric($pid))
            redirect(base_url() . 'admin/Supplier');

        $this->Supplier_model->delete_supplier($pid);
        $this->session->set_flashdata('success', 'Supplier Deleted Successfully...');
        redirect(base_url() . 'admin/Supplier', 'refresh');
    }

    public function listAll($pid){

        if (!isset($pid))
            redirect(base_url() . 'admin/Supplier');

        if (!is_numeric($pid))
            redirect(base_url() . 'admin/Supplier');

        $data['title'] = '.:: VIEW Supplier ::.';
        $data['page_header'] = 'View Supplier ';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Supplier';
        $data['panel_title'] = 'View Supplier  ';
        $data['main'] = 'supplier_show_list';
        $data['supplier_info'] = $this->Supplier_model->get_all_by_aid($pid);

        $this->load->view('home', $data);
    }

    public function add(){
        $data['title'] = '.:: ADD Supplier ::.';
        $data['page_header'] = 'View Supplier ';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Supplier';
        $data['panel_title'] = 'Add Supplier  ';
        $where = array('parent_id'=>'0');  
        $order_by = 'fullname ASC'; 
        $data['company_list'] =$this->general_model->getAll('tbl_company',$where,$order_by,'id,fullname'); 
        $data['main'] = 'supplier_add_edit';
        //echo "lang = ".$this->session->lang;
        $this->load->view('home', $data);
    }

    public function addSupplier(){

        $this->form_validation->set_rules('fullname', 'fullname', 'required');
        //echo $this->session->lang;
        if (FALSE == $this->form_validation->run()) {
            $data['title'] = '.:: ADD Supplier ::.';
            $data['page_header'] = 'Supplier';
            $data['page_header_icone'] = 'fa-product-hunt';
            $data['nav'] = 'Supplier';
            $data['panel_title'] = 'Add Supplier ';
            
            $data['main'] = 'supplier_add_edit';

            $this->load->view('home', $data);

        } else {

            $pid = $this->Supplier_model->add_supplier();
            $this->session->set_flashdata('success', 'Supplier added Successfully...');
            redirect(base_url() . 'admin/Supplier', 'refresh');
        }
    }  

    public function edit($id){

        if (!isset($id))
            redirect(base_url() . 'admin/Supplier');

        if (!is_numeric($id))
            redirect(base_url() . 'admin/Supplier');

        $data['title'] = '.:: EDIT Supplier ::.';
        $data['page_header'] = 'Supplier';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Supplier';
        $data['panel_title'] = 'Edit Supplier ';
        $where = array('parent_id'=>'0');  
        $order_by = 'fullname ASC'; 
        $data['company_list'] =$this->general_model->getAll('tbl_company',$where,$order_by,'id,fullname'); 
        $data['supplier_detail'] = $this->general_model->getById('tbl_supplier','id',$id);
        $data['main'] = 'supplier_add_edit';

        $this->load->view('home', $data);
    }

    public function editSupplier($pid){

        if (!isset($pid))
            redirect(base_url() . 'admin/Supplier');

        if (!is_numeric($pid))
            redirect(base_url() . 'admin/Supplier');

        
        $this->form_validation->set_rules('fullname', 'fullname', 'required');

        if (FALSE == $this->form_validation->run()) {
            $data['title'] = '.:: EDIT Supplier ::.';
            $data['page_header'] = 'Supplier';
            $data['page_header_icone'] = 'fa-product-hunt';
            $data['nav'] = 'Supplier';
            $data['panel_title'] = 'Edit Supplier ';
            $data['Supplier_detail'] = $this->general_model->getById('tbl_supplier','id',$pid);
            $data['main'] = 'edit/'.$pid;

            $this->load->view('home', $data);

        } else {

            $this->Supplier_model->update_supplier($pid);
            $this->session->set_flashdata('success', 'Supplier Updated Successfully...');
            redirect(base_url() . 'admin/Supplier/edit/'.$pid, 'refresh');
        }
    }

    function get_suppliers(){
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->Supplier_model->get_supplier($q);
        }
    }

    public function search()
    {

    }
}

/* End of file Supplier.php
 * Location: ./application/modules/admin/controllers/Supplier.php */