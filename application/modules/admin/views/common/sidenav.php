<?php
$this->load->model('date_model');
$nepDate_arr = $this->date_model->eng_to_nep(date('Y'),date('m'),date('d'));
$fromNepDate = $nepDate_arr['year'].'-'.$nepDate_arr['month'].'-01';
$toNepDate = $nepDate_arr['year'].'-'.$nepDate_arr['month'].'-'.$nepDate_arr['date'];
?>
<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel" style="background-color: #fff;">
        <div class="pull-left">
          <img src="<?php echo base_url();?>/content_admin/images/logo.png" alt="S M Pharma" width="100%" class="img-responsive">
        </div>
      </div>
      <ul class="sidebar-menu">
        <li class ="<?php if($nav == 'dashboard'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/Dashboard"><i class="fa fa-home"></i><span>DASHBOARD</span></a></li>
        <li class ="<?php if($nav == 'Company'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/Company"><i class="fa fa-buysellads "></i><span>COMPANY</span></a></li>
        <li class ="<?php if($nav == 'Supplier'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/Supplier"><i class="fa fa-buysellads "></i><span>SUPPLIER/DISTRIBUTOR</span></a></li>
        <li class ="<?php if($this->uri->segment(2) == 'medicine'){ echo 'active'; } ?>"><a href="javascript:void(0);"><i class="fa fa-medkit"></i><span>MEDICINE</span></a>
          <ul class="treeview-menu">
            <li class="<?php if($this->uri->segment(2) == 'medicine'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/medicine"><i class="fa fa-circle-o"></i> List Medicine</a></li>
            <li class="<?php if($this->uri->segment(3) == 'add'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/medicine/add"><i class="fa fa-circle-o"></i> Add Medicine</a></li>
            <li class="<?php if($this->uri->segment(3) == 'merge_medicine'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/medicine/merge_medicine"><i class="fa fa-circle-o"></i> Merge Medicine</a></li>
          </ul>
        </li>
        <li class ="<?php if($this->uri->segment(2) == 'stock'){ echo 'active'; } ?>"><a href="javascript:void(0);"><i class="fa fa-edit"></i><span>STOCK</span></a>
          <ul class="treeview-menu">
            <li class="<?php if($this->uri->segment(3) == 'add'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/stock/add"><i class="fa fa-circle-o"></i> Add Stock</a></li>
            <li class="<?php if($this->uri->segment(3) == ''){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/stock"><i class="fa fa-circle-o"></i> List All</a></li>
            <li class="<?php if($this->uri->segment(3) == 'listallinvoices'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/stock/listallinvoices/<?php echo $fromNepDate;?>/<?php echo $toNepDate;?>/0"><i class="fa fa-circle-o"></i> List All Invoices</a></li>
            <li class="<?php if($this->uri->segment(3) == 'near_expiry'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/stock/near_expiry"><i class="fa fa-circle-o"></i> Near Expiry</a></li>
            <li class="<?php if($this->uri->segment(3) == 'expired'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/stock/expired"><i class="fa fa-circle-o"></i> Expired</a></li>
          </ul>
        </li>
        <li class ="<?php if($this->uri->segment(2) == 'sale'){ echo 'active'; } ?>"><a href="javascript:void(0);"><i class="fa fa-edit"></i><span>SALE</span></a>          
          <ul class="treeview-menu">
            <li class="<?php if($this->uri->segment(3) == ''){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/sale"><i class="fa fa-circle-o"></i> Add Sales</a></li>
            <li class="<?php if($this->uri->segment(3) == 'listSales'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/sale/listSales"><i class="fa fa-circle-o"></i> List Sales</a></li>
          </ul>
        </li>
        </ul>
  </section>
    <!-- /.sidebar -->
</aside>
