<?php
include 'functions.php';
$id_pegawai = @$_GET['id'];

$result = $koneksi->query("DELETE FROM pegawai WHERE id_pegawai = $id_pegawai");
if($result) {
	echo "<script>window.location.href ='./?page=Pegawai';</script>";
}
?>