<section class="content-header">
  <h1>Data Jenis Kulit
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url('dashboard')?>"><i class="fa fa-dashboard"></i> Halaman Utama</a></li>
    <li class="active">Data Jenis Kulit</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">List Data Jenis Kulit</h3>
            <div class="pull-right">
                <a href="<?=site_url('jenis_kulit/add')?>" class="btn btn-primary btn-flat">Tambah</a>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Jenis Kulit</th>
                        <th>Keterangan</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1;
                foreach ($row->result() as $key => $data) { ?>
                <tr>
                    <td><?=$no++?></td>
                    <td><?=$data->jenisKulit?></td>
                    <td><?=$data->keterangan?></td>
                    <td width="160px">
                        <form action="<?=site_url('jenis_kulit/delete')?>" method="post">
                                <a href="<?=site_url('jenis_kulit/edit/' .$data->idJenisKulit)?>" class="btn btn-primary btn-xs">
                                <i class="fa fa-pencil"></i>
                                </a>

                                <input type="hidden" name="idJenisKulit" value="<?=$data->idJenisKulit?>">
                                <button onclick="return confirm('Apakah anda yakin menghapus data ini?')" class="btn btn-danger btn-xs">
                                    <i class="fa fa-trash"></i>
                                </button>
                          </form>
                    </td>
                </tr>
                <?php
                } ?>
                </tbody>
            </table>
        </div>
    </div>    
</section>
