<?php
include '../koneksi.php';
$nim=$_SESSION['nim'];

$total=mysqli_fetch_row(mysqli_query($conn,"
SELECT COUNT(*) FROM tugas 
JOIN matkul ON tugas.matkul_id=matkul.id 
WHERE matkul.nim='$nim'"))[0];

$belum=mysqli_fetch_row(mysqli_query($conn,"
SELECT COUNT(*) FROM tugas 
JOIN matkul ON tugas.matkul_id=matkul.id 
WHERE matkul.nim='$nim' AND status='Belum'"))[0];

$selesai=mysqli_fetch_row(mysqli_query($conn,"
SELECT COUNT(*) FROM tugas 
JOIN matkul ON tugas.matkul_id=matkul.id 
WHERE matkul.nim='$nim' AND status='Selesai'"))[0];

echo json_encode([
  "total"=>$total,
  "belum"=>$belum,
  "selesai"=>$selesai
]);
