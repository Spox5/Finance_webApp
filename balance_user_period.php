<?php

	session_start();
	
	if (!isset($_SESSION['logged']))
	{
		header('Location: index.php');
		exit();
	}
	


	if (isset($_POST['date1']))
	{
		
	//period walidation ok
	$all_ok = true;

	$_SESSION['date1'] = $_POST['date1'];
	$_SESSION['date2'] = $_POST['date2'];

	require_once "connect.php";
	$current_month = date('m');

	
	try
	
	{
		$connect = new mysqli($host, $db_user, $db_password, $db_name);
		if ($connect->connect_errno!=0)
		{
			throw new Exception(mysqli_connect_errno());
		}
		else
		{
			
			
			$query = "SELECT e_c.name, SUM(e.amount) FROM expenses_category_assigned_to_users AS e_c, expenses AS e WHERE e.user_id = e_c.user_id AND e.expense_category_assigned_to_user = e_c.id AND e.user_id=$_SESSION[user_id] AND e.date_of_expense >= '$_SESSION[date1]' AND e.date_of_expense <= '$_SESSION[date2]' GROUP BY e_c.name";
			$result = $connect->query($query);
		}
	$connect->close();
	}
	catch (Exception $e)
	{
		echo "Błąd serwera. Przepraszamy za niedogodności";
		echo '<br /> Info dev.'.$e;
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
	
	<!-- pie chart -->
	<script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
	<script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {

        var data = google.visualization.arrayToDataTable([
          ['Rodzaj', 'Kwota'],
          
		  <?php
		  
			while($row=$result->fetch_assoc())
			{
				echo "['".$row['name']."',".$row['SUM(e.amount)']."],";
			}
		  
		  ?>
		  
        ]);

        var options = {
          title: 'Wydatki',
		  backgroundColor: '#F5F5F5',
		  width: '500',
		  height: '300'
		  
        };
;

        var chart = new google.visualization.PieChart(document.getElementById('piechart'));

        chart.draw(data, options);
      }
    </script>
	
	
	<!--<script src="balance.js"></script>
	
	<!--żeby znaczniki HTML5 działay na starszych przeglądarkach <script src="https://cdnjs.cloudflare.com/ajax/libs/html5shiv/3.7.3/html5shiv.min.js"></script>-->

</head>

<body>

	<main>

		<div class="container-fluid">
		
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
					<form>
					  <div class="form-group">
						<label class="col-form-label">Podaj zakres dat, którego ma dotyczyć bilans.</label>
						<label>Od: <input type="date" class="form-control"></label>
						<label>Do: <input type="date" class="form-control"></label>
					  </div>
					</form>
				  </div>
				  <div class="modal-footer">
					<button type="button" class="btn btn-modal-cancel" data-dismiss="modal">Anuluj</button>
					<button type="button" class="btn btn-modal-ok">Akceptuj</button>
				  </div>
				</div>
			  </div>
			</div>
				
			<header>
				<div class="header">
					<h1><i class="icon-money mr-1"></i><b>Przyszły milioner</b></h1>
				</div>
			</header>

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
						
						<div id="title">Bieżący miesiąc:</div>
						
					</div>	
					
						<div class="table1 col-sm-12 col-md-6">
							<table>
								<tr>
									<th colspan="4">Przychody</th>
								</tr>
								<tr>
									<td><b>Kategoria</b></td>
									<td><b>Wysokość</b></td>
									<td><b>Data</b></td>
									<td><b>Komentarz</b></td>
								</tr>
								<?php 
								
								require_once "connect.php";
								
								$_SESSION['date1'] = $_POST['date1'];
								$_SESSION['date2'] = $_POST['date2'];
								
								try
								{
									$connect = new mysqli($host, $db_user, $db_password, $db_name);
									if ($connect->connect_errno!=0)
									{
										throw new Exception(mysqli_connect_errno());
									}
									else
									{
										
										$result = $connect->query("SELECT i.user_id, i.amount, i.date_of_income, i.id, i.income_comment, i_c.name FROM incomes AS i, incomes_category_assigned_to_users AS i_c WHERE i.user_id = i_c.user_id AND i.income_category_assigned_to_user_id = i_c.id AND i.date_of_income >= '$_SESSION[date1]' AND i.date_of_income <= '$_SESSION[date2]' AND i.user_id=$_SESSION[user_id] ORDER BY date_of_income DESC" );
										
										$count = $result->num_rows;
										
										$result->fetch_assoc();
										
										foreach($result as $data)
										{
											echo "<tr> \n";
											echo "<td>$data[name]</td>";
											echo "<td>$data[amount] zł</td>";
											echo "<td>$data[date_of_income]</td>";
											echo "<td>$data[income_comment]</td>";
											echo "</tr> \n";
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
							</table>
						</div>
						
						<div class="table1 col-sm-12 col-md-6">
							<table>
								<tr>
									<th colspan="5">Wydatki</th>
								</tr>
								<tr>
									<td><b>Kategoria</b></td>
									<td><b>Płatność</b></td>
									<td><b>Wysokość</b></td>
									<td><b>Data</b></td>
									<td><b>Komentarz</b></td>
								</tr>
								<?php 
								
								require_once "connect.php";
								$current_year = date('Y');
								
								try
								{
									$connect = new mysqli($host, $db_user, $db_password, $db_name);
									if ($connect->connect_errno!=0)
									{
										throw new Exception(mysqli_connect_errno());
									}
									else
									{
										$result = $connect->query("SELECT e_c.name, p_m.namem, e.amount, e.date_of_expense, e.expense_comment FROM expenses as e, payment_methods_assigned_to_users as p_m, expenses_category_assigned_to_users as e_c WHERE e.user_id = p_m.user_id AND e.user_id = e_c.user_id AND e.expense_category_assigned_to_user = e_c.id AND e.payment_method_assigned_to_user = p_m.id AND e.user_id=$_SESSION[user_id] AND e.date_of_expense >= '$_SESSION[date1]' AND e.date_of_expense <= '$_SESSION[date2]' ORDER BY date_of_expense DESC");
										
										$count = $result->num_rows;
										
										$result->fetch_assoc();
										
										foreach($result as $data)
										{
											echo "<tr> \n";
											echo "<td>$data[name]</td>";
											echo "<td>$data[name]</td>";
											echo "<td>$data[amount] zł</td>";
											echo "<td>$data[date_of_expense]</td>";
											echo "<td>$data[expense_comment]</td>";
											echo "</tr> \n";
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
							</table>
						</div>
						
						
						<div class="summary col-md-12">Podsumowanie bilansu:
							<?php 
							
							require_once "connect.php";
								
								try
								{
									$connect = new mysqli($host, $db_user, $db_password, $db_name);
									if ($connect->connect_errno!=0)
									{
										throw new Exception(mysqli_connect_errno());
									}
									else
									{
										$result_income = $connect->query("SELECT SUM(amount) as income_summary FROM incomes WHERE user_id=$_SESSION[user_id] AND incomes.date_of_income >= '$_SESSION[date1]' AND incomes.date_of_income <= '$_SESSION[date2]'");
										
										$result_expense = $connect->query("SELECT SUM(amount) as expense_summary FROM expenses WHERE user_id=$_SESSION[user_id] AND expenses.date_of_expense >= '$_SESSION[date1]' AND expenses.date_of_expense <= '$_SESSION[date2]'");
																
										$row_income=mysqli_fetch_assoc($result_income);
										$row_expense=mysqli_fetch_assoc($result_expense);
										
										$balance = $row_income['income_summary'] - $row_expense['expense_summary'];
										echo "$balance zł";
										if ($balance > 0)
										{
											echo "<div style='color: #00b33c'>Gratulacje! Świetnie zarządzasz finansami</div>";
										}
										else
											echo "<div style='color: #e60000;'>Uważaj! Popadasz w długi</div>";																	
										$connect->close();
									}
									
								}
								catch (Exception $e)
								{
									echo "Błąd serwera. Przepraszamy za niedogodności";
									echo '<br /> Info dev.'.$e;
								}
								
								?>
								
						</div>
		
						<div class = "expense_chart" id="piechart"></div>
		
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