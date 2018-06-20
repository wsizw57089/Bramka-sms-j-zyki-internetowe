<?php
	require 'config.php';
	if(!empty($_SESSION['name'])){
		header('Location: index.php');
		exit();
	}
	if(isset($_POST['login'])) {
		$errMsg = '';

		// Get data from FORM
		$username = $_POST['username'];
		$password = $_POST['password'];

		if($username == '')
			$errMsg = 'Podaj nazwe użytkownika';
		if($password == '')
			$errMsg = 'Podaj hasło';

		if($errMsg == '') {
			try {
				$stmt = $connect->prepare('SELECT id, fullname, username, password, dzial FROM uzytkownicy WHERE username = :username');
				$stmt->execute(array(
					':username' => $username
					));
				$data = $stmt->fetch(PDO::FETCH_ASSOC);

				if($data == false){
					$errMsg = "Użytkownik $username nie znaleziony";
				}
				else {
					if($password == $data['password']) {
						$_SESSION['name'] = $data['fullname'];
						$_SESSION['username'] = $data['username'];
						$_SESSION['password'] = $data['password'];
						$_SESSION['dzial'] = $data['dzial'];
						header('Location: index.php');
						exit;
					}
					else
						$errMsg = 'Nieprawidłowe hasło';
				}
			}
			catch(PDOException $e) {
				$errMsg = $e->getMessage();
			}
		}
	}
?>

<html lang="pl">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, shrink-to-fit=no, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Logowanie - BRAMKA SMS PWSZ TARNOBRZEG</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="css/supersized.css">
	<link rel="stylesheet" href="css/login.css">
	<script src="js/jquery.js"></script>
	<script src="js/supersized.3.2.7.min.js"></script>
	<script src="js/supersized-init.js"></script>
	<script src="js/login.js"></script>


    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>

<body>
	<div class="row">
		<div class="col-lg-12">
			<div class="page-container">
				<h1>Państwowa Wyższa Szkoła Zawodowa</h1>
				<h2>Bramka SMS</h2>
				<form action="" method="post">
					<input type="text" name="username" class="username" placeholder="Login">
					<input type="password" name="password" class="password" placeholder="Hasło">
					<button type="submit" name='login' value="Login">Zaloguj się</button>
				</form><br/>
				<p>Zapomniałeś/potrzebujesz hasła <br/> zgłoś się do 23C</p>
				<?php
				if(isset($errMsg)){
					echo '<div style="color:#FF0000;text-align:center;font-size:17px;">'.$errMsg.'</div>';
				}
				?>
			</div>
		</div>
	</div>
    <!-- /#wrapper -->
    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

    <!-- Menu Toggle Script -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
	
    </script>
</body>
</html>