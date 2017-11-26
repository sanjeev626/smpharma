<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Company Controller
 * @company Controller
 * @subcompany Controller
 * Date created:June 01, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class Company extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Company_model');
        $this->load->model('general_model');
    }

    public function index(){

        $config['base_url'] = base_url() . 'admin/Company';
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

        
        $config['total_rows'] = $this->db->count_all('tbl_company');
        $data['company_info'] = $this->Company_model->get_all_company($config['per_page'], $page);
        

        $this->pagination->initialize($config);

        $data['title'] = '.:: Company ::.';
        $data['page_header'] = 'Company';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Company';
        $data['panel_title'] = 'Company List';
        $data['page'] = $page;
        $data['main'] = 'company_listall';
        //$data['organisation_type'] =$this->general_model->getAll('dropdown','fid = 6','','id,dropvalue');

        $this->load->view('home', $data);
    }

    public function deleteCompany($pid){

        if (!isset($pid))
            redirect(base_url() . 'admin/Company');

        if (!is_numeric($pid))
            redirect(base_url() . 'admin/Company');

        $this->Company_model->delete_company($pid);
        $this->session->set_flashdata('success', 'Company Deleted Successfully...');
        redirect(base_url() . 'admin/Company', 'refresh');
    }

    public function listAll($pid){

        if (!isset($pid))
            redirect(base_url() . 'admin/Company');

        if (!is_numeric($pid))
            redirect(base_url() . 'admin/Company');

        $data['title'] = '.:: VIEW Company ::.';
        $data['page_header'] = 'View Company ';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Company';
        $data['panel_title'] = 'View Company  ';
        $data['main'] = 'company_show_list';
        $data['company_info'] = $this->Company_model->get_all_by_aid($pid);

        $this->load->view('home', $data);
    }

    public function add(){
        $data['title'] = '.:: ADD Company ::.';
        $data['page_header'] = 'View Company ';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Company';
        $data['panel_title'] = 'Add Company  ';
        $where = array('parent_id'=>'0');  
        $order_by = 'fullname ASC'; 
        $data['parent_company_list'] =$this->general_model->getAll('tbl_company',$where,$order_by,'id,fullname'); 
        $data['main'] = 'company_add_edit';
        //echo "lang = ".$this->session->lang;
        $this->load->view('home', $data);
    }

    public function addCompany(){

        $this->form_validation->set_rules('fullname', 'fullname', 'required');
        //echo $this->session->lang;
        if (FALSE == $this->form_validation->run()) {
            $data['title'] = '.:: ADD Company ::.';
            $data['page_header'] = 'Company';
            $data['page_header_icone'] = 'fa-product-hunt';
            $data['nav'] = 'Company';
            $data['panel_title'] = 'Add Company ';
            
            $data['main'] = 'company_add_edit';

            $this->load->view('home', $data);

        } else {

            $pid = $this->Company_model->add_company();
            $this->session->set_flashdata('success', 'Company added Successfully...');
            redirect(base_url() . 'admin/Company', 'refresh');
        }
    }  

    public function edit($id){

        if (!isset($id))
            redirect(base_url() . 'admin/Company');

        if (!is_numeric($id))
            redirect(base_url() . 'admin/Company');

        $data['title'] = '.:: EDIT Company ::.';
        $data['page_header'] = 'Company';
        $data['page_header_icone'] = 'fa-product-hunt';
        $data['nav'] = 'Company';
        $data['panel_title'] = 'Edit Company ';
        $where = array('parent_id'=>'0');  
        $order_by = 'fullname ASC'; 
        $data['parent_company_list'] =$this->general_model->getAll('tbl_company',$where,$order_by,'id,fullname'); 
        $data['company_detail'] = $this->general_model->getById('tbl_company','id',$id);
        $data['main'] = 'company_add_edit';

        $this->load->view('home', $data);
    }

    public function editCompany($pid){

        if (!isset($pid))
            redirect(base_url() . 'admin/Company');

        if (!is_numeric($pid))
            redirect(base_url() . 'admin/Company');

        
        $this->form_validation->set_rules('fullname', 'fullname', 'required');

        if (FALSE == $this->form_validation->run()) {
            $data['title'] = '.:: EDIT Company ::.';
            $data['page_header'] = 'Company';
            $data['page_header_icone'] = 'fa-product-hunt';
            $data['nav'] = 'Company';
            $data['panel_title'] = 'Edit Company ';
            $data['Company_detail'] = $this->general_model->getById('tbl_company','id',$pid);
            $data['main'] = 'edit/'.$pid;

            $this->load->view('home', $data);

        } else {

            $this->Company_model->update_company($pid);
            $this->session->set_flashdata('success', 'Company Updated Successfully...');
            redirect(base_url() . 'admin/Company/edit/'.$pid, 'refresh');
        }
    }

    function get_companies(){
        if (isset($_GET['term'])){
          $q = strtolower($_GET['term']);
          $this->Company_model->get_company($q);
        }
    }
}

/* End of file Company.php
 * Location: ./application/modules/admin/controllers/Company.php */