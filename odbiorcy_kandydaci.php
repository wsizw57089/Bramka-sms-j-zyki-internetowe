<?php
	require 'config.php';
	
	if(empty($_SESSION['name'])){
		header('Location: zaloguj.php');
	}
	
	if (isset($_POST['album'])) {
		$album = implode(',', $_POST['album']);  
	} elseif (isset($_POST['message'])) {
		$tresc = $_POST['message'];  
	} else {
		$_SESSION['blad'] = "Muszisz wybrać studenta/ów z listy";
		header('Location: baza.php');
		exit;
	}
	
	
?>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png" />
	<link rel="icon" type="image/png" href="img/favicon.png" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Odbiorcy kandydaci - BRAMKA SMS PWSZ TARNOBRZEG</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

	
	    <link rel="stylesheet" href="css/tablefilter.css">
	    <link rel="stylesheet" href="css/qunit.css">
        <script src="js/qunit.js"></script>
        <script src="js/polyfill.js"></script>

    <!-- Bootstrap core CSS     -->
    <link href="css/bootstrap.min.css" rel="stylesheet" />

    <!--  Material Dashboard CSS    -->
    <link href="css/material-dashboard.css" rel="stylesheet"/>

    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="css/demo.css" rel="stylesheet" />

    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300|Material+Icons' rel='stylesheet' type='text/css'>
</head>

<body>

	<div class="wrapper">
	    <div class="sidebar" data-color="red">
			<!--
		        Tip 1: You can change the color of the sidebar using: data-color="purple | blue | green | orange | red"
		    -->
			<div class="logo">
				<a href="" class="simple-text">
					Bramka PWSZ
				</a>
			</div>

	    	<div class="sidebar-wrapper">
	            <ul class="nav">
					<?php if(isset($_SESSION['name'])){
					echo"<li>";
	                    echo"<center><p>Zalogowany użytkownik<br><strong>".$_SESSION['name']."</strong></p></center>";
	                echo"</li>";
	                echo"<li>";
	                    echo"<a href='index.php'>";
	                        echo"<i class='material-icons'>dashboard</i>";
	                        echo"<p>Panel główny</p>";
	                    echo"</a>";
	                echo"</li>";
					echo"<li>";
	                    echo"<a href='sms_numer.php'>";
	                        echo"<i class='fa fa-envelope'></i>";
	                        echo"<p>Wyślij wiadomość</p>";
	                    echo"</a>";
	                echo"</li>";
	                echo"<li>";
	                    echo"<a href='baza_studenci.php'>";
	                        echo"<i class='fa fa-graduation-cap'></i>";
	                        echo"<p>Baza studentów</p>";
	                    echo"</a>";
	                echo"</li>";
					echo"<li class='active'>";
	                    echo"<a href='baza_kandydaci.php'>";
	                        echo"<i class='fa fa-users'></i>";
	                        echo"<p>Baza kandydaci</p>";
	                    echo"</a>";
	                echo"</li>";
					echo"<li>";
	                    echo"<a href='baza_podyplomowki.php'>";
	                        echo"<i class='fa fa-paperclip'></i>";
	                        echo"<p>Studia podyplomowe</p>";
	                    echo"</a>";
	                echo"</li>";
					echo"<li>";
	                    echo"<a href='dodaj.php'>";
	                        echo"<i class='fa fa-user-plus'></i>";
	                        echo"<p>Dodaj osobę</p>";
	                    echo"</a>";
	                echo"</li>";
	                echo"<li>";
	                    echo"<a href='statystyka.php'>";
	                        echo"<i class='fa fa-list-ul'></i>";
	                        echo"<p>Statystyka</p>";
	                    echo"</a>";
	                echo"</li>";
	                echo"<li>";
	                    echo"<a href='ustawienia.php'>";
	                        echo"<i class='fa fa-cog'></i>";
	                        echo"<p>Ustawienia</p>";
	                    echo"</a>";
	                echo"</li>";
					echo"<li>";
	                    echo"<a href='aktualizacja.php'>";
	                        echo"<i class='fa fa-database'></i>";
	                        echo"<p>Aktualizacja bazy</p>";
	                    echo"</a>";
	                echo"</li>";
					echo"<li>";
	                    echo"<a href='wyloguj.php'>";
	                        echo"<i class='fa fa-power-off'></i>";
	                        echo"<p>Wyloguj</p>";
	                    echo"</a>";
	                echo"</li>";
					}
					
					?>
	            </ul>
	    	</div>
	    </div>

	    <div class="main-panel">
		    <div class="content">
	            <div class="container-fluid">
	                <div class="row">
	                    <div class="col-md-12">
	                        <div class="card">
	                            <div class="card-header" data-background-color="blue">
	                                <h4 class="title">Wiadomość do kandydatów</h4>
	                                <p class="category">Wpisz treść, sprawdź czy zgadzają się osoby i wyślij</p>
	                            </div>
	                            <div class="card-content table-responsive">
								<?php
								if (isset($_POST['album'])) {
									echo "<div class='row'>";
										echo "<div class='col-md-12'>";
											echo "<div class='well well-sm'>";
												echo "<form class='form-horizontal' method='post' action=''>";
													echo "<fieldset>";
														echo "<div class='form-group'>";
															echo "<div class='col-md-12'>";
																echo "<textarea class='form-control' id='message' name='message' placeholder='Tu wpisz treść wiadomości bez polskich znaków' rows='2'></textarea>";
															echo "</div>";
														echo "</div>";
														echo "<div class='form-group'>";
															echo "<div class='col-md-12 text-center'>";
																echo "<button type='submit' class='btn btn-primary btn-lg'>Wyślij</button>";
															echo "</div>";
														echo "</div>";
													echo "</fieldset>";
												echo "</form>";
											echo "</div>";
										echo "</div>";
									echo "</div>";
									echo "<div class='row'>";
										echo "<div class='col-lg-12'>";
											echo "<div class='panel panel-primary filterable'>";
												echo "<div class='panel-heading'>";
												echo "	<h3 class='panel-title'><center>Lista osób które dostaną wiadomość SMS</center></h3>";
												echo "</div>";
												echo "<table class='table'>";
												echo "	<thead>";
													echo "	<tr>";
													echo "		<th><input type='text' class='form-control' placeholder='Nr albumu' disabled></th>";
													echo "		<th><input type='text' class='form-control' placeholder='Imię' disabled></th>";
													echo "		<th><input type='text' class='form-control' placeholder='Nazwisko' disabled></th>";
													echo "		<th><input type='text' class='form-control' placeholder='Kierunek' disabled></th>";
													echo "		<th><input type='text' class='form-control' placeholder='Rok' disabled></th>";
													echo "	</tr>";
													echo "</thead>";
													echo "<tbody>";
											
														$telefony = [];
														try
														{
															$pdo = $connect;
															$pdo -> query ('SET NAMES utf8');
															$stmt = $pdo->query("SELECT * FROM kandydaci WHERE album IN ($album)");
															foreach($stmt as $row)
															{
																echo "<tr>"; 
																$album_s[] = $row['album'];
																echo "<td>".$row['album']."</td>"; 
																echo "<td>".$row['imie']."</td>"; 
																echo "<td>".$row['nazwisko']."</td>"; 
																echo "<td>".$row['kierunek']."</td>"; 
																echo "<td>".$row['rok']."</td>"; 
																$telefony[] = $row['telefon']; 
																echo "</tr>"; 
															}
															$_SESSION['telefon_sesja'] = $telefony;
															$_SESSION['album_sesja'] = $album_s;
															$_SESSION['kategoria'] = "student";
															$stmt->closeCursor();	  
														}
														
														catch(PDOException $e)
														{
														echo 'Połączenie nie mogło zostać utworzone.<br />';
														echo $e;
														}
											} else	{
														echo "<div class='alert alert-success'>";
															echo "<center><strong>SUKCES!</strong><br/> Wiadomości zostały wysłane.</center>";
														echo "</div>";
														echo "<center><a href='baza_kandydaci.php'><button type='button' class='btn btn-success'>Wróć do bazy</button></a>
															  <a href='logout.php'><button type='button' class='btn btn-danger'>Wyloguj się</button></a></center>";
													}	
													
													echo "</tbody>";
												echo "</table>";
								?>
	                            </div>
	                        </div>
	                    </div>
	                </div>
	            </div>
	        </div>
	    </div>
	</div>

