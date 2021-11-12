<?php
    if(!empty($_FILES)){  
        $tipo = substr($_FILES['file']['name'],-4,4);
        $tipos = ['.PNG','.png','.jpeg','.jpg','.JPEG','.JPG'];
        if(array_search($tipo,$tipos)===false){
            echo json_encode(['erro_tipo'=>1]);
            exit;
        }
        $nome_imagem = (rand() * rand()).date("YmdHi")."_temp".substr($_FILES['file']['name'],-4,4);
        $path = '../../../arquivos/uploads_evento/'. $nome_imagem;  
        
        if(move_uploaded_file($_FILES['file']['tmp_name'], $path)){  
            include("resize-class.php");
            $resizeObj = new resize($path);

            $data = getimagesize($path);
            $width = $data[0];
            $height = $data[1];

            $maior_lado = $width > $height?$width:$height;
            $diferenca = $height - $width;
            $diferenca = $diferenca<0?($diferenca*-1):$diferenca;

            $corte = $maior_lado - $diferenca;
            $resizeObj -> resizeImage($corte, $corte, 'crop');

            $nome_imagem_ = (rand() * rand()).date("YmdHi").substr($_FILES['file']['name'],-4,4);
            $path_ = '../../../arquivos/uploads_evento/'. $nome_imagem_;  
            $resizeObj -> saveImage($path_, 100);

            if($resizeObj){
                unlink($path);
                echo "arquivos/uploads_evento/{$nome_imagem_}";
            }else{
                echo 0;
            }

        } else{
            echo 0;
        }
    }  
    else{  
        echo 0;  
    }  

?>