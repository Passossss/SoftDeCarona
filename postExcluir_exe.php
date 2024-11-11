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
		.w3-theme {color:#ffff !important;background-color: teal !important}
		.w3-code{border-left:4px solid teal}
		.myMenu {margin-bottom:150px}
      </style>
	</head>
<body onload="w3_show_nav('menuFeed')">

<?php require 'menu.php';?>

<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

<div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
  <h1 class="w3-xxlarge">Exclusão de postagem</h1>

  <p class="w3-large">
  <div class="w3-code cssHigh notranslate">

	<?php
		
		$servername = "localhost:3306";
		$username = "usu@SoftwareCarona";
		$password = "caronadesoftware";
		$database = "software_de_carona";
		
		$conn = mysqli_connect($servername, $username, $password, $database);

		if (!$conn) {
			die("Connection failed: " . mysqli_connect_error());
		}

		mysqli_query($conn,"SET NAMES 'utf8'");
		mysqli_query($conn,"SET NAMES 'utf8'");
		mysqli_query($conn,'SET character_set_connection=utf8');
		mysqli_query($conn,'SET character_set_client=utf8');
		mysqli_query($conn,'SET character_set_results=utf8');
		$cod = $_GET['Cod'];

		$sql = "UPDATE Postagem SET Excluida = 1
				where Cod = $cod";

		echo "<div class='w3-responsive w3-card-4'>";
		if ($result = mysqli_query($conn, $sql)) {
				echo "Postagem excluída!";
		} else {
			echo "Erro executando UPDATE: " . mysqli_error($conn);
		}
        echo "</div>";
		mysqli_close($conn);

	?>
  </div>
</div>

<footer class="w3-panel w3-padding-32 w3-card-4 w3-light-grey w3-center">
  <p><nav>
      <a class="w3-button w3-teal" onclick="document.getElementById('id01').style.display='block'" >Sobre</a>
  </nav></p>
</footer>

</div>

<?php require 'rodape.php';?>
</body>
</html>
