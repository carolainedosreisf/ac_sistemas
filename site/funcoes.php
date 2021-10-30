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

    function serializaDados($lista)
    {
        foreach ($lista as $key => $value) {
            foreach ($value as $k => $v) {
                $lista[$key][$k] = utf8_encode($v);
            }
        }

        return $lista;
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

    function floorp($val, $precision)
    {
        $mult = pow(10, $precision); // Can be cached in lookup table        
        return floor($val * $mult) / $mult;
    }


?>