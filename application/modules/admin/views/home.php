<?php $this->load->view('admin/common/header');?>
<?php $this->load->view('admin/common/sidenav');?>
<?php $this->load->helper("view_helper"); ?>

<body class="hold-transition skin-blue sidebar-mini">
  <div class="wrapper">
    <!-- Page -->
    <?php $this->load->view('admin/common/nav');?>

    <div class="content-wrapper">
      <section class="content-header">
        <h1><i class="fa <?php echo $page_header_icone; ?>"></i> &nbsp;<?php echo $page_header;?></h1>
      </section>

      <!-- Main content -->
      <section class="content">
        <div class="row">
          <div class="col-xs-12">
           <?php $this->load->view('admin/common/flash_message'); ?>
           <?php $this->load->view($main);?>
          </div>
        </div>
         <!-- /.row -->
      </section>
       <!-- /.content -->
    </div>
     <!-- /.content-wrapper -->
     <!-- End Page -->
     <?php $this->load->view('admin/common/footer');?>

<style>
  .asterisk {
    color: red;
  }
  .green {
    color: green;
  }
  .green-bold {
    color: green;
    font-weight: bold;
  }
  .below_space{
        margin: 0 0 15px 0;
  }

  .margin-left {
    margin-left: 15px;
  }

  .pagination>.active>a {
    background-color: #00a65a !important;
}
</style>