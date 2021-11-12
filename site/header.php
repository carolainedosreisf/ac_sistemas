<?php
	if(!isset($_SESSION)){ 
        session_start(); 
    }
	if(isset($_SESSION['usuario'])){
		if(strtotime(date("Y-m-d H:i:s")) >= $_SESSION['usuario']['tempo_inatividade']){
			session_destroy();
		}
	
		$_SESSION['usuario']['tempo_inatividade'] = strtotime(date("Y-m-d H:i:s")."+30 minutes ");
	    //$_SESSION['usuario']['tempo_inatividade'] = strtotime(date("Y-m-d H:i:s")."+15 seconds");
	}

	$usuario = isset($_SESSION['usuario'])?$_SESSION['usuario']:0;
	$carrinho = isset($_SESSION['carrinho'])?$_SESSION['carrinho']:[];
	$qtd = isset($_SESSION['qtd'])?$_SESSION['qtd']:0;
	$valor = isset($_SESSION['valor'])?$_SESSION['valor']:0;

	if(!isset($controller)){
		$controller = "siteController";
	}

	
?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta name="generator" content="">
	<title>Blablabla Eventos - Home</title>
	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
	<link href="css/bootstrap.min.css" rel="stylesheet">
	<link href="css/style.css" rel="stylesheet">
	<link rel="stylesheet"  type="text/css" href="css/owl.carousel.css"/>
	<link rel="stylesheet"  type="text/css" href="css/owl.theme.default.css"/>
	<link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700" rel="stylesheet">
	<link href="https://fonts.googleapis.com/css?family=Roboto:200,300,400,500,600,700" rel="stylesheet">
	
	<link rel="stylesheet" type="text/css" href="css/datepicker.css">
	<link rel="stylesheet" href="css/sweetalert.css"/>

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
	<script src="js/dirPagination.js" language="javascript" type="text/javascript"></script>
	<script src="js/sweetalert.min.js"></script>

	<script src="controllers_js/<?php echo $controller;?>.js"></script>
	<script src="js/angular-input-masks-standalone.min.js"></script>
	
</head>
<body ng-app="app" ng-controller="<?php echo $controller; ?>">
<div class="loading ng-hide" ng-show="carregando">
	<img class="loading-img" src="images/load.gif">
</div>
<script> 
	var usuario = '<?php echo json_encode($usuario);?>';
	var carrinho = '<?php echo json_encode($carrinho);?>';
	var qtd = '<?php echo $qtd;?>';
	var valor = '<?php echo $valor;?>';
	var pagina = "";
</script>
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
	<style>
		figure.carrinho {
			display:inline-block;
			position: relative;
			border: 2px solid #3D566E;
			border-radius: 50%;
			padding: 7px;
			margin-right: 15px;
		}
		
		figure.carrinho figcaption {
			position: absolute;
			top: 17px;
			left:28px;
		}
		figure.carrinho figcaption .qtd-carrinho{
			font-size: 15px;
			color: white;
			background: orange;
			border-radius: 50%;
			padding: 2px 4px 1px 4px;
		}
	</style>
	<div class="wrapper">
		<nav role="navigation" class="navbar navbar-white navbar-embossed navbar-lg bg-light">
		<div class="">
			<div class="navbar-header">
				<button data-target="#navbar-collapse-02" data-toggle="collapse" class="navbar-toggle" type="button">
					<i class="fa fa-bars"></i>
					<span class="sr-only"></span>
				</button>
				<a class="navbar-brand brand cursor-pointer" href="carrinho.php" ng-show="usuario && usuario.cd_permissao != 1"> 
					<!-- <span class="carrinho">
						<i class="fa fa-shopping-cart"></i>
						<span class="qtd-carrinho">{{qtd_carrinho}}</span>
					</span> -->
					<figure class="carrinho">
						<i class="fa fa-shopping-cart"></i>
						<figcaption>
							<span class="qtd-carrinho">{{qtd_carrinho}}</span>
						</figcaption>
					</figure>
					<span class="saudacao-usuario">Bem vind{{usuario.sexo=='F'?'a':'o'}} {{usuario.nm_cadastro}}</span>
				</a>
			</div>
			<div id="navbar-collapse-02" class="collapse navbar-collapse">
				<ul class="nav navbar-nav navbar-right">
					<li class="propClone"><a href="index.php">Eventos</a></li>
					<li class="propClone"><a href="eventosoCorridos.php">Albuns</a></li>
					<li class="propClone"><a href="contato.php">Contato</a></li>
					<li class="propClone"><a href="minhasCompras.php" ng-show="usuario && usuario.cd_permissao != 1">Minhas Compras</a></li>
					<li class="propClone"><a href="logout.php" ng-show="usuario && usuario.cd_permissao != 1">Sair</a></li>
					<li class="propClone"><a href="login.php" ng-show="!usuario || usuario.cd_permissao == 1">Login</a></li>
					<li class="propClone"><a href="cadastro.php" ng-show="!usuario || usuario.cd_permissao == 1">Cadastro</a></li>
				</ul>
			</div>
		</div>
		</nav>
	</div>
</header>
