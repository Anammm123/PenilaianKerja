<?php
include 'fungsi_keanggotaan.php';

function Fuzzy($x1, $x2, $x3, $x4) {
	#Variabel kedisiplinan
	//$x1 = @$_GET['kedisiplinan'];
	$kedisiplinan_besar = tinggi($x1);
	$kedisiplinan_sedang = sedang_($x1);
	$kedisiplinan_kecil = kecil($x1);

	#Variabel kejujuran
	//$x2 = @$_GET['kejujuran'];
	$kejujuran_besar = tinggi($x2);
	$kejujuran_sedang = sedang_($x2);
	$kejujuran_kecil = kecil($x2);

	#Variabel kepemimpinan
	//$x3 = @$_GET['kepemimpinan'];
	$kepemimpinan_besar = tinggi($x3);
	$kepemimpinan_sedang = sedang_($x3);
	$kepemimpinan_kecil = kecil($x3);

	#Variabel kerjasama
	//$x4 = @$_GET['kerjasama'];
	$kerjasama_besar = tinggi($x4);
	$kerjasama_sedang = sedang_($x4);
	$kerjasama_kecil = kecil($x4);

	#Output Kinerja:

	$rule = array();
	$z = array();
	#IF Kedisiplinan KECIL AND Kejujuran KECIL THEN Kinerja : Sangat Buruk
	$rule[0] = min($kedisiplinan_kecil, $kejujuran_kecil);
	$z[0] = sangatBuruk($rule[0]);

	#IF Kedisiplinan KECIL AND Kejujuran SEDANG THEN Kinerja : Buruk
	$rule[1] = min($kedisiplinan_kecil, $kejujuran_sedang);
	$z[1] = Buruk($rule[1]);

	#IF Kedisiplinan KECIL AND Kejujuran TINGGI THEN Kinerja : sedang
	$rule[2] = min($kedisiplinan_kecil, $kejujuran_besar);
	$z[2] = Sedang($rule[2]);

	#IF Kedisiplinan SEDANG AND Kejujuran KECIL THEN Kinerja : Buruk
	$rule[3] = min($kedisiplinan_sedang, $kejujuran_kecil);
	$z[3] = Buruk($rule[3]);

	#IF Kedisiplinan SEDANG AND Kejujuran SEDANG THEN Kinerja : sedang
	$rule[4] = min($kedisiplinan_sedang, $kejujuran_sedang);
	$z[4] = Sedang($rule[4]);

	#IF Kedisiplinan SEDANG AND Kejujuran TINGGI THEN Kinerja : Baik
	$rule[5] = min($kedisiplinan_sedang, $kejujuran_besar);
	$z[5] = Baik($rule[5]);

	#IF Kedisiplinan TINGGI  Kejujuran KECIL THEN Kinerja : Buruk
	$rule[6] = min($kedisiplinan_besar, $kejujuran_kecil);
	$z[6] = Buruk($rule[6]);

	#IF Kedisiplinan TINGGI AND Kejujuran SEDANG THEN Kinerja : Baik
	$rule[7] = min($kedisiplinan_besar, $kejujuran_sedang);
	$z[7] = Baik($rule[7]);

	#IF Kedisiplinan TINGGI AND Kejujuran TINGGI THEN Kinerja : Sangat Baik 
	$rule[8] = min($kedisiplinan_besar, $kejujuran_besar);
	$z[8] = sangatBaik($rule[8]);

	#IF Kepemimpinan KECIL AND Kerjasama KECIL THEN Kenirja : Sangat Buruk
	$rule[9] = min($kepemimpinan_kecil, $kerjasama_kecil);
	$z[9] = sangatBuruk($rule[9]);

	#IF Kepemimpinan KECIL AND Kerjasama SEDANG THEN Kenirja : Buruk
	$rule[10] = min($kepemimpinan_kecil, $kerjasama_sedang);
	$z[10] = Buruk($rule[10]);

	#IF Kepemimpinan KECIL AND Kerjasama TINGGI THEN Kenirja : sedang
	$rule[11] = min($kepemimpinan_kecil, $kerjasama_besar);
	$z[11] = Sedang($rule[11]);

	#IF Kepemimpinan SEDANG AND Kerjasama KECIL THEN Kenirja : Buruk
	$rule[12] = min($kepemimpinan_sedang, $kerjasama_kecil);
	$z[12] = Buruk($rule[12]);

	#IF Kepemimpinan SEDANG AND Kerjasama SEDANG THEN Kenirja : sedang
	$rule[13] = min($kepemimpinan_sedang, $kerjasama_sedang);
	$z[13] = Sedang($rule[13]);

	#IF Kepemimpinan SEDANG AND Kerjasama TINGGI THEN Kenirja : Baik
	$rule[14] = min($kepemimpinan_sedang, $kerjasama_besar);
	$z[14] = Baik($rule[14]);

	#IF Kepemimpinan TINGGI AND Kerjasama KECIL THEN Kenirja : Buruk
	$rule[15] = min($kepemimpinan_besar, $kerjasama_kecil);
	$z[15] = Buruk($rule[15]);

	#IF Kepemimpinan TINGGI AND Kerjasama SEDANG THEN Kenirja : Baik
	$rule[16] = min($kepemimpinan_besar, $kerjasama_sedang);
	$z[16] = Baik($rule[16]);

	#IF Kepemimpinan TINGGI AND Kerjasama TINGGI THEN Kenirja : Sangat Baik
	$rule[17] = min($kepemimpinan_besar, $kerjasama_besar);
	$z[17] = sangatBaik($rule[17]);

	$a = 0;
	$b = 0;
	for ($i = 0; $i<18; $i++) {
		/* echo "Rule $i: ".$rule[$i]."<br>";
		echo "Z $i: ".$z[$i]."<br>"; */
		$a += $z[$i];
		$b += $rule[$i];
	}
	return (($a/$b));
}

function kinerja($x) {
	if($x < 20 and $x > 0)
		echo "<center><legend class=\"btn-rounded btn-danger btn-lg\">Sangat Buruk</legend></center>";
	else if ($x < 40 and $x > 20)
		echo "<center><legend class=\"btn-rounded btn-warning btn-lg\">Buruk</legend></center>";
	else if ($x < 60 and $x > 40)
		echo "<center><legend class=\"btn-rounded btn-info btn-lg\">Normal</legend></center>";
	else if ($x < 80 and $x > 60)
		echo "<center><legend class=\"btn-rounded btn-primary btn-lg\">Baik</legend></center>";
	else
		echo "<center><legend class=\"btn-rounded btn-success btn-lg\">Sangat Baik</legend></center>";
}

?>