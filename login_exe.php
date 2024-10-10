<!DOCTYPE html>
<!--
Software de Carona
-->
<html>
<head>

    <title>Software de Carona</title>
    <link rel="icon" type="image/png" href="imagens/logoSoftwareCarona.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        .w3-theme {color:#ffff !important;background-color:#380077 !important}
        .w3-code{border-left:4px solid #380077}
        .myMenu {margin-bottom:150px}
    </style>
</head>
</html>
<?php
session_start();
$_SESSION['usuario_email'] = $_POST['Email'];
$_SESSION['usuario_senha'] = $_POST['Senha'];

$usuario_email = $_SESSION['usuario_email'];
$usuario_senha_md5 = md5($_SESSION['usuario_senha']);

$servername = "localhost:3307";
$username = "usu@SoftwareCarona";
$password = "caronadesoftware";
$database = "software_de_carona";

$conn = mysqli_connect($servername, $username, $password, $database);

mysqli_query($conn,"SET NAMES 'utf8'");
mysqli_query($conn,"SET NAMES 'utf8'");
mysqli_query($conn,'SET character_set_connection=utf8');
mysqli_query($conn,'SET character_set_client=utf8');
mysqli_query($conn,'SET character_set_results=utf8');

$sql = "SELECT * FROM Usuario WHERE Email = '$usuario_email' AND Senha = '$usuario_senha_md5'";

if (!$result = mysqli_query($conn, $sql)) {
    ?>
    <script>console.log("Erro executando SELECT: " . mysqli_error($conn));</script>
    <?php
} else {
    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $_SESSION['usuario_matri'] = $row['Matricula'];
            $_SESSION['usuario_nome'] = $row['Nome'];
            $_SESSION['usuario_genero'] = $row['Genero'];
            $_SESSION['usuario_cnh'] = $row['CNH'];
        }
        header("Location: oferecidasListar.php");
    } else {
        ?>
        <script>
            alert("Login inválido.");
            window.location.href = ".";
        </script>
        <?php
    }
}
?>