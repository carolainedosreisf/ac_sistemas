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

        $DataAtual = new DateTime();
        $DataEspecifica = new DateTime($data);

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


?>