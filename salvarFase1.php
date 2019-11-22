<?php
    // inicia a sessão
    !isset($_SESSION)?session_start():null;
    // INSERIR NOME e outros dados da FICHA
    // Inicialmente checará o login e a senha por sessão. Se OK, abrirá a página, senão, retornará à página de login.

    global $conexao,$login,$sqlLogin,$varNome,$varSobrenome,$varsexo,$varLogin,$chkLogin,$varSenha,$msgLogin,$data,$hora;
    global $varNomeFicha,$varSobrenomeFicha,$varsexoFicha,$varSobrenomeSolteira,$varDataNasc,$varIdade,$sqlUPDATE;

    $varTituloPessoa=filter_input(INPUT_POST,'varTituloPessoa');//Pega o sobrenome
    $varSobrenome=filter_input(INPUT_POST,'varSobrenome');//Pega o sobrenome
    $varNome=filter_input(INPUT_POST,'varNome');//Pega o nome
    $varSexo=filter_input(INPUT_POST,'varSexo');//Pega o sexo
    $varDataNascimento=filter_input(INPUT_POST,'varDataNascimento');//Pega data de nascimento montada (y/m/d)
    $varIdade=filter_input(INPUT_POST,'varIdade');//Pega a idade
    $varEstadoCivil=filter_input(INPUT_POST,'varEstadoCivil');//Pega o estado civil
    $varSobrenomeConjuge=filter_input(INPUT_POST,'varSobrenomeConjuge');//Pega o sobrenome do conjuge
    $varNomeConjuge=filter_input(INPUT_POST,'varNomeConjuge');//Pega o nome do conjuge
    $varSobrenomeSolteiraFicha=filter_input(INPUT_POST,'varSobrenomeSolteiraFicha');//Pega o sobrenome de solteira
    $varSobrenomeSolteiraConjuge=filter_input(INPUT_POST,'varSobrenomeSolteiraConjuge');//Pega o sobrenome de solteira
    $varPai=filter_input(INPUT_POST,'varPai');//Pega o pai
    $varMae=filter_input(INPUT_POST,'varMae');//Pega a mãe
    $varObs=filter_input(INPUT_POST,'varObs');//Pega a obs

    if(strlen($varSobrenomeConjuge)<1 && $varEstadoCivil!=='Solteiro'){$varSobrenomeConjuge=$varSobrenome;}

    $chkLogin=$_SESSION['usu']['chkLogin'];// Pega o chkLogin da Session
    $login= $_SESSION['usu']['varLogin'];

    $varFase=2;// Já somando para voltar na próxima fase

    $data_atual = date('d/m/Y');
    $hora_atual = date('H:i:s');

    $_SESSION['ficha']['varTituloPessoa']=$varTituloPessoa;
    $_SESSION['ficha']['varNome']=$varNome;
    $_SESSION['ficha']['varSobrenome']=$varSobrenome;
    $_SESSION['ficha']['varSexo']=$varSexo;
    $_SESSION['ficha']['varDataNascimento']=$varDataNascimento;
    $_SESSION['ficha']['varIdade']=$varIdade;
    $_SESSION['ficha']['varEstadoCivil']=$varEstadoCivil;
    $_SESSION['ficha']['varNomeConjuge']=$varNomeConjuge;
    $_SESSION['ficha']['varSobrenomeConjuge']=$varSobrenomeConjuge;
    $_SESSION['ficha']['varSobrenomeSolteiraFicha']=$varSobrenomeSolteiraFicha;
    $_SESSION['ficha']['varSobrenomeSolteiraConjuge']=$varSobrenomeSolteiraConjuge;
    $_SESSION['ficha']['varObs']=$varObs;

    $dataMySQLFicha = implode("-",array_reverse(explode("/",$varDataNascimento)));
    $dataGravacao = implode("/",array_reverse(explode("/",$data_atual)));

    $dataBR = implode("/",array_reverse(explode("-",$dataMySQLFicha)));

    if ($chkLogin=="OK"){ //Se chkLogin=OK, altera os dados

        $sqlUPDATE = "UPDATE dbkartei.tab_fichas SET TX_TituloPessoa='".$varTituloPessoa."', TX_Nome='".$varNome."', TX_Sobrenome='".$varSobrenome."', TX_Sexo='".$varSexo."'";
        $sqlUPDATE .=", TX_SobrenomeSolteiraFicha='".$varSobrenomeSolteiraFicha."', DT_Nascimento='".$varDataNascimento."', TX_Idade='".$varIdade."', TX_EstadoCivil='".$varEstadoCivil."'";
        $sqlUPDATE .=", TX_NomeConjuge='".$varNomeConjuge."', TX_SobrenomeConjuge='".$varSobrenomeConjuge."', TX_SobrenomeSolteiraConjuge='".$varSobrenomeSolteiraConjuge."'";
        $sqlUPDATE .=", TX_OBS='".$varObs."', TX_Pai='".$varPai."', TX_Mae='".$varMae."', NR_Fase_Cadastro=".$varFase.", DT_Cadastro='".$dataGravacao."', HR_Cadastro='".$hora_atual."'"; 
        $sqlUPDATE .=" WHERE TX_Matricula='".$_SESSION['ficha']['varMatricula']."'";

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
        header("Location:cadastroFicha.php");
        //die();
        }
    } // fim if chkLogin

    function resposta(){ //JSON
        echo json_encode(1); // utilizo o echo para retornar meu array, porém em formato json.
    }
    ?>