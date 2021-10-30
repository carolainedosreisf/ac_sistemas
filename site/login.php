<?php 
    session_start();
    if(isset($_SESSION['usuario'])){
        header('Location: index.php');
    }
    $controller = "cadastroController";
?>
<?php include 'header.php' ?>
    <script>var cadastro = 0;</script>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <div class="row form-group">
                    <div class="alert alert-danger" role="alert" ng-show="form_login.$invalid && form_login.$submitted">
                        Preencha os campos destacados!
                    </div>
                    <div class="alert alert-danger" role="alert" ng-show="mensagem">
                        {{mensagem}}
                    </div>
                </div>
                <form class="login100-form validate-form" id="form" name="form_login" ng-submit="setSessao()" novalidate>
                    <span class="login100-form-title p-b-26">Login</span>
                    
                    <div class="row form-group" ng-class="form_login.nm_usuario.$invalid && (form_login.$submitted || form_login.nm_usuario.$dirty)?'has-error':''">
                        <label for="nm_usuario">Usuário:</label><br>
                        <input type="text" name="nm_usuario" ng-model="login.nm_usuario" ng-required="true">
                    </div>
                    <div class="row form-group" ng-class="form_login.senha.$invalid && (form_login.$submitted || form_login.senha.$dirty)?'has-error':''">
                        <label for="senha">Senha:</label><br>
                        <input type="password" name="senha" ng-model="login.senha" ng-required="true">
                    </div>
                    <div class="text-center">
                        <button type="submit" class="main_bt">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
<?php include 'footer.php' ?>
