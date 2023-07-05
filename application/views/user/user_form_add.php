<section class="content-header">
  <h1>Data Pengguna
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url('dashboard')?>"><i class="fa fa-dashboard"></i> Halaman Utama</a></li>
    <li class="active">Data Pengguna</li>
  </ol>
</section> 

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Tambah Data Pengguna</h3>
            <div class="pull-right">
                <a href="<?=site_url('user')?>" class="btn btn-warning btn-flat">Kembali</a>
            </div>
        </div>
        <div class="box-body">
          <div class="row">
              <div class="col-md-4 col-md-offset-4">
                  <?php // echo validation_errors();?>
                  <form action="" method="post">
                      <div class="form-group <?=form_error('fullname') ? 'has-error' : null?>">
                          <label>Nama Lengkap *</label>
                          <input type="text" name="fullname" value="<?=set_value('fullname')?>" class="form-control">
                          <?=form_error('fullname')?>
                      </div>
                      <div class="form-group <?=form_error('username') ? 'has-error' : null?>">
                          <label>Username *</label>
                          <input type="text" name="username" value="<?=set_value('username')?>" class="form-control">
                          <?=form_error('username')?>
                      </div>
                      <div class="form-group <?=form_error('password') ? 'has-error' : null?>">
                          <label>Password *</label>
                          <input type="password" name="password" value="<?=set_value('password')?>" class="form-control">
                          <?=form_error('password')?>
                      </div>
                      <div class="form-group <?=form_error('passconf') ? 'has-error' : null?>">
                          <label>Konfirmasi Password *</label>
                          <input type="password" name="passconf" value="<?=set_value('passconf')?>" class="form-control">
                          <?=form_error('passconf')?>
                      </div>
                      <div class="form-group <?=form_error('email') ? 'has-error' : null?>">
                          <label>Email *</label>
                          <input type="email" name="email" value="<?=set_value('email')?>" class="form-control">
                          <?=form_error('email')?>
                      </div>
                      <div class="form-group">
                          <label>Jenis Kelamin *</label>
                          <select name="gender" class="form-control">
                                <option value="">- Pilih -</option>
                                <option value="Laki-laki" <?=set_value('gender') == 'Laki-laki' ? "selected" : null?>>Laki-laki</option>
                                <option value="Perempuan" <?=set_value('gender') == 'Perempuan' ? "selected" : null?>>Perempuan</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <label>Level *</label>
                          <select name="level" class="form-control">
                                <option value="">- Pilih -</option>
                                <option value="1" <?=set_value('level') == 1 ? "selected" : null?>>Admin</option>
                                <option value="2" <?=set_value('level') == 2 ? "selected" : null?>>User</option>
                          </select>
                      </div>
                      <div class="form-group">
                          <button type="submit" class="btn btn-success btn-flat">Simpan</button>
                          <button type="reset" class="btn btn-danger btn-flat">Hapus</button>
                      </div>
                  </form>
              </div>
          </div>
        </div>
    </div>
</section>