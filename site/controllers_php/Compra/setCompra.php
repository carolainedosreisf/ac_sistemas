<?php
    require '../../conexao.php';
    require '../../funcoes.php';

    $dados = getPostAngular();
    $data = $dados['data'];
    $total = $dados['total'];
    $carrinho = $dados['carrinho'];
    $cd_cadastro = $dados['usuario']['cd_cadastro'];

    $data_compra = [
        'cd_cadastro' => $cd_cadastro,
        'cd_fpagto' => $data['cd_fpagto'],
        'vl_total' => $total,
        'dt_compra' => date("Y-m-d H:i:s")
    ];

    $insert_compra = montaInsert($data_compra,['cd_cadastro','cd_fpagto','vl_total']);
    $sql_compra = "INSERT INTO compra ({$insert_compra['colunas']}) VALUES ({$insert_compra['valores']})";
    $compra = mysqli_query($conexao, $sql_compra);

    if($compra==1){
        
        foreach ($carrinho as $key => $item) {
            $valor = $item['cd_promocao']>0?$item['vl_promocao']:$item['vl_venda'];
            
            $data_item = [
                'cd_compra' => 1,
                'cd_ingresso' => $item['cd_ingresso'],
                'qt_compra' => $item['qtd'],
                'vl_compra' => $valor,
            ];

            $insert_item = montaInsert($data_item,['cd_compra','cd_ingresso','qt_compra','vl_compra']);
            $sql_item = "INSERT INTO comprait ({$insert_item['colunas']}) VALUES ({$insert_item['valores']})";
            $item = mysqli_query($conexao, $sql_item);
        }
    }

    echo 1;

?>