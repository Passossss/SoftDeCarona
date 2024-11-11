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
<body onload="w3_show_nav('menuPassag')">
<?php require 'menu.php';?>

<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

<div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
  <h1 class="w3-xxlarge">Carona Pedida</h1>

  <p class="w3-large">
  <div class="w3-code cssHigh notranslate">
  <!-- Acesso em:-->
	<?php
		date_default_timezone_set("America/Sao_Paulo");
		$data = date("d/m/Y H:i:s",time());
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

		$passageiro_matricula = $_SESSION['usuario_matri'];
		$localPartida_Puc   = $_POST['localPartida_Puc'];
		$localDestino_Puc = $_POST['localDestino_Puc'];
		$localPartida_Personal   = $_POST['localPartida_Personal'];
		$localDestino_Personal = $_POST['localDestino_Personal'];
		$generoUsuario = $_SESSION['usuario_genero'];

		$isDestinoPersonalizado = 
			$localPartida_Puc == NULL 
			&& $localDestino_Puc == "Escolha";

		$isEscolhaSelectsEmpty = 
			$localDestino_Puc == "Escolha" 
			&& $localPartida_Personal == "Escolha";

		if ($isEscolhaSelectsEmpty) {
			$mensagemErro = "Selecione um destino válido.";

			if($isDestinoPersonalizado)
				$mensagemErro = "Selecione uma partida válida.";

			echo '<script>alert("'.$mensagemErro.'");</script>';
			echo '<script> window.location.href="pedidoRegistrar.php" </script>';
		} else {
		
			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			} else {
				$partidaCarona = $localPartida_Personal;
				$destinoCarona = $localDestino_Personal;

				if (!$isDestinoPersonalizado) {
					$partidaCarona = $localPartida_Puc;
					$destinoCarona = $localDestino_Puc;
				}

				$sql = 
					"INSERT INTO Carona (fk_Passageiro_Matricula, localPartida, localDestino, Finalizada, Cancelada) 
					VALUES ('$passageiro_matricula', '$partidaCarona', '$destinoCarona', 0, 0)";

				if ($generoUsuario == "F") {
					$generoMotorista = $_POST['selectGenero'];

					if ($generoMotorista != "Q") {
						$sql = 
							"INSERT INTO Carona (fk_Passageiro_Matricula, localPartida, localDestino, prefGenero, Finalizada, Cancelada) 
							VALUES ('$passageiro_matricula', '$partidaCarona', '$destinoCarona', '$generoMotorista', 0, 0)";
					}
				}

				echo "<div class='w3-responsive w3-card-4'>";
	
				if (mysqli_query($conn, $sql)) {
					echo "Carona Registrada";
				} else {
					echo "Erro: ".$sql."<br>".mysqli_error($conn);
					echo "Carona não registrada";
				}
			}
		}
		mysqli_close($conn);
	?>
  </div>
</div>

<footer class="w3-panel w3-padding-32 w3-card-4 w3-light-grey w3-center">
  <p><nav>
      <a class="w3-button w3-teal w3-hover-white" onclick="document.getElementById('id01').style.display='block'" >Sobre</a>
  </nav></p>
</footer>

</div>

<?php require 'rodape.php';?>
</body>
</html>