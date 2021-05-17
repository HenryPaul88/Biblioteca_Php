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

<?php

require 'conexion.php';

$id = test_input($_POST["id"]);
$ISBN = test_input($_POST["ISBN"]);
$titulo = test_input($_POST["titulo"]);
$autor = test_input($_POST["autor"]);
$categoria = test_input($_POST["categoria"]);
$editorial = test_input($_POST["editorial"]);
$resumen = test_input($_POST["resumen"]);

$sql = "INSERT INTO clientes (ID,ISBN,titulo,autor,categoria,editorial,resumen)
VALUES ('.$id.','.$ISBN.', '.$titulo.', '.$autor.', '.$categoria.', '.$editorial.', '.$resumen.')";

if ($conn->query($sql) === TRUE) {
  echo "Libro insertado correctamente";
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

$conn->close();
?>