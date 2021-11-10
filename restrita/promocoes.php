
<?php $controller = "promocoesController"; ?>

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

    <h2>Promoções</h2><br>

    <div class="row form-group">
        <div class="col-sm-5"></div>
        <div class="col-sm-3">
            <select name="status" id="status" class="form-control" ng-model="filtro_status">
                <option value="">Todas</option>
                <option value="A">Ativas</option>
                <option value="I">Inativas</option>
            </select>
        </div>
        <div class="col-sm-4">
            <input type="text" class="form-control" placeholder="Pesquisar..." ng-model="filtrar">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-striped table-bordered table-responsive">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">#</th>
                        <th>Promoção</th>
                        <th width="8%" class="text-center">Dt. Início</th>
                        <th width="8%" class="text-center">Dt. Fim</th>
                        <th width="8%" class="text-center">Status</th>
                        <th width="5%" class="text-center">Editar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-show="(lista_promocoes | filter:filtrar | filter:{status:filtro_status} ).length <=0">
                        <td class="text-center" colspan="4">Nenhum resgistro encontrado.</td>
                    </tr>
                    <tr pagination-id="pg_promocoes" dir-paginate="l in lista_promocoes| filter:filtrar | filter:{status:filtro_status} | itemsPerPage:20">
                        <td class="text-center">{{l.cd_promossao}}</td>
                        <td>{{l.ds_promossao}} ({{l.vl_promossao | currency:'R$'}})</td>
                        <td class="text-center">{{l.dt_prazoini}}</td>
                        <td class="text-center">{{l.dt_prazofim}}</td>
                        <td class="text-center">{{l.status=='A'?'Ativa':'Inativa'}}</td>
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
                    pagination-id="pg_promocoes">  
                </dir-pagination-controls>  
            </div>
        </div>
    </div>
    <div id="cadPromocao" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{txt_modal}}</h4>
                </div>
                <div class="modal-body">
                    <div class="row form-group" ng-show="mensagem">
                        <div class="col-sm-12">
                            <div class="alert alert-danger" role="alert">
                                {{mensagem}}
                            </div>
                        </div>
                    </div>
                    <div class="row form-group" ng-show="form_promocao.$invalid && form_promocao.$submitted">
                        <div class="col-sm-12">
                            <div class="alert alert-danger" role="alert">
                                Preencha os campos destacados!
                            </div>
                        </div>
                    </div>
                    <form name="form_promocao" id="form_promocao" novalidate ng-submit="setPromocao()">
                        <div class="row form-group" ng-show="cad.cd_promossao">
                            <div class="col-sm-3">
                                <label for="cd_promossao">Código:</label>
                                <input type="text" class="form-control" name="cd_promossao" id="cd_promossao" autocomplete="off" ng-model="cad.cd_promossao" ng-disabled="true">
                            </div>
                        </div>
                        <div class="row form-group">
                            <div class="col-sm-8" ng-class="form_promocao.ds_promossao.$invalid && (form_promocao.$submitted || form_promocao.ds_promossao.$dirty)?'has-error':''">
                                <label for="ds_promossao">Descrição:</label>
                                <input type="text" name="ds_promossao" autocomplete="of" class="form-control" maxlength="45" ng-model="cad.ds_promossao" ng-required="true">
                            </div>
                            <div class="col-sm-4" ng-class="form_promocao.vl_promossao.$invalid && (form_promocao.$submitted || form_promocao.vl_promossao.$dirty)?'has-error':''">
                                <label for="vl_promossao">Valor:</label>
                                <input type="text" class="form-control" name="vl_promossao" id="vl_promossao" autocomplete="off" ng-model="cad.vl_promossao" required="required" maxlength="22" ui-number-mask="2">
                            </div>
                        </div>

                        <div class="row form-group">
                            <div class="col-sm-6">
                                <label for="dt_prazoini">Data Início:</label>
                                <input type="text" data-provide="datepicker" class="form-control date_picker" name="dt_prazoini" autocomplete="off" data-date-format="dd/mm/yyyy" ng-model="cad.dt_prazoini">
                            </div>
                            <div class="col-sm-6">
                                <label for="dt_prazofim">Data Final:</label>
                                <input type="text" data-provide="datepicker" class="form-control date_picker" name="dt_prazofim" autocomplete="off" data-date-format="dd/mm/yyyy" ng-model="cad.dt_prazofim">
                            </div>
                        </div>
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success" form="form_promocao">Salvar</button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php' ?>


         
