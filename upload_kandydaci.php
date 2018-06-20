<?php
require 'config.php';
	if(empty($_SESSION['name'])){
		header('Location: zaloguj.php');
		exit();
	}
$target_dir = "upload_kandydaci/";
$target_file = $target_dir . basename($_FILES["up_kandydat"]["name"]);
$uploadOk = 1;
$plik = pathinfo($target_file,PATHINFO_EXTENSION);
// Check if image file is a actual image or fake image
// Check if file already exists
if (file_exists($target_file)) {
    $_SESSION['upload_kandydaci_blad'] = "Taki plik już istnieje na serwerze, skasuj go z folderu <strong>upload_kandydaci</strong> i ponów próbe";
	header('Location: aktualizacja.php');
	exit;
}
// Check file size
if ($_FILES["up_kandydat"]["size"] > 500000) {
    $_SESSION['upload_kandydaci_blad'] = "Plik jest za duży";
	header('Location: aktualizacja.php');
	exit;
}
// Allow certain file formats
if($plik != "csv") {
    $_SESSION['upload_kandydaci_blad'] = "Plik nie jest bazą danych";
	header('Location: aktualizacja.php');
	exit;
}
// Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
// if everything is ok, try to upload file
} else {
    if (move_uploaded_file($_FILES["up_kandydat"]["tmp_name"], $target_file)) {

	$table = "kandydaci";
	$fieldseparator = ","; 
	$lineseparator = "\n";
	$csvfile = "upload_kandydaci/baza.csv";
	
	try
		{
			$pdo = $connect;
			$pdo -> query ('SET NAMES utf8');
			
			//kasuję starą baze
			$stmt = $pdo->query("DROP TABLE $table;") ;
			//zaciagam nową baze z pliku
			$stmt = $pdo->query("CREATE table $table(
					 id INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
					 nazwisko TEXT( 50 ) NOT NULL, 
					 imie TEXT( 50 ) NOT NULL,
					 album INT( 6 ) NOT NULL, 
					 rok INT( 4 ) NOT NULL, 
					 kierunek TEXT( 40 ) NOT NULL, 
					 spec TEXT( 40 ) NOT NULL,
					 telefon VARCHAR( 11 ) NOT NULL);") ;
			//zaciagam plik csv do bazy		 
			$stmt = $pdo->query(
							"LOAD DATA LOCAL INFILE "
							.$pdo->quote($csvfile)
							." INTO TABLE `$table` FIELDS TERMINATED BY "
							.$pdo->quote($fieldseparator)
							."LINES TERMINATED BY "
							.$pdo->quote($lineseparator)
						  );
			array_map('unlink', glob("upload_kandydaci/*.csv"));
			$stmt->closeCursor();
		}	
		catch(PDOException $e)
		{
			echo 'Połączenie nie mogło zostać utworzone.<br />';
			echo $e;
		}
		
		$_SESSION['upload_kandydaci_ok'] = "Baza została poprawnie zaktualizowana";
		header('Location: aktualizacja.php');
		exit;
    } else {
        $_SESSION['upload_kandydaci_blad'] = "Wystąpił błąd podczas wysyłania pliku na serwer";
		header('Location: aktualizacja.php');
		exit;
    }
}
?>