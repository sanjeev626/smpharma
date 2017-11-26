<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Home Controller
 * @package Controller
 * @subpackage Controller
 * Date created:January 31, 2017
 * @author Digital Agency Catmandu <info@dac.com.np>
 */
class Home extends View_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('home_model');
        $this->load->helper("view_helper");
        $this->load->model('admin/general_model','general_model');
    }

    function index() {    
        $data['menu'] = 'home';
        $data['page_title'] = '.:: A trave and tours of Nepal :: ';
        // $data['premium_job'] = $this->home_model->get_job_by_type('PJob',5);
        // $data['corporate_job'] = $this->home_model->get_job_by_type('CJob',50);
        // $data['newspaper_job'] = $this->home_model->get_job_by_type('NJob',6);
        // $data['recent_job'] = $this->home_model->get_job_by_type('RJob',6);
        // $data['featured_job'] = $this->home_model->get_job_by_type('FJob',6);
        // $data['location'] = $this->general_model->getAll('dropdown','fid = 2','dropvalue ASC','id,dropvalue','',200);
        // $data['type'] = $this->general_model->getAll('dropdown','fid = 2','','id,dropvalue','',6);
        // $data['sliders'] = $this->general_model->getAll('slider',array('status' => 'Enabled','type' => 'slider'));
        // $data['middle_banner'] = $this->general_model->getAll('slider',array('status' => 'Enabled','type' => 'middle_portion'),'','','',2);

        $data['main'] = 'home';
        $this->load->view('main',$data);
    }
    
    public function subscribe(){
        $subscribe_data = array(
            'name' => $this->input->post('name'),
            'email'=> $this->input->post('email')
        );

        $this->general_model->insert('subscribe',$subscribe_data);

        $this->session->set_flashdata('success', 'Your Information has been Saved. ');
        redirect(base_url());

    }

    /*---------------------------------------------------------
        Job Detail Information with paramater slug and job Id
    ---------------------------------------------------------*/
    public function job($emp_slug,$slug,$job_id = ''){
        if(($emp_slug) && ($slug) && ($job_id)){
            $slug = $this->uri->segment(3);
            $jobid = $this->uri->segment(4);
        }else{
            $slug = $this->uri->segment(2);
            $jobid = $this->uri->segment(3);
        }

        $data['menu'] = 'home';
        $data['page_title'] = '.:: Global Job :: Complete HR Solution..';
        $data['job_detail'] = $jobInfo = $this->general_model->getAll('jobs',array('id'=>$jobid,'slug'=>$slug));
        
        $jobview = ($jobInfo[0]->no_of_views != '') ? $jobInfo[0]->no_of_views : 0; 
        $total_view = $jobview +1;
        $view_data =array(    
            'no_of_views' => $total_view
        );
        $this->general_model->update('jobs',$view_data, array('id' => $jobid));

        $employerId = $data['job_detail'][0]->eid;
        //echo $employerId;
        $data['employer_info'] = $this->general_model->getById('employer','id',$employerId); 
        $applydate = date('Y-m-d');
        if($employerId>0)
        $data['related_job'] = $this->general_model->getAll('jobs',array('eid'=>$employerId,'id !=' => $jobid,'applybefore >='=>$applydate),'','id,jobtitle,slug');
        else
            $data['related_job'] = '';
        $banner_image = $data['employer_info'] = $jobInfo[0]->banner_image;
        if((isset($banner_image)) && ($banner_image !== NULL)){
            $this->load->view('job-new-detail',$data);
        }else{
            $this->load->view('job-detail',$data);
        }
    }

    public function premium_jobs(){
        $type = "PJob";
        $data['premium_job_all'] = $this->home_model->get_job_by_type('PJob',50);
        $data['job_list'] = '';
         /* Bootstrap Pagination  */
         /*
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
        /*
        $config['uri_segment'] = 3;
        $config['per_page'] = 25;

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $config['base_url'] = base_url() . 'premium_jobs/';

        //$data['job_list']= $this->home_model->get_news_job_list($config['per_page'], $page,$type);
        //$config['total_rows'] = $data['total'] =$this->home_model->count_job_by_type($type,$typeId);
        $config['total_rows'] = $data['total'] = 50;

        $this->pagination->initialize($config);
        */
        $data['menu'] = 'none';
        $data['page_title'] = '.:: Global Job :: Complete HR Solution..';
        $data['title'] ='PREMUIM JOBS';
        //$data['job_info'] = $data['job_list'];
        //$data['total_job'] = $data['total'];

        $data['main'] = 'premium-job-list';
        $this->load->view('main',$data);
    }

    public function top_jobs(){
        $type = "CJob";
        $data['top_job_all'] = $this->home_model->get_job_by_type('CJob',100);
        //$data['job_list'] = '';
         /* Bootstrap Pagination  */
         /*
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
        /*
        $config['uri_segment'] = 3;
        $config['per_page'] = 25;

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $config['base_url'] = base_url() . 'premium_jobs/';

        //$data['job_list']= $this->home_model->get_news_job_list($config['per_page'], $page,$type);
        //$config['total_rows'] = $data['total'] =$this->home_model->count_job_by_type($type,$typeId);
        $config['total_rows'] = $data['total'] = 50;

        $this->pagination->initialize($config);
        */
        $data['menu'] = 'none';
        $data['page_title'] = '.:: Global Job :: Complete HR Solution..';
        $data['title'] ='TOP JOBS';
        //$data['job_info'] = $data['job_list'];
        //$data['total_job'] = $data['total'];

        $data['main'] = 'top-job-list';
        $this->load->view('main',$data);
    }

    public function corporate_jobs(){
        $type = "CJob";
        $data['top_job_all'] = $this->home_model->get_job_by_type('CJob',100);
        //$data['job_list'] = '';
         /* Bootstrap Pagination  */
         /*
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
        /*
        $config['uri_segment'] = 3;
        $config['per_page'] = 25;

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $config['base_url'] = base_url() . 'premium_jobs/';

        //$data['job_list']= $this->home_model->get_news_job_list($config['per_page'], $page,$type);
        //$config['total_rows'] = $data['total'] =$this->home_model->count_job_by_type($type,$typeId);
        $config['total_rows'] = $data['total'] = 50;

        $this->pagination->initialize($config);
        */
        $data['menu'] = 'none';
        $data['page_title'] = '.:: Global Job :: Complete HR Solution..';
        $data['title'] ='TOP JOBS';
        //$data['job_info'] = $data['job_list'];
        //$data['total_job'] = $data['total'];

        $data['main'] = 'corporate-job-list';
        $this->load->view('main',$data);
    }    

    public function key_positions(){
        $type = "IJob";
        $data['key_positions_all'] = $this->home_model->get_job_by_type('IJob',100);
        //$data['job_list'] = '';
         /* Bootstrap Pagination  */
         /*
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
        /*
        $config['uri_segment'] = 3;
        $config['per_page'] = 25;

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $config['base_url'] = base_url() . 'premium_jobs/';

        //$data['job_list']= $this->home_model->get_news_job_list($config['per_page'], $page,$type);
        //$config['total_rows'] = $data['total'] =$this->home_model->count_job_by_type($type,$typeId);
        $config['total_rows'] = $data['total'] = 50;

        $this->pagination->initialize($config);
        */
        $data['menu'] = 'none';
        $data['page_title'] = '.:: Global Job :: Complete HR Solution..';
        $data['title'] ='INTERNATIONAL JOBS';
        //$data['job_info'] = $data['job_list'];
        //$data['total_job'] = $data['total'];

        $data['main'] = 'key-positions-list';
        $this->load->view('main',$data);
    }
    
    private function _ageCalculator($dob){
        if(!empty($dob)){
            $birthdate = new DateTime($dob);
            $today   = new DateTime('today');
            $age = $birthdate->diff($today)->y;
            return $age;
        }else{
            return 0;
        }
    }

    /*---------------------------------------------------------
        Check Befor Apply Whether User is Login or Not
    ---------------------------------------------------------*/
    public function applyJob($jobid){
       $jobseeker_profile = $this->session->userdata('jobseeker_profile');
        if(!empty($jobseeker_profile)){
            $jid = $jobid;  // jid = Job Id
            $empinfo = $this->general_model->getById('jobs','id',$jobid);
            $eid =$empinfo->eid;  // eid = Employer Id
            $sid = $jobseeker_profile->id; // Job Seeker User Id

            //print_r($jobseeker_profile);
            /*-----------------------------------------------------------------------------------------------------------------
                                                       Condition Check for Faculty and Age
            -------------------------------------------------------------------------------------------------------------------*/
            $error_message = '';
            //echo '<br>-----'.$sid.'-----<br>';
            $job_faculty = $empinfo->apply_by_faculty;
            $job_age = $empinfo->apply_by_age;

            $seekerInfo = $this->general_model->getById('seeker','id',$sid);

            $seeker_faculty = $seekerInfo->faculty;
            $seeker_dob = $seekerInfo->dob;
            $seeker_age = $this->_ageCalculator($seeker_dob);


            $start_age = $empinfo->from_age;
            $end_age = $empinfo->to_age;

               if($job_age == '18-20'){
                    $start_age = 18;
                    $end_age = 20;
                }
                if($job_age == '21-25'){
                    $start_age = 21;
                    $end_age = 25;
                }
                if($job_age == '26-30'){
                    $start_age = 26;
                    $end_age = 30;
                }
                if($job_age == '30+'){
                    $start_age = 31;
                    $end_age = 60;
                }

            if($job_faculty == 'any'){

                if($seeker_age >= $start_age && $seeker_age <= $end_age){
                   // continue;
                }else{
                    $this->session->set_flashdata('error', 'Job Condition does not match with your Faculty and Age. Please Apply for Correct Criteria');
                    redirect(base_url() . 'Jobseeker/dashboard');
                }
            }
            else if($job_faculty == $seeker_faculty){

                if($seeker_age >= $start_age && $seeker_age <= $end_age){

                }else{
                    $this->session->set_flashdata('error', 'Job Condition does not match with your Faculty and Age. Please Apply for Correct Criteria');
                    redirect(base_url() . 'Jobseeker/dashboard');
                   }
            }else{
                $this->session->set_flashdata('error', 'Job Condition does not match with your Faculty and Age. Please Apply for Correct Criteria');
                    redirect(base_url() . 'Jobseeker/dashboard');
            }
             /*-----------------------------------------------------------------------------------------------------------------
                                                 End of Condition Check for Faculty and Age
            -------------------------------------------------------------------------------------------------------------------*/
            $check =  $this->general_model->countTotal('application',array('jid' => $jid,'sid'=>$sid,'eid'=>$eid));

            if($check == 0){
                  $applicable=0;
                  $education = $this->general_model->countTotal('seeker_education',array('sid'=>$sid));
                  $experience = $this->general_model->countTotal('seeker_experience',array('sid'=>$sid));
                  $training = $this->general_model->countTotal('seeker_training',array('sid'=>$sid));
                  $lang = $this->general_model->countTotal('seeker_language',array('sid'=>$sid));
                  $reference = $this->general_model->countTotal('seeker_reference',array('sid'=>$sid));

                  $required_education = $empinfo->required_education;
                  if(!empty($required_education))
                  {
                    //echo $required_education.'=='.$seekerInfo->faculty;
                    if($required_education != $seekerInfo->faculty)
                    {
                       $error_message .= "<br>Your Education details doesn't match employer's required education"; 
                       $applicable += 1; 
                    }
                  }

                  $other_faculty = $empinfo->other_faculty;

                  $slc_docs = $empinfo->slc_docs;
                  if($slc_docs==1)
                  {
                    if(empty($seekerInfo->slc_docs))
                    {
                       $error_message .= "<br>Please upload SLC Marksheet to apply for this job."; 
                       $applicable += 1; 
                    }
                  }

                  $docs_11_12 = $seekerInfo->docs_11_12;
                  if($docs_11_12==1)
                  {
                    if(empty($jobseeker_profile->docs_11_12))
                    {
                       $error_message .= "<br>Please upload 11/12 Transcript to apply for this job."; 
                       $applicable += 1; 
                    }
                  }

                  $bachelor_docs = $empinfo->bachelor_docs;
                  if($bachelor_docs==1)
                  {
                    if(empty($seekerInfo->bachelor_docs))
                    {
                       $error_message .= "<br>Please upload bachelor transcript to apply for this job."; 
                       $applicable += 1; 
                    }
                  }

                  $masters_docs = $empinfo->masters_docs;
                  if($masters_docs==1)
                  {
                    if(empty($seekerInfo->masters_docs))
                    {
                       $error_message .= "<br>Please upload Masters Transcript to apply for this job."; 
                       $applicable += 1; 
                    }
                  }


                  //echo $required_education.' -- '.$other_faculty.' -- '.$slc_docs.' -- '.$docs_11_12.' -- '.$bachelor_docs.' -- '.$masters_docs;
                  //echo "<br>";

                 if($education==0){ $error_message .= "<br>Education details is mandatory"; $applicable += 1;}
	             //if($training==0){ $applicable += 1; }
	             if($lang==0){ $error_message .= "<br>Language details is mandatory";  $applicable += 1; }
	             if($reference==0){ $error_message .= "<br>Reference details is mandatory";  $applicable += 1; }

                //Get job Seeker Info
                    $fromEmail = $jobseeker_profile->email;
                    $fromName = $jobseeker_profile->fname.' '.$jobseeker_profile->mname.' '.$jobseeker_profile->lname;
                //echo "<br>applicable = ".$applicable;
                if($applicable == 0){

                    /*---------------------------------------------------------
                            Sending Mail to job Seeker about apply job
                    ---------------------------------------------------------*/
                    $adminEmail = 'info@globaljob.com.np';

                    //Get job Seeker Info
                    $fromEmail = $jobseeker_profile->email;
                    $fromName = $jobseeker_profile->fname.' '.$jobseeker_profile->mname.' '.$jobseeker_profile->lname;

                    $employerInfo = $this->general_model->getById('employer','id',$eid,'email,orgname');

                    $toEmail = $employerInfo->email;
                    $toName = $employerInfo->orgname;

                    $jobInfo = $this->general_model->getById('jobs','id',$jid,'jobtitle,onlineap,emailap,postap,orgemail');

                    $jobtitle = $jobInfo->jobtitle;
                    $onlineap = $jobInfo->onlineap;
                    $emailap = $jobInfo->emailap;
                    $postap = $jobInfo->postap;

                    /*---------------------------------------------------------
                                Send Mail to multiple recipients
                    ---------------------------------------------------------*/
                    $to  = $adminEmail . ', '; // note the comma
                    if($emailap=="Yes") $to .= $toEmail;
                    if(!empty($jobInfo->orgemail)) $to .= $jobInfo->orgemail;

                    // subject
                    $subject = 'globaljob.com.np :: Job Application for the post of '.$jobtitle." ::";

                    $content1 = $this->_jobSeekerDetail($sid);

                     /*---------------------------------------------------------
                        To send HTML mail, the Content-type header must be set
                    ---------------------------------------------------------*/
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                    // Additional headers
                    $headers .= 'To: '.$toName.' <'.$to.'>' . "\r\n";
                    $headers .= 'From: '.$fromName.' <'.$fromEmail.'>' . "\r\n";
                    $headers .= 'Bcc: '.$adminEmail . "\r\n";

                    // Mail it
                    @mail($to, $subject, $content1, $headers);

                    /*---------------------------------------------------------
                        send mail to applier starts here
                    ---------------------------------------------------------*/
                    $subject ='Your Application for '.$jobtitle.' has been successfully received.';
                    $content = "Dear ".$fromName.",<br><br>Your Application for ".$jobtitle." has been successfully received. Only shortlisted candidates will be contacted for further process.<br><br><br><br>Thank you<br>globaljob.com.np<br>A complete HR solution";
                    $headers  = 'MIME-Version: 1.0' . "\r\n";
                    $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

                    // Additional headers
                    $headers .= 'To: '.$fromName.' <'.$fromEmail.'>' . "\r\n";
                    $headers .= 'From: '.$toName.' <'.$to.'>' . "\r\n";
                    $headers .= 'Bcc: '.$adminEmail . "\r\n";

                    // Mail it
                    @mail($fromEmail, $subject, $content, $headers);

                  /*---------------------------------------------------------
                            Insert into Application table for information
                    ---------------------------------------------------------*/
                    $data = array(
                        'jid' => $jid,
                        'sid' => $sid,
                        'eid' => $eid,
                        'appdate' => date('Y-m-d')
                    );
                    $this->general_model->insert('application',$data);
                    $this->session->set_flashdata('success', 'Your applicaion has been sent for this job.');
                    redirect(base_url() . 'Jobseeker/dashboard');

                }else{
                    $this->session->set_flashdata('error', $error_message);
                    redirect(base_url() . 'job/'.$empinfo->slug.'/'.$jid);
                }

            }else{
                $this->session->set_flashdata('success', 'You have already applied for this job.');
                redirect(base_url() . 'Jobseeker/dashboard');
            }

            echo 'You are logged now';
            //echo "<br><br>".$error_message;
        }else{
            $this->session->set_flashdata('error', 'You must be a registered member to apply for this job.');
            //redirect(base_url() . 'Jobseeker/login/?jobid='.$jobid);
        }
    }
    
    /*-------------------------------------------------------------
        Job Category Information with paramater Type and job Id
    -------------------------------------------------------------*/
    public function category($type,$catid){
        $data['job_list'] = '';
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

        $config['uri_segment'] = 4;
        $config['per_page'] = 25;

        $page = ($this->uri->segment(4)) ? $this->uri->segment(4) : 0;
        $config['base_url'] = base_url() . 'category/'.$type.'/'.$catid;
        
        switch ($type) {
        case 'job-category':
             $data['job_list']= $this->home_model->get_job_list_by_category('jobcategory',$catid,$config['per_page'], $page);
             $config['total_rows'] = $data['total'] =$this->home_model->get_total_job_list_by_category('jobcategory',$catid);
            break;
        case 'job-location':
             $data['job_list']= $this->home_model->get_job_list_by_category('joblocation',$catid,$config['per_page'], $page);
             $config['total_rows'] = $data['total'] =$this->home_model->get_total_job_list_by_category('joblocation',$catid);
            break;
        case 'job-type':
             $jobtype = '';
             $type = implode(' ',explode('-',$catid));
             if($type == 'Full Time') $jobtype = 'jobtype1';  
             if($type == 'Part Time') $jobtype = 'jobtype2';
             if($type == 'Contract') $jobtype = 'jobtype3';
             if($type == 'Others') $jobtype = 'jobtype4';
             $data['job_list']= $this->home_model->get_job_list_by_type($jobtype,$type,$config['per_page'], $page);
             $config['total_rows'] = $data['total'] =$this->home_model->get_total_job_list_by_type($jobtype,$type);
            break;
        case 'job-level':
             $level = implode(' ',explode('-',$catid)); 
             $data['job_list']= $this->home_model->get_job_list_by_level($level,$config['per_page'], $page);
             $config['total_rows'] = $data['total'] =$this->home_model->get_total_job_list_by_level($level);
            break;
        }

        $this->pagination->initialize($config);
        $data['menu'] = 'home';
        $data['page_title'] = '.:: Global Job :: Complete HR Solution..';
        $data['title'] ='Job List';
        $data['job_info'] = $data['job_list'];
        $data['total_job'] = $data['total'];

        $data['main'] = 'job-list';
        $this->load->view('main',$data);
    }
    
    /*---------------------------------------------------------
                    About Us Information
    ---------------------------------------------------------*/
    public function aboutus(){
        $data['menu'] = 'home';
        $data['page_title'] = 'About Us .:: Global Job :: Complete HR Solution..';
        $data['title'] ='About Us';
        $data['content'] = $this->general_model->getById('content','id','1')->contents;
        $data['main'] = 'page-view';
        $this->load->view('main',$data);
    }

    public function upload_your_video_cv(){
        $content_id = "11";
        $data['menu'] = 'home';
        $data['page_title'] = $this->general_model->getById('content','id',$content_id)->title.' .:: Global Job :: Complete HR Solution..';
        $data['title'] =$this->general_model->getById('content','id',$content_id)->title;
        $data['content'] = $this->general_model->getById('content','id',$content_id)->contents;
        $data['main'] = 'page-view';
        $this->load->view('main',$data);
    }

    public function express_your_perception(){
        $content_id = "12";
        $data['menu'] = 'home';
        $data['page_title'] = $this->general_model->getById('content','id',$content_id)->title.' .:: Global Job :: Complete HR Solution..';
        $data['title'] =$this->general_model->getById('content','id',$content_id)->title;
        $data['content'] = $this->general_model->getById('content','id',$content_id)->contents;
        $data['main'] = 'page-view';
        $this->load->view('main',$data);
    }

    public function give_your_feedbacks(){
        $content_id = "13";
        $data['menu'] = 'home';
        $data['page_title'] = $this->general_model->getById('content','id',$content_id)->title.' .:: Global Job :: Complete HR Solution..';
        $data['title'] =$this->general_model->getById('content','id',$content_id)->title;
        $data['content'] = $this->general_model->getById('content','id',$content_id)->contents;
        $data['main'] = 'page-view';
        $this->load->view('main',$data);
    }

    public function subscribe_for_video_cv(){
        $content_id = "14";
        $data['menu'] = 'home';
        $data['page_title'] = $this->general_model->getById('content','id',$content_id)->title.' .:: Global Job :: Complete HR Solution..';
        $data['title'] =$this->general_model->getById('content','id',$content_id)->title;
        $data['content'] = $this->general_model->getById('content','id',$content_id)->contents;
        $data['main'] = 'page-view';
        $this->load->view('main',$data);
    }

    public function express_employers_perception(){
        $content_id = "15";
        $data['menu'] = 'home';
        $data['page_title'] = $this->general_model->getById('content','id',$content_id)->title.' .:: Global Job :: Complete HR Solution..';
        $data['title'] =$this->general_model->getById('content','id',$content_id)->title;
        $data['content'] = $this->general_model->getById('content','id',$content_id)->contents;
        $data['main'] = 'page-view';
        $this->load->view('main',$data);
    }

    public function give_your_feedback(){
        $content_id = "13";
        $data['menu'] = 'home';
        $data['page_title'] = $this->general_model->getById('content','id',$content_id)->title.' .:: Global Job :: Complete HR Solution..';
        $data['title'] =$this->general_model->getById('content','id',$content_id)->title;
        $data['content'] = $this->general_model->getById('content','id',$content_id)->contents;
        $data['main'] = 'page-view';
        $this->load->view('main',$data);
    }
    
    /*---------------------------------------------------------
                    Feeback  Page
    ---------------------------------------------------------*/
    public function feedback(){
        $data['menu'] = 'home';
        $data['page_title'] = '.:: Global Job :: Complete HR Solution..';
        $data['title'] ='Feedback';
        $data['main'] = 'feedback-view';
        $this->load->view('main',$data);
    }

    public function submitFeedback(){
        $to = "info@searchglobaljobs.com";
        $toname = "Global Job-Complete HR Solution";
        $from = $this->input->post('email');
        $fromname = $this->input->post('name');

        /*---------------------------------------------------------------
                        Email Content Goes here
        ---------------------------------------------------------------*/
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $address = $this->input->post('address');
        $phone = $this->input->post('phone');
        $comments = $this->input->post('comments');

        // subject
        $subject = 'Industrial Expertise Post Requirement Form Info';

        $message = '';
        $message .='<table border="0" align="center" cellpadding="0" cellspacing="0">';
        $message .='<tr>';
        $message .='<td colspan="2"><h2>Feedbacks</h2></td>';
        $message .='</tr>';
        $message .='<tr>';
        $message .='<td>  Name : </td>';
        $message .='<td>'.$name.'</td>';
        $message .='</tr>';
        $message .='<tr>';
        $message .='<td> Email : </td>';
        $message .='<td>'.$email.'</td>';
        $message .='</tr>';
        $message .='<tr>';
        $message .='<td>Address : </td>';
        $message .='<td>'.$address.'</td>';
        $message .='</tr>';
        $message .='<tr>';
        $message .='<td> Phone : </td>';
        $message .='<td>'.$phone.'</td>';
        $message .='</tr>';
        $message .='<tr>';
        $message .='<td>  Comments : </td>';
        $message .='<td>'.$comments.'</td>';
        $message .='</tr>';
        $message .='</table>';

        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Additional headers
        $headers .= 'To: '.$toname.' <'.$to.'>' . "\r\n";
        $headers .= 'From: '.$fromname.' <'.$from.'>' . "\r\n";

        // Mail it
        if(@mail($to, $subject, $message, $headers))
        {
            $this->session->set_flashdata('success', 'Your information has been sent to '.$toname);
            redirect(base_url() . 'feedback');
        }
        else
        {
            $this->session->set_flashdata('error', 'ERROR! failed to send Your information.');
            redirect(base_url() . 'feedback');
        }
    }
    
    /*---------------------------------------------------------
                    Term And Condition  Page
    ---------------------------------------------------------*/
    public function termandcondition(){
        $data['menu'] = 'home';
        $data['page_title'] = '.:: Global Job :: Complete HR Solution..';
       
        $data['main'] = 'term-condition';
        $this->load->view('main',$data);
    }
    
    /*---------------------------------------------------------
                    Privacy and Policy  Page
    ---------------------------------------------------------*/
    public function privacypolicy(){
        $data['menu'] = 'home';
        $data['page_title'] = '.:: Global Job :: Complete HR Solution..';
       
        $data['main'] = 'privacy-policy';
        $this->load->view('main',$data);
    }
    
    /*---------------------------------------------------------
                        Contact Us Page
    ---------------------------------------------------------*/
    public function contactus(){
        $data['menu'] = 'contactus';
        $data['page_title'] = '.:: Global Job :: Complete HR Solution..';
        $data['title'] ='Contact Us';
        $data['content'] = $this->general_model->getById('content','id','3')->contents;
       // $data['main'] = 'contact_us';
        $this->load->view('contact_us',$data);
    }
    
    /*---------------------------------------------------------
                        Submitting Contact Us
    ---------------------------------------------------------*/
    public function submitContact(){
        $to = "info@searchglobaljobs.com";
        $toname = "Global Job-Complete HR Solution";
        $from = $this->input->post('email');
        $fromname = $this->input->post('name');

        /*---------------------------------------------------------------
                        Email Content Goes here
        ---------------------------------------------------------------*/
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $contact_message = $this->input->post('message');

        // subject
        $subject = $this->input->post('subject');

        $message = '';
        $message .='<table border="0" align="center" cellpadding="0" cellspacing="0">';
        $message .='<tr>';
        $message .='<td colspan="2"><h2>Contact Us Form</h2></td>';
        $message .='</tr>';
        $message .='<tr>';
        $message .='<td>  Name : </td>';
        $message .='<td>'.$name.'</td>';
        $message .='</tr>';
        $message .='<tr>';
        $message .='<td> Email : </td>';
        $message .='<td>'.$email.'</td>';
        $message .='</tr>';
        $message .='<tr>';
        $message .='<td>  Message : </td>';
        $message .='<td>'.$contact_message.'</td>';
        $message .='</tr>';
        $message .='</table>';

        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Additional headers
        $headers .= 'To: '.$toname.' <'.$to.'>' . "\r\n";
        $headers .= 'From: '.$fromname.' <'.$from.'>' . "\r\n";

        // Mail it
        if(@mail($to, $subject, $message, $headers))
        {
            $this->session->set_flashdata('success', 'Your information has been sent to '.$toname);
            redirect(base_url());
        }
        else
        {
            $this->session->set_flashdata('error', 'ERROR! failed to send Your information.');
            redirect(base_url());
        }
    }


    /*--------------------------------------------------------------------
        Check Job Seeker Login Credentail along with Username and Password
        Redirect Job Seeker Login Page if Error Occured
    ----------------------------------------------------------------------*/
    public function jobseekerLoginCheck(){
        $this->form_validation->set_rules('username', 'username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        if (FALSE == $this->form_validation->run()) {
            //redirect to Jobseeker login page and display error
        }else{
            $seeker_info = $this->home_model->jobseeker_login_check();
            if($seeker_info){
                // Go to Seeker Dashboard and insert seeker info in session
            }else{
                // Provided Username or Password is not matching
                //Redirect to job seeker login page and display error
            }
        }
    }

    private function _jobSeekerDetail($sid){
       $jobseeker_profile = $this->session->userdata('jobseeker_profile');
       $salutation = $this->general_model->getById('dropdown','id',$jobseeker_profile->salutation)->dropvalue;

       $jsname = $salutation." ".$jobseeker_profile->fname." ".$jobseeker_profile->mname." ".$jobseeker_profile->lname;

                $html ='';

                $html .='<table cellpadding="0" cellspacing="0" border="0" width="100%" style="font-family:Arial, Helvetica, sans-serif;">';
                $html .='<tr>';
                $html .='<td valign="top">';
                $html .='<table border="0" cellpadding="0" cellspacing="0" width="100%">';
                $html .='<tr>';
                $html .='<td style="padding-left:10px;">'.$jsname;
                $html .='<table border="0" cellpadding="0" cellspacing="0">';
                    $html .='<tr>';
                      $html .='<td width="160" class="txt">Email :</td>';
                      $html .='<td>'.$jobseeker_profile->email.'</td>';
                    $html .='</tr>';
                    $html .='<tr>';
                      $html .='<td class="txt">Secondary Email :</td>';
                      $html .='<td>'.$jobseeker_profile->email2.'</td>';
                    $html .='</tr>';
                  $html .='</table>';
                  $html .='<br />';
                  $html .='<p style="font-weight:bold;"><strong>Personal Details</strong></p>';
                  $html .='<table border="0" cellpadding="0" cellspacing="0" width="100%">';
                    $html .='<tr>';
                      $html .='<td width="160" class="txt">Date of Birth :</td>';
                      $html .='<td>'.$jobseeker_profile->mm.'-'.$jobseeker_profile->dd.'-'.$jobseeker_profile->yy.'</td>';
                      $html .='<td width="160" rowspan="8">';

                    $imagepath = base_url()."images/jobseeker/".$jobseeker_profile->picture;
                    if(isset($jobseeker_profile->picture) && file_exists($imagepath)){
                        $html .= '<img src='.$imagepath.' alt="Image" width="130"/>';
                    }

                    $html .='</td>';
                    $html .='</tr>';
                    $html .='<tr>';
                      $nationality = $this->general_model->getById('dropdown','id',$jobseeker_profile->nationality)->dropvalue;
                      $html .='<td class="txt">Nationality :</td>';
                      $html .='<td>'.$nationality.'</td>';
                      $html .='</tr>';
                    $html .='<tr>';
                      $html .='<td class="txt">Phone (Res) :</td>';
                      $html .='<td>'.$jobseeker_profile->phoneres.'</td>';
                      $html .='</tr>';
                    $html .='<tr>';
                      $html .='<td class="txt">Phone (off) :</td>';
                      $html .='<td>'.$jobseeker_profile->phoneoff.'</td>';
                    $html .='</tr>';
                    $html .='<tr>';
                      $html .='<td class="txt">Cell No. :</td>';
                      $html .='<td>'.$jobseeker_profile->phonecell.'</td>';
                      $html .='</tr>';
                    $html .='<tr>';
                      $html .='<td class="txt">Marital Status :</td>';
                      $html .='<td>'.$jobseeker_profile->maritalstatus.'</td>';
                      $html .='</tr>';
                    $html .='<tr>';
                      $html .='<td class="txt">Current Address</td>';

                      $country_name = $this->general_model->getById('country2code','country_code',$jobseeker_profile->currentcon);
                      $html .='<td>'.$jobseeker_profile->currentadd.' '.ucfirst(strtolower($country_name->country_name)).'</td>';
                      $html .='</tr>';
                    $html .='<tr>';
                      $html .='<td class="txt">Permanent Address</td>';

                    $country_name1 = $this->general_model->getById('country2code','country_code',$jobseeker_profile->permanentcon);
                    $country = ($country_name1) ? ucfirst(strtolower($country_name1->country_name)) : '';
                    $html .='<td>'.$jobseeker_profile->permanentadd.' '.$country.'</td>';
                    $html .='</table>';
                    $html .='<br />';
                  $html .='<p style="font-weight:bold;"><strong>Experience Details</strong></p>';
                  $html .='<table border="0" cellpadding="0" cellspacing="0">';
                    $html .='<tr>';
                      $html .='<td class="txt" width="160">Have work experience:</td>';
                      $html .='<td>'.$jobseeker_profile->workexp.','.$jobseeker_profile->expyrs.' years '.$jobseeker_profile->expmths.' Months </td>';
                    $html .='</tr>';
                    $html .='<tr>';
                      $html .='<td class="txt">Present Salary :</td>';
                      $html .='<td>'.$jobseeker_profile->preunit.' '.$jobseeker_profile->presal.' per month (Gross) </td>';
                    $html .='</tr>';
                    $html .='<tr>';
                      $html .='<td class="txt">Expected Salary :</td>';
                      $salary = $this->general_model->getById('dropdown','id',$jobseeker_profile->expsal);
                      $expected = ($salary) ? $salary->dropvalue : '';
                      $html .='<td>'.$jobseeker_profile->expunit.' '.$expected.' per month (Gross) </td>';
                    $html .='</tr>';
                    $html .='<tr>';
                      $html .='<td class="txt">Looking for :</td>';
                      $html .='<td>'.$jobseeker_profile->joblevel.'</td>';
                    $html .='</tr>';
                    $html .='<tr>';
                      $html .='<td class="txt">Job Type :</td>';
                      $jobType = '';
                      $jobType  = (!empty($jobseeker_profile->jobtype1)) ? $jobseeker_profile->jobtype1.',' : ' ';
                      $jobType .= (!empty($jobseeker_profile->jobtype2)) ? $jobseeker_profile->jobtype2.',' : ' ';
                      $jobType .= (!empty($jobseeker_profile->jobtype3)) ? $jobseeker_profile->jobtype3 : ' ';

                    $html .='<td>'.$jobType.'</td>';
                    $html .='</tr>';
                    $html .='<tr>';
                      $html .='<td>Job Region:</td>';
                        $jobRegion = ($jobseeker_profile->job_region > 0) ? $this->general_model->getById('dropdown','id',$jobseeker_profile->job_region)->dropvalue : ' ';
                      $html .='<td>'.$jobRegion.'</td>';
                    $html .='</tr>';
                    $html .='<tr>';
                      $html .='<td>Job Location:</td>';
                        $jobLocation = ($jobseeker_profile->joblocation > 0) ? $this->general_model->getById('dropdown','id',$jobseeker_profile->joblocation)->dropvalue : ' ';
                      $html .='<td>'.$jobLocation.'</td>';
                    $html .='</tr>';
                  $html .='</table><br />';

                  $html .='<p style="font-weight:bold;"><strong>Preferred Job Category</strong></p>';
                  $html .='<table border="0" cellpadding="0" cellspacing="0">';
                    $html .='<tr>';
                      $html .='<td colspan="2"><strong>First Job Preference:</strong></td>';
                    $html .='</tr>';
                    $html .='<tr>';
                      $html .='<td class="txt" width="160">Funtional Area :</td>';
                        $functionalArea = ($jobseeker_profile->funcarea1 > 0) ? $this->general_model->getById('dropdown','id',$jobseeker_profile->funcarea1)->dropvalue : ' ';
                      $html .='<td>'.$functionalArea.'</td>';
                    $html .='</tr>';
                    $html .='<tr>';
                      $html .='<td class="txt" valign="top">Nature of Organization :</td>';
                      $html .='<td valign="top">'.$jobseeker_profile->natureoforg1.'</td>';
                    $html .='</tr>';
                    $html .='<tr>';
                      $html .='<td colspan="2"><strong>Second Job Preference:</strong></td>';
                    $html .='</tr>';
                    $html .='<tr>';
                      $html .='<td class="txt">Funtional Area :</td>';
                        $functionalArea2 = ($jobseeker_profile->funcarea2 > 0) ? $this->general_model->getById('dropdown','id',$jobseeker_profile->funcarea2)->dropvalue : ' ';
                      $html .='<td>'.$functionalArea2.'</td>';
                    $html .='</tr>';
                    $html .='<tr>';
                      $html .='<td class="txt" valign="top">Nature of Organization :</td>';
                      $html .='<td valign="top">'.$jobseeker_profile->natureoforg2.'</td>';
                    $html .='</tr>';
                    $html .='<tr>';
                      $html .='<td colspan="2" valign="top">&nbsp;</td>';
                      $html .='</tr>';
                        if(!empty($jobseeker_profile->resume)){
                            $resume = $jobseeker_profile->resume;
                            $html .='<tr>';
                            $html .='<td class="txt" valign="top">Resume Attached</td>';
                            $html .='<td valign="top"><a href="'.base_url().'uploads/resume/'.$resume.'">Download/Open</a></td>';
                            $html .='</tr>';
                        }
                $html .='</table>';
            $html .='</td>';
              $html .='</tr>';
              $html .='<tr>';
                $html .='<td>&nbsp;</td>';
              $html .='</tr>';
              $html .='<tr>';
                $html .='<td>';
                  $html .='<table width="100%" border="0" cellspacing="0" cellpadding="0">';
                    $html .='<tr>';
                      $html .='<td valign="top" colspan="2" style="padding-left:10px;">';
                      $html .='<table border="0" cellpadding="0" cellspacing="0" width="100%">';
                      $html .='<tr>';
                        $html .='<th colspan="7">Education Background</th>';
                      $html .='</tr>';
                      $html .='<tr>';
                        $html .='<td width="5%">SN</td>';
                        $html .='<td>Degree</td>';
                        $html .='<td>Name of Degree</td>';
                        $html .='<td>Graduation Year</td>';
                        $html .='<td>Collage/ School</td>';
                        $html .='<td>Board/ University</td>';
                        $html .='<td>Percentage</td>';
                      $html .='</tr>';

                        $seekerEducation = $this->general_model->getAll('seeker_education',array('sid'=>$sid));
                        if(!empty($seekerEducation)){
                            foreach($seekerEducation as $key => $sval):
                                $edu_degree = $this->general_model->getById('dropdown','id',$sval->degree);
                                $key = $key+1;
                                $html .='<tr>';
                                $html .='<td>'.$key++.'</td>';
                                $html .='<td>'.$edu_degree->dropvalue.'</td>';
                                $html .='<td>'.$sval->faculty.'</td>';
                                $html .='<td>'.$sval->graduationyear.'</td>';
                                $html .='<td>'.$sval->instution.'</td>';
                                $html .='<td>'.$sval->board.'</td>';
                                $html .='<td>'.$sval->percentage.'</td>';
                                $html .='</tr>';
                            endforeach;
                        }else{
                            $html .='<tr>';
                            $html .='<td colspan="7" style="font-weight:bold;text-align:center;color:#FF0000;">No Information has been added</td>';
                            $html .='</tr>';
                        }

                      $html .='<tr>';
                        $html .='<td colspan="7">&nbsp;</td>';
                      $html .='</tr>';
                      $html .='</table>';
                      $html .='<br />';
                      $html .='<table border="0" cellpadding="0" cellspacing="0" width="100%">';
                      $html .='<tr>';
                        $html .='<th colspan="6">Work Experience</th>';
                      $html .='</tr>';
                      $html .='<tr>';
                        $html .='<td width="5%">SN</td>';
                        $html .='<td width="25%">Company Name</td>';
                        $html .='<td width="20%">Location</td>';
                        $html .='<td width="20%">Designation</td>';
                        $html .='<td width="13%">From</td>';
                        $html .='<td width="15%">To</td>';
                      $html .='</tr>';

                        $seekerExperience = $this->general_model->getAll('seeker_experience',array('sid'=>$sid));
                        if(!empty($seekerExperience)){
                            foreach($seekerExperience as $key => $sval):
                                $key = $key+1;
                                $html .='<tr>';
                                $html .='<td>'.$key++.'</td>';
                                $html .='<td>'.$sval->company.'</td>';
                                $html .='<td>'.$sval->empoyername.'</td>';
                                $html .='<td>'.$sval->designation.'</td>';
                                $html .='<td>'.date('M',strtotime($sval->frommonth)).' '.$sval->fromyear.'</td>';
                                $html .='<td>'.date('M',strtotime($sval->tomonth)).' '.$sval->toyear.'</td>';
                                $html .='</tr>';
                                $html .='<tr>';
                                $html .='<td>&nbsp;</td>';
                                $html .='<td>Duties and Responsibilities</td>';
                                $html .='<td colspan="4">'.$sval->duties.'</td>';
                                $html .='</tr>';
                            endforeach;
                        }else{
                            $html .='<tr>';
                            $html .='<td colspan="6" style="font-weight:bold;text-align:center;color:#FF0000;">No Information has been added</td>';
                            $html .='</tr>';
                        }

                      $html .='<tr>';
                        $html .='<td colspan="6">&nbsp;</td>';
                      $html .='</tr>';
                    $html .='</table>';
                      $html .='<br />';
                      $html .='<table border="0" cellpadding="0" cellspacing="0" width="100%">';
                      $html .='<tr>';
                        $html .='<th colspan="5">Training History</th>';
                      $html .='</tr>';
                      $html .='<tr>';
                        $html .='<td width="5%">SN</td>';
                        $html .='<td width="27%">Company / Institute Name</td>';
                        $html .='<td width="26%">Training Course</td>';
                        $html .='<td width="18%">From</td>';
                        $html .='<td width="24%">To</td>';
                      $html .='</tr>';

                        $seekerTraining = $this->general_model->getAll('seeker_training',array('sid'=>$sid));
                         if(!empty($seekerTraining)){
                            foreach($seekerTraining as $key => $sval):
                                $key = $key+1;
                                $html .='<tr>';
                                $html .='<td>'.$key++.'</td>';
                                $html .='<td>'.$sval->institution.'</td>';
                                $html .='<td>'.$sval->course.'</td>';
                                $html .='<td>'.date('M',strtotime($sval->frommonth)).' '.$sval->fromyear.'</td>';
                                $html .='<td>'.date('M',strtotime($sval->tomonth)).' '.$sval->toyear.'</td>';
                                $html .='</tr>';
                            endforeach;
                        }else{
                            $html .='<tr>';
                            $html .='<td colspan="5" style="font-weight:bold;text-align:center;color:#FF0000;">No Information has been added</td>';
                            $html .='</tr>';
                        }

                      $html .='<tr>';
                        $html .='<td colspan="5">&nbsp;</td>';
                      $html .='</tr>';
                    $html .='</table>';
                      $html .='<br />';
                      $html .='<table border="0" cellpadding="0" cellspacing="0" width="100%">';
                      $html .='<tr>';
                        $html .='<th colspan="5">Language Proficiency</th>';
                      $html .='</tr>';
                      $html .='<tr>';
                        $html .='<td width="5%">SN</td>';
                        $html .='<td>Language</td>';
                        $html .='<td>Reading</td>';
                        $html .='<td>Writing</td>';
                        $html .='<td>Speaking</td>';
                      $html .='</tr>';

                        $seekerLanguage = $this->general_model->getAll('seeker_language',array('sid'=>$sid));
                        if(!empty($seekerLanguage)){
                            foreach($seekerLanguage as $key => $sval):
                                $key = $key+1;
                                $html .='<tr>';
                                $html .='<td>'.$key++.'</td>';
                                $html .='<td>'.$sval->lang.'</td>';
                                $html .='<td>'.$sval->reading.'</td>';
                                $html .='<td>'.$sval->writing.'</td>';
                                $html .='<td>'.$sval->speaking.'</td>';
                                $html .='</tr>';
                            endforeach;
                        }else{
                            $html .='<tr>';
                            $html .='<td colspan="5" style="font-weight:bold;text-align:center;color:#FF0000;">No Information has been added</td>';
                            $html .='</tr>';
                        }

                      $html .='<tr>';
                        $html .='<td colspan="5">&nbsp;</td>';
                      $html .='</tr>';
                    $html .='</table>';
                      $html .='<br />';
                      $html .='<table cellspacing="0" cellpadding="0" width="100%">';
                      $html .='<tr>';
                        $html .='<th colspan="6">Reference</th>';
                      $html .='</tr>';

                        $seekerReference = $this->general_model->getAll('seeker_reference',array('sid'=>$sid));
                         if(!empty($seekerReference)){
                            foreach($seekerReference as $key => $refval):
                            $salutationref = $this->general_model->getById('dropdown','id',$refval->salutation);
                            $countryName = $this->general_model->getById('country2code','country_code',$refval->country);
                             $key = $key+1;
                             $saturation = ($salutationref) ? $salutationref->dropvalue : '';
                             $full_name = $refval->fname.' '.$refval->mname.' '.$refval->lname;
                                $html .='<tr>';
                                $html .='<td width="5%">SN</td>';
                                $html .='<td width="12%">Name :</td>';
                                $html .='<td colspan="4">'.$saturation.' '.$full_name.' </td>';
                              $html .='</tr>';
                              $html .='<tr>';
                                $html .='<td>'.$key++.'</td>';
                                $html .='<td>Address :</td>';
                                $html .='<td colspan="4">'.$refval->block.' '.$refval->street.' '.$refval->city.' '.ucfirst(strtolower($countryName->country_name)).'</td>';
                              $html .='</tr>';
                              $html .='<tr>';
                                $html .='<td>&nbsp;</td>';
                                $html .='<td>Home Phone </td>';
                                $html .='<td>Office Phone </td>';
                                $html .='<td>Cell No.</td>';
                                $html .='<td>Fax</td>';
                                $html .='<td>Email</td>';
                              $html .='</tr>';
                              $html .='<tr>';
                                $html .='<td>&nbsp;</td>';
                                $html .='<td>'.$refval->home.'</td>';
                                $html .='<td>'.$refval->office.'</td>';
                                $html .='<td>'.$refval->cell.'</td>';
                                $html .='<td>'.$refval->fax.'</td>';
                                $html .='<td>'.$refval->email.'</td>';
                              $html .='</tr>';
                              $html .='<tr>';
                                $html .='<td>&nbsp;</td>';
                                $html .='<td>Company Name</td>';
                                $html .='<td>Company Location</td>';
                                $html .='<td>Designation</td>';
                                $html .='<td>Relationship</td>';
                                $html .='<td>&nbsp;</td>';
                              $html .='</tr>';
                              $html .='<tr>';
                                $html .='<td>&nbsp;</td>';
                                $html .='<td>'.$refval->cname.'</td>';
                                $html .='<td>'.$refval->clocation.'</td>';
                                $html .='<td>'.$refval->designation.'</td>';
                                $html .='<td>'.$refval->relationship.'</td>';
                                $html .='<td>&nbsp;</td>';
                              $html .='</tr>';
                              $html .='<tr>';
                                $html .='<td colspan="6" style="padding-right:5px;"><hr color="#CCCCCC" /></td>';
                              $html .='</tr>';
                            endforeach;
                        }else{
                            $html .='<tr>';
                            $html .='<td colspan="6" style="font-weight:bold;text-align:center;color:#FF0000;">No Information has been added</td>';
                            $html .='</tr>';
                        }
                    $html .='</table>';
                      $html .='</td>';
                    $html .='</tr>';
                  $html .='</table>';
                $html .='</td>';
              $html .='</tr>';
            $html .='</table>';
         $html .='</td>';
        $html .='</tr>';
        $html .='</table>';

        return $html;
    }

    public function submitMessage(){
        $to = "masanjeev@gmail.com";
        $toname = "Global Job-Complete HR Solution";
        $from = $this->input->post('email');
        $fromname = $this->input->post('name');

        /*---------------------------------------------------------------
                        Email Content Goes here
        ---------------------------------------------------------------*/
        $name = $this->input->post('name');
        $email = $this->input->post('email');
        $companyname = $this->input->post('company_name');
        $phone = $this->input->post('phone');
        $message = $this->input->post('message');

        // subject
        $subject = 'Inquiry Form Info';

        $message = '';
        $message .='<table border="0" align="center" cellpadding="0" cellspacing="0">';
        $message .='<tr>';
        $message .='<td colspan="2"><h2>Inquiry</h2></td>';
        $message .='</tr>';
        $message .='<tr>';
        $message .='<td>  Name : </td>';
        $message .='<td>'.$name.'</td>';
        $message .='</tr>';
        $message .='<tr>';
        $message .='<td> Email : </td>';
        $message .='<td>'.$email.'</td>';
        $message .='</tr>';
        $message .='<tr>';
        $message .='<td>Company Name : </td>';
        $message .='<td>'.$companyname.'</td>';
        $message .='</tr>';
        $message .='<tr>';
        $message .='<td> Phone : </td>';
        $message .='<td>'.$phone.'</td>';
        $message .='</tr>';
        $message .='<tr>';
        $message .='<td>  Message : </td>';
        $message .='<td>'.$message.'</td>';
        $message .='</tr>';
        $message .='</table>';

        // To send HTML mail, the Content-type header must be set
        $headers  = 'MIME-Version: 1.0' . "\r\n";
        $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

        // Additional headers
        $headers .= 'To: '.$toname.' <'.$to.'>' . "\r\n";
        $headers .= 'From: '.$fromname.' <'.$from.'>' . "\r\n";

        // Mail it
        if(@mail($to, $subject, $message, $headers))
        {
            $this->session->set_flashdata('success2', 'Your information has been sent to '.$toname);
            redirect(base_url() . 'Employer/login');
        }
        else
        {
            $this->session->set_flashdata('error2', 'ERROR! failed to send Your information.');
            redirect(base_url() . 'Employer/login');
        }
    }
    
    public function clients(){
        $data['menu'] = 'home';
        $data['page_title'] = '.:: Global Job :: Complete HR Solution..';
        $data['client_list'] = $this->general_model->getAll('clients','','','id,clientname,image');
        
        $this->load->view('client-list',$data);
    }
    
    public function testimonial_list(){
        $data['menu'] = 'home';
        $data['page_title'] = '.:: Global Job :: Complete HR Solution..';
        $data['testimonial_list'] = $this->home_model->get_all_testimonial();
        
        $this->load->view('testimonial-list',$data);
    }
}

/* End of file Home.php
 * Location: ./application/modules/home/controllers/home.php */
