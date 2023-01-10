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
<div class="menu" style="height: auto;">
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
	echo "<i id='wyb'>Wybrałeś: \"Wyświetl pracowników\"</i>";
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
	<p>Wyświetl według:</p>
	<p><select name="wedlug">
		<option value="Numer">Numer</option>
		<option value="Nazwisko">Alfabetycznie</option>
		<option value="Wiek">Wiek</option>
		<option value="Staż">Staż</option>
		<option value="Data_dodania DESC">Od „najświeższych”</option>
		<option value="Data_dodania ASC">Do „najstarszych”</option>
	</select></p>
	<p>Podaj wydział:</p>
	<input type="radio" name="wydzial" value="" checked>Dowolny <input type="radio" name="wydzial" value="IT">Dział IT <input type="radio" name="wydzial" value="Kadry">Kadry <input type="radio" name="wydzial" value="Ekonomia">Ekonomia <input type="radio" name="wydzial" value="Kadry">Kadry <input type="radio" name="wydzial" value="Kadry">Kadry <input type="radio" name="wydzial" value="Dyrekcja">Dyrekcja <input type="radio" name="wydzial" value="Kadry">Kadry<br><input type="radio" name="wydzial" value="Zaopatrzenie">Zaopatrzenie <input type="radio" name="wydzial" value="Kadry">Kadry <input type="radio" name="wydzial" value="Produkcja">Produkcja <input type="radio" name="wydzial" value="Biuro">Biuro <input type="radio" name="wydzial" value="Inny">Inny
	<input type="hidden" name="pensja" value="0">
	<p><input type="checkbox" name="pensja" value="1"> Pokaż pensje</p>
	<p>Większa pensja od: <input type="number" name="pensja2"></p>
	<p><input type="submit" name="filtruj" value="Filtruj dane"></p>
	<p><input type="submit" name="wyswietl" value="Wszyscy pracownicy"></p>
	</form>
