<?php
session_start();
if (!isset($_SESSION["usuario"]))
  header("Location: index.php");
else {
  if ($_SESSION["tipo"] != "admin") {
    header("Location: index.php");
  }
}
require 'conexion.php';
$SQLdni = "SELECT dni FROM usuario ";
$result = $conn->query($SQLdni);
if ($result->num_rows > 0) {
  while ($filaDni = $result->fetch_assoc()) {

    $a[] = $filaDni["dni"];
  }
} else {
  echo "0 dni";
}

$conn->close();

$dni = $_REQUEST["dni"];

    $hint = "No existe";
    $new;

    if ($dni !== "") {
      $dni = strtolower($dni);
      $len = strlen($dni);
      foreach ($a as $name) {
        if (stristr($dni, substr($name, 0, $len))) {
          if ($hint === "No existe") {
            
            $new = $name;
            
          } else {
            $hint .= ", $name";
          }
        }
      }
    }
    if (empty($new)){
      echo $hint;
    }else{
      echo "ya existe";
    }
      

?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.6.3/css/all.css" integrity="sha384-UHRtZLI+pbxtHCWp1t77Bi1L4ZtiqrqD80Kn4Z8NTSRyMA2Fd33n5dQ8lWUE00s/" crossorigin="anonymous">
  <link rel="stylesheet" href="estilos.css">
  <title>ALta Usuario</title>
</head>

<body>
  <div class="container">
    <?php

    $usuarioErr = $passErr  = $tipoErr =  "";
    $usuario = $pass = $tipo  = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

      if (empty($_POST["usuario"])) {
        $usuarioErr = "Se requiere el usuario";
      } else {
        $usuario = test_input($_POST["usuario"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $usuario)) {
          $usuarioErr = "usuario: Solo se permiten letras y espacios en blanco";
        }
      }


      if (validar_clave($_POST["contraseña"], $passErr)) {
        $pass = $_POST["contraseña"];
      } else {

        $passErr = "Se requiere la contraseña";
      }


      if (empty($_POST["tipo"])) {
        $tipoErr = "Se requiere el tipo";
      } else {
        $tipo = test_input($_POST["tipo"]);
        // check if name only contains letters and whitespace
        if (!preg_match("/^[a-zA-Z-' ]*$/", $tipo)) {
          $tipoErr = "tipo: Solo se permiten letras y espacios en blanco";
        }
      }
    }


    function test_input($data)
    {
      $data = trim($data);
      $data = stripslashes($data);
      $data = htmlspecialchars($data);
      return $data;
    }

    function validar_dni($dni)
    {
      $letra = substr($dni, -1);
      $numeros = substr($dni, 0, -1);

      if (substr("TRWAGMYFPDXBNJZSQVHLCKE", $numeros % 23, 1) == $letra && strlen($letra) == 1 && strlen($numeros) == 8) {
        return true;
      } else {
        return false;
      }
    }

    function validar_clave($clave, &$error_clave)
    {
      if (strlen($clave) < 6) {
        $error_clave = "La clave debe tener al menos 6 caracteres";
        return false;
      }
      if (strlen($clave) > 16) {
        $error_clave = "La clave no puede tener más de 16 caracteres";
        return false;
      }
      if (!preg_match('`[a-z]`', $clave)) {
        $error_clave = "La clave debe tener al menos una letra minúscula";
        return false;
      }
      if (!preg_match('`[A-Z]`', $clave)) {
        $error_clave = "La clave debe tener al menos una letra mayúscula";
        return false;
      }
      if (!preg_match('`[0-9]`', $clave)) {
        $error_clave = "La clave debe tener al menos un caracter numérico";
        return false;
      }
      $error_clave = "";
      return true;
    }

    if (!empty($_POST["usuario"]) && !empty($_POST["tipo"])) {

      require 'conexion.php';

      $sql = "SELECT max(ID) ID from usuario";
      $result = $conn->query($sql);
      $fila = $result->fetch_assoc();
      $id = $fila["ID"] + 1;


      $dni = test_input($_POST["dni"]);
      $password = md5($pass);
      $stmt = $conn->prepare("INSERT INTO usuario ( ID, usu, pass, tipo, dni ) values(?,?,?,?,?)");
      $stmt->bind_param("issss", $id, $usuario, $password, $tipo, $dni);

      if ($stmt->execute()) {
        echo "Usuario insertado";
        header("Location: listadoUsuario.php");
        $stmt->close();
        $conn->close();
      }
    }
    echo "<span class='error'>" . $usuarioErr . "</span> <br>";
    echo "<span class='error'>" . $passErr . "</span> <br>";
    echo "<span class='error'>" . $tipoErr . "</span> <br>";
    
    ?>
    
  </div>
</body>

</html>