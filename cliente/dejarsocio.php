<?php
include("../conexion.php");
$id_cliente = $_GET['id'];
$sql = "UPDATE clientes SET socio = 0 WHERE id_cliente = $id_cliente";
$resultado=mysqli_query($conexion, $sql);

if($resultado){
    echo "<script language='JavaScript'>
            alert('El cliente dejo de ser socio');
            location.assign('../index1.php');
          </script>";
}else{
    echo "<script language='JavaScript'>
            alert('No se logro ejecutar');
            location.assign('../index1.php');
          </script>";
}
mysqli_close($conexion);

?>