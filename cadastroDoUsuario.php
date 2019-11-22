<!DOCTYPE html>
<html lang="en">
   <?php include 'head.php'; ?>
  <body>
    <?php include 'menu.php'; ?>
    <?php include 'logout.php'; ?>
    <?php !isset($_SESSION['usu']['chkLogin'])?$_SESSION['usu']['chkLogin']="NOK": $_SESSION['usu']['chkLogin']; ?>  
    <div id="layerMsgCadastro" class="msgCadastro">
          <?php 
            //echo "ChkLogin: " . $_SESSION['usu']['chkLogin'] . " - Nv Acesso: ". $_SESSION['usu']['nvAcesso']; 
            !isset($_SESSION['usu']['msgInsert'])?null: $_SESSION['usu']['msgInsert'];
          ?>
    <?php 
        $varLogin=filter_input(INPUT_POST,'varLogin');//Pega a nacionalidade
        
        if($_SESSION['usu']['nvAcesso']>=3){// Nível maior que 3 acessará as fichas sem imagem 
                $sqlUsuario="SELECT * FROM dbkartei.tab_usu WHERE TX_Login =".$varLogin;
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
                    $rsDadosUsuario=mysqli_query($conexao, $sqlUsuario);
                    while($dadosU=mysqli_fetch_assoc($rsDadosUsuario)) // ================================= WHILE pata varrer SELECT
                    {
                        $nomeU=$dadosUsu['TX_Nome'];
                        $SobrenomeU['TX_Sobrenome'];
                        $loginU=$dadosU['TX_Login'];
                        $nivelU=intval($dadosU['NR_NvAcesso']);
                        $sexoU=$dadosU('TX_Sexo');
                        if($sexoU==='M'){$dSexo='o';}else{$dSexo='a';}
                        $emailU=$dadosU['TX_Login'];
                        $telefoneU=$dadosU['TX_Telefone'];
                        $celularU=$dadosU['TX_Celular'];
                        $dataUltimoAcessoU=$dadosU['DT_UltimoAcesso'];
                        $horaUltimoAcessoU=$dadosU['HR_UltimoAcesso'];
                    }    
                    mysqli_close($conexao);
                }    
        }else{
            echo "<script>location.href='index.php';</script>";
        }
    ?>
    </div> 
    <main role="main" class="container"> 
      <form action="cadastrarUsuario.php" method="post">
        <div class="row mt-4">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="col-12">Cadastro d"<?php echo $dSexo." ". $nomeU." ".$sobreNomeU; ?></h4>
                <h4 class="col-12 mb-0"><!--?php/* echo $_SESSION['ficha']['varNome']. " " .$_SESSION['ficha']['varSobrenome']*/ ?--></h4>
              </div>  
              <div class="card-body px-3">
                <div class="row">
                  <div class="form-group col-4">
                    <label for="NoexampleInputEmail1">Nome</label>
                    <input name="TX_NOME" type="text" class="form-control" id="TX_NOME" aria-describedby="emailHelp" value="<?php echo $nomeU; ?>">
                  </div>
                  <div class="form-group col-8">
                    <label for="NoexampleInputEmail1">Sobrenome</label>
                    <input name="TX_SOBRENOME"  type="text" class="form-control" id="TX_SOBRENOME" aria-describedby="emailHelp" value="<?php echo $sobrenomeU; ?>>
                  </div>
                  <div class="form-group col-4">
                    <label for="NoexampleInputEmail1">Login</label>
                    <input name="TX_LOGIN"  type="text" class="form-control" id="TX_LOGIN" aria-describedby="emailHelp" value="<?php echo $loginU; ?>>
                  </div>
                    
                  <div class="form-group col-4"> 
                    <label for="NoexampleInputEmail1">Nível de Acesso</label>
                    <Select name="TX_NVACESSO"  class="form-control" id="TX_NVACESSO" value="<?php echo $nivelU; ?>">
                        <option value="1"> 1 - Pesquisador</option>
                        <option value="3"> 3 - Pesquisador Master</option>
                        <option value="5"> 5 - Pesquisador Secretário</option>
                        <option value="10">10 - Administrador</option>                  
                    </select>
                  </div>
                  <div class="form-group col-4 d-flex align-items-end">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="TX_SEXO" id="masc" value="M" <?php if($sexoU==='M'){echo 'checked';} ?>>
                      <label class="form-check-label" for="masc">Masculino</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="TX_SEXO" id="fem" value="F" <?php if($sexoU==='F'){echo 'checked';} ?>>
                      <label class="form-check-label" for="fem">Feminino</label>
                    </div>
                  </div>
                  <div class="form-group col-4">
                    <label for="NoexampleInputEmail1">Email</label>
                    <input name="TX_EMAIL"  type="email" class="form-control" id="TX_EMAIL" aria-describedby="emailHelp" <?php echo $emailU; ?>>
                  </div>
                  <div class="form-group col-4">
                    <label for="NoexampleInputEmail1">Telefone</label>
                    <input name="TX_TEL"  type="text" class="form-control" id="TX_TEL" aria-describedby="emailHelp" <?php echo $telefoneU; ?>>
                  </div>
                  <div class="form-group col-4">
                    <label for="NoexampleInputEmail1">Celular/WhatsApp</label>
                    <input name="TX_CEL"  type="text" class="form-control" id="TX_CEL" aria-describedby="emailHelp" <?php echo $celularU; ?>>
                  </div>
                  <div class="form-group col-12 text-right mb-0">
                      <?php 
                      if($_SESSION['usu']['chkLogin']==="OK" && $_SESSION['usu']["nvAcesso"]==="10"){
                        $varEnabled="enabled";
                        $msgAcesso="";
                      }else              {
                        $varEnabled="disabled";
                        $msgAcesso="Acesso não permitido.";
                      }
                      ?>
                    <button name="BOT_CADASTRAR" id="BOT_CADASTRAR" type="submit" class="btn btn-primary" <?php echo $varEnabled; ?> ><?php echo $msgAcesso ;?> salvar </button>
                  </div>
                </div>
              </div>
            </div>
            <div class="w-100 text-right">
              <button class="btn btn-success">Novo Usuário</button>
            </div>
          </div>
        </div>

        <div id="l_LOGIN" class="layerLogin"></div>  
      </form>
    </main>

   <!--   </main>   /.container -->
   <script src="cadastroFicha.js"></script>
    </body>
</html> 