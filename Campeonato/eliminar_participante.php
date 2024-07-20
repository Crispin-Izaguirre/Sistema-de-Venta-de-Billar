<?php

include("../conexion.php");
$id_cliente = $_GET['id'];

$sql = "UPDATE participante SET eliminado = 1 WHERE id_participante = $id_cliente";
$resultado=mysqli_query($conexion, $sql);

if($resultado){
    echo "<script language='JavaScript'>
            location.assign('visualizar_participante.php');
          </script>";
}else{
    echo "<script language='JavaScript'>
            location.assign('visualizar_participante.php');
          </script>";
}
mysqli_close($conexion);
?>
