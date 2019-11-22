<?php 
//    if(!isset($_SESSION)){
//echo "================ SIM, abemos SESSION!<br/>";
//        session_start();
//    session_start();
session_name();
$_SESSION['usu'] = []; // inicia o array Session do Usuário
$_SESSION['usu']['msgLogin']=null;
$_SESSION['usu']['varNome']=null;
$_SESSION['usu']['varSobrenome']=null;
$_SESSION['usu']['varSexo']=null;
$_SESSION['usu']['varLogin']=null;
$_SESSION['usu']['varNome']=null;
$_SESSION['usu']['varSobrenome']=null;
$_SESSION['usu']['varSexo']=null;
$_SESSION['usu']['varLogin']=null;
$_SESSION['usu']['varSenha']=null;
$_SESSION['usu']['varEmail']=null;
$_SESSION['usu']['varNvAcesso']=null;
$_SESSION['usu']['varTelefone']=null;
$_SESSION['usu']['varCelular']=null;
$_SESSION['ficha']['varMatricula']=null;
$_SESSION['ficha']['fase']=null;
$_SESSION['ficha']['varTipoFicha']=null;//-----------  2
?>
<?php include 'head.php'; ?>
<body>
    <?php include 'menu.php'; ?>
    <main role="main" class="container mt-5">
    <form action="loginPesquisadorCheck.php" method="post">
    <div class="row index">
        <div class="col-9 topo-index"></div>
        <div class="col-3 pl-0">
        <div class="card mb-0 card-login">
            <div class='card-header obs px-4 border-0'><h4>Acesso do pesquisador</h4></div>
                <div class="card-body px-4">
                    <div class="form-group">
                        <label for="NoexampleInputEmail1">Login</label>
                        <input name="TX_LOGIN" id="TX_LOGIN" type="text" class="form-control" aria-describedby="emailHelp" placeholder="Entre com seu login">
                    </div>
                    <div class="form-group">
                        <label for="exampleInputPassword1">Senha</label>
                        <input name="TX_SENHA" id="TX_SENHA" type="password" class="form-control" placeholder="Entre com sua senha">
                    </div>
                    <div class="w-100 text-right">
                        <button name="bot_entrar" type="submit" class="btn btn-primary">Entrar</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 mt-5 pr-4 pl-0 mb-5">
            <h2>Digitalização do Cadastro Histórico de Associados da ARI</h2>
            <p>Heritage and History AG e a Associação Religiosa Israelita do
                Rio de Janeiro empreendem em cooperação o processo de
                digitalização do cadastro histórico da ARI, inciado na década
                de 1940.</p>
                <p>A digitalização deste cadastro vai gerar um conjunto de
                    informações sobre pessoas que ainda não tiveram os seus
                    destinos devidamente registrados e analizados na história da
                    trajetória da comunidade judaica no século 20.</p>
                    <p>O registro de pessoas e, por consequência, a elaboração
                        de suas biografias permitem, ao mesmo tempo, a melhor
                        compreensão do seu destino pessoal e familiar, mas também
                        a descoberta do destino comum de certas populações.</p>
        </div>
        <div class="col-6 mt-5 pl-4 pr-0 mb-5">
            <h2>Digitale Erfassung der Historischen Mitgliederkartei der ARI</h2>
            <p>Heritage and History AG und die Associação Religiosa
                Israelita do Rio de Janeiro unternehmen in Zusammenarbeit
                die digitale Erfassung der Historischen Mitgliederkartei der
                deutsch-jüdischen Gemeinde von Rio de Janeiro aus den
                1940er Jahren.</p>
                <p>Durch die Digitalisierung dieser Kartei entsteht eine
                    Sammlung an Informationen über eine bestimmte Gruppe,
                    deren Geschichte im Rahmen der Immigrationsbewegungen
                    der jüdischen Bevölkerung im 20. Jahrhundert noch nicht
                    angemessen ausgewertet und erforscht worden ist.</p>
                    <p>Die Datenerfassung von Individuen und demzufolge die
                        Erstellung ihrer Biografien ermöglichen besseres Verständnis
                        ihrer eigenen Schicksale und derer Familienangehörigen,
                        aber gleichzeitig auch die Erkenntnis über Schicksale ganzer
                        Bevölkerungsgruppen.</p>
        </div>
    </div>
        
        <div id="l_msg" class="msgLogin">
            <?php //echo $_SESSION['usu']['msgLogin']; ?>
        </div>

        <div id="l_LOGIN" class="layerLogin"></div>
    </form>
</main><!-- /.container -->


<!-- < ?php include 'scripts.php'; ?> -->


</body>
</html>
