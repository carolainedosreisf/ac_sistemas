
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
                        <td>{{l.ds_evento}} ({{l.nome_tipo_evento}}) - {{l.dt_evento_br}} {{l.hr_evento}} <br>
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

                            <button ng-click="openAlbuns(l.cd_evento)" class="btn btn-default" ng-disabled="l.ocorrido==0" data-html="true" data-toggle="tooltip" tooltip data-placement="top" data-original-title="Álbum">
                                <i class="glyphicon glyphicon-book"></i>
                            </button>
                      
                            <button ng-click="openSetEvento(l.cd_evento)" class="btn btn-primary" data-html="true" data-toggle="tooltip" tooltip data-placement="top" data-original-title="Editar/Ver">
                                <i class="glyphicon glyphicon-{{l.publica=='N'?'pencil':'search'}}"></i>
                            </button>

                            <button class="btn btn-danger" data-html="true" data-toggle="tooltip" tooltip data-placement="top" data-original-title="Cancelar Evento">
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

</div>
<?php include 'footer.php' ?>


         
