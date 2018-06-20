<?php
	require 'config.php';
	
	if(empty($_SESSION['name'])){
		header('Location: zaloguj.php');
	}	
	
	if (isset($_POST['wyslij'])) {
		if (!empty($_POST['telefon']) && $_POST['tresc']){
			$telefon = $_POST['telefon'];
			$tresc = $_POST['tresc'];
			include "smsGateway.php";
			$smsGateway = new SmsGateway('daroxpl5@gmail.com', 'kamikadze123');

			$deviceID = 41762;
			$number = $telefon;
			$message = $tresc;

			$options = [
			'expires_at' => strtotime('+1 hour') // Cancel the message in 1 hour if the message is not yet sent
			];

			//Please note options is no required and can be left out
			$result = $smsGateway->sendMessageToNumber($number, $message, $deviceID, $options);
			$_SESSION['sms_sukces'] = "<center><strong>SUKCES!</strong><br/> Wiadomość została wysłana do numeru: <strong>".$number."</strong></center>";
		} else {
			$_SESSION['sms_blad'] = "Uzupełnij treść oraz numer telefonu odbiorcy wiadomości";
		}
	}
?>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png" />
	<link rel="icon" type="image/png" href="img/favicon.png" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Sms do numeru - BRAMKA SMS PWSZ TARNOBRZEG</title>

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
					echo"<li class='active'>";
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
					echo"<li>";
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
							if (isset($_SESSION['sms_sukces']))
								{	
								echo "<div class='alert alert-success'>";
									echo $_SESSION['sms_sukces'];
									unset ($_SESSION['sms_sukces']);
								echo "</div>";
									echo "<center><a href='sms_numer.php'><button type='button' class='btn btn-success'>Wyślij kolejną wiadomość</button></a>
										  <a href='logout.php'><button type='button' class='btn btn-danger'>Wyloguj się</button></a></center>";
								} else {
								echo "<div class='card'>";
									echo "<div class='card-header' data-background-color='green'>";
										echo "<h4 class='title'>Wiadomość do numeru</h4>";
										echo "<p class='category'>Wyślij SMS do osoby niewpisanej do bazy dziekanatowej</p>";
									echo "</div>";
									echo "<div class='card-content table-responsive'>";
											if (isset($_SESSION['sms_blad']))
												{
													echo "<div class='alert alert-danger'><center>".$_SESSION['sms_blad']."</center></div>";
													unset($_SESSION['sms_blad']);
												}
										echo "<form method='POST' action=''>";
											echo "<div class='row'>";
												echo "<div class='col-md-12'>";
													echo "<div class='form-group label-floating'>";
														echo "<label class='control-label'>Numer telefonu</label>";
														echo "<input type='text' class='form-control' name='telefon'>";
													echo "</div>";
												echo "</div>";
											echo "</div>";
											
											echo "<div class='row'>";
												echo "<div class='col-md-12'>";
													echo "<div class='form-group label-floating'>";
														echo "<label class='control-label'>Treść wiadomości</label>";
														echo "<textarea class='form-control' rows='2' name='tresc'></textarea>";
													echo "</div>";
												echo "</div>";
											echo "</div>";
											echo "<button type='submit' class='btn btn-success btn-block' name='wyslij'>Wyślij wiadomość</button>";
											echo "<div class='clearfix'></div>";
										echo "</form>";
									echo "</div>";
								echo "</div>";
								}
							?>
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