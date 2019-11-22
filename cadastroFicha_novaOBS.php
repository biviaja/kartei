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
          <h3 class="carousel-indicators">
            <div class="traco<?php if($varFase===0){echo " active";}else{echo "";} ?>" data-target="#carrossel-passos" data-slide-to="0"></div>
            <div class="passo passo1<?php if($varFase===1){echo " active";}else{echo "";} ?>" data-target="<?php if($varFase>=1){echo "#carrossel-passos";}else{echo '';} ?>" data-slide-to="1"><a href="#" class="passo-num">1</a></div>
            <div class="passo<?php if($varFase===2){echo " active";}else{echo "";} ?>" data-target="<?php if($varFase>=2){echo "#carrossel-passos";}else{echo '';} ?>" data-slide-to="2"><a href="#" class="passo-num">2</a></div>
            <div class="passo<?php if($varFase===3){echo " active";}else{echo "";} ?>" data-target="<?php if($varFase>=3){echo "#carrossel-passos";}else{echo '';} ?>" data-slide-to="3"><a href="#" class="passo-num">3</a></div>
            <div class="passo<?php if($varFase===4){echo " active";}else{echo "";} ?>" data-target="<?php if($varFase>=4){echo "#carrossel-passos";}else{echo '';} ?>" data-slide-to="4"><a href="#" class="passo-num">4</a></div>
            <div class="passo<?php if($varFase===5){echo " active";}else{echo "";} ?>" data-target="<?php if($varFase>=5){echo "#carrossel-passos";}else{echo '';} ?>" data-slide-to="5"><a href="#" class="passo-num">5</a></div>
            <div class="passo<?php if($varFase===6){echo " active";}else{echo "";} ?>" data-target="<?php if($varFase>=6){echo "#carrossel-passos";}else{echo '';} ?>" data-slide-to="6"><a href="#" class="passo-num">6</a></div>
          </h3>
          <div class="carousel-inner">
          <!-- Início matrícula -->
          <div class="carousel-item<?php if($varFase===0){echo " active";}else{echo "";} ?>">
            <div class="col-12">
              <div class="row">
                <h2 class="col-12">Cadastramento de Nova Ficha</h2>
                <div class="form-group form-inline col-12 mb-3">
                  <label for="matricula" class="col-2 p-0">Número da matrícula: </label>
                  <input type="text" name="TX_MATRICULA" id="TX_MATRICULA_DIG" class="form-control" maxlength="4" aria-describedby="matricula">
                  <input type="text" name="TX_MATRICULA" id="TX_MATRICULA" class="d-none" maxlength="5" aria-describedby="matricula"<?php echo " value='".$_SESSION['ficha']['varMatricula']."'"; ?> >
                  
                  <div id="divErroMatricula" class="invalid-feedback col-10 ml-auto px-0 <?php echo $_SESSION['ficha']['classeErro']; ?>"  > <?php echo $_SESSION['ficha']['mse']; ?></div>
                </div>
                <div class="col-2"></div>
                <div class="col-9 form-group ml-1">
                  <div class="form-check">
                    <!--< ?php echo "Tipo da ficha na SESSION: ".$_SESSION['ficha']['varTipoFicha']."<br/>"; ?>-->
                    <input class="form-check-input" type="radio" name="tipoFichaRadios" id="fichaPropria" value="Ficha Própria" onclick="tipoMatricula('Própria');" <?php if($_SESSION['ficha']['varTipoFicha']==="Ficha Propria"){echo " checked";} ?> >
                    <label class="form-check-label" for="fichaPropria">Ficha própria</label>
                  </div>
                  <div class="form-check">
                    <input class="form-check-input" type="radio" name="tipoFichaRadios" id="fichaSegundoUsu" value="Ficha Segundo Usuário (herdeiro, viúvo/a…" onclick="tipoMatricula('Segundo');" <?php if($_SESSION['ficha']['varTipoFicha']==="Ficha Segundo Usuário (herdeiro, viúvo/a…"){echo " checked";} ?> />
                    <label class="form-check-label" for="fichaSegundoUsu">Ficha em segundo uso <span class="parenteses">(herdeiro, viúvo/a…)</span></label>
                    <div id="divErroTipoFicha" class="invalid-feedback <?php echo $_SESSION['ficha']['classeErro']; ?>" > <?php echo $_SESSION['ficha']['mse']; ?></div>
                  </div>
                </div>
                <div class="col-2"></div>
                <div class="col-auto">
                  <button id="salvar0" class="btn btn-success float-right" href="#" role="button" data-slide="next" type="submit" onclick="salvar('0');">
                  Salvar e Continuar
                  </button>  
                  <input type="hidden" id="formFase1" value="0"/>
                </div>
              </div>
            </div>
          </div>
          <!-- Fim matrícula -->

          <!-- Início Item 1 -->
          <div class="<?php if($varFase===1){echo "carousel-item active";} else {echo "carousel-item";} ?>">
            <div class="row">
              <div class="col-8 pr-0">
                <div class="card">
                  <div class="card-header" id="matriculaFase2">
                      <h4 class="col-12 px-0"><span class="text-lowercase">Mat.:</span> <span class="num-matricula"><?php echo $_SESSION['ficha']['varMatricula']; ?></span></h4>
                      <h4>&nbsp;</h4>
                  </div>
                  <div class="card-body">
                    <div class="row px-3">
                        <div class="form-group col-2">
                          <label for="sobrenome">Título</label>
                          <input type="text" name="TX_TITULOPESSOA" id="TX_TITULOPESSOA" class="form-control" value="<?php echo $_SESSION['ficha']['varTituloPessoa']; ?>">
                        </div>
                        <div class="form-group col">
                          <label for="sobrenome">Último Sobrenome</label>
                          <input type="text" name="TX_SOBRENOME" id="TX_SOBRENOME" class="form-control" value="<?php echo $_SESSION['ficha']['varSobrenome']; ?>">
                        </div>
                    </div>
                    <div class="form-group col-12 mb-2">
                      <label for="nome">Nome <span class="parenteses">(pré-nome, nome do meio… ex.: Albert Israel; Helga Sara)</span></label>
                      <input type="text" name="TX_NOME" id="TX_NOME" class="form-control" value="<?php echo $_SESSION['ficha']['varNome']; ?>">
                    </div>
                    <div class="d-flex mb-3">
                      <div class="form-group form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="TX_SEXO" id="masc" value="M" onclick="mascFem('M');" <?php if($_SESSION['ficha']['varSexo']==="M"){ echo "checked";} ?>>
                        <label class="form-check-label" for="masc">Masculino</label>
                      </div>
                      <div class="form-group form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="TX_SEXO" id="fem" value="F" onclick="mascFem('F');" <?php if($_SESSION['ficha']['varSexo']==="F"){ echo "checked";} ?>>
                        <label class="form-check-label" for="fem">Feminino</label>
                      </div>
                    </div>
                    <div class="row px-3 align-items-center mb-3">
                      <div class="form-group col-auto">
                        <div class="form-check-group">
                          <input class="form-check-input" type="radio" name="dataIdade" id="dataNascRadio" value="option2" <?php if($_SESSION['ficha']['varDataNascimento']!==""){ echo "checked";} ?> onClick="verificaNascIdade('dt');">
                          <label for="dataNascRadio">Data de Nascimento</label>
                        </div> 
                        <div class="d-flex">
                          <div class="col-3 pl-0">
                            <?php
                              $dtNasc=$_SESSION['ficha']['varDataNascimento'];
                              $anoNasc=intval(substr($dtNasc,0,4));
                              $mesNasc=intval(substr($dtNasc,5,2));
                              $diaNasc=intval(substr($dtNasc,8,2));
                              $seld='';
                              $selm=[];
                              $sela='';
                              //echo "dtNasc: ".$dtNasc."<br/>";
                              //echo "anoNasc: ".$anoNasc."<br/>";
                              //echo "mesNasc: ".$mesNasc."<br/>";
                              //echo "diaNasc: ".$diaNasc."<br/>";
                            ?>
                            <select class="form-control" id="TX_DIANASCIMENTO" name="TX_DIANASCIMENTO" onClick="verificaNascIdade('dt');">
                                <option value="00"></option>
                                <?php
                                for($dia=1;$dia<32;$dia++){
                                    if($dia===$diaNasc){
                                        $seld= ' selected';
                                    }else{
                                        $seld='';
                                    }
                                    echo "<option value=".$dia.$seld.">".$dia."</option>";}
                                ?>
                            </select>
                          </div>
                          <?php
                          for($mes=1;$mes<13;$mes++){
                                if($mes===$mesNasc){
                                    $selm[$mes]=' selected';
                                }else{
                                    $selm[$mes]='';
                                }
                            }
                          ?>
                          <select class="form-control" id="TX_MESNASCIMENTO" name="TX_MESNASCIMENTO">
                            <option value="00"></option>
                            <option value="01" <?php echo $selm[1];?>>janeiro</option>
                            <option value="02" <?php echo $selm[2];?>>fevereiro</option>
                            <option value="03" <?php echo $selm[3];?>>março</option>
                            <option value="04" <?php echo $selm[4];?>>abril</option>
                            <option value="05" <?php echo $selm[5];?>>maio</option>
                            <option value="06" <?php echo $selm[6];?>>junho</option>
                            <option value="07" <?php echo $selm[7];?>>julho</option>
                            <option value="08" <?php echo $selm[8];?>>agosto</option>
                            <option value="09" <?php echo $selm[9];?>>setembro</option>
                            <option value="10" <?php echo $selm[10];?>>outubro</option>
                            <option value="11" <?php echo $selm[11];?>>novembro</option>
                            <option value="12" <?php echo $selm[12];?>>dezembro</option>
                          </select>
                          <div class="col-4">
                            <select class="form-control" id="TX_ANONASCIMENTO" name="TX_ANONASCIMENTO" style="width:90px;">
                              <option value="0000"></option>  
                              <?php
                              for($ano=1850;$ano<1971;$ano++)
                              {
                                  if($ano===intval($anoNasc)){
                                      $sela= ' selected';
                                  }else{
                                      $sela='';
                                  }   
                                  echo "<option value=".$ano.$sela.">".$ano."</option>";}
                              ?>
                            </select>
                          </div>
                        </div> 
                      </div>
                      <div class="col-auto">ou</div>
                      <div class="form-group col-auto">
                        <div class="form-check-group">
                          <input class="form-check-input" type="radio" name="dataIdade" id="idaderadio" value="option2" onClick="verificaNascIdade('id');" <?php if($_SESSION['ficha']['varIdade']!==""){ echo "checked";} ?>>
                          <label for="idaderadio">Idade</label>
                        </div>
                        <input type="text" style="width:80px;" class="form-control" id="TX_IDADE" name="TX_IDADE" onClick="verificaNascIdade('id');" value="<?php echo $_SESSION['ficha']['varIdade']; ?>">
                      </div>
                    </div>
                    <div class="form-group col-12 mb-3">
                      <label for="estCivil" class='mb-2'>Estado civil, quando da associação <span class="parenteses">(solteiro, casado, separado, viúvo)</span></label>
                      <div class="form-group d-flex pb-3">
                        <div class="form-check form-check-inline ml-0">
                          <input class="form-check-input" type="radio" name="TX_ESTADOCIVIL" id="solt" value="Solteiro" onclick="estadoCivil('Solteiro', '<?php echo $_SESSION['ficha']['varSexo']; ?>');" <?php if('Solteiro'===$_SESSION['ficha']['varEstadoCivil']){echo ' checked';}?>>
                          <label class="form-check-label" for="solt">Solteir<span class="vogalSexo">o</span></label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="TX_ESTADOCIVIL" id="casado" value="Casado" onclick="estadoCivil('Casado', '<?php echo $_SESSION['ficha']['varSexo']; ?>');" <?php if('Casado'===$_SESSION['ficha']['varEstadoCivil']){echo ' checked';}?>>
                          <label class="form-check-label" for="cas">Casad<span class="vogalSexo">o</span></label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="TX_ESTADOCIVIL" id="divorciado" value="Divorciado" onclick="estadoCivil('Divorciado', '<?php echo $_SESSION['ficha']['varSexo']; ?>');" <?php if('Divorciado'===$_SESSION['ficha']['varEstadoCivil']){echo ' checked';}?>>
                          <label class="form-check-label" for="divorc">Divorciad<span class="vogalSexo">o</span></label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="TX_ESTADOCIVIL" id="viuvo" value="Viúvo" onclick="estadoCivil('Viúvo', '<?php echo $_SESSION['ficha']['varSexo']; ?>');" <?php if('Viúvo'===$_SESSION['ficha']['varEstadoCivil']){echo ' checked';}?>>
                          <label class="form-check-label" for="viuvo">Viúv<span class="vogalSexo">o</span></label>
                        </div>
                      </div>
                    </div>
                    <div class="form-group col-12 sobrenome-solteira-ficha">
                      <label for="sobrenome">Sobrenome de solteira</label>
                      <input type="text" name="TX_SOBRENOMESOLTEIRAFICHA" id="TX_SOBRENOMESOLTEIRAFICHA" class="form-control" <?php echo " value='".$_SESSION['ficha']['varSobrenomeSolteiraFicha']."'"; ?>>
                    </div>
                    <div class="form-group col-12">
                      <label><strong>Cônjuge</strong></label>
                    </div>
                    <div class="form-group col-12 sobrenome-conjuge">
                      <label for="sobrenomeConjuge">Sobrenome d<span class="vogalSexoContrario">o</span> <span class="tipo-conjuge">cônjuge</span>:</label>
                      <input type="text" class="form-control" id="TX_SOBRENOMECONJUGE" name="TX_SOBRENOMECONJUGE" value="<?php echo $_SESSION['ficha']['varSobrenomeConjuge']; ?>">
                    </div>
                    <div class="form-group col-12 nome-conjuge">
                      <label for="nomeConjuge">Nome d<span class="vogalSexoContrario">o</span> <span class="tipo-conjuge">cônjuge</span> <span class="parenteses">(pré-nome, nome do meio… ex.: Helga Sara, Helen Augustine)</span></label>
                      <input type="text" class="form-control" id="TX_NOMECONJUGE" name="TX_NOMECONJUGE" value="<?php echo $_SESSION['ficha']['varNomeConjuge']; ?>">
                    </div>
                    <div class="form-group col-12 sobrenome-solteira-conjuge">
                      <label for="sobrenome">Sobrenome de solteira da cônjuge (Mädchenname):</label>
                      <input type="text" name="TX_SOBRENOMESOLTEIRACONJUGE" id="TX_SOBRENOMESOLTEIRACONJUGE" class="form-control" <?php echo " value='".$_SESSION['ficha']['varSobrenomeSolteiraConjuge']."'"; ?>>
                    </div>
                  </div>
                </div>
              </div>
              <!-- _____________________ OBS ____________________ -->
              <div class="col-4 d-flex pl-1">
                <div class="card align-self-stretch w-100"> 
                  <div class="card-header obs">
                    <h4 class="col-12 px-0">Inserir aqui observações da ficha e/ou do pesquisador</h4>
                  </div>
                  <textarea class="form-control h-100" id="Obs1" name="Obs1"><?php echo $_SESSION['ficha']['varObs'] ?></textarea>
                </div>
              </div>
                <!-- ____________________________________________ -->
              <div class="col-8 pr-0">
                <a class="btn btn-primary" href="#carrossel-passos" role="button" data-slide="prev">
                  Voltar
                </a>
                <button id="salvar1" class="btn btn-success float-right" href="#" role="button" data-slide="next" type="submit" onclick="salvar('1');">
                  Salvar e Continuar
                </button>
              </div>
            </div>
          </div>
          <!-- Fim Item 1 -->

          <!-- Início Item 2 -->
          <div class="<?php if($varFase===2){echo "carousel-item active";} else {echo "carousel-item";} ?>">
            <div class="row">
              <div class="col-8">
                <div class="card">
                  <div class="card-header" id="matriculaFase3">
                    <h4 class="d-flex px-0"><span class="text-lowercase">Mat.:</span> <span class="num-matricula"><?php echo $_SESSION['ficha']['varMatricula']; ?></span></h4>
                      <h4><?php echo $_SESSION['ficha']['varTituloPessoa']. " " . $_SESSION['ficha']['varNome']. " " .$_SESSION['ficha']['varSobrenome']; ?></h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group col-12">
                      <label for="nacion">Nacionalidade:</label>
                      <input type="text" class="form-control" name="TX_NACIONALIDADE" id="TX_NACIONALIDADE"<?php echo " value='".  $_SESSION['ficha']['varNacionalidade']."'"; ?>>
                    </div>
                    <div class="form-group col-12">
                      <label for="natur">Naturalidade:</label>
                      <input type="text" class="form-control" name="TX_NATURALIDADE" id="TX_NATURALIDADE"<?php echo " value='".  $_SESSION['ficha']['varNaturalidade']."'"; ?>>
                    </div>
                    <div class="form-group col-12">
                      <label for="prof">Profissão:</label>
                      <input type="text" class="form-control" name="TX_PROFISSAO" id="TX_PROFISSAO"<?php echo " value='".  $_SESSION['ficha']['varProfissao']."'"; ?>>
                    </div>
                    <div class="form-group col-12">
                      <label for="cartId">Carteira de Identidade nº:</label>
                      <input type="text" class="form-control" name="TX_IDENTIDADE" id="TX_IDENTIDADE"<?php echo " value='".  $_SESSION['ficha']['varIdentidade']."'"; ?>>
                    </div>
                    <div class="form-group col-12">
                      <label for="expedicao">emitida pela Polícia de:</label>
                      <input type="text" class="form-control" name="TX_EXPEDICAO" id="TX_EXPEDICAO"<?php echo " value='".  $_SESSION['ficha']['varExpedicao']."'"; ?>>
                    </div>
                  </div>
                </div>
              </div>
              <!-- _____________ OBS ____________________________ -->
              <div class="col-4 d-flex">
                <div class="card align-self-stretch w-100"> 
                  <div class="card-header obs">
                    <h4 class="col-12 px-0">Inserir aqui observações da ficha e/ou do pesquisador</h4>
                  </div>
                  <textarea class="form-control h-100" id="Obs2" name="Obs2"><?php echo $_SESSION['ficha']['varObs']; ?></textarea>
                </div>
              </div>
                <!-- ____________________________________________ -->
              <div class="col-8"> 
                <a class="btn btn-primary" href="#carrossel-passos" role="button" data-slide="prev">
                  Voltar
                </a>
                <button id="salvar2" class="btn btn-success float-right" href="#" role="button" data-slide="next" type="submit" onclick="salvar('2');">
                  Salvar e Continuar
                  </button>
              </div>
            </div>
          </div>
          <!-- Fim Item 2 -->


          <!-- Início Item 3 -->
          <div class="<?php if($varFase===3){echo "carousel-item active";} else {echo "carousel-item";} ?>">
            <div class="row">
              <div class="col-8">
                <div class="card">
                  <div class="card-header" id="matriculaFase4">
                    <h4 class="d-flex px-0"><span class="text-lowercase">Mat.:</span> <span class="num-matricula"><?php echo $_SESSION['ficha']['varMatricula']; ?></span></h4>
                      <h4><?php echo $_SESSION['ficha']['varTituloPessoa']. " " . $_SESSION['ficha']['varNome']. " " .$_SESSION['ficha']['varSobrenome']; ?></h4>
                  </div>
                  <div class="card-body">
                  <div id="filhoAdicionado">
                  <?php
                  //echo "Session Sexo Ficha: ".$_SESSION['ficha']['varSexo']."<br/>";
                  $varSexoFicha=$_SESSION['ficha']['varSexo']; // Sexo do progenitor
                    if($varSexoFicha==="M"){
                        $varCampoGenitor="TX_Pai";
                    }else{
                        $varCampoGenitor="TX_Mae";
                    }
                    //echo "varCampoGenitor: ".$varCampoGenitor;

                  $sqlVerificaFilhos="SELECT * FROM dbkartei.tab_filhos WHERE ".$varCampoGenitor."='".$_SESSION['ficha']['varMatricula']."'";
                  //echo "SQL: ".$sqlVerificaFilhos."<br>";
                  $conexao = mysqli_connect('66.33.203.11', 'kartei', 'ktARI#19', 'dbkartei'); //Desenv
                  if (!$conexao ) {
                    echo "Error: Connection with DB MySQL is fail." . PHP_EOL;
                    echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
                    exit;
                  }
                  else{ // echo "Conexão Ok.<br/>";
                        $numFilho=0;
                        $nomesFilhos=[];
                        $sobrenomesFilhos=[];
                        $sexosFilhos=[];
                        $dtNascFilhos=[];

                        $rsVerifica=mysqli_query($conexao, $sqlVerificaFilhos);
                        while($dadosFilhos=mysqli_fetch_assoc($rsVerifica)){
                              $idsFilhos[$numFilho]=$dadosFilhos['id_FILHO'];
                              $nomesFilhos[$numFilho]=$dadosFilhos['TX_Nome'];
                              $sexosFilhos[$numFilho]=$dadosFilhos['TX_Sexo'];
                              $dtNascFilhos[$numFilho]=$dadosFilhos['DT_Nascimento'];
                              if($sexosFilhos[$numFilho]==="M"){
                                $chkM="checked";
                                $chkF="";
                              }else{
                                $chkF="checked";
                                $chkM="";
                              }
                        //echo "Id filho ".($numFilho+1).": ".$idsFilhos[$numFilho]."<br>";
                        // cria formulario ------
                        echo "<div class='row px-3 align-items-center finalizado pb-4'>";
                        echo "    <div class='col-auto pl-3 mb-0'>Filho ".($numFilho+1).":</div>";
                        echo "        <div class='col-auto'>";
                        echo "          <input id='idFilho".($numFilho+1)."' type='text' class='d-none' value='".$idsFilhos[$numFilho]."'>";
                        echo "          <input id='NomeFilho".($numFilho+1)."' type='text' style='width:150px;' class='form-control' value='".$nomesFilhos[$numFilho]."'>";
                        echo "        </div>";
                        echo "        <div class='col-12 d-xl-none mt-3'></div>";
                        echo "        <div class='col-auto pl-3 pr-2'>nascid<span class='vogalSexo'>o</span> em </div>";
                        echo "        <div class='col-auto'>";
                        $dtNascFilhoAdd=$dtNascFilhos[$numFilho];
                        $anoNascFilhoAdd=intval(substr($dtNascFilhos[$numFilho],0,4));
                        $mesNascFilhoAdd=intval(substr($dtNascFilhos[$numFilho],5,2));
                        $diaNascFilhoAdd=intval(substr($dtNascFilhos[$numFilho],8,2));
                        $seldFilhoAdd='';
                        $selmFilhoAdd=[];
                        $selaFilhoAdd='';
                        echo "          <select class='form-control' id='diaNascFilho".($numFilho+1)."'>";
                        echo "            <option value='00'></option>";
                                for($diafAdd=1;$diafAdd<32;$diafAdd++){
                                if($diafAdd===$diaNascFilhoAdd){
                                    $seldFilhoAdd= ' selected';
                                }else{
                                    $seldFilhoAdd='';
                                } 
                                echo "<option value=".$diafAdd.$seldFilhoAdd.">".$diafAdd."</option>";
                            }
                        echo "          </select>";
                        echo "        </div>";
                        echo "        <div class='col-auto'>";
                        echo "          <select class='form-control' id='mesNascFilho".($numFilho+1)."'>"; 
                        for($mesfAdd=1;$mesfAdd<13;$mesfAdd++){
                              if($mesfAdd===$mesNascFilhoAdd){
                                  $selmFilhoAdd[$mesfAdd]=' selected';
                              }else{
                                  $selmFilhoAdd[$mesfAdd]='';
                              } 
                        }
                        echo "            <option value='00'></option>";
                        echo "            <option value='01'".$selmFilhoAdd[1].">janeiro</option>";
                        echo "            <option value='02'".$selmFilhoAdd[2].">fevereiro</option>";
                        echo "            <option value='03'".$selmFilhoAdd[3].">março</option>";
                        echo "            <option value='04'".$selmFilhoAdd[4].">abril</option>";
                        echo "            <option value='05'".$selmFilhoAdd[5].">maio</option>";
                        echo "            <option value='06'".$selmFilhoAdd[6].">junho</option>";
                        echo "            <option value='07'".$selmFilhoAdd[7].">julho</option>";
                        echo "            <option value='08'".$selmFilhoAdd[8].">agosto</option>";
                        echo "            <option value='09'".$selmFilhoAdd[9].">setembro</option>";
                        echo "            <option value='10'".$selmFilhoAdd[10].">outubro</option>";
                        echo "            <option value='11'".$selmFilhoAdd[11].">novembro</option>";
                        echo "            <option value='12'".$selmFilhoAdd[12].">dezembro</option>";
                        echo "          </select>";
                        echo "        </div>";
                        echo "        <div class='col-auto'> ";
                        echo "          <select class='form-control' id='anoNascFilho".($numFilho+1)."'>";
                        for($anofAdd=1850;$anofAdd<1971;$anofAdd++){
                                if($anofAdd===intval($anoNascFilhoAdd)){
                                    $selaFilhoAdd= ' selected';
                                }else{
                                    $selaFilhoAdd='';
                                }
                                echo "<option value=".$anofAdd.$selaFilhoAdd.">".$anofAdd."</option>";
                        }
                        echo "            <option>1956</option>";
                        echo "          </select>";
                        echo "        </div>";
                        echo "    <div class='col-auto pl-2'>";
                        echo "      <div class='form-group form-check form-check-inline m-0'>";
                        echo "      <input class='form-check-input' type='radio' name='TX_SexoFilho".($numFilho+1)."' id='mascFilho".($numFilho+1)."' value='M' ".$chkM.">";
                        echo "      <label class='form-check-label' for='mascFilho".($numFilho+1)."'>M</label>";
                        echo "      </div>";
                        echo "      <div class='form-group form-check form-check-inline mb-0'>";
                        echo "        <input class='form-check-input' type='radio' name='TX_SexoFilho".($numFilho+1)."' id='femFilho".($numFilho+1)."' value='F' ".$chkF.">";
                        echo "        <label class='form-check-label' for='femFilho".($numFilho+1)."'>F</label>";
                        echo "      </div>";
                        echo "    </div>";
                        echo "    <div class='col-auto'><a href=''><i class='far fa-trash-alt'></i></a></div>";
                        echo "  </div>";
                        $numFilho++;
                        }
                      }  
                      $_SESSION['ficha']['varNumFilhos']=$numFilho;
                        mysqli_close($conexao);
                  ?> 
                   
                    </div>
                    <div class="col-12" id="filhoAtual">
                      <?php if(!isset($_SESSION['ficha']['varNumeroFilho'])){$_SESSION['ficha']['varNumeroFilho']=1;} ?>
                      <h6><?php echo "Filho ".($numFilho+1); ?></h6>
                    </div>
                    <div class="form-group col-12 mb-2">
                      <label for="filho1Nome">Nome:</label>
                      <input type="text" class="form-control" id="TX_NOMEFILHO" name="TX_NOMEFILHO">
                    </div>
                    <div class="d-flex">
                      <div class="form-group form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="TX_SEXOFILHO" id="mascFilho" value="M">
                        <label class="form-check-label" for="mascFilho1">Masculino</label>
                      </div>
                      <div class="form-group form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="TX_SEXOFILHO" id="femFilho" value="F">
                        <label class="form-check-label" for="femFilho1">Feminino</label>
                      </div>
                    </div>
                    <div class="form-group col-6">
                      <label for="dataNascFilho1">Data de Nascimento:</label>
                      <div class="d-flex">
                        <div class="col-3 pl-0">
                          <?php // =========================================================  SELECT Data Nascimento FILHO
                     /*       
                            $dtNascFilho=$_SESSION['ficha']['varDataNascimento'];
                            echo "Data de Nascimento do filho: ".$dtNascFilho."<br/>";
                             $anoNascFilho=intval(substr($dtNascFilho,0,4));
                             $mesNascFilho=intval(substr($dtNascFilho,5,2));
                             $diaNascFilho=intval(substr($dtNascFilho,8,2));
                             $seldFilho='';
                             $selmFilho=[];
                             $selaFilho='';
                             //echo "dtNasc: ".$dtNasc."<br/>";
                             //echo "anoNasc: ".$anoNasc."<br/>";
                             //echo "mesNasc: ".$mesNasc."<br/>";
                             //echo "diaNasc: ".$diaNasc."<br/>";
                    */         
                           ?>    
                          <select class="form-control" id="TX_DIANASCIMENTOFILHO" name="TX_DIANASCIMENTOFILHO">
                          <option value="00"> </option>  
                            <?php
                            for($diaf=1;$diaf<32;$diaf++){
                    /* 
                                if($diaf===$diaNascFilho){
                                    $seldf= ' selected';
                                }else{
                                    $seldf='';
                                }
                     */
                                echo "<option value=".$diaf.$seldFilho.">".$diaf."</option>";
                            }
                            ?>
                          </select>
                        </div>
                        <?php
                    /*
                        for($mesf=1;$mesf<13;$mesf++){
                            if($mesf===$mesNascFilho){
                                $selm[$mesf]=' selected';
                            }else{
                                $selm[$mesf]='';
                            }
                        }
                     */
                        ?>
                        <select class="form-control" id="TX_MESNASCIMENTOFILHO" name="TX_MESNASCIMENTOFILHO">
                          <option value="00" </option>
                          <option value="01">janeiro</option>
                          <option value="02">fevereiro</option>
                          <option value="03">março</option>
                          <option value="04">abril</option>
                          <option value="05">maio</option>
                          <option value="06">junho</option>
                          <option value="07">julho</option>
                          <option value="08">agosto</option>
                          <option value="09">setembro</option>
                          <option value="10">outubro</option>
                          <option value="11">novembro</option>
                          <option value="12">dezembro</option>
                        </select>
                        <div class="col-4"> 
                          <select class="form-control" id="TX_ANONASCIMENTOFILHO" name="TX_ANONASCIMENTOFILHO" style="width:90px;">
                            <option value="0000"> </option>
                            <?php
                            for($anof=1850;$anof<1971;$anof++)
                            {
                     /*
                                if($anof===intval($anoNascFilho)){
                                    $selaFilho= ' selected';
                                }else{
                                    $selaFilho='';
                                }
                      */
                                echo "<option value=".$anof.$selaFilho.">".$anof."</option>";}
                            ?>
                          </select>
                        </div> 
                      </div>
                    </div> 
                    <div class="col-12 mt-5">
                      <?php
                      global $varSexFicha,$varNascFicha, $varMat;
                      $varSexFicha=$_SESSION['ficha']['varSexo'];
                      $varNascFicha=$_SESSION['ficha']['varDataNascimento'];
                      $varMat=$_SESSION['ficha']['varMatricula'];
                      ?>
                      <button class="btn btn-info" role="button" name="bot_inserirFilho" id="inserirFilho" onclick="novoFilho('inserir', '3','<?php echo $varMat."', '".$varSexFicha."', '".$varNascFicha."', '".$numFilho."'"; ?>);">
                        Incluir mais um filho
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- _____________________ OBS ____________________ -->
              <div class="col-4 d-flex">
                <div class="card align-self-stretch w-100">
                  <div class="card-header obs">
                    <h4 class="col-12 px-0">Inserir aqui observações da ficha e/ou do pesquisador</h4>
                  </div>
                  <textarea class="form-control h-100" id="Obs3" name="Obs3"><?php echo $_SESSION['ficha']['varObs']; ?></textarea>
                </div>
              </div>
                  <!-- ____________________________________________ -->
              <div class="col-8"> 
                <a class="btn btn-primary" href="#carrossel-passos" role="button" data-slide="prev">
                  Voltar
                </a>
                <button id="salvar3" name="bot_salvarFilho" class="btn btn-success float-right" href="#" role="button" data-slide="next" type="submit" onclick="salvarFilhos('salvar', '4','<?php echo $varMat."', '".$varSexFicha."', '".$varNascFicha."', '".$numFilho."'"; ?>);"> <!-- onclick="salvarFilhos('salvar', '4','<? //php echo $varMat."', '".$varSexFicha."', '".$varNascFicha."', '".$numFilho."'"; ?>);">  ||| salvarFake('salvar', '3','<?// php echo $varMat."', '".$varSexFicha."', '".$varNascFicha."', '".$numFilho."'"; ?>);">-->
                Salvar e Continuar
                </button>
              </div>
            </div>
          </div>
          <!-- Fim Item 3 -->

          <!-- Início Item 4 -->
          <div class="<?php if($varFase===4){echo "carousel-item active";} else {echo "carousel-item";} ?>">
            <div class="row">
              <div class="col-8">
                <div class="card">
                  <div class="card-header" id="matriculaFase5">
                    <h4 class="d-flex px-0"><span class="text-lowercase">Mat.:</span> <span class="num-matricula"><?php echo $_SESSION['ficha']['varMatricula']; ?></span></h4>
                      <h4><?php echo $_SESSION['ficha']['varTituloPessoa']. " " . $_SESSION['ficha']['varNome']. " " .$_SESSION['ficha']['varSobrenome']; ?></h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group col-6">
                      <label for="dataAceitProp">Data da aceitação como sóci<span class="vogalSexo">o</span>:</label>
                      <div class="d-flex">
                        <div class="col-3 pl-0">
                          <?php
                          if(!isset($_SESSION['ficha']['varDataAceitacao'])){
                              $dtAceit='';
                          }else{
                              $dtAceit=$_SESSION['ficha']['varDataAceitacao'];
                          }
                            $anoAceit=intval(substr($dtAceit,0,4));
                            $mesAceit=intval(substr($dtAceit,5,2));
                            $diaAceit=intval(substr($dtAceit,8,2));
                            $seldAceit='';
                            $selmAceit=[];
                            $selaAceit='';
                            //echo "dtAceit: ".$dtAceit."<br/>";
                            //echo "anoAceit: ".$anoAceit."<br/>";
                            //echo "mesAceit: ".$mesAceit."<br/>";
                            //echo "diaAceit: ".$diaAceit."<br/>";
                          ?>
                          <select class="form-control" id="TX_DIAACEITACAO" name="TX_DIAACEITACAO">
                            <option value="00"> </option>
                            <?php
                            for($diaAc=1;$diaAc<32;$diaAc++){
                                if($diaAc===$diaAceit){
                                    $seldAceit= ' selected';
                                }else{
                                    $seldAceit='';
                                }
                                echo "<option value=".$diaAc.$seldAceit.">".$diaAc."</option>";}
                            ?>
                          </select>
                        </div>
                        <?php
                            for($mesAc=1;$mesAc<13;$mesAc++){
                                if($mesAc===$mesAceit){
                                    $selmAceit[$mesAc]=' selected';
                                }else{
                                    $selmAceit[$mesAc]='';
                                }  
                              } 
                        ?>
                        <select class="form-control" id="TX_MESACEITACAO" name="TX_MESACEITACAO">
                          <option value="00"> </option>
                          <option value="01" <?php echo $selmAceit[1];?>>janeiro</option>
                          <option value="02" <?php echo $selmAceit[2];?>>fevereiro</option>
                          <option value="03" <?php echo $selmAceit[3];?>>março</option>
                          <option value="04" <?php echo $selmAceit[4];?>>abril</option>
                          <option value="05" <?php echo $selmAceit[5];?>>maio</option>
                          <option value="06" <?php echo $selmAceit[6];?>>junho</option>
                          <option value="07" <?php echo $selmAceit[7];?>>julho</option>
                          <option value="08" <?php echo $selmAceit[8];?>>agosto</option>
                          <option value="09" <?php echo $selmAceit[9];?>>setembro</option>
                          <option value="10" <?php echo $selmAceit[10];?>>outubro</option>
                          <option value="11" <?php echo $selmAceit[11];?>>novembro</option>
                          <option value="12" <?php echo $selmAceit[12];?>>dezembro</option>
                        </select>
                        <div class="col-4">
                          <select class="form-control" id="TX_ANOACEITACAO" name="TX_ANOACEITACAO" style="width:90px;">
                            <option value="0000"> </option>
                            <?php
                            for($anoAc=1850;$anoAc<1971;$anoAc++)
                            {
                                  if($anoAc===intval($anoAceit)){
                                      $selaAc= ' selected';
                                  }else{
                                      $selaAc='';
                                  }
                                echo "<option value=".$anoAc.$selaAc.">".$anoAc."</option>";
                            }
                            ?>
                          </select>
                        </div>
                      </div>
                    </div>
                    <div id="proponente1A" name="proponente1">
                      <h6 class="col-12">Proponente 1</h6>
                      <div class="d-flex">
                        <div class="form-group col-2">
                          <label for="Prop1Sobrenome">Título:</label>
                          <input type="text" class="form-control" id="TX_TituloProponente1A" name ="TX_TituloProponente1A" value="<?php echo $_SESSION['ficha']['varTituloProponente1'] ;?>">
                        </div>
                        <div class="form-group col">
                          <label for="Prop1Sobrenome">Sobrenome:</label>
                          <input type="text" class="form-control" id="TX_SobrenomeProponente1A" name="TX_SobrenomeProponente1A" value="<?php echo $_SESSION['ficha']['varSobrenomeProponente1'] ;?>">
                        </div>
                      </div>
                      <div class="form-group col">
                        <label for="Prop1Nome">Nome:</label>
                        <input type="text" class="form-control" id="TX_NomeProponente1A" name="TX_NomeProponente1A" value="<?php echo $_SESSION['ficha']['varNomeProponente1'] ;?>">
                      </div>
                      <div class="d-flex">
                        <div class="form-group form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="TX_SexoProponente1A" id="mascProponente1A" value="M"  <?php if($_SESSION['ficha']['varSexoProponente1']==="M"){ echo " checked" ;}?>>
                          <label class="form-check-label" for="mascFilho1">Masculino</label>
                        </div>
                        <div class="form-group form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="TX_SexoProponente1A" id="femProponente1A" value="F"  <?php if($_SESSION['ficha']['varSexoProponente1']==="F"){ echo " checked" ;}?>>
                          <label class="form-check-label" for="femFilho1">Feminino</label>
                        </div>
                      </div>
                    </div>

                    <div id="proponente1" class="d-none">
                      <div class="d-flex align-items-center finalizado">
                        <div class='form-group col-auto pl-3 mb-2'>Proponente1:</div>
                        <div class='form-group col-2 mb-2'>
                          <input type='text' class='form-control' id='TX_TituloProponente1' name ='TX_TituloProponente1' value="<?php echo $_SESSION['ficha']['varTituloProponente1'] ;?>">
                        </div>
                        <div class='form-group col mb-2'>
                          <input type='text' class='form-control' id='TX_SobrenomeProponente1' name='TX_SobrenomeProponente1' value="<?php echo $_SESSION['ficha']['varSobrenomeProponente1'] ;?>">
                        </div>
                        <div class='form-group col mb-2'> 
                          <input type='text' class='form-control' id='TX_NomeProponente1' name='TX_NomeProponente1' value="<?php echo $_SESSION['ficha']['varNomeProponente1'] ;?>">
                        </div>
                      </div>
                      <div class='d-flex'>
                        <div class='form-group form-check form-check-inline ml-auto'>
                          <input class='form-check-input' type='radio' name='TX_SexoProponente1' id='mascProponente1' value='M' <?php if($_SESSION['ficha']['varSexoProponente1']==="M"){ echo " checked" ;}?>>
                          <label class='form-check-label' for='mascProponente1'>Masculino</label>
                        </div>
                        <div class='form-group form-check form-check-inline'>
                          <input class='form-check-input' type='radio' name='TX_SexoProponente1' id='femProponente1' value='F' <?php if($_SESSION['ficha']['varSexoProponente1']==="F"){ echo " checked" ;}?>>
                          <label class='form-check-label' for='femProponente1'>Feminino</label>
                        </div>
                      </div>
                    </div>

                    <div id="proponente2" class="d-none">
                      <h6 class="col-12">Proponente 2</h6>
                      <div class="d-flex">
                        <div class="form-group col-2">
                          <label for="Prop1Titulo">Título:</label> 
                          <input type="text" class="form-control" id="TX_TituloProponente2" name ="TX_TituloProponente2" value="<?php echo $_SESSION['ficha']['varTituloProponente2'] ;?>">
                        </div>
                        <div class="form-group col mb-2">
                          <label for="Prop1Sobrenome">Sobrenome:</label>
                          <input type="text" class="form-control" id="TX_SobrenomeProponente2" name="TX_SobrenomeProponente2" value="<?php echo $_SESSION['ficha']['varSobrenomeProponente2'] ;?>">
                        </div>
                      </div>
                        <div class="form-group col">
                          <label for="Prop1Nome">Nome:</label>
                          <input type="text" class="form-control" id="TX_NomeProponente2" name="TX_NomeProponente2" value="<?php echo $_SESSION['ficha']['varNomeProponente2'] ;?>">
                        </div>
                      <div class="d-flex">
                        <div class="form-group form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="TX_SexoProponente2" id="mascProponente2" value="M" <?php if($_SESSION['ficha']['varSexoProponente2']==="M"){ echo " checked" ;}?>>
                          <label class="form-check-label" for="mascFilho1">Masculino</label>
                        </div>
                        <div class="form-group form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="TX_SexoProponente2" id="femProponente2" value="F" <?php if($_SESSION['ficha']['varSexoProponente2']==="F"){ echo " checked" ;}?>>
                          <label class="form-check-label" for="femFilho1">Feminino</label>
                        </div>
                      </div>
                    </div>
                    <div class="col-12">
                      <button id="btnAdicionarProponente" class="btn btn-info" role="button" type="submit" onclick="inserirProponente();">
                        Adicionar Proponente
                      </button>
                    </div>
                  </div>
                </div>
              </div>
              <!-- _____________________ OBS ____________________ -->
              <div class="col-4 d-flex">
                <div class="card align-self-stretch w-100"> 
                  <div class="card-header obs">
                    <h4 class="col-12 px-0">Inserir aqui observações da ficha e/ou do pesquisador</h4>
                  </div>               
                  <textarea class="form-control h-100" id="Obs4" name="Obs4"><?php echo $_SESSION['ficha']['varObs'] ?></textarea>
                </div>
              </div>
                <!-- ____________________________________________ -->
              <div class="col-8">
                <a class="btn btn-primary" href="#carrossel-passos" role="button" data-slide="prev">
                  Voltar
                </a>
                <button id="salvar4" class="btn btn-success float-right" href="#" role="button" data-slide="next" type="submit" onclick="salvarProponente();">
                  Salvar e Continuar
                </button>
              </div>
            </div>
          </div>
          <!-- Fim Item 4 -->

          <!-- Início Item 5 -->
          <div class="<?php if($varFase===5){echo "carousel-item active";} else {echo "carousel-item";} ?>">
            <div class="row">
              <div class="col-8">
                <div class="card">
                  <div class="card-header" id="matriculaFase6">
                    <h4 class="d-flex px-0"><span class="text-lowercase">Mat.:</span> <span class="num-matricula"><?php echo $_SESSION['ficha']['varMatricula']; ?></span></h4>
                      <h4><?php echo $_SESSION['ficha']['varTituloPessoa']. " " . $_SESSION['ficha']['varNome']. " " .$_SESSION['ficha']['varSobrenome']; ?></h4>
                  </div>
                  <div class="card-body">
                    <div class="form-group col-12">
                      <label for="destino">Destino:</label>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="radiosDestino" id="desassociou" value="Desassociou-se"<?php if($_SESSION['ficha']['varDestino']==="Desassociou-se"){ echo " checked" ;}?>>
                        <label class="form-check-label" for="desassociou">
                          Desassociou-se
                        </label>
                      </div>
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="radiosDestino" id="emigrouExt" value="Emigrou para o exterior"<?php if($_SESSION['ficha']['varDestino']==="Emigrou para o exterior"){ echo " checked" ;}?>>
                        <label class="form-check-label" for="emigrouExt">
                          Emigrou para o exterior
                        </label>
                      </div>
                      <div class="form-check disabled">
                        <input class="form-check-input" type="radio" name="radiosDestino" id="imigrouInt" value="Imigrou para o interior do Brasil"<?php if($_SESSION['ficha']['varDestino']==="Imigrou para o interior do Brasil"){ echo " checked" ;}?>>
                        <label class="form-check-label" for="imigrouInt">
                          Imigrou para o interior do Brasil
                        </label>
                      </div>
                    </div>
                    <div class="d-flex align-items-end">
                      <div class="form-group col-6">
                        <label for="dataFalec">Data de falecimento (cal. gregoriano):</label>
                        <div class="d-flex">
                          <div class="col-auto pl-0">
                            <?php
                            if(!isset($_SESSION['ficha']['varDataFalecimento'])){
                                $dtFalec='';
                            }else{
                                $dtFalec=$_SESSION['ficha']['varDataFalecimento'];
                            }
                              $anoFalec=intval(substr($dtFalec,0,4));
                              $mesFalec=intval(substr($dtFalec,5,2));
                              $diaFalec=intval(substr($dtFalec,8,2));
                              $seldFalec='';
                              $selmFalec=[];
                              $selaFalec='';
                              //echo "dtFalec: ".$dtFalec."<br/>";
                              //echo "anoFalec: ".$anoFalec."<br/>";
                              //echo "mesFalec: ".$mesFalec."<br/>";
                              //echo "diaFalec: ".$diaFalec."<br/>";
                            ?>
                            <select class="form-control" id="TX_DIAFALECIMENTO" name="TX_DIAFALECIMENTO">
                                <option value="00"> </option>
                                <?php
                                for($diaFlc=1;$diaFlc<32;$diaFlc++){
                                    if($diaFlc===$diaFalec){
                                        $seldFalec= ' selected';
                                    }else{
                                        $seldFalec='';
                                    }
                                    echo "<option value=".$diaFlc.$seldFalec.">".$diaFlc."</option>";}
                                ?>
                            </select>
                          </div>  
                          <div class="col pl-0">
                            <?php
                            for($mesFlc=1;$mesFlc<13;$mesFlc++){
                               if($mesFlc===$mesFalec){
                                   $selmFalec[$mesFlc]=' selected';
                               }else{
                                   $selmFalec[$mesFlc]='';
                               }  

                              } 
                            ?>
                            <select class="form-control" id="TX_MESFALECIMENTO" name="TX_MESFALECIMENTO">
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
                          <div class="col-auto pl-0"> 
                            <select class="form-control" id="TX_ANOFALECIMENTO" name="TX_ANOFALECIMENTO" style="width:90px;">
                              <option value="0000"> </option>
                              <?php
                              for($anoFlc=1850;$anoFlc<1971;$anoFlc++)
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
                        </div> 
                      </div>
                      <div class="form-group col-6">
                        <label for="dataFalec">Data de falecimento (cal. judaico):</label>
                        <div class="d-flex">
                          <div class="col-auto pl-0">
                            <?php
                              if(!isset($_SESSION['ficha']['varDiaFalecimentoJud'])){
                                  $diaFalecJ='';
                              }else{
                                  $diaFalecJ=$_SESSION['ficha']['varDiaFalecimentoJud'];               
                              }
                              if(!isset($_SESSION['ficha']['varMesFalecimentoJud'])){
                                  $mesFalecJ='';
                              }else{
                                  $mesFalecJ=$_SESSION['ficha']['varMesFalecimentoJud'];               
                              }
                              if(!isset($_SESSION['ficha']['varAnoFalecimentoJud'])){
                                  $anoFalecJ='';
                              }else{
                                  $anoFalecJ=$_SESSION['ficha']['varAnoFalecimentoJud'];               
                              }
                                $seldFalecJ='';
                                $mesFalecExt=['','tishrei','cheshvan','kislev','tevet','shevat','adar','nissan','iyar','sivan','tamuz','av','elul'];
                                $selmFalecJ=[];
                                $selaFalecJ='';
                                //echo "dtFalec: ".$dtFalecJ."<br/>";
                                //echo "anoFalecJ: ".$anoFalecJ."<br/>";
                                //echo "mesFalecJ: ".$mesFalecJ."<br/>";
                                //echo "diaFalecJ: ".$diaFalecJ."<br/>";
                                // echo "dtFalecJ:".$dtFalecJ."<============================= <br/>";
                              ?>
                              <select class="form-control" id="TX_DIAFALECIMENTOJUD" name="TX_DIAFALECIMENTOJUD">
                                <option value="00"></option>
                                <?php
                                for($diaFlcJ=1;$diaFlcJ<31;$diaFlcJ++){
                                    if($diaFlcJ===intval($diaFalecJ)){
                                        $seldFalecJ= ' selected';
                                    }else{
                                        $seldFalecJ='';
                                    }
                                    echo "<option value=".$diaFlcJ.$seldFalecJ.">".$diaFlcJ."</option>";
                                }
                                ?>
                              </select>
                          </div>
                          <div class="col pl-0">
                                <?php
                                for($mesFlcJ=0;$mesFlcJ<13;$mesFlcJ++){
                                   if($mesFalecExt[$mesFlcJ]===$mesFalecJ){
                                       $selmFalecJ[$mesFlcJ]=' selected';
                                   }else{
                                       $selmFalecJ[$mesFlcJ]='';
                                   }
                                }
                            ?>
                            <select class="form-control" id="TX_MESFALECIMENTOJUD" name="TX_MESFALECIMENTOJUD">
                              <option value="00"></option>
                              <option value="tishrei" <?php echo $selmFalecJ[1];?>>tishrei</option>
                              <option value="cheshvan" <?php echo $selmFalecJ[2];?>>cheshvan</option>
                              <option value="kislev" <?php echo $selmFalecJ[3];?>>kislev</option>
                              <option value="tevet" <?php echo $selmFalecJ[4];?>>tevet</option>
                              <option value="shevat" <?php echo $selmFalecJ[5];?>>shevat</option>
                              <option value="adar" <?php echo $selmFalecJ[6];?>>adar</option>
                              <option value="nissan" <?php echo $selmFalecJ[7];?>>nissan</option>
                              <option value="iyar" <?php echo $selmFalecJ[8];?>>iyar</option>
                              <option value="sivan" <?php echo $selmFalecJ[9];?>>sivan</option>
                              <option value="tamuz" <?php echo $selmFalecJ[10];?>>tamuz</option>
                              <option value="av" <?php echo $selmFalecJ[11];?>>av</option>
                              <option value="elul" <?php echo $selmFalecJ[12];?>>elul</option>
                            </select>
                          </div>
                          <div class="col-auto pl-0"> 
                            <select class="form-control" id="TX_ANOFALECIMENTOJUD" name="TX_ANOFALECIMENTOJUD" style="width:90px;">
                                <option value="0000"></option> 
                                <?php
                                for($anoFlcJ=5610;$anoFlcJ<5801;$anoFlcJ++)
                                {
                                  if($anoFlcJ===intval($anoFalecJ)){
                                      $selaFalecJ= ' selected';
                                  }else{
                                      $selaFalecJ='';
                                  }
                                  echo "<option value=".$anoFlcJ.$selaFalecJ.">".$anoFlcJ."</option>";
                                }
                                ?>
                              </select>
                          </div>
                        </div>
                      </div> 
                    </div>
                  </div>
                </div>
              </div>
              <!-- _____________________ OBS ____________________ -->
              <div class="col-4 d-flex">
                <div class="card align-self-stretch w-100"> 
                  <div class="card-header obs">
                    <h4 class="col-12 px-0">Inserir aqui observações da ficha e/ou do pesquisador</h4>
                  </div>
                  <textarea class="form-control h-100" id="Obs5" name="Obs5"><?php echo $_SESSION['ficha']['varObs']; ?></textarea>
                </div>
              </div>
                <!-- ____________________________________________ -->
              <div class="col-8">
                <a class="btn btn-primary" href="#carrossel-passos" id="inserirProponente" name="inserirProponente" role="button" data-slide="prev">
                  Voltar
                </a>

                <button id="salvar5" class="btn btn-success float-right" href="#" role="button" data-slide="next" type="submit" onclick="salvar('5');">
                    Salvar e Continuar
                </button>
              </div>
            </div>
          </div>
          <!-- Fim Item 5 -->

          <!-- Início Item 6 -->
          <div class="<?php if($varFase===6){echo "carousel-item active";} else {echo "carousel-item";} ?>">
            <div class="row">
              <div class="col-auto">
                <div class="alert alert-warning">Por favor, confira os dados e depois insira ficha no cadastro!</div>
              </div>
              <div class="col-12 finalizado">
                <div class="card">
                  <div class="card-header card-header-final" id="matriculaFase7">
                    <h4 class="d-flex px-0"><span class="text-lowercase">Mat.: </span> <span class="num-matricula"><?php echo $_SESSION['ficha']['varMatricula']; ?></span></h4>
                    <h4></h4>
                  </div>
                  <div class="card-body row px-3">
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
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="TX_SEXO_Final" id="masc_Final" value="M" onclick="mascFem('M');" <?php if($_SESSION['ficha']['varSexo']==="M"){ echo "checked";} ?>>
                          <label class="form-check-label" for="masc">Masculino</label>
                        </div>
                        <div class="form-check form-check-inline">
                          <input class="form-check-input" type="radio" name="TX_SEXO_Final" id="fem_Final" value="F" onclick="mascFem('F');" <?php if($_SESSION['ficha']['varSexo']==="F"){ echo "checked";} ?>>
                          <label class="form-check-label" for="fem">Feminino</label>
                        </div>
                      </div>
                      <div class="form-group col-12">
                        <div class="row px-3">
                          <div class="form-check-group col-auto pl-0">
                            <input class="form-check-input" type="radio" name="dataIdade_Final" id="dataNascRadio_Final" value="option2" <?php if($_SESSION['ficha']['varDataNascimento']!==""){ echo "checked";} ?> onClick="verificaNascIdade('dt');">
                            <label for="dataNascRadio">nascid<span class="vogalSexo">o</span> em </label>
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
                                for($anoFinal=1850;$anoFinal<1971;$anoFinal++)
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
                            <div class="form-check-group form-check-inline ml-2 col">
                              <input class="form-check-input" type="radio" name="dataIdade_Final" id="idaderadio_Final" value="option2" onClick="verificaNascIdade('id');" <?php if($_SESSION['ficha']['varIdade']!==""){ echo "checked";} ?>>
                              <label for="idaderadio">Idade:</label>
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
                                <li class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="TX_ESCOLHECONJUGE" id="TX_ESCOLHECONJUGE" value="C1">
                                  <label class="form-check-label" for="divorc">Fulano de Tal</label>
                                </li>
                                <li class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="TX_ESCOLHECONJUGE" id="TX_ESCOLHECONJUGE" value="C2">
                                  <label class="form-check-label" for="divorc">Beltrano de Tal</label>
                                </li>
                                <li class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="TX_ESCOLHECONJUGE" id="TX_ESCOLHECONJUGE" value="C3">
                                  <label class="form-check-label" for="divorc">Sicrano de Tal</label>
                                </li>
                                <li class="form-check form-check-inline">
                                  <input class="form-check-input" type="radio" name="TX_ESCOLHECONJUGE" id="TX_ESCOLHECONJUGE" value="C3">
                                  <label class="form-check-label" for="divorc">Nenhuma delas</label>
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
                              echo "      <input type='text' class='form-control' name='TX_NOMEFILHO".$nff." id='TX_NOMEFILHO".$nff."' value='".$nmFilho[$nff]."'>";
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
                                          for($anoFinalF=1850;$anoFinalF<1971;$anoFinalF++)
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

                          echo "<div class='sugestao d-none' id='sugestao2'> <!-- DIV Balão Sugestão --> 
                                  <div class='seta'></div>
                                  <div class='sugestao-conteudo'>
                                    Este filho é um destes abaixo?
                                    <ul>
                                      <li class='form-check form-check-inline'>
                                        <input class='form-check-input' type='radio' name='TX_ESCOLHECONJUGE' id='TX_ESCOLHECONJUGE' value='C1'>
                                        <label class='form-check-label' for='divorc'>Fulano de Tal</label>
                                      </li>
                                      <li class='form-check form-check-inline'>
                                        <input class='form-check-input' type='radio' name='TX_ESCOLHECONJUGE' id='TX_ESCOLHECONJUGE' value='C2'>
                                        <label class='form-check-label' for='divorc'>Beltrano de Tal</label>
                                      </li>
                                      <li class='form-check form-check-inline'>
                                        <input class='form-check-input' type='radio' name='TX_ESCOLHECONJUGE' id='TX_ESCOLHECONJUGE' value='C3'>
                                        <label class='form-check-label' for='divorc'>Sicrano de Tal</label>
                                      </li>
                                      <li class='form-check form-check-inline'>
                                        <input class='form-check-input' type='radio' name='TX_ESCOLHECONJUGE' id='TX_ESCOLHECONJUGE' value='C3'>
                                        <label class='form-check-label' for='divorc'>Nenhum deles</label>
                                      </li>
                                    </ul>
                                  </div>
                               </div>";

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
                                          for($anoFinalF=1850;$anoFinalF<1971;$anoFinalF++)
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
                              for($anoAcF=1850;$anoAcF<1971;$anoAcF++)
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
                            <input type="text" class="form-control" style="width:50px" value="<?php echo $_SESSION['ficha']['varTituloProponente1']; ?>">
                          </div>
                          <div class="col">
                            <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varNomeProponente1']; ?>">
                          </div>
                          <div class="col">
                            <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varSobrenomeProponente1']; ?>">
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
                                $anoFalec=intval(substr($dtFalec,0,4));
                                $mesFalec=intval(substr($dtFalec,5,2));
                                $diaFalec=intval(substr($dtFalec,8,2));
                                $seldFalec='';
                                $selmFalec=[];
                                $selaFalec='';
                                //echo "dtFalec: ".$dtFalec."<br/>";
                                //echo "anoFalec: ".$anoFalec."<br/>";
                                //echo "mesFalec: ".$mesFalec."<br/>";
                                //echo "diaFalec: ".$diaFalec."<br/>";
                              ?>
                              <select class="form-control" id="TX_DIAFALECIMENTO_Final" name="TX_DIAFALECIMENTO_Final">
                                  <option value="00"> </option>
                                  <?php
                                  for($diaFlc=1;$diaFlc<32;$diaFlc++){
                                      if($diaFlc===$diaFalec){
                                          $seldFalec= ' selected';
                                      }else{
                                          $seldFalec='';
                                      }
                                      echo "<option value=".$diaFlc.$seldFalec.">".$diaFlc."</option>";}
                                  ?>
                              </select>
                            </div>
                            <div class="col-auto">
                              <?php
                              for($mesFlc=1;$mesFlc<13;$mesFlc++){
                                 if($mesFlc===$mesFalec){
                                     $selmFalec[$mesFlc]=' selected';
                                 }else{
                                     $selmFalec[$mesFlc]='';
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
                                for($anoFlc=1850;$anoFlc<1971;$anoFlc++)
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
                                    $diaFalecJ='';
                                }else{
                                    $diaFalecJ=$_SESSION['ficha']['varDiaFalecimentoJud'];               
                                }
                                if(!isset($_SESSION['ficha']['varMesFalecimentoJud'])){
                                    $mesFalecJ='';
                                }else{
                                    $mesFalecJ=$_SESSION['ficha']['varMesFalecimentoJud'];               
                                }
                                if(!isset($_SESSION['ficha']['varAnoFalecimentoJud'])){
                                    $anoFalecJ='';
                                }else{
                                    $anoFalecJ=$_SESSION['ficha']['varAnoFalecimentoJud'];               
                                }
                                  $seldFalecJ='';
                                  $mesFalecExt=['','tishrei','cheshvan','kislev','tevet','shevat','adar','nissan','iyar','sivan','tamuz','av','elul'];
                                  $selmFalecJ=[];
                                  $selaFalecJ='';
                                  //echo "dtFalec: ".$dtFalecJ."<br/>";
                                  //echo "anoFalecJ: ".$anoFalecJ."<br/>";
                                  //echo "mesFalecJ: ".$mesFalecJ."<br/>";
                                  //echo "diaFalecJ: ".$diaFalecJ."<br/>";
                                  // echo "dtFalecJ:".$dtFalecJ."<============================= <br/>";
                                ?>
                                <select class="form-control" id="TX_DIAFALECIMENTOJUD_Final" name="TX_DIAFALECIMENTOJUD_Final">
                                  <option value="00"></option>
                                  <?php
                                  for($diaFlcJ=1;$diaFlcJ<31;$diaFlcJ++){
                                      if($diaFlcJ===intval($diaFalecJ)){
                                          $seldFalecJ= ' selected';
                                      }else{
                                          $seldFalecJ='';
                                      }
                                      echo "<option value=".$diaFlcJ.$seldFalecJ.">".$diaFlcJ."</option>";
                                  }
                                  ?>
                                </select>
                            </div>
                            <div class="col-auto">
                              <?php
                                  for($mesFlcJ=0;$mesFlcJ<13;$mesFlcJ++){
                                     if($mesFalecExt[$mesFlcJ]===$mesFalecJ){
                                         $selmFalecJ[$mesFlcJ]=' selected';
                                     }else{
                                         $selmFalecJ[$mesFlcJ]='';
                                     }
                                  }
                              ?>
                              <select class="form-control" id="TX_MESFALECIMENTOJUD_Final" name="TX_MESFALECIMENTOJUD_Final" style="width:100px">
                                <option value="00"></option>
                                <option value="tishrei" <?php echo $selmFalecJ[1];?>>tishrei</option>
                                <option value="cheshvan" <?php echo $selmFalecJ[2];?>>cheshvan</option>
                                <option value="kislev" <?php echo $selmFalecJ[3];?>>kislev</option>
                                <option value="tevet" <?php echo $selmFalecJ[4];?>>tevet</option>
                                <option value="shevat" <?php echo $selmFalecJ[5];?>>shevat</option>
                                <option value="adar" <?php echo $selmFalecJ[6];?>>adar</option>
                                <option value="nissan" <?php echo $selmFalecJ[7];?>>nissan</option>
                                <option value="iyar" <?php echo $selmFalecJ[8];?>>iyar</option>
                                <option value="sivan" <?php echo $selmFalecJ[9];?>>sivan</option>
                                <option value="tamuz" <?php echo $selmFalecJ[10];?>>tamuz</option>
                                <option value="av" <?php echo $selmFalecJ[11];?>>av</option>
                                <option value="elul" <?php echo $selmFalecJ[12];?>>elul</option>
                              </select>
                            </div>
                            <div class="col-auto pr-0">
                              <select class="form-control" id="TX_ANOFALECIMENTOJUD_Final" name="TX_ANOFALECIMENTOJUD_Final" style="width:90px;">
                                  <option value="0000"></option> 
                                  <?php
                                  for($anoFlcJ=5610;$anoFlcJ<5801;$anoFlcJ++)
                                  {
                                    if($anoFlcJ===intval($anoFalecJ)){
                                        $selaFalecJ= ' selected';
                                    }else{
                                        $selaFalecJ='';
                                    }
                                    echo "<option value=".$anoFlcJ.$selaFalecJ.">".$anoFlcJ."</option>";
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
                <button class="btn btn-success" type="submit" data-toggle="modal" data-target="#modalFinal">
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

    

    

    <script src="cadastroFicha.js"></script>

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
        })
        $('#sugestao1 input').click(function() {
            $('#sugestao1').addClass('d-none');
            $('#link-sugestao1').removeClass('d-none')
        })
        $('#sugestao2 input').click(function() {
            $('#sugestao2').addClass('d-none');
            $('#link-sugestao2').removeClass('d-none')
        })
    
    </script>
    </body>
</html>

