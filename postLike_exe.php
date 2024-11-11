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
        .w3-code {border-left:4px solid teal}
        .myMenu {margin-bottom: 150px}
        .ctaFeed {text-decoration: none;}
        .ctaFeed>h4:hover {
            cursor: pointer;
            color: white;
            background-color: teal;
        }
    </style>
</head>
<body onload="w3_show_nav('menuFeed')">

<?php require 'menu.php';?>

<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

<div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
  <h1 class="w3-xxlarge">Avaliação de postagem</h1>

  <p class="w3-large">
  <div class="w3-code cssHigh notranslate">

	<?php
		
		$servername = "localhost:3306";
		$username = "usu@SoftwareCarona";
		$password = "caronadesoftware";
		$database = "software_de_carona";
        $usuario_matricula = $_SESSION['usuario_matri'];
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

        $Like = 0;
        $Existente = 0;
        $sqlSelect = "SELECT fk_Usuario_Matricula, fk_Postagem_Cod, Curtida FROM AvaliacaoPostagem
                      WHERE fk_Usuario_Matricula = '$usuario_matricula' AND fk_Postagem_Cod = $cod";
        
        if ($result = mysqli_query($conn,$sqlSelect)) {
            if (mysqli_num_rows($result) > 0) {
                $Existente = 1;
                while ($row = mysqli_fetch_assoc($result)) {
                    if($row["Curtida"] == 0) {
                        $Like = 1;
                    } else {
                        $Like = 0;
                    }
                }
            } else {
                $Like = 1;
                $Existente = 0;
            }
        } else {
            echo "Erro executando SELECT: " . mysqli_error($conn);
        }
        
        $sql = $Like == 1 && $Existente == 0 ? "INSERT INTO AvaliacaoPostagem(fk_Usuario_Matricula, fk_Postagem_Cod, Curtida) 
                            VALUES('$usuario_matricula', $cod, $Like)"
                          : "UPDATE AvaliacaoPostagem SET Curtida = $Like,
                            DataCriacao = current_timestamp()
                            WHERE fk_Postagem_Cod = $cod AND fk_Usuario_Matricula = '$usuario_matricula'";  

		if ($result = mysqli_query($conn,$sql)) {
                echo $Like == 1 ? "Postagem curtida!" : "Postagem descurtida!";
                echo "<a href='postListar.php' class='ctaFeed'>
                        <h4 class='w3-center w3-padding-large w3-round-large'>
                            Voltar ao feed
                        </h4>
                    </a>";
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