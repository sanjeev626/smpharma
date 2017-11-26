<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Api Controller
 * @package Controller
 * @subpackage Controller
 * Date created:March 08, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class Api extends MY_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('api_model');
    }

    public function index(){
        //Do Nothing
    }

    public function expireJobWithinWeek(){
        $jobInfo = $this->api_model->get_expire_job_within_week();
        if(!empty($jobInfo)){
            foreach($jobInfo as $key => $value):
                $mail_to = 'sndrawal50@gmail.com'; // $value->email;
                $fullname =  $value->fname.' '.$value->mname.' '.$value->lname;
                $company_code = $value->orgcode;
                $job_code = $value->slug;
                $job_id = $value->job_id;

                $content  = '';
                $content .= "Hi <b>".$fullname."</b><br>";
                $content .= "<span>Your Posted Job will be expired within a week. Please update the post before the expired date.</span><br>";
                $content .= "<br><br>To view your Job, click the link below<br>";
                $content .= "<a href='".base_url()."job/".$company_code."/".$job_code."/".$job_id."'>Job View";
                $content .= "<br><br><br><br>Cheers,<br>";
                $content .= "Global Job Team";

                $adminEmail = 'info@globaljob.com.np';
                $mail_subject = "Post Job is on Expired !!!";
                $mail_body = $content;
                $mail_header  = 'MIME-Version: 1.0' . "\r\n";
                $mail_header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $mail_header .= 'To: '.$mail_to.' <'.$mail_to.'>' . "\r\n";
                $mail_header .= 'From: Global Job :: Complete HR solution <'.$adminEmail.'>' . "\r\n";

                if(@mail($mail_to,$mail_subject,$mail_body,$mail_header)){
                         echo "Mail Send Successfully<br>";
                    }else{
                       echo "Failed to Send Mail. Pleast Try Again<br>";
                    }

            endforeach;
        }
    }

    public function expireJob(){
        $jobInfo = $this->api_model->get_expire_job();
        if(!empty($jobInfo)){
            foreach($jobInfo as $key => $value):
                $mail_to = 'sndrawal50@gmail.com'; // $value->email;
                $fullname =  $value->fname.' '.$value->mname.' '.$value->lname;
                $company_code = $value->orgcode;
                $job_code = $value->slug;
                $job_id = $value->job_id;

                $content  = '';
                $content .= "Hi <b>".$fullname."</b><br>";
                $content .= "<span>Your Posted Job has been expired within a week. Please update the post if you want to re post the expired job post.</span><br>";
                $content .= "<br><br>To view your Job, click the link below<br>";
                $content .= "<a href='".base_url()."job/".$company_code."/".$job_code."/".$job_id."'>Job View";
                $content .= "<br><br><br><br>Cheers,<br>";
                $content .= "Global Job Team";

                $adminEmail = 'info@globaljob.com.np';
                $mail_subject = "Post Job is on Expired !!!";
                $mail_body = $content;
                $mail_header  = 'MIME-Version: 1.0' . "\r\n";
                $mail_header .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
                $mail_header .= 'To: '.$mail_to.' <'.$mail_to.'>' . "\r\n";
                $mail_header .= 'From: Global Job :: Complete HR solution <'.$adminEmail.'>' . "\r\n";

                if(@mail($mail_to,$mail_subject,$mail_body,$mail_header)){
                         echo "Mail Send Successfully<br>";
                    }else{
                       echo "Failed to Send Mail. Pleast Try Again<br>";
                    }

            endforeach;
        }
    }

}

/* End of file Slider.php
 * Location: ./application/modules/api/controllers/Slider.php */
