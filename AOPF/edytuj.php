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
		if(isset($_POST['przycisk'])){
			if($_POST['opcja']==0) header("Location:index.php");
			elseif($_POST['opcja']==1) header("Location:dodaj.php");
			elseif($_POST['opcja']==2) header("Location:wyswietl.php");
			elseif($_POST['opcja']==3) header("Location:edytuj.php");
			elseif($_POST['opcja']==4) header("Location:usun.php");
		}
	}
	else echo "<i id='pol'>Błąd z połączenia z bazą!</i>";
	echo "<i id='wyb'>Wybrałeś: \"Edytuj pracownika\"</i>";
	?>
	<form action="" method="post">
	<p>Wybierz opcję</p>
	<p><select name="opcja">
		<option value="0">Powrót do strony głównej</option>
		<option value="1">Dodaj pracownika</option>
		<option value="2">Wyświetl pracowników</option>
		<option value="3">Edytuj pracownika</option>
		<option value="4">Usuń pracownika</option>
	</select></p>
	<p><input type="submit" name="przycisk" value="Wykonaj"></p>
	</form>
	<form action="" method="post">
	<p><input type="submit" name="edytuj" value="Przejdź do edycji"></p>
</div>
<div class="zawar">
<?php
if(isset($_POST['edytuj'])){
	header('location:edytuj2.php');
}
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
?>
</form>
</div>
</body>
</html>