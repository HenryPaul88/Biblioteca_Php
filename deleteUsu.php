<?php
session_start();
if(!isset($_SESSION["usuario"]))
    header("Location: index.php");
else{
    if($_SESSION["tipo"]!= "admin"){
        header("Location: index.php");
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

  <title>Document</title>
</head>

<body>
  <?php
  $id = $_GET["id"];

  require 'conexion.php';

  $sql = "DELETE FROM usuario WHERE ID=" . $id;


  if ($conn->query($sql) === TRUE) {
    echo "Usuario borrado con exito!";
    header("Location: listadoUsuario.php");
    $conn->close();
  } else {
    echo "Error deleting record: " . $conn->error;
  }
  
  ?>


</body>

</html>