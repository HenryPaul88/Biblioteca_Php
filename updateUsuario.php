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
$id = $_GET["id"];

require 'conexion.php';

$stmt = $conn->prepare("UPDATE usuario SET usu=?,pass=?,tipo=?,dni=? where ID=" . $id);
$stmt->bind_param("ssss", $_POST["usuario"], $_POST["contraseña"], $_POST["tipo"],$_POST["dni"]);
$stmt->execute();
header("Location: listadoUsuario.php");
$conn->close();
?>
