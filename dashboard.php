<?php
include 'koneksi.php';
if(!isset($_SESSION['nim'])){header("Location:login.php");exit;}
$nim=$_SESSION['nim']; $nama=$_SESSION['nama'];

$matkul = mysqli_fetch_assoc(mysqli_query($conn,"SELECT COUNT(*) c FROM matkul WHERE nim='$nim'"))['c'];
$total  = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) c FROM tugas t JOIN matkul m ON t.matkul_id=m.id WHERE m.nim='$nim'"))['c'];
$done   = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) c FROM tugas t JOIN matkul m ON t.matkul_id=m.id WHERE m.nim='$nim' AND t.status='selesai'"))['c'];
$late   = mysqli_fetch_assoc(mysqli_query($conn,"
SELECT COUNT(*) c FROM tugas t JOIN matkul m ON t.matkul_id=m.id WHERE m.nim='$nim' AND t.status='belum' AND t.deadline<NOW()"))['c'];
?>
<!DOCTYPE html>
<html>
<head>
<title>Dashboard</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<style>
body{background:#f5f5f5;font-family:Segoe UI}
.card{border:none;border-radius:16px;box-shadow:0 8px 20px rgba(0,0,0,.06)}
.stat{font-size:28px;color:#6f42c1;font-weight:600}
.btn-ungu{background:#6f42c1;color:#fff}
</style>
</head>
<body>

<nav class="navbar bg-white shadow-sm px-4">
  <div>
    <div class="fw-semibold"><?=$nama?></div>
    <small class="text-muted"><?=$nim?></small>
  </div>
  <a href="logout.php" class="btn btn-sm btn-outline-danger">Logout</a>
</nav>

<div class="container py-4">

<div class="row g-3 mb-4">
  <div class="col-md-3"><div class="card p-3"><div>Mata Kuliah</div><div class="stat"><?=$matkul?></div></div></div>
  <div class="col-md-3"><div class="card p-3"><div>Total Tugas</div><div class="stat"><?=$total?></div></div></div>
  <div class="col-md-3"><div class="card p-3"><div>Selesai</div><div class="stat"><?=$done?></div></div></div>
  <div class="col-md-3"><div class="card p-3"><div>Terlambat</div><div class="stat"><?=$late?></div></div></div>
</div>

<div class="card p-3 mb-4">
  <canvas id="chart"></canvas>
</div>

<div class="card p-3">
<form method="POST">
<input name="matkul" class="form-control mb-2" placeholder="Nama mata kuliah" required>
<button name="add" class="btn btn-ungu w-100">Tambah Mata Kuliah</button>
</form>
</div>

<?php
if(isset($_POST['add'])){
  mysqli_query($conn,"INSERT INTO matkul (nim,nama_matkul) VALUES ('$nim','$_POST[matkul]')");
  header("Location:dashboard.php");
}
$q=mysqli_query($conn,"SELECT * FROM matkul WHERE nim='$nim'");
while($r=mysqli_fetch_assoc($q)){
  echo "<a href='tugas.php?id={$r['id']}' class='text-decoration-none'>
        <div class='card p-3 mt-2'>{$r['nama_matkul']}</div></a>";
}
?>

</div>

<script>
new Chart(document.getElementById('chart'),{
 type:'doughnut',
 data:{
  labels:['Selesai','Belum','Terlambat'],
  datasets:[{data:[<?=$done?>,<?=$total-$done?>,<?=$late?>],backgroundColor:['#6f42c1','#b9a3e3','#dc3545']}]
 }
});
</script>
</body>
</html>
