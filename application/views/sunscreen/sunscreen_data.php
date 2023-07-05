<section class="content-header">
  <h1>Data Sunscreen
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url('dashboard')?>"><i class="fa fa-dashboard"></i> Halaman Utama</a></li>
    <li class="active">Data Sunscreen</li>
  </ol>
</section>

<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">List Data Sunscreen</h3>
            <div class="pull-right">
                <a href="<?=site_url('sunscreen/add')?>" class="btn btn-primary btn-flat">Tambah</a>
            </div>
        </div>
        <div class="box-body table-responsive">
          <table class="table table-bordered table-striped" id="table1">
            <thead>
              <tr>
                <th>No</th>
                <th>Nama</th>
                <th>SPF</th>
                <th>Harga</th>
                <th>Aksi</th>
              </tr>
            </thead>
            <tbody>
              <?php $no = 1;
              foreach($row->result() as $key => $data){?>
              <tr>
                <td><?=$no++?></td>
                <td><?=$data->namaProduk?></td>
                <td><?=$data->spf?></td>
                <td><?=$data->harga?></td>
                <td width="160px">
                  <form action="<?=site_url('sunscreen/delete')?>" method="post">
                    <a href="<?=site_url('sunscreen/edit/'. $data->idSunscreen)?>" class="btn btn-primary btn-xs">
                      <i class="fa fa-pencil"></i>
                    </a>
                    <input type="hidden" name="idSunscreen" value="<?=$data->idSunscreen?>">
                        <button onclick="return confirm('Apakah anda yakin menghapus data ini?')" class="btn btn-danger btn-xs">
                            <i class="fa fa-trash"></i>
                        </button>
                  </form>
                </td>
              </tr>
              <?php
              }?>
            </tbody>

          </table>
        </div>
</section>