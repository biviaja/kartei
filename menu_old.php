  <nav class="navbar navbar-expand-sm navbar-dark bg-dark">
    <div class="container">
      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>

      <div class="collapse navbar-collapse" id="navbarsExampleDefault">
        <div class="mr-auto title">
          Projeto Kartei<br /><span>Cadastro Histórico de Associados da ARI</span>
        </div>

        <a class="navbar-brand" href="#"><img src="img/logo.png" class="img-responsive"></a>
      </div>
    </div>
  </nav>
  <?php 
    //!isset($_SESSION['ficha']['varMatricula'])?"":$_SESSION['ficha']['varMatricula'];
    //!isset($_SESSION['ficha']['varTipoFicha'])?"":$_SESSION['ficha']['varTipoFicha'];
    //echo "SESSION['usu']['varMatricula']: ".$_SESSION['ficha']['varMatricula']."<br/>";
    //echo "SESSION['usu']['varTipoFicha']: ".$_SESSION['ficha']['varTipoFicha']."<br/>";
    //echo "Fase: ".$_SESSION['ficha']['fase']."<br>";
    ?>
    <?php
     if($_SESSION['ficha']['fase']==='' || !isset($_SESSION['ficha']['fase'])){
        //echo "Session fase: ===> _SESSION['ficha']['fase']==='' || !isset(SESSION['ficha']['fase'] <br>"; 
        //echo "Session fase: ========> _SESSION['ficha']['fase']=".$_SESSION['ficha']['fase'].".<br>"; 
        //echo "Session fase: ========> !isset(SESSION['ficha']['fase']=".!isset($_SESSION['ficha']['fase']).".<br>"; 
        
        $_SESSION['ficha']['fase']="0";
        $passoSalvo="";
     }else{
         //$_SESSION['ficha']['fase'];
         $passoSalvo=""; //passo-salvo";
     }
     //echo "Passo-salvo: ".$passoSalvo."<br>";
     //================================================================================================= fase
     //$_SESSION['ficha']['fase']="5";
     $varFase=intval($_SESSION['ficha']['fase']);
     //$varFase=1;
     //echo "Session fase: =============> ".$_SESSION['ficha']['fase']." - fase+1: ".($varFase+1)."<br>";
     //echo "Session varObsFicha: ======> ".$_SESSION['ficha']['varObsFicha']."<br>";
     //echo "Session varObsPesq: =======> ".$_SESSION['ficha']['varObsPesq']."<br>";
     
     
     //Define as classes do Menu segundo a fase do cadastro.
     $classeMenu = [6]; // inicia o array Classe menu
     $targetMenu = [6]; // inicia o array target menu
     $item = [6]; // inicia o array item
         
     for($nf=0;$nf<6;$nf++){
         //echo "nº fase: ==============================================================> ".$nf."<br>";
        $item[$nf]="carousel-item"; 
        if($nf===$varFase){ // número da fase = sessão fase
            if($nf===5){ // ---------------------------------------------------- última fase
                $classeMenu[$nf]= "col-auto passo passo-atual active ".$passoSalvo;
                $item[$nf]="carousel-item active";
            }else { // --------------------------------------------------------- não é última fase
                   $classeMenu[$nf]="col passo passo-atual active ".$passoSalvo;
                   $targetMenu[$nf]="#carrossel-passos";   
                   $item[$nf]="carousel-item active";
            }
            //echo "targetMenu[".($nf)."]: ---> ".$targetMenu[($nf)]."<br>";
        }else{ // ------------------------------------------------------------- número da fase DIFERENTE sessão fase
            if($nf<($varFase)){ // -------------------------------------------  número da fase MENOR OU IGUAL sessão fase
                //echo "<<<<<< nf: ".$nf." - varFase+1: ".(1+$varFase)."<br>";
                $classeMenu[$nf]="col passo passo-salvo";  // Classe
                $targetMenu[($nf)]="#carrossel-passos";    // target
            }else{// ----------------------------------------------------------- nf é maior que varFase 
                if($nf===6){ // ------------------------------------------------ última fase
                    $classeMenu[$nf]= "col-auto passo";
                }else{ // ------------------------------------------------------ não é última fase
                    if($nf===($varFase+1)){ // --------------------------------- nf = fase
                        $classeMenu[$nf]="col passo";
                        $targetMenu[($nf)]="#carrossel-passos";
                        //echo "= varFase+1: nf: ".$nf." - targetMenu[".(1+$nf)."]: ---> ".$targetMenu[(1+$nf)]."<br>";
                    }else{ // não é a última fase
                        $classeMenu[$nf]="col passo";
                        $targetMenu[$nf]="";
                    }
                }
            }
         }
        // echo "classeMenu[".$nf."]: --> ".$classeMenu[$nf]."<br>";
        // echo "targetMenu[".($nf+1)."]: =============> ".$targetMenu[($nf+1)]."<br>";
     }
    // echo "____________________________________________________________________________________________<br>";
    // for($nf=0;$nf<7;$nf++){
    //     echo "classeMenu[".$nf."]: -> ".$classeMenu[$nf]."<br>";
    //     echo "targetMenu[".$nf."]: -> ".$targetMenu[$nf]."<br>";
    // }
    ?>      