<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Halaman Login</title>
  <link rel="shortcut icon" href="<?= base_url(); ?>assets/vikor-logo.png">
  <meta name="description" content="SPK Sunscreen products using Vikor">

  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url()?>assets/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>assets/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/iCheck/square/blue.css">

  <link rel="stylesheet" href="<?=base_url()?>assets/plugins/sweetalert2/sweetalert2.min.css">

  <link rel="stylesheet" href="<?=base_url()?>assets/dist/css/custom.css?<?= time();?>">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition login-page">
<div class="login-box">
  <div class="login-logo">
    <b>SPK Sunscreen</b> 
  </div>
  <!-- /.login-logo -->
  <div class="login-box-body">
    <p class="login-box-msg">Sign in to start your session</p>
    <form action="<?=site_url('auth/process')?>" method="post">
      <div class="form-group has-feedback">
        <input type="text" name="username" class="form-control" placeholder="Username" required autofocus>
        <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
      </div>
      <div class="form-group has-feedback">
        <input type="password" name="password" class="form-control" placeholder="Password" required>
        <span class="glyphicon glyphicon-lock form-control-feedback"></span>
      </div>
      <div class="row">
        <div class="col-xs-8"></div>
        <div class="col-xs-4">
          <button type="submit" name="login" class="btn btn-primary btn-block btn-flat">Sign In</button>
        </div>
      </div>
    </form>
    <br>
    <a href="<?=site_url('auth/register')?>" class="text-center">Register a new membership</a>
  </div>
</div>


<!-- jQuery 3 -->
<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?=base_url()?>assets/plugins/iCheck/icheck.min.js"></script>

<script type="text/javascript" src="<?= base_url(); ?>assets/pluginS/sweetalert2/sweetalert2.min.js"></script>
<!-- <script> -->
  <!-- $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  }); -->
</script>
<!-- ALERT -->
<?php if ($this->session->flashdata('error')) { ?>
    <script>
        Swal.fire({
            text: '<?php echo $this->session->flashdata('error'); ?>',
            icon: 'info',
        })
    </script>
<?php
} ?>

<?php if ($this->session->flashdata('warning')) { ?>
    <script>
        Swal.fire({
            text: '<?php echo $this->session->flashdata('warning'); ?>',
            icon: 'warning',
        })
    </script>
<?php
} ?>

<?php if ($this->session->flashdata('success')) { ?>
    <script>
        Swal.fire({
            text: '<?php echo $this->session->flashdata('success'); ?>',
            icon: 'success',
        })
    </script>
<?php
} ?>

<?php if ($this->session->flashdata('info')) { ?>
    <script>
        Swal.fire({
            text: '<?php echo $this->session->flashdata('info'); ?>',
            icon: 'info',
        })
    </script>
<?php
} ?>

<!-- TOAST -->
<?php if ($this->session->flashdata('notif_error')) { ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'error',
            title: "<?php echo $this->session->flashdata('notif_error'); ?>"
        })
    </script>
<?php
} ?>

<?php if ($this->session->flashdata('notif_warning')) { ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 223000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'warning',
            title: "<?php echo $this->session->flashdata('notif_warning'); ?>"
        })
    </script>
<?php
} ?>

<?php if ($this->session->flashdata('notif_success')) { ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'success',
            title: "<?php echo $this->session->flashdata('notif_success'); ?>"
        })
    </script>
<?php
} ?>

<?php if ($this->session->flashdata('notif_info')) { ?>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 6000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })

        Toast.fire({
            icon: 'info',
            title: "<?php echo $this->session->flashdata('notif_info'); ?>"
        })
    </script>
<?php
} ?>

</body>
</html>
