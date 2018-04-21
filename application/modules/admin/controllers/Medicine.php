<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Medicine Controller
 * @medicine Controller
 * @submedicine Controller
 * Date created:June 01, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class Medicine extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Medicine_model');
        $this->load->model('general_model');
    }

    public function index(){

        $config['base_url'] = base_url() . 'admin/Medicine';
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

        
        $config['total_rows'] = $this->db->count_all('tbl_medicine');
        $data['medicine_info'] = $this->Medicine_model->get_all_medicine($config['per_page'], $page);
        

        $this->pagination->initialize($config);

        $data['title'] = '.:: Medicine ::.';
        $data['page_header'] = 'Medicine';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Medicine';
        $data['panel_title'] = 'Medicine List';
        $data['page'] = $page;
        $data['main'] = 'medicine_listall';
        //$data['organisation_type'] =$this->general_model->getAll('dropdown','fid = 6','','id,dropvalue');

        $this->load->view('home', $data);
    }

    public function deleteMedicine($pid){

        if (!isset($pid))
            redirect(base_url() . 'admin/Medicine');

        if (!is_numeric($pid))
            redirect(base_url() . 'admin/Medicine');

        $this->Medicine_model->delete_medicine($pid);
        $this->session->set_flashdata('success', 'Medicine Deleted Successfully...');
        redirect(base_url() . 'admin/Medicine', 'refresh');
    }

    public function listAll($pid){

        if (!isset($pid))
            redirect(base_url() . 'admin/Medicine');

        if (!is_numeric($pid))
            redirect(base_url() . 'admin/Medicine');

        $data['title'] = '.:: VIEW Medicine ::.';
        $data['page_header'] = 'View Medicine ';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Medicine';
        $data['panel_title'] = 'View Medicine  ';
        $data['main'] = 'medicine_show_list';
        $data['medicine_info'] = $this->Medicine_model->get_all_by_aid($pid);

        $this->load->view('home', $data);
    }

    public function add(){
        $data['title'] = '.:: ADD Medicine ::.';
        $data['page_header'] = 'View Medicine ';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Medicine';
        $data['panel_title'] = 'Add Medicine  ';
        $where = array('parent_id'=>'0');  
        $order_by = 'fullname ASC'; 
        $data['parent_medicine_list'] =$this->general_model->getAll('tbl_medicine',$where,$order_by,'id,fullname'); 
        $data['main'] = 'medicine_add_edit';
        //echo "lang = ".$this->session->lang;
        $this->load->view('home', $data);
    }

    public function addMedicine(){

        $this->form_validation->set_rules('fullname', 'fullname', 'required');
        //echo $this->session->lang;
        if (FALSE == $this->form_validation->run()) {
            $data['title'] = '.:: ADD Medicine ::.';
            $data['page_header'] = 'Medicine';
            $data['page_header_icone'] = 'fa-product-hunt';
            $data['nav'] = 'Medicine';
            $data['panel_title'] = 'Add Medicine ';
            
            $data['main'] = 'medicine_add_edit';

            $this->load->view('home', $data);

        } else {

            $pid = $this->Medicine_model->add_medicine();
            $this->session->set_flashdata('success', 'Medicine added Successfully...');
            redirect(base_url() . 'admin/Medicine', 'refresh');
        }
    }  

    public function edit($id){

        if (!isset($id))
            redirect(base_url() . 'admin/Medicine');

        if (!is_numeric($id))
            redirect(base_url() . 'admin/Medicine');

        $data['title'] = '.:: EDIT Medicine ::.';
        $data['page_header'] = 'Medicine';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Medicine';
        $data['panel_title'] = 'Edit Medicine ';
        $where = array('parent_id'=>'0');  
        $order_by = 'fullname ASC'; 
        $data['main_division'] =$this->general_model->getAll('tbl_company',$where,$order_by,'id,fullname');
        $data['form_list'] =$this->general_model->getAll('tbl_form','','form ASC','id,form'); 
        $data['medicine_detail'] = $this->general_model->getById('tbl_medicine','id',$id);
        $data['main'] = 'medicine_add_edit';

        $this->load->view('home', $data);
    }

    public function editMedicine($mid){

        if (!isset($mid))
            redirect(base_url() . 'admin/Medicine');

        if (!is_numeric($mid))
            redirect(base_url() . 'admin/Medicine');

        
        $this->form_validation->set_rules('medicine_name', 'medicine_name', 'required');

        if (FALSE == $this->form_validation->run()) {
            $data['title'] = '.:: EDIT Medicine ::.';
            $data['page_header'] = 'Medicine';
            $data['page_header_icone'] = 'fa-product-hunt';
            $data['nav'] = 'Medicine';
            $data['panel_title'] = 'Edit Medicine ';
            $data['Medicine_detail'] = $this->general_model->getById('tbl_medicine','id',$mid);
            $data['main'] = 'edit/'.$mid;

            $this->load->view('home', $data);

        } else {

            $this->Medicine_model->update_medicine($mid);
            $this->session->set_flashdata('success', 'Medicine Updated Successfully...');
            redirect(base_url() . 'admin/Medicine/edit/'.$mid, 'refresh');
        }
    }

    public function merge_medicine()
    {        
        $data['title'] = '.:: Merge Medicine ::.';
        $data['page_header'] = 'Merge Medicine ';
        $data['page_header_icone'] = 'fa-search';
        $data['nav'] = 'Medicine';
        $data['panel_title'] = 'Merge Medicine  ';
        $data['main'] = 'medicine_merge';
        //echo "lang = ".$this->session->lang;
        if(isset($_POST['btnMerge']))
        {
            $this->Medicine_model->merge_medicine($_POST['correct_name_id'],$_POST['wrong_name_id']);
            $this->session->set_flashdata('success', 'Medicine Merged Successfully...');
            //redirect(base_url() . 'admin/medicine/merge_medicine/', 'refresh');
        }
        $this->load->view('home', $data);
    }

    public function search(){
        $data['title'] = '.:: Search Medicine ::.';
        $data['page_header'] = 'Search Medicine ';
        $data['page_header_icone'] = 'fa-search';
        $data['nav'] = 'Medicine';
        $data['panel_title'] = 'Search Medicine  ';
        $medicine_id = $this->uri->segment(4);
        if(empty($medicine_id))
            $medicine_id=0;
        $data['medicine_id'] = $medicine_id;
        $data['medicine_info'] =$this->Medicine_model->get_medicine_info($medicine_id); 
        $data['main'] = 'medicine_search';
        //echo "lang = ".$this->session->lang;
        $this->load->view('home', $data);
    }

    function get_medicines(){
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->Medicine_model->get_medicine($q);
        }
    }

    function search_medicines(){
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->Medicine_model->search_medicine($q);
        }
    }
}

/* End of file Medicine.php
 * Location: ./application/modules/admin/controllers/Medicine.php */