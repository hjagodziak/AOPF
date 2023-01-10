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
	<p>Wpisz numer pracownika do edycji: <input type="number" name="numer"></p>
	<p><input type="submit" name="edytuj" value="Zacznij edytować"></p>
	</form>
</div>
<div class="zawar">
<form action="edytuj3.php" method="post">
<?php
if(isset($_POST['edytuj'])){
	$pol=mysqli_connect("localhost","root","","pracownicy_jagodzinski");
	mysqli_set_charset($pol,"utf8");
	$zapyt="SELECT * FROM pracownicy;";
	$wynik=mysqli_query($pol,$zapyt);
	$t=[];
	$i=0;
	while($wiersz=mysqli_fetch_array($wynik)){
		$t[$i]=$wiersz[0];
		$i++;
	}
	mysqli_close($pol);
	if($_POST['numer']!=""){
		$znacz=false;
		$numer=$_POST['numer'];
		for($j=0;$j<$i;$j++){
			if($t[$j]==$numer) $znacz=true;
		}
		if($znacz){
			$pol=mysqli_connect("localhost","root","","pracownicy_jagodzinski");
			mysqli_set_charset($pol,"utf8");
			echo "<h3>Numer pracownika do edycji: $numer</h3>";
			echo "<table>";
			echo "<tr><th>Imię</th><th>Nazwisko</th><th>Wiek</th><th>Staż</th><th>Stanowisko</th><th>Wydział</th><th>Pensja</th><th>Data_dodania</th></tr>";
			$zapyt="SELECT * FROM pracownicy WHERE Numer=$numer;";
			$wynik=mysqli_query($pol,$zapyt);
			while($wiersz=mysqli_fetch_array($wynik)){
				echo "<tr><td><input type='text' name='k1' value='$wiersz[1]' size='15'></td><td><input type='text' name='k2' value='$wiersz[2]' size='15'></td><td><input type='text' name='k3' value='$wiersz[3]' size='1'></td><td><input type='text' name='k4' value='$wiersz[4]' size='1'></td><td><input type='text' name='k5' value='$wiersz[5]' size='20'></td><td><input type='text' name='k6' value='$wiersz[6]' size='20'></td><td><input type='text' name='k7' value='$wiersz[7]' size='10'></td><td><input type='text' name='k8' value='$wiersz[8]' size='10'></td></tr>";
			}
			echo "</table>";
			echo '<p><input type="submit" name="zapisz" value="Zapisz zmiany"></p>';
			echo "<p><input type='hidden' name='numer' value='$numer'></p>";
			mysqli_close($pol);
		}
		else echo "<h3>Numer nie istnieje w bazie!</h3>";
	}
	else echo "<h3>Nie wpisano numeru pracownika!</h3>";
}
else {
	echo "<table>";
	echo "<tr><th>Numer</th><th>Imię</th><th>Nazwisko</th><th>Wiek</th><th>Staż</th><th>Stanowisko</th><th>Wydział</th><th>Pensja</th><th>Data_dodania</th></tr>";
	$pol=mysqli_connect("localhost","root","","pracownicy_jagodzinski");
	mysqli_set_charset($pol,"utf8");
	$zapyt="SELECT * FROM pracownicy;";
	$wynik=mysqli_query($pol,$zapyt);
	while($wiersz=mysqli_fetch_array($wynik)){
		echo "<tr><td>$wiersz[0]</td><td>$wiersz[1]</td><td>$wiersz[2]</td><td>$wiersz[3]</td><td>$wiersz[4]</td><td>$wiersz[5]</td><td>$wiersz[6]</td><td>$wiersz[7]</td><td>$wiersz[8]</td></tr>";
	}
	echo "</table>";
}
?>
</form>
</div>
</body>
</html>