
<?php $controller = "eventosController"; ?>

<?php include 'header.php' ?>
<script>var cadastro = 0;</script>
<div id="content" class="container" style="width:100%;">
    <div class="row">
        <div class="col-sm-12">
            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                <i class="glyphicon glyphicon-align-left"></i>
            </button>
            <a href="novoEvento.php" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i>
                Novo
            </a>
        </div>
    </div>

    <h2>Eventos</h2><br>
    
    <div class="bs-callout bs-callout-default">
        <div class="row">
            <div class="col-sm-4">
                <label for="cd_cidade">Cidade</label>
                <select class="form-control" name="cd_cidade" id="cd_cidade" autocomplete="off" ng-model="filtro_cidade">
                    <option value="">Todas</option>
                    <option value="{{l.nm_cidade}}" ng-repeat="l in lista_cidades">{{l.nm_cidade+ ' ('+ l.uf_cidade+')'}}</option>
                </select>
            </div>
            <div class="col-sm-3">
                <label for="sn_cancelado">Status</label>
                <select class="form-control" name="sn_cancelado" id="sn_cancelado" autocomplete="off" ng-model="filtro_status">
                    <option value="N">Ativo</option>
                    <option value="S">Cancelado</option>
                </select>
            </div>
            <div class="col-sm-2">
                <label for="ocorrido">Evento já ocorrido?</label>
                <select class="form-control" name="ocorrido" id="ocorrido" autocomplete="off" ng-model="filtro_ocorrido">
                    <option value="">Todos</option>
                    <option value="N">Não</option>
                    <option value="S">Sim</option>
                </select>
            </div>
            <div class="col-sm-3">
                <label for="filtro">Busca Rápida...</label>
                <input type="text" name="filtro" ng-model="filtro" class="form-control">
            </div>
        </div>
        
        
    </div>

    <div class="row form-group">
        <div class="col-sm-2">
            <a 
                class="btn btn-primary form-control" 
                onclick="MyWindow=window.open('relatorioEventos.php','MyWindow','width=800,height=600'); return false;" href="#" 
                target="blank"
            >
                <i class="glyphicon glyphicon-print"></i>
                Imprimir
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-striped table-bordered table-eventos">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">#</th>
                        <th width="5%" class="text-center">Imagem</th>
                        <th>Evento</th>
                        <th width="25%" class="text-center">Ingresso/Lotação/Álbm/Ver/Cancelar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-show="(lista_eventos| filter:{sn_cancelado:filtro_status} | filter:{nome_cidade:filtro_cidade} | filter:{ocorrido:filtro_ocorrido} | filter:filtro).length <=0">
                        <td class="text-center" colspan="6">Nenhum resgistro encontrado.</td>
                    </tr>
                    <tr pagination-id="pg_eventos" dir-paginate="l in lista_eventos| filter:{sn_cancelado:filtro_status} | filter:{ocorrido:filtro_ocorrido} | filter:{nome_cidade:filtro_cidade} | filter:filtro | itemsPerPage:20">
                        <td class="text-center">{{l.cd_evento}}</td>
                        <td class="text-center">
                            <img class="ft-evento-miniatura" src="../{{l.ft_caminho?l.ft_caminho:'arquivos/uploads_evento/sem-foto.jpg'}}" >
                        </td>
                        <td>
                            <b ng-show="l.sn_cancelado=='S'" style="color:red;" >
                                <i>Evento Cancelado</i>
                                <button ng-click="openCancelamento(l)" class="btn btn-primary btn-xs">
                                    <i class="glyphicon glyphicon-search"></i>
                                </button> <br>
                            </b>
                            {{l.ds_evento}} ({{l.nome_tipo_evento}}) - {{l.dt_evento_br}} {{l.hr_evento}} <br>
                            <span ng-class="l.cd_promocao>0?'vl-venda':''">{{l.vl_venda | currency:'R$'}}</span>
                            <span ng-class="l.cd_promocao>0?'vl-promocao':''" ng-show="l.cd_promocao>0">{{l.vl_promocao | currency:'R$'}}</span> <br>
                            {{l.nome_cidade}} ({{l.uf_cidade}})
                        </td>
                        <td class="text-center">
                            <button class="btn btn-primary" data-html="true" data-toggle="tooltip" tooltip data-placement="top" data-original-title="Ingresso">
                                <i class="fa fa-ticket"></i>
                            </button>

                            <button class="btn btn-default" ng-click="openVendas(l.cd_evento)" data-html="true" data-toggle="tooltip" tooltip data-placement="top" data-original-title="Lotação">
                                {{l.qtd_vendas}}/{{l.nr_lotacao}} <i class="glyphicon glyphicon-search"></i>
                            </button>

                            <button ng-click="openAlbuns(l.cd_evento)" class="btn btn-default" ng-disabled="l.ocorrido=='N'" data-html="true" data-toggle="tooltip" tooltip data-placement="top" data-original-title="Álbum">
                                <i class="glyphicon glyphicon-book"></i>
                            </button>
                      
                            <button ng-click="openSetEvento(l.cd_evento)" class="btn btn-primary" data-html="true" data-toggle="tooltip" tooltip data-placement="top" data-original-title="Editar/Ver">
                                <i class="glyphicon glyphicon-{{l.publica=='N'?'pencil':'search'}}"></i>
                            </button>

                            <button class="btn btn-danger" ng-disabled="l.permite_cancela==0" ng-click="openCancelamento(l)"data-html="true" data-toggle="tooltip" tooltip data-placement="top" data-original-title="Cancelar Evento">
                                <i class="glyphicon glyphicon-remove"></i>
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
                    pagination-id="pg_eventos">  
                </dir-pagination-controls>  
            </div>
        </div>
    </div>

    <div id="cancelamento" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">{{objEvento.sn_cancelado=='S'?'Motivo do cancelamento':'Cancelar'}}: {{objEvento.ds_evento}} ({{objEvento.nome_tipo_evento}})</h4>
                </div>
                <div class="modal-body">
                    <div ng-show="objEvento.sn_cancelado=='N'">
                        <div class="row form-group" ng-show="form_cancelamento.$invalid && form_cancelamento.$submitted">
                            <div class="col-sm-12">
                                <div class="alert alert-danger" role="alert">
                                    Preencha os campos destacados!
                                </div>
                            </div>
                        </div>
                        <form name="form_cancelamento" id="form_cancelamento" novalidate ng-submit="setCancelamento()">
                        
                            <div class="row form-group">
                                <div class="col-sm-12" ng-class="form_cancelamento.motivo_cancelamento.$invalid && (form_cancelamento.$submitted || form_cancelamento.motivo_cancelamento.$dirty)?'has-error':''">
                                    <label for="ds_promossao">Descrição:</label>
                                    <textarea name="motivo_cancelamento" id="motivo_cancelamento" autocomplete="off" rows="4" class="form-control" maxlength="255" ng-model="cad.motivo_cancelamento " ng-required="true"></textarea>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div ng-show="objEvento.sn_cancelado=='S'">
                        <p>{{objEvento.motivo_cancelamento}}</p>
                    </div>
                    
                </div>
                <div class="modal-footer" ng-show="objEvento.sn_cancelado=='N'">
                    <button type="submit" class="btn btn-danger" form="form_cancelamento">Cancelar Evento</button>
                </div>
            </div>
        </div>
    </div>

</div>
<?php include 'footer.php' ?>


         
