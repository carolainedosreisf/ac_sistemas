<?php include 'header.php' ?>

<!-- CONTENT =============================-->
<section class="item content" style="margin-top:50px">
    <div class="container toparea">
        <div class="underlined-title">
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
                <form method="post" action="contact.php" id="contactform">
                    <div class="form">
                        <div class="painel">
                            <div class="titulo-painel">
                                Dados Pessoais
                            </div>
                            <div class="corpo-painel">

                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="nome">Nome:</label>
                                        <input type="text" name="nome" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="cpf">CPF:</label>
                                        <input type="text" name="cpf" autocomplete="off">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="rg">RG:</label>
                                        <input type="text" name="rg" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <label for="dt_nascimento">Data Nascimento:</label>
                                        <input type="text" name="dt_nascimento" autocomplete="off">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="sexo">Sexo:</label>
                                        <select name="sexo" id="sexo" autocomplete="off">
                                            <option value="F">Feminino</option>
                                            <option value="M">Masculino</option>
                                        </select>
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
                                    <div class="col-sm-6">
                                        <label for="cep">CEP:</label>
                                        <input type="text" name="cep" autocomplete="off">
                                    </div>
                                    <div class="col-sm-6">
                                        <label for="cidade">Cidade:</label>
                                        <input type="text" name="cidade" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-3">
                                        <label for="numero">Número:</label>
                                        <input type="text" name="numero" autocomplete="off">
                                    </div>
                                    <div class="col-sm-9">
                                        <label for="logradouro">Logradouro:</label>
                                        <input type="text" name="logradouro" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="endereco">Endereço:</label>
                                        <input type="text" name="endereco" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="bairro">Bairro:</label>
                                        <input type="text" name="bairro" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="complemento">Complemento:</label>
                                        <input type="text" name="complemento" autocomplete="off">
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
                                    <div class="col-sm-12">
                                        <label for="email">E-mail:</label>
                                        <input type="email" name="email" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="senha">Senha:</label>
                                        <input type="password" name="senha" autocomplete="off">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <label for="confirm_senha">Confirmar Senha:</label>
                                        <input type="password" name="confirm_senha" autocomplete="off">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <input type="submit" id="submit" class="clearfix btn" value="Cadastrar">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php include 'footer.php' ?>
