				<div class = "container-fluid">
					<h4 class = "page-title">Profil</h4>
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<form method="POST" action="" enctype='multipart/form-data'>
									<div class="card-header">
										<h4 class="card-title">Edit Profil</h4>
									</div>
									<div class="card-body">
										<p>Nama</p>
										<input name="nama" type="text" class="form-control" value="<?php echo $data['nm_pegawai']; ?>">
										<br>
										<p>Email</p>
										<input name="email" type="text" class="form-control" value="<?php echo $data['email']; ?>">
										<br>
										<p>Tempat Tanggal Lahir</p>
										<input type="text" class="form-control" id="disableinput" value="<?php echo $data['ttl']; ?>" disabled>
										<br>
										<p>Jenis Kelamin</p>
										<input type="text" class="form-control" id="disableinput" value="<?php $jk = ($data['jeniskelamin'] == 'L') ? "Laki-laki" : "Perempuan"; echo $jk;?>" disabled>
										<br>
										<p>Posisi</p>
										<input type="text" class="form-control" id="disableinput" value="<?php echo $data['nama'];?>" disabled>
										<br>
										<p>Alamat</p>
										<input name="alamat" type="text" class="form-control" id="disableinput" value="<?php echo $data['alamat'];?>">
										<br>
										<p>Upload Foto</p>
										<input type="file" name="foto" class="form-control">
										<br>
									</div>
									<div class="card-footer">
										<input type="submit" name = "submit" href="#" class="btn btn-rounded btn-success btn-l" value="Simpan"/>
									</div>
								</form>
								<?php
								if(isset($_POST['submit'])) {
									$nama = $koneksi->real_escape_string($_POST['nama']);
									$email = $koneksi->real_escape_string($_POST['email']);
									$alamat = $koneksi->real_escape_string($_POST['alamat']);
									
									$fileName = md5($_FILES['foto']['name']);
									$tmpName = @$_FILES['foto']['tmp_name'];
									$fileSize = @$_FILES['foto']['size'];
									$fileType = @$_FILES['foto']['type']; 
									$content = addslashes(file_get_contents($tmpName));
																		
									$foto = false;
									if (!empty($_FILES['foto']['name'])) {
										if($koneksi->query("SELECT * FROM foto_pegawai WHERE id_pegawai = {$_SESSION['id_pegawai']}")->num_rows > 0 ) {
											$foto = $koneksi->query("INSERT INTO foto_pegawai (file, nama_file, tipe_file, ukuran_file, id_pegawai) VALUES ('$content', '$fileName', '$fileType', '$fileSize', {$data['id_pegawai']})");
											echo "<script>alert('Foto profil berhasil diperbarui')</script>";
										} else {
											$foto = $koneksi->query("INSERT INTO foto_pegawai (file, nama_file, tipe_file, ukuran_file, id_pegawai) VALUES ('$content', '$fileName', '$fileType', '$fileSize', {$data['id_pegawai']})");
											echo "<script>alert('Foto profil berhasil ditambah')</script>";
										}
									} 
									$result = $koneksi->query("UPDATE pegawai SET nm_pegawai = '$nama', email = '$email', alamat = '$alamat' WHERE id_pegawai = '{$data['id_pegawai']}'");
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