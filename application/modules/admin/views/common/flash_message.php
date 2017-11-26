<?php if($this->session->flashdata('success')){ ?>
        <div class="alert alert-success alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>              
                  <?php echo strtoupper($this->session->flashdata('success')); ?>
        </div>            
<?php }else if($this->session->flashdata('error')){ ?>
	      <div class="box-body">
              <div class="alert alert-danger alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                 <i class="glyphicon red glyphicon-ok tooltips"></i>
                   <?php echo strtoupper($this->session->flashdata('error')); ?>
              </div>            
        </div>
<?php } ?>