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
						<th>Rating</th>
						<th>SPF</th>
						<th>Harga</th>
						<th>Berat</th>
						<th>Link</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
					<?php $no = 1;
              foreach($row->result() as $key => $data){?>
					<tr>
						<td><?=$no++?></td>
						<td><?=$data->namaProduk?></td>
						<td><?=$data->ratingProduk?></td>
						<td><?=$data->spf?></td>
						<td><?=$data->harga?></td>
						<td><?=$data->berat?></td>
						<td>
							<a href="<?= is_null($data->link) ? 'https://www.sociolla.com/140-skin-care' : $data->link; ?>"
								class="btn btn-primary btn-sm" target="_blank"><i class="fa fa-external-link"></i></a>
						</td>
						<td width="160px">
							<form action="<?=site_url('sunscreen/delete')?>" method="post">
								<a id="detail" class="btn btn-info btn-xs" data-toggle="modal" data-target="#modal-detail"
									data-name="<?=$data->namaProduk?>" data-price="<?=$data->harga?>" data-spf="<?=$data->spf?>"
									data-pa="<?=$data->protectionGrade?>" data-rating="<?=$data->ratingProduk?>"
									data-netto="<?=$data->berat?>" data-recommend="<?=$data->usersRecommend?>"
									data-repurchase="<?=$data->usersRepurchase?>" data-jenis="<?=$data->jenisKulit?>"
									data-asal="<?=$data->asalBrand?>" data-perusahaan="<?=$data->namaPerusahaan?>">
									<i class="fa fa-ellipsis-h"></i>
								</a>
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

<div class="modal fade" id="modal-detail">
	<div class="modal-dialog">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				</button>
				<h4 class="modal-title">Detail Sunscreen</h4>
			</div>
			<div class="modal-body table-responsive">
				<table class="table table-bordered no-margin">
					<tbody>
						<tr>
							<th width="200px">Nama Produk</th>
							<td><span id="namaProduk"></span></td>
						</tr>
						<tr>
							<th>Harga</th>
							<td>Rp. <span id="harga"></span></td>
						</tr>
						<tr>
							<th>SPF</th>
							<td><span id="spf"></span></td>
						</tr>
						<tr>
							<th>Protection Grade</th>
							<td><span id="protectionGrade"></span></td>
						</tr>
						<tr>
							<th>Rating</th>
							<td><span id="rating_produk"></span></td>
						</tr>
						<tr>
							<th>Berat</th>
							<td><span id="berat"></span></td>
						</tr>
						<tr>
						<tr>
							<th>Users Recommend</th>
							<td><span id="usersRecommend"></span> %</td>
						</tr>
						<th>Users Repurchase</th>
						<td><span id="usersRepurchase"></span> %</td>
						</tr>
						<tr>
							<th>Jenis Kulit</th>
							<td><span id="jenisKulit"></span></td>
						</tr>
						<tr>
							<th>Asal Brand</th>
							<td><span id="asalBrand"></span></td>
						</tr>
						<tr>
							<th>Nama Perusahaan</th>
							<td><span id="namaPerusahaan"></span></td>
						</tr>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>

<!-- jQuery 3 -->
<script src="<?=base_url()?>assets//bower_components/jquery/dist/jquery.min.js"></script>



<script>
	$(document).ready(function () {
		$(document).on('click', '#detail', function () {
			var name = $(this).data('name');
			var price = $(this).data('price');
			var spf = $(this).data('spf');
			var pa = $(this).data('pa');
			var rating = $(this).data('rating');
			var netto = $(this).data('netto');
			var recommend = $(this).data('recommend');
			var repurchase = $(this).data('repurchase');
			var jenis = $(this).data('jenis');
			var asal = $(this).data('asal');
			var perusahaan = $(this).data('perusahaan');

			$('#namaProduk').text(name);
			$('#harga').text(price);
			$('#spf').text(spf);
			$('#protectionGrade').text(pa);
			$('#rating_produk').text(rating);
			$('#berat').text(netto);
			$('#usersRecommend').text(recommend);
			$('#usersRepurchase').text(repurchase);
			$('#jenisKulit').text(jenis);
			$('#asalBrand').text(asal);
			$('#namaPerusahaan').text(perusahaan);

		})
	})

</script>
