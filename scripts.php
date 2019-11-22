<?php
include 'head.php';
?>
<body>
<?php

global $mat, $fase;
  $minha_url= "http://" . $_SERVER["REQUEST_URI"] ; //$_SERVER['PHP_SELF']
  $mat=isset($_GET['mat'])?trim($_GET['mat']):null;
  $fase=isset($_GET['fase'])?trim($_GET['fase']):null;

  if($fase!="undefined" AND $fase!='')
    {// Existe o GET
      $_SESSION['ficha']['fase']=$fase; 
      //echo "Fase da URL:".$fase."<br/>";
    }
    if($mat!="undefined" AND $mat!='')
    {// Existe o GET
      $_SESSION['ficha']['varMatricula']=$mat;
      //echo "Matricula da URL:".$mat."<br/";

        global $df_TX_Matricula,$df_TX_TipoFicha,$df_TX_TituloPessoa,$df_TX_Nome,$df_TX_Sobrenome,$df_TX_SobrenomeSolteiraFicha;
        global $df_TX_Sexo,$df_DT_Nascimento,$df_TX_Idade,$df_TX_Nacionalidade,$df_TX_Naturalidade,$df_TX_EstadoCivil,$df_TX_Pai,$df_TX_Mae;
        global $df_TX_NomeConjuge,$df_TX_SobrenomeConjuge,$df_TX_Identidade,$df_TX_Expedicao,$df_TX_Profissao;
        global $df_DT_AceitacaoSocio,$df_TX_TituloProponente1,$df_TX_Proponente1,$df_TX_TituloProponente2,$df_TX_Proponente2,$df_TX_Destino;
        global $df_DT_Falecimento,$df_Dia_Falecimento_Jud,$df_Mes_Falecimento_Jud,$df_Ano_Falecimento_Jud,$df_TX_OBS,$df_BL_FichaCompleta,$df_NR_ImagensFicha,$df_DT_Gravacao,$df_TX_Cadastrador;

        //Buscar no banco todas as variáveis da ficha e jogar para SESSION
        $sqlFicha="SELECT * FROM dbkartei.tab_fichas WHERE TX_Matricula='".$mat."'";
         //echo "sqlFicha: ".$sqlFicha."<br/>";

        //abre_conexao;  eX: "$pMysqli = new mysqli('p:'.DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);"
        $conexao = mysqli_connect('66.33.203.11', 'kartei', 'ktARI#19', 'dbkartei'); // Produção
        // $conexao = mysqli_connect("mysql.cs2rio.com", "heritagehistory", "me22olatto", "hhdatabase"); // Site

        if (!$conexao ) {
            echo "Error: Connection with DB MySQL is fail." . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        else{
            //echo "Conexão Ok. '<br/>"; //OK
            $rsDd=mysqli_query($conexao, $sqlFicha);
            $numLinhas=mysqli_num_rows($rsDd); // OK
            //echo "Linhas: ". $numLinhas ."<br/>"; // OK

            while($ddf=mysqli_fetch_assoc($rsDd)) // ================================= WHILE pata varrer SELECT
            {
                $df_TX_Matricula=$ddf['TX_Matricula'];//--------------------------- 01
                $df_TX_TipoFicha=$ddf['TX_TipoFicha'];//--------------------------- 02
                $df_TX_TituloPessoa=$ddf['TX_TituloPessoa'];//--------------------- 03
                $df_TX_Nome=$ddf['TX_Nome'];//------------------------------------- 04
                $df_TX_Sobrenome=$ddf['TX_Sobrenome'];//--------------------------- 05
                $df_TX_SobrenomeSolteiraFicha=$ddf['TX_SobrenomeSolteiraFicha'];//- 06
                $df_TX_Sexo=$ddf['TX_Sexo'];//------------------------------------- 07
                $df_DT_Nascimento=$ddf['DT_Nascimento'];//------------------------- 08
                $df_TX_Idade=$ddf['TX_Idade'];//----------------------------------- 09
                $df_TX_Nacionalidade=$ddf['TX_Nacionalidade'];//------------------- 10
                $df_TX_Naturalidade=$ddf['TX_Naturalidade'];//--------------------- 11
                $df_TX_EstadoCivil=$ddf['TX_EstadoCivil'];//----------------------- 12
                $df_TX_Pai=$ddf['TX_Pai'];//--------------------------------------- 13
                $df_TX_Mae=$ddf['TX_Mae'];//--------------------------------------- 14
                $df_TX_NomeConjuge=$ddf['TX_NomeConjuge'];//----------------------- 15
                $df_TX_SobrenomeConjuge=$ddf['TX_SobrenomeConjuge'];//------------- 16
                $df_TX_SobrenomeSolteiraConjuge=$ddf['TX_SobrenomeSolteiraConjuge'];//------ 162
                $df_TX_Identidade=$ddf['TX_Identidade'];//------------------------- 17
                $df_TX_Expedicao=$ddf['TX_Expedicao'];//--------------------------- 18
                $df_TX_Profissao=$ddf['TX_Profissao'];//--------------------------- 19
                $df_DT_AceitacaoSocio=$ddf['DT_AceitacaoSocio'];//----------------- 20
                $df_TX_TituloProponente1=$ddf['TX_TituloProponente1'];//----------- 21
                $df_TX_NomeProponente1=$ddf['TX_NomeProponente1'];//--------------- 22
                $df_TX_SobrenomeProponente1=$ddf['TX_SobrenomeProponente1'];//----- 23
                $df_TX_SexoProponente1=$ddf['TX_SexoProponente1'];//--------------- 24
                $df_TX_TituloProponente2=$ddf['TX_TituloProponente2'];//----------- 25
                $df_TX_NomeProponente2=$ddf['TX_NomeProponente2'];//--------------- 26
                $df_TX_SobrenomeProponente2=$ddf['TX_SobrenomeProponente2'];//----- 27
                $df_TX_SexoProponente2=$ddf['TX_SexoProponente2'];//--------------- 28
                $df_TX_Destino=$ddf['TX_Destino'];//------------------------------- 29
                $df_DT_Falecimento=$ddf['DT_Falecimento'];//----------------------- 30
                $df_TX_Dia_Falecimento_Jud=$ddf['TX_Dia_Falecimento_Jud'];//------- 31
                $df_TX_Mes_Falecimento_Jud=$ddf['TX_Mes_Falecimento_Jud'];//------- 32
                $df_TX_Ano_Falecimento_Jud=$ddf['TX_Ano_Falecimento_Jud'];//------- 33
                $df_TX_OBS=$ddf['TX_OBS'];//--------------------------------------- 34
                $df_NR_Fase_Cadastro=$ddf['NR_Fase_Cadastro'];//------------------- 35
                $df_NR_ImagensFicha=intval($ddf['NR_ImagensFicha']);//------------- 36
                $df_BL_FichaCompleta=$ddf['BL_FichaCompleta'];//------------------- 37
                $df_TX_Cadastrador=$ddf['TX_Cadastrador'];//----------------------- 38
                $df_DT_Cadastro=$ddf['DT_Cadastro'];//----------------------------- 39
                $df_HR_Cadastro=$ddf['HR_Cadastro'];//----------------------------- 40

/* OK, FUNCIONANDO! 
                echo 'TX_Matricula :'.$df_TX_Matricula.'<br/>';
                echo 'TX_TipoFicha :'.$df_TX_TipoFicha.'<br/>';
                echo 'TX_TituloPessoa :'.$df_TX_TituloPessoa.'<br/>';
                echo 'TX_Nome :'.$df_TX_Nome.'<br/>';
                echo 'TX_Sobrenome :'.$df_TX_Sobrenome.'<br/>';
                echo 'TX_SobrenomeSolteiraFicha :'.$df_TX_SobrenomeSolteiraFicha.'<br/>';
                echo 'TX_Sexo :'.$df_TX_Sexo.'<br/>';
                echo 'DT_Nascimento :'.$df_DT_Nascimento.'<br/>';
                echo 'TX_Idade :'.$df_TX_Idade.'<br/>';
                echo 'TX_Nacionalidade :'.$df_TX_Nacionalidade.'<br/>';
                echo 'TX_Naturalidade :'.$df_TX_Naturalidade.'<br/>';
                echo 'TX_EstadoCivil :'.$df_TX_EstadoCivil.'<br/>';
                echo 'TX_Pai :'.$df_TX_Pai.'<br/>';
                echo 'TX_Mae :'.$df_TX_Mae.'<br/>';
                echo 'TX_NomeConjuge :'.$df_TX_NomeConjuge.'<br/>';
                echo 'TX_SobrenomeConjuge :'.$df_TX_SobrenomeConjuge.'<br/>';
                echo 'TX_SobrenomeSolteiraConjuge :'.$df_TX_SobrenomeSolteiraConjuge.'<br/>';
                echo 'TX_Identidade :'.$df_TX_Identidade.'<br/>';
                echo 'TX_Expedicao :'.$df_TX_Expedicao.'<br/>';
                echo 'TX_Profissao :'.$df_TX_Profissao.'<br/>';
                echo 'DT_AceitacaoSocio :'.$df_DT_AceitacaoSocio.'<br/>';
                echo 'TX_TituloProponente1 :'.$df_TX_TituloProponente1.'<br/>';
                echo 'TX_NomeProponente1 :'.$df_TX_NomeProponente1.'<br/>';
                echo 'TX_SobrenomeProponente1 :'.$df_TX_SobrenomeProponente1.'<br/>';
                echo 'TX_SexoProponente1 :'.$df_TX_SexoProponente1.'<br/>';
                echo 'TX_TituloProponente2 :'.$df_TX_TituloProponente2.'<br/>';
                echo 'TX_Proponente2 :'.$df_TX_Proponente2.'<br/>';
                echo 'TX_Destino :'.$df_TX_Destino.'<br/>';
                echo 'DT_Falecimento:'.$df_DT_Falecimento.'<br/>';
                echo 'TX_DiaFalecimento_Jud :'.$df_TX_Dia_Falecimento_Jud.'<br/>';
                echo 'TX_MesFalecimento_Jud :'.$df_TX_Mes_Falecimento_Jud.'<br/>';
                echo 'TX_AnoFalecimento_Jud :'.$df_TX_Ano_Falecimento_Jud.'<br/>';
                echo 'TX_OBS :'.$df_TX_OBS.'<br/>';
                echo 'BL_FichaCompleta :'.$df_BL_FichaCompleta.'<br/>';
                echo 'NR_ImagensFicha :'.$df_NR_ImagensFicha.'<br/>';
                echo 'TX_Cadastrador]:'.$ddf['TX_Cadastrador'].'<br/>';
                echo 'DT_Cadastro]:'.$ddf['DT_Cadastro'].'<br/>';
                echo 'HR_Cadastro]:'.$ddf['HR_Cadastro'].'<br/>';

                //echo "::::::: df_TX_Cadastrador = SESSION['usu']['varLogin']? :".$df_TX_Cadastrador." = ". $_SESSION['usu']['varLogin']."??? <br/>";
*/                  
             // coloca os valores na SESSION, se não for nulo
                $_SESSION['ficha']['varMatricula']=$df_TX_Matricula;//------------------------ 01
                $_SESSION['ficha']['varTipoFicha']=$df_TX_TipoFicha;//------------------------ 02
                $_SESSION['ficha']['varTituloPessoa']=$df_TX_TituloPessoa;//--------------------- 03
                $_SESSION['ficha']['varNome']=$df_TX_Nome;//---------------------------------- 04
                $_SESSION['ficha']['varSobrenome']=$df_TX_Sobrenome;//------------------------ 05
                $_SESSION['ficha']['varSobrenomeSolteiraFicha']=$df_TX_SobrenomeSolteiraFicha;//-------- 06
                $_SESSION['ficha']['varSexo']=$df_TX_Sexo;//---------------------------------- 07
                $_SESSION['ficha']['varDataNascimento']=$df_DT_Nascimento;//------------------ 08
                $_SESSION['ficha']['varIdade']=$df_TX_Idade;//-------------------------------- 09
                $_SESSION['ficha']['varNacionalidade']=$df_TX_Nacionalidade;//---------------- 10
                $_SESSION['ficha']['varNaturalidade']=$df_TX_Naturalidade;//------------------ 11
                $_SESSION['ficha']['varEstadoCivil']=$df_TX_EstadoCivil;//-------------------- 12
                $_SESSION['ficha']['varPai']=$df_TX_Pai;//------------------------------------ 13
                $_SESSION['ficha']['varMae']=$df_TX_Mae;//------------------------------------ 14
                $_SESSION['ficha']['varNomeConjuge']=$df_TX_NomeConjuge;//-------------------- 15
                $_SESSION['ficha']['varSobrenomeConjuge']=$df_TX_SobrenomeConjuge;//---------- 16
                $_SESSION['ficha']['varSobrenomeSolteiraConjuge']=$df_TX_SobrenomeSolteiraConjuge;//- 16-2
                $_SESSION['ficha']['varIdentidade']=$df_TX_Identidade;//---------------------- 17
                $_SESSION['ficha']['varExpedicao']=$df_TX_Expedicao;//------------------------ 18
                $_SESSION['ficha']['varProfissao']=$df_TX_Profissao;//------------------------ 19
                $_SESSION['ficha']['varDataAceitacao']=$df_DT_AceitacaoSocio;//--------------- 20
                $_SESSION['ficha']['varTituloProponente1']=$df_TX_TituloProponente1;//-------------- 21
                $_SESSION['ficha']['varNomeProponente1']=$df_TX_NomeProponente1;//------------ 22
                $_SESSION['ficha']['varSobrenomeProponente1']=$df_TX_SobrenomeProponente1;//-- 23
                $_SESSION['ficha']['varSexoProponente1']=$df_TX_SexoProponente1;//------------ 24
                $_SESSION['ficha']['varTituloProponente2']=$df_TX_TituloProponente2;//-------------- 25
                $_SESSION['ficha']['varNomeProponente2']=$df_TX_NomeProponente2;//-------------26
                $_SESSION['ficha']['varSobrenomeProponente2']=$df_TX_SobrenomeProponente2;//-- 27
                $_SESSION['ficha']['varSexoProponente2']=$df_TX_SexoProponente2;//------------ 28
                $_SESSION['ficha']['varDestino']=$df_TX_Destino;//---------------------------- 29
                $_SESSION['ficha']['varDataFalecimento']=$df_DT_Falecimento;//---------------- 30
                $_SESSION['ficha']['varDiaFalecimentoJud']=$df_TX_Dia_Falecimento_Jud;//------ 31
                $_SESSION['ficha']['varMesFalecimentoJud']=$df_TX_Mes_Falecimento_Jud;//------ 32
                $_SESSION['ficha']['varAnoFalecimentoJud']=$df_TX_Ano_Falecimento_Jud;//------ 33
                $_SESSION['ficha']['varObs']=$df_TX_OBS;//------------------------------------ 34
                $_SESSION['ficha']['fase']=$df_NR_Fase_Cadastro;//---------------------------- 35
                $_SESSION['ficha']['varFichaCompleta']=$df_BL_FichaCompleta;//---------------- 36
                $_SESSION['ficha']['varNumImagensFicha']=$df_NR_ImagensFicha;//--------------- 37
                $_SESSION['ficha']['varCadastrador']=$df_TX_Cadastrador;//-------------------- 38
                $_SESSION['ficha']['varDataCadastro']=$df_DT_Cadastro;//---------------------- 39
                $_SESSION['ficha']['varHoraCadastro']=$df_HR_Cadastro;//---------------------- 40
                $_SESSION['ficha']['mse']="";

                // -------------------------------------------------------------------------------------------------------------------------------------------------------  
/*
                echo  '01 SESSION[ficha][varMatricula]:' .$_SESSION['ficha']['varMatricula'].'<br/>';
                echo  '02  SESSION[ficha][varTipoFicha]:' . $_SESSION['ficha']['varTipoFicha'].'<br/>';
                echo  '03  SESSION[ficha][varTitPessoa]:' . $_SESSION['ficha']['varTitPessoa'].'<br/>';
                echo  '04  SESSION[ficha][varNome]:' . $_SESSION['ficha']['varNome'].'<br/>';
                echo  '05  SESSION[ficha][varSobrenome]:' . $_SESSION['ficha']['varSobrenome'].'<br/>';
                echo  '06  SESSION[ficha][varSobrenomeSolteiraFicha]:' . $_SESSION['ficha']['varSobrenomeSolteiraFicha'].'<br/>';
                echo  '07  SESSION[ficha][varSexo]:' . $_SESSION['ficha']['varSexo'].'<br/>';
                echo  '08  SESSION[ficha][varDataNascimento]:' . $_SESSION['ficha']['varDataNascimento'].'<br/>';
                echo  '09  SESSION[ficha][varIdade]:' . $_SESSION['ficha']['varIdade'].'<br/>';
                echo  '10  SESSION[ficha][varEstadoCivil]:' . $_SESSION['ficha']['varEstadoCivil'].'<br/>';
                echo  '11  SESSION[ficha][varSobrenomeConjuge]:' . $_SESSION['ficha']['varSobrenomeConjuge'].'<br/>';
                echo  '12  SESSION[ficha][varNomeConjuge]:' . $_SESSION['ficha']['varNomeConjuge'].'<br/>';
                echo  '122 SESSION[ficha][varSobrenomeSolteiraConjuge]:' . $_SESSION['ficha']['varSobrenomeSolteiraConjuge'].'<br/>';
                echo  '13  SESSION[ficha][varPai]:' . $_SESSION['ficha']['varPai'].'<br/>';
                echo  '14  SESSION[ficha][varMae]:' . $_SESSION['ficha']['varMae'].'<br/>';
                echo  '15  SESSION[ficha][varNacionalidade]:' . $_SESSION['ficha']['varNacionalidade'].'<br/>';
                echo  '16  SESSION[ficha][varNaturalidade]:' . $_SESSION['ficha']['varNaturalidade'].'<br/>';
                echo  '17  SESSION[ficha][varIdentidade]:' . $_SESSION['ficha']['varIdentidade'].'<br/>';
                echo  '18  SESSION[ficha][varExpedicao]:' . $_SESSION['ficha']['varExpedicao'].'<br/>';
                echo  '19  SESSION[ficha][varProfissao]:' . $_SESSION['ficha']['varProfissao'].'<br/>';
                echo  '20  SESSION[ficha][varDataAceitacao]:' . $_SESSION['ficha']['varDataAceitacao'].'<br/>';
                echo  '21  SESSION[ficha][varTituloProponente1]:' . $_SESSION['ficha']['varTituloProponente1'].'<br/>';
                echo  '22  SESSION[ficha][varNomeProponente1]:' . $_SESSION['ficha']['varNomeProponente1'].'<br/>';
                echo  '23  SESSION[ficha][varSobrenomeProponente1]:' . $_SESSION['ficha']['varSobrenomeProponente1'].'<br/>';
                echo  '24  SESSION[ficha][varSexoProponente1]:' . $_SESSION['ficha']['varSexoProponente1'].'<br/>';
                echo  '25  SESSION[ficha][varTituloProponente2]:' . $_SESSION['ficha']['varTituloProponente2'].'<br/>';
                echo  '26  SESSION[ficha][varNomeProponente2]:' . $_SESSION['ficha']['varNomeProponente2'].'<br/>';
                echo  '27  SESSION[ficha][varSobrenomeProponente2]:' . $_SESSION['ficha']['varSobrenomeProponente2'].'<br/>';
                echo  '28  SESSION[ficha][varSexoProponente2]:' . $_SESSION['ficha']['varSexoProponente2'].'<br/>';
                echo  '29  SESSION[ficha][varDestino]:' . $_SESSION['ficha']['varDestino'].'<br/>';
                echo  '30  SESSION[ficha][varDataFalecimento]:' . $_SESSION['ficha']['varDataFalecimento'].'<br/>';
                echo  '31  SESSION[ficha][varDiaFalecimentoJud]:' . $_SESSION['ficha']['varDiaFalecimentoJud'].'<br/>';
                echo  '32  SESSION[ficha][varMesFalecimentoJud]:' . $_SESSION['ficha']['varMesFalecimentoJud'].'<br/>';
                echo  '33  SESSION[ficha][varAnoFalecimentoJud]:' . $_SESSION['ficha']['varAnoFalecimentoJud'].'<br/>';
                echo  '34  SESSION[ficha][varObs]:' . $_SESSION['ficha']['varObs'].'<br/>';
                echo  '35  SESSION[ficha][fase]:' . $_SESSION['ficha']['fase'].'<br/>';
                echo  '36  SESSION[ficha][varFichaCompleta]:' . $_SESSION['ficha']['varFichaCompleta'].'<br/>';
                echo  '37  SESSION[ficha][varNumImagensFicha]:' . $_SESSION['ficha']['varNumImagensFicha'].'<br/>';
                echo  '38  SESSION[ficha][varCadastrador]:' . $_SESSION['ficha']['varCadastrador'].'<br/>';
                echo  '39  SESSION[ficha][varDataCadastro]:' . $_SESSION['ficha']['varDataCadastro'].'<br/>';
                echo '40  SESSION[ficha][varHoraCadastro]:' . $_SESSION['ficha']['varHoraCadastro'].'<br/>';
*/

                if($_SESSION['usu']['nvAcesso']<=3){// Nível menor que 3 - verifica se ficha é dessa pessoa
                    
                    if($df_TX_Cadastrador !== $_SESSION['usu']['varLogin']){//Usuário não foi quem gravou
                    echo "Volta para o login - tentativa de abrir ficha de outra pessoa pela URL. <br/>";    
                    header("Location:index.php");//Volta para o login - tentativa de abrir ficha de outra pessoa pela URL
                    }
                }    

                //---------------------------------------------------------------------------------------------------------------------------------
            }// end while
            // fecha a conexão
            mysqli_close($conexao);
        }// fim Se conexão
    }// end if se existe GET

?>
    </body>
    </html>    
