<?php
include 'koneksi.php';

$aksi = $_POST['aksi'];

if($aksi=='load'){
  $matkul = $_POST['matkul'];
  $q = mysqli_query($conn,"SELECT * FROM tugas WHERE matkul_id='$matkul' ORDER BY deadline ASC");

  while($d = mysqli_fetch_assoc($q)){
    $telat = (strtotime($d['deadline']) < time() && $d['status']=='belum');
    echo "<div class='card p-3 mb-2'>";
    echo "<b>{$d['judul_tugas']}</b><br>";
    echo "<small>{$d['deadline']}</small><br>";

    if($d['status']=='belum'){
      echo $telat 
        ? "<span class='telat'>TELAT</span><br>"
        : "<span class='aman'>Belum selesai</span><br>";
    }else{
      echo "<span class='aman'>Selesai</span><br>";
    }

    if($d['status']=='belum'){
      echo "<button class='btn btn-success btn-sm mt-2' onclick='selesai({$d['id']})'>Selesai</button> ";
    }

    echo "<button class='btn btn-danger btn-sm mt-2' onclick='hapus({$d['id']})'>Hapus</button>";
    echo "</div>";
  }
}

if($aksi=='tambah'){
  mysqli_query($conn,"INSERT INTO tugas VALUES(NULL,'$_POST[matkul]','$_POST[judul_tugas]','$_POST[deadline]','belum')");
}

if($aksi=='hapus'){
  mysqli_query($conn,"DELETE FROM tugas WHERE id='$_POST[id]'");
}

if($aksi=='selesai'){
  mysqli_query($conn,"UPDATE tugas SET status='selesai' WHERE id='$_POST[id]'");
}
