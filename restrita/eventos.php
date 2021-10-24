
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
            <div class="col-sm-4">
                <label for="sn_cancelado">Status</label>
                <select class="form-control" name="sn_cancelado" id="sn_cancelado" autocomplete="off" ng-model="filtro_status">
                    <option value="N">Ativo</option>
                    <option value="S">Cancelado</option>
                </select>
            </div>
            <div class="col-sm-4">
                <label for="filtro">Busca Rápida...</label>
                <input type="text" name="filtro" ng-model="filtro" class="form-control">
            </div>
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
                        <th width="15%">Tipo</th>
                        <th width="15%" class="text-center">Cidade</th>
                        <th width="5%" class="text-center">Editar</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-show="(lista_eventos| filter:{sn_cancelado:filtro_status} | filter:{nome_cidade:filtro_cidade} | filter:filtro).length <=0">
                        <td class="text-center" colspan="6">Nenhum resgistro encontrado.</td>
                    </tr>
                    <tr pagination-id="pg_eventos" dir-paginate="l in lista_eventos| filter:{sn_cancelado:filtro_status} | filter:{nome_cidade:filtro_cidade} | filter:filtro | itemsPerPage:20">
                        <td class="text-center">{{l.cd_evento}}</td>
                        <td class="text-center">
                            <img class="ft-evento-miniatura" src="../{{l.ft_caminho?l.ft_caminho:'arquivos/uploads_evento/sem-foto.jpg'}}" >
                        </td>
                        <td>{{l.ds_evento}} - {{l.dt_evento_br}} 
                            (<span ng-class="l.cd_promocao>0?'vl-venda':''">{{l.vl_venda | currency:'R$'}}</span>
                            <span ng-class="l.cd_promocao>0?'vl-promocao':''" ng-show="l.cd_promocao>0">{{l.vl_promocao | currency:'R$'}}</span>)
                        </td>
                        <td>{{l.nome_tipo_evento}}</td>
                        <td class="text-center">{{l.nome_cidade}} ({{l.uf_cidade}})</td>
                        <td class="text-center">
                            <button ng-click="openSetEvento(l.cd_evento)" class="btn btn-primary btn-sm">
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
                    pagination-id="pg_eventos">  
                </dir-pagination-controls>  
            </div>
        </div>
    </div>

</div>
<?php include 'footer.php' ?>


         