<?php 
    // inicia a sessão
     !isset($_SESSION['usu'])?session_start():null;
     $langLogin="po";
     ?>
    <?php include 'head.php'; ?>
    <!-- ?php include 'scripts.php'; ?> -->
<?php

   // $_SESSION['usu']['varNome'] = $dadosLogin['TX_Nome'];
   // $_SESSION['usu']['varSobrenome'] =$dadosLogin['TX_Sobrenome'];
   // $_SESSION['usu']['varSexo'] = $dadosLogin['TX_Sexo'];
   // $_SESSION['usu']['varEmail'] = $dadosLogin['TX_Email'];
   // $_SESSION['usu']['varTel'] = $dadosLogin['TX_Telefone'];
   // $_SESSION['usu']['varCel'] =$dadosLogin['TX_Celular'];

    //echo "PHPSESSID: " . $_SERVER['PHPSESSID']."<br/>" ;
    //echo "SESSION['usu'][varNome]:". $_SESSION['usu']['varNome']."<br/>" ;
    //echo "SESSION['usu'][varSobrenome]: ". $_SESSION['usu']['varSobrenome']."<br/>" ;
    //echo "SESSION['usu'][varSexo]: ". $_SESSION['usu']['varSexo']."<br/>" ;
    //echo "SESSION['usu'][varTel]: " . $_SESSION['usu']['varTel']."<br/>" ;
    //echo "SESSION['usu'][varCel]: " . $_SESSION['usu']['varCel'] ."<br/>" ;
    //echo "SESSION['usu'][varEmail]: " . $_SESSION['usu']['varEmail'] ."<br/>" ;
    //echo "Check: Session name: ". session_name()."<br/>";
    //echo "Check: session_status: ". session_status()."<br/>";

    //echo "1 chkLogin: " . $chkLogin ." = SESSION[chkLogin]: " . $_SESSION['usu']["chkLogin"] . ". <br/>";
    //echo "2 msgLogin: " . $msgLogin ." - SESSION[msgLogin]: " . $_SESSION['usu']["msgLogin"] . ". <br/>";

//if (isset($_COOKIE['langLogin']))
//      {
//        $langLogin=$_COOKIE["langLogin"];//$_SESSION['usu']["lang"]=$lang;        //$idioma="ale";
////  echo " ENTRADA depois IF cookie: lang: " . "'".$langLogin."'" . " - _COOKIE[langLogin]: " ."'". $_COOKIE["langLogin"]. "<br/>";
//      }
//      else
//      {$langLogin='de';}

