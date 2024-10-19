<!DOCTYPE html>

<html>
<head>
    <title>Software de Carona</title>
    <link rel="icon" type="image/png" href="imagens/logoSoftwareCarona.png" />
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        .w3-theme {
            color: #ffff !important;
            background-color: #380077 !important
        }

        .w3-code {
            border-left: 4px solid teal;
        }

        .myMenu {
            margin-bottom: 150px
        }
    </style>
</head>

<body onload="w3_show_nav('menuMinhas')">
<?php require 'menu.php'; ?>

<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

    <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
        <h1 class="w3-xxlarge">Mensagens</h1>

        <p class="w3-large">
        <div class="w3-code cssHigh notranslate">

            <?php
            date_default_timezone_set("America/Sao_Paulo");
            $data = date("d/m/Y H:i:s", time());
            echo "<p class='w3-small' > ";
            echo "Acesso em: ";
            echo $data;
            echo "</p> ";

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
            $cod = $_GET["Cod"];

            mysqli_close($conn);
            ?>
        </div>
        <div class="w3-code cssHigh notranslate">
            <?php
            $conn = mysqli_connect($servername, $username, $password, $database);


            $sql = "SELECT m.fk_Remetente_Matricula as fk_Remetente_Matricula, m.texto as texto, m.Cod as MensagemCod, u.Nome as Remetente, m.datahora as Horario
                        FROM Mensagem as m
                        INNER JOIN Usuario u
                        ON u.Matricula = m.fk_Remetente_Matricula 
                        WHERE m.fk_Chat_Cod = $cod
                        ORDER BY Horario asc";

            if ($result = mysqli_query($conn, $sql)) {
                echo "Mensagem:";
                echo "</p>";
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        $cod = $row["MensagemCod"];
                        echo "<tr>";
                        echo "<td>";
                        echo "<td>";
                        echo $row["Horario"];
                        echo ": ";
                        echo "<td>";
                        echo $row["Remetente"];
                        echo ":";
                        echo $row["texto"];
                        echo "</td><td>";
                        echo "</tr>";
                        echo "</p>";
                    }
                }
            }
            $cod = $_GET["Cod"];

            mysqli_close($conn);
            ?>
        </div>

        <div class="w3-responsive w3-card-4">

            <form class="w3-container" action="mensagemChat_exe.php?Cod= <?php echo $cod;?>" method="post">
                <input type="hidden" id="acaoForm" name="acaoForm" value="Carona">

                <div id="escreverTexto">
                    <label class="w3-text-teal"><h6><b>Insira a mensagem</b></h6></label>
                    <input id="inputTexto" class="w3-input w3-border w3-light-grey " name="mensagemEnviada" type="text"
                           title="Insira a mensagem."></p>
                </div>

                <div id="salvarTexto" >
                    <input type="submit" value="Enviar mensagem" class="w3-btn w3-teal" name="mensagemEnviar">
                    <input type="button" value="Voltar" class="w3-btn w3-teal" onclick="window.location.href='caronaAndamento.php'"></p>
                </div>
            </form>
        </div>

    </div>

    <footer class="w3-panel w3-padding-32 w3-card-4 w3-light-grey w3-center">
        <p>
        <nav>
            <a class="w3-button w3-teal w3-hover-white"
               onclick="document.getElementById('id01').style.display='block'">Sobre</a>
        </nav>
        </p>
    </footer>
</div>
<?php require 'rodape.php';?>
</body>
</html>