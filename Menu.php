<!-------------------------------------------------------------------------------
Software de Carnona


MENU.PHP
---------------------------------------------------------------------------------->

<?php
session_start();
if (!isset($_SESSION['usuario_matri']))
    header("Location: .");

if (isset($_SESSION['LAST_ACTIVITY']) && (time() - $_SESSION['LAST_ACTIVITY'] > 1800)) {
    session_unset();
    session_destroy();
    header("Location: .");
}
$_SESSION['LAST_ACTIVITY'] = time();
?>

<!-- Top -->
<div class="w3-top">
    <div class="w3-row w3-dark-grey w3-padding">
        <div class="w3-center"><img src="./Imagens/LogoBranca.png" style="height: 56px" /></div>
    </div>
    <div class="w3-bar w3-dark-grey w3-large" style="z-index:4;height:45px">
        <a class="w3-bar-item w3-button w3-left w3-hide-large w3-hover-white w3-large w3-teal w3-padding-16" href="javascript:void(0)" onclick="w3_open()">☰</a>

        <div style="display:" class="perfilMenu_Mobile">
            <form action="login_sair_exe.php" style="float:right; width:90px; padding-right:10">
                <input type="submit" value="Sair" class="w3-button w3-teal w3-hover-dark-grey"/>
            </form>
            <a style="float:right; padding:10px; width:175px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;" href="loginAtualizar.php"><?= $_SESSION['usuario_nome'] ?></a>
        </div>


        <a class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-hover-teal w3-padding-16" href="javascript:void(0)" onclick="w3_show_nav('menuPassag')">PASSAGEIRO</a>
        <?php if (isset($_SESSION['usuario_cnh'])) { ?>
            <a class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-hover-teal w3-padding-16" href="javascript:void(0)" onclick="w3_show_nav('menuMotor')">MOTORISTA</a>
        <?php } ?>
        <a class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-hover-teal w3-padding-16" href="javascript:void(0)" onclick="w3_show_nav('menuMinhas')">MINHAS CARONAS</a>
        <a class="w3-bar-item w3-button w3-hide-medium w3-hide-small w3-hover-teal w3-padding-16" href="javascript:void(0)" onclick="w3_show_nav('menuFeed')">FEED</a>
    </div>

</div>

<!-- Sidebar -->
<div class="w3-sidebar w3-bar-block w3-collapse w3-animate-left w3-grey w3-card" style="z-index:3;width:280px" id="mySidebar">
    <div class="w3-bar w3-hide-large w3-large">
        <a href="javascript:void(0)" onclick="w3_show_nav('menuPassag')"
           class="w3-bar-item w3-button w3-teal w3-hover-white w3-padding-16">PASSAGEIRO</a>
        <?php if (isset($_SESSION['usuario_cnh'])) { ?>
            <a href="javascript:void(0)" onclick="w3_show_nav('menuMotor')"
               class="w3-bar-item w3-button w3-teal w3-hover-white w3-padding-16">MOTORISTA</a>
        <?php } ?>
        <a href="javascript:void(0)" onclick="w3_show_nav('menuMinhas')"
           class="w3-bar-item w3-button w3-teal w3-hover-white w3-padding-16">MINHAS CARONAS</a>
        <a href="javascript:void(0)" onclick="w3_show_nav('menuFeed')"
           class="w3-bar-item w3-button w3-teal w3-hover-white w3-padding-16">FEED</a>
    </div>
    <a href="javascript:void(0)" onclick="w3_close()" class="w3-button w3-right w3-xlarge w3-hide-large w3-teal"
       title="Close Menu">x</a>
    <div id="menuPassag" class="myMenu">
        <div class="w3-container w3-teal">
            <h3 class="w3-border-dark-grey w3-padding">Passageiro</h3>
        </div>
        <a class="w3-bar-item w3-button" href="oferecidasListar.php">Caronas oferecidas</a>
        <a class="w3-bar-item w3-button" href="pedidoRegistrar.php">Pedir carona</a>
    </div>
    <div id="menuMotor" class="myMenu" >
        <div class="w3-container w3-teal">
            <h3 class="w3-border-dark-grey w3-padding">Motorista</h3>
        </div>
        <a class="w3-bar-item w3-button" href='pedidoListar.php'>Pedidos de carona</a>
        <a class="w3-bar-item w3-button" href='oferecidasRegistrar.php'>Oferecer carona</a>
    </div>
    <div id="menuFeed" class="myMenu" >
        <div class="w3-container w3-teal">
            <h3 class="w3-border-dark-grey w3-padding">Feed</h3>
        </div>
        <a class="w3-bar-item w3-button" href='postListar.php'>Posts</a>
        <a class="w3-bar-item w3-button" href='postMeu.php'>Meus posts</a>
        <a class="w3-bar-item w3-button" href='postRegistrar.php'>Novo post</a>
    </div>
    <div id="menuMinhas" class="myMenu" >
        <div class="w3-container w3-teal">
            <h3 class="w3-border-dark-grey w3-padding">Minhas caronas</h3>
        </div>
        <a class="w3-bar-item w3-button" href='caronaPedi.php'>Pedidas pendentes</a>
        <?php if (isset($_SESSION['usuario_cnh'])) { ?>
            <a class="w3-bar-item w3-button" href='caronaOfereci.php'>Oferecidas pendentes</a>
        <?php } ?>
        <a class="w3-bar-item w3-button" href='caronaAndamento.php'>Em andamento</a>
        <a class="w3-bar-item w3-button" href='historico.php'>Histórico</a>

    </div>
    <div class="myMenu perfilMenu_Desktop" style="position:absolute; bottom:0; left:0; width:285px">
        <div style="float:left; margin-left:4px; padding:5px; width:180px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">
            <a href="loginAtualizar.php"><?= $_SESSION['usuario_nome'] ?></a>
        </div>
        <div style="float:left;">
            <form action="login_sair_exe.php">
                <input type="submit" value="Sair"
                       class="w3-button w3-dark-grey w3-hover-teal"/>
            </form>
        </div>
    </div>

</div>

<style>
    .perfilMenu_Desktop {
        display:block;
    }
    .perfilMenu_Mobile {
        display:none;
    }
    @media (max-width: 991.98px) {
        .perfilMenu_Desktop {
            display:none;
        }
        .perfilMenu_Mobile {
            display:block;
        }
    }
</style>
