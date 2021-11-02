
<?php $controller = "albunsEventoController"; ?>

<?php include 'header.php' ?>
<script>var cadastro = 0;</script>
<div id="content" class="container" style="width:100%;">
    <div class="row">
        <div class="col-sm-12">
            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                <i class="glyphicon glyphicon-align-left"></i>
            </button>
            <a type="button" href="eventos" class="btn btn-default">
                <i class="glyphicon glyphicon-arrow-left"></i>
                Voltar
            </a>
            <a data-toggle="modal" data-target="#cadAlbum" class="btn btn-success">
                <i class="glyphicon glyphicon-plus"></i>
                Novo
            </a>
        </div>
    </div>

    <h2>Álbum: {{objEvento.ds_evento}} ({{objEvento.nome_tipo_evento}})</h2><br>
    
    <div class="row form-group">
        <div class="col-sm-8"></div>
        <div class="col-sm-4">
            <input type="text" class="form-control" placeholder="Pesquisar..." ng-model="filtrar">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-striped table-bordered table-eventos">
                <thead>
                    <tr>
                        <th width="30%" class="text-center">Imagem</th>
                        <th>Descrição</th>
                        <th width="8%" class="text-center">Excluir</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-show="(lista_albuns | filter:filtrar).length <=0">
                        <td class="text-center" colspan="6">Nenhum resgistro encontrado.</td>
                    </tr>
                    <tr pagination-id="pg_albuns" dir-paginate="l in lista_albuns | filter:filtrar| itemsPerPage:20">
                        <td class="text-center">
                            <img class="ft-album-miniatura" src="../{{l.ft_caminho}}" >
                        </td>
                        <td>{{l.ds_album}}</td>
                        <td class="text-center">
                            <button class="btn btn-danger" ng-click="deleteAlbum(l)">
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
                    pagination-id="pg_albuns">  
                </dir-pagination-controls>  
            </div>
        </div>
    </div>

    <div id="cadAlbum" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Cadastrar Álbum</h4>
                </div>
                <div class="modal-body">
                    <div class="row form-group" ng-show="mensagem">
                        <div class="col-sm-12">
                            <div class="alert alert-danger" role="alert">
                                {{mensagem}}
                            </div>
                        </div>
                    </div>
                    <div class="row form-group" ng-show="form_album.$invalid && form_album.$submitted">
                        <div class="col-sm-12">
                            <div class="alert alert-danger" role="alert">
                                Preencha os campos destacados!
                            </div>
                        </div>
                    </div>
                    <form name="form_album" id="form_album" novalidate ng-submit="setAlbum()">
                        <div class="row form-group">
                            <div class="col-sm-12" ng-class="form_album.ds_album.$invalid && (form_album.$submitted || form_album.ds_album.$dirty)?'has-error':''">
                                <label for="ds_album">Descrição:</label>
                                <input type="text" name="ds_album" autocomplete="off" class="form-control" maxlength="50" ng-model="cad.ds_album">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <label>Imagem</label>
                                <input type="file" file-input="files" class="form-control">
                            </div>
                        </div>
                        
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                    <button type="submit" class="btn btn-success" form="form_album">Salvar</button>
                </div>
            </div>
        </div>
    </div>

</div>
<?php include 'footer.php' ?>


         
