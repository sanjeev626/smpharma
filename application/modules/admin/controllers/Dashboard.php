<?php defined('BASEPATH') OR exit('No direct script access allowed');
/*** Admin Controller
 * @package Controller
 * @subpackage Controller
 * Date created:January 23, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */

class Dashboard extends MY_Controller {



    public function __construct() {

        parent::__construct();

        $this->load->model('general_model');

    }

   

    function index() {

        $data['title'] = 'S M Pharma :: Administrator Panel';

        $data['page_header'] = 'Dashboard';

        $data['page_header_icone'] = 'fa-home';

        $data['main'] = 'dashboard_view';

        $data['parent_nav'] = '';

        $data['nav'] = 'dashboard';

        $data['total_new_order'] = $this->general_model->countTotal('tbl_order');

        //$data['total_activity'] = $this->general_model->countTotal('tbl_activity');

        //$data['total_package'] = $this->general_model->countTotal('tbl_package');

        //$data['total_testimonial'] = $this->general_model->countTotal('tbl_testimonial');      

        if(!isset($this->session->lang))

        {            

            $the_session = array("lang" => '1');

            $this -> session -> set_userdata($the_session);

        }



        $this->load->view('home', $data);

    }



    function setLang($lang)

    {

        $the_session = array("lang" => $lang);

        $this -> session -> set_userdata($the_session);

        redirect(base_url() . 'admin/Dashboard');

    }



}



/* End of file dashboard.php

 * Location: ./application/modules/admin/controllers/dashboard.php */