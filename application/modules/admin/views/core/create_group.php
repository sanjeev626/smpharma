
           
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo lang('create_group_heading');?>
          <?php //echo lang('create_user_subheading');?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <!--<div id="infoMessage"><?php echo $message;?></div> -->
            <?php if($message){ ?>
             <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                 <?php echo $message;?>
              </div> 
             <?php } ?> 
            <?php echo form_open("admin/auth/create_group",array('class'=>'form-horizontal'));?>

              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang('create_group_name_label', 'group_name');?></label>
                  <div class="col-sm-5">
                  <?php $group_name['class'] = "form-control";
                   echo form_input($group_name);?>
                  </div>
                </div>

                 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang('create_group_desc_label', 'description');?> </label>
                  <div class="col-sm-5">
                  <?php $description['class'] = "form-control";
                   echo form_input($description);?>
                  </div>
                </div>

                               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info">Create</button>
              </div>
              <!-- /.box-footer -->
    <?php echo form_close();?>
    </div>
          </div>

