<!DOCTYPE html>



<html>
<head>

    <title>Software de Carona</title>
    <link rel="icon" type="image/png" href="imagens/logoSoftwareCarona.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        .w3-theme {color:#ffff !important; background-color:#380077 !important}
        .w3-code{border-left:4px solid teal}
        .myMenu {margin-bottom:150px}
    </style>
</head>

<body onload="w3_show_nav('menuMinhas')">
<?php require 'menu.php';?>

<div class="w3-main w3-container" id="salvarMensagem" style="margin-left:270px;margin-top:117px;">

    <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
        <h1 class="w3-xxlarge">Mensagem</h1>

        <div class="w3-code cssHigh notranslate">

            <?php

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

            $usuarioMatri = $_SESSION['usuario_matri'];
            $cod = $_GET["Cod"];
            $mensagemEnviada = trim($_POST['mensagemEnviada']);

            $sql = "SELECT m.fk_Chat_Cod as fkChatCod, ct.Cod as ChatCod
                                    FROM Mensagem as m
                                    WHERE fkChatCod = ChatCod";

            if (!$conn) {
                die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
            } else {
                if ($mensagemEnviada != '') {
                    $sql = "INSERT INTO Mensagem (texto, fk_Chat_Cod, fk_Remetente_Matricula)
                                            VALUES ('$mensagemEnviada', $cod , '$usuarioMatri')";
                } else {
                    echo "Erro: ".$sql."<br>".mysqli_error($conn);
                }
                echo "<div class='w3-responsive w3-card-4'>";

                if (mysqli_query($conn, $sql)) {
                    echo "Mensagem Enviada";

                } else {
                    echo "Erro: ".$sql."<br>".mysqli_error($conn);
                    echo "Mensagem não Enviada";
                }
            }
            mysqli_close($conn);
            ?>
        </div>
    </div>

    <div class="w3-panel w3-padding-16 w3-center">
        <input type="button" value="Voltar" class="w3-button w3-teal" onclick="history.go(-1)"></p>
    </div>

    <footer class="w3-panel w3-padding-32 w3-card-4 w3-light-grey w3-center">
        <p>
        <nav>
            <a  class="w3-button w3-teal w3-hover-white w3-center"
                onclick="document.getElementById('id01').style.display='block'">Sobre</a>
        </nav>
        </p>
    </footer>
</div>
<?php require 'rodape.php';?>
</body>
<html>