if ($langLogin==='de')
        {
        $txLogin="Forscher";
        $txSenha="Passwort";
        $txtNovaSenha="Neues passwort";
        $txConfSenha="Neues passwort - bestätigung";
        $linkEsqSenha="Ich habe mein passwort vergessen";
        $linkTroca="Passwort ändern";
        $txBotao="Anmelden";
        $msgLoginForgot="Ihr Passwort wurde an Ihre E-Mail geschickt. Bitte melden Sie sich erneut mit korrektem Login und Passwort an.";
        $msgLoginTrOK="Ihr Passwort wurde mit Erfolg geändert. Bitte melden Sie sich erneut mit neuem Passwort an.";
        $msgLoginTrNOK="Ihr Passwort hat sich nicht geändert. Bitte überprüfen Sie Ihre Anmeldung und Ihr Passwort und versuchen Sie es erneut.";
        $msgLoginNOK="Benutzer und / oder Passwort falsch(s).<br/>Bitte füllen Sie Ihre Anmeldung und Passwort.";
        $msgLogin= "Bitte füllen Sie Ihre Anmeldung und Passwort.";

        }
    if ($langLogin==='en')
        {
        $txLogin="Researcher";
        $txSenha="Password";
        $txNovaSenha="New password";
        $txConfSenha="New password - confirmation";
        $linkEsqSenha="I forgot my password";
        $linkTroca="Change password";
        $txBotao="Go";
        $msgLoginForgot="Your password was sento to your e-mail. Please, try login again with correct login and password.";
        $msgLoginTrOK="Your password was changed with success. Please, login again with new password.";
        $msgLoginTrNOK="Your password didn't changed. Please, check your login and password and try it again.";
        $msgLoginNOK="User and/or password incorrect(s).<br/>Please, fill your login and password";
        $msgLogin= "Please, fill your login and password.";
        $saudacao="Wellcome, ".$_SESSION['usu']['varNome']." ".$_SESSION['usu']['varSsobrenome']."!";
        }
    if ($langLogin==="po")
        {
        $txLogin="Pesquisador";
        $txSenha="Senha";
        $txNovaSenha="Nova senha";
        $txConfSenha="Nova senha - confirmação";
        $linkEsqSenha="Esqueci minha senha";
        $linkTroca="Trocar senha";
        $txBotao="Entrar";
        $msgLoginForgot="Sua senha foi enviada para seu e-mail. Por favor, tente novamente com usuário e senha corretos.";
        $msgLoginTrOK="Sua senha foi alterada com sucesso. Por favor, faça seu login com a nova senha.";
        $msgLoginTrNOK="Sua senha NÃO foi alterada. Por favor, verifique usuário e senha e tente novamente.";
        $msgLoginNOK="Usuário e/ou senha incorreto(s).<br/>Por favor, entre com seu usuário e senha.";
        $msgLogin= "Por favor, entre com seu usuário e senha.";
        //echo "Sexo  dx Pesquisadxr: ". $_SESSION['usu']['varSexo'];
        }
        if($_SESSION['usu']['varSexo']=="M"){$dsexo="o";} else {$dsexo="a";}
        //$saudacao="Bem-vind".$dsexo.", ".$_SESSION['usu']['varNome']." ".$_SESSION['usu']['varSobrenome']."!";

//$minha_url="http://" .filter_input(INPUT_SERVER, 'REQUEST_URI', FILTER_SANITIZE_STRING);

//if(isset($_GET['chkLogin'])){
//    $chkLogin=trim(filter_input(INPUT_GET,'chkLogin'), FILTER_SANITIZE_STRING);
//}

$minha_url= "http://" . $_SERVER["REQUEST_URI"] ; //$_SERVER['PHP_SELF']
$chkLogin=isset($_GET['chkLogin'])?trim($_GET['chkLogin']):null;
  if($chkLogin!="undefined" AND $chkLogin!='')
    {
      $_SESSION['usu']['chkLogin']=$chkLogin; 
      if($chkLogin==="forgot")
        {$_SESSION['usu']["msgLogin"]=$msgLoginForgot;}
      if($chkLogin==="TrOK")
       { $_SESSION['usu']["msgLogin"]=$msgLoginTrOK;}
      if($chkLogin==="TrNOK")
       { $_SESSION['usu']["msgLogin"]=$msgLoginTrNOK;}
      if($chkLogin==="NOK")
       { $_SESSION['usu']["msgLogin"]=$msgLoginNOK;}

    }
    else { $_SESSION['usu']["msgLogin"]= $msgLogin;}
    
         //echo "1 chkLogin: " . $chkLogin ." - SESSION[chkLogin]: " . $_SESSION['usu']["chkLogin"] . ". <br/>";
         // echo "2 msgLogin: " . $msgLogin ." - SESSION[msgLogin]: " . $_SESSION['usu']["msgLogin"] . ". <br/>";
global $mat, $fase, $status;
function abrirFicha($mat, $fase, $status){
        $_SESSION['ficha']['fase']=$fase;
        if($status==1){
            //Ficha completa
            header("Location:finalFicha.php?mat=".$mat);
            die();
        }else{
            //Ficha incompleta
            header("Location:cadastroFicha.php?mat=".$mat);
            die();
        }
    }
