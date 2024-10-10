<html lang="pt">
<!-------------------------------------------------------------------------------
Software de Carona


INDEX.PHP
---------------------------------------------------------------------------------->
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
        border-left: 4px solid #380077
    }

    .myMenu {
        margin-bottom: 150px
    }

    .myFont {
        font-max-size: 8px
    }
</style>

<?php
session_start();
if (isset($_SESSION['usuario_matri']))
    header("Location: oferecidasListar.php");
?>

<body class="w3-dark-grey">

<div class="w3-main w3-container w3-padding" style="display: flex; height: 100%;">
    <div class="w3-panel w3-padding w3-card-4 w3-light-grey" style="margin: auto;">
        <div class="w3-padding-large w3-light-grey w3-half">
            <div class="w3-container w3-dark-grey">
                <h3>Realize seu login se for um estudante de BES da PUCPR!</h3>
            </div>
            <form action="login_exe.php" method="post" onsubmit="return check(this.form)">
                <input type="hidden" id="login" name="login" value="Login">
                <p>
                    <label class="w3-text-teal"><b>Email</b></label>
                    <input class="w3-input w3-border w3-light-grey" name="Email" type="email" pattern=".{10,250}"
                           title="Email entre 10 e 250 letras." required>
                </p>
                <p>
                    <label class="w3-text-teal"><b>Senha</b></label>
                    <input class="w3-input w3-border w3-light-grey" name="Senha" type="password"
                           pattern=".{10,40}" title="Senha entre 10 a 40 caracteres" required>
                </p>
                <p class="w3-center">
                    <input type="submit" value="Entrar" class="w3-btn w3-teal w3-section" >
                    <input type="reset" value="Limpar campos" class="w3-btn w3-teal">
                </p>
            </form>
        </div>
        <div class="w3-padding-large w3-card-4 w3-light-grey w3-half">
            <div class="w3-center w3-padding-large"><img src="./Imagens/LogoCinza1.png" style="width: 300px"></div>
            <p>
                Integrantes do curso de BES da PUCPR criaram este software com o principal
                objetivo de aumentar a interação entre os integrantes do curso de uma maneira
                ao mesmo tempo rentável e agradável! <br/><br/>
                Se você é um desses que quer conversar com alguém legal no caminho de casa ou
                se simplemente cansou de ter que andar de ônibus o tempo inteiro (ou as duas
                coisas, também vale), use este site ao seu favor! Aqui você pode receber e dar
                caronas para outros integrantes do curso enquanto bate um papo legal com quem
                está junto contigo! <br/><br/>
                "Ah, mas eu não tenho problema com isso e prefiro ficar na minha no  meu carro"
                <br/><br/>
                Tudo bem... mas esse site também é para você! Na aba "feed", você pode estar
                acompanhando as novidades sobre o trânsito e tudo mais que o pessoal postar lá!
                Seria legal se você também desse uma olhada e contribuísse com os outros, não acha?
                Afinal, você também não gosta de chegar num ponto do caminho e perceber que vai se
                atrasar algumas horas para o almoço, certo? <br/><br/>
                Aproveite este site!
            </p>
        </div>
    </div>
</div>
</body>
</html>