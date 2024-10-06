<?php
include 'functions.php';
error_reporting(0);

$id = @$_GET['id'];
$foto = $koneksi->query("SELECT * FROM foto_pegawai WHERE id_pegawai=$id ORDER BY id DESC")->fetch_assoc();

header("Content-type: image/jpg");
echo $foto['file'];
?>