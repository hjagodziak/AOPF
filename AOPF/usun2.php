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
	echo "<i id='wyb'>Wybrałeś: \"Usuń pracownika\"</i>";
	?>
	<form action="usun.php" method="post">
	<p><input type="submit" name="wroc" value="Wróć"></p>
	</form>
</div>
<div class="zawar">
<form action="usun3.php" method="post">
<?php
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
	$numer=$_POST['numer'];
	if(isset($_POST['usun'])){
		$znacz=false;
		$numer=$_POST['numer'];
		for($j=0;$j<$i;$j++){
			if($t[$j]==$numer) $znacz=true;
		}
		if($znacz){
			echo "<table>";
			echo "<tr><th>Numer</th><th>Imię</th><th>Nazwisko</th><th>Wiek</th><th>Staż</th><th>Stanowisko</th><th>Wydział</th><th>Pensja</th><th>Data_dodania</th></tr>";
			$pol=mysqli_connect("localhost","root","","pracownicy_jagodzinski");
			mysqli_set_charset($pol,"utf8");
			$zapyt="SELECT * FROM pracownicy WHERE numer=$numer;";
			$wynik=mysqli_query($pol,$zapyt);
			while($wiersz=mysqli_fetch_array($wynik)){
				$imie=$wiersz[1];
				$nazwisko=$wiersz[2];
				echo "<tr><td>$wiersz[0]</td><td>$wiersz[1]</td><td>$wiersz[2]</td><td>$wiersz[3]</td><td>$wiersz[4]</td><td>$wiersz[5]</td><td>$wiersz[6]</td><td>$wiersz[7]</td><td>$wiersz[8]</td></tr>";
			}
			echo "</table>";
			mysqli_close($pol);
			echo "<input type='hidden' name='imie' value='$imie'>";
			echo "<input type='hidden' name='nazwisko' value='$nazwisko'>";
			echo "<input type='hidden' name='numer2' value='$numer'>";
			echo "<h2 style='color: red'>CZY NA PEWNO CHCESZ USUNĄĆ PRACOWNIKA? <input type='submit' name='tak' value='TAK'> <input type='submit' name='nie' value='NIE'></h2>";
		}
		else echo "<h3>Numer nie istnieje w bazie!</h3>";
	}
}
else echo "<h3>Nie wprowadzono numeru pracownika!</h3>";
?>
</form>
</div>
</body>
</html>