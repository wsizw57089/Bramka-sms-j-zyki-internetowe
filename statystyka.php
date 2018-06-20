<?php
	require 'config.php';
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

	<title>Statystyka - BRAMKA SMS PWSZ TARNOBRZEG</title>

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
	                echo"<li class='active'>";
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
	    	</div>	    </div>

	    <div class="main-panel">
		    <div class="content">
	            <div class="container-fluid">
	                <div class="row">
	                    <div class="card">
	                            <div class="card-header" data-background-color="green">
	                                <h4 class="title">Statystyka wszystkich wysłanych wiadomości</h4>
	                                <p class="category">Na rok 2017</p>
	                            </div>
	                            <div class="card-content table-responsive">
	                                <table class="table">
	                                    <thead class="text-primary">
	                                    	<th>NR</th>
	                                    	<th>Miesiąc</th>
	                                    	<th>Ilość</th>
											<th>Oszczędność</th>
	                                    </thead>
	                                    <tbody>
										<?php
										$rok = date("Y");
										$styczen_baza = $rok."-01";
										$luty_baza = $rok."-02";
										$marzec_baza = $rok."-03";
										$kwiecien_baza = $rok."-04";
										$maj_baza = $rok."-05";
										$czerwiec_baza = $rok."-06";
										$lipiec_baza = $rok."-07";
										$sierpien_baza = $rok."-08";
										$wrzesien_baza = $rok."-09";
										$pazdziernik_baza = $rok."-10";
										$listopad_baza = $rok."-11";
										$grudzien_baza = $rok."-12";
											try
											{
												$pdo = $connect;
												$pdo -> query ('SET NAMES utf8');
												
												$stmt = $pdo->query("SELECT COUNT(*) FROM historia_sms WHERE stat_data='$styczen_baza'");
												$styczen = $stmt->fetchColumn() ;
												
												$stmt = $pdo->query("SELECT COUNT(*) FROM historia_sms WHERE stat_data='$luty_baza'");
												$luty = $stmt->fetchColumn() ;
												
												$stmt = $pdo->query("SELECT COUNT(*) FROM historia_sms WHERE stat_data='$marzec_baza'");
												$marzec = $stmt->fetchColumn() ;
												
												$stmt = $pdo->query("SELECT COUNT(*) FROM historia_sms WHERE stat_data='$kwiecien_baza'");
												$kwiecien = $stmt->fetchColumn() ;
												
												$stmt = $pdo->query("SELECT COUNT(*) FROM historia_sms WHERE stat_data='$maj_baza'");
												$maj = $stmt->fetchColumn() ;
												
												$stmt = $pdo->query("SELECT COUNT(*) FROM historia_sms WHERE stat_data='$czerwiec_baza'");
												$czerwiec = $stmt->fetchColumn() ;
												
												$stmt = $pdo->query("SELECT COUNT(*) FROM historia_sms WHERE stat_data='$lipiec_baza'");
												$lipiec = $stmt->fetchColumn() ;
												
												$stmt = $pdo->query("SELECT COUNT(*) FROM historia_sms WHERE stat_data='$sierpien_baza'");
												$sierpien = $stmt->fetchColumn() ;
												
												$stmt = $pdo->query("SELECT COUNT(*) FROM historia_sms WHERE stat_data='$wrzesien_baza'");
												$wrzesien = $stmt->fetchColumn() ;
												
												$stmt = $pdo->query("SELECT COUNT(*) FROM historia_sms WHERE stat_data='$pazdziernik_baza'");
												$pazdziernik = $stmt->fetchColumn() ;
												
												$stmt = $pdo->query("SELECT COUNT(*) FROM historia_sms WHERE stat_data='$listopad_baza'");
												$listopad = $stmt->fetchColumn() ;
												
												$stmt = $pdo->query("SELECT COUNT(*) FROM historia_sms WHERE stat_data='$grudzien_baza'");
												$grudzien = $stmt->fetchColumn() ;
												
												$stmt = $pdo->query("SELECT COUNT(*) FROM historia_sms WHERE stat_data BETWEEN '2017-01' AND '2017-12'");
												$all = $stmt->fetchColumn() ;

												$stmt->closeCursor();
											}	
											catch(PDOException $e)
											{
												echo 'Połączenie nie mogło zostać utworzone.<br />';
												echo $e;
											}
										?>
	                                        <tr>
	                                        	<td>1</td>
	                                        	<td>Styczeń <?php echo date("Y"); ?></td>
	                                        	<td><?php echo $styczen; ?></td>
												<td><?php echo $styczen*0.13; ?> zł</td>
	                                        </tr>
											<tr>
	                                        	<td>2</td>
	                                        	<td>Luty <?php echo date("Y"); ?></td>
	                                        	<td><?php echo $luty; ?></td>
												<td><?php echo $luty*0.13; ?> zł</td>
	                                        </tr>
											<tr>
	                                        	<td>3</td>
	                                        	<td>Marzec <?php echo date("Y"); ?></td>
	                                        	<td><?php echo $marzec; ?></td>
												<td><?php echo $marzec*0.13; ?> zł</td>
	                                        </tr>
											<tr>
	                                        	<td>4</td>
	                                        	<td>Kwiecień <?php echo date("Y"); ?></td>
	                                        	<td><?php echo $kwiecien; ?></td>
												<td><?php echo $kwiecien*0.13; ?> zł</td>
	                                        </tr>
											<tr>
	                                        	<td>5</td>
	                                        	<td>Maj <?php echo date("Y"); ?></td>
	                                        	<td><?php echo $maj; ?></td>
												<td><?php echo $maj*0.13; ?> zł</td>
	                                        </tr>
											<tr>
	                                        	<td>6</td>
	                                        	<td>Czerwiec <?php echo date("Y"); ?></td>
	                                        	<td><?php echo $czerwiec; ?></td>
												<td><?php echo $czerwiec*0.13; ?> zł</td>
	                                        </tr>
											<tr>
	                                        	<td>7</td>
	                                        	<td>Lipiec <?php echo date("Y"); ?></td>
	                                        	<td><?php echo $lipiec; ?></td>
												<td><?php echo $lipiec*0.13; ?> zł</td>
	                                        </tr>
											<tr>
	                                        	<td>8</td>
	                                        	<td>Sierpień <?php echo date("Y"); ?></td>
	                                        	<td><?php echo $sierpien; ?></td>
												<td><?php echo $sierpien*0.13; ?> zł</td>
	                                        </tr>
											<tr>
	                                        	<td>9</td>
	                                        	<td>Wrzesień <?php echo date("Y"); ?></td>
	                                        	<td><?php echo $wrzesien; ?></td>
												<td><?php echo $wrzesien*0.13; ?> zł</td>
	                                        </tr>
											<tr>
	                                        	<td>10</td>
	                                        	<td>Październik <?php echo date("Y"); ?></td>
	                                        	<td><?php echo $pazdziernik; ?></td>
												<td><?php echo $pazdziernik*0.13; ?> zł</td>
	                                        </tr>
											<tr>
	                                        	<td>11</td>
	                                        	<td>Listopad <?php echo date("Y"); ?></td>
	                                        	<td><?php echo $listopad; ?></td>
												<td><?php echo $listopad*0.13; ?> zł</td>
	                                        </tr>
											<tr>
	                                        	<td>12</td>
	                                        	<td>Grudzień <?php echo date("Y"); ?></td>
	                                        	<td><?php echo $grudzien; ?></td>
												<td><?php echo $grudzien*0.13; ?> zł</td>
	                                        </tr>
											<tr style="color:red;">
	                                        	<td>Łącznie wysłano w roku</td>
	                                        	<td><?php echo date("Y"); ?></td>
	                                        	<td><?php echo $all; ?></td>
												<td><?php echo $all*0.13; ?> zł</td>
	                                        </tr>
	                                    </tbody>
	                                </table>
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