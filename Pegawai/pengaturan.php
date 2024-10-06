				<div class = "container-fluid">
					<h4 class = "page-title">Pengaturan</h4>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<form method="POST" action="">
									<div class="card-header">
										<h4 class="card-title">Ganti Password</h4>
									</div>
									<div class="card-body">
										<p>Username</p>
										<input type="text" class="form-control" id="disableinput" value="<?php echo $data['username']; ?>" disabled>
										<br>
										<p>Password Lama</p>
										<input name="pass_lama" type="password" class="form-control">
										<br>
										<p>Password Baru</p>
										<input name="pass_baru" type="password" class="form-control">
										<br>
										<p>Ulangi Password Baru</p>
										<input name="re_pass_baru" type="password" class="form-control" >
									</div>
									<div class="card-footer">
										<input type="submit" name="submit" class="btn btn-rounded btn-success btn-l" value="Simpan"/>
									</div>
								</form>
								<?php
								if(isset($_POST['submit'])) {
									$pass_lama = $_POST['pass_lama'];
									$pass_baru = $_POST['pass_baru'];
									$re_pass_baru = $_POST['re_pass_baru'];
									if($data['password'] === $pass_lama) {
										if($pass_baru === $re_pass_baru) {
											$result = $koneksi->query("UPDATE pegawai SET password = '$pass_baru' WHERE id_pegawai = {$data['id_pegawai']}");
											echo "<script>alert('Password berhasil diperbarui')</script>";
										} else {
											echo "<script>alert('Password tidak sama')</script>";
										}
									} else {
										echo "<script>alert('Password tidak sama')</script>";
									}
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