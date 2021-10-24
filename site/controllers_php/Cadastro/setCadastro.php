<?php
    require '../../conexao.php';
    require '../../funcoes.php';

    $obj = getPostAngular();

    $data_cadastro = [
        "nm_cadastro" => $obj['nm_cadastro'],
        "dt_nascto" => formataData($obj['dt_nascto'],1),
        "sexo" => $obj['sexo'],
        "co_complemento" => isset($obj['co_complemento'])?$obj['co_complemento']:null,
        "nr_endereco" => $obj['nr_endereco'],
        "ba_cadastro" => $obj['ba_cadastro'],
        "cd_cidade" => $obj['cd_cidade'],
        "ed_cadastro" => $obj['ed_cadastro'],
        "nr_cep" => $obj['nr_cep'],
        "nr_cpf" => $obj['nr_cpf'],
        "nr_rg" => $obj['nr_rg'],
        "ed_email" => $obj['ed_email'],
        "nr_telefone" => isset($obj['nr_telefone'])?$obj['nr_telefone']:null,
        "nr_contato" => isset($obj['nr_contato'])?$obj['nr_contato']:null
    ];

    // echo "<pre>";
    // print_r($data_cadastro);
    // exit;

    $insert_cadastro = montaInsert($data_cadastro,['cd_cidade']);
    $sql_cadastro = "INSERT INTO cadastro ({$insert_cadastro['colunas']}) VALUES ({$insert_cadastro['valores']})";
    $cadastro = mysqli_query($conexao, $sql_cadastro);
    $cd_cadastro = mysqli_insert_id($conexao);
    $login = 0;
    $data_login = [];

    if($cadastro==1){
        $data_login = [
            "cd_cadastro" => $cd_cadastro,
            "nm_usuario" => $obj['nm_usuario'],
            "senha" => md5($obj['senha']),
            "cd_permissao" => 2
        ];

        $insert_login = montaInsert($data_login,['cd_permissao']);
        $sql_login = "INSERT INTO login ({$insert_login['colunas']}) VALUES ({$insert_login['valores']})";
        $login = mysqli_query($conexao, $sql_login);
    }

    // echo "<pre>";
    // print_r($sql_login);

    echo json_encode(['sucesso'=>$login,'login'=>$data_login])

?>