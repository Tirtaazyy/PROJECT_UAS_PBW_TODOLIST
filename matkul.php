<?php
include '../koneksi.php';
$nim=$_SESSION['nim'];

if($_POST){
  mysqli_query($conn,"INSERT INTO matkul VALUES(NULL,'$nim','$_POST[nama]')");
}

$q=mysqli_query($conn,"SELECT * FROM matkul WHERE nim='$nim'");
while($m=mysqli_fetch_assoc($q)){
  echo "<div class='glass'>
  <h5>$m[nama_matkul]</h5>

  <input id='t$m[id]' class='form-control mb-1' placeholder='Nama tugas'>
  <input id='d$m[id]' type='date' class='form-control mb-2'>
  <button onclick='tambahTugas($m[id])' class='btn btn-success btn-sm'>Tambah Tugas</button>";

  $t=mysqli_query($conn,"SELECT * FROM tugas WHERE matkul_id=$m[id]");
  while($tg=mysqli_fetch_assoc($t)){
    $late = ($tg['status']=="Belum" && $tg['deadline'] < date('Y-m-d'));
    $badge = $tg['status']=="Selesai" ? "success" : ($late ? "danger":"warning");

    echo "<div class='mt-2'>
      <span class='badge bg-$badge'>$tg[status]</span>
      $tg[nama_tugas] (".$tg['deadline'].")
      <button onclick='selesai($tg[id])' class='btn btn-sm btn-outline-light'>✔</button>
    </div>";
  }
  echo "</div>";
}
