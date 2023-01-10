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
<?php
if(isset($_POST['tak'])){
	$numer=$_POST['numer2'];
	$imie=$_POST['imie'];
	$nazwisko=$_POST['nazwisko'];
	$pol=mysqli_connect("localhost","root","","pracownicy_jagodzinski");
	mysqli_set_charset($pol,"utf8");
	$zapyt="DELETE FROM pracownicy WHERE numer=$numer;";
	$wynik=mysqli_query($pol,$zapyt);
	if($wynik) echo "<h3>Usunięto pracownika $imie $nazwisko</h3>";
	else echo "<h3>Błąd podczas usuwania pracownika!</h3>";
	mysqli_close($pol);
}
elseif(isset($_POST['nie'])){
	$numer=$_POST['numer2'];
	$imie=$_POST['imie'];
	$nazwisko=$_POST['nazwisko'];
	$pol=mysqli_connect("localhost","root","","pracownicy_jagodzinski");
	mysqli_set_charset($pol,"utf8");
	$zapyt="SELECT * FROM pracownicy WHERE numer=$numer;";
	$wynik=mysqli_query($pol,$zapyt);
	while($wiersz=mysqli_fetch_array($wynik)){
		$wiersz[1]=$imie;
		$wiersz[2]=$nazwisko;
	}
	mysqli_close($pol);
	echo "<h3>Zrezygnowałeś z usunięcia pracownika $imie $nazwisko</h3>";
}
?>
</div>
</body>
</html>