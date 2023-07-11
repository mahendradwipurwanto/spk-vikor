<section class="content-header">
	<h1>Kriteria
	</h1>
	<ol class="breadcrumb">
		<li><a href="<?=site_url('dashboard_user')?>"><i class="fa fa-dashboard"></i> Halaman Utama</a></li>
		<li class="active">Kriteria</li>
	</ol>
</section>
<section class="p-1 px-15">
	<div class="callout callout-info" style="margin-bottom: 0!important;">
		<h4><i class="fa fa-info"></i> Perhatian:</h4>
		Harap set nilai bobot dengan minimal bobot 0 atau maksimal 1!
	</div>
</section>
<section class="content">
	<div class="box">
		<div class="box-header">
			<h3 class="box-title">Kriteria Pemilihan Sunscreen</h3>
		</div>
		<div class="box-body p-3 pt-0">
			<form action="<?= site_url('dashboard/save_bobot');?>" method="post">
				<table class="table table-bordered w-100">
					<thead>
						<tr>
							<th>No</th>
							<th>Kriteria</th>
							<th>Bobot</th>
						</tr>
					</thead>
					<tbody>
						<?php if(!empty($bobot_kriteria)):?>
						<?php $no= 1; foreach ($bobot_kriteria as $key => $val):?>
						<tr>
							<td><?= $no++;?></td>
							<td><?= $val['name'];?></td>
							<td>
								<div class="form-group">
									<input type="text" class="form-control form-control-sm inputNumber" min="0"
										name="<?= $val['id'];?>" data-original="<?= $val['weight']; ?>"
										value="<?= $val['weight'];?>" required>
								</div>
							</td>
						</tr>
						<?php endforeach;?>
						<?php endif;?>
					</tbody>
				</table>
				<div class="form-group">
					<button type="submit" class="btn btn-success pull-right btn-flat">Simpan</button>
				</div>
			</form>

		</div>

	</div>

</section>

<script>
	function checkInput(event) {
		var input = event.target;
		var original = input.dataset.original;

		if (input.value >= 0 && input.value <= 1) {
			input.classList.remove('input-error');
		} else {
			input.classList.add('input-error');
		}
	}

	var inputs = document.getElementsByClassName('inputNumber');
	for (var i = 0; i < inputs.length; i++) {
		inputs[i].addEventListener('input', checkInput);
	}

</script>
