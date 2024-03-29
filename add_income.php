<?php

	session_start();
	
	if (!isset($_SESSION['logged']))
	{
		header('Location: index.php');
		exit();
	}
	
	if (isset($_POST['amount']))
	{
		//income walidation ok
		$all_ok = true;
		
		require_once "connect.php";
		
		if (!empty($_POST['amount']) && !empty($_POST['date']) && isset($_POST['category']))
		{
			
			$logged_user_id = $_SESSION['user_id'];
			$amount = $_POST['amount'];
			$date = $_POST['date'];
			$category = $_POST['category'];
			$comment = $_POST['comment'];
		
			try
			{
				$connect = new mysqli($host, $db_user, $db_password, $db_name);
				
				mysqli_query($connect, "SET CHARSET utf8");
				mysqli_query($connect, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
							
				if ($connect->connect_errno!=0)
				{
					throw new Exception(mysqli_connect_errno());
				}
				else
				{
					$_SESSION['add_income_complete'] = "Przychód został dodany";
					
					$connect->query("INSERT INTO incomes VALUES(NULL, '$logged_user_id', '$category','$amount' ,'$date', '$comment')");
					
					$connect->close();
					
					
				}
				
			}
			catch (Exception $e)
			{
				echo "Błąd serwera. Przepraszamy za niedogodności";
				echo '<br /> Info dev.'.$e;
			}
		}
		else
		{
			$_SESSION['e_add_income'] = "Wypełnij niezbędne pola.";
		}
		
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
		
			<div class="modal fade" id="periodDate" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			  <div class="modal-dialog" role="document">
				<div class="modal-content">
				  <div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Podaj datę</h5>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					  <span aria-hidden="true">&times;</span>
					</button>
				  </div>
				  <div class="modal-body">
					<form action="balance_user_period.php" method="post">
					  <div class="form-group">
						<label class="col-form-label">Podaj zakres dat, którego ma dotyczyć bilans.</label>
						<label>Od: <input type="date" class="form-control" name="date1"></label>
						<label>Do: <input type="date" class="form-control" name="date2"></label>
					  </div>
					
					  </div>
					  <div class="modal-footer">
						<button type="button" class="btn btn-modal-cancel" data-dismiss="modal">Anuluj</button>
						<button type="submir" class="btn btn-modal-ok">Akceptuj</button>
					  </div>
					</form>
				</div>
			  </div>
			</div>
				
			<header>
				<div class="header">
					<h1><i class="icon-money mr-1"></i><b>Przyszły milioner</b></h1>
	
				</div>
			</header>

			<div class="modal"></div>

			<nav class="navbar navbar-expand-lg">
			
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Navigation switch">
					<i id="hamburger-icon" class="icon-menu"></i>
				</button>
				
				<div  class="collapse navbar-collapse" id="mainmenu">
				
					<ul class="navbar-nav mx-auto nav">
					
						<li class="nav-item">
							<a class="nav-link" href="main.php">
								<i class="icon-home"></i>Strona główna
							</a>
						</li>
						
						<li class="nav-item">
							<a class="nav-link" href="add_income.php">
								<i class="icon-dollar"></i>Dodaj przychód
							</a>
						</li>
						
						<li class="nav-item">
							<a class="nav-link" href="add_expense.php">
								<i class="icon-basket"></i>Dodaj wydatek
							</a>
						</li>
						
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false" id="submenu" aria-haspopup="true">
								<i class="icon-calendar"></i>Pokaż bilans
							</a>
							
							<div class="dropdown-menu" aria-labelledby="submenu">
							
								<a class="dropdown-item" href="balance.php">Bieżący miesiąc</a>
								<a class="dropdown-item" href="balance_previous_month.php">Poprzedni miesiąc</a>
								<a class="dropdown-item" href="balance_present_year.php">Bieżący rok</a>
								
								<div class="dropdown-divider"></div>
								
								<div>Niestandardowe
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#periodDate">Podaj datę</button>
								</div>
							
							</div>
						
						</li>
						
						<li class="nav-item"><a class="nav-link" href="#"><i class="icon-wrench"></i>Ustawienia</a></li>
						
						<li class="nav-item"><a class="nav-link" href="logout.php"><i class="icon-logout"></i>Wyloguj</a></li>
						
					</ul>
				
				</div>
				
			</nav>

			<div id="main">
			
			<div class="row">
			
			<div class="col-md-12">
	
				<form method="post">
				
					<?php 
								
						if (isset($_SESSION['e_add_income']))
						{
							
							echo '<div class="error">'.$_SESSION['e_add_income'].'</div>';
							unset($_SESSION['e_add_income']);
						}
						else if (isset($_SESSION['add_income_complete']))
						{
							
							echo '<div class="registration_complete">'.$_SESSION['add_income_complete'].'</div>';
							unset($_SESSION['add_income_complete']);
						}
					
					?>
		
					<div id="title">Podaj dane:</div>

					<div><input type="number" step="0.01" min="0" placeholder="kwota" onfocus="this.placeholder=''" onblur="this.placeholder='kwota'" name="amount"></div>
			
					<div><input type="date" name="date"></div>
				
					<fieldset>
						
						<legend>Kategoria</legend>
							
						<?php	
						
						require_once "connect.php";
						
								
						try
						{
							$connect = new mysqli($host, $db_user, $db_password, $db_name);
							
							mysqli_query($connect, "SET CHARSET utf8");
							mysqli_query($connect, "SET NAMES 'utf8' COLLATE 'utf8_polish_ci'");
							
							if ($connect->connect_errno!=0)
							{
								throw new Exception(mysqli_connect_errno());
							}
							else
							{
								$result = $connect->query("SELECT incomes_category_assigned_to_users.name, incomes_category_assigned_to_users.id FROM incomes_category_assigned_to_users WHERE incomes_category_assigned_to_users.user_id=$_SESSION[user_id]" );
								
								$count = $result->num_rows;
								
								$result->fetch_assoc();
								
								foreach($result as $data)
								{
									echo "<div><label><input type='radio' name='category' value=$data[id]>$data[name]</label></div>";
								}
								
								$connect->close();
							}
							
						}
						catch (Exception $e)
						{
							echo "Błąd serwera. Przepraszamy za niedogodności";
							echo '<br /> Info dev.'.$e;
						}
							
					
						
						?>
								
						<div><input type="text" placeholder="komentarz (opcjonalnie)" onfocus="this.placeholder=''" onblur="this.placeholder='komentarz (opcjonalnie)'" name="comment"></div>
								
						<div><input type="submit" class="ok" value="Dodaj"></div>
						<div><input type="submit" class="cancel" value="Anuluj"></div>
						
					</fieldset>
				
				</form>
			
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