<!DOCTYPE html>
<!--
Software de Carona
-->
<html>
<head>

    <title>Software de Carona</title>
    <link rel="icon" type="image/png" href="imagens/logoSoftwareCarona.png" />	  <link rel="icon" type="image/png" href="imagens/logoSoftwareCarona.png" />    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <style>
        .w3-theme {
            color: #ffff !important;
            background-color: teal !important
        }

        .w3-code {
            border-left: 4px solid teal
        }

        .myMenu {
            margin-bottom: 150px
        }
    </style>
</head>
<body onload="w3_show_nav('menuPassag')">

<?php require 'menu.php'; ?>

<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

    <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
        <h1 class="w3-xxlarge">Atualização de login</h1>

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
            $matricula = $_SESSION['usuario_matri'];

            $conn = mysqli_connect($servername, $username, $password, $database);

            if (!$conn) {
                die("Connection failed: " . mysqli_connect_error());
            }

            mysqli_query($conn,"SET NAMES 'utf8'");
            mysqli_query($conn,"SET NAMES 'utf8'");
            mysqli_query($conn,'SET character_set_connection=utf8');
            mysqli_query($conn,'SET character_set_client=utf8');
            mysqli_query($conn,'SET character_set_results=utf8');

            $sql = "SELECT Matricula, Genero, Nome, Email, Senha FROM Usuario WHERE Matricula = $matricula";
            echo "<div class='w3-responsive w3-card-4'>";
            if ($result = mysqli_query($conn, $sql)) {
                if (mysqli_num_rows($result) > 0) {

                    while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                        <div class="w3-container w3-teal">
                            <h2>Altere os dados do usuário de matrícula <?= $row['Matricula']; ?></h2>
                        </div>
                        <form class="w3-container" action="loginAtualizar_exe.php" method="post" onsubmit="return check(this.form)">
                            <p>
                                <label class="w3-text-teal"><b>Gênero</b></label>
                                <select class="w3-white w3-border w3-padding" id="selectGenero" name="selectGenero">
                                    <option value="F"> Feminino </option>
                                    <option value="M"> Masculino </option>
                                </select>
                            </p>
                            <script> document.getElementById('selectGenero').value = '<?= $row['Genero']; ?>'; </script>
                            <p>
                                <label class="w3-text-teal"><b>Nome</b></label>
                                <input class="w3-input w3-border w3-light-grey" name="Nome" type="text" pattern="[a-zA-Z\u00C0-\u00FF ]{10,250}$"
                                       title="Nome entre 10 e 250 letras." value="<?= $row['Nome']; ?>" required>
                            </p>
                            <p>
                                <label class="w3-text-teal"><b>Email</b></label>
                                <input class="w3-input w3-border w3-light-grey" name="Email" type="email" pattern=".{10,250}"
                                       title="Email entre 10 e 250 letras." value="<?= $row['Email']; ?>" required>
                            </p>
                            <p>
                                <label class="w3-text-deep-orange"><b>Nova senha</b></label>
                                <input id="novaSenha" class="w3-input w3-border w3-sand" name="Senha" type="password"
                                       pattern=".{10,40}" title="Senha entre 10 a 40 caracteres"
                                       onkeyup="validaConfirmacaoSenha()">
                            </p>
                            <p>
                                <label class="w3-text-deep-orange"><b>Confirme a nova senha</b></label>
                                <input id="confirmaNovaSenha" class="w3-input w3-border w3-sand" name="Senha2" type="password"
                                       pattern=".{10,40}" title="Senha entre 10 a 40 caracteres"
                                       onkeyup="validaConfirmacaoSenha()">
                            </p>
                            <script>
                                function validaConfirmacaoSenha() {
                                    var senha = document.getElementById("novaSenha").value;
                                    var senha_conf = document.getElementById("confirmaNovaSenha").value;

                                    if((senha.length >= 10 && senha.length <= 40) &&
                                        (senha_conf.length >= 10 && senha_conf.length <= 40) &&
                                        (senha.length != '' && senha_conf.length != '') &&
                                        senha == senha_conf)
                                        document.getElementById('submitAtualizar').disabled = false;
                                    else
                                        document.getElementById('submitAtualizar').disabled = true;
                                }
                            </script>
                            <p>
                                <input id="submitAtualizar" type="submit" value="Alterar" class="w3-btn w3-teal" disabled >
                                <input type="button" value="Cancelar" class="w3-btn w3-dark-grey" onclick="window.location.href='pedidoListar.php'">
                            </p>
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
