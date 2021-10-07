<?php
	session_start();
	
	if((!isset($_POST['login'])) || (!isset($_POST['haslo'])))
	{
		header('Location:  login.php');
		exit();
	}
	
	//ustanowienie połączenia z bazą danych
	require_once "connect.php";
	$polaczenie = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if($polaczenie->connect_errno!=0)
	{
		echo"Error:".$polaczenie->connect_errno;
	}
	else
	{
		//wczytywanie wartości z POSTa
		$login = $_POST['login'];
		$haslo = $_POST['haslo'];
		
		$login=htmlentities($login, ENT_QUOTES, "UTF-8");
		
		//wysłanie zapytania do bazy:
		if($rezultat = @$polaczenie->query(
		sprintf("SELECT * FROM users WHERE login='%s'", 
		mysqli_real_escape_string($polaczenie, $login))))
		{
			$ilu_userow=$rezultat->num_rows;
			if($ilu_userow>0)
			{
				$wiersz=$rezultat->fetch_assoc();
				
			//Weryfikacja hasz-hasła:
				if(password_verify($haslo, $wiersz['password']))
				{
				//Zmienna pokazująca czy jest ktoś zalogowany:
					$_SESSION['zalogowany']=true;
					
					$_SESSION['login']=$wiersz['login'];
					
					$_SESSION['user_id']=$wiersz['user_id'];
					
					unset($_SESSION['blad']);
					$rezultat->free_result();
					header('Location: start.php');
				}
				else
				{
					//Przypadek podania dobrego loginu i złego hasła:
						$_SESSION['blad'] = '<span style="color:#C9EFF5 text-align:center">Nieprawidłowe hasło!</span>';
						header('Location: login.php');
				}
			}
			else
			{
				$_SESSION['blad'] = '<span style="color:#C9EFF5 text-align:center">Nieprawidłowy login lub hasło!</span>';
					header('Location: login.php');
			}
		}
		$polaczenie->close();
	}
?>