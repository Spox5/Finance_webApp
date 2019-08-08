<?php
	
	session_start();
	//REGISTARTION
	if (isset($_POST['email_reg']))
	{
		//walidation ok
		$all_ok = true;
		
		//check username_reg
		$username_reg = $_POST['username_reg'];
		
		//check username_reg length
		if ((strlen($username_reg)<3 || (strlen($username_reg)>20)))
		{
			$all_ok = false;
			$_SESSION['e_username_reg'] = "Login musi posiadać od 3 do 20 znaków";
			header('Location: index.php');
		}
		
		if (ctype_alnum($username_reg) == false)
		{
			$all_ok = false;
			$_SESSION['e_username_reg'] = "Login może składać się tylko z liter (bez polskich znaków) i cyfr";
			header('Location: index.php');
		}
		
		//check email_reg
		$email_reg = $_POST['email_reg'];
		$email_reg_S = filter_var($email_reg, FILTER_SANITIZE_EMAIL);
		
		if((filter_var($email_reg_S, FILTER_VALIDATE_EMAIL)==false) || ($email_reg_S!=$email_reg))
		{
			$all_ok = false;
			$_SESSION['e_email_reg'] = "Podaj poprawny adres e-mail";
			header('Location: index.php');
		}
		
		//check password
		$password_reg = $_POST['password_reg'];
		if ((strlen($password_reg)<3 || (strlen($username_reg)>20)))
		{
			$all_ok = false;
			$_SESSION['e_password_reg'] = "Hasło musi posiadać od 3 do 20 znaków";
			header('Location: index.php');
		}
		
		$password_hashed = password_hash($password_reg, PASSWORD_DEFAULT);
		
		//check same logins or passwords
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
				//is email in databse
				$result = $connect->query("SELECT id FROM users WHERE email='$email_reg'");
				
				if(!$result) throw new Exception($connect->error);
				
				$email_number = $result->num_rows;
				if($email_number>0)
				{
					$all_ok = false;
					$_SESSION['e_email_reg']="Istnieje już konto o takim adresie e-mail";
					header('Location: index.php');
				}
				
				//is username in databse
				$result = $connect->query("SELECT id FROM users WHERE username='$username_reg'");
				
				if(!$result) throw new Exception($connect->error);
				
				$username_number = $result->num_rows;
				if($username_number>0)
				{
					$all_ok = false;
					$_SESSION['e_username_reg']="Istnieje już konto o takim loginie";
					header('Location: index.php');
				}
				
				if ($all_ok == true)
				{
					if($connect->query("INSERT INTO users VALUES(NULL, '$username_reg', '$password_hashed','$email_reg')"))
					{
						$_SESSION['registration_complete'] = "Rejestracja udana. Możesz zalogować się na swoje konto";
	
						$connect->query("INSERT INTO incomes_category_assigned_to_users (user_id, name) SELECT users.id, incomes_category_default.name FROM users, incomes_category_default WHERE users.id = (SELECT max(id) FROM users)");
						
						$connect->query("INSERT INTO payment_methods_assigned_to_users (user_id, name) SELECT users.id, payment_methods_default.name FROM users, payment_methods_default WHERE users.id = (SELECT max(id) FROM users)");
						
						$connect->query("INSERT INTO expenses_category_assigned_to_users (user_id, name) SELECT users.id, expenses_category_default.name FROM users, expenses_category_default WHERE users.id = (SELECT max(id) FROM users)");
						
						header('Location: index.php');
					}
					else
					{
						throw new Exception($connect->error);
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
		
	}	
	
	
?>