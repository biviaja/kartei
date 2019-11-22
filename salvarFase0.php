<?php
    // inicia a sessão
    !isset($_SESSION)?session_start():null;
    // INSERIR MATRÍCULA e TIPO DA FICHA e número de imagens = 0
    // Inicialmente checará o login e a senha por sessão. Se OK, abrirá a página, senão, retornará à página de login.

    global $conexao,$login,$sqlLogin,$nome,$sobrenome,$varsexo,$varLogin,$chkLogin,$varSenha,$msgLogin,$data,$hora,$varFase;
    if(!isset($_SESSION['usu']['chkLogin'])){
        $chkLogin="NOK";
    }else{
    $chkLogin=$_SESSION['usu']['chkLogin'];// Pega o chkLogin da Session
    }

    $data_atual = date('d/m/Y');
    $hora_atual = date('H:i:s');
    $dataGravacao = implode("/",array_reverse(explode("/",$data_atual)));

    $varMatricula=strtolower(filter_input(INPUT_POST,'varMatricula'));//Pega a matricula
    $varTipoFicha=filter_input(INPUT_POST,'varTipoFicha');//Pega o tipo da Ficha

    $_SESSION['ficha']['varMatricula']=$varMatricula;
    $_SESSION['ficha']['varTipoFicha']=$varTipoFicha;

    if ($chkLogin==="OK" && $varMatricula!='' && $varTipoFicha!='' ){ 
    // Verifica se a ficha já existe. Se não existir, grava, se existir, UPDATE
        //SQL para verificar o login
        $sqlVerificaFicha="SELECT * FROM dbkartei.tab_fichas WHERE TX_Matricula='".$varMatricula."'";
        //abre_conexao; 
        $conexao = mysqli_connect('66.33.203.11', 'kartei', 'ktARI#19', 'dbkartei'); // Produção
        if (!$conexao ) {
            echo "Error: Connection with DB MySQL is fail." . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        else{
            $rsVerifica=mysqli_query($conexao, $sqlVerificaFicha);
            $numLinhas=mysqli_num_rows($rsVerifica);

            if($numLinhas>0){// Já existe, UPDATE
                $msge="Já existe uma ficha com esta matrícula. Verifique o número.";
                $_SESSION['ficha']['mse']=$msge;
                $_SESSION['ficha']['classeErro']="d-block";
                $varFase=0;
            }else{
                $_SESSION['ficha']['classeErro']="";
                $_SESSION['ficha']['mse']="";
                $varFase=1;
                $sqlCadastra = "INSERT INTO dbkartei.tab_fichas (TX_Matricula, TX_TipoFicha, NR_Fase_Cadastro, BL_FichaCompleta, NR_ImagensFicha";
                $sqlCadastra .=", DT_Cadastro, HR_Cadastro, TX_Cadastrador) ";
                $sqlCadastra .="VALUES('".$varMatricula."','".$varTipoFicha."',1,0,0,'".$dataGravacao."','".$hora_atual."','".$_SESSION['usu']['varLogin']."')";

                // Como é ficha nova, reseta a Session para todas as variáveis
                $_SESSION['ficha']['varMatricula']=$varMatricula;//-------------  1
                $_SESSION['ficha']['varTipoFicha']=$varTipoFicha;//-------------  2
                $_SESSION['ficha']['varFichaCompleta']=0;//--------------------- 36
                $_SESSION['ficha']['fase']=$varFase;//-------------------------- 35
                $_SESSION['ficha']['varTituloPessoa']="";//---------------------  3
                $_SESSION['ficha']['varNome']="";//-----------------------------  4
                $_SESSION['ficha']['varSobrenome']="";//------------------------  5
                $_SESSION['ficha']['varSobrenomeSolteiraFicha']="";//-----------  6
                $_SESSION['ficha']['varSexo']="";//-----------------------------  7
                $_SESSION['ficha']['varDataNascimento']="";//-------------------  8
                $_SESSION['ficha']['varIdade']="";//----------------------------  9
                $_SESSION['ficha']['varEstadoCivil']="";//---------------------- 10
                $_SESSION['ficha']['varSobrenomeConjuge']="";//----------------- 11
                $_SESSION['ficha']['varNomeConjuge']="";//---------------------- 12
                $_SESSION['ficha']['varSobrenomeSolteiraConjuge']="";//--------- 122
                $_SESSION['ficha']['varPai']="";//------------------------------ 13
                $_SESSION['ficha']['varMae']="";//------------------------------ 14
                $_SESSION['ficha']['varNacionalidade']="";//-------------------- 15
                $_SESSION['ficha']['varNaturalidade']="";//--------------------- 16
                $_SESSION['ficha']['varIdentidade']="";//----------------------- 17
                $_SESSION['ficha']['varExpedicao']="";//------------------------ 18
                $_SESSION['ficha']['varProfissao']="";//------------------------ 19
                $_SESSION['ficha']['varDataAceitacao']="";//-------------------- 20
                $_SESSION['ficha']['varTituloProponente1']="";//---------------- 21
                $_SESSION['ficha']['varNomeProponente1']="";//------------------ 22
                $_SESSION['ficha']['varSobrenomeProponente1']="";//------------- 23
                $_SESSION['ficha']['varSexoProponente1']="";//------------------ 24
                $_SESSION['ficha']['varTituloProponente2']="";//---------------- 25
                $_SESSION['ficha']['varNomeProponente2']="";//------------------ 26
                $_SESSION['ficha']['varSobrenomeProponente2']="";//------------- 27
                $_SESSION['ficha']['varSexoProponente2']="";//------------------ 28
                $_SESSION['ficha']['varDestino']="";//-------------------------- 29
                $_SESSION['ficha']['varDataFalecimento']="";//------------------ 30
                $_SESSION['ficha']['varDiaFalecimentoJud']="";//---------------- 31
                $_SESSION['ficha']['varMesFalecimentoJud']="";//---------------- 32
                $_SESSION['ficha']['varAnoFalecimentoJud']="";//---------------- 33
                $_SESSION['ficha']['varObs']="";//------------------------------ 34
                $_SESSION['ficha']['varNumImagensFicha']="";//------------------ 37
                $_SESSION['ficha']['varCadastrador']="";//---------------------- 38
                $_SESSION['ficha']['varDataCadastro']="";//--------------------- 39
                $_SESSION['ficha']['varHoraCadastro']="";//--------------------- 40
                //echo "Sucesso ao conectar-se com a base de dados.<br>" . PHP_EOL;  Executa a query (o recordset $rs contém o resultado da query)
                $rsUpdate=mysqli_query($conexao, $sqlCadastra);
            }
                // fecha a conexão
                mysqli_close($conexao);
        }
    }else{
        $msge= "Dados não gravados. Verifique o login.";
        $_SESSION['ficha']['msge']=$msge;
        header("Location:cadastroFicha.php");
         //  die();
    }    // fim if chkLogin
    function resposta(){ //JSON
        echo json_encode(1); // utilizo o echo para retornar meu array, porém em formato json.
    }
    ?>