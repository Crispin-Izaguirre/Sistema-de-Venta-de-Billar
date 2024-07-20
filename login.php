<?php
session_start();
include("conexion.php");

if (isset($_POST['login'])) {
    $username = $_POST['username'];
    $password = $_POST['password'];

    if (empty($username) && empty($password)) {
        echo "<script>alert('Por favor ingrese su correo y contraseña');</script>";
        exit;
    } elseif (empty($password)) {
        echo "<script>alert('Por favor complete la contraseña');</script>";
        exit;
    } elseif (empty($username)) {
        echo "<script>alert('Por favor complete su correo');</script>";
        exit;
    } else {
        $password = md5($password);
        $sql = "SELECT * FROM `administradores` WHERE `username`='$username' AND `password`='$password'";
        $resultado = mysqli_query($conexion, $sql);

        if (mysqli_num_rows($resultado) > 0) {
            $row = mysqli_fetch_array($resultado);
            $_SESSION['name'] = $row['name'];
            $_SESSION['username'] = $row['username'];
            $_SESSION['admin_id'] = $row['id_admin'];
            header('location:index1.php');
        } else {
            echo "<script language='JavaScript'>
                    alert('Correo y contraseña incorrecta');
                    location.assign('index.php');
                  </script>";
        }
    }
}
?>
