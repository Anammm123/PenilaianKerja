<?php
include_once "../config/koneksi.php";

// Get the employee ID from the query parameter
$id_pegawai = isset($_GET['id']) ? (int) $_GET['id'] : 0;

// Fetch the employee data to be edited
$query = $koneksi->query("SELECT * FROM pegawai WHERE id_pegawai = $id_pegawai");
$data = $query->fetch_assoc();

if (!$data) {
	echo "<script>alert('Data tidak ditemukan!'); window.location.href='pegawai.php';</script>";
	exit;
}

if (isset($_POST['submit'])) {
	// Sanitize and update the form input values
	$nm_pegawai = isset($_POST['nama']) ? htmlspecialchars(trim($_POST['nama'])) : '';
	$ttl = isset($_POST['ttl']) ? htmlspecialchars(trim($_POST['ttl'])) : '';
	$alamat = isset($_POST['alamat']) ? htmlspecialchars(trim($_POST['alamat'])) : '';
	$email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
	$jeniskelamin = isset($_POST['jeniskelamin']) ? htmlspecialchars(trim($_POST['jeniskelamin'])) : '';
	$id_posisi = isset($_POST['posisi']) ? (int) $_POST['posisi'] : 0;
	$username = isset($_POST['username']) ? htmlspecialchars(trim($_POST['username'])) : '';
	$password = isset($_POST['password']) ? htmlspecialchars(trim($_POST['password'])) : '';

	// Ensure all fields are filled
	if (
		empty($nm_pegawai) || empty($ttl) || empty($alamat) ||
		empty($email) || empty($jeniskelamin) || empty($id_posisi) ||
		empty($username)
	) {
		echo "<script>alert('Semua field harus diisi!');</script>";
	} elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		echo "<script>alert('Format email tidak valid!');</script>";
	} else {
		// If password is provided, hash it before storing it
		if (!empty($password)) {
			$password = password_hash($password, PASSWORD_DEFAULT);
			$password_update = "password='$password',";
		} else {
			$password_update = "";
		}

		// Update the employee data in the database
		$result = $koneksi->query("UPDATE pegawai SET 
            nm_pegawai='$nm_pegawai', 
            ttl='$ttl', 
            alamat='$alamat', 
            email='$email', 
            jeniskelamin='$jeniskelamin', 
            id_posisi='$id_posisi',
            username='$username',
            password='$password'  -- Koma dihapus
            WHERE id_pegawai=$id_pegawai");

		$stmt = $koneksi->prepare("UPDATE pegawai SET 
            nm_pegawai=?, 
            ttl=?, 
            alamat=?, 
            email=?, 
            jeniskelamin=?, 
            id_posisi=?, 
            username=?, 
            password=? 
            WHERE id_pegawai=?");
		$stmt->bind_param("ssssssssi", $nm_pegawai, $ttl, $alamat, $email, $jeniskelamin, $id_posisi, $username, $password, $id_pegawai);
		$stmt->execute();

		if ($result) {
			echo "<script>alert('Data pegawai sudah diperbarui!');</script>";
			echo "<script>window.location.href = 'http://localhost/PenilaianKerja-main/Admin/?page=Pegawai';</script>"; // Redirect back to the main page after update
		} else {
			echo "<script>alert('Gagal memperbarui data!');</script>";
		}
	}
}
?>

<div class="container-fluid">
	<h4 class="page-title">Edit Data Pegawai</h4>
	<div class="row">
		<div class="col-md-12">
			<div class="card">
				<form method="POST" action="">
					<div class="card-header">
						<h4 class="card-title">Edit Data</h4>
					</div>
					<div class="card-body row">
						<div class="col-md-6">
							<p>Nama</p>
							<input name="nama" type="text" class="form-control"
								value="<?php echo htmlspecialchars($data['nm_pegawai']); ?>">
							<br>

							<p>Tempat Tanggal Lahir</p>
							<input name="ttl" type="text" class="form-control"
								value="<?php echo htmlspecialchars($data['ttl']); ?>">
							<br>

							<p>Alamat</p>
							<input name="alamat" type="text" class="form-control"
								value="<?php echo htmlspecialchars($data['alamat']); ?>">
							<br>

							<p>Username</p>
							<input name="username" type="text" class="form-control"
								value="<?php echo htmlspecialchars($data['username']); ?>">
							<br>
						</div>

						<div class="col-md-6">
							<p>Email</p>
							<input name="email" type="email" class="form-control"
								value="<?php echo htmlspecialchars($data['email']); ?>">
							<br>

							<p>Jenis Kelamin</p>
							<select name="jeniskelamin" class="form-control">
								<option value="L" <?php echo ($data['jeniskelamin'] == 'L') ? "selected" : ""; ?>>
									Laki-laki</option>
								<option value="P" <?php echo ($data['jeniskelamin'] == 'P') ? "selected" : ""; ?>>
									Perempuan</option>
							</select>
							<br>

							<p>Posisi</p>
							<select class="form-control" name="posisi">
								<option value="1" <?php echo ($data['id_posisi'] == 1) ? "selected" : ""; ?>>House Keeping
								</option>
								<option value="2" <?php echo ($data['id_posisi'] == 2) ? "selected" : ""; ?>>Public Area
								</option>
								<option value="3" <?php echo ($data['id_posisi'] == 3) ? "selected" : ""; ?>>Mechanical
									Engineering</option>
								<option value="4" <?php echo ($data['id_posisi'] == 4) ? "selected" : ""; ?>>Front Office
								</option>
								<option value="5" <?php echo ($data['id_posisi'] == 5) ? "selected" : ""; ?>>Bell Boy
								</option>
								<option value="6" <?php echo ($data['id_posisi'] == 6) ? "selected" : ""; ?>>None</option>
							</select>
							<br>

							<p>Password (kosongkan jika tidak diubah)</p>
							<input name="password" type="password" class="form-control">
							<br>
						</div>
					</div>
					<div class="card-footer" style="display:flex; justify-content:flex-end; width:100%; padding:2;">
						<input type="submit" name="submit" class="btn w-100 btn-success btn-l" value="Simpan" />
					</div>
				</form>
			</div>
		</div>
	</div>
</div>