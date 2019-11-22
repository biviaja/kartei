/* 
Script para Login by LH.
 */
function muda_idioma(idioma)
{
    //alert("Mudar("+idioma+" - idi: "+document.getElementById("lIdioma").innerHTML +")");
    document.getElementById("lIdioma").innerHTML=idioma;
    if (idioma==='de')
        {
        document.getElementById("txtLogin").innerHTML="Einloggen";
        document.getElementById("txtSenha").innerHTML="Passwort";
        document.getElementById("txtNovaSenha").innerHTML="Neues passwort";
        document.getElementById("txtConfSenha").innerHTML="Neues passwort - bestÃ¤tigung";
        document.getElementById("lEsqSenha").innerHTML="Ich habe mein passwort vergessen";
        document.getElementById("lTrSenha").innerHTML="Passwort Ã¤ndern";
        document.FORM_LOGIN.Entrar.value="Anmelden";
        document.getElementById("l_msg").innerHTML="Bitte fÃ¼llen Sie Ihre Anmeldung und Passwort.";
        }
    if (idioma==='en')
        {
        document.getElementById("txtLogin").innerHTML="Login";
        document.getElementById("txtSenha").innerHTML="Password";
        document.getElementById("txtNovaSenha").innerHTML="New password";
        document.getElementById("txtConfSenha").innerHTML="New password - confirmation";
        document.getElementById("lEsqSenha").innerHTML="I forgot my password";
        document.getElementById("lTrSenha").innerHTML="Change password";
        document.FORM_LOGIN.Entrar.value="Go";
        document.getElementById("l_msg").innerHTML="Please, fill your login and password.";
        }
    if (idioma==='po')
        {
        document.getElementById("txtLogin").innerHTML="Login";
        document.getElementById("txtSenha").innerHTML="Senha";
        document.getElementById("txtNovaSenha").innerHTML="Nova senha";
        document.getElementById("txtConfSenha").innerHTML="Nova senha - confirmação";
        document.getElementById("lEsqSenha").innerHTML="Esqueci minha senha";
        document.getElementById("lTrSenha").innerHTML="Trocar senha";
        document.FORM_LOGIN.Entrar.value="Entrar";
        document.getElementById("l_msg").innerHTML="Por favor, entre com seu usuário e senha.";
        }
    registra_cookie(idioma);
}
function trbotao(botao,cor)
{botao.style.color=cor;
// Troca cor do botao SETA, das fotos
}

function trmsg(msg)
{// Troca mensagem
 if (msg==='esqueci')
    {
        if(document.getElementById("lIdioma").innerHTML==="de"){
            mensagem="Bitte geben Sie Ihren Benutzernamen oder Ihre E-Mail-Adresse in das Feld 'Einloggen' ein und klicken Sie auf 'Ich habe mein Passwort vergessen'.<br>Sie erhalten Ihr Passwort in Ihrer E-Mail.";
        }
        if(document.getElementById("lIdioma").innerHTML==="en"){
            mensagem="Please, enter your user name or e-mail in the 'Login' field and click on 'I forgot my password'.<br>You will receive your password in your e-mail.";
        }
        if(document.getElementById("lIdioma").innerHTML==="po"){
            mensagem="Por favor, entre com seu login ou e-mail no campo 'Login' e clique em 'Esqueci minha senha'.<br>Você receberá sua senha em seu e-mail.";
        }
    }
 if (msg==='trocar')	
    {
        if(document.getElementById("lIdioma").innerHTML==="de")
        {mensagem="Klicken Sie hier, um Ihr Passwort zu Ã¤ndern.";}
        if(document.getElementById("lIdioma").innerHTML==="en")
        {mensagem="Click here to change your password.";}
        if(document.getElementById("lIdioma").innerHTML==="po")
        {mensagem="Clique para trocar sua senha.";}		
    }
if (msg==='nada')	
	{
            mensagem="";
        }
    document.getElementById("l_msg").innerHTML=mensagem;
}

