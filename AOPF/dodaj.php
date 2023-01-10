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
	echo "<i id='wyb'>Wybrałeś: \"Dodaj pracownika\"</i>";
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
</div>
<div class="zawar">
	<form action="" method="post">
	<h4>Podaj dane pracownika</h4>
	<p>Podaj imię pracownika: <input type="text" name="imie"></p>
	<p>Podaj nazwisko pracownika: <input type="text" name="nazwisko"></p>
	<p>Podaj wiek pracownika: <input type="number" name="wiek"></p>
	<p>Podaj staż pracownika: <input type="number" name="staz"></p>
	<p>Podaj stanowisko pracownika: <input type="text" name="stanowisko"></p>
	<p>Podaj wydział przypisany do pracownika: 
	<select name="wydzial">
		<option value=""></option>
		<option value="Dyrekcja">Dyrekcja</option>
		<option value="Ekonomia">Ekonomia</option>
		<option value="IT">IT</option>
		<option value="Biuro">Biuro</option>
		<option value="Produkcja">Produkcja</option>
		<option value="Zaopatrzenie">Zaopatrzenie</option>
		<option value="Kadry">Kadry</option>
		<option value="Inny">Inny</option>
	</select>
	</p>
	<p>Podaj pensje pracownika: <input type="number" name="pensja"></p>
	<p><input type="submit" name="dodaj" value="Dodaj"></p>
	<?php
	if(isset($_POST['dodaj'])){
		if($_POST['imie']!="" && $_POST['nazwisko']!="" && $_POST['wiek']!="" && $_POST['staz']!="" && $_POST['stanowisko']!="" && $_POST['wydzial']!="" && $_POST['pensja']!=""){
			$imie=$_POST['imie'];
			$nazwisko=$_POST['nazwisko'];
			$wiek=$_POST['wiek'];
			$staz=$_POST['staz'];
			$stanowisko=$_POST['stanowisko'];
			$wydzial=$_POST['wydzial'];
			$pensja=$_POST['pensja'];
			$data="20".date("y-m-d");
			if(($wiek>=15 && $wiek<=80) && $wiek-$staz>=15){
				if(strlen($imie)>=2 && strlen($nazwisko)>=2){
					$pol=mysqli_connect("localhost","root","","pracownicy_jagodzinski");
					mysqli_set_charset($pol,"utf8");
					$zapyt="INSERT INTO pracownicy VALUES(NULL,'$imie','$nazwisko','$wiek','$staz','$stanowisko','$wydzial','$pensja','$data');";
					if($wynik=mysqli_query($pol,$zapyt)) echo "<h3>Udało się zapisać do bazy!</h3>";
					else echo "<h3>Nieznany błąd w zapisywaniu do bazy!</h3>";
				}
				else echo "<h3>Imie bądź nazwisko jest za krótkie!</h3>";
			}
			else echo "<h3>Wiek jest zbyt mały bądź zbyt duży w porównaniu do stażu!</h3>";
		}
		else echo "<h3>Jedno z pól nie zostało wypełnionych!</h3>";
	}
	?>
	</form>
</div>
</body>
</html>