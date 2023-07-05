<section class="content-header">
  <h1>Data Asal Brand
  </h1>
  <ol class="breadcrumb">
    <li><a href="<?=site_url('dashboard')?>"><i class="fa fa-dashboard"></i> Halaman Utama</a></li>
    <li class="active">Data Asal Brand</li>
  </ol>
</section>

<!-- Main content -->
<section class="content">
    <div class="box">
        <div class="box-header">
            <h3 class="box-title">List data asal brand</h3>
            <div class="pull-right">
                <a href="<?=site_url('asal_brand/add')?>" class="btn btn-primary btn-flat">Tambah</a>
            </div>
        </div>
            <div class="box-body table-responsive">
                <table class="table table-bordered table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Asal Brand</th>
                            <th>Keterangan</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                <?php $no = 1;
                foreach ($row->result() as $key => $data) { ?>
                <tr>
                    <td><?=$no++?></td>
                    <td><?=$data->asalBrand?></td>
                    <td><?=$data->keterangan?></td>
                    <td width="160px">
                        <form action="<?=site_url('asal_brand/delete')?>" method="post">
                                <a href="<?=site_url('asal_brand/edit/'.$data->idAsalBrand)?>" class="btn btn-primary btn-xs">
                                <i class="fa fa-pencil"></i>
                                </a>

                                <input type="hidden" name="idAsalBrand" value="<?=$data->idAsalBrand?>">
                                <button class="btn btn-danger btn-xs">
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