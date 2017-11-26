<?php

class View_Controller extends CI_Controller
{

    function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
        $this->load->model('admin/general_model','general_model');
        //$data['testimonial']= $this->home_model->get_all_testimonial();
        //$this->load->vars($data);

        //Send the data into the current view
        //http://ellislab.com/codeigniter/user-guide/libraries/loader.html
    }

}
