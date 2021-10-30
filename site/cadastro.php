<?php 
    session_start();
    if(isset($_SESSION['usuario'])){
        //header('Location: index.php');
    }
    $controller = "cadastroController";
?>

<?php include 'header.php' ?>

<section class="item content" style="margin-top:50px;margin-bottom:50px;">
    <script>var cadastro = 1;</script>

    <div class="container toparea">
        <div class="underlined-title" id="mensagens">
            <div class="editContent">
                <h1 class="text-center latestitems">Casdastro</h1>
            </div>
            <div class="wow-hr type_short">
                <span class="wow-hr-h">
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                    <i class="fa fa-star"></i>
                </span>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-8 col-lg-offset-2">
                <div class="alert alert-danger" role="alert" ng-repeat="l in lista_msg">
                    Esse {{l.nome}} já esta cadastrado, por favor digite outro!
                </div>
                <div class="alert alert-danger" role="alert" ng-show="mensagem">
                    {{mensagem}}
                </div>
                <div class="alert alert-danger" role="alert" ng-show="form_cadastro.nr_cpf.$invalid && !(form_cadastro.nr_cpf.$error.required) && (form_cadastro.$submitted || form_cadastro.nr_cpf.$dirty)">
                    CPF Inválido!
                </div>
                <div class="alert alert-danger" role="alert" ng-show="cad.senha != cad.confirm_senha && !(form_cadastro.senha.$error.required) && !(form_cadastro.confirm_senha.$error.required) && (form_cadastro.$submitted || form_cadastro.nr_cpf.$dirty)">
                    As senhas não correspondem!
                </div>
                <div class="alert alert-danger" role="alert" ng-show="form_cadastro.$invalid && form_cadastro.$submitted">
                    Preencha os campos destacados!
                </div>
                <form id="contactform" name="form_cadastro" novalidate ng-submit="getVerificaColunas()">
                    <div class="form">
                        <div class="painel">
                            <div class="titulo-painel">
                                Dados Pessoais
                            </div>
                            <div class="corpo-painel">

                                <div class="row">
                                    <div class="col-sm-12" ng-class="form_cadastro.nm_cadastro.$invalid && (form_cadastro.$submitted || form_cadastro.nm_cadastro.$dirty)?'has-error':''">
                                        <label for="nm_cadastro">Nome:</label>
                                        <input type="text" name="nm_cadastro" ng-model="cad.nm_cadastro" autocomplete="off" ng-required="true" maxlength="50">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" ng-class="form_cadastro.nr_cpf.$invalid && (form_cadastro.$submitted || form_cadastro.nr_cpf.$dirty)?'has-error':''">
                                        <label for="nr_cpf">CPF:</label>
                                        <input type="text" name="nr_cpf" ng-model="cad.nr_cpf" ui-br-cpf-mask autocomplete="off" ng-required="true">
                                    </div>
                                    <div class="col-sm-6" ng-class="form_cadastro.nr_rg.$invalid && (form_cadastro.$submitted || form_cadastro.nr_rg.$dirty)?'has-error':''">
                                        <label for="nr_rg">RG:</label>
                                        <input type="text" name="nr_rg" autocomplete="off" ng-model="cad.nr_rg" ng-required="true" maxlength="9">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" ng-class="form_cadastro.dt_nascto.$invalid && (form_cadastro.$submitted || form_cadastro.dt_nascto.$dirty)?'has-error':''">
                                        <label for="dt_nascto">Data Nascimento:</label>
                                        <input type="text" data-provide="datepicker" class="date_picker" name="dt_nascto" autocomplete="off" data-date-format="dd/mm/yyyy" ng-model="cad.dt_nascto" ng-required="true">
                                    </div>
                                    <div class="col-sm-6" ng-class="form_cadastro.sexo.$invalid && (form_cadastro.$submitted || form_cadastro.sexo.$dirty)?'has-error':''">
                                        <label for="sexo">Sexo:</label>
                                        <select name="sexo" id="sexo" autocomplete="off" ng-model="cad.sexo" ng-required="true">
                                            <option value="F">Feminino</option>
                                            <option value="M">Masculino</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6" ng-class="form_cadastro.nr_telefone.$invalid && (form_cadastro.$submitted || form_cadastro.nr_telefone.$dirty)?'has-error':''">
                                        <label for="nr_telefone">Telefone:</label>
                                        <input type="text" id="nr_telefone" name="nr_telefone" ng-model="cad.nr_telefone" autocomplete="off" ui-br-phone-number-mask="areaCode">
                                    </div>
                                    <div class="col-sm-6" ng-class="form_cadastro.nr_contato.$invalid && (form_cadastro.$submitted || form_cadastro.nr_contato.$dirty)?'has-error':''">
                                        <label for="nr_contato">Celular:</label>
                                        <input type="text" id="nr_contato" name="nr_contato" ng-model="cad.nr_contato" autocomplete="off" ui-br-phone-number-mask="areaCode">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="painel">
                            <div class="titulo-painel">
                                Dados Enderço
                            </div>
                            <div class="corpo-painel">
                                <div class="row">
                                    <div class="col-sm-6" ng-class="form_cadastro.nr_cep.$invalid && (form_cadastro.$submitted || form_cadastro.nr_cep.$dirty)?'has-error':''">
                                        <label for="nr_cep">CEP:</label>
                                        <input type="text" ui-mask="99999-999" name="nr_cep" autocomplete="off" ng-model="cad.nr_cep" required="required">
                                    </div>
                                    <div class="col-sm-6" ng-class="form_cadastro.cd_cidade.$invalid && (form_cadastro.$submitted || form_cadastro.cd_cidade.$dirty)?'has-error':''">
                                        <label for="cidade">Cidade:</label>
                                        <select name="cd_cidade" id="cd_cidade" autocomplete="off" ng-model="cad.cd_cidade" required="required">
                                        <option value="">Selecione...</option>
                                        <option value="{{l.cd_cidade}}" ng-repeat="l in lista_cidades">{{l.nm_cidade}}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3" ng-class="form_cadastro.nr_endereco.$invalid && (form_cadastro.$submitted || form_cadastro.nr_endereco.$dirty)?'has-error':''">
                                        <label for="nr_endereco">Número:</label>
                                        <input type="text" name="nr_endereco" autocomplete="off" ng-model="cad.nr_endereco" required="required" maxlength="5">
                                    </div>
                                    <div class="col-sm-9" ng-class="form_cadastro.ed_cadastro.$invalid && (form_cadastro.$submitted || form_cadastro.ed_cadastro.$dirty)?'has-error':''">
                                        <label for="ed_cadastro">Endereço:</label>
                                        <input type="text" name="ed_cadastro" autocomplete="off" ng-model="cad.ed_cadastro" required="required" maxlength="80">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" ng-class="form_cadastro.ba_cadastro.$invalid && (form_cadastro.$submitted || form_cadastro.ba_cadastro.$dirty)?'has-error':''">
                                        <label for="ba_cadastro">Bairro:</label>
                                        <input type="text" name="ba_cadastro" autocomplete="off" ng-model="cad.ba_cadastro" required="required" maxlength="50">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" ng-class="form_cadastro.co_complemento.$invalid && (form_cadastro.$submitted || form_cadastro.co_complemento.$dirty)?'has-error':''">
                                        <label for="co_complemento">Complemento:</label>
                                        <input type="text" name="co_complemento" autocomplete="off" ng-model="cad.co_complemento" maxlength="80">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="painel">
                            <div class="titulo-painel">
                                Dados Login
                            </div>
                            <div class="corpo-painel">
                                <div class="row">
                                    <div class="col-sm-12" ng-class="form_cadastro.ed_email.$invalid && (form_cadastro.$submitted || form_cadastro.ed_email.$dirty)?'has-error':''">
                                        <label for="ed_email">E-mail:</label>
                                        <input type="email" name="ed_email" autocomplete="off" ng-model="cad.ed_email" required="required" maxlength="80">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" ng-class="form_cadastro.nm_usuario.$invalid && (form_cadastro.$submitted || form_cadastro.nm_usuario.$dirty)?'has-error':''">
                                        <label for="nm_usuario">Nome de usuario:</label>
                                        <input type="text" name="nm_usuario" autocomplete="off" ng-model="cad.nm_usuario" required="required" maxlength="50">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" ng-class="form_cadastro.senha.$invalid && (form_cadastro.$submitted || form_cadastro.senha.$dirty)?'has-error':''">
                                        <label for="senha">Senha:</label>
                                        <input type="password" name="senha" autocomplete="off" ng-model="cad.senha" required="required" maxlength="20">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12" ng-class="form_cadastro.confirm_senha.$invalid && (form_cadastro.$submitted || form_cadastro.confirm_senha.$dirty)?'has-error':''">
                                        <label for="confirm_senha">Confirmar Senha:</label>
                                        <input type="password" name="confirm_senha" autocomplete="off" ng-model="cad.confirm_senha" required="required" maxlength="20">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn-large-black">Cadastrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
<?php include 'footer.php' ?>
