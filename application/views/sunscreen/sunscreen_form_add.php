<section class="content-header">
  <h1>Data Sunscreen
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url('dashboard')?>"><i class="fa fa-dashboard"></i> Halaman Utama</a></li>
    <li class="active">Data Sunscreen</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title"><?=ucfirst($page)?> Sunscreen</h3>
            <div class="pull-right">
                <a href="<?=site_url('sunscreen')?>" class="btn btn-warning btn-flat">Kembali</a>
            </div>
        </div>
        <div class="box-body">
          <div class="row">
              <div class="col-md-4 col-md-offset-4">
                  <?php // echo validation_errors();?>
                  <form action="<?=site_url('sunscreen/process')?>" method="post">
                      <div class="form-group">
                          <label>Nama Produk *</label>
                          <input type="hidden" name="id" value="<?=$row->idSunscreen?>">
                          <input type="text" name="nameProduct" value="<?=$row->namaProduk?>" class="form-control" required>
                      </div>
                      <div class="form-group">
                          <label>Harga Produk *</label>
                          <input type="number" name="price" value="<?=$row->harga?>" class="form-control" required>
                      </div>
                      <div class="form-group">
                          <label>SPF *</label>
                          <input type="number" name="spf" value="<?=$row->spf?>" class="form-control" required>
                      </div>
                      <div class="form-group">
                          <label>Proteksi UVA *</label>
                          <input type="text" name="protectionGrade" value="<?=$row->protectionGrade?>" class="form-control" required>
                      </div>
                      <div class="form-group">
                          <label>Rating Produk *</label>
                          <input type="number" name="rating" value="<?=$row->ratingProduk?>" class="form-control" step="0.01"  required>
                      </div>
                      <div class="form-group">
                          <label>Berat Produk *</label>
                          <input type="number" name="netto" value="<?=$row->berat?>" class="form-control" required>
                      </div>
                      <div class="form-group">
                          <label>Persentase Users Recommend *</label>
                          <input type="number" name="recommend" value="<?=$row->usersRecommend?>" class="form-control" required>
                      </div>
                      <div class="form-group">
                          <label>Persentase Users Repurchase *</label>
                          <input type="number" name="repurchase" value="<?=$row->usersRepurchase?>" class="form-control" required>
                      </div>
                      <div class="form-group">
                          <label>Cocok Untuk Jenis Kulit *</label>
                          <select name="jenis" class="form-control">
                                <option value="">- Pilih -</option>
                                <?php foreach($jenis->result() as $key => $data) { ?>
                                <option value="<?=$data->idJenisKulit?>" <?=$data->idJenisKulit == $row->idJenisKulit? "selected" : null?>><?=$data->jenisKulit?></option>
                                <?php } ?>
                          </select>
                      </div>
                      <div class="form-group">
                          <label>Asal Brand *</label>
                          <select name="asal" class="form-control">
                                <option value="">- Pilih -</option>
                                <?php foreach($asal->result() as $key => $data) { ?>
                                <option value="<?=$data->idAsalBrand?>" <?=$data->idAsalBrand == $row->idAsalBrand? "selected" : null?>><?=$data->asalBrand?></option>
                                <?php } ?>
                          </select>
                      </div>
                      <div class="form-group">
                          <label>Nama Perusahaan</label>
                          <input type="text" name="nameCompany" value="<?=$row->namaPerusahaan?>" class="form-control">
                      </div>
                      <div class="form-group">
                          <label>Link Gambar</label>
                          <input type="text" name="link" value="<?=$row->gambar?>" class="form-control">
                      </div>
                      <div class="form-group">
                          <button type="submit" name="<?=$page?>" class="btn btn-success btn-flat">Simpan</button>
                          <button type="reset" class="btn btn-danger btn-flat">Hapus</button>
                      </div>
                  </form>

              </div>
          </div>
        </div>
    </div>
</section>