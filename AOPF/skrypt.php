<?php
function polacz() {
	$pol=mysqli_connect("localhost","root","","pracownicy_jagodzinski");
	if($pol) return true;
	else return false;
}
?>
