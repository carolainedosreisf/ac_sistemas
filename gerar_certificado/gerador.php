<?php
    require '../restrita/conexao.php';
    require '../restrita/funcoes.php';

    setlocale( LC_ALL, 'pt_BR', 'pt_BR.iso-8859-1', 'pt_BR.utf-8', 'portuguese' );
    date_default_timezone_set( 'America/Sao_Paulo' );
    require('fpdf/alphapdf.php');

    $dados = json_decode(base64_decode($_GET['t']),true);
    $cd_evento = $dados['cd_evento'];
    $cd_cadastro = isset($dados['cd_cadastro'])?$dados['cd_cadastro']:0;
    $cd_compra = isset($dados['cd_compra'])?$dados['cd_compra']:0;

    if($cd_cadastro){
        $sql = "SELECT 
                DATE_FORMAT(a.dt_realizado, '%d/%m/%Y') AS dt_evento_br
                ,DATE_FORMAT(a.dt_realizado, '%Y-%m-%d') AS dt_evento
                ,DATE_FORMAT(a.dt_finalizado, '%Y-%m-%d')  AS dt_geracao_certificado
                , a.ds_ceritificado AS ds_evento
                , a.carga_horaria AS carga
                , a.hash_certificado
                , b.nm_cadastro AS nome
            FROM certificado AS a
            INNER JOIN cadastro AS b ON a.cd_cadastro = b.cd_cadastro
            WHERE a.cd_evento = {$cd_evento}
            AND a.cd_cadastro = {$cd_cadastro}";
    }else{
        $sql = "SELECT 
                e.cd_evento
                ,DATE_FORMAT(e.dt_evento, '%d/%m/%Y') AS dt_evento_br
                ,DATE_FORMAT(e.dt_evento, '%Y-%m-%d') AS dt_evento
                ,DATE_FORMAT(NOW(), '%Y-%m-%d') AS dt_geracao_certificado
                ,e.ds_evento AS ds_evento
                ,e.carga_horaria AS carga
            FROM evento AS e 
            WHERE e.cd_evento = {$cd_evento}";
    }

    $query = mysqli_query($conexao, $sql);
    $item = mysqli_fetch_array($query, MYSQLI_ASSOC);

    $qtd =  mysqli_num_rows($query);

    if($qtd <= 0){
        $sql = "SELECT 
                    DATE_FORMAT(e.dt_evento, '%d/%m/%Y') AS dt_evento_br
                    ,DATE_FORMAT(e.dt_evento, '%Y-%m-%d') AS dt_evento
                    ,DATE_FORMAT(NOW(), '%Y-%m-%d')   AS dt_geracao_certificado
                    , e.ds_evento AS ds_evento
                    , e.carga_horaria AS carga
                    , cd_ingresso AS hash_certificado
                    , (SELECT nm_cadastro FROM cadastro AS c WHERE c.cd_cadastro = {$cd_cadastro}) AS nome
                FROM comprait AS i
                INNER JOIN evento AS e ON e.cd_evento = i.cd_evento
                WHERE i.cd_evento = {$cd_evento}
                AND i.cd_compra = {$cd_compra}";
        $query = mysqli_query($conexao, $sql);
        $item = mysqli_fetch_array($query, MYSQLI_ASSOC);
        $data_insert = [
            'cd_evento'=>$cd_evento,
            'cd_cadastro'=>$cd_cadastro,
            'hash_certificado'=>$item['hash_certificado'],
            'dt_realizado'=>$item['dt_evento'],
            'dt_finalizado'=>$item['dt_geracao_certificado'],
            'carga_horaria'=>$item['carga'],
            'ds_ceritificado'=>$item['ds_evento'],
        ];

        $insert = montaInsert($data_insert);
        $sql_insert = "INSERT INTO certificado ({$insert['colunas']}) VALUES ({$insert['valores']})";
        $query_insert = mysqli_query($conexao, $sql_insert);
    }
    
    $nome     = $cd_cadastro?$item['nome']:'[AQUI VAI O NOME DO ALUNO]';
    $nome_certificado_      = $cd_cadastro?md5($cd_cadastro."_".$cd_evento):md5($item['cd_evento']);
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
    $pdf->MultiCell(165, 10, "ID: ".($cd_cadastro?$item['hash_certificado']:'[AQUI VAI O ID]'), '', 'L', 0);
    $pdf->SetFont('Arial', '', 15); 
    $pdf->SetXY(52,168);
    $pdf->MultiCell(165, 10, $texto3, '', 'L', 0);
    $pdfdoc = $pdf->Output('', 'S');
    $certificado="arquivos/{$nome_certificado_}.pdf";
    $pdf->Output($certificado,'F'); 
    $pdf->Output();
?>
