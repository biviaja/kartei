<?php
!isset($_SESSION)?session_start():null;
global $dsexo, $varSexo, $varNome, $varSobrenome, $varSexoUsu, $varNomeUsu, $varSobrenomeUsu;
    isset($_SESSION['usu']['varSexo'])?$varSexoUsu=$_SESSION['usu']['varSexo']:$varSexoUsu=null;
    isset($_SESSION['usu']['varNome'])?$varNomeUsu=$_SESSION['usu']['varNome']:$varNomeUsu=null;
    isset($_SESSION['usu']['varSobrenome'])?$varSobrenomeUsu=$_SESSION['usu']['varSobrenome']:$varSobrenomeUsu=null;
    
    //echo " varSexo: ". $varSexo. " - varNome: ".$varNome." - varSobrenome: ".$varSobrenome."<br/>";
?>    
    <div class="logout">
        <div class="container p-0">
            <div class="row align-items-center">
                            <?php
                            if($varSexoUsu=="M"){$dsexo="o pesquisador";} else {$dsexo="a pesquisadora";}  
                            ?>
                <div class="col">Área restrita para <?php echo $dsexo; ?>: <span class="pl-1"><strong><?php echo $varNomeUsu. " " . $varSobrenomeUsu ?></strong></span>
                <a class="mais-info collapsed" data-toggle="collapse" href="#infosPesquisador" role="button" aria-expanded="false" aria-controls="infosPesquisador"></a> <span class="px-3">|</span> <a href="logoff.php">Sair</a></div>
                <div class="col-auto ml-auto">
                <div id='menuADM'>
                    <a class='btn btn-primary' href='HomeDoPesquisador.php'>Voltar para página Inicial</a>
                </div>

                </div>
             </div>
        </div>
    </div>
