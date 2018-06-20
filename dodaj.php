<?php
	require 'config.php';
	
	if(empty($_SESSION['name'])){
		header('Location: zaloguj.php');
	}	
	
	
	if(isset($_POST['student'])) 
	{
		$nazwisko = $_POST['nazwisko'];
		$imie = $_POST['imie'];
		$album = $_POST['album'];
		$rok = $_POST['rok'];
		$kierunek = $_POST['kierunek'];
		$spec = $_POST['spec'];
		$telefon = $_POST['telefon'];
		try
		{
			$pdo = $connect;
			$pdo -> query ('SET NAMES utf8');
			$stmt = $pdo->query("INSERT INTO studenci(id, nazwisko, imie, album, rok, kierunek, spec, telefon) VALUES('null','$nazwisko','$imie','$album','$rok','$kierunek','$spec','$telefon')");
			$stmt->closeCursor();
		$_SESSION['student_sukces'] = "Dodano studenta <strong>".$imie." ".$nazwisko."</strong> do bazy studenci";
		}

		catch(PDOException $e)
		{
		echo 'Połączenie nie mogło zostać utworzone.<br />';
		echo $e;
		}
	}
	
	if(isset($_POST['kandydat'])) 
	{
		$nazwisko = $_POST['nazwisko'];
		$imie = $_POST['imie'];
		$album = $_POST['album'];
		$rok = $_POST['rok'];
		$kierunek = $_POST['kierunek'];
		$spec = $_POST['spec'];
		$telefon = $_POST['telefon'];
		try
		{
			$pdo = $connect;
			$pdo -> query ('SET NAMES utf8');
			$stmt = $pdo->query("INSERT INTO kandydaci(id, nazwisko, imie, album, rok, kierunek, spec, telefon) VALUES('null','$nazwisko','$imie','$album','$rok','$kierunek','$spec','$telefon')");
			$stmt->closeCursor();
		$_SESSION['student_sukces'] = "Dodano kandydata <strong>".$imie." ".$nazwisko."</strong> do bazy kandydaci";
		}

		catch(PDOException $e)
		{
		echo 'Połączenie nie mogło zostać utworzone.<br />';
		echo $e;
		}
	}
	
	if(isset($_POST['podyplomowe'])) 
	{
		$nazwisko = $_POST['nazwisko'];
		$imie = $_POST['imie'];
		$rok = $_POST['rok'];
		$kierunek = $_POST['kierunek'];
		$telefon = $_POST['telefon'];
		try
		{
			$pdo = $connect;
			$pdo -> query ('SET NAMES utf8');
			$stmt = $pdo->query("INSERT INTO studia_podyplomowe(id, nazwisko, imie, rok, kierunek, telefon) VALUES('null','$nazwisko','$imie','$rok','$kierunek','$telefon')");
			$stmt->closeCursor();
		$_SESSION['student_sukces'] = "Dodano studenta studiów podyplomowych <strong>".$imie." ".$nazwisko."</strong> do bazy studia_podyplomowe`";
		}

		catch(PDOException $e)
		{
		echo 'Połączenie nie mogło zostać utworzone.<br />';
		echo $e;
		}
	}
	
	
