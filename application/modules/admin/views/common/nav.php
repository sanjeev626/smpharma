  <header class="main-header">
    <!-- Logo -->
    <a href="<?php echo site_url('admin/dashboard');?>" class="logo">
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>C</b>MS</span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>Control</b> Panel</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <!-- Messages: style can be found in dropdown.less-->
          <li class="dropdown messages-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              My Account
              <span class="caret"></span>
            </a>
            <ul class="dropdown-menu">
              <li>
                <ul class="menu">
                  <li>
                  <a href="<?php echo base_url().'admin/auth/edit_user/'.$this->ion_auth->user()->row()->id; ?>"><h4>
                  <i class="glyphicon glyphicon-cog"></i> &nbsp;Account Settings</h4></a>                    
                  </li>
                  <li><a href="<?php echo base_url(); ?>admin/auth/logout"><h4><i class="glyphicon glyphicon-log-out"></i> &nbsp;Log Out</h4></a></li>  
                </ul>
              </li>
            </ul>
          </li>  
        </ul>
      </div>
    </nav>
  </header>