<section class="content-header">
	<h1>Hasil Rekomendasi Pemilihan Sunscreen
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?=site_url('dashboard_user')?>"><i class="fa fa-dashboard"></i> Halaman Utama</a></li>
		<li class="active">Hasil Rekomendasi Pemilihan Sunscreen</li>
	</ol>
</section>
<?php if($this->session->userdata('level') == 2 && !$perhitungan_aktif['status']):?>
<section class="p-1 px-15">
	<div class="callout callout-info" style="margin-bottom: 0!important;">
		<h4><i class="fa fa-info"></i> Perhatian:</h4>
		Anda belum memiliki perhitungan yang aktif, harap melakukan perhitungan pada menu kriteria terlebih dahulu!
	</div>
</section>
<?php endif;?>
<?php if($this->session->userdata('level') == 2 && $perhitungan_aktif['status']):?>
<section class="p-1 px-15">
	<div class="callout callout-info" style="margin-bottom: 0!important;">
		<!-- <h4><i class="fa fa-info"></i> Informasi perhitungan:</h4> -->
		<h4>Berikut hasil rekomendasi data sunscreen yang anda pilih melalui fitur kriteria :</h4>
		<div class="row">
			<div class="col-sm-12 col-md-6">
				<ul>
					<li><b>Waktu perhitungan :</b> <?= date("d F Y H:i", $perhitungan_aktif['params']->created_at);?>
					</li>
					<li><b>Total data :</b> <?= $perhitungan_aktif['params']->total_data;?></li>
				</ul>
			</div>
			<div class="col-sm-12 col-md-6">
				<ul>
					<li><b>Filter :</b>
						<ul>
							<li><b>Jenis Kulit :</b> <?= $perhitungan_aktif['params']->jenisKulit;?></li>
							<li><b>Asal Brand :</b> <?= $perhitungan_aktif['params']->asalBrand;?></li>
							<li><b>Harga :</b> <?= str_replace(',', ' - ', $perhitungan_aktif['params']->harga);?></li>
							<li><b>SPF :</b> <?= str_replace(',', ' - ', $perhitungan_aktif['params']->spf);?></li>
							<li><b>Protection Grade :</b> <?= $perhitungan_aktif['params']->protection;?></li>
						</ul>
					</li>
				</ul>
			</div>
		</div>
	</div>
</section>
<section class="content">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title fw-bold">Peringkat</h3>
		</div>
		<div class="box-body">
			<table class="table table-bordered table-hover dataTables w-100" id="sort">
				<thead class="bg-gray disabled color-palettes">
					<tr>
						<th>Peringkat</th>
						<th>Sunscreen</th>
						<th>Lihat Produk</th>
						<!-- <th><?= $ranked_results['veto']; ?></th> -->
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($ranked_results['ranked'] as $index => $row): ?>
					<?php if($no <= 10):?>
					<tr>
						<td><?= $no++; ?></td>
						<td><?= $alternatives[$row['id']]['name']; ?></td>
						<td>
							<a href="<?= $alternatives[$row['id']]['link']; ?>" class="btn btn-primary btn-sm" target="_blank"><i
									class="fa fa-external-link"></i></a>
						</td>
						<!-- <td><span class="result" data-original="<?= $row['calc']; ?>"><?= $row['calc']; ?></span></td> -->
					</tr>
					<?php endif;?>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>

</section>
<div class="floating-card">
	<button class="trigger-button"></button>
	<div class="card-content">
		<fieldset>
			<div class="btn-group-custom">
				<label class="mb-0">
					<input type="radio" class="radio-group" name="conversion" value="number" checked />
					<span>Satuan</span>
				</label>
				<label class="mb-0">
					<input type="radio" class="radio-group" name="conversion" value="percentage" />
					<span>Persen</span>
				</label>
			</div>
		</fieldset>
	</div>
</div>

<script>
	const floatingCard = document.querySelector('.floating-card');
	const triggerButton = document.querySelector('.trigger-button');

	triggerButton.addEventListener('click', () => {
		floatingCard.classList.toggle('slide-out');
	});

	function convertNumbers() {
		var results = document.querySelectorAll('.result');
		var selectedOption = document.querySelector('input[name="conversion"]:checked').value;

		results.forEach(function (result) {
			var number = parseFloat(result.dataset.original); // Retrieve original value

			if (selectedOption === 'percentage') {
				var percentage = Math.round(number * 100) + '%';
				result.textContent = percentage;
			} else {
				result.textContent = number;
			}
		});
	}

	// Attach event listener to radio buttons
	var radioButtons = document.querySelectorAll('input[name="conversion"]');
	radioButtons.forEach(function (radioButton) {
		radioButton.addEventListener('change', convertNumbers);
	});

</script>
<?php endif;?>
<?php if($this->session->userdata('level') == 1):?>
<section class="content">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title fw-bold">Peringkat</h3>
		</div>
		<div class="box-body">
			<table class="table table-bordered table-hover dataTables w-100" id="sort">
				<thead>
					<tr>
						<th>Peringkat</th>
						<th>Sunscreen</th>
						<th><?= $ranked_results['veto']; ?></th>
					</tr>
				</thead>
				<tbody>
					<?php ;$no=1; foreach ($ranked_results['ranked'] as $index => $row): ?>
					<tr>
						<td><?= $no++; ?></td>
						<td><?= $alternatives[$row['id']]['name']; ?></td>
						<td><span class="result" data-original="<?= $row['calc']; ?>"><?= $row['calc']; ?></span>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
	</div>

</section>

<script>
	const floatingCard = document.querySelector('.floating-card');
	const triggerButton = document.querySelector('.trigger-button');

	triggerButton.addEventListener('click', () => {
		floatingCard.classList.toggle('slide-out');
	});

	function convertNumbers() {
		var results = document.querySelectorAll('.result');
		var selectedOption = document.querySelector('input[name="conversion"]:checked').value;

		results.forEach(function (result) {
			var number = parseFloat(result.dataset.original); // Retrieve original value

			if (selectedOption === 'percentage') {
				var percentage = Math.round(number * 100) + '%';
				result.textContent = percentage;
			} else {
				result.textContent = number;
			}
		});
	}

	// Attach event listener to radio buttons
	var radioButtons = document.querySelectorAll('input[name="conversion"]');
	radioButtons.forEach(function (radioButton) {
		radioButton.addEventListener('change', convertNumbers);
	});

</script>
<?php endif;?>
