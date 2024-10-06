<?php
include 'functions.php';
error_reporting(0);

$id = @$_GET['id'];
$foto = $koneksi->query("SELECT * FROM foto_admin WHERE id_admin=$id ORDER BY id DESC")->fetch_assoc();

header("Content-type: image/jpg");
echo $foto['file'];
?>