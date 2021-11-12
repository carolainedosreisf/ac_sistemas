<?php
    require '../../funcoes.php';
    require '../../check_login.php';
    //session_start();
    //session_destroy();

    $obj = getPostAngular();


    if(!(isset($_SESSION['carrinho']))){
        $_SESSION['carrinho'] = [];
    }

    $existe = array_search($obj['cd_evento'],array_column($_SESSION['carrinho'],'cd_evento'));

    if($obj['tipo']==1){
        if($existe!==false){
            if($_SESSION['carrinho'][$existe]['qtd']==1){
                unset($_SESSION['carrinho'][$existe]);
            }else{
                $_SESSION['carrinho'][$existe]['qtd'] = $_SESSION['carrinho'][$existe]['qtd'] -1;
            }
        }

        $carrinho = $_SESSION['carrinho'];
        $_SESSION['carrinho'] = [];
        $qtd = 0;
        $valor = 0;
        foreach ($carrinho as $key => $v) {
            $_SESSION['carrinho'][] = $v;
            $qtd += $v['qtd'];
            $valor += $v['cd_promocao'] >0?($v['vl_promocao'] * $v['qtd']):$v['vl_venda'] * $v['qtd'];
        }

    }elseif($obj['tipo']==2){
        
        $_SESSION['carrinho'][$existe]['qtd'] = $_SESSION['carrinho'][$existe]['qtd'] + 1;

        $valores = returnQtd($_SESSION['carrinho']);
        $qtd = $valores['qtd'];
        $valor = $valores['valor'];

    }elseif($obj['tipo']==3){

        unset($_SESSION['carrinho'][$existe]);
        
        $carrinho = $_SESSION['carrinho'];
        $_SESSION['carrinho'] = [];
        $qtd = 0;
        $valor = 0;
        foreach ($carrinho as $key => $v) {
            $_SESSION['carrinho'][] = $v;
            $qtd += $v['qtd'];
            $valor += $v['cd_promocao'] >0?($v['vl_promocao'] * $v['qtd']):$v['vl_venda'] * $v['qtd'];
        }

    }elseif($obj['tipo']==4){
        $index = count($_SESSION['carrinho']);

        if($existe===false){
            $_SESSION['carrinho'][$index] = $obj;
            $_SESSION['carrinho'][$index]['qtd'] = 1;
        }else{
            $_SESSION['carrinho'][$existe]['qtd'] = $_SESSION['carrinho'][$existe]['qtd'] +1;
        }

        $valores = returnQtd($_SESSION['carrinho']);
        $qtd = $valores['qtd'];
        $valor = $valores['valor'];
        
    }

    function returnQtd($lista){
        $qtd = 0;
        $valor = 0;
        foreach ($lista as $key => $v) {
            $qtd += $v['qtd'];
            $valor += $v['cd_promocao'] >0?($v['vl_promocao'] * $v['qtd']):$v['vl_venda'] * $v['qtd'];

        }
        return ['qtd'=>$qtd,'valor'=>$valor];
    }

    $_SESSION['qtd'] = $qtd;
    $_SESSION['valor'] = $valor;

    echo json_encode(['qtd'=>$_SESSION['qtd'],'carrinho'=>$_SESSION['carrinho'],'valor'=>$_SESSION['valor']]);

?>
