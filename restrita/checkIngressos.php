
<?php $controller = "checkIngressosController"; ?>

<?php include 'header.php' ?>
<script>var pagina = 'EVENTO';</script>
<div id="content" class="container" style="width:100%;">
    <div class="row">
        <div class="col-sm-12">
            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                <i class="glyphicon glyphicon-align-left"></i>
            </button>
        </div>
    </div>
    <h2>Check Ingressos</h2><br>

    <div class="row form-group">
        <div class="col-sm-8"></div>
        <div class="col-sm-4">
            <input type="text" class="form-control" placeholder="Pesquisar..." ng-model="filtro">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-striped table-bordered table-eventos">
                <thead>
                    <tr>
                        <th width="5%" class="text-center">#</th>
                        <th width="10%" class="text-center">Imagem</th>
                        <th width="75%">Evento</th>
                        <th width="10%" class="text-center">Abrir</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-show="(lista_eventos| filter:filtro).length <=0">
                        <td class="text-center" colspan="6">Nenhum resgistro encontrado.</td>
                    </tr>
                    <tr pagination-id="pg_eventos" dir-paginate="l in lista_eventos| filter:{sn_cancelado:'N'} | filter:filtro | itemsPerPage:20">
                        <td class="text-center">{{l.cd_evento}}</td>
                        <td class="text-center">
                            <img class="ft-evento-miniatura" src="../{{l.ft_caminho?l.ft_caminho:'arquivos/uploads_evento/sem-foto.jpg'}}" >
                        </td>
                        <td>
                            {{l.ds_evento}} ({{l.nome_tipo_evento}}) <br>
                            {{l.dt_evento_br}} {{l.hr_evento}} - 
                            <span ng-class="l.cd_promocao>0?'vl-venda':''">{{l.vl_venda | currency:'R$'}}</span>
                            <span ng-class="l.cd_promocao>0?'vl-promocao':''" ng-show="l.cd_promocao>0">{{l.vl_promocao | currency:'R$'}}</span> <br>
                            {{l.nome_cidade}} ({{l.uf_cidade}})
                        </td>
                        <td class="text-center">
                            <button class="btn btn-primary" ng-click="openIngressos(l)" ng-disabled="l.permite_check==1">
                                <i class="glyphicon glyphicon-search"></i>
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


         
