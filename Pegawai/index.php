<?php
include 'functions.php';
$data = $koneksi->query("SELECT id_pegawai,username,password,nm_pegawai,email,ttl,jeniskelamin,posisi.nama,alamat,id_posisi FROM pegawai, posisi WHERE id_pegawai = {$_SESSION['id_pegawai']} AND posisi.id = id_posisi")->fetch_array();
$nilai = mysqli_num_rows($koneksi->query("SELECT * FROM nilai WHERE id_pegawai = {$_SESSION['id_pegawai']}")) > 0 ? $koneksi->query("SELECT * FROM (SELECT * FROM nilai WHERE id_pegawai = {$_SESSION['id_pegawai']} ORDER BY id DESC LIMIT 4) Var1 ORDER BY id ASC")->fetch_all(MYSQLI_ASSOC) : NULL;

?>

<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
	<title>Pegawai | Sistem Penilaian Kinerja Pegawai</title>
	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	
	<link rel="stylesheet" href="../assets/css/ready.css">
	<link rel="stylesheet" href="../assets/css/demo.css">

	<link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <style>
    *, html, body {
      font-family: "Poppins", serif;
    }
  </style>

</head>
<body>

<!-- 
la la-code
la la-file-code-o
la la-line-chart
la la-unlock
la la-support
 -->


	<div class="wrapper">
		<div class="main-header">
			<div class="logo-header">
				<a href="?page=Dashboard" class="logo">
					Dashboard Pegawai
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-controls="sidebar" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon"></span>
				</button>
				<button class="topbar-toggler more"><i class="la la-ellipsis-v"></i></button>
			</div>
			<nav class="navbar navbar-header navbar-expand-lg">
				<div class="container-fluid">
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item dropdown">
							<!-- Foto pegawai -->
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false"> <img src="lihat_foto.php?id=<?php echo $_SESSION['id_pegawai']; ?>" alt="user-img" width="36" class="img-circle"><span ><?php echo $data['nm_pegawai']; ?></span></span> </a>
							
							<ul class="dropdown-menu dropdown-user">
								<li>
									<div class="user-box">
										<div class="u-img"><img src="lihat_foto.php?id=<?php echo $_SESSION['id_pegawai']; ?>" alt="user"></div>
										<div class="u-text">
										<h4><?php echo $data['nm_pegawai']; ?></h4>
										<p class="text-muted"><?php echo $data['email']; ?></p><a href="?page=Profil" class="btn btn-rounded btn-primary btn-xs">Lihat Profil</a></div>
									</div>
								</li>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="?page=Pengaturan"><i class="ti-settings"></i>Pengaturan</a>
								<div class="dropdown-divider"></div>
								<a class="dropdown-item" href="logout.php"><i class="fa fa-power-off"></i>Keluar</a>
							</ul>
								<!-- /.dropdown-user -->
						</li>
					</ul>
				</div>
			</nav>
		</div>
		<div class="sidebar">
			<div class="scrollbar-inner sidebar-wrapper">
				<div class="user">
					<div class="photo">
						<img src="lihat_foto.php?id=<?php echo $_SESSION['id_pegawai']; ?>">
					</div>						
					<div class="info">
						<a class="" data-toggle="collapse" href="#collapseExample" aria-expanded="true">
							<span>
								<?php echo $data['nm_pegawai']; ?>
								<span class="user-level"><?php echo $data['nama']; ?></span>
							</span>
						</a>
					</div>
				</div>
				<ul class="nav">
					<li class="nav-item <?php echo ($_GET['page'] == 'Dashboard') ? "active" : ""; ?>">
						<a href="?page=Dashboard">
							<i class="la la-dashboard"></i>
							<p>Dashboard</p>
						</a>
					</li>
					<li class="nav-item <?php echo ($_GET['page'] == 'Profil') ? "active" : ""; ?>">
						<a href="?page=Profil">
							<i class="la la-user"></i>
							<p>Profil</p>
						</a>
					</li>
					<li class="nav-item <?php echo ($_GET['page'] == 'Pengaturan') ? "active" : ""; ?>">
						<a href="?page=Pengaturan">
							<i class="la la-cog"></i>
							<p>Pengaturan</p>
						</a>
					</li>
					<li class="nav-item <?php echo ($_GET['page'] == 'Kinerja') ? "active" : ""; ?>">
						<a href="?page=Kinerja">
							<i class="la la-tasks"></i>
							<p>Kinerja</p>
						</a>
					</li>
				</ul>
			</div>
		</div>
		
		<div class = "main-panel">
			<div class = "content">
			<?php
			switch(@$_GET['page']) {
				case "Dashboard":
					include 'dashboard.php';
					break;
				case "Profil":
					include 'profil.php';
					break;
				case "Pengaturan":
					include 'pengaturan.php';
					break;
				case "Kinerja":
					include 'lihat.php';
					break;
				default:
					echo '404 Not Found!';
					break;
			}
			?>
			</div>
		</div>
	</div>
</body>
<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
<script src="../assets/js/core/popper.min.js"></script>
<script src="../assets/js/core/bootstrap.min.js"></script>
<script src="../assets/js/plugin/chartist/chartist.min.js"></script>
<script src="../assets/js/plugin/chartist/plugin/chartist-plugin-tooltip.min.js"></script>
<!-- <script src="assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script> -->
<script src="../assets/js/plugin/bootstrap-toggle/bootstrap-toggle.min.js"></script>
<script src="../assets/js/plugin/jquery-mapael/jquery.mapael.min.js"></script>
<script src="../assets/js/plugin/jquery-mapael/maps/world_countries.min.js"></script>
<script src="../assets/js/plugin/chart-circle/circles.min.js"></script>
<script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
<script src="../assets/js/ready.min.js"></script>
<!-- <script src="assets/js/demo.js"></script> -->
<script>
Circles.create({
	id:           'task-complete',
	radius:       75,
	value:        <?php echo @$value; ?>, <!-- <--- Ganti nilai -->
	maxValue:     100,
	width:        8,
	text:         function(value){return value + '%';},
	colors:       ['#eee', '#1D62F0'],
	duration:     400,
	wrpClass:     'circles-wrp',
	textClass:    'circles-text',
	styleWrapper: true,
	styleText:    true
})
</script>
</html>