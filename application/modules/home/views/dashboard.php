
<?php $this->load->view('includes/header');?>
<?php $this->load->helper("view_helper"); ?>

<!-- body start -->
<div class="container">
        <div class="row">
            <div id="login-detail">
            <?php $this->load->view('admin/common/flash_message'); ?>
            <?php
                if($sidebar == 'employer'){    
                    $this->load->view('includes/employer-dashboard-sidebar');
                }else{
                    $jobseekerInfo= $this->general_model->getById('seeker','id',$sid);
                    $this->load->view('includes/jobseeker-dashboard-sidebar');
                }
            ?>
            <?php $this->load->view($main);?>
        </div>
    </div>
</div>
<!-- body end -->

<?php $this->load->view('includes/footer');?>
