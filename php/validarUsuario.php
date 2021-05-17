<?php
session_start();

if(!isset($_SESSION["usuario"]))
    header("Location: index.php");
else{
    if($_SESSION["tipo"]!= "admin"){
        header("Location: index.php");
    }
}

$usuario = $_POST["usuario"];
$pass = $_POST["contraseña"];
$pass = md5($pass);
require 'conexion.php';

$stmt = $conn->prepare("SELECT ID, tipo from usuario where usu=? and pass=?");
$stmt->bind_param("is", $usuario, $pass);
$stmt->execute();
$fila = $stmt->get_result()->fetch_assoc();

if ($fila) {
    echo "Usuario contraseña correctas";

    $_SESSION["usuario"] = $usuario;
    $_SESSION["tipo"]= $fila["tipo"];
      
    
    header("Location: listadoLibros.php");
}else{
    echo "erro en login";
    header("Location: index.php");
}
$stmt -> close();
$conn -> close();

?>



