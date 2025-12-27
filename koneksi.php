<?php
$conn = mysqli_connect("localhost","root","","todolist");
if(!$conn){
  die("Koneksi gagal");
}
session_start();
