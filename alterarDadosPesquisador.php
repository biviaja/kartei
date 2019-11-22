    <?php
    // inicia a sessão
    session_start();
    // RELATORIO_UPLOADS.php
    // Inicialmente checará o login e a senha por sessão. Se OK, abrirá a página, senão, retornará à página de login.

    global $conexao,$login,$sqlLogin,$nome,$sobrenome,$varsexo,$varLogin,$chkLogin,$varSenha,$msgLogin,$chkLogin,$data,$hora;
    $chkLogin=$_SESSION['usu']["chkLogin"];// Pega o chkLogin da Session
    $login= filter_input_array(INPUT_POST, FILTER_DEFAULT);

    //echo "<script>window.alert('Login: '. $login);</script>";

    $varEmail=$_POST["TX_EMAIL"];//Pega o email
    $varTel=$_POST["TX_TEL"];//Pega o Tel
    $varCel=$_POST["TX_CEL"];//Pega o Cel
                
    //echo "varEmail: " . $varEmail . "<br>";
    //echo "varTel: " . $varTel. "<br>";
    //echo "VarCel: " . $varCel . "<br>";
    //echo "Login: " . $_SESSION['usu']['varLogin']. "<br>";
    //echo "chkLogin: " . $chkLogin . "<br>";
    
    $_SESSION['usu']['varEmail']=$varEmail;
    $_SESSION['usu']['varTel']=$varTel;
    $_SESSION['usu']['varCel']=$varCel;
    echo "(session) email: " . $_SESSION['usu']['varEmail']. "<br>";
    echo "(session) Tel: " . $_SESSION['usu']['varTel']. "<br>";
    echo "(session) Cel: " . $_SESSION['usu']['varCel']. "<br>";
    echo "(session) Login: " . $_SESSION['usu']['varLogin']. "<br>";
    
    if ($chkLogin=="OK"){ //Se chkLogin=OK, altera os dados
        //SQL para verificar o login
        $sqlUPDATE = "UPDATE tab_usu SET TX_Email='".$varEmail."', TX_Telefone='".$varTel."', TX_Celular='".$varCel. "' WHERE TX_LOGIN='" . $_SESSION['usu']['varLogin']. "'";
        echo "sqlUPDATE: ". $sqlUPDATE . "<br>";   

        //abre_conexao;  eX: "$pMysqli = new mysqli('p:'.DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);"
        $conexao = mysqli_connect('66.33.203.11', 'kartei', 'ktARI#19', 'dbkartei'); // Produção
        // $conexao = mysqli_connect("mysql.cs2rio.com", "heritagehistory", "me22olatto", "hhdatabase"); // Site
        if (!$conexao ) {
            echo "Error: Connection with DB MySQL is fail." . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        else{
        //echo "Sucesso ao conectar-se com a base de dados DBUpload (MySQL).<br>" . PHP_EOL; 
        
        // query SQL

        // Executa a query (o recordset $rs contém o resultado da query)
        $rsUpdate=mysqli_query($conexao, $sqlUPDATE);

        // fecha a conexão
        mysqli_close($conexao);
        header("Location:HomeDoPesquisador.php");
        die();
        }
    } // fim if chkLogin
    ?>