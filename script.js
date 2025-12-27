<script>
function load(){
 fetch("ajax_tugas.php",{
  method:"POST",
  body:new URLSearchParams({aksi:'load',matkul:'<?=$id?>'})
 }).then(r=>r.text()).then(t=>list.innerHTML=t);
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
  body:new URLSearchParams({aksi:'hapus',id:id,matkul:'<?=$id?>'})
 }).then(()=>load());
}
</script>
