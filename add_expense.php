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

			<div class="modal"></div>

			<nav class="navbar navbar-expand-lg">
			
				<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mainmenu" aria-controls="mainmenu" aria-expanded="false" aria-label="Navigation switch">
					<i id="hamburger-icon" class="icon-menu"></i>
				</button>
				
				<div  class="collapse navbar-collapse" id="mainmenu">
				
					<ul class="navbar-nav mx-auto nav">
					
						<li class="nav-item">
							<a class="nav-link" href="main.html">
								<i class="icon-home"></i>Strona główna
							</a>
						</li>
						
						<li class="nav-item">
							<a class="nav-link" href="add_income.html">
								<i class="icon-dollar"></i>Dodaj przychód
							</a>
						</li>
						
						<li class="nav-item">
							<a class="nav-link" href="add_expense.html">
								<i class="icon-basket"></i>Dodaj wydatek
							</a>
						</li>
						
						<li class="nav-item dropdown">
							<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown" role="button" aria-expanded="false" id="submenu" aria-haspopup="true">
								<i class="icon-calendar"></i>Pokaż bilans
							</a>
							
							<div class="dropdown-menu" aria-labelledby="submenu">
							
								<a class="dropdown-item" href="balance.html">Bieżący miesiąc</a>
								<a class="dropdown-item" href="#">Poprzedni miesiąc</a>
								<a class="dropdown-item" href="#">Bieżący rok</a>
								
								<div class="dropdown-divider"></div>
								
								<div>Niestandardowe
									<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#periodDate">Podaj datę</button>
								</div>
							
							</div>
						
						</li>
						
						<li class="nav-item"><a class="nav-link" href="#"><i class="icon-wrench"></i>Ustawienia</a></li>
						
						<li class="nav-item"><a class="nav-link" href="index.html"><i class="icon-logout"></i>Wyloguj</a></li>
						
					</ul>
				
				</div>
				
			</nav>

			<div id="main">
			
			<div class="row">
			
			<div class="col-md-12">
	
				<form>
		
					<div id="title">Podaj dane:</div>

					<div><input type="number" placeholder="kwota" onfocus="this.placeholder=''" onblur="this.placeholder='kwota'"></div>
			
					<div><input type="date"></div>
			
					<fieldset>
					
						<legend>Sposób płatności</legend>
								
						<div><label><input type="radio" name="payment_method">Gotówka</label></div>
						<div><label><input type="radio" name="payment_method">Karta debetowa</label></div>
						<div><label><input type="radio" name="payment_method">Karta kredytowa</label></div>
								
					</fieldset>
				
					<fieldset>
						
						<legend>Kategoria</legend>
							
						<div><label><input type="radio" name="category">Jedzenie</label></div>
						<div><label><input type="radio" name="category">Mieszkanie</label></div>
						<div><label><input type="radio" name="category">Transport</label></div>
						<div><label><input type="radio" name="category">Telekomunikacja</label></div>
						<div><label><input type="radio" name="category">Opieka zdrowotna</label></div>					
						<div><label><input type="radio" name="category">Ubrania</label></div>
						<div><label><input type="radio" name="category">Higiena</label></div>
						<div><label><input type="radio" name="category">Dzieci</label></div>
						<div><label><input type="radio" name="category">Rozrywka</label></div>
						<div><label><input type="radio" name="category">Wycieczka</label></div>
						<div><label><input type="radio" name="category">Szkolenia</label></div>					
						<div><label><input type="radio" name="category">Książki</label></div>						
						<div><label><input type="radio" name="category">Oszczędności</label></div>
						<div><label><input type="radio" name="category">Na złotą jesień, czyli emeryturę</label></div>
						<div><label><input type="radio" name="category">Spłata długów</label></div>
						<div><label><input type="radio" name="category">Darowizna</label></div>
						<div><label><input type="radio" name="category" value="other">Inne wydatki</label></div>
								
						<div><input type="text" placeholder="komentarz (opcjonalnie)" onfocus="this.placeholder=''" onblur="this.placeholder='komentarz (opcjonalnie)'"></div>
								
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