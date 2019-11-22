<?php include 'head.php'; ?>
  <body>
    <?php include 'menu.php'; ?>
    <?php include 'topoHomePesquisador.php'; ?>
      
    <?php 
    //    if(!isset($_SESSION['usu']['chkLogin']){?$_SESSION['usu']['chkLogin']="NOK": $_SESSION['usu']['chkLogin']; ?>  
      
    <div id="layerMsgCadastro" class="msgCadastro">
          <?php 
            //echo "ChkLogin: " . $_SESSION['usu']['chkLogin'] . " - Nv Acesso: ". $_SESSION['usu']['nvAcesso']; 
            !isset($_SESSION['usu']['msgInsert'])?null: $_SESSION['usu']['msgInsert'];
          ?>
    </div> 
    <main role="main" class="container"> 
        <form id="FORM_Dados" name="FORM_Dados" method="post" action="alterarDadosPesquisador.php">
            <div class="collapse" id="infosPesquisador">
              <div class="d-flex align-items-end">
                <div class="col-5 px-0">
                  <div class="card mb-0">
                    <div class="card-body finalizado">
                      <div class="form-group col-12 d-flex align-items-center">
                        <label class="col-auto pl-0">Seu email:</label>
                        <input name="TX_EMAIL_box" id="TX_EMAIL_box"  type="text" class="form-control" value="<?php echo $_SESSION['usu']['varEmail']; ?>">
                      </div>
                      <div class="form-group col-12 d-flex align-items-center">
                        <label class="col-auto pl-0">Seu Tel:</label>
                        <input name="TX_TEL_box" id="TX_TEL_box" type="text" class="form-control" value="<?php echo $_SESSION['usu']['varTel']; ?>">
                      </div>
                      <div class="form-group col-12 d-flex align-items-center">
                        <label class="col-auto pl-0">Seu Cel/WhatsApp:</label>
                        <input name="TX_CEL_box" id="TX_CEL_box" type="text" class="form-control" value="<?php echo $_SESSION['usu']['varCel']; ?>">
                      </div>
                      <div class="text-right col">
                        <button type="submit" class="btn btn-primary btn-sm">Salvar</button>

                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
      </form>
      <form action="cadastrarUsuario.php" method="post">
        <div class="row mt-3">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h4 class="col-12 pl-0">Cadastrar pesquisador</h4></div>  
              <div class="card-body px-3">
                <div class="row">
                  <div class="form-group col-4">
                    <label for="NoexampleInputEmail1">Nome</label>
                    <input name="TX_NOME" type="text" class="form-control" id="TX_NOME" aria-describedby="emailHelp">
                  </div>
                  <div class="form-group col-8">
                    <label for="NoexampleInputEmail1">Sobrenome</label>
                    <input name="TX_SOBRENOME"  type="text" class="form-control" id="TX_SOBRENOME" aria-describedby="emailHelp">
                  </div>
                  <div class="form-group col-4"> 
                    <label for="NoexampleInputEmail1">Nível de Acesso</label>
                    <Select name="TX_NVACESSO"  class="form-control" id="TX_NVACESSO">
                        <option value="1"> 1 - Pesquisador</option>
                        <option value="3"> 3 - Pesquisador Master</option>
                        <option value="5"> 5 - Pesquisador Secretário</option>
                        <option value="10">10 - Administrador</option>                  
                    </select>
                  </div>
                  <div class="form-group col-8 d-flex align-items-end">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="TX_SEXO" id="masc" value="M">
                      <label class="form-check-label" for="masc">Masculino</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="TX_SEXO" id="fem" value="F" >
                      <label class="form-check-label" for="fem">Feminino</label>
                    </div>
                  </div>
                 
                  <div class="form-group col-4">
                    <label for="NoexampleInputEmail1">Email</label>
                    <input name="TX_EMAIL"  type="email" class="form-control" id="TX_EMAIL" aria-describedby="emailHelp">
                  </div>
                  <div class="form-group col-4">
                    <label for="NoexampleInputEmail1">Telefone</label>
                    <input name="TX_TEL"  type="text" class="form-control" id="TX_TEL" aria-describedby="emailHelp">
                  </div>
                  <div class="form-group col-4">
                    <label for="NoexampleInputEmail1">Celular/WhatsApp</label>
                    <input name="TX_CEL"  type="text" class="form-control" id="TX_CEL" aria-describedby="emailHelp">
                  </div>
                  <div class="form-group col-4">
                    <label for="NoexampleInputEmail1">Login</label>
                    <input name="TX_LOGIN"  type="text" class="form-control" id="TX_LOGIN" aria-describedby="emailHelp">
                  </div>
                  <div class="form-group col-4">
                    <label for="exampleInputPassword1">Senha</label>
                    <input name="TX_SENHA" type="password" class="form-control" id="TX_SENHA">
                  </div>
                  <div class="form-group col-4">
                    <label for="NoexampleInputEmail1">Confirmação de Senha</label>
                    <input name="TX_CONFSENHA"  type="password" class="form-control" id="TX_CONFSENHA">
                  </div> 
                  <div class="form-group col-12 text-right mb-0">
                      <?php 
                      $_SESSION['usu']['chkLogin']="OK";
                      $_SESSION['usu']["nvAcesso"]="10";
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
<?php 
// inicia a sessão
// < ?php !isset($_SESSION)?session_start():null; ? > 
 //!isset($_SESSION)?session_start():null;
 //session_start();
 //session_name();


 //echo " session_name(): ". session_name()."<br/>";
 //echo " session_id(): ". session_id()."<br/>";

 //echo "lPC: 0- Check: Session_status: ". session_status()."<br/>";
 //echo "lPC: 0 chkLogin: " . $chkLogin ." - SESSION['usu']['chkLogin']: " . $_SESSION['usu']['chkLogin'] . ". <br/>";
 //echo "lPC: 0 msgLogin: " . $msgLogin ." - SESSION['usu']['msgLogin']: " . $_SESSION['usu']['msgLogin'] . ". <br/>";
 //echo "lPC: 0 varLogin: " . $varLogin ." - SESSION['usu']['varLogin']: " . $_SESSION['usu']['varLogin'] . ". <br/>";
 //echo "_________________________________________________________________________________________________________________________________ <br/>"

 ?>    
    <script src="login.js"></script>
    </body>
</html> 