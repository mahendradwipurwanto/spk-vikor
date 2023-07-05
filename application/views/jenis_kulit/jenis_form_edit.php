<section class="content-header">
  <h1>Data Jenis Kulit
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url('dashboard')?>"><i class="fa fa-dashboard"></i> Halaman utama</a></li>
    <li class="active">Tambah data</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">Tambah Data Jenis Kulit</h3>
            <div class="pull-right">
                <a href="<?=site_url('jenis_kulit')?>" class="btn btn-warning btn-flat">Kembali</a>
            </div>
        </div>
        <div class="box-body">
          <div class="row">
              <div class="col-md-4 col-md-offset-4">
              <form action="" method="post">
                  <div class="form-group <?=form_error('jenisKulit') ? 'has-error' : null?>">
                      <label>Jenis Kulit *</label>
                      <input type="hidden" name="idJenisKulit" value="<?=$row->idJenisKulit?>"> 
                      <input type="text" name="jenisKulit" value="<?=$this->input->post('jenisKulit') ?? $row->jenisKulit;?>" class="form-control">
                      <?=form_error('jenisKulit')?>
                  </div>
                  <div class="form-group <?=form_error('keterangan') ? 'has-error' : null?>">
                      <label>Keterangan </label>
                      <input type="text" name="keterangan" value="<?=$this->input->post('keterangan') ?? $row->keterangan;?>" class="form-control">
                      <?=form_error('keterangan')?>
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