<?php

	session_start();
	
	if ((isset($_SESSION['logged'])) && ($_SESSION['logged'] == true))
	{
		header('Location: main.php');
		exit();
	}

?>

<!DOCTYPE html>
<html lang="pl">
<head>
	<meta charset="utf-8"/>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	<title>Przyszły milioner</title>
	
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link href="https://fonts.googleapis.com/css?family=Lato&display=swap&subset=latin-ext" rel="stylesheet">
	<link rel="stylesheet" href="style.css" type="text/css" />
	<link rel="stylesheet" href="css/fontello.css" type="text/css" />
	
	<!--żeby znaczniki HTML5 działay na starszych przeglądarkach <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>-->
	
</head>

<body>
	
	<main>
	
		<div class="container-fluid">
		
			<header>
				<div class="header">
					<h1><i class="icon-money"></i><b>Przyszły milioner</b></h1>
				</div>
			</header>
			
			<div id="main">
				
				<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. In nisl urna, mollis sit amet lectus id, lacinia faucibus quam. Suspendisse sem diam, iaculis eu ante vel, malesuada rutrum metus. Proin sed felis tincidunt, pellentesque ante vitae, commodo augue. Morbi auctor sapien ligula, id vulputate dolor feugiat a. Nullam nec nulla metus. Duis hendrerit dignissim ligula et posuere. Vestibulum orci metus, blandit at feugiat at, tincidunt ac ipsum. Phasellus sit amet lorem faucibus, ullamcorper quam sed, consectetur quam. Sed imperdiet tellus sed blandit venenatis. Donec ultrices velit vel neque pellentesque, in dignissim purus tincidunt.</p>
				
				<div class="row">
				
					<div class="col-md-12 col-lg-6">
						<div class="log_form">
							<form action="registration.php" method="post">
								Rejestracja
								<div><input type="text" placeholder="login" onfocus="this.placeholder=''" onblur="this.placeholder='login'"name ="username_reg" ></div>
								
								<?php 
								
									if (isset($_SESSION['e_username_reg']))
									{
										echo '<div class="error">'.$_SESSION['e_username_reg'].'</div>';
										unset($_SESSION['e_username_reg']);
									}
								
								?>
								
								<div><input type="text" placeholder="e-mail" onfocus="this.placeholder=''" onblur="this.placeholder='e-mail'" name ="email_reg"></div>
								
								<?php 
								
									if (isset($_SESSION['e_email_reg']))
									{
										echo '<div class="error">'.$_SESSION['e_email_reg'].'</div>';
										unset($_SESSION['e_email_reg']);
									}
								
								?>
								
								<div><input type="password" placeholder="hasło" onfocus="this.placeholder=''" onblur="this.placeholder='hasło'"name ="password_reg"></div>
								
								<?php 
								
									if (isset($_SESSION['e_password_reg']))
									{
										echo '<div class="error">'.$_SESSION['e_password_reg'].'</div>';
										unset($_SESSION['e_password_reg']);
									}
								
								?>
								
								<div><input type="submit" class="register" value="Zarejestruj się"></div>
								
								<?php 
								
									if (isset($_SESSION['registration_complete']))
									{
										echo '<div class="registration_complete">'.$_SESSION['registration_complete'].'</div>';
										unset($_SESSION['registration_complete']);
									}
								
								?>
								
							</form>
						</div>
					</div>
					
					<div class="col-md-12 col-lg-6">
						<div class="log_form">
							<form action="login.php" method="post">
							
								Logowanie
								<div><input type="text" placeholder="login" onfocus="this.placeholder=''" onblur="this.placeholder='login'" name="username"></div>
								
								<div><input type="password" placeholder="hasło" onfocus="this.placeholder=''" onblur="this.placeholder='hasło'"name="password"></div>
								
								<div><input type="submit" class="login" value="Zaloguj się"></div>
								
							</form>
							
							<?php
								if (isset($_SESSION['e_login']))
								{
									echo '<div class="error">'.$_SESSION['e_login'].'</div>';
									unset($_SESSION['e_login']);
								}
							?>
							
						</div>
					</div>
					
				</div>
			
			</div>
		
		</div>
	
	</main>
	
	<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
	
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
	
	<script src="js/bootstrap.min.js"></script>
	
</body>
</html>