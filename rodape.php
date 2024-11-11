<!-------------------------------------------------------------------------------
Software de Carona

RODAPE.PHP
---------------------------------------------------------------------------------->

    <div id="id01" class="w3-modal w3-animate-opacity">
        <div class="w3-modal-content">
            <header class="w3-container w3-teal">
                <span onclick="document.getElementById('id01').style.display='none'"
                      class="w3-button w3-display-topright">x</span>
                <h2>Software de Carona</h2>
            </header>
            <div class="w3-container">
                <p><b>O Software para caronas do curso de BES!</b></p>
                <p>
                    Integrantes do curso de BES da PUCPR criaram este software com o principal
                    objetivo de aumentar a interação entre os integrantes do curso de uma maneira
                    ao mesmo tempo rentável e agradável! <br/><br/>
                    Se você é um desses que quer conversar com alguém legal no caminho de casa ou
                    se simplemente cansou de ter que andar de ônibus o tempo inteiro (ou as duas
                    coisas, também vale), use este site ao seu favor! Aqui você pode receber e dar
                    caronas para outros integrantes do curso enquanto bate um papo legal com quem
                    está junto contigo! <br/><br/>
                    "Ah, mas eu não tenho problema com isso e prefiro ficar na minha no meu carro"
                    <br/><br/>
                    Tudo bem... mas esse site também é para você! Na aba "feed", você pode estar
                    acompanhando as novidades sobre o trânsito e tudo mais que o pessoal postar lá!
                    Seria legal se você também desse uma olhada e contribuísse com os outros, não acha?
                    Afinal, você também não gosta de chegar num ponto do caminho e perceber que vai se
                    atrasar algumas horas para o almoço, certo? <br/><br/>
                    Aproveite este site!
                </p>
            </div>
            <footer class="w3-container w3-teal ">
                <p>PUCPR 2020</p>
            </footer>
        </div>
    </div>


    <script>
        function w3_open() {
            document.getElementById("mySidebar").style.display = "block";
        }

        function w3_close() {
            document.getElementById("mySidebar").style.display = "none";
        }

        function w3_show_nav(name) {
            document.getElementById("menuPassag").style.display = "none";
            document.getElementById("menuMotor").style.display = "none";
			document.getElementById("menuFeed").style.display = "none";
			document.getElementById("menuMinhas").style.display = "none";
            document.getElementById(name).style.display = "block";

        }
    </script>

