<?php
include '../config/koneksi.php';
include '../config/fuzzy.php';

if(@$_SESSION['level'] !== 'Admin') {
	echo "<script>window.location.href = '../index.php';</script>";
	exit();
}

function count_pegawai($id) {
	global $koneksi;
	$query = "SELECT COUNT(*) FROM pegawai WHERE id_posisi = $id";
	$result = $koneksi->query($query);
	$data = $result->fetch_array();
	return $data['COUNT(*)'];
}

?>