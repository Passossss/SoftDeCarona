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
<body onload="w3_show_nav('menuFeed')">
<?php require 'menu.php';?>

<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

    <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
        <h1 class="w3-xxlarge">Comentário</h1>
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
        $cod = $_GET["Cod"];
        $usuarioMatri = $_SESSION['usuario_matri'];
        $comentario = trim($_POST['comentario']);

        $Existente = 0;

        $sqlSelect = "SELECT fk_Usuario_Matricula, fk_Postagem_Cod FROM AvaliacaoPostagem
                    WHERE fk_Usuario_Matricula = '$usuarioMatri' AND fk_Postagem_Cod = $cod";

        if ($result = mysqli_query($conn,$sqlSelect)) {
            $Existente = mysqli_num_rows($result) > 0 ? 1 : 0;
        } else {
            echo "Erro executando SELECT: " . mysqli_error($conn);
        }

        if(!$conn) {
            die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
        } else {
            $sql = "";
            if ($comentario != '') {
                $sql = $Existente == 0 ?
                    "INSERT INTO AvaliacaoPostagem(fk_Usuario_Matricula, fk_Postagem_Cod, Comentario, Curtida) 
                        VALUES('$usuarioMatri', $cod, '$comentario', 0)" :
                    "UPDATE AvaliacaoPostagem SET Comentario = '$comentario', DataCriacao = current_timestamp()
                        WHERE fk_Postagem_Cod = $cod AND fk_Usuario_Matricula = '$usuarioMatri'";

                if (!mysqli_query($conn,$sql)) {
                    echo "Erro: ".$sql."<br>".mysqli_error($conn);
                    echo "Comentário não enviado";
                } else
                    echo $Existente == 0 ? "Comentário enviado" : "Comentário atualizado";
            } else {
                echo "<div class='w3-responsive w3-card-4'>";
                echo "Comentário vazio não enviado";
            }
        }
        mysqli_close($conn);
        ?>
        <div class="w3-panel w3-padding-16 w3-center">
            <input type="button" value="Voltar" class="w3-button w3-teal" onclick="history.go(-1)"></p>
        </div>
    </div>
    <footer class="w3-panel w3-padding-32 w3-card-4 w3-light-grey w3-center">
        <p><nav>
            <a class="w3-button w3-teal w3-hover-white" onclick="document.getElementById('id01').style.display='block'" >Sobre</a>
        </nav></p>
    </footer>
    <?php require 'rodape.php';?>
</body>
</html>