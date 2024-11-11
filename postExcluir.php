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
		.ctaNovoPost > a {text-decoration: none;}
		.ctaNovoPost:hover {
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

<?php require 'menu.php';?>

<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

    <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
        <h1 class="w3-xxlarge">Excluir postagem</h1>

        <p class="w3-large">
            <div class="w3-code cssHigh notranslate">

				<?php
				
				$servername = "localhost:3307";
				$username = "usu@SoftwareCarona";
				$password = "caronadesoftware";
				$database = "software_de_carona";
				$cod = $_GET['Cod'];
				
				$conn = mysqli_connect($servername, $username, $password, $database);

				if (!$conn) {
					die("Connection failed: " . mysqli_connect_error());
				}

				mysqli_query($conn,"SET NAMES 'utf8'");
				mysqli_query($conn,"SET NAMES 'utf8'");
				mysqli_query($conn,'SET character_set_connection=utf8');
				mysqli_query($conn,'SET character_set_client=utf8');
				mysqli_query($conn,'SET character_set_results=utf8');

				$sql = "SELECT Cod, Texto, FotoBin, DataCriacao FROM Postagem WHERE Cod = $cod"; 

				echo "<div class='w3-responsive'>";
				if ($result = mysqli_query($conn, $sql)) {
					if (mysqli_num_rows($result) > 0) {
						while ($row = mysqli_fetch_assoc($result)) {
				?>
				<div class="w3-responsive w3-code w3-border w3-border-teal box-postagem">
                    <div class="box-postagem-texto" style="width: <?= $row['FotoBin'] ? '35%' : '100%'; ?>">
                        <h6 class="w3-text-grey w3-small">Publicado em: <?= $row['DataCriacao'] ?></h6>
                        <hr class="w3-dark-grey"/>
                        <p class="w3-text-dark-grey w3-padding"><?= $row['Texto'] ?></p>
                    </div>
                    <?php if($row['FotoBin']) { ?>
                        <div class="box-postagem-imagem">
                            <img class="post-image w3-padding" src="data:image/png;base64,<?= base64_encode($row['FotoBin'])?>" />
                        </div>
                    <?php } ?>
                </div>
				<form class="w3-container" action="postExcluir_exe.php?Cod=<?= $cod ?>" method="post" onsubmit="return check(this.form)">
					<input type="submit" value="Excluir postagem" class="w3-btn w3-red" >
					<input type="button" value="Voltar" class="w3-btn w3-theme" onclick="window.location.href='postListar.php'">
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
