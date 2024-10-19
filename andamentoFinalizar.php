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

        [type="radio"]:checked + img {
            border-bottom: 1px solid teal;
            padding-bottom: 5px;
        }

        @media(max-width: 991.98px) {
            .Estrela-Avaliacao{
                width: 20px !important;
                margin:
            }
        }

    </style>
</head>

<body onload="w3_show_nav('menuMinhas')">

<?php require 'menu.php';?>

<div class="w3-panel w3-main w3-container w3-responsive" style="margin-left:270px;margin-top:117px;">

    <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
        <h1 class="w3-xxlarge">Finalizar carona</h1>

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

            $servername = "localhost:3307";
            $username = "usu@SoftwareCarona";
            $password = "caronadesoftware";
            $database = "software_de_carona";
            $cod = $_GET["Cod"];
            $usuario_matricula = $_SESSION['usuario_matri'];

            $conn = mysqli_connect($servername, $username, $password, $database);

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }
            mysqli_query($conn,"SET NAMES 'utf8'");
            mysqli_query($conn,"SET NAMES 'utf8'");
            mysqli_query($conn,'SET character_set_connection=utf8');
            mysqli_query($conn,'SET character_set_client=utf8');
            mysqli_query($conn,'SET character_set_results=utf8');

            $sql = "SELECT c.Cod as Cod, u.Nome as Passageiro, u2.Nome as Motorista, c.LocalPartida as LocalPartida, 
                                c.LocalDestino as LocalDestino, c.fk_Passageiro_Matricula as PassageiroMatricula,
                                c.DataFinalizacao as DataFinalizacao
                    FROM Carona c 
                    INNER JOIN Usuario u 
                        ON u.Matricula = c.fk_Passageiro_Matricula 
                    INNER JOIN Usuario u2 
                        ON u2.Matricula = c.fk_Motorista_Matricula 
                    WHERE c.fk_Passageiro_Matricula IS NOT NULL
                    AND c.fk_Motorista_Matricula IS NOT NULL
                    AND Cod = $cod";

            echo "<div class='w3-responsive w3-card-4'>";
            if ($result = mysqli_query($conn, $sql)) {
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>

                        <div class="w3-container w3-teal w3-responsive">
                            <h2>Carona: <?php echo $row['Cod']; ?></h2>
                        </div>
                        <form class="w3-container" action="andamentoFinalizar_exe.php?Cod= <?php echo $row['Cod'] ?>" method="post" onsubmit="return check(this.form)">
                            <p>
                                <label class="w3-text-dark-grey"><b>Passageiro: </b><?php echo $row['Passageiro']; ?> </label>
                            </p>
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
                                <label class="w3-text-dark-grey"><b>Avaliação </b></label>
                            </p>
                            <label>
                                <input type="radio" value="1" style="display: none" name="Avaliacao" >
                                <img src="./Imagens/estrelaAvaliacao.png" style="width:25px" class="Estrela-Avaliacao w3-image w3-hover-opacity">
                            </label>
                            <label>
                                <input type="radio" value="2" style="width:0" name="Avaliacao">
                                <img src="./Imagens/estrelaAvaliacao.png" style="width:25px" class="Estrela-Avaliacao w3-image w3-hover-opacity">
                            </label>
                            <label>
                                <input type="radio" value="3" style="width:0" name="Avaliacao">
                                <img src="./Imagens/estrelaAvaliacao.png" style="width:25px" class="Estrela-Avaliacao w3-image w3-hover-opacity">
                            </label>
                            <label>
                                <input type="radio" value="4" style="width:0" name="Avaliacao">
                                <img src="./Imagens/estrelaAvaliacao.png" style="width:25px" class="Estrela-Avaliacao w3-image w3-hover-opacity">
                            </label>
                            <label>
                                <input type="radio" value="5" style="width:0" name="Avaliacao">
                                <img src="./Imagens/estrelaAvaliacao.png" style="width:25px" class="Estrela-Avaliacao w3-image w3-hover-opacity">
                            </label>
                            </p>
                            <p>
                                <label class="w3-text-dark-grey"><b>Comentário: </b></label>
                                <textarea class="w3-input w3-border w3-light-grey " name="Comentario"  rows="5" title="Necessários 10 a 250 caracteres" pattern=".{10,250}"></textarea>
                            </p>
                            <p>
                                <input type="submit" value="Finalizar carona" class="w3-btn w3-teal" >
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
