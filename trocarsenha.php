<!DOCTYPE html>
<html lang='en'>
<head>
<title>Heritage History - Changing password</title>
 <link href="css/relatorio.css" rel="stylesheet">
 <script src="login.js"></script>
<?php
// TROCAR SENHA.php
// Inicialmente checará o login e a senha por sessão. Se OK, enviará e-mail com a senha. Se não encontrar,retornará à página de login.

global $conexao, $login, $sqlLogin, $nome, $varLogin,$chkLogin, $varSenha, $msgLogin, $chkLogin, $data , $hora;
$chkLogin=$_SESSION["chkLogin"];// Pega o chkLogin da Session
$login= filter_input_array(INPUT_POST, FILTER_DEFAULT);

$varLogin=$_POST["TX_LOGIN"];//Pega o login do post
$varSenha=$_POST["TX_SENHA"];//Pega o login do post

//echo "varLogin: " . $varLogin . "<br>";
//echo "varSenha: " . $varSenha . "<br>";
//echo "chkLogin: " . $chkLogin . "<br>";

//if ($chkLogin!="OK") //Se chkLogin=OK, passa direto, já existe a session e já foi verificado o login
//{
//SQL para verificar o login
$sqlLogin = "SELECT * FROM tab_usu WHERE TX_LOGIN='" . $varLogin . "' AND TX_SENHA='" . $varSenha . "'";
//echo sqlLogin . "<br>";   

//abre_conexao;
//$conexao = mysqli_connect("mysql.cs2rio.com", "heritagehistory", "me22olatto", "hhdatabase");
$conexao = mysqli_connect('66.33.203.11', 'kartei', 'ktARI#19', 'dbkartei'); // Produção
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
while($dadosLogin=mysqli_fetch_assoc($rsLogin))
    {
    //echo "e-mail: ".$dadosLogin['TX_Email']." - Login: ".$dadosLogin['TX_Login']." - Senha: ".$dadosLogin['TX_Senha']. " - Data: ". $data . " - Hora: ". $hora . '<br>';
    }
    $numLinhas=mysqli_num_rows($rsLogin);
//    echo " >> num_rows(rsLogin): " . $numLinhas . " ||| varLogin: " . $varLogin . "<br>"; 
    if ($numLinhas<=0)      
        {// checar com e-mail em vez do login 
        // query SQL
            $sqlLoginEmail="select * from tab_usu Where TX_Email='" . $varLogin . "' AND TX_Senha='" . $varSenha . "'";
            // Executa a query (o recordset $rs contém o resultado da query)
            $rsLoginEmail=mysqli_query($conexao, $sqlLoginEmail);
            while($dadosLoginEmail=mysqli_fetch_assoc($rsLoginEmail))
                {
                //echo "e-mail: ".$dadosLogin['TX_Email']." - Login: ".$dadosLogin['TX_Login']." - Senha: ".$dadosLogin['TX_Senha']. " - Data: ". $data . " - Hora: ". $hora . '<br>';
                }
                $numLinhasEmail=mysqli_num_rows($rsLoginEmail);
            //    echo " >> num_rows(rsLogin): " . $numLinhas . " ||| varLogin: " . $varLogin . "<br>"; 
                if ($numLinhasEmail<=0)   
                {
                ////Sem registros - Volta para Login
                  //$chkLogin="NOK";
                  //$msgLogin="Login and/or password incorret(s). Try again, please or ask for your password.";
                  //echo "LOGIN NOK: msgLogin: ".$msgLogin." - chkLogin: ".$chkLogin." - SESSION[chkLogin]: ".$_SESSION["chkLogin"]. " - SESSION[varLogin]: ". $_SESSION["varLogin"] . '<br>';
                  header("Location:login.php?chkLogin=NOK");
                  die();
                }
                 else
                    {// encontrou - Enviar e-mail com senha
                     // setcookie("login",$login);
                     // envia e-mail
                     $login=$dadosLoginEmail['TX_Login'];
                     $passw=$dadosLoginEmail['TX_Senha'];
                     $email=$dadosLoginEmail['TX_Email'];
                    }
        }
        else
        {// encontrou - Enviar e-mail com senha
         // setcookie("login",$login);
         // envia e-mail
         $login=$dadosLogin['TX_Login'];
         $passw=$dadosLogin['TX_Senha'];
         $email=$dadosLogin['TX_Email'];
        echo '<script> alert("Iniciando envio do e-mail...");</script>';

        // Compo E-mail
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
          $emailenviar = "charles@cs2rio.com";
          $destino = $email;
          $assunto = "Your password Heritage History - Delete after read. ";

          // É necessário indicar que o formato do e-mail é html
          $headers  = 'MIME-Version: 1.0' . "\r\n";
              $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
              $headers .= 'From: Heritage History <charles@cs2rio.com>';
          //$headers .= "Bcc: $EmailPadrao\r\n";

          $enviaremail = mail($destino, $assunto, $arquivo, $headers);
          if($enviaremail){
          $mgm = "Seu e-mail foi enviado com sucesso <br> O link será enviado para ". $email;
          //echo " <meta http-equiv='refresh' content='10;URL=contato.php'>";
          } else {
          $mgm = "ERRO AO ENVIAR E-MAIL!";
          echo "";
          }    
         }
         // FIM envia e-mail
