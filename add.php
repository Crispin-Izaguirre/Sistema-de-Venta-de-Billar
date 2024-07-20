<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('location:index.php');
    exit;
}
?>
<?php
include("conexion.php");

if(isset($_POST['register'])){
    $name=$_POST['name'];
    $username=$_POST['username'];
    $pass=md5($_POST['password']);

    $sql   ="INSERT INTO `administradores`(`name`, `username`, `password`) VALUES ('$name','$username','$pass')";
    $resultado=mysqli_query($conexion, $sql);
    if($resultado){ 
    header('location:index1.php');
    echo"<script>alert('Nuevo administrador registrado');</script>";   
    }else{
        die(mysqli_error($conexion)) ;
    }
    mysqli_close($conexion);
}
