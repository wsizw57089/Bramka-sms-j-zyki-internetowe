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
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Panel - BRAMKA SMS PWSZ TARNOBRZEG</title>

	<meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0' name='viewport' />
    <meta name="viewport" content="width=device-width" />

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
	                echo"<li class='active'>";
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
			<nav class="navbar navbar-transparent navbar-absolute">
				<div class="container-fluid">
					<div class="navbar-header">
						<button type="button" class="navbar-toggle" data-toggle="collapse">
							<span class="sr-only">Toggle navigation</span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
							<span class="icon-bar"></span>
						</button>
					</div>
				</div>
			</nav>
			
			<div class="content">
				<div class="container-fluid">
					<?php
						if (isset($_SESSION['uprawnienia'])){
							echo "<div class='alert alert-danger'><center>".$_SESSION['uprawnienia']."</center></div>";
							unset($_SESSION['uprawnienia']);
						}
					?>
					
					
					<div class="row">
					
					<?php
						try
						{
							$pdo = $connect;
							$pdo -> query ('SET NAMES utf8');
							$stmt = $pdo->query("SELECT COUNT(*) FROM studenci");
							$lstudentow = $stmt->fetchColumn() ;
							$stmt->closeCursor();
						}	
						catch(PDOException $e)
						{
							echo 'Połączenie nie mogło zostać utworzone.<br />';
							echo $e;
						}
					?>
					
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="card card-stats">
								<div class="card-header" data-background-color="red">
									<i class="fa fa-graduation-cap"></i>
								</div>
								<div class="card-content">
									<p class="category">Studenci</p>
									<h3 class="title"><?php echo $lstudentow; ?></h3>
								</div>
								<div class="card-footer">
									<div class="stats">
										<i class="material-icons">toc</i> Aktualna baza
									</div>
								</div>
							</div>
						</div>
					
					<?php
						try
						{
							$pdo = $connect;
							$pdo -> query ('SET NAMES utf8');
							$stmt = $pdo->query("SELECT COUNT(*) FROM kandydaci");
							$lkadydaci = $stmt->fetchColumn() ;
							$stmt->closeCursor();
						}	
						catch(PDOException $e)
						{
							echo 'Połączenie nie mogło zostać utworzone.<br />';
							echo $e;
						}
					?>
					
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="card card-stats">
								<div class="card-header" data-background-color="blue">
									<i class="fa fa-users"></i>
								</div>
								<div class="card-content">
									<p class="category">Kandydaci</p>
									<h3 class="title"><?php echo $lkadydaci; ?></h3>
								</div>
								<div class="card-footer">
									<div class="stats">
										<i class="material-icons">toc</i> Aktualna baza
									</div>
								</div>
							</div>
						</div>
					
					<?php
						try
						{
							$pdo = $connect;
							$pdo -> query ('SET NAMES utf8');
							$stmt = $pdo->query("SELECT COUNT(*) FROM historia_sms");
							$lwsms = $stmt->fetchColumn() ;
							$stmt->closeCursor();
						}	
						catch(PDOException $e)
						{
							echo 'Połączenie nie mogło zostać utworzone.<br />';
							echo $e;
						}
					?>
					
						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="card card-stats">
								<div class="card-header" data-background-color="orange">
									<i class="fa fa-envelope"></i>
								</div>
								<div class="card-content">
									<p class="category">SMS</p>
									<h3 class="title"><?php echo $lwsms; ?></h3>
								</div>
								<div class="card-footer">
									<div class="stats">
										<i class="material-icons">import_export</i> Wszystkie wysłane
									</div>
								</div>
							</div>
						</div>

						<div class="col-lg-3 col-md-6 col-sm-6">
							<div class="card card-stats">
								<div class="card-header" data-background-color="green">
									<i class="fa fa-money"></i>
								</div>
								<div class="card-content">
									<p class="category">Złotych</p>
									<h3 class="title">
										<?php 
											$koszty = $lwsms*0.13; 
											echo $koszty; 
										?>
									</h3>
								</div>
								<div class="card-footer">
									<div class="stats">
										<i class="material-icons">show_chart</i> Oszczędności na sms
									</div>
								</div>
							</div>
						</div>
					</div>
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

							$stmt->closeCursor();
						}	
						catch(PDOException $e)
							{
								echo 'Połączenie nie mogło zostać utworzone.<br />';
								echo $e;
							}
					?>
					<div class="row">
						<div class="col-lg-12 col-md-1">
							<div class="card">
								<div class="card-header" data-background-color="green">
									<h4 class="title">Wysłane wiadomości</h4>
									<p class="category">W skali bierzącego roku</p>
								</div>
								<div class="card-content table-responsive">
									<center><div style="width: 1000px; height: 500px" id="chart-container"></div></center>
								</div>
							</div>
						</div>
					</div>
					
					<div class="row">
						<div class="col-lg-12 col-md-12">	
							<div class="card">
								<div class="card-header" data-background-color="orange">
									<h4 class="title">Osoby uprawnione do wysyłania wiadomości</h4>
									<p class="category"></p>
								</div>
								<div class="card-content table-responsive">
									<table class="table table-hover">
										<thead class="text-warning">
											<th>Nazwisko</th>
											<th>Login</th>
											<th>Dział</th>
										</thead>
										<tbody>
											<?php
												try
												{
													$pdo = $connect;
													$pdo -> query ('SET NAMES utf8');
													$stmt = $pdo->query("SELECT * FROM uzytkownicy ORDER BY username ASC");
													foreach($stmt as $row)
													{
														echo "<tr>";
														echo "<td>".$row['fullname']."</td>";
														echo "<td>".$row['username']."</td>";
														echo "<td>".$row['dzial']."</td>";
														echo "</tr>";
													}
													$stmt->closeCursor();	  
												}
												catch(PDOException $e)
												{
													echo 'Połączenie nie mogło zostać utworzone.<br />';
													echo $e;
												}
											?>
										</tbody>
									</table>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</body>
