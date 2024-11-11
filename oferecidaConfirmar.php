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
        .w3-theme {
            color: #ffff !important;
            background-color: #380077 !important
        }

        .w3-code {
            border-left:4px solid teal
        }

        .myMenu {
            margin-bottom: 150px
        }
    </style>
</head>

<body onload="w3_show_nav('menuPassag')">

<?php require 'menu.php';?>

<div class="w3-panel w3-main w3-container w3-responsive" style="margin-left:270px;margin-top:117px;">

    <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
        <h1 class="w3-xxlarge">Confirmar carona</h1>

        <p class="w3-large">
        <div class="w3-code cssHigh notranslate">
            <?php

            date_default_timezone_set("America/Sao_Paulo");
            $data = date("d/m/Y H:i:s", time());
            echo "<p class='w3-small' > ";
            echo "Acesso em: ";
            echo $data;
            echo "</p> "
            ?>

            <?php

            $servername = "localhost:3306";
            $username = "usu@SoftwareCarona";
            $password = "caronadesoftware";
            $database = "software_de_carona";
            $cod = $_GET["Cod"];

            $conn = mysqli_connect($servername, $username, $password, $database);

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            mysqli_query($conn,"SET NAMES 'utf8'");
            mysqli_query($conn,"SET NAMES 'utf8'");
            mysqli_query($conn,'SET character_set_connection=utf8');
            mysqli_query($conn,'SET character_set_client=utf8');
            mysqli_query($conn,'SET character_set_results=utf8');

            $sql = "SELECT c.LocalPartida as LocalPartida, c.LocalDestino as LocalDestino, c.Cod as Cod, u.Nome as Motorista
				FROM Carona as c
				INNER JOIN Usuario as u ON u.Matricula = c.fk_Motorista_Matricula
				WHERE Cod = $cod";

            echo "<div class='w3-responsive w3-card-4'>";
            if ($result = mysqli_query($conn, $sql)) {
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="w3-container w3-teal w3-responsive">
                            <h2>Carona: <?php echo $row['Cod']; ?></h2>
                        </div>
                        <form class="w3-container" action="oferecidaConfirmar_exe.php?Cod= <?php echo $row['Cod'] ?>" method="post" onsubmit="return check(this.form)">
                            <p>
                                <label class="w3-text-dark-grey"><b>Motorista: </b><?php echo $row['Motorista']; ?> </label>
                            </p>
                            <p>
                                <label class="w3-text-dark-grey"><b>Local de partida: </b><?php echo $row['LocalPartida']; ?> </label>
                            </p>
                            <p>
                                <label class="w3-text-dark-grey"><b>Destino: </b><?php echo $row['LocalDestino']; ?></label>
                            </p>
                            <p>
                                <input type="submit" value="Confirmar carona" class="w3-btn w3-teal" >
                        </form>
                        <?php
                    }
                }
            }
            else {
                echo "Erro executando SELECT: " . mysqli_error($conn);
            }
            echo "</div>";
            mysqli_close($conn);

            ?>

        </div>
        </p>
    </div>


    <footer class="w3-panel w3-padding-32 w3-card-4 w3-light-grey w3-center">
        <p>
        <nav>
            <a class="w3-button w3-teal"
               onclick="document.getElementById('id01').style.display='block'">Sobre</a>
        </nav>
        </p>
    </footer>
</div>
<?php require 'rodape.php';?>
</body>
</html>
