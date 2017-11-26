<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Admin Controller
 * @package Controller
 * @subpackage Controller
 * Date created:January 23, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class Admin extends CI_Controller {

    public function __construct() {
        parent::__construct();
    }

    function index() {   
        if (!$this->ion_auth->logged_in()) {
            redirect(base_url() . 'core', 'refresh');
        }else{
            redirect(base_url() . 'admin/dashboard', 'refresh');
        }
    }

}

/* End of file admin.php
 * Location: ./application/modules/admin/controllers/admin.php */