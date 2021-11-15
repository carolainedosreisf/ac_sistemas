<?php
    require '../restrita/conexao.php';

    setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
    date_default_timezone_set( 'America/Sao_Paulo' );
    require('fpdf/alphapdf.php');

    $dados = json_decode(base64_decode($_GET['t']),true);
    $cd_evento = $dados['cd_evento'];
    $cd_compra = isset($dados['cd_compra'])?$dados['cd_compra']:0;

    if($cd_compra){
        $sql = "SELECT 
                DATE_FORMAT(e.dt_evento, '%d/%m/%Y') AS dt_evento_br
                , (SELECT DATE_ADD(e.dt_evento, INTERVAL 1 DAY))  AS dt_geracao_certificado
                , e.ds_evento AS ds_evento
                , e.carga_horaria AS carga
                , cd_ingresso AS nr_lote
                , (SELECT nm_cadastro FROM cadastro AS c WHERE c.cd_cadastro = (SELECT cd_cadastro FROM compra AS co WHERE i.cd_compra = co.cd_compra)) AS nome
                , (SELECT nr_cpf FROM cadastro AS c WHERE c.cd_cadastro = (SELECT cd_cadastro FROM compra AS co WHERE i.cd_compra = co.cd_compra)) AS cpf
            FROM comprait AS i
            INNER JOIN evento AS e ON e.cd_evento = i.cd_evento
            WHERE i.cd_evento = {$cd_evento}
            AND i.cd_compra = {$cd_compra}";
    }else{
        $sql = "SELECT 
                e.cd_evento
                ,DATE_FORMAT(e.dt_evento, '%d/%m/%Y') AS dt_evento_br
                ,(SELECT DATE_ADD(e.dt_evento, INTERVAL 1 DAY))  AS dt_geracao_certificado
                ,e.ds_evento AS ds_evento
                ,e.carga_horaria AS carga
            FROM evento AS e 
            WHERE e.cd_evento = {$cd_evento}";

    }

    $query = mysqli_query($conexao, $sql);
    $item = mysqli_fetch_array($query, MYSQLI_ASSOC);

    $nome     = $cd_compra?$item['nome']:'[AQUI VAI O NOME DO ALUNO]';
    $cpf      = $cd_compra?$item['cpf']:md5($item['cd_evento']);
    $empresa  = "Blablabla Eventos";
    $curso    = $item['ds_evento'];
    $data     = $item['dt_evento_br'];

    $fracao = substr(strpbrk($item['carga'], '.,'), 1);
    
    if((int) $fracao == 0){
        $carga_h =  (int) $item['carga'];
    }else{
        $carga_h  = number_format($item['carga'],1,',','.');
    }


    $texto1 = utf8_decode($empresa);
    $texto2 = utf8_decode("pela participação no ".$curso." \n realizado em ".$data." com carga horária total de ".$carga_h." horas.");
    $texto3 = utf8_decode(utf8_encode(strftime( '%d de %B de %Y', strtotime( $item['dt_geracao_certificado'] ) )));
    $pdf = new AlphaPDF();
    $pdf->AddPage('L');
    $pdf->SetLineWidth(1.5);
    $pdf->Image('certificado.jpg',5,-6,288);
    $pdf->SetAlpha(1);
    $pdf->SetFont('Arial', '', 15);
    $pdf->SetFont('Arial', '', 30); 
    $pdf->SetXY(20,82); 
    $pdf->MultiCell(265, 10, $nome, '', 'C', 0); 
    $pdf->SetFont('Arial', '', 15); 
    $pdf->SetXY(20,108); 
    $pdf->MultiCell(265, 10, $texto2, '', 'C', 0);
    $pdf->SetXY(130,130);
    $pdf->MultiCell(165, 10, "ID: ".($cd_compra?$item['nr_lote']:'[AQUI VAI O ID]'), '', 'L', 0);
    $pdf->SetFont('Arial', '', 15); 
    $pdf->SetXY(52,168);
    $pdf->MultiCell(165, 10, $texto3, '', 'L', 0);
    $pdfdoc = $pdf->Output('', 'S');
    $certificado="arquivos/$cpf.pdf";
    $pdf->Output($certificado,'F'); 
    $pdf->Output();
?>
