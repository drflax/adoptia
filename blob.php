<?php
// Verificamos que el formulario no ha sido enviado aun
$postback = (isset($_POST["enviar"]));
if ($postback) {  
  // Nivel de errores
  error_reporting(E_ALL);
  
 
   
  // Mime types permitidos
  $mimetypes = array("image/jpeg", "image/pjpeg", "image/gif", "image/png");
 
  // Variables de la foto
  $name = $_FILES['foto']['name'];
  $type = $_FILES['foto']['type'];
  $tmp_name = $_FILES['foto']['tmp_name'];
  $size = $_FILES['foto']['size'];
  
  // Verificamos si el archivo es una imagen válida
  if(!in_array($type, $mimetypes))
    die("El archivo que subiste no es una imagen válida");
 
 
 
  // Extrae los contenidos de las fotos
   //contenido de la foto original
  $fp = fopen($tmp_name, "rb");
  $tfoto = fread($fp, filesize($tmp_name));
  $tfoto = addslashes($tfoto);
  fclose($fp);
  
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
 

  // Guardamos todo en la base de datos
	  
  $link = mysqli_connect("mysql.hostinger.es", "u997080380_drf", "sambucetti", "u997080380_adopt");
  $sql = "INSERT INTO adopt(foto, mime, email, telf, postal, nomcont, edad, nomanimal, funciones, hld, neces, animal, pass) VALUES('$tfoto', '$type', '$email', '$telf', '$postal', '$nomcont', '$edad', '$nomanimal', '$funciones', '$hld', '$neces', '$animal', '$pass')";
  mysqli_query($link, $sql) or die(mysqli_error($link));
  echo "Datos Subidos";
  exit();
}
?>
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0">
  <title>donar</title>
  <link rel="stylesheet" href="css/standardize.css">
  <link rel="stylesheet" href="css/donar-grid.css">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body class="body page-donar clearfix">
  <a href="select.html" class="text title">aDoptia</a>
  <form id="donar" class="donar clearfix js-donar" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
    <label class="radio-label radio-label-1 clearfix">
      <span class="point-text">Perr@</span>
      <input id="animal" class="radio js-animal" name="animal" value="perro" type="radio">
    </label>
    <label class="radio-label radio-label-2 clearfix">
      <span class="point-text">Gat@</span>
      <input id="animal" class="radio js-animal" name="animal" value="gato" type="radio">
    </label>
    <p class="text noma">Nombre :</p>
    <input id="nomanimal" class="_input _input-1 js-nomanimal" name="nomanimal" type="text">
    <p class="text edad">Edad:</p>
    <input id="edad" class="_input _input-3 js-edad" name="edad" type="number">
    <p class="text nomc">Contacto:</p>
    <input id="nomcont" class="_input _input-5 js-nomcont" name="nomcont" type="text">
    <p class="text telf text-9">Telf.:</p>
    <input id="telf" class="_input _input-7 js-telf" name="telf" type="text">
    <p class="text telf text-11">Email:</p>
    <input id="email" class="_input _input-9 js-email" name="email" type="email">
    <p class="text telf text-13">Contraseña:</p>
    <input id="pass" class="_input _input-11 js-pass" name="email" type="text">
    <p class="text post">Codigo Postal:</p>
    <input id="postal" class="_input _input-13 js-postal" name="postal" type="text">
    <p class="text hld">Horas Libres Diarias:</p>
    <input id="hld" class="_input _input-15 js-hld" name="hld" type="number">
    <p class="text nec">Necesidades:</p>
    <input id="neces" class="_input _input-17 js-neces" name="neces" type="text">
    <p class="text func">Funciones :</p>
    <input id="funciones" class="_input _input-19 js-funciones" name="funciones" type="text">
    <input id="foto" class="_input _input-21 js-foto" name="foto" placeholder="foto" type="file">
    <button id="enviar" class="_button-3 js-enviar" type="submit">Donar</button>
    <button id="limpiar" class="_button-6 js-enviar" type="reset">Limpiar</button>
  </form>

  <script src="js/jquery-min.js"></script>
</body>
</html>