    <?php
    // inicia a sessão
    session_start();
    header('Content-Type: text/html; charset=utf-8');
    // uploadFotos.php
    // Inicialmente checará o login e a senha por sessão. Se OK, abrirá a página, senão, retornará à página de login.

    global $conexao,$login,$sqlLogin,$nome,$sobrenome,$varsexo,$varLogin,$chkLogin,$varSenha,$msgLogin,$chkLogin,$data,$hora;
    $chkLogin=$_SESSION['usu']["chkLogin"];// Pega o chkLogin da Session
    $login= filter_input_array(INPUT_POST, FILTER_DEFAULT);

    //echo "<script>window.alert('Login: '. $login);</script>";
   // if(strcasecmp('0', $_POST['varFase'])==0){
   //     echo "Verificação da fase OK";
   // }
    $varFase=0;
    //$varFase=$_POST["campo_hidden"];//Pega a fase
    $varMatricula=$_POST['varMatricula'];//Pega a matricula
    $varTipoFicha=$_POST['varTipoFicha'];//Pega o tipo da Ficha
    $varObs=$_POST['varObs'];//Pega a OBS da ficha
    $varObsPesq=$_POST['varObsPesq'];//Pega a OBS do pesquisador
    
    //$varMatricula=$_POST["TX_MATRICULA"];//Pega a matricula
    //$varTipoFicha=$_POST["tipoFichaRadios"];//Pega o tipo da Ficha
    //$varObs=$_POST["Obs1"];//Pega a OBS da ficha
    //$varObsPesq=$_POST["ObsPesq1"];//Pega a OBS do pesquisador
                
  //  echo "varMatricula: " . $varMatricula . "<br>";
  //  echo "varTipoFicha: " . $varTipoFicha. "<br>";
  //  echo "VarCel: " . $varCel . "<br>";
  //  echo "Login: " . $_SESSION['ficha']['varLogin']. "<br>";
  //  echo "chkLogin: " . $chkLogin . "<br>";
    
    $_SESSION['ficha']['varMatricula']=$varMatricula;
    $_SESSION['ficha']['varTipoFicha']=$varTipoFicha;
    $_SESSION['ficha']['varObs']=$varObs;
    $_SESSION['ficha']['varObsPesq']=$varObsPesq;
    $_SESSION['ficha']['fase']=$varFase;//0;
    $_SESSION['ficha']['varRespostaCadastro']="Dados inseridos. Clique em avançar para continuar o cadastro.";
    
    //$_SESSION['ficha']['varCel']=$varCel;
    
    //echo "(session) email: " . $_SESSION['ficha']['varEmail']. "<br>";
    //echo "(session) Tel: " . $_SESSION['ficha']['varTel']. "<br>";
    //echo "(session) Cel: " . $_SESSION['ficha']['varCel']. "<br>";
    //echo "(session) varObs: " . $_SESSION['ficha']['varObs']. "<br>";
    //echo "(session) varObsPesq: " . $_SESSION['ficha']['varObsPesq']. "<br>";
    
    if ($chkLogin=="OK"){ //Se chkLogin=OK, altera os dados
        //SQL para verificar o login
        
        $sqlINSERT="INSERT INTO dbkartei.tab_upload ";
        $sqlINSERT+="(`id_upload`,`TX_Login`,`TX_NomeArq`,`NR_TamArq`,`DT_Upload`,`HR_Upload`)";
        $sqlINSERT+="VALUES(default,'LH','010EIN_foto1.jpg',1024,NOW(),NOW())";
            
        //echo "sqlINSERT: ". $sqlINSERT . "<br>";   

        //abre_conexao;  eX: "$pMysqli = new mysqli('p:'.DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);"
        $conexao = mysqli_connect('localhost:3306', 'Kartei', 'ktARI#19', 'dbkartei'); // Produção
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
            $rsUpdate=mysqli_query($conexao, $sqlINSERT);

            // fecha a conexão
            mysqli_close($conexao);

         // header("Location:cadastroFicha.php");
         //  die();
        }
    } // fim if chkLogin
    ?>