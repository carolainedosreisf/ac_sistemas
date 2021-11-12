<?php
    session_start();
    if(!(isset($_SESSION['usuario']))){
        echo json_encode(['erro_login'=>1]);
        exit;
    }else{
        if($_SESSION['usuario']['cd_permissao']==1){
            echo json_encode(['erro_login'=>1]);
            exit;
        }
    }

?>