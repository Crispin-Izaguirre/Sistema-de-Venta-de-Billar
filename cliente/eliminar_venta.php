
<?php

include("../conexion.php");
$id_cliente = $_GET['id'];

$sql = "UPDATE ventas SET eliminado = 1 WHERE id_venta = $id_cliente";
$resultado=mysqli_query($conexion, $sql);

if($resultado){
    echo "<script language='JavaScript'>
            location.assign('historial.php');
          </script>";
}else{
    echo "<script language='JavaScript'>
            location.assign('historial.php');
          </script>";
}
mysqli_close($conexion);
?>