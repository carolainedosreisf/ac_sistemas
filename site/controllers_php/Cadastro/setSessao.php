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
                ,l.cd_permissao
                ,(SELECT concat(nm_cidade,' (',uf_cidade,')') FROM cidade AS b WHERE c.cd_cidade = b.cd_cidade) AS cidade
                ,c.nr_cpf
                ,c.nr_rg
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
        $item['cpf_formatado'] = formatar_cpf_cnpj($item['nr_cpf']);
        session_start();
        $_SESSION['usuario'] = $item;
        $_SESSION['usuario']['tempo_inatividade'] = strtotime(date("Y-m-d H:i:s")."+30 minutes");
        echo $item['cd_permissao'];
    }else{
        echo 0;
    }
?>