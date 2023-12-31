<section class="content-header">
  <h1>Profil Saya
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url('dashboard')?>"><i class="fa fa-dashboard"></i> Halaman Utama</a></li>
    <li class="active">Profil Saya</li>
  </ol>
</section> 

<section class="content">

      <div class="row">
        <div class="col-md-3">

          <!-- Profile Image -->
          <div class="box box-primary">
            <div class="box-body box-profile">
              <img class="profile-user-img img-responsive img-circle" src="<?=base_url()?>assets//dist/img/pelanggan.png"  alt="User profile picture">

              <h3 class="profile-username text-center"><?=$this->fungsi->user_login()->namaLengkap?></h3>

              <p class="text-muted text-center"><?=$this->fungsi->user_login()->email?></p>

              <ul class="list-group list-group-unbordered">
                <li class="list-group-item">
                  <b>Username</b> <a class="pull-right"><?=$this->fungsi->user_login()->username?></a>
                </li>
                <li class="list-group-item">
                  <b>Jenis Kelamin</b> <a class="pull-right"><?=$this->fungsi->user_login()->jenisKelamin?></a>
                </li>
              </ul>
              <!-- <a href="#" class="btn btn-primary btn-block"><b>Follow</b></a> -->
            </div>
            <!-- /.box-body -->
          </div>
          <!-- /.box -->

        </div>
        <!-- /.col -->
        <div class="col-md-9">
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <!-- <li class=""><a href="#activity" data-toggle="tab" aria-expanded="false">Activity</a></li>
              <li class=""><a href="#timeline" data-toggle="tab" aria-expanded="false">Timeline</a></li> -->
              <li class="active"><a href="#settings" >Edit Profil</a></li>
            </ul>
            <div class="tab-content">

              <div class="tab-pane active" id="settings">
                <form class="form-horizontal">
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Nama Lengkap</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputName">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Username</label>
                    <div class="col-sm-10">
                      <input type="text" class="form-control" id="inputEmail">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputName" class="col-sm-2 control-label">Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputName">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Ulangi Password</label>
                    <div class="col-sm-10">
                      <input type="password" class="form-control" id="inputEmail">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Email</label>
                    <div class="col-sm-10">
                      <input type="email" class="form-control" id="inputEmail">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="inputEmail" class="col-sm-2 control-label">Jenis Kelamin</label>
                    <div class="col-sm-10">
                    <select name="gender" class="form-control">
                          <?php $gender = $this->input->post('gender') ? $this->input->post('gender') : $row->jenisKelamin ?>
                          <option value="Laki-laki">Laki-laki</option>
                          <option value="Perempuan" <?=$gender == 'Perempuan' ? "selected" : null?>>Perempuan</option>
                    </select>
                    </div>
                  </div>
                  <div class="form-group">
                    <div class="col-sm-offset-2 col-sm-10">
                      <button type="submit" class="btn btn-success">Submit</button>
                    </div>
                  </div>
                </form>
              </div>
              <!-- /.tab-pane -->
            </div>
            <!-- /.tab-content -->
          </div>
          <!-- /.nav-tabs-custom -->
        </div>
        <!-- /.col -->
      </div>
      <!-- /.row -->

    </section>