
<?php $controller = "vendasEventoController"; ?>

<?php include 'header.php' ?>
<script>var pagina = 'CONSCIENCIA';</script>
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

    <h2>Clientes e Ciencias do calcelamento do enveto</h2><br>
    <div class="row">
        <div class="col-sm-7">
            <span><b>Evento: </b>{{objEvento.ds_evento}} ({{objEvento.nome_tipo_evento}})</span><br>
            <span><b>Data Evento: </b>{{objEvento.dt_evento}} {{objEvento.hr_evento}}</span><br>
            <span><b>Valor Evento: </b>{{objEvento.vl_mostrar | currency:'R$'}}</span><br>
            <span><b>Motivo Cancelamento: </b>{{objEvento.motivo_cancelamento}}</span><br><br>
            </div>
    </div>
    

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-striped table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th>Contato</th>
                        <th width="10%" class="text-center">Quantidade</th>
                        <th width="10%" class="text-center">Valor Reembolso</th>
                        <th width="10%" class="text-center">Dt. Compra</th>
                        <th width="10%" class="text-center">Consciente?</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-show="(lista_vendas).length <=0">
                        <td class="text-center" colspan="6">Nenhum resgistro encontrado.</td>
                    </tr>
                    <tr pagination-id="pg_conciencia" dir-paginate="l in lista_vendas | itemsPerPage:20">
                        <td>{{l.nm_cadastro}}</td>
                        <td>
                            {{l.ed_email}} <br ng-show="l.br_email">
                            {{l.nr_telefone}} <br ng-show="l.br_contato">
                            {{l.nr_contato}}

                        </td>
                        <td class="text-center">{{l.qt_compra}}</td>
                        <td class="text-center">{{l.vl_compra | currency:'R$'}}</td>
                        <td class="text-center">{{l.dt_compra_br}}</td>
                        <td class="text-center">{{l.consciencia_cancelamento=='S'?'Sim':'Não'}}</td>
                    </tr>
                </tbody>
            </table>
            <div class="col-sm-6"></div>
            <div class="col-sm-6 padding-0">
                <div class="pull-right">
                    <dir-pagination-controls 
                        max-size="7" 
                        direction-links="true" 
                        boundary-links="true" 
                        pagination-id="pg_conciencia">  
                    </dir-pagination-controls>  
                </div>
            </div>
            
        </div>
    </div>
</div>
<?php include 'footer.php' ?>


         
