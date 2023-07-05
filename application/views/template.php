
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>SPK | Sunscreen</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="<?=base_url()?>assets//bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="<?=base_url()?>assets//bower_components/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="<?=base_url()?>assets//bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="<?=base_url()?>assets//bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="<?=base_url()?>assets//dist/css/AdminLTE.min.css">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="<?=base_url()?>assets//dist/css/skins/_all-skins.min.css">

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
<body class="hold-transition skin-blue sidebar-mini">
<!-- Site wrapper -->
<div class="wrapper">

  <header class="main-header">
    <!-- Logo -->
    <a href="" class="logo" style="background-color: #FF8E9E;"> 
      <!-- mini logo for sidebar mini 50x50 pixels -->
      <span class="logo-mini"><b>SPK</b></span>
      <!-- logo for regular state and mobile devices -->
      <span class="logo-lg"><b>SPK</b>Sunscreen</span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top" style="background-color: #FF8E9E;"> 
      <!-- Sidebar toggle button-->
      <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button" style="background-color: #FF8E9E;">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </a>

      
      
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
        
          <!-- User Account: style can be found in dropdown.less -->
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?=base_url()?>assets//dist/img/pelanggan.png" class="user-image" alt="User Image">
              <span class="hidden-xs"><?=ucfirst($this->fungsi->user_login()->username)?></span>
            </a>
            <ul class="dropdown-menu">
              <!-- User image -->
              <li class="user-header" style="background-color: #FF8E9E;"> 
                <img src="<?=base_url()?>assets//dist/img/pelanggan.png" class="img-circle" alt="User Image">

                <p><?=$this->fungsi->user_login()->namaLengkap?>
                  <small><?=$this->fungsi->user_login()->email?></small>
                </p>
              </li>
              <!-- Menu Footer-->
              <li class="user-footer">
              <?php if($this->fungsi->user_login()->level == 1) { ?>
                <div class="pull-left">
                  <a href="<?=site_url('myprofile_admin')?>" class="btn btn-default btn-flat">Profil</a>
                </div>
              <?php } ?>
              <?php if($this->fungsi->user_login()->level == 2) { ?>
                <div class="pull-left">
                  <a href="<?=site_url('myprofile_user')?>" class="btn btn-default btn-flat">Profil</a>
                </div>
              <?php } ?>

                <div class="pull-right">
                  <a href="<?=site_url('auth/logout')?>" class="btn btn-default btn-flat bg-red">Keluar</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>

  <!-- =============================================== -->

  <!-- Left side column. contains the sidebar -->
  <aside class="main-sidebar"> <!-- style="background-color: #FF8E9E;" -->
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="<?=base_url()?>assets//dist/img/pelanggan.png" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p><?=ucfirst($this->fungsi->user_login()->username)?></p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MENU UTAMA</li>
        <!-- NAVIGATION ADMIN -->
        <?php if($this->fungsi->user_login()->level == 1) { ?>
        <li>
          <a href="<?=site_url('dashboard')?>"> <i class="fa fa-dashboard"></i> <span>Halaman Utama</span> </a>
        </li>
        <li>
        	<a href="<?=site_url('user')?>"> <i class="fa fa-user-o"></i> <span>Data Pengguna</span> </a>
        </li>
        <li>
          <a href="<?=site_url('sunscreen')?>"> <i class="fa fa-folder-open-o"></i> <span>Data Sunscreen</span> </a>
        </li>
        <li>
          <a href="<?=site_url('jenis_kulit')?>"> <i class="fa fa-list-alt"></i> <span>Data Jenis Kulit</span> </a>
        </li>
        <li>
          <a href="<?=site_url('asal_brand')?>"> <i class="fa fa-building-o"></i> <span>Data Asal Brand</span> </a>
        </li>
        <?php } ?>

        <!--NAVIGATION USER-->
        <?php if($this->fungsi->user_login()->level == 2) { ?>
        <li>
          <a href="<?=site_url('dashboard_user')?>"> <i class="fa fa-dashboard"></i> <span>Halaman Utama</span> </a>
        </li>
        <li>
          <a href="<?=site_url('sunscreen_user')?>"> <i class="fa fa-folder-open-o"></i> <span>Data Sunscreen</span> </a>
        </li>
        <li>
          <a href="<?=site_url('kriteria')?>"> <i class="fa fa-list-alt"></i> <span>Kriteria</span> </a>
        </li>
        <li>
          <a href=""> <i class="fa fa-calculator"></i> <span>Perhitungan</span> </a>
        </li>
        <li>
          <a href=""> <i class="fa fa-thumbs-o-up"></i> <span>Rekomendasi</span> </a>
        </li>
        <li>
          <a href=""> <i class="fa fa-history"></i> <span>Riwayat</span> </a>
        </li>
        <?php } ?>
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>

  <!-- =============================================== -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
      <?php echo $contents ?>
  </div>
  <!-- /.content-wrapper -->

  <footer class="main-footer">
    <div class="pull-right hidden-xs">
      <b>Version</b> 1.1.1
    </div>
    <strong> SPK Sunscreen  <a href=""></a></strong> 
  </footer>

  <!-- Control Sidebar -->
  
  <!-- /.control-sidebar -->
  <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
  <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->

<!-- jQuery 3 -->
<script src="<?=base_url()?>assets//bower_components/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap 3.3.7 -->
<script src="<?=base_url()?>assets//bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
<!-- SlimScroll -->
<script src="<?=base_url()?>assets//bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
<!-- FastClick -->
<script src="<?=base_url()?>assets//bower_components/fastclick/lib/fastclick.js"></script>
<!-- AdminLTE App -->
<script src="<?=base_url()?>assets//dist/js/adminlte.min.js"></script>
<!-- AdminLTE for demo purposes -->
<script src="<?=base_url()?>assets//dist/js/demo.js"></script>

<script src="<?=base_url()?>assets//bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?=base_url()?>assets//bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script type="text/javascript" src="<?= base_url(); ?>assets/pluginS/sweetalert2/sweetalert2.min.js"></script>

<script>
  $(document).ready(function() {
    $('#table1').DataTable()
  })
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
 