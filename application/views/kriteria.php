<section class="content-header">
	<h1>Kriteria
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?=site_url('dashboard_user')?>"><i class="fa fa-dashboard"></i> Halaman Utama</a></li>
		<li class="active">Kriteria</li>
	</ol>
</section>

<section class="content">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Kriteria Pemilihan Sunscreen</h3>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-4 col-md-offset-4">
					<form action="<?= site_url('perhitungan/hitung');?>" method="post">
						<div class="form-group">
							<label>Jenis Kulit</label>
							<select class="form-control select2" style="width: 100%;" name="jenis_kulit" required>
								<option selected="selected">-- Pilih jenis kulit anda --</option>
								<?php if(!empty($jenis_kulit)):?>
								<?php foreach($jenis_kulit as $key => $val):?>
								<option value="<?= $val->idJenisKulit;?>"><?= $val->jenisKulit;?></option>
								<?php endforeach;?>
								<?php endif;?>
							</select>
						</div>
						<div class="form-group">
							<label>Asal Brand</label>
							<select class="form-control select2" style="width: 100%;" name="asal_brand" required>
								<option selected="selected">-- Pilih asal brand --</option>
								<?php if(!empty($asal_brand)):?>
								<?php foreach($asal_brand as $key => $val):?>
								<option value="<?= $val->idAsalBrand;?>"><?= $val->asalBrand;?></option>
								<?php endforeach;?>
								<?php endif;?>
							</select>
						</div>
						<div class="form-group">
							<label>Harga</label>
							<div class="input-group">
								<span class="input-group-addon">Rp.</span>
								<input type="text" class="form-control" name="harga" placeholder="10000" min="0" required>
							</div>
						</div>
						<div class="form-group">
							<label>SPF</label>
							<input type="text" name="spf" class="form-control" min="0" required>
						</div>
						<div class="form-group">
							<label>Protection Grade</label>
							<select class="form-control select2" style="width: 100%;" name="protectionGrade" required>
								<option selected="selected">-- Pilih protection grade --</option>
								<option value="Tidak ada">Tidak ada</option>
								<option value="PA+">PA+</option>
								<option value="PA++">PA++</option>
								<option value="PA+++">PA+++</option>
								<option value="PA++++">PA++++</option>
							</select>
						</div>
						<div class="form-group">
							<button type="submit" class="btn btn-success btn-block btn-flat">Proses</button>
						</div>
					</form>
				</div>
			</div>

		</div>

	</div>

</section>