// fecha a conexão
mysqli_close($conexao);
?>


<!-- Fim Script para login -->
<?php
$varLogin=$_POST["TX_LOGIN"];//Pega o login do post
$varSenha=$_POST["TX_SENHA"];//Pega o login do post

$minha_url= "http://" . $_SERVER["REQUEST_URI"] ; //$_SERVER['PHP_SELF']
  $chkLogin=isset($_GET['chkLogin'])?trim($_GET['chkLogin']):null;
  if($chkLogin!="undefined" AND $chkLogin!='')
    {
      $_SESSION['chkLogin']=$chkLogin; 
      if($chkLogin==="forgot")
        {$_SESSION["msgLogin"]="Your password was sento to your e-mail. Please, try login again with correct login and password.";}
      if($chkLogin==="changed")
       { $_SESSION["msgLogin"]="Your password was sento to your e-mail. Please, try login again with correct login and password.";}
      if($chkLogin==="NOK")
       { $_SESSION["msgLogin"]="Your password was changed wit success. Please, login again with new password.";}
    }
    else { $_SESSION["msgLogin"]= "Please, fill your login and password.";}
    
         //echo "1 chkLogin: " . $chkLogin ." - SESSION[chkLogin]: " . $_SESSION["chkLogin"] . ". <br>";
         // echo "2 msgLogin: " . $msgLogin ." - SESSION[msgLogin]: " . $_SESSION["msgLogin"] . ". <br>";
?>
</head>
<body>
<!-- inserir form de login -->
<div id="l_msg" class="msgLogin">
          <?php echo $_SESSION["msgLogin"]; ?>
</div>
<div id="l_LOGIN" class="layerLogin">
  <form name="FORM_LOGIN" method="post" action="relatorio_uploads.php">
      <a href="#" class="txLogin">Login</a><br>
      <input name="TX_LOGIN" type="text" maxlength="50" class="formLogin"><br>
      <span class="txLogin">Your Password</span><br>
      <input type="password" class="formLogin" name="TX_SENHA" maxlength="20" size="20"><br>
      <span class="txLogin">New Password</span><br>
      <input type="password" class="formLogin" name="TX_NOVA_SENHA" maxlength="20" size="20"><br>
      <span class="txLogin">New Password Confirmation</span><br>
      <input type="password" class="formLogin" name="TX_NOVA_SENHA_CONF" maxlength="20" size="20"><br>
      <input type="submit" class="bot_entrar" name="Entrar" value="Entrar" onMouseOver="trbotao(this,'#00C');" onMouseOut="trbotao(this,'#333');" >
  </form>
  <br>
  <a href="#" onClick="esqsenha();" class="esqsenha" onMouseOver="trmsg('esqueci');" onMouseOut="trmsg('nada');">Forgot password</a><br>
  <a href="#" onClick="trocar_senha();" class="esqsenha" onMouseOver="trmsg('trocar');" onMouseOut="trmsg('nada');">Change password</a> 
</div>
    <!-- Fim form login -->
</body>
</html>