function trocar_senha()
{
 if (document.getElementById("l_trocaSenha").style.visibility==="hidden")
 {  document.getElementById("l_trocaSenha").style.visibility="visible";
    
    msg_de="Bitte geben Sie Ihr Login, Passwort, neues Passwort ein und bestÃ¤tigen Sie das neue Passwort. Dann klicken Sie auf Swap.";
    msg_en="Please enter your login, password, new password and confirm the new password. Then click on swap.";
    msg_po="Por favor, entre com seu login, senha, nova senha e confirme a nova senha. Depois clique em trocar.";
    if(document.getElementById("lIdioma").innerHTML==="de")
    {
        document.getElementById("l_msg").innerHTML=msg_de;
        document.FORM_LOGIN.Entrar.value="Swap";
    }
    if(document.getElementById("lIdioma").innerHTML==="en")
    {
        document.getElementById("l_msg").innerHTML=msg_po;
        document.FORM_LOGIN.Entrar.value="Change";
    }
    if(document.getElementById("lIdioma").innerHTML==="po")
    {
        document.getElementById("l_msg").innerHTML=msg_po;
        document.FORM_LOGIN.Entrar.value="Trocar";
    }
}
else
{
    document.getElementById("l_trocaSenha").style.visibility="hidden";

    msg_de="Bitte geben Sie Ihre Anmeldung und Ihr Passwort ein.";
    msg_en="Please enter your login and password.";
    msg_po="Por favor, entre com seu login e senha.";
    if(document.getElementById("lIdioma").innerHTML==="de")
    {
        document.getElementById("l_msg").innerHTML=msg_de;
        document.FORM_LOGIN.bot_entrar.value="Anmelden";
    }
    if(document.getElementById("lIdioma").innerHTML==="en")
    {
        document.getElementById("l_msg").innerHTML=msg_po;
        document.FORM_LOGIN.bot_entrar.value="Go";
    }
    if(document.getElementById("lIdioma").innerHTML==="po")
    {
        document.getElementById("l_msg").innerHTML=msg_po;
        document.FORM_LOGIN.bot_entrar.value="Entrar";
    }
    
    }
}

function esqsenha()
{
	// Tem de trocar ACTION do FORM para poder enviar os dados
	//window.alert("Esqueci a senha");
	login=document.FORM_LOGIN.TX_LOGIN.value;
    if(login===""){
            if (document.getElementById("lIdioma").innerHTML==="de"){
               msg="Bitte geben Sie Ihren Benutzernamen oder Ihre E-Mail-Adresse in das Feld 'Einloggen' ein und klicken Sie auf 'Ich habe mein Passwort vergessen'.\nSie erhalten Ihr Passwort in Ihrer E-Mail.";
            }
            if (document.getElementById("lIdioma").innerHTML==="en"){
               msg="Please, enter your user name or e-mail in the 'Login' field and click on 'I forgot my password'.\nYou will receive your password in your e-mail.";
            }
            if (document.getElementById("lIdioma").innerHTML==="po"){
               msg="Por favor, entre com seu login ou e-mail no campo 'Login' e clique em 'Esqueci minha senha'.\nVocê receberá sua senha em seu e-mail.";
            }
        window.alert(msg);
    }
    
    if(login.length>=2)
	{
		document.FORM_LOGIN.action="esquecisenha.php";
		document.FORM_LOGIN.submit();
	}
        
}

function confereSenha()
{
    var novasenha=document.FORM_LOGIN.TX_NOVA_SENHA.value;
    var novasenhaconf=document.FORM_LOGIN.TX_NOVA_SENHA_CONF.value;
    
    
 if ((novasenha !== "") && (novasenhaconf !== "") && (novasenha !== novasenhaconf))
    { 
    document.getElementById("l_msg").innerHTML="As senhas nÃ£o conferem.";
    }
     if ((novasenha !== "") && (novasenhaconf !== "") && (novasenha === novasenhaconf))
    { 
    document.getElementById("l_msg").innerHTML="As senhas conferem. Clique em Trocar para efetuar a troca.";
    }
}

function registra_cookie(idioma) 
    { 
      //alert("Cookie: $lang= " + idioma +"."); 
      document.cookie = 'langLogin='+ idioma +';expires=Thu, 31 Dec 2020 12:00:00 UTC;path=/;';
    }