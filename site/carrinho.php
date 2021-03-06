<?php 
include 'header.php';
if(!(isset($_SESSION['usuario']))){
	header('Location: index.php');
}

?>
<section class="body">
    <div class="container" style="margin-top:50px;margin-bottom:50px;">
        <div class="underlined-title" id="mensagens">
            <div class="editContent">
                <h1 class="text-center latestitems">Carrinho</h1>
            </div>
            <div class="wow-hr type_short">
                <span class="wow-hr-h">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </span>
            </div>
        </div>
        <div class="alert alert-primary text-center" role="alert" ng-show="lista_carrinho.length<=0">
            Nenhum item adicionado ao carrinho ainda!
        </div>
        
        <div class="container panel-white" ng-show="lista_carrinho.length >0">
            <div class="col-sm-12">
                <p><b>Total de itens: {{qtd_carrinho}}</b></p>
            </div>

            <div class="col-md-12 padding-item" ng-repeat="l in lista_carrinho">
                <div class="item">
                    <table class="table-cart-pc">
                        <tr>
                            <td class="text-center" width="10%"><img src="../{{l.ft_caminho?l.ft_caminho:'arquivos/uploads_evento/sem-foto.jpg'}}"></td>
                            <td width="60%">
                                <div class="informacoes">
                                    <span class="titulo-evento">{{l.ds_evento}} ({{l.nome_tipo_evento}})</span>
                                    <span class="text"><b>Valor Unitário: </b>{{(l.cd_promocao>0?l.vl_promocao:l.vl_venda) | currency:'R$'}}</span>
                                    <span class="text"><b>Local: </b>{{l.ds_local}} / {{l.nome_cidade}} ({{l.uf_cidade}})</span>
                                    <span class="text"><b>Data: </b>{{l.dt_evento_br}} {{l.hr_evento}}</span>
                                </div>
                            </td>
                            <td class="text-center">
                                <div class="carrinho-acoes">
                                    <span class="span_" ng-class="l.qtd<=1?'cursor-not-allowed span-disabled':'cursor-pointer'" ng-click="setCarrinho(l,1)"><i class="fa fa-minus"></i></span>
                                    <span class="span_ qtd">{{l.qtd}}</span>
                                    <span class="span_ cursor-pointer" ng-click="setCarrinho(l,2)"><i class="fa fa-plus"></i></span>
                                </div>
                            </td>
                            <td class="text-center" width="10%">
                                <span>
                                    <b ng-class="l.cd_promocao>0?'vl-venda':''">{{l.cd_promocao>0?('('+(l.vl_venda*l.qtd | currency:'R$')+')'):(l.vl_venda*l.qtd | currency:'R$')}}</b>
                                    <b ng-class="l.cd_promocao>0?'vl-promocao':''" ng-show="l.cd_promocao>0">{{l.vl_promocao*l.qtd | currency:'R$'}}</b>
                                </span>
                            </td>
                            <td class="text-center" width="5%">
                                <span class="apagar cursor-pointer" ng-click="setCarrinho(l,3)"><i class="fa fa-trash-o ml-3 text-black-50"></i></span>
                            </td>
                        </tr>
                    </table>
                    <table class="table-cart-cel">
                        <tr>
                            <td width="100%">
                                <div class="col-cel-5">
                                    <img style="width:100%" src="../{{l.ft_caminho?l.ft_caminho:'arquivos/uploads_evento/sem-foto.jpg'}}">
                                </div>
                                <div class="col-cel-7">
                                    <div class="informacoes ">
                                        <span class="titulo-evento">{{l.ds_evento}} ({{l.nome_tipo_evento}})</span>
                                        <span class="text"><b>Valor Unitário: </b>{{(l.cd_promocao>0?l.vl_promocao:l.vl_venda) | currency:'R$'}}</span>
                                        <span class="text"><b>Local: </b>{{l.ds_local}} / {{l.nome_cidade}} ({{l.uf_cidade}})</span>
                                        <span class="text"><b>Data: </b>{{l.dt_evento_br}} {{l.hr_evento}}</span>
                                    </div>
                                
                                    <div class="carrinho-acoes" style="padding-left: 15px;">
                                        <span class="span_" ng-class="l.qtd<=1?'cursor-not-allowed span-disabled':'cursor-pointer'" ng-click="setCarrinho(l,1)"><i class="fa fa-minus"></i></span>
                                        <span class="qtd span_">{{l.qtd}}</span>
                                        <span class="cursor-pointer span_" ng-click="setCarrinho(l,2)"><i class="fa fa-plus"></i></span>
                                        <span class="apagar_" ng-click="setCarrinho(l,3)">
                                            <i class="fa fa-trash-o ml-3 text-black-50"></i>
                                        </span>
                                    </div>
                                    
                                    <span style="padding-left: 15px;">
                                        <b ng-class="l.cd_promocao>0?'vl-venda':''">{{l.cd_promocao>0?('('+(l.vl_venda*l.qtd | currency:'R$')+')'):(l.vl_venda*l.qtd | currency:'R$')}}</b>
                                        <b ng-class="l.cd_promocao>0?'vl-promocao':''" ng-show="l.cd_promocao>0">{{l.vl_promocao*l.qtd | currency:'R$'}}</b>
                                    </span>
                                </div>
                                
                                
                            </td>
                        </tr>
                    </table>
                </div>
            </div><br>
            <div class="col-md-4 col-lg-offset-4 margin-20">
                <button class="btn-large-black" ng-click="setToken()">
                    Comprar {{valor_carrinho | currency:'R$'}}
                </button>
            </div>
        </div>
        
    </div>
    
</section>
<?php include 'footer.php' ?>
