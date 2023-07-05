
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Halaman Registrasi</title>
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

  <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
  <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
  <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>
<body class="hold-transition register-page">
<div class="register-box">
  <div class="register-logo">
    <a href="<?=base_url()?>assets/index2.html"><b>Admin</b>LTE</a>
  </div>

  <div class="register-box-body">

    <form action="" method="post">
      <div class="form-group <?=form_error('fullname') ? 'has-error' : null?>">
        <input type="text" class="form-control" id="fullname" name="fullname" 
        value="<?=set_value('fullname')?>" placeholder="Nama Lengkap">
        <?=form_error('fullname')?>
      </div>
      <div class="form-group <?=form_error('username') ? 'has-error' : null?>">
        <input type="text" class="form-control" id="username" name="username" 
        value="<?=set_value('username')?>" placeholder="Username">
        <?=form_error('username')?>
      </div>
      <div class="form-group <?=form_error('password') ? 'has-error' : null?>">
        <input type="password" class="form-control" id="password" name="password" 
        placeholder="Password">
        <?=form_error('password')?>
      </div>
      <div class="form-group <?=form_error('passconf') ? 'has-error' : null?>">
        <input type="password" class="form-control" id="passconf" name="passconf" 
        placeholder="Retype password">
        <?=form_error('passconf')?>
      </div>
      <div class="form-group <?=form_error('email') ? 'has-error' : null?>">
        <input type="email" class="form-control" id="email" name="email" 
        value="<?=set_value('email')?>" placeholder="Email">
        <?=form_error('email')?>
      </div>
      <div class="form-group">
          <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
        </div>
    </form>

    <a href="<?=site_url('auth/login')?>" class="text-center">Saya sudah memiliki akun</a>
  </div>
  <!-- /.form-box -->
</div>
<!-- /.register-box -->

<!-- jQuery 3 -->
<script src="<?=base_url()?>assets/bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>assets/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- iCheck -->
<script src="<?=base_url()?>assets/plugins/iCheck/icheck.min.js"></script>

<script type="text/javascript" src="<?= base_url(); ?>assets/pluginS/sweetalert2/sweetalert2.min.js"></script>
<script>
  $(function () {
    $('input').iCheck({
      checkboxClass: 'icheckbox_square-blue',
      radioClass: 'iradio_square-blue',
      increaseArea: '20%' /* optional */
    });
  });
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
            timer: 3000,
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
