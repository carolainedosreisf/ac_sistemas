<?php
    $param = $_GET['apaga'];
    session_start();

    if($param==0){
        $token = bin2hex(random_bytes('78'));
        $_SESSION['token'] = $token;
        echo $token;
    }else{
        unset($_SESSION['token']);
        unset($_SESSION['carrinho']);
        unset($_SESSION['qtd']);
        unset($_SESSION['valor']);
    }
    
?>