<?php 
require "PDO_Pagination.php";

/* Config Connection */
$root = 'u997080380_drf';
$password = 'sambucetti';
$host = 'mysql.hostinger.es';
$dbname = 'u997080380_adopt';

$connection = new PDO("mysql:host=$host;dbname=$dbname;", $root, $password);
$pagination = new PDO_Pagination($connection);


$postal = $_REQUEST['postal'];
$hld = $_REQUEST['hld']; 
$animal = $_REQUEST['animal'];

$pagination->param = "&postal=$postal&hld=$hld&animal=$animal";
$pagination->rowCount("SELECT  * FROM `adopt` WHERE `postal` LIKE '$postal' AND `hld`<= '$hld' AND `animal` LIKE '$animal'");
$pagination->config(2, 1);
$sql = "SELECT  `animal`, `email`, `telf`, `postal`, `nomcont`, `edad`, `funciones`, `hld`, `neces`, `idfoto`, `foto`, `nomanimal`, `pass` FROM `adopt` WHERE `postal` LIKE '$postal' AND `hld`<= '$hld' AND `animal` LIKE '$animal' LIMIT $pagination->start_row, $pagination->max_rows";
$query = $connection->prepare($sql);
$query->execute();
$model = array();
while($model = $query->fetch())
{  
 $nomanimal = $model['nomanimal'];
 $edad = $model['edad'];
 $animal = $model['animal'];
 $hld = $model['hld'];
 $funciones = $model['funciones'];
 $neces = $model['neces'];
 $nomcont = $model['nomcont'];
 $email = $model['email'];
 $foto = $model['foto'];
 $telf = $model['telf'];
}

?> 
<!doctype html>
<html>
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="initial-scale=1.0">
  <title>aDoptar</title>
  <link rel="stylesheet" href="css/standardize.css">
  <link rel="stylesheet" href="css/cats-grid.css">
  <link rel="stylesheet" href="css/styles.css">
</head>
<body class="body page-cats clearfix">
  <p onClick="window.location='select.html';" class="text text-2">aDoptia</p>
  <div class="container container-1 clearfix">
     <div class="container container-2 clearfix">
          <p class="text text-4">Nombre:</p>
          <input id="nomanimal" read_only="read_only" value=" <?php echo $nomanimal; ?> " class="_input _input-2 js-nomanimal" name="nomanimal" type="text">
          <p class="text text-6">Edad:</p>
          <input id="edad" read_only="read_only" value="<?php echo $edad; ?>" class="_input _input-4 js-edad" name="edad" type="text">
          <p class="text text-8">Raza:</p>
          <input id="animal" read_only="read_only" value="<?php echo $animal; ?>" class="_input _input-6 js-animal" name="animal" type="text">
          <p class="text text-10">HLD:</p>
          <input id="hld" read_only="read_only" value="<?php echo $hld; ?>" class="_input _input-8 js-hld" name="hld" type="text">
          <p class="text text-12">Caracter:</p>
          <input id="funciones" read_only="read_only" value="<?php echo $funciones; ?>" class="_input _input-10 js-funciones" name="funciones" type="text">
          <p class="text text-14">Nece.Esp:</p>
          <input id="neces" read_only="read_only" value="<?php echo $neces; ?>" class="_input _input-12 js-neces" name="neces" type="text">
          <p class="text text-16">Contacto:</p>
          <input id="nomcont" read_only="read_only" value="<?php echo $nomcont; ?>" class="_input _input-14 js-nomcont" name="nomcont" type="text"> 
          <p class="text text-19">Email:</p>
          <input id="email" read_only="read_only" value="<?php echo $email; ?>" class="_input _input-16 js-email" name="email" type="text">
          <p class="text text-22">Telefono:</p>
          <input id="telf" read_only="read_only" value="<?php echo $telf;  ?>" class="_input _input-18 js-telf" name="telf" type="text">
      </div>
          <img src="<?php echo $foto;  ?>" class="_input _input-20 js-foto" name="foto"  >
  </div>
          <button onClick="window.location='tel:<?php echo $telf; ?>';" id="adoptar" class="_button-1 js-adoptar">Adoptar</button>
                  

  <script src="js/jquery-min.js"></script>
  <style>
            /* CSS */
            .btn
            {
              text-decoration: none;
              color: #FFFFFF;
              padding-left: 10px;
              padding-right: 10px;
              margin-left: 1px;
              margin-right: 1px;
              border-radius: 3px;
              background: #7F83AD;
            }
            
            .btn:hover
            {
                background: #474C80;
            }
            .active
            {
                background: #E7814A;
            }
            /* CSS */
  </style>
</body>
</html>
<?php
$pagination->pages("btn");
?>