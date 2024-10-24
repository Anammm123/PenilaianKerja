<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Admin Login</title>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
  <style>
    body {
      display: flex;
      align-items: center;
      height: 100vh;
      margin: 0;
      background-color: #007bff;
      background-image: url('gm.jpeg'); /* Ganti dengan URL gambar yang diinginkan */
      background-size: cover;
      background-position: center;
      background-repeat: no-repeat;
    }

    .login-container {
      background-color: rgba(255, 255, 255, 0.8);
      padding: 40px;
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
      width: 400px;
      margin-left: auto;
    }
  </style>
</head>
<body>
  <div class="container-fluid">
    <div class="row justify-content-end">
      <div class="col-md-4">
        <div class="login-container">
          <h2 class="mb-4">Admin Login</h2>
          <form method="POST" action="">
            <div class="mb-3">
              <label for="username" class="form-label">Username</label>
              <input type="text" class="form-control" id="username" name="username" placeholder="Enter your username" required>
            </div>
            <div class="mb-3">
              <label for="password" class="form-label">Password</label>
              <input type="password" class="form-control" id="password" name="password" placeholder="Enter your password" required>
            </div>
            <button type="submit" class="btn btn-primary w-100" name="submit">Login</button>
          </form>
          <?php
          if(isset($_POST['submit'])) {
            $username = $koneksi->real_escape_string(@$_POST['username']);
            $password = $koneksi->real_escape_string(@$_POST['password']);
            $result = $koneksi->query("SELECT * FROM admin WHERE username = '$username' AND password = '$password'")->num_rows;
            $data = $koneksi->query("SELECT * FROM admin WHERE username = '$username' AND password = '$password'")->fetch_array();
            if($result > 0) {
              $_SESSION['id_admin'] = $data['id'];
              $_SESSION['username'] = $data['username'];
              $_SESSION['status'] = 'Aktif';
              $_SESSION['level'] = 'Admin';
              echo "<script>alert('Login Sukses')</script>";
              echo "<script>window.location.href = 'Admin/?page=Dashboard';</script>";
            } else {
              echo "<script>alert('Username atau Password salah!')</script>";
            }
          }
          ?>
        </div>
      </div>
    </div>
  </div>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>