
<?php $controller = "formasPagamentoController"; ?>

<?php include 'header.php' ?>
<script>var cadastro = 0;</script>
<div id="content" class="container" style="width:100%;">
    <div class="row">
        <div class="col-sm-12">
            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                <i class="glyphicon glyphicon-align-left"></i>
            </button>
            <button type="button" ng-click="openModalCad()" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i>
                Nova
            </button>
        </div>
    </div>

    <h2>Formas de Pagamento</h2><br>

    <div class="row form-group">
        <div class="col-sm-8"></div>
        <div class="col-sm-4">
            <input type="text" class="form-control" placeholder="Pesquisar..." ng-model="filtrar">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">#</th>
                        <th>Descrição</th>
                        <th width="8%" class="text-center">Qtd. Parcelas</th>
                        <th width="8%" class="text-center">Valor Mínimo</th>
                        <th width="5%" class="text-center">Editar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-show="(lista_formas_pagamento | filter:filtrar ).length <=0">
                        <td class="text-center" colspan="5">Nenhum resgistro encontrado.</td>
                    </tr>
                    <tr pagination-id="pg_formas_pagamento" dir-paginate="l in lista_formas_pagamento| filter:filtrar | itemsPerPage:20">
                        <td class="text-center">{{l.cd_fpagto}}</td>
                        <td>{{l.ds_fpagto}}</td>
                        <td class="text-center">{{l.qt_parcela}}</td>
                        <td class="text-center">{{l.vl_min | currency:'R$'}}</td>
                        <td class="text-center">
                            <button ng-click="openModalCad(l)" class="btn btn-primary btn-sm">
                                <i class="glyphicon glyphicon-pencil"></i>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="pull-right">
                <dir-pagination-controls 
                    max-size="7" 
                    direction-links="true" 
                    boundary-links="true" 
                    pagination-id="pg_formas_pagamento">  
                </dir-pagination-controls>  
            </div>
        </div>
    </div>
    <div id="cadFormaPagamento" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{txt_modal}}</h4>
                </div>
                <div class="modal-body">
                    <div class="row form-group" ng-show="form_forma_pagamento.$invalid && form_forma_pagamento.$submitted">
                        <div class="col-sm-12">
                            <div class="alert alert-danger" role="alert">
                                Preencha os campos destacados!
                            </div>
                        </div>
                    </div>
                    <div class="row form-group" ng-show="mensagem">
                        <div class="col-sm-12">
                            <div class="alert alert-danger" role="alert">
                                {{mensagem}}
                            </div>
                        </div>
                    </div>
                    <form name="form_forma_pagamento" id="form_forma_pagamento" novalidate ng-submit="setFormaPagamento()">
                        <div class="row form-group" ng-show="cad.cd_fpagto">
                            <div class="col-sm-3">
                                <label for="cd_fpagto">Código:</label>
                                <input type="text" class="form-control" name="cd_fpagto" id="cd_fpagto" autocomplete="off" ng-model="cad.cd_fpagto" ng-disabled="true">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-12" ng-class="form_forma_pagamento.ds_fpagto.$invalid && (form_forma_pagamento.$submitted || form_forma_pagamento.ds_fpagto.$dirty)?'has-error':''">
                                <label for="ds_fpagto">Descrição:</label>
                                <input type="text" name="ds_fpagto" autocomplete="of" class="form-control" maxlength="50" ng-model="cad.ds_fpagto" ng-required="true">
                            </div>
                            
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-6">
                                <label for="qt_parcela">Qtd Parcelas:</label>
                                <input type="text" class="form-control" name="qt_parcela" id="qt_parcela" autocomplete="off" ng-model="cad.qt_parcela" maxlength="11" ui-number-mask="0">
                            </div>
                            <div class="col-sm-6">
                                <label for="vl_min">Valor Mínino:</label>
                                <input type="text" class="form-control" name="vl_min" id="vl_min" autocomplete="off" ng-model="cad.vl_min" maxlength="22" ui-number-mask="2">
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" form="form_forma_pagamento" class="btn btn-success" ng-disabled="form_promocao.$invalid">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php' ?>


         
