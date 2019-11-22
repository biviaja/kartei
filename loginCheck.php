<html>
<head>
    <meta charset="UTF-8">
    <title>Heritage History - Login Checker KARTEI</title>
    <link href="css/login.css" rel="stylesheet">
    <script src="login.js"></script>

    <?php
    // C:\Users\All Users\MySQL\MySQL Server 5.7\Data\DBKartei
    // 
    // inicia a sessão
    !isset($_SESSION['usu'])?session_start():null;
    // RELATORIO_UPLOADS.php
    // Inicialmente checará o login e a senha por sessão. Se OK, abrirá a página, senão, retornará à página de login.

    global $conexao,$login,$sqlLogin,$nome,$sobrenome,$varsexo,$varLogin,$chkLogin,$varSenha,$msgLogin,$chkLogin,$data,$hora;
    $chkLogin=$_SESSION['usu']["chkLogin"];// Pega o chkLogin da Session
    $login= filter_input_array(INPUT_POST, FILTER_DEFAULT);

    echo "<script>window.alert('Login: '. $login);</script>";
    //$varLogin=$_POST["TX_LOGIN"];//Pega o login do post
    //$varSenha=$_POST["TX_SENHA"];//Pega o login do post
    
/* @var $varLogin type  campos do formulário */
    $varLogin=filter_input(INPUT_POST , 'TX_LOGIN');
    $varSenha=filter_input(INPUT_POST , 'TX_SENHA');
            
    //echo "varLogin: " . $varLogin . "<br>";
    //echo "varSenha: " . $varSenha . "<br>";
    //echo "chkLogin: " . $chkLogin . "<br>";

    //if ($chkLogin!="OK") //Se chkLogin=OK, passa direto, já existe a session e já foi verificado o login
    //{
    //SQL para verificar o login
    $sqlLogin = "SELECT * FROM tab_usu WHERE TX_LOGIN='" . $varLogin . "' AND TX_SENHA='" . $varSenha . "'";
    //echo sqlLogin . "<br>";   

    //abre_conexao;  eX: "$pMysqli = new mysqli('p:'.DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);"
    $conexao = mysqli_connect('localhost:3306', 'Kartei', 'ktARI#19', 'DBKartei'); // Produção
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
    while($dadosLogin=mysqli_fetch_assoc($rsLogin))
        {
        //echo "e-mail: ".$dadosLogin['TX_Email']." - Login: ".$dadosLogin['TX_Login']." - Senha: ".$dadosLogin['TX_Senha']. " - Data: ". $data . " - Hora: ". $hora . '<br>';
        }
        $numLinhas=mysqli_num_rows($rsLogin);
    //    echo " >> num_rows(rsLogin): " . $numLinhas . " ||| varLogin: " . $varLogin . "<br>"; 
        if ($numLinhas<=0)      
            { //Sem registros - Volta para Login
              //$chkLogin="NOK";
              //$msgLogin="Login and/or password incorret(s). Try again, please or ask for your password.";
              //echo "LOGIN NOK: msgLogin: ".$msgLogin." - chkLogin: ".$chkLogin." - SESSION[chkLogin]: ".$_SESSION['usu']["chkLogin"]. " - SESSION[varLogin]: ". $_SESSION['usu']["varLogin"] . '<br>';
              //$_SESSION['usu']["chkLogin"]=$chkLogin;
              //$_SESSION['usu']["msgLogin"]=$msgLogin;

              //echo '<script> alert("chk>> chkLogin: ' . $chkLogin .' - SESSION[chkLogin]: ' . $_SESSION['usu']["chkLogin"] . '");';
              //echo 'alert("chk>> msgLogin: ' . $msgLogin .' - SESSION[msgLogin]: ' . $_SESSION['usu']["msgLogin"] . '");</script> ';
              $_SESSION['usu']['chkLogin']="NOK";
              header("Location:login.php?chkLogin=NOK");
              die();
            }
            else
                { // encontrou
             // setcookie("login",$login);
                $msgLogin="";
                $chkLogin="OK";
                $_SESSION['usu']['chkLogin'] = $chkLogin;		
                $_SESSION['usu']['varLogin'] = $varLogin ;
                $_SESSION['usu']['varNome'] = mysql_rsLogin($rsLogin, 2);
                $_SESSION['usu']['varSobrenome'] =mysql_rsLogin($rsLogin, 3);
                $_SESSION['usu']['varSexo'] = mysql_rsLogin($rsLogin, 4);
                $_SESSION['usu']['varTel'] = mysql_rsLogin($rsLogin, 9);
                $_SESSION['usu']['varCel'] = mysql_rsLogin($rsLogin, 10);
                $_SESSION['usu']['varEmail'] = mysql_rsLogin($rsLogin, 7);
            
                 // response.Redirect("relatorio_uploads.php") 
                // echo "chk>> chkLogin: " . $chkLogin ." - SESSION[chkLogin]: " . $_SESSION['usu']["chkLogin"] . "<br>";
                header("Location:relatorio_uploads.php");
                die();
                 //echo "Login OK: msgLogin: ".$msgLogin." - chkLogin: ".$chkLogin." - SESSION[chkLogin]: ".$_SESSION['usu']["chkLogin"]. " |||  SESSION[varLogin]: ". $_SESSION['usu']["varLogin"] . '<br>';
                }	
    // libera result set 
    $rsLogin->close();
    // fecha a conexão
    mysqli_close($conexao);
    //}
    ?>
</head>
<body>
</body>
</html>