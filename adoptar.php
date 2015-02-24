<?php  
//conectamos con la base de datos 

$con = mysqli_connect("mysql.hostinger.es", "u997080380_drf", "sambucetti", "u997080380_adopt"); 


//Definimos variables de consulta

 $postal = $_POST['postal'];
  
 $hld = $_POST['hld'];
  
 $animal = $_POST['animal']; 

//establecemos condiciones de paginacion 
$registros = 1; 

@$pagina = $_GET ['pagina']; 

if (!isset($pagina)) 
{ 
$pagina = 1; 
$inicio = 0; 
} 
else 
{ 
$inicio = ($pagina-1) * $registros; 
} 

//realizamos la busqueda en la base de datos 
$sql = " SELECT FROM adopt(foto, email, telf, postal, nomcont, edad, nomanimal, funciones, hld, neces, animal) WHERE postal LIKE  '$postal' WHERE hld <='$hld WHERE animal LIKE  '$animal' "; 
$cad = mysqli_query($con,$sql); 

//calculamos las paginas a mostrar 

$contar = "SELECT (foto, email, telf, postal, nomcont, edad, nomanimal, funciones, hld, neces, animal) FROM adopt"; 
$contarok = mysqli_query($con,$contar); 
$total_registros = mysqli_num_rows($contarok); 
$total_paginas = ($total_registros / $registros); 

//imprimiendo los resultados 


while ($array = mysqli_fetch_array($cad)) 

/* ==============================================*/ 


?> 
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0">
  <title>dog</title>
  <link rel="stylesheet" href="css/standardize.css">
  <link rel="stylesheet" href="css/cats-grid.css">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body class="body page-cats clearfix">
  <p onClick="window.location='select.html';" class="text text-2">aDoptia</p>
  <div class="container container-1 clearfix">
    <div class="container container-2 clearfix">
      <p class="text text-4">Nombre:</p>
      <input id="nomanimal" value="<?php echo $array['nomanimal'];?>" class="_input _input-2 js-nomanimal" name="nomanimal" type="text">
      <p class="text text-6">Edad:</p>
      <input id="edad" value="<?php echo $array['edad'];?>"class="_input _input-4 js-edad" name="edad" type="text">
      <p class="text text-8">Raza:</p>
      <input id="animal" value="<?php echo $array['animal'];?>"class="_input _input-6 js-animal" name="animal" type="text">
      <p class="text text-10">HLD:</p>
      <input id="hld" value="<?php echo $array['hld'];?>"class="_input _input-8 js-hld" name="hld" type="text">
      <p class="text text-12">Funciones:</p>
      <input id="funciones" value="<?php echo $array['funciones'];?>"class="_input _input-10 js-funciones" name="funciones" type="text">
      <p class="text text-14">Nece.Esp:</p>
      <input id="neces" value="<?php echo $array['neces'];?>"class="_input _input-12 js-neces" name="neces" type="text">
      <p class="text text-16">Contacto:</p>
      <input id="nomcont" value="<?php echo $array['nomcont'];?>"class="_input _input-14 js-nomcont" name="nomcont" type="text">
      <p class="text text-19">Email:</p>
      <input id="email" value="<?php echo $array['email'];?>"class="_input _input-16 js-email" name="email" type="text">
      <p class="text text-22">Telefono:</p>
      <input id="telf" value="<?php echo $array['telf'];?>"class="_input _input-18 js-telf" name="telf" type="text">
    </div>
    <input id="foto" value="<?php echo $array['foto'];?>" class="_input _input-20 js-foto" name="foto" type="text">
  </div>
  <button onClick="window.location='tel:$telf';" id="adoptar" class="_button-1 js-adoptar">Adoptar</button>
  <button onClick="window.location='adoptar.php?pagina=".($pagina-1)."';" id="sigu" class="_button-4 js-sigu">No Adoptar</button>

  <script src="js/jquery-min.js"></script>
</body>
</html>
  