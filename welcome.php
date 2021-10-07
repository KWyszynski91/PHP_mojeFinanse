<?php
	session_start();
	
	if(!isset($_SESSION['udanarejestracja']))
	{
		header ('Location: index.php');
		exit();
	}
	else
	{
		unset($_SESSION['udanarejestracja']);
	}
?>

<!DOCTYPE HTML>

<html lang="pl">

<head>
	<meta charset="utf-8" >
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<title>mojeFinanse</title>
	<meta name="description" content="mF - Panel użytkownika" >
	<meta name="keywords" content="finanse, dobrobyt, pieniądze" >
	<meta http-equiv="X-UA-Compatible" content="IE=edge" >
		
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="style.css">

   <link href="https://fonts.googleapis.com/css2?family=Poiret+One&display=swap" rel="stylesheet">

</head>

<body>
	<header>
		<div class="header">
			<div class="container">
				<div class="row">
					
					<div class="col-sm-6" id="logo">
						mojeFinanse
					</div>
						
				</div>
			</div>
		</div>
	</header>
	
	<nav class="navbar navbar-dark navbar-expand-md">
			
		<button class="navbar-toggler order-first"  type="button" data-bs-toggle="collapse" data-bs-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Przełącznik nawigacji">
			<span class="navbar-toggler-icon"></span>
		</button>
				
		<div class="collapse navbar-collapse" id="mainmenu">
			<ul class="navbar-nav mr-auto">
							
				<li class="nav-item">
					<a class="nav-link" href="login.php">Logowanie</a>
				</li>
							
			</ul>
		</div>
				
	</nav>
	
	<main>
		
		<div class="container">
			
			<div class="row">
				<section class="titleBar">
					<header>
						<h4>mojeFinanse</h4>
					</header>
				</section>
			</div>
			
			<section class="dataSheet">
			
				<div class="row">
					<div class="col-sm-12 col-md-6" id="formAlignText" style="text-align: justify">
						<p>Dziękuję za rejestrację!</p>
						<br/><br/>
						Możesz już zalogować się na swoje konto.
						<br/>
					</div>
				</div>
				
			</section>
		</div>
		
	</main>

	<footer>
		<div class="container">
			
			<div class="row">
				<section class="footerBar">
					mojeFinanse &copy; 2021 Krzysztof Wyszyński - Przyszły Programista.
				</section>
			</div>
			
		</div>
	</footer>
	
	<script src="https://code.jquery.com/jquery-3.4.1.slim.min.js" integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
	<script src="js/bootstrap.min.js"></script>
	
</body>

</html>