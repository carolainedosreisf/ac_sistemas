<?php 
include 'header.php';
?>
<script>
    var pagina = "ALBUM";
</script>
<section class="body">
    <div class="container" style="margin-top:50px;margin-bottom:50px;">

        <div class="container">
            <div class="row filtros bs-callout bs-callout-default">
                <div class="col-sm-4">
                    <label for="filtrar">Busca Rápida:</label>
                    <input type="text" name="filtrar" id="filtrar" class="form-control" ng-model="filtrar" placeholder="Pesquisar...">
                </div>
                <div class="col-sm-4">
                    <label for="nome_cidade">Cidade:</label>
                    <select name="nome_cidade" id="nome_cidade" class="form-control" ng-model="filtros.nome_cidade">
                        <option value="">Todas</option>
                        <option value="{{l.nm_cidade}}" ng-repeat="l in lista_cidades">{{l.nm_cidade}} ({{l.uf_cidade}})</option>
                    </select>
                </div>
                <div class="col-sm-4">
                    <label for="nome_tipo_evento">Categoria:</label>
                    <select name="nome_tipo_evento" id="nome_tipo_evento" class="form-control" ng-model="filtros.nome_tipo_evento">
                        <option value="">Todas</option>
                        <option value="{{l.ds_evento}}" ng-repeat="l in lista_tipos_eventos">{{l.ds_evento}}</option>
                    </select>
                </div>
            </div>
        </div>
        <div class="underlined-title" id="mensagens">
            <div class="editContent">
                <h1 class="text-center latestitems">Eventos Ocorridos</h1>
            </div>
            <div class="wow-hr type_short">
                <span class="wow-hr-h">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </span>
            </div>
        </div>
        <div class="alert alert-primary text-center" role="alert" ng-show="(lista_lancamentos| filter:filtrar |filter:{nome_cidade:filtros.nome_cidade} | filter:{nome_tipo_evento:filtros.nome_tipo_evento}).length<=0">
            Nenhum registro ainda!
        </div>
        <div class="row">
            <div class="col-md-4" pagination-id="pg_ocorridos" dir-paginate="l in lista_lancamentos| filter:filtrar |filter:{nome_cidade:filtros.nome_cidade} | filter:{nome_tipo_evento:filtros.nome_tipo_evento} | itemsPerPage:6">
                <div class="productbox">
                    <div class="fadeshop" ng-mouseover="aparece='evento-car-'+l.cd_evento">
                        <span class="maxproduct card-evento" style="width: 100% !important">
                        <img 
                            src="../{{l.ft_caminho?l.ft_caminho:'arquivos/uploads_evento/sem-foto.jpg'}}" 
                            alt="">
                    </span>
                    </div>
                    <div class="product-details">
                        <a href="#">
                            <h1>
                                {{l.ds_evento}} <br>
                                <span class="eventos-button">
                                    <span ng-class="l.cd_promocao>0?'vl-venda':''">
                                        {{l.cd_promocao>0?('('+(l.vl_venda | currency:'R$')+')'):(l.vl_venda | currency:'R$')}}
                                    </span>
                                    <span ng-class="l.cd_promocao>0?'vl-promocao':''" ng-show="l.cd_promocao>0">
                                        &nbsp;
                                        {{l.vl_promocao | currency:'R$'}}
                                    </span>
                                    {{l.nome_cidade}} ({{l.uf_cidade}})
                                </span><br>
                                {{l.dt_evento_br}} {{l.hr_evento}}
                            </h1>
                        </a>
                        <span class="price">
                            <span class="edd_price">
                                <button class="main_bt" ng-click="getAlbuns(l)"><i class="fa fa-book"></i>  Álbum</button>
                            </span>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div style="margin-bottom:50px" class="container">
            <div class="row">
                <div class="col-sm-12 text-center">
                    <dir-pagination-controls 
                        max-size="7" 
                        direction-links="true" 
                        boundary-links="true" 
                        pagination-id="pg_ocorridos">  
                    </dir-pagination-controls>  
                </div>
            </div>
        </div>
    </div>

    <div id="album" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                        <h4 class="modal-title">Álbum: {{objEvento.ds_evento}} ({{objEvento.nome_tipo_evento}})</h4>
                </div>
                <div class="modal-body">
                    <div class="row form-group" ng-show="lista_albuns.length <=0">
                        <div class="col-sm-12">
                            <div class="alert alert-info" role="alert">
                                Nenhum álbum cadastrado.
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12 text-center pagination-album">
                            <dir-pagination-controls 
                                max-size="1" 
                                direction-links="true" 
                                boundary-links="true" 
                                pagination-id="pg_albuns">  
                            </dir-pagination-controls>  
                        </div>
                    </div>
                    <div class="row" pagination-id="pg_albuns" dir-paginate="l in lista_albuns | itemsPerPage:1">
                        <div class="col-sm-12">
                            <p class="text-center"><b>{{l.ds_album}}</b></p>
                            <img style="width:100%;" src="../{{l.ft_caminho?l.ft_caminho:'arquivos/uploads_evento/sem-foto.jpg'}}">
                        </div>
                    </div>
                    
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
                </div>
            </div>
        </div>
    </div>
    
</section>
<?php include 'footer.php' ?>
