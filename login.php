<?php

	session_start();
	
	if ((!isset($_POST['username'])) || (!isset($_POST['password'])))
	{
		header('Location: index.php');
		exit();
	}
	
	require_once "connect.php";
	mysqli_report(MYSQLI_REPORT_STRICT);
	
	try
	{
		$connect = new mysqli($host, $db_user, $db_password, $db_name);
		if ($connect->connect_errno!=0)
		{
			throw new Exception(mysqli_connect_errno());
		}
		else
		{
			$username = $_POST['username'];
			$password = $_POST['password'];
			
			$username = htmlentities($username, ENT_QUOTES, "UTF-8");
		
		
			if ($result = $connect->query(sprintf("SELECT * FROM users WHERE username='%s'",
			mysqli_real_escape_string($connect, $username))))
			{
				$user_number = $result->num_rows;
				if($user_number>0)
				{
					$row = $result->fetch_assoc();
					
					if(password_verify($password, $row['password']))
					{
						$_SESSION['logged'] = true;
							
						$_SESSION['user_id'] = $row['id'];
						$_SESSION['username'] = $row['username'];
						
						unset($_SESSION['e_login']);
						$result->free_result();
						header('Location: main.php');
					}
					else
					{
						$_SESSION['e_login'] = '<span>Nieprawidłowy login lub hasło</span>';
						header('Location: index.php');
					}	
					
				}
				else
				{
					$_SESSION['e_login'] = '<span>Nieprawidłowy login lub hasło</span>';
					header('Location: index.php');
				}			
			}
		
			$connect->close();
		}
		
	}
	catch(Exception $e)
	{
		echo "Błąd serwera. Przepraszamy za niedogodności";
		echo '<br /> Info dev.'.$e;
	}
	
	
	
	/*
	
	$connect = @new mysqli($host, $db_user, $db_password, $db_name);
	
	if ($connect->connect_errno!=0)
	{
		echo "Error: ".$connect->connect_errno;
	}
	else
	{
		$username = $_POST['username'];
		$password = $_POST['password'];
		
		$username = htmlentities($username, ENT_QUOTES, "UTF-8");
		
		
		if ($result = @$connect->query(sprintf("SELECT * FROM users WHERE username='%s'",
		mysqli_real_escape_string($connect, $username))))
		{
			$user_number = $result->num_rows;
			if($user_number>0)
			{
				$row = $result->fetch_assoc();
				
				if(password_verify($password, $row['password']))
				{
					$_SESSION['logged'] = true;
						
					$_SESSION['user_id'] = $row['id'];
					$_SESSION['username'] = $row['username'];
					
					unset($_SESSION['error']);
					$result->free_result();
					header('Location: main.php');
				}
				else
				{
					$_SESSION['error'] = '<span style="color: red; font-size:20px">Nieprawidłowy login lub hasło</span>';
					header('Location: index.php');
				}	
				
			}
			else
			{
				$_SESSION['error'] = '<span style="color: red; font-size:20px">Nieprawidłowy login lub hasło</span>';
				header('Location: index.php');
			}			
			
		}
		
		$connect->close();
	}

	
	*/

?>