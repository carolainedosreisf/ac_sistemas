<?php  
function conectar(){
	$servidor = "localhost";
	$usuario = "root";
	$senha= "";
	$bd = "angular_tu";
	
	$con = new mysqli($servidor, $usuario, $senha, $bd);
	return $con;
	
}

$conexao = conectar();

 if(!empty($_FILES))  
 {  
      $path = 'uploads/' . $_FILES['file']['name'];  
      if(move_uploaded_file($_FILES['file']['tmp_name'], $path))  
      {  
           $insertQuery = "INSERT INTO angularjs_file_upload(name) VALUES ('".$_FILES['file']['name']."')";  
           if(mysqli_query($conexao, $insertQuery))  
           {  
                echo 'File Uploaded Successfully';  
           }  
           else  
           {  
                echo 'File Uploaded But Not Saved';  
           }  
      }  
 }  
 else  
 {  
      echo 'Error';  
 }  
 ?>  