?>
<body>
<?php include 'menu.php'; ?>
<?php include 'topoHomePesquisador.php'; ?>
  <main role="main" class="container">
    <div id="ldados" class="LayerDados">
      <form id="FORM_Dados" name="FORM_Dados" method="post" action="alterarDadosPesquisador.php">
      <div class="collapse" id="infosPesquisador">
        <div class="d-flex align-items-end">
          <div class="col-5 px-0">
            <div class="card mb-0">
              <div class="card-body finalizado">
                <div class="form-group col-12 d-flex align-items-center">
                  <label class="col-auto pl-0">Seu e-mail:</label>
                  <input name="TX_EMAIL" id="TX_EMAIL"  type="text" class="form-control" value="<?php echo $_SESSION['usu']['varEmail']; ?>">
                </div>
                <div class="form-group col-12 d-flex align-items-center">
                  <label class="col-auto pl-0">Seu tel. fixo:</label>
                  <input name="TX_TEL" id="TX_TEL" type="text" class="form-control" value="<?php echo $_SESSION['usu']['varTel']; ?>">
                </div>
                <div class="form-group col-12 d-flex align-items-center">
                  <label class="col-auto pl-0">Seu cel. | WhatsApp:</label>
                  <input name="TX_CEL" id="TX_CEL" type="text" class="form-control" value="<?php echo $_SESSION['usu']['varCel']; ?>">
                </div>
                <div class="text-right col">
                  <button type="submit" class="btn btn-primary btn-sm">Salvar</button>
                  <div id="botaoSalvarEmail"></div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
      <div class="col-12 px-0 mt-3 mb-4">
        <?php 
          $_SESSION['ficha'] = []; // inicia o array Session das fichas
          $_SESSION['ficha']['varMatricula']="";
          $_SESSION['ficha']['varTipoFicha']="";
          ?>
          <button type="button" class="btn btn-success" onclick="javascript:location.href='cadastroNovaFicha.php';">CADASTRAR NOVA FICHA</button>
      </div>
      </form>
    <?php
    //  Aqui vai um select para cada grupo e loop para escrever ***  
        //SQL para buscar as fichas do usuário
    if($_SESSION['usu']['nvAcesso']>3){// Nível maior que 3 acessará as fichas sem imagem
        $sqlFichasDoUsuario="SELECT * FROM dbkartei.tab_fichas ORDER BY TX_Matricula ";
    }else{
        $sqlFichasDoUsuario="SELECT * FROM dbkartei.tab_fichas WHERE TX_Cadastrador='".$_SESSION['usu']['varLogin']."' ORDER BY TX_Matricula ";
    }
   // echo "sqlFichasDoUsuario: ". $sqlFichasDoUsuario . "<br>"; // OK

    //abre_conexao;  eX: "$pMysqli = new mysqli('p:'.DB_HOST, DB_USERNAME, DB_PASSWORD, DB_NAME);"
    $conexao = mysqli_connect('66.33.203.11', 'kartei', 'ktARI#19', 'dbkartei'); // Produção
    // $conexao = mysqli_connect("mysql.cs2rio.com", "heritagehistory", "me22olatto", "hhdatabase"); // Site

    if (!$conexao ) {
        echo "Error: Connection with DB MySQL is fail." . PHP_EOL;
        echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
        exit;
    }
    else{
        //echo "Conexão Ok.<br/>"; //OK
        $rsDados=mysqli_query($conexao, $sqlFichasDoUsuario);
        $numLinhas=mysqli_num_rows($rsDados); // OK
        //echo "Linhas: ". $numLinhas ."<br/>"; // OK

        $FichasCompletas=[];
        $FichasCompletasSemImagem=[];
        $FichasIncompletas=[];
        $faseF=[];
        $cad=[];
        $cont=0;
        $nFC=0;
        $nFCSI=0;
        $nFI=0;
        while($dadosFichas=mysqli_fetch_assoc($rsDados)) // ================================= WHILE pata varrer SELECT
        {
            $fichaCompleta=intval($dadosFichas['BL_FichaCompleta']);
            $fichaMatricula=$dadosFichas['TX_Matricula'];
            $fichaNome=$dadosFichas['TX_Nome'];
            $fichaSobrenome=$dadosFichas['TX_Sobrenome'];
            $fichaFotos=intval($dadosFichas['NR_ImagensFicha']);
            $cadastrador=$dadosFichas['TX_Cadastrador'];
            $fichaNomeCompleto=$fichaSobrenome.", ".$fichaNome;
            $fichaFaseCadastro=$dadosFichas['NR_Fase_Cadastro'];
   /*         echo "-----------------------------------------------------------------------------------------------------------<br/>";
            echo "fichaCompleta: ".$fichaCompleta."<br/>";
            echo "fichaMatricula: ".$fichaMatricula."<br/>";
            echo "fichaNome: ".$fichaNome."<br/>";
            echo "fichaSobrenome: ".$fichaSobrenome."<br/>";
            echo "fichaNomeCompleto: ".$fichaNomeCompleto."<br/>";
            echo "fichaFotos: ".$fichaFotos."<br/>";
            echo "Pesquisador: ".$cadastrador."<br/>";
            echo "-----------------------------------------------------------------------------------------------------------<br/>";
     */     // Verifica Nível de acesso(3 colunas)
            if($_SESSION['usu']['nvAcesso']>3){// Nível maior que 3 acessará as fichas sem imagem   
            //Fichas completas no Cadastro Histórico	 Fichas completas sem imagens	 Fichas incompletas em cadastramento
            //Matr.	Nome                Nº ft	 Matr.	Nome                     Matr.	Nome                    Nº ft    
                if($fichaCompleta==1){//Ficha completa
                    if($fichaFotos>0){//Ficha completa com imagens
                        $FichasCompletas[$nFC]['FC']['Matr']=$fichaMatricula;
                        $FichasCompletas[$nFC]['FC']['Nome']=$fichaNomeCompleto;
                        $FichasCompletas[$nFC]['FC']['NumFotos']=$fichaFotos;
                        $cad[intval($fichaMatricula)]=$cadastrador;
                        $faseF[intval($fichaMatricula)]=$fichaFaseCadastro;
                        //echo $cont." - FichasCompletas[".$nFC."]['FC']['Matr']: ".$fichaMatricula."<br>";
                        //echo $cont." - FichasCompletas[".$nFC."]['FC']['Nome']: ".$fichaNomeCompleto."<br>";
                        //echo $cont." - FichasCompletas[".$nFC."]['FC']['NumFotos']: ".$fichaFotos."<br>";
                        $nFC++;
                        $cont++;
                    }else{// fim ficha completa e início ficha completa sem imagens
                        $FichasCompletasSemImagem[$nFCSI]['FCSI']['Matr']=$fichaMatricula;
                        $FichasCompletasSemImagem[$nFCSI]['FCSI']['Nome']=$fichaNomeCompleto;
                        $cad[intval($fichaMatricula)]=$cadastrador;
                        $faseF[intval($fichaMatricula)]=$fichaFaseCadastro;
                        //echo $cont." - FichasCompletasSemImagem[".$nFCSI."]['FCSI']['Matr']: ".$fichaMatricula."<br>";
                        //echo $cont." - FichasCompletasSemImagem[".$nFCSI."]['FCSI']['Nome']: ".$fichaNomeCompleto."<br>";
                        $nFCSI++;
                        $cont++;
                    }
                }else{// Fim ficha completa sem imagens e início Ficha incompleta
                    $FichasIncompletas[$nFI]['FI']['Matr']=$fichaMatricula;
                    $FichasIncompletas[$nFI]['FI']['Nome']=$fichaNomeCompleto;
                    $FichasIncompletas[$nFI]['FI']['NumFotos']=$fichaFotos;
                    $cad[intval($fichaMatricula)]=$cadastrador;
                    $faseF[intval($fichaMatricula)]=$fichaFaseCadastro;
                   // echo $cont." - FichasIncompletas[".$nFI."]['FI']['Matr']: ".$fichaMatricula."<br>";
                   // echo $cont." - FichasIncompletas[".$nFI."]['FI']['Nome']: ".$fichaNomeCompleto."<br>";
                   //echo $cont." - FichasIncompletas[".$nFI."]['FI']['NumFotos']: ".$fichaFotos."<br>";
                    $nFI++;
                    $cont++;
                }// fim if ficha completa
            }
            if($_SESSION['usu']['nvAcesso']<=3){ //else{// fim verif nível: pesquisador - junta as fichas completas  =========================================== PESQUISADOR
                if($fichaCompleta==1){//Ficha completa
                    $FichasCompletas[$nFC]['FC']['Matr']=$fichaMatricula;
                    $FichasCompletas[$nFC]['FC']['Nome']=$fichaNomeCompleto;
                    $FichasCompletas[$nFC]['FC']['NumFotos']=$fichaFotos;
                    $faseF[intval($fichaMatricula)]=$fichaFaseCadastro;
                    //echo $cont." - FichasCompletas[".$nFC."]['FC']['Matr']: ".$fichaMatricula."<br>";
                    //echo $cont." - FichasCompletas[".$nFC."]['FC']['Nome']: ".$fichaNomeCompleto."<br>";
                    //echo $cont." - FichasCompletas[".$nFC."]['FC']['NumFotos']: ".$fichaFotos."<br>";
                    $nFC++;
                    $cont++;
                }else{// Ficha incompleta
                    $FichasIncompletas[$nFI]['FI']['Matr']=$fichaMatricula;
                    $FichasIncompletas[$nFI]['FI']['Nome']=$fichaNomeCompleto;
                    $FichasIncompletas[$nFI]['FI']['NumFotos']=$fichaFotos;
                    $faseF[intval($fichaMatricula)]=$fichaFaseCadastro;
                   // echo $cont." - FichasIncompletas[".$nFI."]['FI']['Matr']: ".$fichaMatricula."<br>";
                   // echo $cont." - FichasIncompletas[".$nFI."]['FI']['Nome']: ".$fichaNomeCompleto."<br>";
                   //echo $cont." - FichasIncompletas[".$nFI."]['FI']['NumFotos']: ".$fichaFotos."<br>";
                    $nFI++;
                    $cont++;
                }// fim if ficha completa
            }//fim if nível <=3
        }//fim while
            $maior=max($nFC,$nFCSI,$nFI);
        //echo "Maior entre nFC=".$nFC.", nFCsI=".$nFCSI. ",nFI=".$nFI." : ".$maior."<br/>"; // OK

        if($_SESSION['usu']['nvAcesso']>3){// Formação da tabela  ######################################################################### ADM
          echo "<div class='row align-items-stretch'>";
          echo "<div class='col-4 pr-0 d-flex align-items-stretch' id='tab_FC'><div class='card w-100'>";
          echo "<div class='card-header bg-completas border-0 px-2'><span class='text-uppercase'>Cadastro Histórico</span><br/>fichas completas com imagem</div>";
          echo "<div class='card-body p-0 border-0'><table id='tab_FichasCompletas' class='table table-striped table-sm'>";
          echo "<thead><tr>";
          echo "<th>Mat.</th>";
          echo "<th>Associado</th>";
          echo "<th>Pesquisador</th>";
          //echo "<th>Fotos</th>";
          echo "</tr></thead>";
            for($linhaFC=0;$linhaFC<$nFC;$linhaFC++){ // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ FC ADM
                $cadFC=$cad[intval($FichasCompletas[$linhaFC]['FC']['Matr'])];
                $mtFC=$FichasCompletas[$linhaFC]['FC']['Matr'];
                $fsFC=$faseF[intval($mtFC)];
                echo "<tr>";
                echo "<td><a href='#' onClick=\"abreFicha('".$FichasCompletas[$linhaFC]['FC']['Matr']."',".$fsFC.",1);\"> ".$FichasCompletas[$linhaFC]['FC']['Matr']."</a></td>";
                echo "<td>".$FichasCompletas[$linhaFC]['FC']['Nome']."</td>";
                echo "<td>".$cadFC."</td>";
                //echo "<td class='text-center'>".$FichasCompletas[$linhaFC]['FC']['NumFotos']."</td>";
                echo "</tr>";
            }   // fim for linhaFC  // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   FC    ADM
          echo "</table>";
          echo "</div></div></div>";

          echo "<div class='col-4 d-flex align-items-stretch' id='tab_FCSI'><div class='card w-100'>";
          echo "<div class='card-header bg-sem-img border-0 px-2'><span class='text-uppercase'>Cadastro Histórico</span><br/>fichas completas sem imagem</div>";
          echo "<div class='card-body p-0 border-0'><table id='tab_FichasCompletasSemImagem' class='table table-striped table-sm'>";
          echo "<thead><tr>";
          echo "<th>Mat.</th>";
          echo "<th>Associado</th>";
          echo "<th>Pesquisador</th>";
          echo "</tr></thead>";
            for($linhaFCSI=0;$linhaFCSI<$nFCSI;$linhaFCSI++){ // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ FCSI ADM
                $cadFCSI=$cad[intval($FichasCompletasSemImagem[$linhaFCSI]['FCSI']['Matr'])];
                $mtFCSI=$FichasCompletasSemImagem[$linhaFCSI]['FCSI']['Matr'];
                $fsFCSI=$faseF[intval($mtFCSI)];
                echo "<tr>";
                echo "<td><a href='#' onClick=\"abreFicha('".$FichasCompletasSemImagem[$linhaFCSI]['FCSI']['Matr']."',".$fsFCSI.",1);\"> ".$FichasCompletasSemImagem[$linhaFCSI]['FCSI']['Matr']."</a></td>";
                echo "<td>".$FichasCompletasSemImagem[$linhaFCSI]['FCSI']['Nome']."</td>";
                echo "<td>".$cadFCSI."</td>";
                echo "</tr>";
            }   // fim for linhaFC  // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@      FCSI  ADM
          echo "</table>";
          echo "</div></div></div>";

          echo "<div class='col-4 pl-0 d-flex align-items-stretch' id='tab_FI'><div class='card w-100'>";
          echo "<div class='card-header bg-incompletas border-0 px-2'><span class='text-uppercase font-italic'>Em cadastramento</span><br/>fichas incompletas</div>";
          echo "<div class='card-body p-0 border-0'><table id='tab_FichasIncompletas' class='table table-striped table-sm'>";
          echo "<thead><tr>";
          echo "<th>Mat.</th>";
          echo "<th>Associado</th>";
          echo "<th>Pesquisador</th>";
          //echo "<th>Fotos</th>";
          echo "</tr></thead>";
            for($linhaFI=0;$linhaFI<$nFI;$linhaFI++){ // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ FI ADM
                $cadFI=$cad[intval($FichasIncompletas[$linhaFI]['FI']['Matr'])];
                $mtFI=$FichasIncompletas[$linhaFI]['FI']['Matr'];
                $fsFI=$faseF[intval($mtFI)];
                echo "<tr>";
                echo "<td><a href='#' onClick=\"abreFicha('".$FichasIncompletas[$linhaFI]['FI']['Matr']."',".$fsFI.",0);\"> ".$FichasIncompletas[$linhaFI]['FI']['Matr']."</a></td>";
                echo "<td>".$FichasIncompletas[$linhaFI]['FI']['Nome']."</td>";
                echo "<td>".$cadFI."</td>";
                //echo "<td class='text-center'>".$FichasIncompletas[$linhaFI]['FI']['NumFotos']."</td>";
                echo "</tr>";
            }   // fim for linhaFI  // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  FI ADM
          echo "</table>";
          echo "</div></div></div>";
          echo "</div>";

        }//fim verificação nível >3 para formação da tabela
        if($_SESSION['usu']['nvAcesso']<=3){// Nível de acesso é menor que 3 não verá se fichas têm imagens  ========================= PESQUISADOR
          echo "<div class='row align-items-stretch'>";
          echo "<div class='col-6 d-flex align-items-stretch' id='tab_FC'><div class='card w-100'>";
          echo "<div class='card-header bg-completas border-0 px-2'><span class='text-uppercase'>Cadastro Histórico</span><br/>fichas completas com imagem</div>";
          echo "<div class='card-body p-0 border-0'><table id='tab_FichasCompletas' class='table table-striped table-sm'>";
          echo "<thead><tr>";
          echo "<th>Matr.</th>";
          echo "<th>Associado</th>";
          echo "</tr></thead>";
            for($linhaFC=0;$linhaFC<$nFC;$linhaFC++){ // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ FC Pesq
                $mtFC=$FichasCompletas[$linhaFC]['FC']['Matr'];
                $fsFC=$faseF[intval($mtFC)];
                echo "<tr>";
                echo "<td><a href='#' onClick=\"abreFicha('".$FichasCompletas[$linhaFC]['FC']['Matr']."',".$fsFC.",1);\"> ".$FichasCompletas[$linhaFC]['FC']['Matr']."</a></td>";
                echo "<td>".$FichasCompletas[$linhaFC]['FC']['Nome']."</td>";
                echo "<tr>";

            }   // fim for linhaFC  // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@   FC    Pesq
          echo "</table>";
          echo "</div></div></div>";

          echo "<div class='col-6 pl-0 d-flex align-items-stretch' id='tab_FI'><div class='card w-100'>";
          echo "<div class='card-header bg-incompletas border-0 px-2'><span class='text-uppercase font-italic'>Em cadastramento</span><br/>fichas incompletas</div>";
          echo "<div class='card-body p-0 border-0'><table id='tab_FichasIncompletas' class='table table-striped table-sm'>";
          echo "<thead><tr>";
          echo "<th>Matr.</th>";
          echo "<th>Nome</th>";
          echo "</tr></thead>";
            for($linhaFI=0;$linhaFI<$nFI;$linhaFI++){ // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@ FI Pesq
                $mtFI=$FichasIncompletas[$linhaFI]['FI']['Matr'];
                $fsFI=$faseF[intval($mtFI)];
                echo "<tr>";
                echo "<td><a href='#' onClick=\"abreFicha('".$FichasIncompletas[$linhaFI]['FI']['Matr']."',".$fsFI.",0);\"> ".$FichasIncompletas[$linhaFI]['FI']['Matr']."</a></td>";
                echo "<td>".$FichasIncompletas[$linhaFI]['FI']['Nome']."</td>";
                echo "<tr>";
            }   // fim for linhaFI  // @@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@@  FI Pesq
          echo "</table>";
          echo "</div></div></div>";
          echo "</div>";
        }// end if nível <=3
    }// fim if conexão
    // libera result set
    $rsDados->close();
    // fecha conexão
    mysqli_close($conexao);
    ?>
    </div>

  </main>
    <script>
    function abreFicha(mat, fase, status){
        //$_SESSION['ficha']['fase']=$fase;
        if(status===1){
            //Ficha completa
            window.location.href = "finalFicha.php?mat="+mat+"&fase="+fase;
        }else{
            //Ficha incompleta
            window.location.href = "cadastroFicha.php?mat="+mat+"&fase="+fase;
        }
}
    function editarDado(campo){
        //window.alert("Entrando em Editar Dado: "+campo);
        //window.alert("Classe do campo: " + document.getElementById(campo).className);
        document.getElementById(campo).className="editarCampo";
        document.getElementById("FORM_Dados").action="alterarDadosPesquisador.php";
        switch(campo){
            case "TX_EMAIL":
                varTdBotao="botaoSalvarEmail";break;
            case "TX_TEL":
                varTdBotao="botaoSalvarTel";break;
            case "TX_CEL":    
                varTdBotao="botaoSalvarCel";break;
        }  
        //window.alert("varTdBotao: "+varTdBotao);
        //window.alert("Ação do FORM: "+document.getElementById("FORM_Dados").action);
        
        document.getElementById(varTdBotao).innerHTML='<input type="submit" class="bot_entrar" value="SALVAR" />';
        // onClick="javascript: location.href=\'alterarDadosPesquisador.php\';"/ > ';  
        
    }
    function salvarDados(){
        alterarDadosPesquisador.php;
    }

    </script>
    <script src="login.js"></script>
</body>
</html>