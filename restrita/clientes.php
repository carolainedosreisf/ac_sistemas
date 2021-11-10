
<?php $controller = "clientesController"; ?>

<?php include 'header.php' ?>
<script>var cadastro = 0;</script>
<div id="content" class="container" style="width:100%;">
    <div class="row">
        <div class="col-sm-12">
            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                <i class="glyphicon glyphicon-align-left"></i>
            </button>
        </div>
    </div>
    <h2>Clientes</h2><br>

    <div class="row form-group">
        <div class="col-sm-8"></div>
        <div class="col-sm-4">
            <input type="text" class="form-control" placeholder="Pesquisar..." ng-model="filtrar">
        </div>
    </div>

    <div class="row">
        <div class="col-sm-12">
            <table class="table table-striped table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>Cliente</th>
                        <th width="10%">CPF/RG</th>
                        <th width="15%" class="text-center">Cidade</th>
                        <th width="10%" class="text-center">Sexo</th>
                        <th width="10%" class="text-center">Dt. Nascimento</th>
                        <th width="12%" class="text-center">Telefone</th>
                        <th width="10%" class="text-center">Itens Comprados</th>

                    </tr>
                </thead>
                <tbody>
                    <tr ng-show="(lista_clientes | filter:filtrar ).length <=0">
                        <td class="text-center" colspan="7">Nenhum resgistro encontrado.</td>
                    </tr>
                    <tr pagination-id="pg_clientes" dir-paginate="l in lista_clientes| filter:filtrar | itemsPerPage:20">
                        <td>
                            {{l.nm_cadastro}} <br>
                            {{l.ed_email}}
                        </td>
                        <td>
                            {{l.nr_cpf}} <br>
                            {{l.nr_rg}}
                        </td>
                        <td class="text-center">{{l.nome_cidade}} ({{l.uf_cidade}})</td>
                        <td class="text-center">{{l.sexo=='F'?'Feminino':'Masculino'}}</td>
                        <td class="text-center">{{l.dt_nascto}}</td>
                        <td class="text-center">
                            {{l.nr_contato}}
                            <br ng-show="l.br_contato">
                            {{l.nr_telefone}}

                        </td>
                        <td class="text-center">{{l.qtd_eventos}}</td>
                    </tr>
                </tbody>
            </table>
            <div class="pull-right">
                <dir-pagination-controls 
                    max-size="7" 
                    direction-links="true" 
                    boundary-links="true" 
                    pagination-id="pg_clientes">  
                </dir-pagination-controls>  
            </div>
        </div>
    </div>
   
</div>
<?php include 'footer.php' ?>


         