</body>

	<!--   Core JS Files   -->
	<script src="js/jquery-3.1.0.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
	<script src="js/material.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="js/chartist.min.js"></script>

	<!--  Notifications Plugin    -->
	<script src="js/bootstrap-notify.js"></script>

	<!-- Material Dashboard javascript methods -->
	<script src="js/material-dashboard.js"></script>

	<!-- Material Dashboard DEMO methods, don't include it in your project! -->
	<script src="js/demo.js"></script>
	
	<script src="js/tablefilter.js"></script>
	<script src="js/test-sort-custom-sorter.js"></script>

</html>
<?php
	
if (isset($_POST["message"])) {
$data = date("Y-m-d");
$stat_data = date("Y-m");
$numbers = $_SESSION['telefon_sesja'];
$album_session = $_SESSION['album_sesja'];
$autor = $_SESSION['name'];
$message = $tresc;
$kategoria = $_SESSION['kategoria'];

unset ($_SESSION['telefon_sesja']);
unset ($_SESSION['album_sesja']);
unset ($_SESSION['kategoria']);

	try
	{
		$pdo = $connect;
		$pdo -> query ('SET NAMES utf8');
		foreach ($album_session as $jeden_rekord) {
			$stmt = $pdo->query("INSERT INTO historia_sms VALUES (null, '$data', '$jeden_rekord', '$message', '$autor', '$kategoria', '$stat_data', 'null')");
			// wykonaj zapytanie do bazy.
		}
		$stmt->closeCursor();	  
	}
	catch(PDOException $e)
	{
	echo 'Połączenie nie mogło zostać utworzone.<br />';
	echo $e;
	}
	
	
	include "smsGateway.php";
	$smsGateway = new SmsGateway('daroxpl5@gmail.com', 'kamikadze123');

	$deviceID = 41762;
	


	$options = [
	'expires_at' => strtotime('+1 hour') // Cancel the message in 1 hour if the message is not yet sent
	];

	//Please note options is no required and can be left out
	$result = $smsGateway->sendMessageToManyNumbers($numbers, $message, $deviceID, $options);  
	var_dump($result);
}
?>