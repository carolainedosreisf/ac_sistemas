
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
        
        <script src="controllers/vendasEventoController.js"></script>
        <script src="js/angular-input-masks-standalone.min.js"></script>
        <script src="js/sweetalert.min.js"></script>

    </head>
    <body ng-app="app" ng-controller="vendasEventoController">
        <script>var pagina = 'RELATORIO';</script>
        <div id="content" class="container" style="width:100%;">
            <div class="row form-group" ng-repeat="e in lista" style="margin-top:40px;">
                <div class="col-sm-12">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th colspan="7" class="text-center">
                                    {{e.ds_evento}} ({{e.nome_tipo_evento}}) - 
                                    {{e.dt_evento_br}} {{e.hr_evento}} - 
                                    {{e.nome_cidade}} ({{e.uf_cidade}}) 
                                    <span ng-show="e.nome_promocao!=''"> - Promoção: {{e.nome_promocao}}</span>

                                </th>
                            </tr>
                            <tr>
                                <th>Cliente</th>
                                <th>Email</th>
                                <th width="10%" class="text-center">Sexo</th>
                                <th width="10%" class="text-center">Dt. Nascimento</th>
                                <th width="10%" class="text-center">Quantidade</th>
                                <th width="10%" class="text-center">Valor Unitário</th>
                                <th width="10%" class="text-center">Dt. Compra</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr ng-show="(e.clientes).length <=0">
                                <td class="text-center" colspan="7">Nenhum venda realizada.</td>
                            </tr>
                            <tr ng-repeat="l in e.clientes">
                                <td>{{l.nm_cadastro}}</td>
                                <td>{{l.ed_email}}</td>
                                <td class="text-center">{{l.sexo=='F'?'Feminino':'Masculino'}}</td>
                                <td class="text-center">{{l.dt_nascto}}</td>
                                <td class="text-center">{{l.qt_compra}}</td>
                                <td class="text-center">{{l.vl_compra | currency:'R$'}}</td>
                                <td class="text-center">{{l.dt_compra_br}}</td>
                            </tr>
                            <tr ng-show="(e.clientes).length > 0">
                                <td colspan="7" class="text-center">
                                    <b>Qtd. de Vendas: </b>{{e.qtd}}&nbsp;&nbsp;&nbsp;&nbsp;
                                    <b>Valor Total: </b>{{e.valor | currency:'R$'}}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    
                </div>
            </div>
        </div>
</body>
</html>