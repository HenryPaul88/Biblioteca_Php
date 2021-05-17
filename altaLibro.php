<?php
session_start();
if (!isset($_SESSION["usuario"]))
  header("Location: index.php");
else {
  if ($_SESSION["tipo"] != "admin") {
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
  $ISBNErr = $tituloErr  = $autorErr = $descripcionErr = $editorialErr = $resumenErr = "";
  $ISBN = $titulo = $autor = $descripcion = $editorial = $resumen = "";

  if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (empty($_POST["ISBN"])) {
      $ISBNErr = "Se requiere el ISBN ";
    } else {
      $ISBN  = ($_POST["ISBN"]);
      // check if name only contains letters and whitespace

    }

    if (empty($_POST["titulo"])) {
      $tituloErr = "Se requiere el titulo";
    } else {
      $titulo = test_input($_POST["titulo"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/", $titulo)) {
        $tituloErr = "titulo: Solo se permiten letras y espacios en blanco";
      }
    }

    if (empty($_POST["descripcion"])) {
      $descripcionErr = "Se requiere el descripcion";
    } else {
      $descripcion = ($_POST["descripcion"]);
      // check if name only contains letters and whitespace

    }

    if (empty($_POST["autor"])) {
      $autorErr = "Se requiere el autor";
    } else {
      $autor = test_input($_POST["autor"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/", $autor)) {
        $autorErr = "autor: Solo se permiten letras y espacios en blanco";
      }
    }

    if (empty($_POST["editorial"])) {
      $editorialErr = "Se requiere el editorial";
    } else {
      $editorial = test_input($_POST["editorial"]);
      // check if name only contains letters and whitespace
      if (!preg_match("/^[a-zA-Z-' ]*$/", $editorial)) {
        $editorialErr = "editorial: Solo se permiten letras y espacios en blanco";
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

  require 'conexion.php';

  $sql = "SELECT max(id) id from libros";

  if (!empty($_POST["titulo"]) && !empty($_POST["autor"]) && !empty($_POST["editorial"]) && !empty($_POST["ISBN"])) {
    $result = $conn->query($sql);
    $fila = $result->fetch_assoc();
    $id = $fila["id"] + 1;

    $resumen = $_POST["resumen"];
    $descripcion = $_POST["descripcion"];
    $stmt = $conn->prepare("INSERT INTO libros (ID, ISBN, titulo, autor, categoria, editorial, resumen ) values(?,?,?,?,?,?,?)");
    $stmt->bind_param("issssss", $id, $ISBN, $titulo, $autor, $descripcion, $editorial, $resumen);

    if ($stmt->execute()) {
      echo "Libro insertado";
      header("Location: listadoLibros.php");
      $stmt->close();
      $conn->close();
    }
  }
  echo "<span class='error'>" . $ISBNErr . "</span><br>";
  echo "<span class='error'>" . $tituloErr . "</span><br>";
  echo "<span class='error'>" . $autorErr . "</span><br>";
  echo "<span class='error'>" . $editorialErr . "</span><br>";

  ?>
  <form class="form-inline" action="FormularioAltalibro.php">
    <div class="col-sm-4">
      <div class="input-group mb-3">
        <input type="submit" value="Volver" id="enviar" type="button" class="btn btn-primary">
      </div>
    </div>
  </form>

</body>

</html>