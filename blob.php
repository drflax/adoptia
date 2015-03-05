<?php
// Verificamos que el formulario no ha sido enviado aun

  // Nivel de errores
  
  error_reporting(E_ALL);
  ini_set('display_errors', true);
  
  //Definimos variables post
 
  $email = $_POST['email'];
  $telf = $_POST['telf'];
  $postal = $_POST['postal'];
  $nomcont = $_POST['nomcont'];
  $edad = $_POST['edad'];
  $nomanimal = $_POST['nomanimal'];
  $funciones = $_POST['funciones'];
  $hld = $_POST['hld'];
  $neces = $_POST['neces'];
  $animal = $_POST['animal'];
  $pass = $_POST['pass']; 
   
  // Mime types permitidos
  $mimetypes = array("image/jpeg", "image/pjpeg", "image/gif", "image/png");
 
  // Variables de la foto
  $type = $_FILES['foto']['type'];
  $size = $_FILES['foto']['size'];
  
  // Verificamos si el archivo es una imagen válida
  if(in_array($type, $mimetypes)){
	  $ruta = "tmp/" . $_FILES ['foto']['name'];
	  if (!file_exists($ruta)){
			//aqui movemos el archivo desde la ruta temporal a nuestra ruta
			//usamos la variable $resultado para almacenar el resultado del proceso de mover el archivo
			//almacenara true o false
			$resultado = @move_uploaded_file($_FILES["foto"]["tmp_name"], $ruta);
			if ($resultado){
				$tfoto = $ruta ;
			}
		}else {
			echo $_FILES['foto']['name'] . ", este archivo existe";
        }
    }else {
		echo "archivo no permitido, es tipo de archivo prohibido";
	}     
 
  
  
 
if ($_POST['email']!= "" && $_POST['telf'] !="" && $_POST['postal'] !="" && $_POST['nomanimal'] !="" && $_POST['edad'] !="")
{
  $link = mysqli_connect('mysql.hostinger.es', 'u997080380_drf', 'sambucetti', 'u997080380_adopt')or die(mysqli_error($link));
  $sql = "INSERT INTO `adopt`(foto, mime, email, telf, postal, nomcont, edad, nomanimal, funciones, hld, neces, animal, pass) VALUES('$tfoto', '$type', '$email', '$telf', '$postal', '$nomcont', '$edad', '$nomanimal', '$funciones', '$hld', '$neces', '$animal', '$pass')";
  mysqli_query($link, $sql) or die(mysqli_error($sql));
  echo "Datos Subidos";
  header('Location: /select.html');
}
else
{
	header('Location:donar.html');
}
  // Guardamos todo en la base de datos
	  
  
  exit();

?>