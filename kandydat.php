<?php
	require 'config.php';
	$album = $_GET["album"];
	if(empty($_SESSION['name'])){
		header('Location: zaloguj.php');
		exit();
	}
?>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png" />
	<link rel="icon" type="image/png" href="img/favicon.png" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Kandydat info - BRAMKA SMS PWSZ TARNOBRZEG</title>

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
						<?php
							try
							{
								$pdo = $connect;
								$pdo -> query ('SET NAMES utf8');
								$stmt = $pdo->query("SELECT * FROM kandydaci WHERE album='$album'");
								foreach($stmt as $row)
								{
									$imie = $row['imie']; 
									$nazwisko = $row['nazwisko']; 
									$kierunek = $row['kierunek']; 
									$rok = $row['rok']; 
								}
								$stmt->closeCursor();	  
							}
							
							catch(PDOException $e)
							{
							echo 'Połączenie nie mogło zostać utworzone.<br />';
							echo $e;
							}
						?>
			
							<div class='alert alert-success'>
								<center><strong><?php echo $imie." ".$nazwisko;?></strong><br/> <?php echo "<strong>Kierunek:</strong> ".$kierunek;?><br/><?php echo "<strong>Nr album:</strong> ".$album;?><br/> <?php echo "<strong>Rok studiów:</strong> ".$rok;?></center>
							</div>
							
	                        <div class="card">
	                            <div class="card-header" data-background-color="blue">
	                                <h4 class="title">Historia wiadomości</h4>
	                                <p class="category">Ostatnie wysyłane wiadomości do studenta</p>
	                            </div>
	                            <div class="card-content table-responsive">
									<?php
									try
										{
											$pdo = $connect;
											$pdo -> query ('SET NAMES utf8');
											$stmt = $pdo->query("SELECT * FROM historia_sms WHERE album='$album' ORDER BY data DESC");
											foreach($stmt as $row)
											{
												echo "<div class='panel panel-primary'>"; 
												echo "<div class='panel-heading'><strong>Wysłano dnia:</strong> ".$row['data']." - ".$row['autor']."</div>"; 
												echo "<div class='panel-body'><strong>TREŚĆ:</strong><br/>".$row['tresc']."</div>"; 
												echo "</div>"; 
											}
											$stmt->closeCursor();	  
										}
										catch(PDOException $e)
										{
										echo 'Połączenie nie mogło zostać utworzone.<br />';
										echo $e;
										}
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