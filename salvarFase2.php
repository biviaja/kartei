<?php
    // inicia a sessão se já não estiver iniciada.
    !isset($_SESSION)?session_start():null;
    // INSERIR NACIONALIDADE e outros dados
    // Inicialmente checará o login e a senha por sessão. Se OK, abrirá a página, senão, retornará à página de login.

    global $conexao,$login,$sqlLogin,$varNome,$varSobrenome,$varsexo,$varLogin,$chkLogin,$varSenha,$msgLogin,$data,$hora,$sqlUPDATE;
    global $varNacionalidade,$varNaturalidade,$varProfissao,$varIdentidade,$varExpedicao;

    $varNacionalidade=filter_input(INPUT_POST,'varNacionalidade');//Pega a nacionalidade
    $varNaturalidade=filter_input(INPUT_POST,'varNaturalidade');//Pega a naturalidade
    $varProfissao=filter_input(INPUT_POST,'varProfissao');//Pega a profissão
    $varIdentidade=filter_input(INPUT_POST,'varIdentidade');//Pega a IOdentidade
    $varExpedicao=filter_input(INPUT_POST,'varExpedicao');//Pega a Expedição
    $varObs=filter_input(INPUT_POST,'varObs');//Pega a obs

    //$chkLogin=$_SESSION['ficha']['chkLogin'];// Pega o chkLogin da Session
    $login= $_SESSION['usu']['varLogin'];
    //echo "<script>window.alert('Login: '. $login);</script>";

    $varFase=3;// Já somando para voltar na próxima fase  
    $data_atual = date('d/m/Y');
    $hora_atual = date('H:i:s');
    $dataGravacao = implode("/",array_reverse(explode("/",$data_atual)));

    $_SESSION['ficha']['varNacionalidade']=$varNacionalidade;
    $_SESSION['ficha']['varNaturalidade']=$varNaturalidade;
    $_SESSION['ficha']['varProfissao']=$varProfissao;
    $_SESSION['ficha']['varIdentidade']=$varIdentidade;
    $_SESSION['ficha']['varExpedicao']=$varExpedicao;
    $_SESSION['ficha']['varObs']=$varObs;

    $chkLogin="OK"; // ============================================ VERIFICAR POR QUE NÃO ESTÁ PEGANDO
    if ($chkLogin=="OK"){ //Se chkLogin=OK, altera os dados
        //SQL para verificar o login
        $sqlUPDATE = "UPDATE dbkartei.tab_fichas SET TX_NACIONALIDADE='".$varNacionalidade."', TX_NATURALIDADE='".$varNaturalidade."'";
        $sqlUPDATE .=", TX_PROFISSAO='".$varProfissao."', TX_IDENTIDADE='".$varIdentidade."', TX_EXPEDICAO='".$varExpedicao."', TX_OBS='".$varObs."'";
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
        $rsUpdate=mysqli_query($conexao, $sqlUPDATE);

        // fecha a conexão
        mysqli_close($conexao);
        //echo "Volta para cadastroFicha";
        $_SESSION['ficha']['fase']=$varFase;
        //header("Location:cadastroFicha.php");
        //die();
        }
    } // fim if chkLogin
    function resposta(){ //JSON
        echo json_encode(1); // utilizo o echo para retornar meu array, porém em formato json.
    }
    ?>