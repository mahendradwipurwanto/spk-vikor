<section class="content-header">
  <h1>Data Asal Brand
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
            <h3 class="box-title">Tambah Data Asal Brand</h3>
            <div class="pull-right">
                <a href="<?=site_url('asal_brand')?>" class="btn btn-warning btn-flat">Kembali</a>
            </div>
        </div>
        <div class="box-body">
          <div class="row">
              <div class="col-md-4 col-md-offset-4">
              <form action="" method="post">
                  <div class="form-group <?=form_error('asalBrand') ? 'has-error' : null?>">
                      <label>Asal Brand *</label>
                      <input type="hidden" name="idAsalBrand" value="<?=$row->idAsalBrand?>"> 
                      <input type="text" name="asalBrand" value="<?=$this->input->post('asalBrand') ?? $row->asalBrand;?>" class="form-control">
                      <?=form_error('asalBrand')?>
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