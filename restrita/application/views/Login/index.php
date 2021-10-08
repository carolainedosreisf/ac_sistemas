<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Blablabla Eventos</title>
    <link href="<?php echo base_url('assets/css/style.css')?>" rel="stylesheet">
    <link href="<?php echo base_url('assets/css/bootstrap.css')?>" rel="stylesheet">
</head>
<body>
    <div class="limiter">
        <div class="container-login100">
            <div class="wrap-login100">
                <form class="login100-form validate-form " id="form">
                    <span class="login100-form-title p-b-26">Login</span>
                    
                    <div class="row form-group">
                        <label for="">Email:</label><br>
                        <input type="text" name="email">
                    </div>
                    <div class="row form-group">
                        <label for="">Senha:</label><br>
                        <input type="password" name="pass">
                    </div>
                    <div class="text-center">
                        <button class="main_bt">Entrar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>
</html>