?>
<html lang="en">
<head>
	<meta charset="utf-8" />
	<link rel="apple-touch-icon" sizes="76x76" href="img/apple-icon.png" />
	<link rel="icon" type="image/png" href="img/favicon.png" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

	<title>Dodaj osobę do bazy - BRAMKA SMS PWSZ TARNOBRZEG</title>

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
	    <div class="sidebar" data-color="red" data-image="img/sidebar-1.jpg">
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
					echo"<li class='active'>";
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
								if (isset($_SESSION['student_sukces'])){
									echo "<div class='alert alert-success'>";
										echo "<center><strong>SUKCES!</strong><br/> ".$_SESSION['student_sukces'].".<br/>Dodaj kolejną osobę lub wróć do panelu.</center>";
									echo "</div>";
									echo "<center><a href='index.php'><button type='button' class='btn btn-success'>Wróć panelu</button></a>
										  <a href='logout.php'><button type='button' class='btn btn-danger'>Wyloguj się</button></a></center>";
									unset($_SESSION['student_sukces']);
									}
								?>
	                        <div class="card">    
								<div class="card-header" data-background-color="green">
	                                <h4 class="title">Dodaj osobę do bazy</h4>
	                                <p class="category">Wybierz bazę z poniższego menu</p>
	                            </div>
	                            <div class="card-content table-responsive">
								<!-- Zakładki -->
									<ul class="nav nav-pills" role="tablist">
									  <li class="active"><a href="#stud" role="tab" data-toggle="tab">Dodaj studenta</a></li>
									  <li><a href="#kand" role="tab" data-toggle="tab">Dodaj kandydata</a></li>
									  <li><a href="#pod" role="tab" data-toggle="tab">Dodaj studenta podyplomówki</a></li>
									</ul><br/>

									<!-- Zawartość zakładek -->
									<div class="tab-content">
										<div class="tab-pane active" id="stud">
										  <form method="POST" action="">
											<div class="row">
												<div class="col-md-6">
													<div class="form-group label-floating">
														<label class="control-label">Imię</label>
														<input type="text" name="imie" class="form-control" required>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group label-floating">
														<label class="control-label">Nazwisko</label>
														<input type="text" name="nazwisko" class="form-control" required>
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-3">
													<div class="form-group label-floating">
														<label class="control-label">Numer albumu</label>
														<input type="text" name="album" class="form-control" required>
													</div>
												</div>
												<div class="col-md-3">
													<div class="form-group label-floating">
														<label class="control-label">Rok studiów (1, 2 ,3)</label>
														<input type="text" name="rok" class="form-control" required>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group label-floating">
														<label class="control-label">Numer telefonu</label>
														<input type="text" name="telefon" class="form-control" required>
													</div>
												</div>
											</div>

											<div class="row">
												<div class="col-md-6">
													<div class="form-group label-floating">
														<label class="control-label">Kierunek studiów</label>
														<input type="text" name="kierunek" class="form-control" required>
													</div>
												</div>
												<div class="col-md-6">
													<div class="form-group label-floating">
														<label class="control-label">Specjalność (jeśli istnieje)</label>
														<input type="text" name="spec" class="form-control" >
													</div>
												</div>
											</div>

											<button type="submit" name="student" class="btn btn-success btn-block">Dodaj studenta</button>
											<div class="clearfix"></div>
										</form>
										</div>
									
									  
									  
										<div class="tab-pane" id="kand">
											<form method="POST" action="">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group label-floating">
															<label class="control-label">Imię</label>
															<input type="text" name="imie" class="form-control" required>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group label-floating">
															<label class="control-label">Nazwisko</label>
															<input type="text" name="nazwisko" class="form-control" required>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-3">
														<div class="form-group label-floating">
															<label class="control-label">Numer albumu</label>
															<input type="text" name="album" class="form-control" required>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group label-floating">
															<label class="control-label">Rok studiów (1, 2 ,3)</label>
															<input type="text" name="rok" class="form-control" required>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group label-floating">
															<label class="control-label">Numer telefonu</label>
															<input type="text" name="telefon" class="form-control" required>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-6">
														<div class="form-group label-floating">
															<label class="control-label">Kierunek studiów</label>
															<input type="text" name="kierunek" class="form-control" required>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group label-floating">
															<label class="control-label">Specjalność (jeśli istnieje)</label>
															<input type="text" name="spec" class="form-control" >
														</div>
													</div>
												</div>

												<button type="submit" name="kandydat" class="btn btn-success btn-block">Dodaj kandydata</button>
												<div class="clearfix"></div>
											</form>
										</div>
									  
									  
										<div class="tab-pane" id="pod">
											<form method="POST" action="">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group label-floating">
															<label class="control-label">Imię</label>
															<input type="text" name="imie" class="form-control" required>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group label-floating">
															<label class="control-label">Nazwisko</label>
															<input type="text" name="nazwisko" class="form-control" required>
														</div>
													</div>
												</div>

												<div class="row">
													<div class="col-md-3">
														<div class="form-group label-floating">
															<label class="control-label">Rok studiów</label>
															<input type="text" name="rok" class="form-control" required>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group label-floating">
															<label class="control-label">Kierunek studiów</label>
															<input type="text" name="kierunek" class="form-control" required>
														</div>
													</div>
													<div class="col-md-3">
														<div class="form-group label-floating">
															<label class="control-label">Numer telefonu</label>
															<input type="text" name="telefon" class="form-control" required>
														</div>
													</div>
												</div>

												<button type="submit" name="podyplomowe" class="btn btn-success btn-block">Dodaj studenta podyplomówki</button>
												<div class="clearfix"></div>
											</form>
										</div>
									</div>
								</div>
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