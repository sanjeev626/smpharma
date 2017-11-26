
<?php //$this->load->view('includes/header');?>
<?php $this->load->helper("view_helper"); ?>

<!-- body start -->
<div class="container">
    <div class="row">
        <?php $this->load->view('admin/common/flash_message'); ?>
        <?php $this->load->view($main);?>
        <?php //$this->load->view('includes/sidebar');?>
    </div>
</div>
<!-- body end -->

<?php //$this->load->view('includes/footer');?>