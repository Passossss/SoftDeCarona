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
		.w3-theme {color:#ffff !important; background-color:#380077 !important}
		.w3-code{border-left:4px solid teal}
		.myMenu {margin-bottom:150px}
      </style>
	</head>
<body onload="w3_show_nav('menuPassag')">
<!-- Inclui MENU.PHP  -->
<?php require 'menu.php';?>

<!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

<div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
  <h1 class="w3-xxlarge">Carona Oferecida</h1>

  <p class="w3-large">
  <div class="w3-code cssHigh notranslate">
  <!-- Acesso em:-->
	<?php
		date_default_timezone_set("America/Sao_Paulo");
		$data = date("d/m/Y H:i:s",time());
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

		$conn = mysqli_connect($servername, $username, $password, $database);

		mysqli_query($conn,"SET NAMES 'utf8'");
		mysqli_query($conn,"SET NAMES 'utf8'");
		mysqli_query($conn,'SET character_set_connection=utf8');
		mysqli_query($conn,'SET character_set_client=utf8');
		mysqli_query($conn,'SET character_set_results=utf8');

		$motorista_matricula = $_SESSION['usuario_matri'];
		$localPartida_Puc = $_POST['localPartida_Puc'];
		$localDestino_Puc = $_POST['localDestino_Puc'];
		$localPartida_Personal = $_POST['localPartida_Personal'];
		$localDestino_Personal = $_POST['localDestino_Personal'];

		if ($localDestino_Puc == "Escolha" && $localPartida_Personal == "Escolha") {
			if($localPartida_Puc == NULL && $localDestino_Puc == "Escolha") {
			?>
			<script>
				alert("Selecione uma partida válida.");
			</script>
			<?php } else { ?>
			<script>
				alert("Selecione um destino válido.");	
			</script>
			<?php } ?>
			<script> window.location.href="oferecidasRegistrar.php" </script>
			<?php
		} else {

			if (!$conn) {
				die("Connection failed: " . mysqli_connect_error());
			} else {
				if ($localPartida_Puc == NULL && $localDestino_Puc == "Escolha") {
					$sql = "INSERT INTO Carona (fk_Motorista_Matricula, localPartida, localDestino, Finalizada, Cancelada) 
							VALUES ('$motorista_matricula', '$localPartida_Personal','$localDestino_Personal', 0, 0)";
					echo "<div class='w3-responsive w3-card-4'>";

					if (mysqli_query($conn, $sql)) {
						echo "Carona Registrada";
					} else {
						echo "Erro: ".$sql."<br>".mysqli_error($conn);
						echo "Carona não registrada";
					}
				} else {
					$sql = "INSERT INTO Carona (fk_Motorista_Matricula, localPartida, localDestino, Finalizada, Cancelada) 
							VALUES ('$motorista_matricula', '$localPartida_Puc','$localDestino_Puc', 0, 0)";
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
		}
	?>
  </div>
</div>


<footer class="w3-panel w3-padding-32 w3-card-4 w3-light-grey w3-center">
  <p><nav>
      <a class="w3-button w3-teal w3-hover-white" onclick="document.getElementById('id01').style.display='block'" >Sobre</a>
  </nav></p>
</footer>

<!-- FIM PRINCIPAL -->
</div>
<!-- Inclui RODAPE.PHP  -->
<?php require 'rodape.php';?>
</body>
</html>
