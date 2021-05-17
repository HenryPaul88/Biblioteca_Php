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

$stmt = $conn->prepare("UPDATE libros SET ISBN=?,titulo=?,autor=?,categoria=?,editorial=?,resumen=? where id=" . $id);
$stmt->bind_param("ssssss", $_POST["ISBN"], $_POST["titulo"], $_POST["autor"],$_POST["descripcion"], $_POST["editorial"], $_POST["resumen"]);
$stmt->execute();
header("Location: listadoLibros.php");
$conn->close();
?>
