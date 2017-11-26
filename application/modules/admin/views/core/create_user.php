
<div class="box box-info">
            <div class="box-header with-border">
              <h3 class="box-title"><?php echo lang('create_user_heading');?>
          <?php //echo lang('create_user_subheading');?></h3>
            </div>
            <!-- /.box-header -->
            <!-- form start -->
           <!-- <div id="infoMessage"><?php echo $message;?></div> -->
           <?php if($message){ ?>
             <div class="alert alert-info alert-dismissible">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                 <?php echo $message;?>
              </div> 
             <?php } ?> 
              
            <?php echo form_open("admin/auth/create_user",array('class'=>'form-horizontal'));?>

              <div class="box-body">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang('create_user_fname_label', 'first_name');?> </label>
                  <div class="col-sm-5">
                  <?php $first_name['class'] = "form-control";
                   echo form_input($first_name);?>
                  </div>
                </div>

                 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang('create_user_lname_label', 'last_name');?> </label>
                  <div class="col-sm-5">
                  <?php $last_name['class'] = "form-control";
                   echo form_input($last_name);?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang('create_user_company_label', 'company');?> </label>
                  <div class="col-sm-5">
                  <?php $company['class'] = "form-control";
                   echo form_input($company);?>
                  </div>
                </div>

                 <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang('create_user_email_label', 'email');?></label>
                  <div class="col-sm-5">
                  <?php $email['class'] = "form-control";
                   echo form_input($email);?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang('create_user_phone_label', 'phone');?> </label>
                  <div class="col-sm-5">
                  <?php $phone['class'] = "form-control";
                   echo form_input($phone);?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang('create_user_password_label', 'password');?> </label>
                  <div class="col-sm-5">
                  <?php $password['class'] = "form-control";
                   echo form_input($password);?>
                  </div>
                </div>

                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-2 control-label"><?php echo lang('create_user_password_confirm_label', 'password_confirm');?> </label>
                  <div class="col-sm-5">
                  <?php $password_confirm['class'] = "form-control";
                   echo form_input($password_confirm);?>
                  </div>
                </div>

                
                
               
              </div>
              <!-- /.box-body -->
              <div class="box-footer">
                <button type="submit" class="btn btn-info">Create</button>
                <?php echo form_close();?>
              </div></div>
              <!-- /.box-footer -->
    
          </div>

