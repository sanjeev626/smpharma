<section class="content">
      <div class="row">
        <div class="col-xs-12">
           
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo lang('deactivate_heading');?>
          <?php //echo lang('create_user_subheading');?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
            <?php echo form_open("admin/auth/deactivate/".$user->id,array('class'=>'form-horizontal'));?>

              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang('deactivate_confirm_y_label', 'confirm');?></label>
                  <div class="col-sm-5">
                  <input type="radio" name="confirm" value="yes" checked="checked" />
    <?php echo lang('deactivate_confirm_n_label', 'confirm');?>
    <input type="radio" name="confirm" value="no" />
                  </div>
                </div>
 <?php echo form_hidden($csrf); ?>
  <?php echo form_hidden(array('id'=>$user->id)); ?>


                               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info">Edit</button>
              </div>
              <!-- /.box-footer -->
    <?php echo form_close();?>
    </div></div></div></section>
          </div>

