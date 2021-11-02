<?php
    function montaInsert($obj, $semAspa = [])
    {
        $colunas = "";
        $valores = "";
        foreach ($obj as $key => $value) {
            if($value){
                $colunas .= $key.", ";

                if(array_search($key,$semAspa) === false){
                    $valores .= "'".$value."', ";
                }else{
                    $valores .= $value.", ";
                }
            }
        }

        $colunas = substr($colunas,0, strlen($colunas) -2);
        $valores = substr($valores,0, strlen($valores) -2);
        
        return ['colunas'=>$colunas,'valores'=>$valores];
    }

    function formataData($data,$tipo,$exibir_hora=0)
    {

        $formato = 'd/m/Y';
        $DataEspecifica = $data;
        $DataEspecifica = DateTime::createFromFormat($formato, $DataEspecifica);

        if($tipo==1){
            $retorno = $DataEspecifica->format('Y-m-d');
        }

        return $retorno;
    }

    function getPostAngular()
    {
        return json_decode(file_get_contents('php://input'),true);
    }

    function serializaDados($lista,$tipo=1)
    {
        if($tipo == 1){
            foreach ($lista as $key => $value) {
                foreach ($value as $k => $v) {
                    $lista[$key][$k] = utf8_encode($v);
                }
            }
        }else{
            foreach ($lista as $key => $value) {
                $lista[$key] = utf8_encode($value);
            } 
        }
        

        return $lista;
    }

    function montaUpdate($obj,$semAspa = [])
    {
        //Tipo 1 é lista
        //Tipos 2 é objeto
        
        $txt = "";
        foreach ($obj as $key => $value) {
            if($value){
                if(array_search($key,$semAspa) === false){
                    $txt .= $key." = '".$value."', ";
                }else{
                    $txt .= $key." = ".$value.", ";
                }
            }else{
                $txt .= $key." = null, ";
            }
        }
        return substr($txt,0, strlen($txt) -2);
    }

    function formatar_cpf_cnpj($doc) 
    {
 
        $doc = preg_replace("/[^0-9]/", "", $doc);
        $qtd = strlen($doc);
 
        if($qtd >= 11) {
 
            if($qtd === 11 ) {
 
                $docFormatado = substr($doc, 0, 3) . '.' .
                                substr($doc, 3, 3) . '.' .
                                substr($doc, 6, 3) . '.' .
                                substr($doc, 9, 2);
            } else {
                $docFormatado = substr($doc, 0, 2) . '.' .
                                substr($doc, 2, 3) . '.' .
                                substr($doc, 5, 3) . '/' .
                                substr($doc, 8, 4) . '-' .
                                substr($doc, -2);
            }
 
            return $docFormatado;
 
        } else {
            return $doc;
        }
    }

    function formatar_telefone($doc) 
    {
 
        $qtd = strlen($doc);
        if($qtd == 10 || $qtd == 11) {
 
            if($qtd === 10 ) {
 
                $docFormatado = '('.substr($doc, 0, 2) . ') ' .
                                substr($doc, 2, 4) . '-' .
                                substr($doc, 6, 4);
            } else {
                $docFormatado = '('.substr($doc, 0, 2) . ')' .
                                substr($doc, 2, 5) . '-' .
                                substr($doc, 7, 4);
            }
 
            return $docFormatado;
 
        } else {
            return $doc;
        }
    }


?>