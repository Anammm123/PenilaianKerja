<!-- DASHBOARD -->
<div class="container-fluid">
	<h4 class="page-title"> Dashboard</h4>
	<!-- ROW -->
	<div class="row">
		<div class="col-md-9">
			<div class="card">
				<div class="card-header">
					<h4 class="card-title">Form Profil</h4>
				</div>
				<div class="card-body row">

					<div class="col-md-6">
						<p>Nama</p>
						<input type="text" class="form-control" id="disableinput"
							value="<?php echo $data['nm_pegawai']; ?>" disabled>
						<br>
						<p>Jenis Kelamin</p>
						<input type="text" class="form-control" id="disableinput"
							value="<?php $jk = ($data['jeniskelamin'] == 'L') ? "Laki-laki" : "Perempuan";
							echo $jk; ?>"
							disabled>
						<br>
					</div>

					<div class="col-md-6">
						<p>Tempat Tanggal Lahir</p>
						<input type="text" class="form-control" id="disableinput" value="<?php echo $data['ttl']; ?>"
							disabled>
						<br>

						<p>Posisi</p>
						<input type="text" class="form-control" id="disableinput" value="<?php echo $data['nama']; ?>"
							disabled>
						<br>
					</div>

				</div>
			</div>
		</div>
		<div class="col-md-3">
			<div class="card">
				<?php $value = $nilai != null ? Fuzzy($nilai[0]['nilai'], $nilai[1]['nilai'], $nilai[2]['nilai'], $nilai[3]['nilai']) : 1; ?>
				<div class="card-header">
					<h4 class="card-title">Kinerja Anda</h4>
				</div>
				<div class="card-body">
					<div id="task-complete" class="chart-circle mt-4 mb-3"></div>
				</div>
				<div class="card-footer">
					<?php kinerja($value); ?>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- DASHBOARD -->