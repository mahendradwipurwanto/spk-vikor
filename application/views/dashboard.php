<section class="content-header">
  <h1>
    Halaman Utama
    <small>Admin</small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="#"><i class="fa fa-dashboard"></i> Halaman Utama</a></li>
    <!-- <li><a href="#">Examples</a></li>
    <li class="active">Blank page</li> -->
  </ol>
</section>

<!-- Main content -->
<section class="content">
<!-- Small boxes (Stat box) -->
<div class="row">
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-aqua">
            <div class="inner">
              <h3><?= $row ?></h3>

              <p>Jumlah Sunscreen</p>
            </div>
            <div class="icon">
              <i class="ion ion-folder"></i>
            </div>
            <a href="<?=site_url('sunscreen')?>" class="small-box-footer">Info lebih lanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-green">
            <div class="inner">
              <h3><?= $user ?></h3>

              <p>Jumlah Pengguna</p>
            </div>
            <div class="icon">
              <i class="ion ion-person"></i>
            </div>
            <a href="<?=site_url('user')?>" class="small-box-footer">Info lebih lanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-yellow">
            <div class="inner">
              <h3><?= $jenis ?></h3>

              <p>Jumlah Data Jenis Kulit </p>
            </div>
            <div class="icon">
              <i class="ion ion-clipboard"></i>
            </div>
            <a href="<?=site_url('jenis_kulit')?>" class="small-box-footer">Info lebih lanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
        <div class="col-lg-3 col-xs-6">
          <!-- small box -->
          <div class="small-box bg-red">
            <div class="inner">
              <h3><?= $asal ?></h3>

              <p>Jumlah Data Asal Brand</p>
            </div>
            <div class="icon">
              <i class="ion ion-location"></i>
            </div>
            <a href="<?=site_url('asal_brand')?>" class="small-box-footer">Info lebih lanjut <i class="fa fa-arrow-circle-right"></i></a>
          </div>
        </div>
        <!-- ./col -->
      </div>
      <!-- /.row -->
  <!-- <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-aqua"><i class="fa fa-folder-open-o"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Jumlah Sunscreen</span>
        <span class="info-box-number"></span>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-green"><i class="fa fa-user-o"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Jumlah Pengguna</span>
        <span class="info-box-number"></span>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-yellow"><i class="fa fa-user-o"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Jumlah Pengguna</span>
        <span class="info-box-number"><?= $user ?></span>
      </div>
    </div>
  </div>
  <div class="col-md-3 col-sm-6 col-xs-12">
    <div class="info-box">
      <span class="info-box-icon bg-red"><i class="fa fa-user-o"></i></span>
      <div class="info-box-content">
        <span class="info-box-text">Jumlah Pengguna</span>
        <span class="info-box-number"><?= $user ?></span>
      </div>
    </div>
  </div> -->
</section>