<?php 
// inicia a sessão
// < ?php !isset($_SESSION)?session_start():null; ? > 
 //!isset($_SESSION)?session_start():null;
 //session_start();
 //session_name();
 header('Content-Type: text/html; charset=utf-8');

 //echo " session_name(): ". session_name()."<br/>";
 //echo " session_id(): ". session_id()."<br/>";

 //echo "lPC: 0- Check: Session_status: ". session_status()."<br/>";
 //echo "lPC: 0 chkLogin: " . $chkLogin ." - SESSION['usu']['chkLogin']: " . $_SESSION['usu']['chkLogin'] . ". <br/>";
 //echo "lPC: 0 msgLogin: " . $msgLogin ." - SESSION['usu']['msgLogin']: " . $_SESSION['usu']['msgLogin'] . ". <br/>";
 //echo "lPC: 0 varLogin: " . $varLogin ." - SESSION['usu']['varLogin']: " . $_SESSION['usu']['varLogin'] . ". <br/>";
 //echo "_________________________________________________________________________________________________________________________________ <br/>"
 include "head.php";
 include "geraSenha.php";
 ?>    
<script src="login.js"></script>

<?php
// Inicialmente checará o login e a senha por sessão. Se OK, abrirá a página, senão, retornará à página de login.
$chkLogin=$_SESSION['usu']["chkLogin"];// Pega o chkLogin da Session
//echo "chkLogin: ".$chkLogin."<br/>";
$chkLogin="OK";
$_SESSION['usu']['nvAcesso']=10;
if($chkLogin!=="OK" || intval($_SESSION['usu']['nvAcesso'])!==10){// NÃO pode rodar           XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
        //echo "Volta para a página de login (acesso não permitido) nvAcesso:". $_SESSION['usu']['nvAcesso']."<br/>";
        //header("Location:index.php");
    }else{

    global $conexao,$usu,$login,$sqlInsert,$chkLogin,$msgLogin,$data ,$hora, $hash;
    global $varNome,$varSobrenome,$varSexo, $varLogin,$varSenha,$varEmail,$varNvAcesso,$varTel,$varCel;
    //echo "Entrando em cadastrarUsuario.php <br/>";

    $login= filter_input_array(INPUT_POST, FILTER_DEFAULT);
    //Definição de mensagens
    $txLogin="Pesquisador";
    $txSenha="Senha";
    $txNovaSenha="Nova senha";
    $txConfSenha="Nova senha - confirmação";
    $linkEsqSenha="Esqueci minha senha";
    $linkTroca="Trocar senha";
    $txBotao="Entrar";
    $msgLoginForgot="Sua senha foi enviada para seu e-mail. Por favor, tente novamente com usuário e senha corretos.";
    $msgLoginTrOK="Sua senha foi alterada com sucesso. Por favor, faça seu login com a nova senha.";
    $msgLoginTrNOK="Sua senha NÃO foi alterada. Por favor, verifique usuário e senha e tente novamente.";
    $msgLoginNOK="Usuário e/ou senha incorreto(s).<br/>Por favor, entre com seu usuário e senha.";
    $msgLogin= "Por favor, entre com seu usuário e senha.";
    $_SESSION['usu']['msgInsert']="";
    //echo "Entrando na página loginPesquisadorCheck.php </br>";
    //echo "<script>window.alert('Login: '. $varLogin);</script>";

    $varNome=filter_input(INPUT_POST , 'TX_NOME');
    $varSobrenome=filter_input(INPUT_POST , 'TX_SOBRENOME');
    $varSexo=filter_input(INPUT_POST , 'TX_SEXO');
    $varNvAcesso=intval(filter_input(INPUT_POST , 'TX_NVACESSO'));
    $varLogin=filter_input(INPUT_POST , 'TX_LOGIN');
    $varSenha=filter_input(INPUT_POST , 'TX_SENHA');
    $varEmail=filter_input(INPUT_POST , 'TX_EMAIL');
    $varTel=filter_input(INPUT_POST , 'TX_TEL');
    $varCel=filter_input(INPUT_POST , 'TX_CEL');
/*
    echo "_____________________________________________________________________________________<br>";
    echo "1 varLogin: " . $varLogin . "<br>";
    echo "2 varSenha: " . $varSenha . "<br>";
    echo "3 chkLogin: " . $chkLogin . "<br>";

    echo "varNome: " . $varNome . "<br>";
    echo "varSobrenome: " . $varSobrenome . "<br>";
    echo "varNvAcesso: " . $varNvAcesso . "<br>";
    echo "varEmail: " . $varEmail . "<br>";
    echo "varSexo: " . $varSexo . "<br>";
    echo "varTel: " . $varTel . "<br>";
    echo "varCel: " . $varCel . "<br>";
    echo "_____________________________________________________________________________________<br>"; 
*/
     //echo "SESSION['usu']['chkLogin']: " . $_SESSION['usu']['chkLogin'] . "<br>";
 
    //if ($chkLogin!="OK") //Se chkLogin=OK, passa direto, já existe a session e já foi verificado o login
    //{

    // ============================================ Encriptando =======================================================
    //echo "Encriptando a senha  - Fazer rotina para gravar encriptando e retirar do banco e comparar.";
    // Encriptando a senha  - Fazer rotina para gravar encriptando e retirar do banco e comparar.
        $hash = Bcrypt::hash($varSenha);
        // $hash = $2a$08$MTgxNjQxOTEzMTUwMzY2OOc15r9yENLiaQqel/8A82XLdj.OwIHQm
        // Salve $hash no banco de 
    //    echo "hash: " . $hash . "<br>";
    // ================================================================================================================
    // Consulta existência
    $sqlProcura = "SELECT * from tab_usu WHERE TX_Login=". $varLogin;

    //SQL para cadastrar no banco  
    $sqlInsert = "INSERT INTO tab_usu (TX_Login,TX_Senha,TX_Nome,TX_Sobrenome,TX_Sexo,TX_Email,NR_NvAcesso,TX_Telefone,TX_Celular,";
    $sqlInsert .="NR_FaseFicha,TX_Matricula,DT_UltimoAcesso,HR_UltimoAcesso) ";
    $sqlInsert.= "VALUES ('". $varLogin . "', '" . $hash . "', '".$varNome."', '".$varSobrenome."', '".$varSexo."', '";
    $sqlInsert.=$varEmail."', " .$varNvAcesso.", '".$varTel."', '".$varCel."', null, null, null, null)";
    //echo "sqlInsert: " . $sqlInsert . "<br>";    

    //abre_conexao;  eX: "$pMysqli = new mysqli('p:'.DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);"
    $conexao = mysqli_connect('66.33.203.11', 'kartei', 'ktARI#19', 'dbkartei'); // Produção

    ////$conexao = mysqli_connect('localhost:3306', 'mydb', 'mypass#13', 'DBUpload'); // Produção
    // $conexao = mysqli_connect("mysql.cs2rio.com", "heritagehistory", "me22olatto", "hhdatabase"); // Site
    if (!$conexao ) {
        echo "Error: Connection with DB MySQL is fail." . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    else{
    ///echo "Sucesso ao conectar-se com a base de dados dbkartei (MySQL).<br>" . PHP_EOL; 
    }
    
    // Procura se já existe no nanco
    $rsProcura=mysqli_query($conexao, $sqlProcura);
    ///if (mysqli_num_rows($rsProcura)>0){// Usuário já existe
    ///    $msge="Usuário existente no banco. Tente outro login.";
    ///    echo msge;
        
//        $dados=mysqli_fetch_array($rsProcura, MYSQLI_NUM);
//        if ($dados[0]>1){echo "Usuário ja existe.";}
        
    ///}else{

        $rsInsert=mysqli_query($conexao, $sqlInsert);
    ///    $numLinhas=mysqli_num_rows($rsInsert);

    ///    if($numLinhas>0){ 
          //$_SESSION['usu'] = []; // inicia o array Session do Usuário
    ///      $_SESSION['usu']['msgInsert'] = "Dados de ". $varNome . " " . $varSobrenome . " gravados com sucesso";
    ///      echo "SESSION['usu']['msgInsert']: ". $_SESSION['usu']['msgInsert'];
            // Grava Log
            //   $sqlGravaLog="INSERT INTO tab_logs (TX_lOGIN,TX_Comando, DT_Login,HR_Login) VALUES(default, '".$varLogin."', '".$sqlInsert."', '".$dtLogin."', '".$hora."')";
            //   Executa a query (o recordset $rs contém o resultado da query)
            //   echo "sqlGravaLog: ". $sqlGravaLog;
            //   $rsLog=mysqli_query($conexao, $sqlGravaLog);
            // Fim grava Log
     ///       } else{
     ///           echo "ERROR: Não foi possível executar $sqlInsert. " . mysqli_error($conexao);
     ///       }
        // libera result set 
        //$rsLog->close();                  
        //fecha a conexão
        mysqli_close($conexao);
  ///  }// Fim else procura usuario
}// Fim else nível ADM
echo "<script>window.location.href = 'cadastroUsuario.php';</script>";
//header("Location:cadastroUsuario.php");
?>