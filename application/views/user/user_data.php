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
            <h3 class="box-title">List Data Pengguna</h3>
            <div class="pull-right">
                <a href="<?=site_url('user/add')?>" class="btn btn-primary btn-flat">Tambah</a>
            </div>
        </div>
        <div class="box-body table-responsive">
            <table class="table table-bordered table-striped" id="table1">
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th>Email</th>
                        <th>Jenis Kelamin</th>
                        <th>Level</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $no = 1;
                    foreach($row->result() as $key => $data) { ?>
                    <tr>
                        <td><?=$no++?></td>
                        <td><?=$data->namaLengkap?></td>
                        <td><?=$data->username?></td>
                        <td><?=$data->email?></td>
                        <td><?=$data->jenisKelamin?></td>
                        <td><?=$data->level == 1 ? "Admin" : "User"?></td>
                        <td width="160px">
                            <form action="<?=site_url('user/delete')?>" method="post">
                                <a href="<?=site_url('user/edit/'.$data->idUser)?>" class="btn btn-primary btn-xs">
                                <i class="fa fa-pencil"></i>
                                </a>
                        
                                <input type="hidden" name="idUser" value="<?=$data->idUser?>">
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