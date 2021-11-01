<?php 
    $controller = "minhasComprasController"; 

    include 'header.php';
    if(!(isset($_SESSION['usuario']))){
        header('Location: index.php');
    }

?>
<section class="body">
    <div class="container" style="margin-top:50px;margin-bottom:50px;">
        <div class="underlined-title" id="mensagens">
            <div class="editContent">
                <h1 class="text-center latestitems">Minhas Compras</h1>
            </div>
            <div class="wow-hr type_short">
                <span class="wow-hr-h">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </span>
            </div>
        </div>
        <div class="alert alert-primary text-center" role="alert" ng-show="lista_compras.length <= 0">
            Nenhum compra realizada ainda!
        </div>
        
        <div class="container panel-white" ng-show="lista_compras.length > 0">
            <br>
            <div class="painel" ng-repeat="l in lista_compras">
                <div class="titulo-painel text-center">
                   Compra Realizada em {{l.dt_compra_br}}
                </div>
                <div class="corpo-painel">
                    
                    <div class="padding-item" ng-repeat="e in l.eventos">
                        <div class="item">
                            <table>
                                <tr>
                                    <td class="text-center" width="10%">
                                        <img src="../{{e.ft_caminho?e.ft_caminho:'arquivos/uploads_evento/sem-foto.jpg'}}">
                                    </td>
                                    <td width="40%">
                                        <div class="informacoes">
                                            <span class="titulo-evento">{{e.ds_evento}} ({{e.nome_tipo_evento}})</span>
                                            <span class="text"> <b>Local: </b> {{e.ds_local}} / {{e.nome_cidade}} ({{e.uf_cidade}})</span>
                                            <span class="text"><b>Data Evento: </b>{{e.dt_evento_br}} {{e.hr_evento}}</span>
                                            <span class="text"><b>Classificação: </b>{{e.nr_classifi==0?'Livre':e.nr_classifi}}</span>
                                            
                                        </div>
                                    </td>
                                    <td width="40%">
                                        <span class="text"><b>Valor Unitário: </b>{{e.vl_venda | currency:'R$'}} </span>
                                        <span class="text"><b>Valor Total: </b>{{e.vl_venda*e.qt_compra | currency:'R$'}}</span>
                                        <span class="text"><b>Quantidade: </b>{{e.qt_compra}}</span>
                                    </td>
                                </tr>
                            </table>
                        </div>
                    </div>
                    <br>
                    <p>
                        <b>Forma de Pagamento: </b>{{l.ds_fpagto}} <br>
                        <b>Valor Total: </b>{{l.vl_total | currency:'R$'}} <br>
                        <b>Qtd. de itens: </b>{{l.qt_compra}} <br>
                    </p>
                </div>
            </div>
        </div>


</section>
<?php include 'footer.php' ?>
