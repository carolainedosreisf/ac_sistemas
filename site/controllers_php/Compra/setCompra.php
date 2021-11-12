<?php
    require '../../conexao.php';
    require '../../funcoes.php';

    $dados = getPostAngular();
    $data = $dados['data'];
    $total = $dados['total'];
    $carrinho = $dados['carrinho'];
    $cd_cadastro = $dados['usuario']['cd_cadastro'];

    $codigos = array_column($carrinho,'cd_evento');
    $in = implode(',',$codigos);

    $sql = "SELECT 
                e.cd_evento
                ,e.dt_evento
                ,e.hr_evento
                ,IFNULL(e.sn_cancelado,'N') AS sn_cancelado
                ,IF ((IFNULL((SELECT SUM(qt_compra) 
                            FROM comprait 
                            WHERE comprait.cd_evento = e.cd_evento)
                        ,0) >= e.nr_lotacao),1,0) AS lotado
                ,nr_lotacao - (IFNULL((SELECT SUM(qt_compra) 
                            FROM comprait 
                            WHERE comprait.cd_evento = e.cd_evento
                        )
                        ,0)) AS qtd_disponivel
            FROM evento AS e
            WHERE IFNULL(e.sn_cancelado,'N') = 'N'
            and dt_evento > NOW()
            AND IF ((IFNULL((SELECT SUM(qt_compra) 
                            FROM comprait 
                            WHERE comprait.cd_evento = e.cd_evento
                        )
                        ,0) >= e.nr_lotacao),1,0) = 0
            AND cd_evento in({$in})
            ORDER BY e.dt_evento DESC";

    $query = mysqli_query($conexao, $sql);
    $qtd_validos =  mysqli_num_rows($query);
    while($item = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $lista[] = $item;
    }
    
  
    if(count($carrinho) != $qtd_validos){
        echo 2;
        exit;
    }
    $error = [];
    $i = 0;
    foreach ($carrinho as $key => $value) {
        $index =  array_search($value['cd_evento'],array_column($lista,'cd_evento'));
        $qtd_disp = $lista[$index]['qtd_disponivel'];
        $qtd_cart = $value['qtd'];
        if($qtd_disp < $qtd_cart){
            $error[$i]['ds_evento'] = $value['ds_evento'];
            $error[$i]['qtd_disp'] = $qtd_disp;
            $error[$i]['qtd_cart'] = $qtd_cart;
            $i++;
        }
    }

    if(count($error) > 0){
        echo json_encode(['error'=>$error]);
        exit;
    }
    
    $data_compra = [
        'cd_cadastro' => $cd_cadastro,
        'cd_fpagto' => $data['cd_fpagto'],
        'vl_total' => $total,
        'dt_compra' => date("Y-m-d H:i:s")
    ];

    $insert_compra = montaInsert($data_compra,['cd_cadastro','cd_fpagto','vl_total']);
    $sql_compra = "INSERT INTO compra ({$insert_compra['colunas']}) VALUES ({$insert_compra['valores']})";
    $compra = mysqli_query($conexao, $sql_compra);
    $cd_cadastro = mysqli_insert_id($conexao);

    if($compra==1){
        
        foreach ($carrinho as $key => $item) {
            $valor = $item['cd_promocao']>0?$item['vl_promocao']:$item['vl_venda'];
            
            $data_item = [
                'cd_compra' => $cd_cadastro,
                'cd_evento' => $item['cd_evento'],
                'qt_compra' => $item['qtd'],
                'vl_compra' => $valor,
            ];

            $insert_item = montaInsert($data_item,['cd_compra','cd_evento','qt_compra','vl_compra']);
            $sql_item = "INSERT INTO comprait ({$insert_item['colunas']}) VALUES ({$insert_item['valores']})";
            $item_ = mysqli_query($conexao, $sql_item);

            if($item_){
                for ($i=1; $i <= $item['qtd']; $i++) { 
                    $data_ingresso = [
                        'cd_compra' => $cd_cadastro,
                        'cd_evento' => $item['cd_evento'],
                        'seq' => $i,
                        'nr_lote' => bin2hex(random_bytes('5')),
                    ];

                    $insert_ingresso = montaInsert($data_ingresso,['cd_compra','cd_evento','seq']);
                    $sql_ingresso = "INSERT INTO ingresso ({$insert_ingresso['colunas']}) VALUES ({$insert_ingresso['valores']})";
                    mysqli_query($conexao, $sql_ingresso);
               }
                
            }
           
        }
    }

    echo 1;

?>