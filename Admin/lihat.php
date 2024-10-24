				<div class = "container-fluid">
					<h4 class = "page-title">Pegawai</h4>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<form method="POST" action="">
									<div class="card-header">
										<h4 class="card-title">Profil</h4>
									</div>
									<div class="card-body row">

									<div class="col-md-6">
										<p>Nama</p>
										<input name="nama" type="text" class="form-control" id="disableinput" value="<?php echo $data['nm_pegawai'];?>" disabled>
										<br>

										<p>Tempat Tanggal Lahir</p>
										<input type="text" class="form-control" id="disableinput" value="<?php echo $data['ttl'];?>" disabled>
										<br>

										<p>Alamat</p>
										<input name="alamat" type="text" class="form-control" id="disableinput" value="<?php echo $data['alamat'];?>" disabled>
										<br>
									</div>

									<div class="col-md-6">
									<p>Email</p>
										<input name="email" type="text" class="form-control" id="disableinput" value="<?php echo $data['email'];?>" disabled>
										<br>
										
										<p>Jenis Kelamin</p>
										<input type="text" class="form-control" id="disableinput" value="<?php $jk = ($data['jeniskelamin'] == 'L') ? "Laki-laki" : "Perempuan"; echo $jk;?>" disabled>
										<br>

										<p>Posisi</p>
										<input name="alamat" type="text" class="form-control" id="disableinput" value="<?php echo $data['nama'];?>" disabled>
										<br>
									</div>
									
									</div>
								</form>
							</div>
						</div>
						<div class="col-md-9">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Kinerja Staf Hotel</h4>
								</div>
								<div class="card-body">
									<p>Kedisiplinan</p>
									<div class="progress-card">
										<div class="d-flex justify-content-between mb-1">
											<span class="text-muted"></span>
											<span class="text-muted fw-bold"> Value : <?php $value = $nilai != null ? $nilai[0]['nilai'] : 1; echo $value; ?></span>
										</div>
										<div class="progress mb-2" style="height: 7px;">
											<div class="progress-bar bg-info" role="progressbar" style="width: <?php $value = $nilai != null ? $nilai[0]['nilai'] : 1; echo $value; ?>%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" title="" data-original-title="78%"></div>
										</div>
									</div>
									<br>
									<p>Kejujuran</p>
									<div class="progress-card">
										<div class="d-flex justify-content-between mb-1">
											<span class="text-muted"></span>
											<span class="text-muted fw-bold"> Value : <?php $value = $nilai != null ? $nilai[1]['nilai'] : 1; echo $value; ?></span>
										</div>
										<div class="progress mb-2" style="height: 7px;">
											<div class="progress-bar bg-success" role="progressbar" style="width: <?php $value = $nilai != null ? $nilai[1]['nilai'] : 1; echo $value; ?>%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" title="" data-original-title="78%"></div>
										</div>
									</div>
									<br>
									<p>Kepemimpinan</p>
									<div class="progress-card">
										<div class="d-flex justify-content-between mb-1">
											<span class="text-muted"></span>
											<span class="text-muted fw-bold"> Value : <?php $value = $nilai != null ? $nilai[2]['nilai'] : 1; echo $value; ?></span>
										</div>
										<div class="progress mb-2" style="height: 7px;">
											<div class="progress-bar bg-danger" role="progressbar" style="width: <?php $value = $nilai != null ? $nilai[2]['nilai'] : 1; echo $value; ?>%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" title="" data-original-title="78%"></div>
										</div>
									</div>
									<br>
									<p>Kerjamasama</p>
									<div class="progress-card">
										<div class="d-flex justify-content-between mb-1">
											<span class="text-muted"></span>
											<span class="text-muted fw-bold"> Value : <?php $value = $nilai != null ? $nilai[3]['nilai'] : 1; echo $value; ?></span>
										</div>
										<div class="progress mb-2" style="height: 7px;">
											<div class="progress-bar bg-warning" role="progressbar" style="width: <?php $value = $nilai != null ? $nilai[3]['nilai'] : 1; echo $value; ?>%" aria-valuenow="78" aria-valuemin="0" aria-valuemax="100" data-toggle="tooltip" data-placement="top" title="" data-original-title="78%"></div>
										</div>
									</div>
									<br>
									
								</div>
							</div>
						</div>
						<div class="col-md-3">
							<div class="card">
							<?php $value = $nilai != null ? Fuzzy($nilai[0]['nilai'], $nilai[1]['nilai'], $nilai[2]['nilai'], $nilai[3]['nilai']) : 1; ?>
								<div class="card-header">
									<h4 class="card-title">Kinerja Pegawai</h4>
								</div>
								<div class="card-body">
									<div id="task-complete" class="chart-circle mt-4 mb-3"></div>
								</div>
								<div class="card-footer">
									<?php kinerja($value); ?>
								</div>
							</div>
						</div>
						<!-- <div class="col-md-3">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Kinerja Pegawai</h4>
								</div>
								<div class="card-body">
									<div id="task-complete" class="chart-circle mt-4 mb-3"></div>
								</div>
								<div class="card-footer">
									<center><legend class="btn-rounded btn-success btn-lg">Sangat Baik</legend></center>
								</div>
							</div>
						</div> -->
					</div>
				</div>
			