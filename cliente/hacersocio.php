<?php
include("../conexion.php");
$id_cliente = $_GET['id'];
$sql = "UPDATE clientes SET socio = 1 WHERE id_cliente = $id_cliente";
$resultado=mysqli_query($conexion, $sql);

if($resultado){
    echo "<script language='JavaScript'>
            alert('Se logro hacer socio de manera correcta');
            location.assign('../index1.php');
          </script>";
}else{
    echo "<script language='JavaScript'>
            alert('No se logro hacer socio');
            location.assign('../index1.php');
          </script>";
}
mysqli_close($conexion);

?>