</div>
<div class="zawar">
<?php
if(isset($_POST['filtruj'])){
	$pensja2=$_POST['pensja2'];
	echo "<table>";
	$pol=mysqli_connect("localhost","root","","pracownicy_jagodzinski");
	mysqli_set_charset($pol,"utf8");
	$wedlug=$_POST['wedlug'];
	$wydzial=$_POST['wydzial'];
	$pensja=$_POST['pensja'];
	if($_POST['pensja2']!=""){
		$pensja2=$_POST['pensja2'];
		if($pensja==1) $zapyt="SELECT * FROM pracownicy WHERE wydział LIKE '%$wydzial%' AND pensja>$pensja2 ORDER BY $wedlug;";
		else $zapyt="SELECT numer, imię, nazwisko, wiek, staż, stanowisko, wydział, data_dodania FROM pracownicy WHERE wydział LIKE '%$wydzial%' AND pensja>$pensja2 ORDER BY $wedlug;";
		$wynik=mysqli_query($pol,$zapyt);
		if($pensja==1){
			echo "<tr><th>Numer</th><th>Imię</th><th>Nazwisko</th><th>Wiek</th><th>Staż</th><th>Stanowisko</th><th>Wydział</th><th>Pensja</th><th>Data_dodania</th></tr>";
			while($wiersz=mysqli_fetch_array($wynik)){
				echo "<tr><td>$wiersz[0]</td><td>$wiersz[1]</td><td>$wiersz[2]</td><td>$wiersz[3]</td><td>$wiersz[4]</td><td>$wiersz[5]</td><td>$wiersz[6]</td><td>$wiersz[7]</td><td>$wiersz[8]</td></tr>";
			}
		}
		else {
			echo "<tr><th>Numer</th><th>Imię</th><th>Nazwisko</th><th>Wiek</th><th>Staż</th><th>Stanowisko</th><th>Wydział</th><th>Data_dodania</th></tr>";
			while($wiersz=mysqli_fetch_array($wynik)){
				echo "<tr><td>$wiersz[0]</td><td>$wiersz[1]</td><td>$wiersz[2]</td><td>$wiersz[3]</td><td>$wiersz[4]</td><td>$wiersz[5]</td><td>$wiersz[6]</td><td>$wiersz[7]</td></tr>";
			}
		}
		echo "</table>";
		mysqli_close($pol);
		if($pensja==1) $zapyt="SELECT * FROM pracownicy WHERE wydział LIKE '%$wydzial%' AND pensja>$pensja2 ORDER BY $wedlug;";
		else $zapyt="SELECT numer, imię, nazwisko, wiek, staż, stanowisko, wydział, data_dodania FROM pracownicy WHERE wydział LIKE '%$wydzial%' AND pensja>$pensja2 ORDER BY $wedlug;";
	}
	else{
		if($pensja==1) $zapyt="SELECT * FROM pracownicy WHERE wydział LIKE '%$wydzial%' ORDER BY $wedlug;";
		else $zapyt="SELECT numer, imię, nazwisko, wiek, staż, stanowisko, wydział, data_dodania FROM pracownicy WHERE wydział LIKE '%$wydzial%' ORDER BY $wedlug;";
		$wynik=mysqli_query($pol,$zapyt);
		if($pensja==1){
			echo "<tr><th>Numer</th><th>Imię</th><th>Nazwisko</th><th>Wiek</th><th>Staż</th><th>Stanowisko</th><th>Wydział</th><th>Pensja</th><th>Data_dodania</th></tr>";
			while($wiersz=mysqli_fetch_array($wynik)){
				echo "<tr><td>$wiersz[0]</td><td>$wiersz[1]</td><td>$wiersz[2]</td><td>$wiersz[3]</td><td>$wiersz[4]</td><td>$wiersz[5]</td><td>$wiersz[6]</td><td>$wiersz[7]</td><td>$wiersz[8]</td></tr>";
			}
		}
		else {
			echo "<tr><th>Numer</th><th>Imię</th><th>Nazwisko</th><th>Wiek</th><th>Staż</th><th>Stanowisko</th><th>Wydział</th><th>Data_dodania</th></tr>";
			while($wiersz=mysqli_fetch_array($wynik)){
				echo "<tr><td>$wiersz[0]</td><td>$wiersz[1]</td><td>$wiersz[2]</td><td>$wiersz[3]</td><td>$wiersz[4]</td><td>$wiersz[5]</td><td>$wiersz[6]</td><td>$wiersz[7]</td></tr>";
			}
		}
		echo "</table>";
	}
	echo "<br><table>";
	if($_POST['pensja2']!=""){
		$pensja2=$_POST['pensja2'];
		$zapyt="SELECT avg(pensja), avg(wiek), avg(staż) FROM pracownicy WHERE wydział LIKE '%$wydzial%' AND pensja>$pensja2  ORDER BY $wedlug;";
		$pol=mysqli_connect("localhost","root","","pracownicy_jagodzinski");
		$wynik=mysqli_query($pol,$zapyt);
		echo "<tr><th>Średnia pensja</th><th>Średni wiek</th><th>Średni staż</th></tr>";
		while($wiersz=mysqli_fetch_array($wynik)){
			echo "<tr><td>".round($wiersz[0],2)."</td><td>".round($wiersz[1],2)."</td><td>".round($wiersz[2],2)."</td></tr>";
		}
	}
	else {
		$pensja2=$_POST['pensja2'];
		$zapyt="SELECT avg(pensja), avg(wiek), avg(staż) FROM pracownicy WHERE wydział LIKE '%$wydzial%' ORDER BY $wedlug;";
		$wynik=mysqli_query($pol,$zapyt);
		echo "<tr><th>Średnia pensja</th><th>Średni wiek</th><th>Średni staż</th></tr>";
		while($wiersz=mysqli_fetch_array($wynik)){
			echo "<tr><td>".round($wiersz[0],2)."</td><td>".round($wiersz[1],2)."</td><td>".round($wiersz[2],2)."</td></tr>";
		}
	}
	echo "</table>";
	mysqli_close($pol);
	if($_POST['pensja2']!=""){
		echo "<br><table>";
		$pol=mysqli_connect("localhost","root","","pracownicy_jagodzinski");
		mysqli_set_charset($pol,"utf8");
		$zapyt="SELECT * FROM pracownicy WHERE pensja=(SELECT max(pensja) FROM pracownicy WHERE pensja>$pensja2 AND wydział LIKE '%$wydzial%');";
		$wynik=mysqli_query($pol,$zapyt);
		if($pensja==1){
			echo "<tr><th>Numer</th><th>Imię</th><th>Nazwisko</th><th>Wiek</th><th>Staż</th><th>Stanowisko</th><th>Wydział</th><th>Pensja</th><th>Data_dodania</th></tr>";
			while($wiersz=mysqli_fetch_array($wynik)){
				echo "<tr><td>$wiersz[0]</td><td>$wiersz[1]</td><td>$wiersz[2]</td><td>$wiersz[3]</td><td>$wiersz[4]</td><td>$wiersz[5]</td><td>$wiersz[6]</td><td>$wiersz[7]</td><td>$wiersz[8]</td></tr>";
			}
		}
		else {
			echo "<tr><th>Numer</th><th>Imię</th><th>Nazwisko</th><th>Wiek</th><th>Staż</th><th>Stanowisko</th><th>Wydział</th><th>Data_dodania</th></tr>";
			while($wiersz=mysqli_fetch_array($wynik)){
				echo "<tr><td>$wiersz[0]</td><td>$wiersz[1]</td><td>$wiersz[2]</td><td>$wiersz[3]</td><td>$wiersz[4]</td><td>$wiersz[5]</td><td>$wiersz[6]</td><td>$wiersz[8]</td></tr>";
			}
		}
		echo "</table>";
		mysqli_close($pol);
	}
	else {
		echo "<br><table>";
		$pol=mysqli_connect("localhost","root","","pracownicy_jagodzinski");
		mysqli_set_charset($pol,"utf8");
		$zapyt="SELECT * FROM pracownicy WHERE pensja=(SELECT max(pensja) FROM pracownicy WHERE wydział LIKE '%$wydzial%');";
		$wynik=mysqli_query($pol,$zapyt);
		if($pensja==1){
			echo "<tr><th>Numer</th><th>Imię</th><th>Nazwisko</th><th>Wiek</th><th>Staż</th><th>Stanowisko</th><th>Wydział</th><th>Pensja</th><th>Data_dodania</th></tr>";
			while($wiersz=mysqli_fetch_array($wynik)){
				echo "<tr><td>$wiersz[0]</td><td>$wiersz[1]</td><td>$wiersz[2]</td><td>$wiersz[3]</td><td>$wiersz[4]</td><td>$wiersz[5]</td><td>$wiersz[6]</td><td>$wiersz[7]</td><td>$wiersz[8]</td></tr>";
			}
		}
		else {
			echo "<tr><th>Numer</th><th>Imię</th><th>Nazwisko</th><th>Wiek</th><th>Staż</th><th>Stanowisko</th><th>Wydział</th><th>Data_dodania</th></tr>";
			while($wiersz=mysqli_fetch_array($wynik)){
				echo "<tr><td>$wiersz[0]</td><td>$wiersz[1]</td><td>$wiersz[2]</td><td>$wiersz[3]</td><td>$wiersz[4]</td><td>$wiersz[5]</td><td>$wiersz[6]</td><td>$wiersz[8]</td></tr>";
			}
		}
		echo "</table>";
		mysqli_close($pol);
	}
}
if(isset($_POST['wyswietl'])){
	echo "<table>";
	$pol=mysqli_connect("localhost","root","","pracownicy_jagodzinski");
	mysqli_set_charset($pol,"utf8");
	$pensja=$_POST['pensja'];
	$zapyt="SELECT * FROM pracownicy;";
	$wynik=mysqli_query($pol,$zapyt);
	if($pensja==1){
		echo "<tr><th>Numer</th><th>Imię</th><th>Nazwisko</th><th>Wiek</th><th>Staż</th><th>Stanowisko</th><th>Wydział</th><th>Pensja</th><th>Data_dodania</th></tr>";
		while($wiersz=mysqli_fetch_array($wynik)){
			echo "<tr><td>$wiersz[0]</td><td>$wiersz[1]</td><td>$wiersz[2]</td><td>$wiersz[3]</td><td>$wiersz[4]</td><td>$wiersz[5]</td><td>$wiersz[6]</td><td>$wiersz[7]</td><td>$wiersz[8]</td></tr>";
		}
	}
	else {
		echo "<tr><th>Numer</th><th>Imię</th><th>Nazwisko</th><th>Wiek</th><th>Staż</th><th>Stanowisko</th><th>Wydział</th><th>Data_dodania</th></tr>";
		while($wiersz=mysqli_fetch_array($wynik)){
			echo "<tr><td>$wiersz[0]</td><td>$wiersz[1]</td><td>$wiersz[2]</td><td>$wiersz[3]</td><td>$wiersz[4]</td><td>$wiersz[5]</td><td>$wiersz[6]</td><td>$wiersz[8]</td></tr>";
		}
	}
	echo "</table>";
	mysqli_close($pol);
	echo "<br><table>";
	$pol=mysqli_connect("localhost","root","","pracownicy_jagodzinski");
	mysqli_set_charset($pol,"utf8");
	$zapyt="SELECT avg(pensja), avg(wiek), avg(staż) FROM pracownicy;";
	$wynik=mysqli_query($pol,$zapyt);
	echo "<tr><th>Średnia pensja</th><th>Średni wiek</th><th>Średni staż</th></tr>";
	while($wiersz=mysqli_fetch_array($wynik)){
		echo "<tr><td>".round($wiersz[0],2)."</td><td>".round($wiersz[1],2)."</td><td>".round($wiersz[2],2)."</td></tr>";
	}
	echo "</table>";
	mysqli_close($pol);
	echo "<br><table>";
	$pol=mysqli_connect("localhost","root","","pracownicy_jagodzinski");
	mysqli_set_charset($pol,"utf8");
	$zapyt="SELECT * FROM pracownicy WHERE pensja=(SELECT max(pensja) FROM pracownicy);";
	$wynik=mysqli_query($pol,$zapyt);
	if($pensja==1){
		echo "<tr><th>Numer</th><th>Imię</th><th>Nazwisko</th><th>Wiek</th><th>Staż</th><th>Stanowisko</th><th>Wydział</th><th>Pensja</th><th>Data_dodania</th></tr>";
		while($wiersz=mysqli_fetch_array($wynik)){
			echo "<tr><td>$wiersz[0]</td><td>$wiersz[1]</td><td>$wiersz[2]</td><td>$wiersz[3]</td><td>$wiersz[4]</td><td>$wiersz[5]</td><td>$wiersz[6]</td><td>$wiersz[7]</td><td>$wiersz[8]</td></tr>";
		}
	}
	else {
		echo "<tr><th>Numer</th><th>Imię</th><th>Nazwisko</th><th>Wiek</th><th>Staż</th><th>Stanowisko</th><th>Wydział</th><th>Data_dodania</th></tr>";
		while($wiersz=mysqli_fetch_array($wynik)){
			echo "<tr><td>$wiersz[0]</td><td>$wiersz[1]</td><td>$wiersz[2]</td><td>$wiersz[3]</td><td>$wiersz[4]</td><td>$wiersz[5]</td><td>$wiersz[6]</td><td>$wiersz[8]</td></tr>";
		}
	}
	echo "</table>";
	mysqli_close($pol);
}
?>
</div>
</body>
</html>