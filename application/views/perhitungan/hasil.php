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
		<h4><i class="fa fa-info"></i> Informasi perhitungan:</h4>
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
			<h3 class="box-title fw-bold">6. Sorting</h3>
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
			<h3 class="box-title fw-bold">1. Matrix</h3>
		</div>
		<div class="box-body">
			<table class="table table-bordered table-hover dataTables w-100" id="matrix">
				<thead>
					<tr>
						<th>No</th>
						<th>Sunscreen</th>
						<?php foreach ($criteria_weights as $value): ?>
						<td><?= $value['name']; ?></td>
						<?php endforeach; ?>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($matrix as $index => $row): ?>
					<tr>
						<td><?= $no++; ?></td>
						<?php foreach ($row as $value): ?>
						<td><?= $value; ?></td>
						<?php endforeach; ?>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title fw-bold">2. Perhitungan Benefit and Cost</h3>
		</div>
		<div class="box-body">
			<table class="table table-bordered table-hover dataTables w-100" id="benefit-cost">
				<thead>
					<tr>
						<th>No</th>
						<th>Sunscreen</th>
						<?php foreach ($criteria_weights as $value): ?>
						<td><?= $value['name']; ?></td>
						<?php endforeach; ?>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($benefit_cost as $index => $row): ?>
					<tr>
						<td><?= $no++; ?></td>
						<td><?= $alternatives[$index]['name']; ?></td>
						<?php foreach ($row as $value): ?>
						<td><span class="result" data-original="<?= $value['calc']; ?>"><?= $value['calc']; ?></span>
						</td>
						<?php endforeach; ?>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title fw-bold">3. Normalisasi Bobot (n*b)</h3>
		</div>
		<div class="box-body">
			<table class="table table-bordered table-hover dataTables w-100" id="bobot">
				<thead>
					<tr>
						<th>No</th>
						<th>Sunscreen</th>
						<?php foreach ($criteria_weights as $value): ?>
						<td><?= $value['name']; ?></td>
						<?php endforeach; ?>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($normalized_weights as $index => $row): ?>
					<tr>
						<td><?= $no++; ?></td>
						<td><?= $alternatives[$index]['name']; ?></td>
						<?php foreach ($row as $value): ?>
						<td><span class="result" data-original="<?= $value['calc']; ?>"><?= $value['calc']; ?></span>
						</td>
						<?php endforeach; ?>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title fw-bold">4. Menentukan Si dan Ri</h3>
		</div>
		<div class="box-body">
			<table class="table table-bordered table-hover dataTables w-100" id="si-ri">
				<thead>
					<tr>
						<th colspan="2">Max</th>
						<th><span class="result"
								data-original="<?= round($si_ri['si_max'], 2); ?>"><?= round($si_ri['si_max'], 2)?></span>
						</th>
						<th><span class="result"
								data-original="<?= round($si_ri['ri_max'], 2); ?>"><?= round($si_ri['ri_max'], 2)?></span>
						</th>
					</tr>
					<tr>
						<th colspan="2">Min</th>
						<th><span class="result"
								data-original="<?= round($si_ri['si_min'], 2); ?>"><?= round($si_ri['si_min'], 2)?></span>
						</th>
						<th><span class="result"
								data-original="<?= round($si_ri['ri_min'], 2); ?>"><?= round($si_ri['ri_min'], 2)?></span>
						</th>
					</tr>
					<tr>
						<th>No</th>
						<th>Sunscreen</th>
						<th>Si</th>
						<th>Ri</th>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($si_ri['si_ri'] as $index => $row): ?>
					<tr>
						<td><?= $no++; ?></td>
						<td><?= $alternatives[$index]['name']; ?></td>
						<td><span class="result"
								data-original="<?= round($row['si'], 2); ?>"><?= round($row['si'], 2); ?></span>
						</td>
						<td><span class="result"
								data-original="<?= round($row['ri'], 2); ?>"><?= round($row['ri'], 2); ?></span>
						</td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title fw-bold">5. Hasil perhitungan vikor sesuai nilai veto(v)</h3>
		</div>
		<div class="box-body">
			<table class="table table-bordered table-hover dataTables w-100" id="veto">
				<thead>
					<tr>
						<th>No</th>
						<th>Sunscreen</th>
						<?php foreach ($veto as $value): ?>
						<th><?= $value; ?></th>
						<?php endforeach; ?>
					</tr>
				</thead>
				<tbody>
					<?php $no=1; foreach ($matrix as $index => $row): ?>
					<tr>
						<td><?= $no++; ?></td>
						<td><?= $alternatives[$index]['name']; ?></td>
						<?php foreach ($veto as $key => $val): ?>
						<td><span class="result"
								data-original="<?= $vikor_result[$key][$index]['calc']; ?>"><?= $vikor_result[$key][$index]['calc']; ?></span>
						</td>
						<?php endforeach; ?>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<hr>
		<div class="box-header">
			<h3 class="box-title fw-bold">6. Sorting</h3>
		</div>
		<div class="box-body">
			<table class="table table-bordered table-hover dataTables w-100" id="sort">
				<thead>
					<tr>
						<th>Peringkat</th>
						<th>Sunscreen</th>
						<th><?= $val; ?></th>
					</tr>
				</thead>
				<tbody>
					<?php ;$no=1; foreach ($ranked_results as $index => $row): ?>
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
		<hr>
		<div class="box-header">
			<h3 class="box-title fw-bold">7. Menentukan Acceptable Advantage</h3>
		</div>
		<div class="box-body">
			<table class="table table-bordered table-hover dataTables w-100" id="acceptable">
				<thead>
					<tr>
						<th>No</th>
						<th>DQ</th>
						<th><?= $acceptable_advantage['dq']; ?></th>
					</tr>
				</thead>
				<tbody>
					<?php $no= 1;foreach ($acceptable_advantage['v'] as $key => $val): ?>
					<tr class="<?= $val['acceptable'] == true ? 'bg-danger' : '' ;?>">
						<td><?= $no++?></td>
						<td><?= $val['key']?></td>
						<td><span class="result" data-original="<?= $val['value']; ?>"><?= $val['value']; ?></span></td>
					</tr>
					<?php endforeach; ?>
				</tbody>
			</table>
		</div>
		<hr>
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
