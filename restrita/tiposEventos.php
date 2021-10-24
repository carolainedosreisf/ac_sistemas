
<?php $controller = "tiposEventosController"; ?>

<?php include 'header.php' ?>
<div id="content" class="container" style="width:100%;">
    <div class="row">
        <div class="col-sm-12">
            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                <i class="glyphicon glyphicon-align-left"></i>
            </button>
            <button ng-click="openModalCad()" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i>
                Novo
            </button>
        </div>
    </div>

    <h2>Tipos de Eventos</h2><br>
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
                    <th class="text-center" width="10%">#</th>
                    <th>Descrição</th>
                    <th class="text-center" width="10%">Editar</th>
                </tr>
                </thead>
                <tbody>
                    <tr ng-show="(lista_tipos_eventos| filter:filtrar).length <=0">
                        <td class="text-center" colspan="3">Nenhum resgistro encontrado.</td>
                    </tr>
                    <tr 
                    pagination-id="pg_tipos_eventos" 
                    dir-paginate="l in lista_tipos_eventos| filter:filtrar | itemsPerPage:20">
                        <td class="text-center">{{l.cd_tipoevento}}</td>
                        <td>{{l.ds_evento}}</td>
                        <td class="text-center">
                            <button ng-click="openModalCad(l)" class="btn btn-primary">
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
                    pagination-id="pg_tipos_eventos">  
                </dir-pagination-controls>  
            </div>
        </div>
    </div>

</div>
<div id="cadTipoEvento" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">{{txt_modal}}</h4>
            </div>
            <div class="modal-body">
                <form name="form_tipo_evento" novalidate>
                    <label for="ds_evento">Descrição:</label>
                    <input type="text" name="ds_evento" autocomplete="off" class="form-control" maxlength="50" ng-model="cad.ds_evento" ng-required="true">
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                <button type="submit" class="btn btn-success" ng-click="setTipoEvento()" ng-disabled="form_tipo_evento.$invalid">Salvar</button>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php' ?>


         
