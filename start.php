<?php
	session_start();
	
	if(!isset($_SESSION['zalogowany']))
	{
		header('Location: login.php');
		exit();
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
						<a href="start.php" class="logolink">mojeFinanse</a>
					</div>
						
					<div class="col-sm-6" id="userinfo">
						Witaj! <span style="color:#FFF">
						<?php echo $_SESSION['login'] 
						?>
						</span> 
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
					<a class="nav-link active" href="start.html">Start</a>
				</li>
							
				<li class="nav-item">
					<a class="nav-link" href="incomes.html">Dodaj przychód</a>
				</li>
							
				<li class="nav-item">
					<a class="nav-link" href="expenses.html">Dodaj wydatek</a>
				</li>
							
				<li class="nav-item">
					<a class="nav-link" href="balance.html">Przeglądaj bilans</a>
				</li>
							
				<li class="nav-item">
					<a class="nav-link disabled" href="#">Ustawienia</a>
				</li>
							
				<li class="nav-item">
					<a class="nav-link"  href="logout.php" >Wyloguj się</a>
					
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
					<div class="col-sm-12 col-md-6">
						<p>Rekinie domowej finansjery ! Zasiądź wygodnie w specjalnie przygotowanym kokpicie. Weź w rękę teleon i portfel - teraz spokojnie. Przepisz ze swojego konta aktualne przychody: wypłaty, zwrócone długi itd. Następnie wyciągnij wszystkie zbierane paragony i wpisz zainwestowane kwoty do panelu wydatków. Sprawdź na co wydajesz najwięcej, gdzie możesz zrobić cięcia, lub jaka część wypłaty przeznaczana jest na oszczędzanie !</p>
					</div>
					<div class="col-sm-12 col-md-6" id="formAlignText" style="text-align: center">
						<img class="img-fluid" src="img/stonks_m.png" alt=""/>
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