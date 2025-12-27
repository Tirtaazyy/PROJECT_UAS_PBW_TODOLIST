<?php
include 'koneksi.php';
$err="";
if(isset($_POST['login'])){
  $nim=$_POST['nim'];
  $p=$_POST['password'];
  $q=mysqli_query($conn,"SELECT * FROM users WHERE nim='$nim'");
  if(mysqli_num_rows($q)){
    $u=mysqli_fetch_assoc($q);
    if(password_verify($p,$u['password'])){
      $_SESSION['nim']=$u['nim'];
      $_SESSION['nama']=$u['nama'];
      header("Location:dashboard.php"); exit;
    }
  }
  $err="Login gagal";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Login</title>
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
<h4 class="mb-3">Login</h4>
<form method="POST">
<input name="nim" class="form-control mb-2" placeholder="NIM" required>
<input type="password" name="password" class="form-control mb-3" placeholder="Password" required>
<button name="login" class="btn btn-ungu w-100">Login</button>
</form>
<small class="text-danger mt-2 d-block"><?=$err?></small>
<a href="register.php" class="mt-2 d-block">Register</a>
</div>
</div>
</body>
</html>
