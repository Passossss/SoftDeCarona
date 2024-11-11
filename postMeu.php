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
    .w3-theme {color: #ffff !important;background-color: teal !important}
    .myMenu {margin-bottom: 150px}
    .w3-code {
        border: 0;
        border-radius: 7px;
    }
    .post-image {
        max-width: 100%;
        height: auto;
    }
    .ctaNovoPost {text-decoration: none;}
    .ctaNovoPost>h4:hover {
        cursor: pointer;
        color: white;
        background-color: teal;
    }
    .box-postagem {display: flex;}
    .box-postagem-texto > hr {border: 1px solid teal;}
    .box-postagem-texto > p {white-space: pre-wrap; overflow-wrap: break-word; font-family: sans-serif;}
    .box-postagem-imagem {width: 65%;}
    @media(max-width: 991.98px)
        {.box-postagem div {width: 100% !important;}.box-postagem{display: block !important}}
</style>
</head>
<body onload="w3_show_nav('menuFeed')">

<?php require 'menu.php'; ?>

<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

    <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
        <h1 class="w3-xxlarge">Meus posts</h1>

        <p class="w3-large">
        <p>
        <div class="cssHigh notranslate">
            <?php
            $servername = "localhost:3306";
            $username = "usu@SoftwareCarona";
            $password = "caronadesoftware";
            $database = "software_de_carona";

            $usuario_matricula = $_SESSION['usuario_matri'];

            $conn = mysqli_connect($servername, $username, $password, $database);

            if (!$conn) {
                echo "</table>";
                echo "</div>";
                die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
            }

            mysqli_query($conn,"SET NAMES 'utf8'");
			mysqli_query($conn,"SET NAMES 'utf8'");
			mysqli_query($conn,'SET character_set_connection=utf8');
			mysqli_query($conn,'SET character_set_client=utf8');
			mysqli_query($conn,'SET character_set_results=utf8');

            $sql = "SELECT  p.Cod as CodigoPostagem,
                            u.Nome as NomeUsuario, 
                            p.Texto as TextoPostagem, 
                            p.FotoBin as FotoPostagem, 
                            p.DataCriacao as DataCriacaoPostagem 
                    FROM Postagem p
                    INNER JOIN Usuario u
                        ON p.fk_Usuario_Matricula = u.Matricula
                    WHERE p.fk_Usuario_Matricula = '$usuario_matricula'
                    AND p.Excluida IS NULL
                    ORDER BY p.DataCriacao DESC";
            
            echo "<div class='w3-responsive'>";
            if ($result = mysqli_query($conn, $sql)) {
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
				?>
                <div class="w3-responsive w3-code w3-border w3-border-teal box-postagem">
                    <div class="box-postagem-texto" style="width: <?= $row['FotoPostagem'] ? '35%' : '100%'; ?>">
                        <h6 class="w3-text-grey w3-small">Publicado em: <?= $row['DataCriacaoPostagem'] ?></h6>
                        <hr class="w3-dark-grey"/>
                        <p class="w3-text-dark-grey w3-padding"><?= $row['TextoPostagem'] ?></p>
                    </div>
                    <?php if($row['FotoPostagem']) { ?>
                        <div class="box-postagem-imagem">
                            <img class="post-image w3-padding" src="data:image/png;base64,<?= base64_encode($row['FotoPostagem'])?>" />
                        </div>
                    <?php } ?>
                </div>
                <div class="w3-bar">
                    <a href='postExcluir.php?Cod=<?= $row['CodigoPostagem'] ?>' class="w3-button w3-bar-item" style="width: 100%">
                        <img src='imagens/Delete.png' title='Chat' width='28'>
                    </a>
                </div>
				<?php
                    }
                } else {
                    echo "<a href='postListar.php' class='ctaNovoPost'>
                        <h4 class='w3-center w3-padding-large w3-round-large'>
                            Você não postou nada até o momento! Que tal fazer seu primeiro post?
                        </h4>
                    </a>";
                }
                echo "</div>";
            } else {
                echo "Erro executando SELECT: " . mysqli_error($conn);
            }

            mysqli_close($conn);

            ?>
        </div>
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
