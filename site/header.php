<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="generator" content="">
	<title>Blablabla Eventos - Home</title>
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link rel="stylesheet"  type="text/css" href="css/owl.carousel.css"/>
	<link rel="stylesheet"  type="text/css" href="css/owl.theme.default.css"/>
	<link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:200,300,400,500,600,700" rel="stylesheet">
	
	
	<?php if(isset($controller)){?>
		<link rel="stylesheet" type="text/css" href="css/datepicker.css">
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap.js"></script>
		<script src="js/angular.min.js"></script>
		<script src="js/jquery.inputmask.bundle.min.js"></script>
		<script src="js/angular-br-filters.js"></script>
		<script src="js/angular-sanitize.min.js"></script>
		<script src="js/masks.js"></script>
		<script src="js/ui-mask.js"></script>
		<script src="js/angular-locale_pt-br.js"></script>
		<script src="js/bootstrap-datepicker.js"></script>
		<script src="js/controllers/<?php echo $controller;?>"></script>
		<script src="js/angular-input-masks-standalone.min.js"></script>
	<?php } ?>
</head>
<body>
<header class="margin-top-0">
	<div class="barra-topo">
		<div class="text-homeimage text-center">
			<div class="maintext-image" data-scrollreveal="enter top over 1.5s after 0.1s">
				AC SISTEMAS
			</div>
			<div class="subtext-image" data-scrollreveal="enter bottom over 1.7s after 0.3s">
				Agilizando seu negócio!
			</div>
		</div>
	</div>
	
	<div class="wrapper">
		<nav role="navigation" class="navbar navbar-white navbar-embossed navbar-lg bg-light">
		<div class="container">
			<div class="navbar-header">
				<button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button">
				<i class="fa fa-bars"></i>
				<span class="sr-only"></span>
				</button>
			</div>
			<div id="navbar-collapse-02" class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="propClone"><a href="index.php">Lançamentos</a></li>
					<li class="propClone"><a href="">Promoções</a></li>
					<li class="propClone"><a href="">Shows</a></li>
					<li class="propClone"><a href="">Eventos</a></li>
					<li class="propClone"><a href="">Agenda</a></li>
					<li class="propClone"><a href="">Albuns</a></li>
					<li class="propClone"><a href="contato.php">Contato</a></li>
					<li class="propClone"><a href="login.php">Login</a></li>
					<li class="propClone"><a href="cadastro.php">Cadastro</a></li>
				</ul>
			</div>
		</div>
		</nav>
	</div>
</header>
