<?php
    // inicia a sessão
    !isset($_SESSION)?session_start():null;
    // RELATORIO_UPLOADS.php
    // Inicialmente checará o login e a senha por sessão. Se OK, abrirá a página, senão, retornará à página de login.

    global $conexao,$login,$sqlLogin,$varNome,$varLogin,$chkLogin,$varSenha,$msgLogin,$data,$hora,$sqlUPDATE;
    global $varDataAceitacao,$varTituloProponente,$varNomeProponente,$varSobrenomeProponente,$varSexoProponente;
    global $varBotao;

    $varDestino=filter_input(INPUT_POST,'varDestino');//Pega a nacionalidade
    $varDataFalecimento=filter_input(INPUT_POST,'varDataFalecimento');//Pega a naturalidade
    $varDiaFalecimentoJud=filter_input(INPUT_POST,'varDiaFalecimentoJud');//Pega a profissão
    $varMesFalecimentoJud=filter_input(INPUT_POST,'varMesFalecimentoJud');//Pega a IOdentidade
    $varAnoFalecimentoJud=filter_input(INPUT_POST,'varAnoFalecimentoJud');//Pega a Expedição
    $varObs=filter_input(INPUT_POST,'varObs');//Pega a obs
  
    $chkLogin=$_SESSION['usu']['chkLogin'];// Pega o chkLogin da Session
    $login= $_SESSION['usu']['varLogin'];

    $varFase=6;// Já somando para voltar na próxima fase
    $data_atual = date('d/m/Y');
    $hora_atual = date('H:i:s');
    $dataGravacao = implode("/",array_reverse(explode("/",$data_atual)));

    $_SESSION['ficha']['varDestino']=$varDestino;
    $_SESSION['ficha']['varDataFalecimento']=$varDataFalecimento;
    $_SESSION['ficha']['varDiaFalecimentoJud']=$varDiaFalecimentoJud;
    $_SESSION['ficha']['varMesFalecimentoJud']=$varMesFalecimentoJud;
    $_SESSION['ficha']['varMesFalecimentoJud']=$varMesFalecimentoJud;
    $_SESSION['ficha']['varObs']=$varObs;

    if ($chkLogin=="OK"){ //Se chkLogin=OK, altera os dados
        $sqlUPDATE = "UPDATE dbkartei.tab_fichas SET TX_Destino='".$varDestino."', DT_FALECIMENTO='".$varDataFalecimento."'";
        $sqlUPDATE .=", TX_Dia_Falecimento_Jud='".$varDiaFalecimentoJud."', TX_Mes_Falecimento_Jud='".$varMesFalecimentoJud."'";
        $sqlUPDATE .=", TX_Ano_Falecimento_Jud='".$varAnoFalecimentoJud."', TX_OBS='".$varObs."'";
        $sqlUPDATE .=", NR_Fase_Cadastro=".$varFase.", DT_Cadastro='".$dataGravacao."', HR_Cadastro='".$hora_atual."'"; 
        $sqlUPDATE .= " WHERE TX_Matricula='".$_SESSION['ficha']['varMatricula']."'";

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
        $_SESSION['ficha']['fase']=$varFase;
        header("Location:cadastroFicha.php");
        //die();
        }
    } // fim if chkLogin
    function resposta(){ //JSON
        echo json_encode(1);
    }
    ?>