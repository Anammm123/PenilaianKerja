<?php
include_once "../config/koneksi.php"; // Include your database connection

if (isset($_POST['submit'])) { // Check if form is submitted
    // Use isset() to avoid accessing undefined keys
    $username = isset($_POST['username']) ? htmlspecialchars(trim($_POST['username'])) : '';
    $password = isset($_POST['password']) ? htmlspecialchars(trim($_POST['password'])) : '';
    $email = isset($_POST['email']) ? filter_var(trim($_POST['email']), FILTER_SANITIZE_EMAIL) : '';
    $nm_pegawai = isset($_POST['nm_pegawai']) ? htmlspecialchars(trim($_POST['nm_pegawai'])) : '';
    $jeniskelamin = isset($_POST['jeniskelamin']) ? htmlspecialchars(trim($_POST['jeniskelamin'])) : '';
    $id_posisi = isset($_POST['id_posisi']) ? (int) $_POST['id_posisi'] : 0;
    $ttl = isset($_POST['ttl']) ? htmlspecialchars(trim($_POST['ttl'])) : '';
    $alamat = isset($_POST['alamat']) ? htmlspecialchars(trim($_POST['alamat'])) : '';

    // Validation
    if (
        empty($username) || empty($password) || empty($email) ||
        empty($nm_pegawai) || empty($jeniskelamin) || empty($id_posisi) ||
        empty($ttl) || empty($alamat)
    ) {
        echo "<script>alert('Semua field harus diisi!'); window.history.back();</script>";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        echo "<script>alert('Format email tidak valid!'); window.history.back();</script>";
    } else {
        try {
            // Prepare SQL statement
            $query = "INSERT INTO pegawai (username, password, email, nm_pegawai, jeniskelamin, id_posisi, ttl, alamat) 
                     VALUES (?, ?, ?, ?, ?, ?, ?, ?)";

            $stmt = $koneksi->prepare($query);
            $stmt->bind_param("ssssssss", $username, $password, $email, $nm_pegawai, $jeniskelamin, $id_posisi, $ttl, $alamat);

            if ($stmt->execute()) {
                echo "<script>
                        alert('Data pegawai berhasil disimpan!');
                        window.location.href = 'http://localhost/PenilaianKerja-main/Admin/?page=TambahPegawai'; 
                      </script>";
            } else {
                throw new Exception("Gagal menyimpan data");
            }

            $stmt->close();
        } catch (Exception $e) {
            echo "<script>alert('Error: Gagal menyimpan data. " . $e->getMessage() . "')</script>";
        }
    }
}
?>


<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pegawai</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>

<body>

    <div class="container-fluid">
        <h4 class="page-title">Tambah Pegawai</h4>
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <form method="POST" action="">
                        <div class="card-header">
                            <h4 class="card-title">Tambah Pegawai</h4>
                        </div>
                        <div class="card-body row">
                            <div class="col-md-6">
                                <p>Username</p>
                                <input name="username" type="text" class="form-control" required>
                                <br>

                                <p>Password</p>
                                <input name="password" type="text" class="form-control" required>
                                <br>

                                <p>Email</p>
                                <input name="email" type="email" class="form-control" required>
                                <br>

                                <p>Nama Pegawai</p>
                                <input name="nm_pegawai" type="text" class="form-control" required>
                                <br>
                            </div>

                            <div class="col-md-6">
                                <p>Jenis Kelamin</p>
                                <select class="form-control" name="jeniskelamin" required>
                                    <option value="" disabled selected>Pilih Jenis Kelamin</option>
                                    <option value="L">Laki-laki</option>
                                    <option value="P">Perempuan</option>
                                </select>
                                <br>

                                <p>Posisi</p>
                                <select class="form-control" name="id_posisi" required>
                                    <option value="" disabled selected>Pilih Posisi</option>
                                    <option value="1">House Keeping</option>
                                    <option value="2">Public Area</option>
                                    <option value="3">Mechanical Engineering</option>
                                    <option value="4">Front Office</option>
                                    <option value="5">Bell Boy</option>
                                    <option value="6">None</option>
                                </select>
                                <br>

                                <p>Tempat Tanggal Lahir</p>
                                <input name="ttl" type="text" class="form-control" required>
                                <br>

                                <p>Alamat</p>
                                <input name="alamat" type="text" class="form-control" required>
                                <br>
                            </div>
                        </div>
                        <div class="card-footer" style="display:flex; justify-content:flex-end;">
                            <input type="submit" name="submit" class="btn btn-success w-100" value="Simpan">
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>

</html>