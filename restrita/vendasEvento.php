
<?php $controller = "vendasEventoController"; ?>

<?php include 'header.php' ?>
<script>var pagina = 'VENDAS';</script>
<div id="content" class="container" style="width:100%;">
    <div class="row">
        <div class="col-sm-12">
            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                <i class="glyphicon glyphicon-align-left"></i>
            </button>
            <a type="button" href="index" class="btn btn-default">
                <i class="glyphicon glyphicon-arrow-left"></i>
                Voltar
            </a>
        </div>
    </div>

    <h2>Vendas do Evento: {{objEvento.ds_evento}} ({{objEvento.nome_tipo_evento}})</h2><br>

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
                        <th>Cliente</th>
                        <th>Email</th>
                        <th width="10%" class="text-center">Sexo</th>
                        <th width="10%" class="text-center">Dt. Nascimento</th>
                        <th width="10%" class="text-center">Quantidade</th>
                        <th width="10%" class="text-center">Valor Total</th>
                        <th width="10%" class="text-center">Dt. Compra</th>

                    </tr>
                </thead>
                <tbody>
                    <tr ng-show="(lista_vendas | filter:filtrar ).length <=0">
                        <td class="text-center" colspan="7">Nenhum resgistro encontrado.</td>
                    </tr>
                    <tr pagination-id="pg_promocoes" dir-paginate="l in lista_vendas| filter:filtrar | itemsPerPage:20">
                        <td>{{l.nm_cadastro}}</td>
                        <td>{{l.ed_email}}</td>
                        <td class="text-center">{{l.sexo=='F'?'Feminino':'Masculino'}}</td>
                        <td class="text-center">{{l.dt_nascto}}</td>
                        <td class="text-center">{{l.qt_compra}}</td>
                        <td class="text-center">{{(l.vl_compra*l.qt_compra) | currency:'R$'}}</td>
                        <td class="text-center">{{l.dt_compra_br}}</td>
                    </tr>
                </tbody>
            </table>
            <div class="col-sm-6 padding-0">
                <p>
                    <b>Qtd. de Vendas: </b>{{qtd}}&nbsp;&nbsp;&nbsp;&nbsp;
                    <b>Valor Total: </b>{{valor | currency:'R$'}}
                </p>
            </div>
            <div class="col-sm-6 padding-0">
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
    </div>
</div>
<?php include 'footer.php' ?>


         
