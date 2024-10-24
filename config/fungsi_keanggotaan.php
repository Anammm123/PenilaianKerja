<?php
function fungsiNaik($a, $b, $x) 
{
	# code...
	if ($x <= $a) {
		# code...
		return 0;
	} elseif ($x >= $a and $x <= $b) {
		# code...
		return ($x - $a)/($b-$a);
	} else {
		return 1;
	}
}

function fungsiTurun($a, $b, $x)
{
	# code...
	if ($x >= $a and $x <= $b) {
		# code...
		return ($b - $x)/($b - $a);
	} else {
		return 0;
	}
}

function fungsiSegitiga($a, $b, $c, $x)
{
	# code...
	if ($x <= $a or $x >= $c) {
		# code...
		return 0;
	} elseif ($a <= $x and $x <= $b) {
		# code...
		return ($x - $a)/($b-$a);
	} elseif ($b<=$x and $x<=$c) {
		# code...
		return ($c-$x)/($c-$b);
	}
}

/* function inv_fungsiTurun($a, $b, $x) {
	# code...
	if ($x > 0 and $x <= 1) {
		# code...
		$x1 = -($x*($b - $a) - $b);
		return ($x1-$a)*$x + ($b-$x1)*$x/2;
	} else {
		return 0;
	}
}

function inv_fungsiNaik($a, $b, $x) 
{
	# code...

	if ($x > 0 and $x <= 1) {
		# code...
		$x1 = $x*($b-$a) + $a ;
		return (($x1 - $a)*$x/2) + (($b - $x1)*$x);
	} else {
		return 0;
	}
}

function inv_fungsiSegitiga($a, $b, $c, $x)
{
	# code...
	if (0 < $x and $x <= 1) {
		# code...
		$x1 = $x * ($b-$a) + $a; # 0.6 * (20) + 40
		$x2 = -($x * ($c-$b) - $c); #-(0.6 * 20 - 80)
		return (($x1 - $a)*$x) + ($x2-$x1)*$x;
	} else {
		return 0;
	}
} */
#Variable Linguistik
function kecil($x) {
	return fungsiTurun(1, 50, $x);
}
function sedang_($x) {
	return fungsiSegitiga(10, 50, 90, $x);
}
function tinggi($x) {
	return fungsiNaik(50, 100, $x);
}

#Output Kinerja
function sangatBuruk($x) {
	return $x * 1;
}
function Buruk($x) {
	return $x * 25;
}
function Sedang($x) {
	return $x * 50;
}
function Baik($x) {
	return $x * 75;
}
function sangatBaik($x) {
	return $x * 100;
}

?>