<?php
	session_start();
	
	if((isset($_SESSION['zalogowany']))&&($_SESSION['zalogowany']==true))
	{
		header ('Location: start.php');
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
   
   <script src="https://kit.fontawesome.com/908917e88d.js" crossorigin="anonymous"></script>

</head>

<body>
	<header>
		<div class="header">
			<div class="container">
				<div class="row">
					
					<div class="col-sm-6" id="logo">
						<a href="main.php" class="logolink">mojeFinanse</a>
					</div>
						
				</div>
			</div>
		</div>
	</header>
	
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
			
				<form action="sign_in.php" method="post">
			
					<div class="row">
						<div class="col-sm-12" id="formAlignData">
							<i class="fas fa-user fa-fw"></i>
							<input class="loginText" type="text" name="login" placeholder="login" onfocus="this.placeholder=''" onblur="this.placeholder='login'">
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-12" id="formAlignData">
							<i class="fas fa-key fa-fw"></i>
							<input class="loginText" type="password" name="haslo" placeholder="hasło" onfocus="this.placeholder=''" onblur="this.placeholder='hasło'">
						</div>
					</div>
					
						<?php
							if(isset($_SESSION['blad']))
								echo $_SESSION['blad'];
						?>
					
					<br/><br/>
					
					<div id="row">
					
						<div class="col-sm-12 col-md-6" id="formAlignData">
						<form action="sign_in.php" method="post">
							<button  type="submit" class="button1" >Zaloguj się</button>
						</form>
						</div>
						
						<div class="col-sm-12 col-md-6" id="formAlignData">
						<form action="main.php" method="post">
							<button type="submit" class="button1">Wstecz</button>
						</form>
						</div>
						
					</div>
				
				</form>
				
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