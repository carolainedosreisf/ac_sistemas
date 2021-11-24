<?php
    require '../../conexao.php';
    require '../../funcoes.php';
   
    $sql = "SELECT
                cd_cadastro
                ,nm_cadastro
                ,nr_cpf
                ,nr_rg
                ,nr_contato
                ,nr_telefone
                ,ed_email
                ,DATE_FORMAT(dt_nascto, '%d/%m/%Y') AS dt_nascto
                ,sexo
                ,(SELECT nm_cidade FROM cidade AS c WHERE c.cd_cidade = e.cd_cidade) AS nome_cidade
                ,(SELECT uf_cidade FROM cidade AS c WHERE c.cd_cidade = e.cd_cidade) AS uf_cidade
                ,IFNULL((SELECT count(*) 
					FROM comprait AS b
					WHERE (SELECT cd_cadastro 
                           	FROM compra AS c 
                           	WHERE c.cd_compra =  b.cd_compra) = e.cd_cadastro),0
                 ) AS qtd_eventos   
            FROM cadastro AS e
            ORDER BY 12 DESC, 2 ASC";

    $query = mysqli_query($conexao, $sql);
    $lista = [];
    $i = 0;
    while($item = mysqli_fetch_array($query, MYSQLI_ASSOC)){
        $lista[$i] = $item;
        $lista[$i]['nr_cpf'] = formatar_cpf_cnpj($item['nr_cpf']);
        $lista[$i]['nr_telefone'] = formatar_telefone($item['nr_telefone']);
        $lista[$i]['nr_contato'] = formatar_telefone($item['nr_contato']);
        $contato = "";
        if($item['nr_contato']){
            $contato .=  $item['nr_contato'];
        }

        if($item['nr_telefone']){
            $lista[$i]['br_contato'] = $contato?1:0;
            $contato .=  $item['nr_telefone'];
        }

        $lista[$i]['contato'] = $contato;

        $i++;
    } 
    

    echo json_encode($lista);

?>