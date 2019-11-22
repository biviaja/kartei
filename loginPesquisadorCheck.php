<?php 
// inicia a sessão
// < ?php !isset($_SESSION)?session_start():null; ? > 
 !isset($_SESSION)?session_start():null;
 //session_start();
 //session_name();
 //echo " session_name(): ". session_name()."<br/>";
 //echo " session_id(): ". session_id()."<br/>";
 global $chkLogin,$msgLogin,$varLogin;
 
 !isset($_SESSION['usu']['chkLogin'])?$_SESSION['usu']['chkLogin']='':null; 
 !isset($_SESSION['usu']['msgLogin'])?$_SESSION['usu']['msgLogin']='':null; 
 !isset($_SESSION['usu']['varLogin'])?$_SESSION['usu']['varLogin']='':null; 
 
 //echo "lPC: 0- Check: Session_status: ". session_status()."<br/>";
 //echo "lPC: 0 chkLogin: " . $chkLogin ." - SESSION['usu']['chkLogin']: " . $_SESSION['usu']['chkLogin'] . ". <br/>";
 //echo "lPC: 0 msgLogin: " . $msgLogin ." - SESSION['usu']['msgLogin']: " . $_SESSION['usu']['msgLogin'] . ". <br/>";
 //echo "lPC: 0 varLogin: " . $varLogin ." - SESSION['usu']['varLogin']: " . $_SESSION['usu']['varLogin'] . ". <br/>";
 //echo "_________________________________________________________________________________________________________________________________ <br/>";
 ?>
 <?php 
  include "geraSenha.php";
 ?>

<html>
<head>
<meta charset="UTF-8">
<title>Heritage History - Login Checker</title>
<link href="css/login.css" rel="stylesheet">
<script src="login.js"></script>

