<?php
session_start();

$koneksi = mysqli_connect("localhost", "root", "", "db_kinerjapegawai");
if(!$koneksi) {
	echo "Koneksi Error!";
}
?>