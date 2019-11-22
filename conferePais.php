    <?php
    // inicia a sessão
    session_start();
    header('Content-Type: text/html; charset=utf-8');
    $_SESSION['ficha']['fase']="2";
    // Inicialmente checará o login e a senha por sessão. Se OK, abrirá a página, senão, retornará à página de login.

    global $conexao,$login,$sqlLogin,$nome,$sobrenome,$varsexo,$varLogin,$chkLogin,$varSenha,$msgLogin,$chkLogin,$data,$hora;
    $chkLogin=$_SESSION['usu']["chkLogin"];// Pega o chkLogin da Session
    $login= filter_input_array(INPUT_POST, FILTER_DEFAULT);

    //echo "<script>window.alert('Login: '. $login);</script>";

    $varSobrenome=$_POST["TX_SOBRENOME"];//Pega o SOBRENOME
                
    //echo "varSobrenome: " . $varSobrenome . "<br>";
    
    $_SESSION['ficha']['varSobrenome']=$varSobrenome;
    
    //echo "(session) varSobrenome: " . $_SESSION['ficha']['varSobrenome']. "<br>";
    
    if ($chkLogin=="OK"){ //Se chkLogin=OK, altera os dados
        //SQL para verificar o login
        $sqlPais = "SELECT FROM dbkartei.tab_fichas * WHERE TX_Sobrenome='".$varSobrenome."'";
        echo "sqlPais: ". $sqlPais . "<br>";   

        //abre_conexao;  eX: "$pMysqli = new mysqli('p:'.DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);"
        $conexao = mysqli_connect('66.33.203.11', 'kartei', 'ktARI#19', 'dbkartei'); // Produção
        // $conexao = mysqli_connect("mysql.cs2rio.com", "heritagehistory", "me22olatto", "hhdatabase"); // Site
        if (!$conexao ) {
            echo "Error: Connection with DB MySQL is fail." . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        else{

        //    $_SESSION['ficha']['varSobrenome']="";
        //    $_SESSION['ficha']['varNome']="";
        //    $_SESSION['ficha']['varDataNasc']="";
        //    $_SESSION['ficha']['varIdade']="";
        
            //echo "Sucesso ao conectar-se com a base de dados DBUpload (MySQL).<br>" . PHP_EOL; 
            // query SQL
            // Executa a query (o recordset $rs contém o resultado da query)
        $nomesPais=[];
        $nomesMaes= [];    
        $npais=0;
        $nmaes=0;
        $rsPais=mysqli_query($conexao, $sqlPais);    
        while($dadosPais=mysqli_fetch_assoc($rsPais))
        {
        echo "e-mail: ".$dadosPais['TX_Email']." - Login: ".$dadosPais['TX_Login']." - Senha: ".$dadosPais['TX_Senha']. " - Data: ". $data->format('d/m/Y') . " - Hora: ". $data->format('H:i:s') ." = ".$dadosPais['TX_Telefone'] ." = ". '<br>';
        //$_SESSION['ficha'] = []; // inicia o array Session das Fichas
        //$_SESSION['usu'] = []; // inicia o array Session do Usuário
        if($dadosPais['TX_Sexo']==="M"){
            $nomesPais[$npais]= $dadosPais['TX_Nome']." ".$dadosPais['TX_Sobrenome']." - matrícula: ".$dadosPais['TX_Matrícula'];
            $_SESSION['ficha']['varPais'][$npais] = $nomesPais[$npais];
            $npais++;
        }else{
            $nomesMaes[$nmaes]= $dadosPais['TX_Nome']." ".$dadosPais['TX_Sobrenome']." - matrícula: ".$dadosPais['TX_Matrícula'];
            $_SESSION['ficha']['varMaes'][$nmaes] = $nomesMaes[$nmaes];
            $nmaes++;
        }
        
        //echo "SESSION['usu'][varEmail]: " . $_SESSION['usu']['varEmail'] ."<br/>" ;
        //echo "SESSION['usu']['nvAcesso']: " . $_SESSION['usu']['nvAcesso'] ."<br/>" ;
        
        //echo "--------------------------------------------------------------------<br/>" ;
        
        }
        $_SESSION['ficha']['npais']=$npais;
        $_SESSION['ficha']['nmaes']=[$nmaes];
            // fecha a conexão
            mysqli_close($conexao);


           //echo "Volta para cadastroFicha";
            header("Location:cadastroFicha.php");
            die();
        }
    } // fim if chkLogin
    ?>