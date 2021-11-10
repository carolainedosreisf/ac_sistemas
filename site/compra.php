<?php 
    session_start();

    if(!(isset($_SESSION['usuario'])) || !(isset($_SESSION['carrinho'])) || !(isset($_SESSION['token']))){
        header('Location: index.php');
    }

    if(isset($_GET['t'])){
        if($_SESSION['token'] != $_GET['t']){
            header('Location: index.php');
        }
    }else{
        header('Location: index.php');
    }

    if(count($_SESSION['carrinho']) <= 0){
        header('Location: index.php');
    }
    include 'header.php';

?>
<script>
    var pagina = "COMPRA";
</script>
<section class="body">
    <div class="container" style="margin-top:50px;margin-bottom:50px;">
        <div class="underlined-title" id="mensagens">
            <div class="editContent">
                <h1 class="text-center latestitems">Compra</h1>
            </div>
            <div class="wow-hr type_short">
                <span class="wow-hr-h">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </span>
            </div>
        </div>

        <div class="container panel-white">
            <form name="form_compra" id="form_compra" novalidate ng-submit="setCompra()">
                <div class="painel">
                    <div class="titulo-painel text-left">
                        Itens da compra
                    </div>
                    <div class="corpo-painel">
                        <div class="padding-item" ng-repeat="l in lista_carrinho">
                            <div class="item">
                                <table class="table-compra-pc">
                                    <tr>
                                        <td class="text-center" width="10%">
                                            <img class="img-compra" src="../{{l.ft_caminho?l.ft_caminho:'arquivos/uploads_evento/sem-foto.jpg'}}">
                                        </td>
                                        <td width="70%">
                                            <div class="informacoes">
                                                <span class="titulo-evento">{{l.ds_evento}} ({{l.nome_tipo_evento}})</span>
                                                <span class="text">
                                                    <b>Valor Unitário: </b>{{(l.cd_promocao>0?l.vl_promocao:l.vl_venda) | currency:'R$'}}
                                                    &nbsp;&nbsp;<b>Quantidade: </b>{{l.qtd}}
                                                </span>
                                                <span class="text"> <b>Local: </b> {{l.ds_local}} / {{l.nome_cidade}} ({{l.uf_cidade}})</span>
                                                <span class="text"><b>Data: </b>{{l.dt_evento_br}} {{l.hr_evento}}</span>
                                                <span>
                                                    <b>Valor: </b>
                                                    <span ng-show="l.cd_promocao==0">{{l.vl_venda*l.qtd | currency:'R$'}}</span>
                                                    <span ng-show="l.cd_promocao>0">{{l.vl_promocao*l.qtd | currency:'R$'}}</span>
                                                </span>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                                <table class="table-compra-cel">
                                    <tr>
                                        <td width="100%">
                                            <div class="col-cel-5">
                                                <img  style="width: 100%;" src="../{{l.ft_caminho?l.ft_caminho:'arquivos/uploads_evento/sem-foto.jpg'}}">
                                            </div>
                                            <div class="informacoes col-cel-7">
                                                <span class="titulo-evento">{{l.ds_evento}} ({{l.nome_tipo_evento}})</span>
                                                <span class="text">
                                                    <b>Valor Unitário: </b>{{(l.cd_promocao>0?l.vl_promocao:l.vl_venda) | currency:'R$'}}
                                                    &nbsp;&nbsp;<b>Quantidade: </b>{{l.qtd}}
                                                </span>
                                                <span class="text"> <b>Local: </b> {{l.ds_local}} / {{l.nome_cidade}} ({{l.uf_cidade}})</span>
                                                <span class="text"><b>Data: </b>{{l.dt_evento_br}} {{l.hr_evento}}</span>
                                                <span>
                                                    <b>Valor: </b>
                                                    <span ng-show="l.cd_promocao==0">{{l.vl_venda*l.qtd | currency:'R$'}}</span>
                                                    <span ng-show="l.cd_promocao>0">{{l.vl_promocao*l.qtd | currency:'R$'}}</span>
                                                </span>
                                            </div>
                                        </td>
                                        
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <br>
                        <div class="total-compra">
                            <span><b>Total: {{valor_carrinho | currency:'R$'}}</b></span>
                        </div>
                    </div>
                </div>
                <div class="painel">
                    <div class="titulo-painel text-left">
                       Seus Dados
                    </div>
                    <div class="corpo-painel">
                        <div class="row form-group">
                            <div class="col-sm-6">
                                <label for="nm_cadastro">Nome:</label>
                                <input type="text" id="nm_cadastro" class="form-control" ng-value="usuario.nm_cadastro" ng-disabled="true">
                            </div>
                            <div class="col-sm-6">
                                <label for="ed_email">Email:</label>
                                <input type="text" id="ed_email" class="form-control" ng-value="usuario.ed_email" ng-disabled="true">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-4">
                                <label for="nr_cpf">CPF:</label>
                                <input type="text" id="nr_cpf" class="form-control" ng-value="usuario.cpf_formatado" ng-disabled="true">
                            </div>
                            <div class="col-sm-4">
                                <label for="nr_rg">RG:</label>
                                <input type="text" id="nr_rg" class="form-control" ng-value="usuario.nr_rg" ng-disabled="true">
                            </div>
                            <div class="col-sm-4">
                                <label for="cidade">Cidade:</label>
                                <input type="text" id="cidade" class="form-control" ng-value="usuario.cidade" ng-disabled="true">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="painel">
                    <div class="titulo-painel text-left">
                        Dados da Compra
                    </div>
                    <div class="corpo-painel">
                        <div class="row form-group" ng-show="form_compra.$invalid && form_compra.$submitted">
                            <div class="col-sm-12">
                                <div class="alert alert-danger" role="alert">
                                    Preencha os campos destacados!
                                </div>
                            </div>
                        </div>
                        <div class="row form-group" ng-show="error == 2">
                            <div class="col-sm-12">
                                <div class="alert alert-danger" role="alert">
                                    Existem um ou mais itens da sua compra esgotados!
                                </div>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-6" ng-class="form_compra.cd_fpagto.$invalid && (form_compra.$submitted || form_compra.cd_fpagto.$dirty)?'has-error':''">
                                <label for="cd_fpagto">Forma de pagamento:</label>
                                <select name="cd_fpagto" id="cd_fpagto" class="form-control" ng-model="cad_compra.cd_fpagto" ng-required="true" ng-change="calculaParcelas()">
                                    <option value="" style="display:none;"></option>
                                    <option value="{{l.cd_fpagto}}" ng-repeat="l in lista_formas_pagamento">{{l.ds_fpagto}}</option>
                                </select>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-6">
                                <table class="table table-bordered" ng-show="parcelas.length > 1">
                                    <thead>
                                        <tr>
                                            <th width="30%" class="text-center">Parcela</th>
                                            <th class="text-center">Valor</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr ng-repeat="l in parcelas">
                                            <td class="text-center">{{l.nr_parcela}}ª</td>
                                            <td class="text-center">{{l.vl_parcela | currency:'R$'}}</td>
                                        </tr>
                                    </tbody>

                                </table>
                                <div class="total-compra">
                                    <span><b>Total à pagar: {{valor_carrinho | currency:'R$'}}</b></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>

            <div class="col-md-4 col-lg-offset-4">
                <button class="btn-large-black" form="form_compra" ng-disabled="error == 2" ng-class="error == 2?'botao-disabled':''">
                    FINALIZAR COMPRA 
                </button>
            </div>
        </div>
    </div>
    
</section>
<?php include 'footer.php' ?>
