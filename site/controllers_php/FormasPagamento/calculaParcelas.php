<?php
    require '../../funcoes.php';

    $qtd = $_GET['qtd'];
    $valor = $_GET['valor'];
    $parcelas = [];
    $total = 0;

    $vl_parcela =  floorp(($valor/$qtd),2);
    $divergencia = number_format(($valor - ($vl_parcela*$qtd)),2);

    for ($i=0; $i <$qtd ; $i++) { 
       $valor_ = $i==0?($vl_parcela+$divergencia):$vl_parcela;

       $parcelas[$i]['nr_parcela'] =  $i+1;
       $parcelas[$i]['vl_parcela'] =  $valor_ ;

       $total += $valor_ ;
    }

    echo json_encode($parcelas);
?>