<?php
    require '../../conexao.php';
    require '../../funcoes.php';

    $obj = getPostAngular();

    

    $cadastro = $obj['cadastro'];
    $nm_usuario = $obj['nm_usuario'];
    $senha = $cadastro?$obj['senha']:md5($obj['senha']);

    $sql = "SELECT 
                c.nm_cadastro
                ,DATE_FORMAT(c.dt_nascto, '%d/%m/%Y') AS dt_nascto
                ,c.sexo
                ,c.ed_email
                ,l.nm_usuario
                ,c.cd_cadastro
            FROM cadastro AS c
            INNER JOIN login AS l
            ON c.cd_cadastro = l.cd_cadastro
                WHERE nm_usuario = '{$nm_usuario}' 
                AND senha = '{$senha}'";

    $query = mysqli_query($conexao, $sql);
    $item = mysqli_fetch_array($query, MYSQLI_ASSOC);
    $cont = mysqli_num_rows($query);
    // echo "<pre>";
    // print_r($sql);
    
    if($cont==1){
        session_start();
        $_SESSION['usuario'] = $item;
        echo 1;
    }else{
        echo 0;
    }
?>