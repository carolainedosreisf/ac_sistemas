<?php
    session_start();
    if(!(isset($_SESSION['usuario']))){
        header('Location: ../site/login.php');
    }else{
        if($_SESSION['usuario']['cd_permissao'] != 1){
            header('Location: ../site/login.php');
        }
    }
    if(strtotime(date("Y-m-d H:i:s")) >= $_SESSION['usuario']['tempo_inatividade']){
        header('Location: logout.php');
    }
    $usuario = $_SESSION['usuario'];

    $_SESSION['usuario']['tempo_inatividade'] = strtotime(date("Y-m-d H:i:s")."+30 minutes");

?>

<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">

        <title>Administração - Blablabla</title>
        <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.6.3/css/font-awesome.min.css" rel="stylesheet">
        <link rel="stylesheet" href="css/bootstrap.css">
        <link rel="stylesheet" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="css/datepicker.css">
        <link rel="stylesheet" href="css/sweetalert.css"/>

        <script src="js/jquery-.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/angular.min.js"></script>

	    <script src="js/jquery.inputmask.bundle.min.js"></script>
        <script src="js/masks.js"></script>
	    <script src="js/ui-mask.js"></script>
	    <script src="js/angular-locale_pt-br.js"></script>
	    <script src="js/bootstrap-datepicker.js"></script>

        <script src="js/dirPagination.js" language="javascript" type="text/javascript"></script>
        
        <script src="controllers/<?php echo $controller;?>.js"></script>
        <script src="js/angular-input-masks-standalone.min.js"></script>
        <script src="js/sweetalert.min.js"></script>

    </head>
    <body ng-app="app" ng-controller="<?php echo $controller; ?>">
        <div class="loading ng-hide" ng-show="carregando">
            <img class="loading-img" src="img/load.gif">
        </div>
        <div class="wrapper">
            <!-- Sidebar Holder -->
            <nav id="sidebar">
                <div class="sidebar-header">
                    <h3>
                        AC SISTEMAS
                    </h3>
                </div>

                <ul class="list-unstyled components">
                    <!-- <li class="">
                        <a href="#homeSubmenu" data-toggle="collapse" aria-expanded="false">Home</a>
                        <ul class="collapse list-unstyled" id="homeSubmenu">
                            <li><a href="#">Home 1</a></li>
                            <li><a href="#">Home 2</a></li>
                            <li><a href="#">Home 3</a></li>
                        </ul>
                    </li> -->
                    <li><a href="promocoes.php">Promoções</a></li>
                    <li><a href="tiposEventos.php">Tipos de Eventos</a></li>
                    <li><a href="eventos.php">Eventos</a></li>
                    <li><a href="checkIngressos.php">Check Ingressos</a></li>
                    <li><a href="formasPagamento.php">Formas de Pagamento</a></li>
                    <li><a href="clientes.php">Clientes</a></li>
                    <li><a href="logout.php">Sair</a></li>
                </ul>
            </nav>
            <script>var id = "<?php echo  isset($_GET['id'])?$_GET['id']:0;?>";</script>