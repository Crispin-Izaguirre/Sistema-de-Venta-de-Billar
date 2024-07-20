
<?php

include("../conexion.php");
$id_cliente = $_GET['id'];

$sql = "UPDATE campeonato SET eliminado = 1 WHERE id_campeonato = $id_cliente";
$resultado=mysqli_query($conexion, $sql);

if($resultado){
    echo "<script language='JavaScript'>
            location.assign('../Campeonato/campeonato.php');
          </script>";
}else{
    echo "<script language='JavaScript'>
            location.assign('../Campeonato/campeonato.php');
          </script>";
}
mysqli_close($conexion);
?>
