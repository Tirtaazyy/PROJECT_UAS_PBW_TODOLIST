<?php
include 'koneksi.php';
$id = $_GET['id'];
?>
<!DOCTYPE html>
<html>
<head>
<title>Tugas</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<style>
body{background:#f5f3ff;font-family:Segoe UI;}
.card{border:none;border-radius:14px;box-shadow:0 8px 20px rgba(0,0,0,.05);}
.btn-ungu{background:#6f42c1;color:#fff;}
.telat{color:#dc3545;font-weight:600;}
.aman{color:#198754;font-weight:600}

/* toast */
.toast-box{
  position:fixed;
  top:20px;
  right:20px;
  background:#dc3545;
  color:white;
  padding:12px 18px;
  border-radius:10px;
  opacity:0;
  transform:translateY(-10px);
  transition:.3s;
}
.toast-box.show{
  opacity:1;
  transform:translateY(0);
}
</style>
</head>

<body>

<div class="toast-box" id="toast">Ada tugas yang TELAT</div>

<div class="container py-4">

<a href="dashboard.php" class="btn btn-light mb-3">Kembali</a>

<div class="card p-3 mb-3">
  <input id="judul" class="form-control mb-2" placeholder="Judul tugas">
  <input id="deadline" type="datetime-local" class="form-control mb-2">
  <button onclick="tambah()" class="btn btn-ungu w-100">Tambah tugas</button>
</div>

<div id="list"></div>

</div>

<script>
function toast(){
  let t = document.getElementById('toast');
  t.classList.add('show');
  setTimeout(()=>t.classList.remove('show'),3000);
}

function load(){
 fetch("ajax_tugas.php",{
  method:"POST",
  body:new URLSearchParams({aksi:'load',matkul:'<?=$id?>'})
 }).then(r=>r.text()).then(t=>{
   list.innerHTML=t;
   if(t.includes('telat')) toast();
 });
}
load();

function tambah(){
 fetch("ajax_tugas.php",{
  method:"POST",
  body:new URLSearchParams({
    aksi:'tambah',
    matkul:'<?=$id?>',
    judul:judul.value,
    deadline:deadline.value
  })
 }).then(()=>{
   judul.value=""; 
   deadline.value="";
   load();
 });
}

function hapus(id){
 fetch("ajax_tugas.php",{
  method:"POST",
  body:new URLSearchParams({aksi:'hapus',id:id})
 }).then(()=>load());
}

function selesai(id){
 fetch("ajax_tugas.php",{
  method:"POST",
  body:new URLSearchParams({aksi:'selesai',id:id})
 }).then(()=>load());
}
</script>

</body>
</html>
