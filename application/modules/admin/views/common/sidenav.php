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
        <li class ="<?php if($nav == 'medicine'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/medicine"><i class="fa fa-medkit"></i><span>MEDICINE</span></a></li>
        <li class ="<?php if($this->uri->segment(2) == 'stock'){ echo 'active'; } ?>"><a href="javascript:void(0);"><i class="fa fa-edit"></i><span>STOCK</span></a>
          <ul class="treeview-menu">
            <li class="<?php if($this->uri->segment(3) == ''){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/stock"><i class="fa fa-circle-o"></i> All</a></li>
            <li class="<?php if($this->uri->segment(3) == 'near_expiry'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/stock/near_expiry"><i class="fa fa-circle-o"></i> Near Expiry</a></li>
            <li class="<?php if($this->uri->segment(3) == 'expired'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/stock/expired"><i class="fa fa-circle-o"></i> Expired</a></li>
          </ul>
        </li>
        <li class ="<?php if($nav == 'stock'){ echo 'active'; } ?>"><a href="<?php echo base_url(); ?>admin/sale"><i class="fa fa-edit"></i><span>SALE</span></a></li>
        </ul>
  </section>
    <!-- /.sidebar -->
</aside>
