<?php
    // inicia a sessão
    !isset($_SESSION)?session_start():null;
    // INSERIR PROPONENTE
    // Inicialmente checará o login e a senha por sessão. Se OK, abrirá a página, senão, retornará à página de login.

    global $conexao,$login,$sqlLogin,$varNome,$varSobrenome,$varsexo,$varLogin,$chkLogin,$varSenha,$msgLogin,$data,$hora,$sqlUPDATE;
    global $varDataAceitacao,$varTituloProponente,$varNomeProponente,$varSobrenomeProponente,$varSexoProponente;
    global $varBotao;
    
    // INSERIR_PROPONENTE
    $varDataAceitacao=filter_input(INPUT_POST,'varDataAceitacao');//Pega a dta de aceitação
    $varTituloProponente1=filter_input(INPUT_POST,'varTituloProponente1');//Pega o título do proponente
    $varNomeProponente1=filter_input(INPUT_POST,'varNomeProponente1');//Pega o Nome do proponente
    $varSobrenomeProponente1=filter_input(INPUT_POST,'varSobrenomeProponente1');//Pega o Sobrenome do proponente
    $varSexoProponente1=filter_input(INPUT_POST,'varSexoProponente1');//Pega o sexo do proponente

    $varTituloProponente2=filter_input(INPUT_POST,'varTituloProponente2');//Pega o título do proponente
    $varNomeProponente2=filter_input(INPUT_POST,'varNomeProponente2');//Pega o Nome do proponente
    $varSobrenomeProponente2=filter_input(INPUT_POST,'varSobrenomeProponente2');//Pega o Sobrenome do proponente
    $varSexoProponente2=filter_input(INPUT_POST,'varSexoProponente2');//Pega o sexo do proponente

    $_SESSION['ficha']['varDataAceitacao']=$varDataAceitacao;
    $_SESSION['ficha']['varTituloProponente1']=$varTituloProponente1;
    $_SESSION['ficha']['varNomeProponente1']=$varNomeProponente1;
    $_SESSION['ficha']['varSobrenomeProponente1']=$varSobrenomeProponente1;
    $_SESSION['ficha']['varSexoProponente1']=$varSexoProponente1;
    $_SESSION['ficha']['varTituloProponente2']=$varTituloProponente2;
    $_SESSION['ficha']['varNomeProponente2']=$varNomeProponente2;
    $_SESSION['ficha']['varSobrenomeProponente2']=$varSobrenomeProponente2;
    $_SESSION['ficha']['varSexoProponente2']=$varSexoProponente2;
    
    $varBotao=filter_input(INPUT_POST,'botao');//Pega o botão clicado (inserir novo ou salvar)
    $varObs=filter_input(INPUT_POST,'varObs');//Pega a obs

    $data_atual = date('d/m/Y');
    $hora_atual = date('H:i:s');
    //$dataGravacao = implode("/",array_reverse(explode("/",$data_atual)));
    if($varBotao==='inserir'){
        $varFase=4;// Mantém a fase para continuar inserindo  
    }else{
        $varFase=5;// Já somando para voltar na próxima fase  
    }
    echo "Salvando fase ".$varFase." na SESSION.<br/>";
    $_SESSION['ficha']['fase']=$varFase;
    echo "SESSION[fase]:".$_SESSION['ficha']['fase']."<br/>";
    
    // UPDATE ======================================================================================================================================================= UPDATE
    $sqlUPDATE = "UPDATE dbkartei.tab_fichas SET DT_AceitacaoSocio='".$varDataAceitacao."', TX_TituloProponente1='".$varTituloProponente1."'";
    $sqlUPDATE .=", TX_NomeProponente1='".$varNomeProponente1."', TX_SobrenomeProponente1='".$varSobrenomeProponente1."', TX_SexoProponente1='".$varSexoProponente1."'";
    $sqlUPDATE .=", TX_TituloProponente2='".$varTituloProponente2."', TX_NomeProponente2='".$varNomeProponente2."'";
    $sqlUPDATE .=", TX_SobrenomeProponente2='".$varSobrenomeProponente2."', TX_SexoProponente2='".$varSexoProponente2."'";
    $sqlUPDATE .=", NR_Fase_Cadastro=".$varFase.", DT_Cadastro='".$data_atual."', HR_Cadastro='".$hora_atual."'";
    $sqlUPDATE .= ", TX_OBS='".$varObs."' WHERE TX_Matricula='".$_SESSION['ficha']['varMatricula']."'";

    echo "sqlUPDATE: ". $sqlUPDATE . "<br>";  

    $chkLogin=$_SESSION['usu']['chkLogin'];// Pega o chkLogin da Session

    echo "ChkLogin: ".$chkLogin; // ="OK"; teste forçando
    if ($chkLogin=="OK"){ //Se chkLogin=OK, altera os dados
        //SQL para verificar o login

        //abre_conexao;  
        $conexao = mysqli_connect('66.33.203.11', 'kartei', 'ktARI#19', 'dbkartei'); // Produção
        // $conexao = mysqli_connect("mysql.cs2rio.com", 'kartei', 'ktARI#19', 'dbkartei'); // Produção

        if (!$conexao ) {
            echo "Error: Connection with DB MySQL is fail." . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        else{// Há conexão
            //echo "Sucesso ao conectar-se com a base de dados DBUpload (MySQL).<br>" . PHP_EOL; 
            // Executa a query (o recordset $rs contém o resultado da query)
            $rsUpdate=mysqli_query($conexao, $sqlUPDATE);
            // fecha a conexão
            mysqli_close($conexao);

            $_SESSION['ficha']['fase']=$varFase;
        }// Fim se !conexão
        header("Location:cadastroFicha.php");
        //die();
    } // fim if chkLogin

    function resposta(){ //JSON
        echo json_encode(1); // utilizo o echo para retornar meu array, porém em formato json.
    } 
    ?>