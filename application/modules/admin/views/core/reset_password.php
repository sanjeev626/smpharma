   <!DOCTYPE html>
   <html>
   <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>.:: Global Job :: CMS Login ::.</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.6 -->
    <link rel="stylesheet" href="<?php echo base_url();?>/content_admin/bootstrap/css/bootstrap.min.css">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="<?php echo base_url();?>/content_admin/dist/css/AdminLTE.min.css">
    <!-- iCheck -->
    <link rel="stylesheet" href="<?php echo base_url();?>/content_admin/plugins/iCheck/square/blue.css">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->
</head>
<body class="hold-transition login-page">
  <div class="login-box">
   <!-- <div style="text-align: center;">
      <img src="<?php echo base_url();?>/content_admin/images/login_logo.jpg" />
    </div> -->

    <div class="login-logo">
      <img src="<?php echo base_url();?>/content_admin/images/logo.png" style="width: 300px;" />
    </div>
    <hr>
    <!-- /.login-logo -->
    <div class="login-box-body">
      <p class="login-box-msg">Use a valid username and password
        to gain access to the administration console.</p>

        <div style="text-align: center;font-size: 18px;padding-bottom: 9px;color: #0db142;font-weight: bold;">
          Adminstrator Login
        </div>
        <?php echo form_open("admin/auth/login");?>

        <?php if($message){ ?>
        <div class="alert alert-danger alert-dismissible">
          <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
          <?php echo $message;?>
        </div> 
        <?php } ?> 

        <div class="form-group has-feedback">
          <?php $identity['class'] = "form-control";
          $identity['placeholder'] = "Email/Username";
          echo form_input($identity);?>
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <?php $password['class'] = "form-control";
          $password['placeholder'] = "Password";
          echo form_input($password);?>
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>
        <div class="row">

          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <br>
      <div class="alert alert-info alert-dismissible">
        Notice: This site is meant to be accessed and used by authorized users only. If you have reached this page by other referral sites or search engines but are not the authorized user, please leave immediately. Thank you.
      </div>

      <br>
      <center>&copy; <?php echo date("Y"); ?>. All Rights Reserved.Global Job CMS.</center>
    </div>
    <!-- /.login-box-body -->
  </div>
  <!-- /.login-box -->

  <!-- jQuery 2.2.0 -->
  <script src="<?php echo base_url();?>content_admin/plugins/jQuery/jQuery-2.2.3.min.js"></script>
  <!-- Bootstrap 3.3.6 -->
  <script src="<?php echo base_url();?>content_admin/bootstrap/js/bootstrap.min.js"></script>
  <!-- iCheck -->
  <script src="<?php echo base_url();?>content_admin/plugins/iCheck/icheck.min.js"></script>
  <script>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' // optional
    });
    });
  </script>
</body>
</html>

