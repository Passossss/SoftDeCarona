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
        .w3-theme {color: #ffff !important; background-color: teal !important}
        .w3-code {border-left: 4px solid teal;}
        .myMenu {margin-bottom: 150px}
        select {width:200px;}
		#Imagem {display: none}
		#imagemSelecionada {
			width: 100% !important;
			height: auto !important;
		}
		.divBtns {
			margin-top: 50px;
		}
		@media(max-width: 991.98px) {
			.divBtns {
				margin-top: 130px;
			}
		}
    </style>
</head>
<body  onload="w3_show_nav('menuFeed')">

<?php require 'menu.php';?>

<div class="w3-main w3-container w3-light-grey" style="margin-left:270px;margin-top:117px;">

    <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
        <h1 class="w3-xxlarge">Postar no feed</h1>

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

                <div class="w3-responsive w3-card-4">
                    <div class="w3-container w3-teal">
                        <h2>Informe os dados do seu post</h2>
                    </div>
                    <form class="w3-container" enctype="multipart/form-data" action="postRegistrar_exe.php" method="post">
						<p>
						<label><h6 class="w3-text-teal"><b>Texto</b></h6></label>
						<textarea maxlength="500" class="w3-input w3-border w3-light-grey " name="Texto" rows="5" 
							title="Texto da postagem" required></textarea>
						<h6 class="w3-text-grey w3-small">Limite de 500 caracteres</h6>
						</p>
						<div class="w3-half">
							<label><h6 class="w3-text-teal"><b>Imagem</b></h6></label>
							<label class="w3-btn w3-dark-grey">
								Selecione uma imagem
								<input type="hidden" name="MAX_FILE_SIZE" value="16777215" />
								<input type="file" id="Imagem" name="Imagem" accept="image/*"
									onchange="validaImagem(this);">
							</label>
						</div>
						<div class="w3-half">
							<label class="w3-text-teal"><h6 ><b>Imagem selecionada</b></h6></label>
							<img id="imagemSelecionada" src="#" />
						</div>
						<br/><br/>
                        <div class="divBtns">
                            <input type="submit" value="Postar" class="w3-btn w3-teal" name="postRegistrar">
                            <input type="button" value="Cancelar" class="w3-btn w3-dark-grey" onclick="window.location.href='postListar.php'"></p>
                        </div>
                    </form>
				</div>

			</div>
		</p>
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
<script>
function validaImagem(input) {
	var caminho = input.value;

	if (caminho) {
		var comecoCaminho = (caminho.indexOf('\\') >= 0 ? caminho.lastIndexOf('\\') : caminho.lastIndexOf('/'));
		var nomeArquivo = caminho.substring(comecoCaminho);

		if (nomeArquivo.indexOf('\\') === 0 || nomeArquivo.indexOf('/') === 0) {
			nomeArquivo = nomeArquivo.substring(1);
		}

		var extensaoArquivo = nomeArquivo.indexOf('.') < 1 ? '' : nomeArquivo.split('.').pop();

		if (extensaoArquivo != 'gif' &&
			extensaoArquivo != 'png' &&
			extensaoArquivo != 'jpg' &&
			extensaoArquivo != 'jpeg') {
			input.value = '';
			alert("É preciso selecionar um arquivo de imagem (gif, png, jpg ou jpeg)");
		}
	} else {
		input.value = '';
		alert("Selecione um caminho de arquivo válido");
	}
	if (input.files && input.files[0]) {
		var arquivoTam = input.files[0].size / 1024 / 1024;
		if (arquivoTam < 16) {
			var reader = new FileReader();
			reader.onload = function (e) {
				document.getElementById('imagemSelecionada').setAttribute('src', e.target.result);
			};
			reader.readAsDataURL(input.files[0]);
		} else {
			input.value = '';
			alert("O arquivo precisa ser uma imagem com menos de 16 MB");
		}
	} else
		document.getElementById('imagemSelecionada').setAttribute('src', '#');
}
</script>
</html>
