
<?php $controller = "checkIngressosController"; ?>

<?php include 'header.php' ?>
<script>
    var pagina = 'INGRESSO';
    var id = "<?php echo $_GET['id']; ?>";
</script>
<div id="content" class="container" style="width:100%;">

    <h2>Check Ingressos: {{objEvento.ds_evento}} ({{objEvento.nome_tipo_evento}})</h2><br>

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
                        <th width="10%" class="text-center">Número lote</th>
                        <th>Dados da Compra</th>
                        <th width="10%" class="text-center">Ckeck</th>
                    </tr>
                </thead>
                <tbody>
                    <tr ng-show="(lista_ingressos| filter:filtro).length <=0">
                        <td class="text-center" colspan="3">Nenhum resgistro encontrado.</td>
                    </tr>
                    <tr ng-repeat="l in lista_ingressos | filter:filtro">
                        <td class="text-center">{{l.nr_lote}}</td>
                        <td>
                            <b>Nome:</b> {{l.nm_cadastro}} <br>
                            <b>CPF:</b> {{l.nr_cpf}} <br>
                            <b>Email:</b> {{l.ed_email}}

                        </td>
                        <td class="text-center">
                            <input style="width:25px;height:25px;"  ng-click="setCheckIngresso(l)" ng-disabled="l.check_presenca==1" ng-checked="l.check_presenca==1" ng-model="check_presenca[l.nr_lote]" type="checkbox" name="check_presenca_{{$index}}" id="check_presenca{{$index}}">
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
   
</div>
<?php include 'footer.php' ?>


         
