<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * My Controller
 * @package Controller
 * @subpackage Controller
 * Date created:January 31,2017
 * @author Shyam Sundar Awal<shyam.awal@dac.com.np>
 */
class MY_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->checkUserlogin();
    }

    /**
     * check whether user is loggin or not. If not redirect to the login page.
     */
    public function checkUserlogin()
    {
        if (!$this->ion_auth->logged_in()) {
            redirect(base_url() . 'core', 'refresh');
        }
    }
}