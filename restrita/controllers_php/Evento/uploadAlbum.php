<?php
    if(!empty($_FILES)){  
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