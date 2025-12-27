<?php
include 'koneksi.php';
$msg="";
if(isset($_POST['daftar'])){
  $nim=$_POST['nim'];
  $nama=$_POST['nama'];
  $pass=password_hash($_POST['password'], PASSWORD_DEFAULT);
  mysqli_query($conn,"INSERT INTO users VALUES('$nim','$nama','$pass')");
  $msg="Registrasi berhasil. Silakan login.";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Register</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body{background:#f5f5f5;font-family:Segoe UI}
.card{border:none;border-radius:16px;box-shadow:0 10px 25px rgba(0,0,0,.08)}
.btn-ungu{background:#6f42c1;color:#fff}
</style>
</head>
<body>
<div class="container d-flex justify-content-center align-items-center vh-100">
<div class="card p-4" style="width:360px">
<h4 class="mb-3">Register</h4>
<form method="POST">
<input name="nim" class="form-control mb-2" placeholder="NIM" required>
<input name="nama" class="form-control mb-2" placeholder="Nama" required>
<input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
<button name="daftar" class="btn btn-ungu w-100">Daftar</button>
</form>
<small class="text-success mt-2 d-block"><?=$msg?></small>
<a href="login.php" class="mt-2 d-block">Login</a>
</div>
</div>
</body>
</html>
