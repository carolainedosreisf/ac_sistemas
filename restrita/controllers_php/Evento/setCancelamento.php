<?php
    require '../../conexao.php';
    require '../../funcoes.php';

    $obj = getPostAngular();
    $cd_evento = $obj['cd_evento'];
    $clientes = [];

    $data = [
        "sn_cancelado" => 'S',
        "motivo_cancelamento" => $obj['motivo_cancelamento']
    ];

    $update = montaUpdate($data);
    $sql_ = "UPDATE evento SET {$update} WHERE cd_evento = {$cd_evento}";
    $query_ = mysqli_query($conexao, $sql_);

    if($query_==1){
        $sql = "SELECT 
                    c.nm_cadastro
                    ,c.ed_email
                    ,(item.qt_compra * item.vl_compra) AS vl_reembolso
                    ,CONCAT(DATE_FORMAT(e.dt_evento, '%d/%m/%Y'),DATE_FORMAT(hr_evento, '%H:%i')) AS dt_evento
                    ,(SELECT ds_evento FROM tipoevento AS c WHERE c.cd_tipoevento = e.cd_tipoevento) AS nome_tipo_evento
                    ,e.ds_evento
                    ,e.motivo_cancelamento
                FROM comprait AS item
                INNER JOIN cadastro AS c ON c.cd_cadastro = (SELECT cd_cadastro FROM compra AS i WHERE i.cd_compra = item.cd_compra)
                INNER JOIN evento as e ON cd_evento = (SELECT cd_evento FROM ingresso AS i WHERE i.cd_ingresso = item.cd_ingresso) 
                WHERE e.cd_evento = {$cd_evento}";

        $query = mysqli_query($conexao, $sql);

        while($item = mysqli_fetch_array($query, MYSQLI_ASSOC)){
            $clientes[] = $item;
        } 
    }
    
    echo $query_;

?>