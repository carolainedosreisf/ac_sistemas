<?php $controller = "eventosController"; ?>
<?php include 'header.php'?>
<script>
    var cadastro = 1;
</script>
<div id="content" class="container" style="width:100%;">
    <div class="row">
        <div class="col-sm-12">
            <button type="button" id="sidebarCollapse" class="btn btn-info navbar-btn">
                <i class="glyphicon glyphicon-align-left"></i>
            </button>
            <a href="eventos.php" class="btn btn-default">
                <i class="glyphicon glyphicon-arrow-left"></i>
                Voltar
            </a>
        </div>
    </div>
    <h2>{{cad.cd_evento?'Editar':'Cadastrar'}} Evento</h2><br>
    <div class="row form-group" ng-show="form_evento.$invalid && form_evento.$submitted">
        <div class="col-sm-12">
            <div class="alert alert-danger" role="alert">
                Preencha os campos destacados!
            </div>
        </div>
    </div>
    <div class="row form-group" ng-show="mensagem">
        <div class="col-sm-12">
            <div class="alert alert-danger" role="alert">
                {{mensagem}}
            </div>
        </div>
    </div>
    <form name="form_evento" ng-submit="setEvento()" novalidate>
        <div class="row form-group" ng-show="cad.cd_evento">
            <div class="col-sm-3">
                <label for="cd_evento">Código:</label>
                <input type="text" class="form-control" name="cd_evento" id="cd_evento" autocomplete="off" ng-model="cad.cd_evento" ng-disabled="true">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-6" ng-class="form_evento.ds_evento.$invalid && (form_evento.$submitted || form_evento.ds_evento.$dirty)?'has-error':''">
                <label for="ds_evento">Descrição:</label>
                <input type="text" class="form-control" name="ds_evento" id="ds_evento" autocomplete="off" ng-model="cad.ds_evento" required="required" maxlength="50">
            </div>
            <div class="col-sm-3" ng-class="form_evento.dt_evento.$invalid && (form_evento.$submitted || form_evento.dt_evento.$dirty)?'has-error':''">
                <label for="dt_evento">Data:</label>
                <input type="text" data-provide="datepicker" class="form-control date_picker" name="dt_evento" autocomplete="off" data-date-format="dd/mm/yyyy" ng-model="cad.dt_evento" ng-required="true">
            </div>
            <div class="col-sm-3">
                <label for="nr_classifi">Classificação:</label>
                <select class="form-control" name="nr_classifi" id="nr_classifi" autocomplete="off" ng-model="cad.nr_classifi">
                    <option value="">Livre</option>
                    <option value="10">10</option>
                    <option value="12">12</option>
                    <option value="14">14</option>
                    <option value="16">16</option>
                    <option value="18">18</option>
                </select>
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-4" ng-class="form_evento.cd_tipoevento.$invalid && (form_evento.$submitted || form_evento.cd_tipoevento.$dirty)?'has-error':''">
                <label for="cd_tipoevento">Tipo:</label>
                <select class="form-control" name="cd_tipoevento" id="cd_tipoevento" autocomplete="off" ng-model="cad.cd_tipoevento" required="required">
                    <option value="">Selecione...</option>
                    <option value="{{l.cd_tipoevento}}" ng-repeat="l in lista_tipos_eventos">{{l.ds_evento}}</option>
                </select>
            </div>
            <div class="col-sm-2" ng-class="form_evento.vl_venda.$invalid && (form_evento.$submitted || form_evento.vl_venda.$dirty)?'has-error':''">
                <label for="vl_venda">Valor de Venda:</label>
                <input type="text" class="form-control" name="vl_venda" id="vl_venda" autocomplete="off" ng-model="cad.vl_venda" required="required" maxlength="22" ui-number-mask="2">
            </div>
            <div class="col-sm-4">
                <label for="cd_promocao">Promoção:</label>
                <select class="form-control" name="cd_promocao" id="cd_promocao" autocomplete="off" ng-model="cad.cd_promocao" ng-change="setCampoPromocao()">
                    <option value="">Nenhuma</option>
                    <option value="{{l.cd_promossao}}" ng-repeat="l in lista_promocoes">{{l.ds_promossao}}</option>
                </select>
            </div>
            <div class="col-sm-2" ng-class="form_evento.vl_promocao.$invalid && (form_evento.$submitted || form_evento.vl_promocao.$dirty)?'has-error':''">
                <label for="vl_promocao">Valor de Promoção:</label>
                <input type="text" class="form-control" name="vl_promocao" id="vl_promocao" ng-disabled="true" autocomplete="off" ng-model="cad.vl_promocao" maxlength="22" ui-number-mask="2">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-6" ng-class="form_evento.cd_cidade.$invalid && (form_evento.$submitted || form_evento.cd_cidade.$dirty)?'has-error':''">
                <label for="cd_cidade">Cidade:</label>
                <select class="form-control" name="cd_cidade" id="cd_cidade" autocomplete="off" ng-model="cad.cd_cidade" required="required">
                    <option value="">Selecione...</option>
                    <option value="{{l.cd_cidade}}" ng-repeat="l in lista_cidades">{{l.nm_cidade+ ' ('+ l.uf_cidade+')'}}</option>
                </select>
            </div>
            <div class="col-sm-6" ng-class="form_evento.ds_local.$invalid && (form_evento.$submitted || form_evento.ds_local.$dirty)?'has-error':''">
                <label for="ds_local">Local:</label>
                <input type="text" class="form-control" name="ds_local" id="ds_local" autocomplete="off" ng-model="cad.ds_local" required="required" maxlength="50">
            </div>
        </div>
        <div class="row form-group">
            <div class="col-sm-2">
                <button class="btn btn-success form-control">Salvar</button>
            </div>
        </div>
    </form>
</div>

<?php include 'footer.php';?>