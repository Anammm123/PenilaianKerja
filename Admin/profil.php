				<div class="container-fluid">
					<h4 class="page-title">Profil</h4>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<form method="POST" action="" enctype='multipart/form-data'>
									<div class="card-header">
										<h4 class="card-title">Edit Profil</h4>
									</div>
									<div class="card-body row">
										<div class="col-8">
											<p>Nama</p>
											<input name="nama" type="text" class="form-control" value="<?php echo $data_admin['nm_lengkap']; ?>">
											<br>
											<p>Email</p>
											<input name="email" type="text" class="form-control" value="<?php echo $data_admin['email']; ?>">
											<br>
											<p>Jenis Kelamin</p>
											<input type="text" class="form-control" id="disableinput" value="<?php echo $data_admin['jeniskelamin']; ?>" disabled>
											<br>
											<p>Posisi</p>
											<input type="text" class="form-control" id="disableinput" value="Administrator" disabled>
											<br>
											<p>Upload Foto</p>
											<input type="file" name="foto" class="form-control">

											<div class="my-3">
											<input type="submit" name="submit" href="#" class="btn w-100 btn-success btn-l" value="Simpan" />												
											</div>
										</div>
									</div>
								</form>
								<?php
								if (isset($_POST['submit'])) {
									$nama = $koneksi->real_escape_string($_POST['nama']);
									$email = $koneksi->real_escape_string($_POST['email']);
									$fileName = md5($_FILES['foto']['name']);
									$tmpName = @$_FILES['foto']['tmp_name'];
									$fileSize = @$_FILES['foto']['size'];
									$fileType = @$_FILES['foto']['type'];

									if (!empty($tmpName) && file_exists($tmpName)) {
										$content = addslashes(file_get_contents($tmpName));
									} else {
										// Tindakan yang harus diambil jika file tidak valid atau tidak ada
										echo "File tidak ditemukan atau path kosong.";
									}

									$foto = false;
									if (!empty($_FILES['foto']['name'])) {
										if ($koneksi->query("SELECT * FROM foto_admin WHERE id_admin = {$data_admin['id']}")->num_rows > 0) {
											$foto = $koneksi->query("INSERT INTO foto_admin (file, nama_file, tipe_file, ukuran_file, id_admin) VALUES ('$content', '$fileName', '$fileType', '$fileSize', {$data_admin['id']})");
											echo "<script>alert('Foto profil berhasil diperbarui')</script>";
										} else {
											$foto = $koneksi->query("INSERT INTO foto_admin (file, nama_file, tipe_file, ukuran_file, id_admin) VALUES ('$content', '$fileName', '$fileType', '$fileSize', {$data_admin['id']})");
											echo "<script>alert('Foto profil berhasil ditambahkan')</script>";
										}
									}
									$result = $koneksi->query("UPDATE admin SET nm_lengkap = '$nama', email = '$email' WHERE username = '{$data_admin['username']}'");
									echo "<script>alert('Data profil berhasil diperbarui')</script>";
									if ($result or $foto)
										echo "<script>window.location.assign(document.URL);</script>";
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