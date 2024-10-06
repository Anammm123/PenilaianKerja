				<div class = "container-fluid">
					<h4 class = "page-title">Posisi</h4>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<form method="POST" action="">
									<div class="card-header">
										<h4 class="card-title">Edit Posisi</h4>
									</div>
									<div class="card-body">
										<p>Nama</p>
										<input name="nama" type="text" class="form-control" id="disableinput" value="<?php echo $data['nm_pegawai']; ?>" disabled>
										<br>
										<p>Email</p>
										<input name="email" type="text" class="form-control" id="disableinput" value="<?php echo $data['email']; ?>" disabled>
										<br>
										<p>Tempat Tanggal Lahir</p>
										<input type="text" class="form-control" id="disableinput" value="<?php echo $data['ttl']; ?>" disabled>
										<br>
										<p>Jenis Kelamin</p>
										<input type="text" class="form-control" id="disableinput" value="<?php $jk = ($data['jeniskelamin'] == 'L') ? "Laki-laki" : "Perempuan"; echo $jk;?>" disabled>
										<br>
										<p>Alamat</p>
										<input name="alamat" type="text" class="form-control" id="disableinput" value="<?php echo $data['alamat']; ?>" disabled>
										<br>
										<p>Posisi</p>
										<select class="form-control" name='posisi'>
											<option value = 1 <?php $kond = ($data['id_posisi'] == 1) ? "selected" : ""; echo $kond; ?>>House Keeping</option>
											<option value = 2 <?php $kond = ($data['id_posisi'] == 2) ? "selected" : ""; echo $kond; ?>>Public Area</option>
											<option value = 3 <?php $kond = ($data['id_posisi'] == 3) ? "selected" : ""; echo $kond; ?>>Mechanical Engineering</option>
											<option value = 4 <?php $kond = ($data['id_posisi'] == 4) ? "selected" : ""; echo $kond; ?>>Front Office</option>
											<option value = 5 <?php $kond = ($data['id_posisi'] == 5) ? "selected" : ""; echo $kond; ?>>Bell Boy</option>
											<option value = 6 <?php $kond = ($data['id_posisi'] == 6) ? "selected" : ""; echo $kond; ?>>None</option>
										</select>
										<br>
									</div>
									<div class="card-footer" style="display:flex; justify-content:flex-end; width:100%; padding:2;">
										<input type="submit" name="submit" class="btn btn-rounded btn-success btn-l" value="Simpan"/>
									</div>
								</form>
								<?php
								if(isset($_POST['submit'])) {
									$result = $koneksi->query("UPDATE pegawai SET id_posisi='{$_POST['posisi']}' WHERE  id_pegawai={$id_pegawai};");
									if($result)
										echo "<script>alert('Posisi sudah diperbarui')</script>";
										echo "<script>window.location.assign(document.URL);</script>";
								} else {
									
								}
								?>
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
			