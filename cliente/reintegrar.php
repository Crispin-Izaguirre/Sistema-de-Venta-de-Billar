
<?php

include("../conexion.php");
$id_cliente = $_GET['id'];

$sql = "UPDATE clientes SET eliminado = 0, razon = 0 WHERE id_cliente = $id_cliente";
$resultado=mysqli_query($conexion, $sql);

if($resultado){
    echo "<script language='JavaScript'>
            alert('Se reintegro correctamente a la base de datos');
            location.assign('../index1.php');
          </script>";
}else{
    echo "<script language='JavaScript'>
            alert('No se reintegro correctamente a la base de datos');
            location.assign('../index1.php');
          </script>";
}
mysqli_close($conexion);
?>
