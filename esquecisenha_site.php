<!DOCTYPE html>
<html lang='en'>
<head>
<title>Ferramenta de An&aacute;lise Mercadol&oacute;gica</title>
 <link href="css/relatorio.css" rel="stylesheet">
 <script src="login.js"></script>
<?php
// ESQUECI SENHA.php
// Inicialmente checará o login e a senha por sessão. Se OK, enviará e-mail com a senha. Se não encontrar,retornará à página de login.


// password-recovery?token=a1eb022055942da31a557da056f58648&id_customer=18313
// massa token e id pela URL
// aí manda confirmação de reset...
// e-mail com senha nova... gerada
!isset($_SESSION)?session_start():null;

global $conexao, $login, $sqlLogin, $nome, $varLogin,$chkLogin, $varSenha, $msgLogin, $chkLogin, $data , $hora;
$chkLogin=$_SESSION["chkLogin"];// Pega o chkLogin da Session
$login= filter_input_array(INPUT_POST, FILTER_DEFAULT);

$varLogin=$_POST["TX_LOGIN"];//Pega o login do post
$varSenha=$_POST["TX_SENHA"];//Pega o login do post

//echo "varLogin: " . $varLogin . "<br>";
//echo "varSenha: " . $varSenha . "<br>";
//echo "chkLogin: " . $chkLogin . "<br>";

if ($chkLogin!="OK"){ //Se chkLogin=OK, passa direto, já existe a session e já foi verificado o login
    //SQL para verificar o login
    $sqlLogin = "SELECT * FROM tab_usu WHERE TX_LOGIN='" . $varLogin . "' AND TX_SENHA='" . $varSenha . "'";
    //echo sqlLogin . "<br>";          
    //abre_conexao  -          HOST               USUARIO           SENHA          BASE
    $conexao = mysqli_connect('66.33.203.11', 'kartei', 'ktARI#19', 'dbkartei'); // Produção
    //$conexao = mysqli_connect("mysql.cs2rio.com", "heritagehistory", "me22olatto", "hhdatabase"); // site

    if (!$conexao ) {
        echo "Error: Connection with DB MySQL is fail." . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    else{
    //echo "Sucesso ao conectar-se com a base de dados DBUpload (MySQL).<br>" . PHP_EOL; 
    }
    // query SQL
    $sqlLogin="select * from tab_usu Where TX_Login='" . $varLogin . "'";
    // Executa a query (o recordset $rs contém o resultado da query)
    $rsLogin=mysqli_query($conexao, $sqlLogin);
    while($dadosLogin=mysqli_fetch_assoc($rsLogin)) {
        //echo "e-mail: ".$dadosLogin['TX_Email']." - Login: ".$dadosLogin['TX_Login']." - Senha: ".$dadosLogin['TX_Senha']. " - Data: ". $data . " - Hora: ". $hora . '<br>';
    }
    $numLinhas=mysqli_num_rows($rsLogin);
    //    echo " >> num_rows(rsLogin): " . $numLinhas . " ||| varLogin: " . $varLogin . "<br>"; 
    if ($numLinhas<=0) {// checar com e-mail em vez do login 
        // query SQL
        $sqlLoginEmail="select * from tab_usu Where TX_Email='" . $varLogin . "'";
        // Executa a query (o recordset $rs contém o resultado da query)
        $rsLoginEmail=mysqli_query($conexao, $sqlLoginEmail);
        while($dadosLoginEmail=mysqli_fetch_assoc($rsLoginEmail)) {
            //echo "e-mail: ".$dadosLogin['TX_Email']." - Login: ".$dadosLogin['TX_Login']." - Senha: ".$dadosLogin['TX_Senha']. " - Data: ". $data . " - Hora: ". $hora . '<br>';
        }
        $numLinhasEmail=mysqli_num_rows($rsLoginEmail);
        //echo " >> num_rows(rsLogin): " . $numLinhas . " ||| varLogin: " . $varLogin . "<br>"; 
            if ($numLinhasEmail<=0) { //Sem registros - Volta para Login
                $chkLogin="NOK";
                $msgLogin="Login and/or password incorret(s). Try again, please or ask for your password.";
              //echo "LOGIN NOK: msgLogin: ".$msgLogin." - chkLogin: ".$chkLogin." - SESSION[chkLogin]: ".$_SESSION["chkLogin"]. " - SESSION[varLogin]: ". $_SESSION["varLogin"] . '<br>';
                header("Location:login.php?chkLogin=NOK");
                die();
            }
            else{// encontrou - Enviar e-mail com senha
                 // setcookie("login",$login);
                 // envia e-mail
                 $login=$dadosLoginEmail['TX_Login'];
                 $passw=$dadosLoginEmail['TX_Senha'];
                 $email=$dadosLoginEmail['TX_Email'];
            }
        }
        else {// encontrou - Enviar e-mail com senha
             // setcookie("login",$login);
             // envia e-mail
             $login=$dadosLogin['TX_Login'];
             $passw=$dadosLogin['TX_Senha'];
             $email=$dadosLogin['TX_Email'];
             echo '<script> alert("Iniciando envio do e-mail...");</script>';

            // Compor E-mail
            $arquivo = "
            <style type='text/css'>
            body {
            margin:0px;
            font-family:Verdane;
            font-size:12px;
            color: #006;
            }
            a{
            color: #00f;
            text-decoration: none;
            }
            a:hover {
            color: #F00;
            text-decoration: none;
            }
            </style>
              <html>
                 <table width='200' border='1' cellpadding='1' cellspacing='1' bgcolor='#CCCCCC'>
                 <tr><td width='200'>Login:$login</td></tr>
                 <tr><td width='200'>password:<b>$passw</b></td></tr>
                 </table>
              </html>
             ";
             $mensagem = "Your login:".$login. " and password: ". $passw. " Heritage History. Delete this email." ;

             // emails para quem será enviado o formulário
             $emailenviar = "it@heritageandhistory.ch";
             $destino = $email;
             $assunto = "Your password Heritage History - Delete after read. ";

             // É necessário indicar que o formato do e-mail é html
             $headers  = 'MIME-Version: 1.0' . "\r\n";
             $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
             $headers .= 'From: Heritage History <it@heritageandhistory.ch>';
             //$headers .= "Bcc: $EmailPadrao\r\n";

             $enviaremail = mail($destino, $assunto, $arquivo, $headers);
             if($enviaremail){
             $mgm = "Your password was sento with success to ". $email;
             //echo " <meta http-equiv='refresh' content='10;URL=contato.php'>";
             } 
             else {
               $mgm = "ERRO AO ENVIAR E-MAIL!";
               echo "";
             }    
        }
        // FIM envia e-mail
     // fecha a conexão
     mysqli_close($conexao);
     header("Location:login.php?chkLogin=forgot");
     die();
    }
?>
</body>
</html>