<?php
    // Inicialmente checará o login e a senha por sessão. Se OK, abrirá a página, senão, retornará à página de login.
    //if(!isset($_SESSION))
    //{
    // inicia a sessão
    //    session_start();
    //    session_name();
        //echo "0- Check:Session name: ". session_name()."<br/>";
        //echo "0- Check: Session_status: ". session_status()."<br/>";
    //}

    //echo "PHPSESSID: " . $_SERVER['PHPSESSID']."<br/>" ;
    //echo "Vai checar o login:<br/>";
        
    global $conexao,$usu,$login,$sqlLogin,$nome,$sobrenome,$varsexo,$varLogin,$chkLogin,$varSenha,$msgLogin,$data ,$hora,$varTel,$varCel,$varEmail;
    global $numLinhas, $numLinhas2,$dadosEncriptados,$rsSenhaEncriptada;
    $chkLogin=$_SESSION['usu']['chkLogin'];// Pega o chkLogin da Session
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

    //echo "Entrando na página loginPesquisadorCheck.php </br>";
    //echo "<script>window.alert('Login: '. $varLogin);</script>";

    $varLogin=filter_input(INPUT_POST , 'TX_LOGIN');
    $varSenha=filter_input(INPUT_POST , 'TX_SENHA');

   //echo "pré-chk > varLogin: " . $varLogin . "<br>";
   //echo "pré-chk > varSenha: " . $varSenha . "<br>";
   //echo "pré-chk > chkLogin: " . $chkLogin . "<br>";
   // echo "pré-chk > SESSION['usu']['chkLogin']: " . $_SESSION['usu']['chkLogin'] . "<br>";
    //if ($chkLogin!="OK") //Se chkLogin=OK, passa direto, já existe a session e já foi verificado o login
    //{
    //SQL para verificar o login
    $sqlLogin = "SELECT * FROM tab_usu WHERE TX_Login='" . $varLogin . "' AND TX_Senha='" . $varSenha . "'";
    //echo "sqlLogin: " . $sqlLogin . "<======================= <br>";   

    //abre_conexao;  eX: "$pMysqli = new mysqli('p:'.DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);"
    $conexao = mysqli_connect('66.33.203.11', 'kartei', 'ktARI#19', 'dbkartei'); // Produção
   //$conexao = mysqli_connect('localhost:3306', 'kartei', 'ktARI#19', 'DBkartei'); // Produção

    ////$conexao = mysqli_connect('localhost:3306', 'mydb', 'mypass#13', 'DBUpload'); // Produção
    // $conexao = mysqli_connect("mysql.cs2rio.com", "heritagehistory", "me22olatto", "hhdatabase"); // Site
    if (!$conexao ) {
        echo "Error: Connection with DB MySQL is fail." . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    else{
    //echo "Sucesso ao conectar-se com a base de dados DBUpload (MySQL).<br>" . PHP_EOL; 
    }
    
    // query SQL
    $sqlLogin="select * from tab_usu Where TX_Login='" . $varLogin . "' AND TX_Senha='" . $varSenha . "'";
    // Executa a query (o recordset $rs contém o resultado da query)
    $rsLogin=mysqli_query($conexao, $sqlLogin);
    $data = new DateTime();
    $dtLogin=date('d/m/Y');

    $hora=date('H:i:s');
   // echo "Hora: ".$hora;

    while($dadosLogin=mysqli_fetch_assoc($rsLogin))
        {
 //       //echo "e-mail: ".$dadosLogin['TX_Email']." - Login: ".$dadosLogin['TX_Login']." - Senha: ".$dadosLogin['TX_Senha']. " - Data: ". $data->format('d/m/Y') . " - Hora: ". $data->format('H:i:s') ." = ".$dadosLogin['TX_Telefone'] ." = ". '<br>';
        
        $_SESSION['ficha'] = []; // inicia o array Session das Fichas
        $_SESSION['usu'] = []; // inicia o array Session do Usuário
        $_SESSION['usu']['varNome'] = $dadosLogin['TX_Nome'];
        $_SESSION['usu']['varSobrenome'] =$dadosLogin['TX_Sobrenome'];
        $_SESSION['usu']['varSexo'] = $dadosLogin['TX_Sexo'];
        $_SESSION['usu']['varEmail'] = $dadosLogin['TX_Email'];
        $_SESSION['usu']['varTel'] = $dadosLogin['TX_Telefone'];
        $_SESSION['usu']['varCel'] =$dadosLogin['TX_Celular'];
        $_SESSION['usu']['varLogin'] = $dadosLogin['TX_Login'];
        $_SESSION['usu']['nvAcesso']=$dadosLogin['NR_NvAcesso'];
        
//        echo "SESSION['usu'][varNome]:". $_SESSION['usu']['varNome']."<br/>" ;
//        echo "SESSION['usu'][varSobrenome]: ". $_SESSION['usu']['varSobrenome']."<br/>" ; 
//        echo "SESSION['usu'][varSexo]: ". $_SESSION['usu']['varSexo']."<br/>" ;
//        echo "SESSION['usu'][varTel]: " . $_SESSION['usu']['varTel']."<br/>" ;
//        echo "SESSION['usu'][varCel]: " . $_SESSION['usu']['varCel'] ."<br/>" ;
//        echo "SESSION['usu'][varEmail]: " . $_SESSION['usu']['varEmail'] ."<br/>" ;
//        echo "SESSION['usu']['varLogin']: " . $_SESSION['usu']['varLogin'] ."<br/>" ;
//        echo "SESSION['usu']['nvAcesso']: " . $_SESSION['usu']['nvAcesso'] ."<br/>" ;
        
        //echo "Check: Session name: ". session_name()."<br/>";
        //echo "Check: session_status: ". session_status()."<br/>";
        //echo "--------------------------------------------------------------------<br/>" ;
        
        }
        $numLinhas=mysqli_num_rows($rsLogin);
        
        if ($numLinhas<=0 || $varLogin !== $_SESSION['usu']['varLogin'] )      
        { //Sem registros - Volta para Login
            
            // ================  Pesquisa a senha (pode estar encriptada)
        // chave 
            $sqlLoginHash="select * from tab_usu Where TX_Login='" . $varLogin. "'";
           // echo "sqlLoginHash: " . $sqlLoginHash . "<br/>";
            // Executa a query (o recordset $rs contém o resultado da query)
            $rsSenhaEncriptada=mysqli_query($conexao, $sqlLoginHash);                    
            $numLinhas2=mysqli_num_rows($rsSenhaEncriptada);
            
            while($dadosEncriptados=mysqli_fetch_assoc($rsSenhaEncriptada))
            {
            //echo " Login: ".$dadosEncriptados['TX_Login']." - Senha: ".$dadosEncriptados['TX_Senha']. '<br>';
            $varSenhaEncriptada=$dadosEncriptados['TX_Senha'];
            $varLogin=$dadosEncriptados['TX_Login'];
            $varNome=$dadosEncriptados['TX_Nome'];
            $varSobrenome=$dadosEncriptados['TX_Sobrenome'];
            $varSexo=$dadosEncriptados['TX_Sexo'];
            $varTel=$dadosEncriptados['TX_Telefone'];
            $varCel=$dadosEncriptados['TX_Celular'];
            $varEmail=$dadosEncriptados['TX_Email'];
            
            /*
            echo "<br/>varSenhaEncriptada de " . $varLogin . ": " . $varSenhaEncriptada . "<br/>";
            echo "varLogin: ".$varLogin. "<br/>";
            echo "varNome: ". $varNome. "<br/>";
            echo "varSobrenome: ". $varSobrenome. "<br/>";
            echo "varSexo: ".$varSexo. "<br/>";  
            echo "varEmail: ".$varEmail. "<br/>";  
            */
            
            
           // $varSenhaEncriptada=$rsSenhaEncriptada->fetch_row()[5];
           // $varLogin=$rsSenhaEncriptada->fetch_row()[4];
           // $varNome=$rsSenhaEncriptada->fetch_row()[1];
           // $varSobrenome=$rsSenhaEncriptada->fetch_row()[2];
           // $varSexo=$rsSenhaEncriptada->fetch_row()[3];
           // echo " >> num_rows(rsSenhaEncriptada): " . $numLinhas2 . " ||| varLogin: " . $varLogin . "<br>";
            // ============================================ Decriptando ======================================================
            // Verificando a senha
            //    echo "if (Bcrypt::check( " . $varSenha . "," . $varSenhaEncriptada." )<br/>"; 
                if (Bcrypt::check($varSenha, $varSenhaEncriptada)) {
                    $msgLogin="";
                    $chkLogin="OK";
                    $_SESSION['usu']['chkLogin'] = $chkLogin;
                    $_SESSION['usu']['varLogin'] = $varLogin;
                    $_SESSION['usu']['varNome']=$varNome;
                    $_SESSION['usu']['varSobrenome']=$varSobrenome;
                    $_SESSION['usu']['varSexo']=$varSexo;
                    $_SESSION['usu']['varTel']=$varTel;
                    $_SESSION['usu']['varCel']=$varCel;
                    $_SESSION['usu']['varEmail'] = $varEmail;

                    /*
                    echo "Bcrypt> SESSION['usu']['chkLogin']: ". $_SESSION['usu']['chkLogin'] . "<br/>";
                    echo "Bcrypt> SESSION['usu']['varLogin']:" . $_SESSION['usu']['varLogin']. "<br/>";
                    echo "Bcrypt> SESSION['usu']['varNome']: " . $_SESSION['usu']['varNome']. "<br/>";
                    echo "Bcrypt> SESSION['usu']['varSobrenome']: " . $_SESSION['usu']['varSobrenome']. "<br/>";
                    echo "Bcrypt> SESSION['usu']['varSexo']: " . $_SESSION['usu']['varSexo']. "<br/>";
                    */
                    
                    //$varData="STR_TO_DATE( $dtLogin, '%d/%m/%Y - %H:%i:%s);
                    //$varHora=STR_TO_DATE($hora, "%H:%i:%s");

                    // Grava login
                    $sqlGravaLogin="INSERT INTO tab_logins (id_LOGIN,TX_Login,DT_Login,HR_Login) VALUES(default, '".$varLogin."', '".$dtLogin."', '".$hora."')";
                 // Executa a query (o recordset $rs contém o resultado da query)

                   // echo "sqlGravaLogin: ". $sqlGravaLogin;
                    //$rsLogins=mysqli_query($conexao, $sqlGravaLogin);
                    if(mysqli_query($conexao, $sqlGravaLogin)){
                        //mysqli_fetch_assoc($rsLogins);
                        //echo "Records inserted successfully.";
                    } else{
                        echo "ERROR: Could not able to execute $sql. " . mysqli_error($conexao);
                    }
                    //echo "krypt: header('Location:HomeDoPesquisador.php');";     
                   // header("Location:HomeDoPesquisador.php");    
                    echo "<script>window.location.href='HomeDoPesquisador.php';</script>";
                    die;
                    } else {
                        //echo 'Senha incorreta!';
            
                        $chkLogin="NOK";
                        //$msgLogin="Login and/or password incorret(s). Try again, please or ask for your password.";
                        $_SESSION['usu']['chkLogin']=$chkLogin;
                        $_SESSION['usu']['varLogin']=$varLogin;
                        $_SESSION['usu']['msgLogin']=$msgLoginNOK;
                        //$msgLogin="Login and/or password incorret(s). Try again, please or ask for your password.";
                    
                       //  echo "<br/> ------------------------------------------------------------------------------------------------------- <br/>";
                       //  echo "1- lPC: LOGIN NOK: msgLogin: ".$msgLoginNOK."<br/>";
                       //  echo "1- lPC: chkLogin: ".$chkLogin." - SESSION['usu']['chkLogin']: ".$_SESSION['usu']["chkLogin"]. " - SESSION['usu']['varLogin']: ". $_SESSION['usu']['varLogin'] . '<br/>';
                       //  echo "1- lPC: SESSION['msgLogin']= ".$_SESSION['usu']['msgLogin'];
                       //  echo '<script> alert("chk>> chkLogin: ' . $chkLogin .' - SESSION[chkLogin]: ' . $_SESSION["chkLogin"] . '");';
                       //  echo 'alert("chk>> msgLogin: ' . $msgLogin .' - SESSION[msgLogin]: ' . $_SESSION["msgLogin"] . '");</script> ';
                       //$_SESSION['usu']['chkLogin']="NOK";    
                       //echo "chkLogin=NOK - header('Location:index.php')";
                       header('Location:index.php');
                       die();
                    } // else
                }// ================================================================================================================
            }    

        else
            { // encontrou
              // setcookie('login",$varLogin);
            $msgLogin="";
            $chkLogin="OK";

            $_SESSION['usu']['chkLogin'] = $chkLogin;	
            //echo "--------------------------------------------------------------------<br/>" ;
            //echo "pós-chk > chkLogin: " . $_SESSION['usu']['chkLogin'] . "<br>";
            //echo "--------------------------------------------------------------------<br/>" ;
        
            $_SESSION['usu']['varLogin'] = $varLogin;
            //$varData="STR_TO_DATE( $dtLogin, '%d/%m/%Y - %H:%i:%s);
            //$varHora=STR_TO_DATE($hora, "%H:%i:%s");

            // Grava login
            $sqlGravaLogin="INSERT INTO tab_logins (TX_Login,DT_Login,HR_Login) VALUES('".$varLogin."', '".$dtLogin."', '".$hora."')";
         // Executa a query (o recordset $rs contém o resultado da query)

            //echo "sqlGravaLogin: ". $sqlGravaLogin;
            //$rsLogins=mysqli_query($conexao, $sqlGravaLogin);
            if(mysqli_query($conexao, $sqlGravaLogin)){
                //mysqli_fetch_assoc($rsLogins);
                //echo "Records inserted successfully.";
            } else{
                echo "ERROR: Could not able to execute $sqlGravaLogin. " . mysqli_error($conexao);
            }


            //response.Redirect("HomeDoPesquisador.php.php") 
           // echo "chk>> chkLogin: " . $chkLogin ." - SESSION[chkLogin]: " . $_SESSION['usu']['chkLogin'] . "<br>";
           // echo "Antes de chamar a página do Pesquisador> SESSION[usu][varSexo]: ". $_SESSION['usu']['varSexo']."<br/>" ;
          
           //echo "header('Location:HomeDoPesquisador.php');";
           echo "<script>window.location.href = 'HomeDoPesquisador.php';</script>";
           //die();
             //echo "Login OK: msgLogin: ".$msgLogin." - chkLogin: ".$chkLogin." - SESSION[chkLogin]: ".$_SESSION["chkLogin"]. " |||  SESSION[varLogin]: ". $_SESSION["varLogin"] . '<br>';
            }	
       //fecha a conexão
       mysqli_close($conexao);
    //} else {
    //        header("Location:HomeDoPesquisador.php");
    //}
       die();
?>
</head>
<body>
</body>
</html>

