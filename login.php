<!DOCTYPE html>
<html lang='en'>
    <head>
        <meta charset="UTF-8">
        <Title>Heritage History - Login KARTEI</title>
        <link href="css/login.css" rel="stylesheet">
        <script src="login.js"></script>
<?php
$varLogin=$_POST["TX_LOGIN"];//Pega o login do post
$varSenha=$_POST["TX_SENHA"];//Pega o login do post

if (isset($_COOKIE['langLogin']))
      {
        $langLogin=$_COOKIE["langLogin"];//$_SESSION["lang"]=$lang;        //$idioma="ale";
//  //echo " ENTRADA depois IF cookie: lang: " . "'".$langLogin."'" . " - _COOKIE[langLogin]: " ."'". $_COOKIE["langLogin"]. "<br>"; 
      }
      else
      {$langLogin='de';}  

if ($langLogin==='de')
        {
        $txLogin="Einloggen";
        $txSenha="Passwort";
        $txtNovaSenha="Neues passwort";
        $txConfSenha="Neues passwort - bestätigung";
        $linkEsqSenha="Ich habe mein passwort vergessen";
        $linkTroca="Passwort ändern";
        $txBotao="Anmelden";
        $msgLoginForgot="Ihr Passwort wurde an Ihre E-Mail geschickt. Bitte melden Sie sich erneut mit korrektem Login und Passwort an.";
        $msgLoginTrOK="Ihr Passwort wurde mit Erfolg geändert. Bitte melden Sie sich erneut mit neuem Passwort an.";
        $msgLoginTrNOK="Ihr Passwort hat sich nicht geändert. Bitte überprüfen Sie Ihre Anmeldung und Ihr Passwort und versuchen Sie es erneut.";
        $msgLoginNOK="Benutzer und / oder Passwort falsch(s).<br>Bitte füllen Sie Ihre Anmeldung und Passwort.";
        $msgLogin= "Bitte füllen Sie Ihre Anmeldung und Passwort.";
        }
    if ($langLogin==='en')
        {
        $txLogin="Login";
        $txSenha="Password";
        $txNovaSenha="New password";
        $txConfSenha="New password - confirmation";
        $linkEsqSenha="I forgot my password";
        $linkTroca="Change password";
        $txBotao="Go";
        $msgLoginForgot="Your password was sento to your e-mail. Please, try login again with correct login and password.";
        $msgLoginTrOK="Your password was changed with success. Please, login again with new password.";
        $msgLoginTrNOK="Your password didn't changed. Please, check your login and password and try it again.";
        $msgLoginNOK="User and/or password incorrect(s).<br>Please, fill your login and password";
        $msgLogin= "Please, fill your login and password.";
        }
    if ($langLogin==='po')
        {
        $txLogin="Login";
        $txSenha="Senha";
        $txNovaSenha="Nova senha";
        $txConfSenha="Nova senha - confirmação";
        $linkEsqSenha="Esqueci minha senha";
        $linkTroca="Trocar senha";
        $txBotao="Entrar";
        $msgLoginForgot="Sua senha foi enviada para seu e-mail. Por favor, tente novamente com usuário e senha corretos.";
        $msgLoginTrOK="Sua senha foi alterada com sucesso. Por favor, faça seu login com a nova senha.";
        $msgLoginTrNOK="Sua senha NÃO foi alterada. Por favor, verifique usuário e senha e tente novamente.";
        $msgLoginNOK="Usuário e/ou senha incorreto(s).<br>Por favor, entre com seu usuário e senha.";
        $msgLogin= "Por favor, entre com seu usuário e senha.";       
        }      

$minha_url= "http://" . $_SERVER["REQUEST_URI"] ; //$_SERVER['PHP_SELF']
  $chkLogin=isset($_GET['chkLogin'])?trim($_GET['chkLogin']):null;
  if($chkLogin!="undefined" AND $chkLogin!='')
    {
      $_SESSION['chkLogin']=$chkLogin; 
      if($chkLogin==="forgot")
        {$_SESSION["msgLogin"]=$msgLoginForgot;}
      if($chkLogin==="TrOK")
       { $_SESSION["msgLogin"]=$msgLoginTrOK;}
      if($chkLogin==="TrNOK")
       { $_SESSION["msgLogin"]=$msgLoginTrNOK;}
      if($chkLogin==="NOK")
       { $_SESSION["msgLogin"]=$msgLoginNOK;}

    }
    else { $_SESSION["msgLogin"]= $msgLogin;}
    
         ////echo "1 chkLogin: " . $chkLogin ." - SESSION[chkLogin]: " . $_SESSION["chkLogin"] . ". <br>";
         // //echo "2 msgLogin: " . $msgLogin ." - SESSION[msgLogin]: " . $_SESSION["msgLogin"] . ". <br>";
?>

</head>
<body>
<!-- inserir form de login -->
    <div><!--/.nav-collapse -->
      <ul class="menuIdioma">
        <li><a href="#" onClick='JavaScript:muda_idioma("de");'>Deutsch </a></li>
        <li><a href="#" onClick='JavaScript:muda_idioma("en");'>English </a></li>
        <li><a href="#" onClick='JavaScript:muda_idioma("po");'>Português </a></li>
      </ul>
      <div id="lIdioma" class="layerIdioma"><?php //echo $langLogin; ?></div>
    </div>
<div id="l_msg" class="msgLogin">
          <?php //echo $_SESSION["msgLogin"]; ?>
</div>        
<div id="l_LOGIN" class="layerLogin">
  <form name="FORM_LOGIN" method="post" action="relatorio_uploads.php">
      <div id="txtLogin" class="txLogin"><?php //echo $txLogin; ?></div>
      <input name="TX_LOGIN" type="text" maxlength="50" class="formLogin"><br>
      <div id="txtSenha" class="txLogin"><?php //echo $txSenha; ?></div>
      <input type="password" class="formLogin" name="TX_SENHA" maxlength="20" size="20"><br>
      <div id="l_trocaSenha" style="visibility:hidden;">
        <div id="txtNovaSenha" class="txLogin"><?php //echo $txNovaSenha; ?></div>
        <input type="password" class="formLogin" name="TX_NOVA_SENHA" maxlength="20" size="20" onBlur="confereSenha();"><br>
        <div id="txtConfSenha" class="txLogin"><?php //echo $txConfSenha; ?></div>
        <input type="password" class="formLogin" name="TX_NOVA_SENHA_CONF" maxlength="20" size="20" onBlur="confereSenha();"><br>
      </div>
      <input type="submit" class="bot_entrar" name="Entrar" value="<?php //echo $txBotao; ?>" onMouseOver="trbotao(this,'#00C');" onMouseOut="trbotao(this,'#333');" >
  </form>
  <br>  
  <a href="#" onClick="esqsenha();" class="esqsenha" onMouseOver="trmsg('esqueci');" onMouseOut="trmsg('nada');"><div id="lEsqSenha" class="lEsqsenha"><?php //echo $linkEsqSenha; ?></div></a><br>
  <a href="#" onClick="trocar_senha();" class="esqsenha" onMouseOver="trmsg('trocar');" onMouseOut="trmsg('nada');"><div id="lTrSenha" class="lEsqsenha"><?php //echo $linkTroca; ?></div></a> 
</div>
    <!-- Fim form login -->
</body>
</html>