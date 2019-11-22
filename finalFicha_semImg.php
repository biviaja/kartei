<?php 
//if(!isset($_SESSION)){
   //header("Location:index.php");
   
    include 'head.php';

//}
?>

<?php
    global $mat, $fase;
    //$varFase=4;
    $minha_url= "http://" . $_SERVER["REQUEST_URI"] ; //$_SERVER['PHP_SELF']
    $mat=isset($_GET['mat'])?trim($_GET['mat']):null;
    $fase=isset($_GET['fase'])?trim($_GET['fase']):null;
    
    //echo "Fase da URL: ". $fase . "<br/>";

    if($fase!="undefined" AND $fase!='')
      {// Existe o GET
        $_SESSION['ficha']['fase']=$fase; 
        //echo "Fase da URL:".$fase."<br/";
      }
      if($mat!="undefined" AND $mat!='')
      {// Existe o GET
        $_SESSION['ficha']['varMatricula']=$mat; 
        //echo "Matricula da URL:".$mat."<br/";

      //Buscar no banco todas as variáveis da ficha e jogar para SESSION
      }
    ?>
    <?php include 'menu.php'; ?>
    <?php include 'logout.php'; ?>
    <?php include 'scripts.php'; ?>

    <?php
    
    $data_atual = date('d/m/Y');
    $anoAtual=date('Y');
    $mesAtual=date('m');
    
    if ($mesAtual>=9){
        $anoJ=$anoAtual+3760+1;
    }else{
          $anoJ=$anoAtual+3760;
    }
    
      
      if(!isset($_SESSION['ficha']['fase'])){
          $_SESSION['ficha']['fase']=0;
          $_SESSION['ficha']['classeErro']="";
          $_SESSION['ficha']['mse']="";
      }else{
          $varFase=intval($_SESSION['ficha']['fase']);
      }
      //echo "Fase:".$varFase." Sessão:".$_SESSION['ficha']['fase']."<br/>";
    ?>
    <main role="main" class="container">
      <form name="FORM_Fichas" id="FORM_Fichas" method="post" onsubmit="return false;">

        <div id="carrossel-passos" class="carousel slide" data-ride="carousel" data-interval="false" data-touch="false">
          
          <div class="carousel-inner">
        

   

          <!-- Início Item 6 -->
          <div class="<?php if($varFase===6){echo "carousel-item active";} else {echo "carousel-item";} ?>">
            <div class="row mt-4">
              
              <div class="col-12 finalizado">
                <div class="card">
                  <div class="card-header card-header-final" id="matriculaFase7">
                    <h4 class="d-flex px-0">mat.:<span class="num-matricula"><?php echo $_SESSION['ficha']['varMatricula']; ?></span></h4>
                    <h4></h4>
                  </div>
                  <div class="card-body row mx-0">
                    <div class="col-8">
                      <div class="form-group col-12">
                        <div class="d-flex align-items-center">                          
                          <div class="col-2">
                            <input type="text" name="TX_TITULOPESSOA_Final" id="TX_TITULOPESSOA_final" class="form-control" value="<?php echo $_SESSION['ficha']['varTituloPessoa']; ?>">
                          </div>
                          <div class="col-auto">
                            <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varNome']; ?>">
                          </div>
                          <div class="col-auto"> 
                            <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varSobrenome']; ?>">
                          </div>
                        </div>
                      </div>
                      <div class="d-flex col-12 mb-3">
                        <label for="">do sexo</label>
                        <div class="custom-control custom-radio custom-control-inline ml-3">
                          <input class="custom-control-input" type="radio" name="TX_SEXO_Final" id="masc_Final" value="M" onclick="mascFem('M');" <?php if($_SESSION['ficha']['varSexo']==="M"){ echo "checked";} ?>>
                          <label class="custom-control-label" for="masc">Masculino</label>
                        </div>
                        <div class="custom-control custom-radio custom-control-inline">
                          <input class="custom-control-input" type="radio" name="TX_SEXO_Final" id="fem_Final" value="F" onclick="mascFem('F');" <?php if($_SESSION['ficha']['varSexo']==="F"){ echo "checked";} ?>>
                          <label class="custom-control-label" for="fem">Feminino</label>
                        </div>
                      </div>
                      <div class="form-group col-12">
                        <div class="row px-3">
                          <div class="custom-control custom-radio custom-control-inline col-auto">
                            <input class="custom-control-input" type="radio" name="dataIdade_Final" id="dataNascRadio_Final" value="option2" <?php if($_SESSION['ficha']['varDataNascimento']!==""){ echo "checked";} ?> onClick="verificaNascIdade('dt');">
                            <label class="custom-control-label" for="dataNascRadio">nascid<span class="vogalSexo">o</span> em </label>
                          </div> 
                          <div class="col-auto">
                              <?php
                                $dtNascFinal=$_SESSION['ficha']['varDataNascimento'];
                                $anoNascFinal=intval(substr($dtNascFinal,0,4));
                                $mesNascFinal=intval(substr($dtNascFinal,5,2));
                                $diaNascFinal=intval(substr($dtNascFinal,8,2));
                                $seldFinal='';
                                $selmFinal=[];
                                $selaFinal='';
                                //echo "dtNasc: ".$dtNasc."<br/>";
                                //echo "anoNasc: ".$anoNasc."<br/>";
                                //echo "mesNasc: ".$mesNasc."<br/>";
                                //echo "diaNasc: ".$diaNasc."<br/>";
                              ?>
                              <select class="form-control" id="TX_DIANASCIMENTO_Final" name="TX_DIANASCIMENTO_Final" onClick="verificaNascIdade('dt');">
                                  <option value="00"></option>
                                  <?php
                                  for($diaFinal=1;$diaFinal<32;$diaFinal++){
                                      if($diaFinal===intval($diaNascFinal)){
                                          $seldFinal= ' selected';
                                      }else{
                                          $seldFinal='';
                                      }
                                      echo "<option value=".$diaFinal.$seldFinal.">".$diaFinal."</option>";}
                                  ?>
                              </select>
                            </div>
                            <?php
                            for($mesFinal=1;$mesFinal<13;$mesFinal++){
                                  if($mesFinal===intval($mesNascFinal)){
                                      $selmFinal[$mesFinal]=' selected';
                                  }else{
                                      $selmFinal[$mesFinal]='';
                                  }
                              }
                            ?>
                            <div class="col-auto">
                              <select class="form-control" id="TX_MESNASCIMENTO_Final" name="TX_MESNASCIMENTO_Final">
                                <option value="00"></option>
                                <option value="01" <?php echo $selmFinal[1];?>>janeiro</option>
                                <option value="02" <?php echo $selmFinal[2];?>>fevereiro</option>
                                <option value="03" <?php echo $selmFinal[3];?>>março</option>
                                <option value="04" <?php echo $selmFinal[4];?>>abril</option>
                                <option value="05" <?php echo $selmFinal[5];?>>maio</option>
                                <option value="06" <?php echo $selmFinal[6];?>>junho</option>
                                <option value="07" <?php echo $selmFinal[7];?>>julho</option>
                                <option value="08" <?php echo $selmFinal[8];?>>agosto</option>
                                <option value="09" <?php echo $selmFinal[9];?>>setembro</option>
                                <option value="10" <?php echo $selmFinal[10];?>>outubro</option>
                                <option value="11" <?php echo $selmFinal[11];?>>novembro</option>
                                <option value="12" <?php echo $selmFinal[12];?>>dezembro</option>
                              </select>
                            </div>
                            <div class="col-auto">
                              <select class="form-control" id="TX_ANONASCIMENTO_Final" name="TX_ANONASCIMENTO_Final" style="width:90px;">
                                <option value="0000"></option>  
                                <?php
                                for($anoFinal=1850;$anoFinal<=$anoAtual;$anoFinal++)
                                {
                                    if($anoFinal===intval($anoNascFinal)){
                                        $selaFinal= ' selected';
                                    }else{
                                        $selaFinal='';
                                    }   
                                    echo "<option value=".$anoFinal.$selaFinal.">".$anoFinal."</option>";}
                                    //echo "<<<<br>";
                                ?>
                              </select>
                            </div>
                           
                          <div class="col-auto">ou</div>
                          <div class="col-12 d-lg-none mt-2"></div>
                            <div class="custom-control custom-radio custom-control-inline ml-2 col">
                              <input class="custom-control-input" type="radio" name="dataIdade_Final" id="idaderadio_Final" value="option2" onClick="verificaNascIdade('id');" <?php if($_SESSION['ficha']['varIdade']!==""){ echo "checked";} ?>>
                              <label class="custom-control-label" for="idaderadio">Idade:</label>
                              <div class="pl-3">
                                <input type="text" style="width:80px" class="form-control" id="TX_IDADE_Final" name="TX_IDADE_Final" onClick="verificaNascIdade('id');" value="<?php echo $_SESSION['ficha']['varIdade']; ?>">
                              </div>
                            </div>
                        </div>
                      </div>
                      <div class="form-group col-12">
                        <div class="d-flex align-items-center">
                          <div class="col-auto">de nacionalidade</div>
                          <div class="col-auto">
                            <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varNacionalidade']; ?>">
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-12">
                        <div class="d-flex align-items-center">
                          <div class="col-auto">natural de </div>
                          <div class="col-auto">
                            <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varNaturalidade']; ?>">
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-12">
                        <div class="d-flex align-items-center">
                          <div class="col-auto">casad<span class="vogalSexo">o</span> com</div>
                          <div class="col">
                            <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varNomeConjuge']; ?>">
                          </div>
                          <div class="col">
                            <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varSobrenomeConjuge']; ?>">
                          </div>
                          <div class="col-auto conjugeNascida">nascida</div>
                          <div class="col conjugeNascida">
                            <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varSobrenomeSolteira']; ?>">
                          </div>
                          <div class="col d-none" id="link-sugestao1">
                            <a href=""><i class="fas fa-link"></i></a>
                          </div>
                        </div>
                        <div id="sugestao1" class="sugestao d-none"> <!-- DIV Balão Sugestão --> 
                            <div class="sugestao-conteudo">
                              Sua cônjuge é um destas abaixo?
                              <ul>
                                <li class="custom-control custom-radio custom-control-inline">
                                  <input class="custom-control-input" type="radio" name="TX_ESCOLHECONJUGE" id="TX_ESCOLHECONJUGE" value="C1">
                                  <label class="custom-control-label" for="divorc">Fulano de Tal</label>
                                </li>
                                <li class="custom-control custom-radio custom-control-inline">
                                  <input class="custom-control-input" type="radio" name="TX_ESCOLHECONJUGE" id="TX_ESCOLHECONJUGE" value="C2">
                                  <label class="custom-control-label" for="divorc">Beltrano de Tal</label>
                                </li>
                                <li class="custom-control custom-radio custom-control-inline">
                                  <input class="custom-control-input" type="radio" name="TX_ESCOLHECONJUGE" id="TX_ESCOLHECONJUGE" value="C3">
                                  <label class="custom-control-label" for="divorc">Sicrano de Tal</label>
                                </li>
                                <li class="custom-control custom-radio custom-control-inline">
                                  <input class="custom-control-input" type="radio" name="TX_ESCOLHECONJUGE" id="TX_ESCOLHECONJUGE" value="C3">
                                  <label class="custom-control-label" for="divorc">Nenhuma delas</label>
                                </li>
                              </ul>
                            </div>                            
                            <div class="seta"></div>
                          </div>
                      </div>
                      <div class="form-group col-12">
                          <div class="col-12 mb-2"><span class="paiMae">pai</span> de</div>
                          <?php
                          // Pegar os filhos
                          $varSexoFicha=$_SESSION['ficha']['varSexo']; // Sexo do progenitor
                            if($varSexoFicha=="M"){
                                $varCampoGenitor="TX_Pai";
                            }else{
                                $varCampoGenitor="TX_Mae";
                            }
                            //echo "varCampoGenitor: ".$varCampoGenitor;

                            //Consulta para pegar os filhos dessa matrícula
                            $sqlBuscaFilhos = "SELECT * from dbkartei.tab_filhos WHERE ".$varCampoGenitor."='".$_SESSION['ficha']['varMatricula']."'";
                            $conexao = mysqli_connect('66.33.203.11', 'kartei', 'ktARI#19', 'dbkartei'); // Desenv
                                if (!$conexao ) {
                                    echo "Error: Connection with DB MySQL is fail." . PHP_EOL;
                                    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
                                    exit;
                                }
                                else{
                                    // Executa a query (o recordset $rs contém o resultado da query)
                            //        echo "Vai executar: $sqlBuscaNumeroFilhos <br/>";
                                    $rsFilhos=mysqli_query($conexao, $sqlBuscaFilhos);

                            //        $numeroFilhos=mysql_result($rsNumeroFilhos);
                            //        $rsDados=mysqli_query($conexao, $sqlFichasDoUsuario);
                                    $numFilhos=mysqli_num_rows($rsFilhos);
                                    if($numFilhos===0){
                                        $idFilho[0]="";//------------------ 01
                                        $nrFilho[0]="";//------------------ 02
                                        $nmFilho[0]="";//------------------- 03
                                        $txPai[0]="";//---------------------- 04
                                        $txMae[0]="";//---------------------- 05
                                        $txMatricula[0]="";//---------- 06
                                        $txSexo[0]="";//-------------------- 07
                                        $dtNsc[0]="";//--------------- 08
                                    } else{
                                            //$row = mysql_fetch_row($result);
                                            //
                                            // libera result set 
                                            //$rsNumeroFilhos->close();
                                            // fecha a conexão
                                             $nf=1;
                                             $idFilho=[];
                                             $nrFilho=[];
                                             $nmFilho=[];
                                             $txPai=[];
                                             $txMae=[];
                                             $txMatricula=[];
                                             $txSexo=[];
                                             $dtNsc=[];
                                                while($df=mysqli_fetch_assoc($rsFilhos)) // ================================= WHILE para varrer SELECT
                                                {
                                                    $idFilho[$nf]=$df['id_FILHO'];//------------------ 01
                                                    $nrFilho[$nf]=$df['NR_FILHO'];//------------------ 02
                                                    $nmFilho[$nf]=$df['TX_Nome'];//------------------- 03
                                                    $txPai[$nf]=$df['TX_Pai'];//---------------------- 04
                                                    $txMae[$nf]=$df['TX_Mae'];//---------------------- 05
                                                    $txMatricula[$nf]=$df['TX_Matricula'];//---------- 06
                                                    $txSexo[$nf]=$df['TX_Sexo'];//-------------------- 07
                                                    $dtNsc[$nf]=$df['DT_Nascimento'];//--------------- 08
                                                    $nf++;
                                                }  
                                                mysqli_close($conexao);   
                                    }
                                }// Fim else conexão
                                 
                          ?>
                        <div class="row px-3 align-items-end">
                          <div class="col-12 pr-0">
                              <?php 
                          $nff=0;
                          if($numFilhos>0){
                            for($nff=1;$nff<=$numFilhos;$nff++){// loop até o último filho
                             // $idFilho=[]; $nrFilho=[]; $nmFilho=[];$txPai=[]; $txMae=[];$txMatricula=[]; $txSexo=[];$dtNsc=[];   
                              $dtNascFinalF=$dtNsc[$nff];
                                $anoNascFinalF=intval(substr($dtNascFinalF,0,4));
                                $mesNascFinalF=intval(substr($dtNascFinalF,5,2));
                                $diaNascFinalF=intval(substr($dtNascFinalF,8,2));
                                $seldFinalF='';
                                $selmFinalF=[];
                                $selaFinalF='';
                              
                          //    <!-- ============================================================= -->   
                              echo "<div class='d-flex align-items-center mb-2'>";
                              echo "      <input type='text' class='d-none' id='id_NOMEFILHO".$nff."' value='".$idFilho[$nff]."'>";    
                              echo "    <div class='col'>";
                              echo "    <input type='text' class='form-control' name='TX_NOMEFILHO".$nff."' id='TX_NOMEFILHO".$nff."' value='".$nmFilho[$nff]."'>";
                              echo "    </div>";
                              echo "    <div class='col-auto'>nascido em </div>";
                              echo "    <div class='col-auto'>";
                              echo "      <select class='form-control' id='diaNasc".$nff."'>";
                              echo "        <option value='00'></option>";
                                              for($diafFinal=1;$diafFinal<32;$diafFinal++){
                                                  if($diafFinal===$diaNascFinalF){
                                                      $seldF= ' selected';
                                                  }else{
                                                      $seldF='';
                                                  }
                                                  echo "<option value=".$diafFinal.$seldF.">".$diafFinal."</option>";}
                              echo "      </select>";
                              echo "    </div>";
                              echo "    <div class='col-auto'>";
                                            for($mesFinalF=1;$mesFinalF<13;$mesFinalF++){
                                                  if($mesFinalF===$mesNascFinalF){
                                                      $selmFinalF[$mesFinalF]=' selected';
                                                  }else{
                                                      $selmFinalF[$mesFinalF]='';
                                                  }
                                            }
                              echo "    <select class='form-control' id='TX_MESNASCIMENTO".$nff."' name='TX_MESNASCIMENTO".$nff."'>";
                              echo "      <option value='00'></option>";
                              echo "       <option value='01'" . $selmFinalF[1].">janeiro</option>";
                              echo "       <option value='02'" . $selmFinalF[2].">fevereiro</option>";
                              echo "       <option value='03'" . $selmFinalF[3].">março</option>";
                              echo "       <option value='04'" . $selmFinalF[4].">abril</option>";
                              echo "       <option value='05'" . $selmFinalF[5].">maio</option>";
                              echo "       <option value='06'" . $selmFinalF[6].">junho</option>";
                              echo "       <option value='07'" . $selmFinalF[7].">julho</option>";
                              echo "       <option value='08'" . $selmFinalF[8].">agosto</option>";
                              echo "       <option value='09'" . $selmFinalF[9].">setembro</option>";
                              echo "       <option value='10'" . $selmFinalF[10].">outubro</option>";
                              echo "       <option value='11'" . $selmFinalF[11].">novembro</option>";
                              echo "       <option value='12'" . $selmFinalF[12].">dezembro</option>";
                              echo "    </select>";
                              echo "    </div>";
                              echo "    <div class='col-auto'> ";
                              echo "      <select class='form-control' id='TX_ANONASCIMENTO".$nff."' name='TX_ANONASCIMENTO".$nff."'>";
                                          for($anoFinalF=1850;$anoFinalF<=$anoAtual;$anoFinalF++)
                                          {
                                              if($anoFinalF===intval($anoNascFinalF)){
                                                  $selaFinalF= ' selected';
                                              }else{
                                                  $selaFinalF='';
                                              }   
                                              echo "<option value=".$anoFinalF.$selaFinalF.">".$anoFinalF."</option>";
                                          }
                              echo "      </select>";
                              echo "    </div>";
                              echo "</div>";
                            }  
                          }
                          ?>

                          <div class='sugestao d-none' id='sugestao2'> <!-- DIV Balão Sugestão --> 
                                  <div class='seta'></div>
                                  <div class='sugestao-conteudo'>
                                    Este filho é um destes abaixo?
                                    <ul>
                                      <li class='custom-control custom-radio custom-control-inline'>
                                        <input class='custom-control-input' type='radio' name='TX_ESCOLHECONJUGE' id='TX_ESCOLHECONJUGE' value='C1'>
                                        <label class='custom-control-label' for='divorc'>Fulano de Tal</label>
                                      </li>
                                      <li class='custom-control custom-radio custom-control-inline'>
                                        <input class='custom-control-input' type='radio' name='TX_ESCOLHECONJUGE' id='TX_ESCOLHECONJUGE' value='C2'>
                                        <label class='custom-control-label' for='divorc'>Beltrano de Tal</label>
                                      </li>
                                      <li class='custom-control custom-radio custom-control-inline'>
                                        <input class='custom-control-input' type='radio' name='TX_ESCOLHECONJUGE' id='TX_ESCOLHECONJUGE' value='C3'>
                                        <label class='custom-control-label' for='divorc'>Sicrano de Tal</label>
                                      </li>
                                      <li class='custom-control custom-radio custom-control-inline'>
                                        <input class='custom-control-input' type='radio' name='TX_ESCOLHECONJUGE' id='TX_ESCOLHECONJUGE' value='C3'>
                                        <label class='custom-control-label' for='divorc'>Nenhum deles</label>
                                      </li>
                                    </ul>
                                  </div>
                               </div>

                               <?php

                          //    último filho  <!-- ============================================================= --> 
                          //   echo "nff: ". $nff."<br/>";
                            $dtNascFinalF=$dtNsc[$nff];
                                $anoNascFinalF=intval(substr($dtNascFinalF,0,4));
                                $mesNascFinalF=intval(substr($dtNascFinalF,5,2));
                                $diaNascFinalF=intval(substr($dtNascFinalF,8,2));
                                
                            echo "<div class='row px-3 align-items-center mb-2 d-none'>";
                              echo "      <input type='text' class='d-none' id='id_NOMEFILHO".$nff."' value='".$idFilho[$nff]."'>";
                              echo "    <div class='col'>";
                              echo "      <input type='text' class='form-control' id='TX_NOMEFILHO".$nff."' value='".$nmFilho[$nff]."'>";
                              echo "    </div>";
                              echo "    <div class='col-auto'>nascido em </div>";
                              echo "    <div class='col-auto'>";
                              echo "      <select class='form-control' id='diaNasc'>";
                              echo "        <option value='00'></option>";
                                              for($diafFinalF=1;$diafFinalF<32;$diafFinalF++){
                                                  if($diafFinalF===$diaNascFinalF){
                                                      $seldF= ' selected';
                                                  }else{
                                                      $seldF='';
                                                  }
                                                  echo "<option value=".$diafFinalF.$seldF.">".$diafFinalF."</option>";}
                              echo "      </select>";
                              echo "    </div>";
                              echo "    <div class='col-auto'>";
                                            for($mesFinalF=1;$mesFinalF<13;$mesFinalF++){
                                                  if($mesFinalF===$mesNascFinalF){
                                                      $selmFinalF[$mesFinalF]=' selected';
                                                  }else{
                                                      $selmFinalF[$mesFinalF]='';
                                                  }
                                            }
                              echo "    <select class='form-control' id='TX_MESNASCIMENTO' name='TX_MESNASCIMENTO'>";
                              echo "      <option value='00'></option>";
                              echo "       <option value='01'" . $selmFinalF[1].">janeiro</option>";
                              echo "       <option value='02'" . $selmFinalF[2].">fevereiro</option>";
                              echo "       <option value='03'" . $selmFinalF[3].">março</option>";
                              echo "       <option value='04'" . $selmFinalF[4].">abril</option>";
                              echo "       <option value='05'" . $selmFinalF[5].">maio</option>";
                              echo "       <option value='06'" . $selmFinalF[6].">junho</option>";
                              echo "       <option value='07'" . $selmFinalF[7].">julho</option>";
                              echo "       <option value='08'" . $selmFinalF[8].">agosto</option>";
                              echo "       <option value='09'" . $selmFinalF[9].">setembro</option>";
                              echo "       <option value='10'" . $selmFinalF[10].">outubro</option>";
                              echo "       <option value='11'" . $selmFinalF[11].">novembro</option>";
                              echo "       <option value='12'" . $selmFinalF[12].">dezembro</option>";
                              echo "    </select>";
                              echo "    </div>";
                              echo "    <div class='col-auto'> ";
                              echo "      <select class='form-control' id='TX_ANONASCIMENTO' name='TX_ANONASCIMENTO'>";
                              echo "      <option value='00'></option>";        
                                          for($anoFinalF=1850;$anoFinalF<=$anoAtual;$anoFinalF++)
                                          {
                                              if($anoFinalF===intval($anoNascFinalF)){
                                                  $selaFinalF= ' selected';
                                              }else{
                                                  $selaFinalF='';
                                              }   
                                              echo "<option value=".$anoFinalF.$selaFinalF.">".$anoFinalF."</option>";
                                          }
                              echo "      </select>";
                              echo "    </div>";
                              echo "</div>";
                          ?>   
                          </div>
                        </div>
                        <div class="col-12">
                          <button class="btn-sm btn btn-info mb-2" role="button">Inserir Filho</button>
                        </div>
                      </div>
                      <div class="form-group col-12">
                        <div class="d-flex align-items-center">
                          <div class="col-7">
                            <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varProfissao']; ?>">
                          </div>
                          <div class="col-auto">de profissão</div>
                        </div>
                      </div>
                      <div class="form-group col-12">
                        <div class="d-flex align-items-center">
                          <div class="col-auto">com carteira de estrangeiro nº</div>
                          <div class="col-auto">
                            <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varIdentidade']; ?>">
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-12">
                        <div class="d-flex align-items-center">
                          <div class="col-auto">emitida pela </div>
                          <div class="col-auto">
                            <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varExpedicao']; ?>">
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-12">
                        <div class="row px-3 align-items-center">
                          <div class="col-auto">foi aceit<span class="vogalSexo">o</span> como associad<span class="vogalSexo">o</span> em</div>
                          <div class="col-12 d-lg-none mt-2"></div>
                          <div class="col-auto">
                            <?php
                            if(!isset($_SESSION['ficha']['varDataAceitacao'])){
                                $dtAceitF='';
                            }else{
                                $dtAceitF=$_SESSION['ficha']['varDataAceitacao'];
                                
                            }
                                    
                              $anoAceitF=intval(substr($dtAceitF,0,4));
                              $mesAceitF=intval(substr($dtAceitF,5,2));
                              $diaAceitF=intval(substr($dtAceitF,8,2));
                              $seldAceitF='';
                              $selmAceitF=[];
                              $selaAceitF='';
                              //echo "dtAceit: ".$dtAceit."<br/>";
                              //echo "anoAceit: ".$anoAceit."<br/>";
                              //echo "mesAceit: ".$mesAceit."<br/>";
                              //echo "diaAceit: ".$diaAceit."<br/>";
                            ?>
                            <select class="form-control" id="TX_DIAACEITACAO_Final" name="TX_DIAACEITACAO_Final">
                              <option value="00"> </option>
                              <?php
                              for($diaAcF=1;$diaAcF<32;$diaAcF++){
                                  if($diaAcF===$diaAceitF){
                                      $seldAceitF= ' selected';
                                  }else{
                                      $seldAceitF='';
                                  }
                                  echo "<option value=".$diaAcF.$seldAceitF.">".$diaAcF."</option>";}
                              ?>
                            </select>
                          </div>

                          <div class="col-auto">
                          <?php
                              for($mesAcF=1;$mesAcF<13;$mesAcF++){
                                  if($mesAcF===$mesAceitF){
                                      $selmAceitF[$mesAcF]=' selected';
                                  }else{
                                      $selmAceitF[$mesAcF]='';
                                  }  
                                } 
                          ?>
                          <select class="form-control" id="TX_MESACEITACAO_Final" name="TX_MESACEITACAO_Final">
                            <option value="00"> </option>
                            <option value="01" <?php echo $selmAceitF[1];?>>janeiro</option>
                            <option value="02" <?php echo $selmAceitF[2];?>>fevereiro</option>
                            <option value="03" <?php echo $selmAceitF[3];?>>março</option>
                            <option value="04" <?php echo $selmAceitF[4];?>>abril</option>
                            <option value="05" <?php echo $selmAceitF[5];?>>maio</option>
                            <option value="06" <?php echo $selmAceitF[6];?>>junho</option>
                            <option value="07" <?php echo $selmAceitF[7];?>>julho</option>
                            <option value="08" <?php echo $selmAceitF[8];?>>agosto</option>
                            <option value="09" <?php echo $selmAceitF[9];?>>setembro</option>
                            <option value="10" <?php echo $selmAceitF[10];?>>outubro</option>
                            <option value="11" <?php echo $selmAceitF[11];?>>novembro</option>
                            <option value="12" <?php echo $selmAceitF[12];?>>dezembro</option>
                          </select>
                        </div>
                          <div class="col-auto">
                            <select class="form-control" id="TX_ANOACEITACAO_Final" name="TX_ANOACEITACAO_Final" style="width:90px;">
                              <option value="0000"> </option>
                              <?php
                              for($anoAcF=1850;$anoAcF<=$anoAtual;$anoAcF++)
                              {
                                    if($anoAcF===intval($anoAceitF)){
                                        $selaAcF= ' selected';
                                    }else{
                                        $selaAcF='';
                                    }
                                  echo "<option value=".$anoAcF.$selaAcF.">".$anoAcF."</option>";
                              }

                              ?>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-12">
                        <div class="row px-3 align-items-center">
                          <div class="col-auto">proposto por</div>
                          <div class="col-auto">
                            <input type="text" class="form-control" style="width:50px" value="<?php echo $_SESSION['ficha']['varTituloProponente1'] ;?>">
                          </div>
                          <div class="col">
                            <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varNomeProponente1'] ;?>">
                          </div>
                          <div class="col">
                            <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varSobrenomeProponente1'] ;?>">
                          </div>
                          <div class="col-12 d-lg-none mt-2"></div>
                          <div class="col-auto">e</div>
                          <div class="col-auto">
                            <input type="text" class="form-control" style="width:50px" value="<?php echo $_SESSION['ficha']['varTituloProponente2']; ?>">
                          </div>
                          <div class="col">
                            <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varNomeProponente2']; ?>">
                          </div>
                          <div class="col pr-0">
                            <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varSobrenomeProponente2']; ?>">
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-12">
                        <div class="d-flex align-items-center">
                          <div class="col-auto">com destino</div>
                          <div class="col-auto">
                            <select class="form-control" id="TX_DESTINO_FINAL" name="TX_DESTINO_FINAL">
                              <option <?php if ($_SESSION['ficha']['varDestino']==="Desassociou-se"){echo "selected";} ?>>Desassociou-se</option>
                              <option <?php if ($_SESSION['ficha']['varDestino']==="Emigrou para o exterior"){echo "selected";}?>>Emigrou para o exterior</option>
                              <option <?php if ($_SESSION['ficha']['varDestino']==="Imigrou para o interior do Brasil"){echo "selected";}?>>Imigrou para o interior do Brasil</option>
                            </select>
                          </div>
                        </div>
                      </div>
                      <div class="form-group col-12">
                          <div class="row align-items-center px-3">
                            <div class="col-auto">faleceu em</div>
                            <div class="col-auto">
                              <?php
                              if(!isset($_SESSION['ficha']['varDataFalecimento'])){
                                  $dtFalec='';
                              }else{
                                  $dtFalec=$_SESSION['ficha']['varDataFalecimento'];
                              }
                                $anoFalecF=intval(substr($dtFalec,0,4));
                                $mesFalecF=intval(substr($dtFalec,5,2));
                                $diaFalecF=intval(substr($dtFalec,8,2));
                                $seldFalecF='';
                                $selmFalecF=[];
                                $selaFalecF='';
                                //echo "dtFalec: ".$dtFalec."<br/>";
                                //echo "anoFalec: ".$anoFalec."<br/>";
                                //echo "mesFalec: ".$mesFalec."<br/>";
                                //echo "diaFalec: ".$diaFalec."<br/>";
                              ?>
                              <select class="form-control" id="TX_DIAFALECIMENTO_Final" name="TX_DIAFALECIMENTO_Final">
                                  <option value="00"> </option>
                                  <?php
                                  for($diaFlcF=1;$diaFlcF<32;$diaFlcF++){
                                      if($diaFlcF===$diaFalecF){
                                          $seldFalecF= ' selected';
                                      }else{
                                          $seldFalecF='';
                                      }
                                      echo "<option value=".$diaFlcF.$seldFalecF.">".$diaFlcF."</option>";}
                                  ?>
                              </select>
                            </div>
                            <div class="col-auto">
                              <?php
                              for($mesFlcF=1;$mesFlcF<13;$mesFlcF++){
                                 if($mesFlcF===$mesFalecF){
                                     $selmFalec[$mesFlcF]=' selected';
                                 }else{
                                     $selmFalec[$mesFlcF]='';
                                 }  

                                } 
                              ?>
                              <select class="form-control" id="TX_MESFALECIMENTO_Final" name="TX_MESFALECIMENTO_Final" style="width:100px">
                                <option value="00"> </option>
                                <option value="01" <?php echo $selmFalec[1];?>>janeiro</option>
                                <option value="02" <?php echo $selmFalec[2];?>>fevereiro</option>
                                <option value="03" <?php echo $selmFalec[3];?>>março</option>
                                <option value="04" <?php echo $selmFalec[4];?>>abril</option>
                                <option value="05" <?php echo $selmFalec[5];?>>maio</option>
                                <option value="06" <?php echo $selmFalec[6];?>>junho</option>
                                <option value="07" <?php echo $selmFalec[7];?>>julho</option>
                                <option value="08" <?php echo $selmFalec[8];?>>agosto</option>
                                <option value="09" <?php echo $selmFalec[9];?>>setembro</option>
                                <option value="10" <?php echo $selmFalec[10];?>>outubro</option>
                                <option value="11" <?php echo $selmFalec[11];?>>novembro</option>
                                <option value="12" <?php echo $selmFalec[12];?>>dezembro</option>
                              </select>
                            </div> 
                            <div class="col-auto">
                              <select class="form-control" id="TX_ANOFALECIMENTO_Final" name="TX_ANOFALECIMENTO_Final" style="width:90px;">
                                <option value="0000"> </option>
                                <?php
                                for($anoFlc=1850;$anoFlc<=$anoAtual;$anoFlc++)
                                {
                                  if($anoFlc===intval($anoFalec)){
                                      $selaFalec= ' selected';
                                  }else{
                                      $selaFalec='';
                                  }

                                    echo "<option value=".$anoFlc.$selaFalec.">".$anoFlc."</option>";}
                                ?>
                              </select>
                            </div>
                            <div class="col-12 d-lg-none mt-2"></div>
                            <div class="col-auto">=</div>
                            <div class="col-auto">
                              <?php
                                if(!isset($_SESSION['ficha']['varDiaFalecimentoJud'])){
                                    $diaFalecJF='';
                                }else{
                                    $diaFalecJF=$_SESSION['ficha']['varDiaFalecimentoJud'];               
                                }
                                if(!isset($_SESSION['ficha']['varMesFalecimentoJud'])){
                                    $mesFalecJF='';
                                }else{
                                    $mesFalecJF=$_SESSION['ficha']['varMesFalecimentoJud'];               
                                }
                                if(!isset($_SESSION['ficha']['varAnoFalecimentoJud'])){
                                    $anoFalecJF='';
                                }else{
                                    $anoFalecJF=$_SESSION['ficha']['varAnoFalecimentoJud'];               
                                }
                                  $seldFalecJF='';
                                  //$mesFalecExt=['','tishrei','cheshvan','kislev','tevet','shevat','adar','nissan','iyar','sivan','tamuz','av','elul'];
                                  $selmFalecFF=[];
                                  $selaFalecJF='';
                                  //echo "dtFalec: ".$dtFalecJ."<br/>";
                                  //echo "anoFalecJ: ".$anoFalecJ."<br/>";
                                  //echo "mesFalecJ: ".$mesFalecJ."<br/>";
                                  //echo "diaFalecJ: ".$diaFalecJ."<br/>";
                                  // echo "dtFalecJ:".$dtFalecJ."<============================= <br/>";
                                ?>
                                <select class="form-control" id="TX_DIAFALECIMENTOJUD_Final" name="TX_DIAFALECIMENTOJUD_Final">
                                  <option value="00"></option>
                                  <?php
                                  for($diaFlcJF=1;$diaFlcJF<31;$diaFlcJF++){
                                      if($diaFlcJF===intval($diaFalecJF)){
                                          $seldFalecJF= ' selected';
                                      }else{
                                          $seldFalecJF='';
                                      }
                                      echo "<option value=".$diaFlcJF.$seldFalecJF.">".$diaFlcJF."</option>";
                                  }
                                  ?>
                                </select>
                            </div>
                            <div class="col-auto">
                              <?php
                                  for($mesFlcJF=0;$mesFlcJF<13;$mesFlcJF++){
                                     if($mesFalecExt[$mesFlcJF]===$mesFalecJF){
                                         $selmFalecJF[$mesFlcJF]=' selected';
                                     }else{
                                         $selmFalecJF[$mesFlcJF]='';
                                     }
                                  }
                              ?>
                              <select class="form-control" id="TX_MESFALECIMENTOJUD_Final" name="TX_MESFALECIMENTOJUD_Final" style="width:100px">
                                <option value="00"></option>
                                <option value="tishrei" <?php echo $selmFalecJF[1];?>>tishrei</option>
                                <option value="cheshvan" <?php echo $selmFalecJF[2];?>>cheshvan</option>
                                <option value="kislev" <?php echo $selmFalecJF[3];?>>kislev</option>
                                <option value="tevet" <?php echo $selmFalecJF[4];?>>tevet</option>
                                <option value="shevat" <?php echo $selmFalecJF[5];?>>shevat</option>
                                <option value="adar" <?php echo $selmFalecJF[6];?>>adar</option>
                                <option value="nissan" <?php echo $selmFalecJF[7];?>>nissan</option>
                                <option value="iyar" <?php echo $selmFalecJF[8];?>>iyar</option>
                                <option value="sivan" <?php echo $selmFalecJF[9];?>>sivan</option>
                                <option value="tamuz" <?php echo $selmFalecJF[10];?>>tamuz</option>
                                <option value="av" <?php echo $selmFalecJF[11];?>>av</option>
                                <option value="elul" <?php echo $selmFalecJF[12];?>>elul</option>
                              </select>
                            </div>
                            <div class="col-auto pr-0">
                              <select class="form-control" id="TX_ANOFALECIMENTOJUD_Final" name="TX_ANOFALECIMENTOJUD_Final" style="width:90px;">
                                  <option value="0000"></option> 
                                  <?php
                                  for($anoFlcJF=5610;$anoFlcJF<=$anoJ;$anoFlcJF++)
                                  {
                                    if($anoFlcJF===intval($anoFalecJ)){
                                        $selaFalecJF= ' selected';
                                    }else{
                                        $selaFalecJF='';
                                    }
                                    echo "<option value=".$anoFlcJF.$selaFalecJF.">".$anoFlcJF."</option>";
                                  }
                                  ?>
                                </select>
                            </div>
                          </div>
                      </div>
                      <div class="form-group mb-0 col-12 text-right">
                        <a href="" class="btn btn-sm btn-primary" id="procuraLinks">Procurar Links</a>
                      </div>
                    </div>
                    <div class="col-4">              
                      <textarea class="form-control h-100" id="Obs6" name="Obs6"><?php echo $_SESSION['ficha']['varObs']; ?></textarea>
                    </div>
                  </div>
                </div>
              </div>
              <!-- =============== OBS ============================== 
              <div class="col-4 d-flex">
                <div class="card align-self-stretch w-100">
                  <div class="card-header obs">
                    <h4 class="col-12 px-0">Observações do Pesquisador</h4>
                  </div>
                </div>
              </div>
              < ================================================== -->
              
              <div class="col-12 text-right">
                <button class="btn btn-success" type="submit" onclick="salvar('6');" data-toggle="modal" data-target="#modalFinal">
                  Inserir Ficha no Cadastro
                </button>
              </div>
              
      
            </div>
          </div>
          <!-- Fim Item 6 -->
        </div>
        </div>
      </form>

    </main><!-- /.container -->

    

    

    <script src="cadastroFicha_Final.js"></script>

    <?php
      if($varSexoFicha==='M'){
          echo "<script>mascFem('M');</script>";
      }
      if($varSexoFicha==='F'){
          echo "<script>mascFem('F');</script>";
      }
    ?>
    
<?php
        if($varSexoFicha==='M'){
            echo "<script>mascFem('M');</script>";
        }
        if($varSexoFicha==='F'){
            echo "<script>mascFem('F');</script>";
        }
?>

    
    <script>
        $('#procuraLinks').click(function() {
            $('.sugestao').removeClass('d-none');
            event.preventDefault();
        });
        $('#sugestao1 input').click(function() {
            $('#sugestao1').addClass('d-none');
            $('#link-sugestao1').removeClass('d-none')
        });
        $('#sugestao2 input').click(function() {
            $('#sugestao2').addClass('d-none');
            $('#link-sugestao2').removeClass('d-none')
        });
    </script>
    </body>
</html>

