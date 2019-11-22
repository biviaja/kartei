<?php
    // inicia a sessão
    !isset($_SESSION)?session_start():null;
    // RELATORIO_UPLOADS.php
    // Inicialmente checará o login e a senha por sessão. Se OK, abrirá a página, senão, retornará à página de login.

    global $conexao,$login,$sqlLogin,$varNome,$varSobrenome,$varsexo,$varLogin,$chkLogin,$varSenha,$msgLogin,$data,$hora,$sqlUPDATE;
    global $varNacionalidade,$varNaturalidade,$varProfissao,$varIdentidade,$varExpedicao;
      
// Com JQ
/*    
    $varNacionalidade=filter_input(INPUT_POST,'varNacionalidade');//Pega a nacionalidade
    $varNaturalidade=filter_input(INPUT_POST,'varNaturalidade');//Pega a naturalidade
    $varProfissao=filter_input(INPUT_POST,'varProfissao');//Pega a profissão
    $varIdentidade=filter_input(INPUT_POST,'varIdentidade');//Pega a IOdentidade
    $varExpedicao=filter_input(INPUT_POST,'varExpedicao');//Pega a Expedição
    $varObs=filter_input(INPUT_POST,'varObs');//Pega a obs
  
    //$chkLogin=$_SESSION['ficha']['chkLogin'];// Pega o chkLogin da Session
    $login= $_SESSION['usu']['varLogin'];
    //echo "<script>window.alert('Login: '. $login);</script>";
*/    
    $varFase=6;// Já somando para voltar na próxima fase  
    $data_atual = date('d/m/Y');
    $hora_atual = date('H:i:s');

//    echo "varSobrenomeSolteira: " . $varSobrenomeSolteira . "<br>";
//    echo "varPai: " . $varPai . "<br>";
//    echo "varMae: " . $varMae . "<br>";
//    echo "OBS: " . $varObs . "<br>";
/*    
    $_SESSION['ficha']['varNacionalidade']=$varNacionalidade;
    $_SESSION['ficha']['varNaturalidade']=$varNaturalidade;
    $_SESSION['ficha']['varProfissao']=$varProfissao;
    $_SESSION['ficha']['varIdentidade']=$varIdentidade;
    $_SESSION['ficha']['varExpedicao']=$varExpedicao;
    $_SESSION['ficha']['varObs']=$varObs;
      
    echo "(session) varNacionalidade: " . $_SESSION['ficha']['varNacionalidade']. "<br>";
    echo "(session) varNaturalidade: " . $_SESSION['ficha']['varNaturalidade']. "<br>";
    echo "(session) varProfissao: " . $_SESSION['ficha']['varProfissao']. "<br>";
    echo "(session) varIdentidade: " . $_SESSION['ficha']['varIdentidade']. "<br>";
    echo "(session) varExpedicao: " . $_SESSION['ficha']['varExpedicao']. "<br>"; 
    echo "(session) varObs: " . $_SESSION['ficha']['varObs']. "<br>";
 */
    $dataGravacao = implode("/",array_reverse(explode("/",$data_atual)));
    //echo "Data MySQL: ". $dataMySQLFicha . "<br/>";
    
    //$_SESSION['ficha']['varCel']=$varCel;
    

    $chkLogin="OK"; // ============================================ VERIFICAR POR QUE NÃO ESTÁ PEGANDO
    if ($chkLogin=="OK"){ //Se chkLogin=OK, altera os dados
        //SQL para verificar o login
        $sqlUPDATE = "UPDATE dbkartei.tab_fichas SET BL_FichaCompleta=1";
        $sqlUPDATE .=", NR_Fase_Cadastro=".$varFase.", DT_Cadastro='".$dataGravacao."', HR_Cadastro='".$hora_atual."'"; 
        $sqlUPDATE .= " WHERE TX_Matricula='".$_SESSION['ficha']['varMatricula']."'";
                
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
        echo "Vai executar o $ rsUpdate=mysqli_query($ conexao, $ sqlUPDATE) <br/>";
        $rsUpdate=mysqli_query($conexao, $sqlUPDATE);

        // fecha a conexão
        mysqli_close($conexao);
        //echo "Volta para cadastroFicha";
        $SESSION['ficha']['fase']=$varFase;
        //header("Location:cadastroFicha.php");
        //die();
        }
    } // fim if chkLogin
    function resposta(){ //JSON

        echo json_encode(1); // utilizo o echo para retornar meu array, porém em formato json.
    } 
    ?>