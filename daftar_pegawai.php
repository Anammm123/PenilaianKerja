<?php
include 'config/koneksi.php';

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Sistem Penilaian Kinerja Pegawai</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i">
	<link rel="stylesheet" href="assets/css/ready.css">
	<link rel="stylesheet" href="assets/css/demo.css">
	<link href="assets/datepicker/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet">
	<link href="assets/datepicker/fontawesome/css/all.min.css" rel="stylesheet">
</head>
<body>
	<div class="wrapper">
		<div>
			<div class = "content">
				<div class = "container-fluid">
					<div class="row" style="padding-top:2%">
					
						<div class="col-md-3"></div>
						<div class="col-md-6">
							<div class="card">
							<form method="POST" action="" enctype='multipart/form-data'>
							<div class="card-header">
							<h4 class="card-title">Daftar Pegawai</h4>
							</div>
							<div class="card-body">
								<div class="row">
									<div class="col-md-5">
										<p>Username</p>
										<input name="username" type="text" class="form-control" placeholder='username' required>
										<br>
										<p>Password</p>
										<input name="password" type="password" class="form-control" placeholder='Password' required>
										<br>
										<p>Email</p>
										<input name="email" type="text" class="form-control" placeholder='user@email.com' required>
										<br>
									</div>
									<div class="col-md-7">
										<p>Foto Pegawai</p>
										<input name="foto" type="file" class="form-control" required>
										<br>
										<p>Nama Lengkap</p>
										<input name="nama_lengkap" type="text" class="form-control" placeholder='Nama Lengkap' required>
										<br>
										<p>Jenis Kelamin</p>
											<label class="form-radio-label">
												<input class="form-radio-input" type="radio" name="jeniskelamin" value="L" checked="" >
												<span class="form-radio-sign">Laki-laki</span>
											</label>
											<label class="form-radio-label ml-3">
												<input class="form-radio-input" type="radio" name="jeniskelamin" value="P">
												<span class="form-radio-sign">Perempuan</span>
											</label>
										<br>
										<br>
										<p>Tempat Tanggal Lahir</p>
										<div class="row">
										<div class="col-md-5" style="padding-right: 0%">
											<input name="tempat" type="text" class="form-control"  placeholder="Tempat Lahir" required />
										</div>
										<div class="col-md-7">
											<input name="tanggal_lahir" type="text" class="form-control datepicker datetimepicker-input" data-toggle="datetimepicker" data-target=".datepicker" placeholder="Tanggal Lahir" required />
										</div>
										</div>
										<br>
										<p>Alamat</p>
										<textarea name="alamat" class="form-control" required></textarea>
										<br>
									</div>
									<div class="card-footer" style="display:flex; justify-content:flex-end; width:100%; padding:2;">
										<input type="Reset" href="#" class="btn btn-rounded btn-danger btn-l" value="Reset" style="margin-right:10px"/><input type="submit" name="submit" href="#" class="btn btn-rounded btn-success btn-l" value="Daftar"/>
									</div>
								</form>
								<?php
								if(isset($_POST['submit'])) {
									$username = $koneksi->real_escape_string(@$_POST['username']);
									if($koneksi->query("SELECT * FROM pegawai WHERE username = '$username'")->num_rows > 0) {
										echo "<script>alert('Username sudah terdaftar')</script>";
									} else {
										$password = $koneksi->real_escape_string(@$_POST['password']); //md5($_POST['password']."IniSALTNYAYAAA");
										$email = $koneksi->real_escape_string(@$_POST['email']);
										$nm_lengkap = $koneksi->real_escape_string(@$_POST['nama_lengkap']);
										$jk = $koneksi->real_escape_string(@$_POST['jeniskelamin']);
										$tempat = $koneksi->real_escape_string(@$_POST['tempat']);
										$tanggal_lahir = $koneksi->real_escape_string(@$_POST['tanggal_lahir']);
										$alamat = $koneksi->real_escape_string(@$_POST['alamat']);
										$ttl = $tempat.", ".$tanggal_lahir;
										
										$fileName = md5($_FILES['foto']['name']);
										$tmpName = @$_FILES['foto']['tmp_name'];
										$fileSize = @$_FILES['foto']['size'];
										$fileType = @$_FILES['foto']['type']; 
										$content = addslashes(file_get_contents($tmpName));
										
										$result = $koneksi->query("INSERT INTO pegawai VALUES (null, '$username', '$password', '$email', '$nm_lengkap', '$jk', 6, '$ttl', '$alamat')");
										$id = $koneksi->insert_id;
										$foto = $koneksi->query("INSERT INTO foto_pegawai (file, nama_file, tipe_file, ukuran_file, id_pegawai) VALUES ('$content', '$fileName', '$fileType', '$fileSize', $id)");
										if($result and $foto) {
											echo "<script>alert('Sukses mendaftar')</script>";
											echo "<script>window.location.href = 'login_pegawai.php';</script>";
										}
									}
								}
								?>
							</div>
							</div>
						</div>
						<center><a href="login_pegawai.php" >Silahkan Masuk</a>, jika sudah mempunyai akun pegawai.</center>
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
			</div>
		</div>
		
	</div>
</body>
<script src="assets/js/core/jquery.3.2.1.min.js"></script>
<script src="assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="assets/js/core/popper.min.js"></script>
<script src="assets/js/core/bootstrap.min.js"></script>
<script src="assets/js/plugin/chartist/chartist.min.js"></script>
<script src="assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
<script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>
<script src="assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="assets/js/ready.min.js"></script>
<!-- <script src="assets/js/demo.js"></script> -->
<!-- Include library Moment JS -->
<script src="assets/datepicker/js/moment.min.js"></script>
<!-- Include library Datepicker Gijgo -->
<script src="assets/datepicker/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Include file custom.js -->
<script src="assets/datepicker/js/custom.js"></script>
<script>
$(document).ready(function(){
	setDatePicker()
    setDateRangePicker(".startdate", ".enddate")
    setMonthPicker()
    setYearPicker()
    setYearRangePicker(".startyear", ".endyear")
})
</script>
</html>