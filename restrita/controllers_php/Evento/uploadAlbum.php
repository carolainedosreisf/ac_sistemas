<?php
    if(!empty($_FILES)){  
        $tipo = substr($_FILES['file']['name'],-4,4);
        $tipo2 = substr($_FILES['file']['name'],-5,5);
        $tipos = ['.PNG','.png','.jpeg','.jpg','.JPEG','.JPG'];
        if(array_search($tipo,$tipos)===false && array_search($tipo2,$tipos)===false){
            echo json_encode(['erro_tipo'=>1]);
            exit;
        }
        $nome_imagem = (rand() * rand()).date("YmdHi").substr($_FILES['file']['name'],-4,4);
        $path = '../../../arquivos/uploads_evento_albuns/'. $nome_imagem;  

        if(move_uploaded_file($_FILES['file']['tmp_name'], $path)){  
            echo "arquivos/uploads_evento_albuns/{$nome_imagem}";
        } else{
            echo 0;
        }
    }  
    else{  
        echo 0;  
    }  

?>