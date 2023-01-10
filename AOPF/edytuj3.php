<html lang="pl-PL">
<head>
	<meta charset="utf-8">
	<link rel="stylesheet" href="styl.css">
	<?php
	include("skrypt.php");
	?>
</head>
<body>
<h2>Aplikacja do obsługi pracowników firmy</h2>
<div class="menu">
	<?php
	if(polacz()){
		echo "<i id='pol'>Prawidłowe połączenie z bazą</i>";
		if(isset($_POST['przycisk'])) header("Location:edytuj.php");
	}
	else echo "<i id='pol'>Błąd z połączenia z bazą!</i>";
	echo "<i id='wyb'>Wybrałeś: \"Edytuj pracownika\"</i>";
	?>
	<form action="" method="post">
	<p><input type="submit" name="przycisk" value="Wróć"></p>
	</form>
</div>
<div class="zawar">
<?php
if($_POST['k1']!="" && $k2=$_POST['k2']!=""){
	if(isset($_POST['zapisz'])){
		$numer=$_POST['numer'];
		$pol=mysqli_connect("localhost","root","","pracownicy_jagodzinski");
		mysqli_set_charset($pol,"utf8");
		$k1=$_POST['k1'];
		$k2=$_POST['k2'];
		$k3=$_POST['k3'];
		$k4=$_POST['k4'];
		$k5=$_POST['k5'];
		$k6=$_POST['k6'];
		$k7=$_POST['k7'];
		$k8=$_POST['k8'];
		$zapyt="UPDATE pracownicy SET imię='$k1', nazwisko='$k2', wiek='$k3', staż='$k4', stanowisko='$k5', wydział='$k6', pensja='$k7', data_dodania='$k8' WHERE numer=$numer;";
		if($wynik=mysqli_query($pol,$zapyt)) echo "<h3>Udało się zmienić dane w bazie!</h3>";
		else echo "<h3>Błąd w modyfikacji danych!</h3>";
		mysqli_close($pol);
	}
}
else echo "<h3>Imię bądź nazwisko nie może pozostać puste!</h3>";
?>
</div>
</body>
</html>