<script src="js/RGraph.svg.common.core.js"></script>
<script src="js/RGraph.svg.bar.js"></script>
<script>
    // This is the source data
    data = {            
        source: [
            {rate: <?php echo  $grudzien; ?>, label: 'Grudzien'},
            {rate: <?php echo  $listopad; ?>, label: 'Listopad'},
            {rate: <?php echo  $pazdziernik; ?>, label: 'Pazdziernik'},
            {rate: <?php echo  $wrzesien; ?>, label: 'Wrzesień'},
            {rate: <?php echo  $sierpien; ?>, label: 'Sierpien'},
            {rate: <?php echo  $lipiec; ?>, label: 'Lipiec'},
            {rate: <?php echo  $czerwiec; ?>, label: 'Czerwiec'},
			{rate: <?php echo  $maj; ?>, label: 'Maj'},
            {rate: <?php echo  $kwiecien; ?>, label: 'Kwiecien'},
            {rate: <?php echo  $marzec; ?>, label: 'Marzec'},
            {rate: <?php echo  $luty; ?>, label: 'Luty'},
            {rate: <?php echo  $styczen; ?>, label: 'Styczen'}
        ],
        
        // These are for once the data has been extracted and split up from
        // the source
        data:   [],
        labels: []
    };

    // Reverse the data so that the latest figure is on the right
    data.source = RGraph.SVG.arrayReverse(data.source);
    
    
    // Loop through the source data extracting the required parts
    for (var i=0; i<data.source.length; ++i) {
        if (data.source[i]) {
            
            // Extract the data piece from the source data
            data.data[i] = data.source[i].rate;

            // Extract the label from the source data
            data.labels[i] = ((i+1) % 1 === 0 ? data.source[i].label : '');
        }
    }

    new RGraph.SVG.Bar({
        id: 'chart-container',
        data: data['data'],
        options: {
            xaxisLabels: data['labels'],
            colors: ['Gradient(red:white)'],
            strokestyle: '#DEDEDE',
            textFont: 'Monospace',
            textSize: 7,
            yaxisMax: 5000,
            hmargin: 4,
            backgroundGridColor: '#eee',
            backgroundGridVlines: false,
            backgroundGridBorder: false,
            yaxis: false,
            xaxis: false,
            yaxisDecimals: 0,
            labelsAbove: true,
            labelsAboveDecimals: 0,
            linewidth: 0.5
        }
    }).draw();
</script>

	<!--   Core JS Files   -->
	<script src="js/jquery-3.1.0.min.js" type="text/javascript"></script>
	<script src="js/bootstrap.min.js" type="text/javascript"></script>
	<script src="js/material.min.js" type="text/javascript"></script>

	<!--  Charts Plugin -->
	<script src="js/chartist.min.js"></script>

	<!--  Notifications Plugin    -->
	<script src="js/bootstrap-notify.js"></script>

	<!--  Google Maps Plugin    -->
	<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js"></script>

	<!-- Material Dashboard javascript methods -->
	<script src="js/material-dashboard.js"></script>

	<!-- Material Dashboard DEMO methods, don't include it in your project! -->
	<script src="js/demo.js"></script>

	<script type="text/javascript">
    	$(document).ready(function(){

			// Javascript method's body can be found in assets/js/demos.js
        	demo.initDashboardPageCharts();

    	});
	</script>

</html>
