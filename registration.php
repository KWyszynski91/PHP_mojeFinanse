<?php
	session_start();
	
	if(isset($_POST['email']))
	{
		$wszystko_OK=true;
		
	//Sprawdź poprawność nowego loginu:
		$login=$_POST['login'];
		//sprawdzanie długości loginu:
		if((strlen($login)<3) || (strlen($login)>20))
			{
				$wszystko_OK=false;
				$_SESSION['e_login']="Login musi posiadać od 3 do 20 znaków.";
			}
		if(ctype_alnum($login)==false)
			{
				$wszystko_OK=false;
				$_SESSION['e_login']="Login może składać się tylko z liter i cyfr (bez polskich znaków).";
			}
			
	// Sprawdź poprawność adresu email
		$email=$_POST['email'];
		//Sanityzacja zmiennej:
		$emailB=filter_var($email, FILTER_SANITIZE_EMAIL);
		
		if ((filter_var($emailB, FILTER_VALIDATE_EMAIL)==false)||($emailB!=$email))
		{
			$wszystko_OK=false;
			$_SESSION['e_email']="Podaj poprawny adres email.";
		}
		
	//Sprawdź poprawność wprowadzanego hasła
		$haslo1=$_POST['haslo1'];
		$haslo2=$_POST['haslo2'];
		
		if((strlen($haslo1)<8)||(strlen($haslo1)>20))
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Hasło musi posiadać od 8 do 20 znaków.";
		}
		if($haslo1!=$haslo2)
		{
			$wszystko_OK=false;
			$_SESSION['e_haslo']="Podane hasła nie są takie same.";
		}
		
	//Zahaszowanie wprowadzonego hasła:
		$haslo_hash=password_hash($haslo1, PASSWORD_DEFAULT);

	//Sprawdzanie zaznaczanie CAPTCHA:
		$sekret="6LdjsK4cAAAAAMiySwkW9OXVSH5XJpVASO9P39-t";
			
			$sprawdz= file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$sekret.'&response='.$_POST['g-recaptcha-response']);
			
			$odpowiedz=json_decode($sprawdz);
			
			if($odpowiedz->success==false)
			{
				$wszystko_OK=false;
				$_SESSION['e_bot']="Potwierdź, że nie jesteś botem.";
			}
			
	//Sprawdzanie czy podany login istnieje juz w bazie:
			require_once "connect.php";
			//wyciszanie:
			mysqli_report(MYSQLI_REPORT_STRICT);
			
			try
			{
				$polaczenie = new mysqli($host, $db_user, $db_password, $db_name);
				if($polaczenie->connect_errno!=0)
				{
					throw new Exception(mysqli_connect_errno());
				}
				else
					//Sukces-połączenie nawiązane - sprawdzenie, czy email już jest w bazie:
				{
					$rezultat=$polaczenie->query("SELECT user_id FROM users WHERE email='$email'");
					//rzuć wyjątkiem gdy znajdziesz taki email
					if(!$rezultat)
						throw new Exception($polaczenie->error);
						$ile_takich_maili = $rezultat->num_rows;
						
						if($ile_takich_maili>0)
						{
							$wszystko_OK=false;
							$_SESSION['e_email']="Istnieje już konto przypisane do tego adresu e-mail.";
						}
						

						//Sukces-połączenie nawiązane - sprawdzenie, czy login już jest w bazie:
					$rezultat=$polaczenie->query("SELECT user_id FROM users WHERE login='$login'");
					//rzuć wyjątkiem gdy znajdziesz powtórzony login
					if(!$rezultat)
						throw new Exception($polaczenie->error);
						$ile_takich_loginow = $rezultat->num_rows;
						
						if($ile_takich_loginow>0)
						{
							$wszystko_OK=false;
							$_SESSION['e_login']="Istnieje już konto o takim loginie.";
						}
						
						
						if($wszystko_OK==true)
						{
							//Umieszczanie użytkownika w bazie:
							if($polaczenie->query("INSERT INTO users VALUES(NULL, '$login', '$haslo_hash', '$email')"))
							{
								//zapytanie się udało TRUE:
								$_SESSION['udanarejestracja']=true;
								header('Location: welcome.php');
							}
							else
							{
								//zapytanie nie udało się - rzucamy wyjątek:
								throw new Exception($polaczenie->error);
							}
						}
					
					$polaczenie->close();
				}
			}
			catch(Exception $zlapany_wyjatek)
			{
				echo '<span style="color:red;">Błąd serwera! Przepraszamy za niedogodności i prosimy o rejestrację w inszym terminie</span>';
				echo '<br/>Informacja developerska: '.$zlapany_wyjatek;
			}
	}
?>

<!DOCTYPE HTML>

<html lang="pl">

<head>
	<meta charset="utf-8" >
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<title>mojeFinanse</title>
	<script src='https://www.google.com/recaptcha/api.js'></script>
	
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
				
				<form method="post">
			
					<div class="row">
						<div class="col-sm-12" id="formAlignData">
							 <i class="fas fa-envelope fa-fw"></i>
							<input class="loginText" type="email" placeholder="adres e-mail" onfocus="this.placeholder=''" onblur="this.placeholder='adres e-mail'" name="email"/>
						</div>
						<?php
								if(isset($_SESSION['e_email']))
								{
									echo'<div class="error">'.$_SESSION['e_email'].'</div>';
									unset($_SESSION['e_email']);
								}
						?>
					</div>
					
					<div class="row">
						<div class="col-sm-12" id="formAlignData">
							<i class="fas fa-user-plus fa-fw"></i>
							<input class="loginText" type="text" placeholder="login" onfocus="this.placeholder=''" onblur="this.placeholder='login'" name="login">
						</div>
						<?php
								if(isset($_SESSION['e_login']))
								{
									echo'<div class="error">'.$_SESSION['e_login'].'</div>';
									unset($_SESSION['e_login']);
								}
						?>
					</div>
					
					<div class="row">
						<div class="col-sm-12" id="formAlignData">
							<i class="fas fa-key fa-fw"></i>
							<input class="loginText" type="password" placeholder="hasło" onfocus="this.placeholder=''" onblur="this.placeholder='hasło'" name="haslo1">
						</div>
					</div>
					
					<div class="row">
						<div class="col-sm-12" id="formAlignData">
							<i class="fas fa-key fa-fw"></i>
							<input class="loginText" type="password" placeholder="powtórz hasło" onfocus="this.placeholder=''" onblur="this.placeholder='hasło'" name="haslo2">
						</div>
						<?php
								if(isset($_SESSION['e_haslo']))
								{
									echo'<div class="error">'.$_SESSION['e_haslo'].'</div>';
									unset($_SESSION['e_haslo']);
								}
						?>
					</div>
					
					<div class="row">
						<div class="col-sm-12" id="formAlignData">
							<div class="g-recaptcha" data-sitekey="6LdjsK4cAAAAAAdiJmZMcjIwUu1G-SvJ3X6JiEs3">
							</div>
						</div>
						<?php
								if(isset($_SESSION['e_bot']))
								{
									echo'<div class="error">'.$_SESSION['e_bot'].'</div>';
									unset($_SESSION['e_bot']);
								}
						?>
					</div>
					
					<br /><br />
					
					<div id="row">
						<div class="col-sm-12 col-md-6" id="formAlignData">
							<button  type="submit" class="button1">Zarejestruj się</button>
						</div>
					</div>
				</form>
					
					<form action="main.php" method="post">
						<div class="col-sm-12 col-md-6" id="formAlignData">
								<button type="submit" class="button1" href="main.php">Wstecz</button>
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