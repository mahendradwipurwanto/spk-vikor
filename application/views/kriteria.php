<section class="content-header">
	<h1>Kriteria
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?= site_url('dashboard_user') ?>"><i class="fa fa-dashboard"></i> Halaman Utama</a></li>
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
					<form id="myForm" action="<?= site_url('perhitungan/hitung'); ?>" method="post">
						<div class="form-group">
							<label>Jenis Kulit</label>
							<select class="form-control select2" style="width: 100%;" name="jenis_kulit" required>
								<option value="0">-- Pilih jenis kulit anda --</option>
								<?php if (!empty($jenis_kulit)) : ?>
									<?php foreach ($jenis_kulit as $key => $val) : ?>
										<?php if ($val->idJenisKulit > 1) : ?>
											<option value="<?= $val->idJenisKulit; ?>"><?= $val->jenisKulit; ?></option>
										<?php endif; ?>
									<?php endforeach; ?>
								<?php endif; ?>
							</select>
						</div>
						<div class="form-group">
							<label>Asal Brand</label>
							<select class="form-control select2" style="width: 100%;" name="asal_brand" required>
								<option value="0">-- Pilih asal brand --</option>
								<?php if (!empty($asal_brand)) : ?>
									<?php foreach ($asal_brand as $key => $val) : ?>
										<option value="<?= $val->idAsalBrand; ?>"><?= $val->asalBrand; ?></option>
									<?php endforeach; ?>
								<?php endif; ?>
							</select>
						</div>
						<div class="form-group">
							<label>Harga</label>
							<select class="form-control select2" style="width: 100%;" name="harga" required>
								<option value="0">-- Pilih rentang harga --</option>
								<option value="0,100000">0 - 100k</option>
								<option value="100000,200000">100k - 200k</option>
								<option value="200000,300000">200k - 300k</option>
								<option value="300000,400000">300k - 400k</option>
								<option value="400000">> 400k</option>
							</select>
						</div>
						<div class="form-group">
							<label>SPF</label>
							<select class="form-control select2" style="width: 100%;" name="spf" required>
								<option value="0">-- Pilih rentang harga --</option>
								<option value="0,50">0 - 50</option>
								<option value="51,100">51 - 100</option>
							</select>
						</div>
						<div class="form-group">
							<label>Protection Grade</label>
							<select class="form-control select2" style="width: 100%;" name="protectionGrade" required>
								<option value="0">-- Pilih protection grade --</option>
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
<script>
	document.getElementById("myForm").addEventListener("submit", function(event) {
		// Prevent form submission
		event.preventDefault();

		// Get all select elements
		var selects = document.getElementsByTagName("select");

		// Flag to track if any select has value 0
		var hasZeroValue = false;

		// Check each select element
		for (var i = 0; i < selects.length; i++) {
			if (selects[i].value === "0") {
				hasZeroValue = true;
				break;
			}
		}

		// Display SweetAlert2 toast if any select has value 0
		if (hasZeroValue) {
			Swal.fire({
				icon: 'warning',
				title: 'Harap pilih semua kriteria!',
				toast: true,
				position: 'top-end',
				showConfirmButton: false,
				timer: 3000
			});
		} else {
			// Continue with form submission
			event.target.submit();
		}
	});
</script>