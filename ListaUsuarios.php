<?php 
if(!isset($_SESSION)){
   //echo "vai para a página inicial<br>";//header("Location:index.php");
}   
    // inicia a sessão
    // < ?php !isset($_SESSION['usu'])?session_start():null; ? > 
     !isset($_SESSION['usu'])?session_start():null;
     //session_start();
     //session_name();
     //header('Content-Type: text/html; charset=utf-8');
     //$langLogin="po";
     ?>
    
    <?php include 'head.php'; ?>
    <!-- ?php include 'scripts.php'; ?> -->        
<body>
<?php include 'menu.php'; ?>
<?php include 'logout.php'; ?>
  <main role="main" class="container"> 
    <form id="FORM_Dados" name="FORM_Dados" method="post" action="alterarDadosPesquisador.php">
      <div class="collapse" id="infosPesquisador">
        <div class="d-flex align-items-end">
          <div class="col-5 px-0">
            <div class="card mb-0">
              <div class="card-body finalizado">
                <div class="form-group col-12 d-flex align-items-center">
                  <label class="col-auto pl-0">Seu e-mail:</label>
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
    <div id="ldados" class="LayerDados">
      <div class="col-12 px-0 mt-3">
        <a class="btn btn-success" href="cadastroUsuario.php">CADASTRAR NOVO pesquisador</a>
      </div>
      <div class="col-12 px-0 mt-4">
        <div class="card w-100">
          <div class="card-header bg-sem-img pl-2 border-0">Pesquisadores Cadastrados</div>
          <div class="card-body p-0 border-0">
            <table id="tab_FichasCompletasSemImagem" class="table table-striped table-sm">
              <thead>
                <tr>
                <th>Nome</th>
                <th>Login</th>
                <th>email</th>
                <th>Nível de acesso</th>
                <th>Fichas Completas</th>
                <th>Fichas Completas sem Imagem</th>
                <th>Fichas Incompletas</th>
                <th>Total</th>
                </tr>
              </thead>
              <tbody>
              <?php
              global $conexao,$sqlUsuarios,$sqlUsuarios,$dadosUsu,$rsDadosUsuarios;
              
              $numFC=0;
              $numFCSI=0;
              $numFI=0;
              $totFichas=0;
              if($_SESSION['usu']['nvAcesso']>=3){// Nível maior que 3 acessará as fichas sem imagem 
                    $sqlUsuarios="SELECT * FROM dbkartei.tab_usu WHERE NR_NvAcesso <=".$_SESSION['usu']['nvAcesso']." ORDER BY TX_Nome";
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
                    $sqlnumFC="SELECT TX_Cadastrador, Count(*) from dbkartei.tab_fichas WHERE BL_FichaCompleta=0 AND NR_ImagensFicha>0 group by TX_Cadastrador ";
                    $rsDadosUsuariosFC=mysqli_query($conexao, $sqlnumFC);
                 //   $sqlnumFCSI="SELECT TX_Cadastrador, Count(*) from dbkartei.tab_fichas WHERE BL_FichaCompleta=0 AND NR_ImagensFicha=0 group by TX_Cadastrador ";
                 //   $rsDadosUsuariosFCSI=mysqli_query($conexao, $sqlnumFCSI);
                 //   $sqlnumFI="SELECT TX_Cadastrador, Count(*) from dbkartei.tab_fichas WHERE BL_FichaCompleta=0 group by TX_Cadastrador ";
                 //   $sqlnumFI=mysqli_query($conexao, $sqlnumFI);
                    


                    $rsDadosUsuarios=mysqli_query($conexao, $sqlUsuarios);
                    //$numLinhas=mysqli_num_rows($rsDadosUsuarios); // OK
                    //echo "Linhas: ". $numLinhas ."<br/>"; // OK
                    while($dadosUsu=mysqli_fetch_assoc($rsDadosUsuarios)) // ================================= WHILE pata varrer SELECT
                    {
                        $nomeUsu=$dadosUsu['TX_Nome']." ".$dadosUsu['TX_Sobrenome'];
                        $loginUsu=$dadosUsu['TX_Login'];
                        $emailUsu=$dadosUsu['TX_Email'];
                        $nivelUsu=intval($dadosUsu['NR_NvAcesso']);
                        switch($nivelUsu){
                            case 10: $descNivelUsu="Administrador";break;
                            case 3: $descNivelUsu="Revisor";break;
                            case 1: $descNivelUsu="Pesquisador";break;
                        }
                        //if($nomeUsu===$rsDadosUsuariosFC[0]){$numFC=$rsDadosUsuariosFC[1];}
                        //if($nomeUsu===$rsDadosUsuariosFCSI[0]){$numFCSC=$rsDadosUsuariosFCSI[1];}
                        //if($nomeUsu===$rsDadosUsuariosFI[0]){$numFI=$rsDadosUsuariosFI[1];}
                        
                    //============================================================================================
                    //$sqlnumFC="SELECT TX_Cadastrador, Count(*) as count from dbkartei.tab_fichas WHERE BL_FichaCompleta=0 AND NR_ImagensFicha>0 group by TX_Cadastrador ";
                    //$rsDadosUsuariosFC=mysqli_query($conexao, $sqlnumFC);
                    //$resultadoCount = null;
                    //if (mysqli_num_rows($rsDadosUsuariosFC) > 0 {
                    //    $resultado = $rsDadosUsuariosFC->mysqli_fetch_assoc();
                    //    $resultadoCount = $resultado['count'];
                    //}
                    //============================================================================================                        
                    // Pesquisa as fichas de cada usuário
                    $sqlFichasCompletas="SELECT Count(*) as numFC from dbkartei.tab_fichas WHERE TX_Cadastrador ='".$loginUsu; 
                    $sqlFichasCompletas.="' AND BL_FichaCompleta=1";
                    //echo "sqlFichasCompletas: ".$sqlFichasCompletas."<br/>";
                    $rsDadosFC=mysqli_query($conexao, $sqlFichasCompletas);
                    $numFC=mysqli_fetch_assoc($rsDadosFC);
                    $numeroFC=$numFC['numFC'];
                        //echo "numFC: ".$numeroFC." <===============<br/>";

                    
                    //$sqlFichasCompletasSemImagem="SELECT Count(*) from dbkartei.tab_fichas TX_Login WHERE TX_Cadastrador ='".$loginUsu; 
                    //$sqlFichasCompletasSemImagem.="' AND BL_FichaCompleta=1 AND NR_ImagensFicha=0";
                    //echo "sqlFichasCompletasSI: ".$sqlFichasCompletasSemImagem."<br/>";
                    //$rsDadosFCSI=mysqli_query($conexao, $sqlFichasCompletasSemImagem);
                    //$numFCSI=mysqli_fetch_assoc($rsDadosFCSI);
                    //$sqlFichasIncompletas="SELECT Count(*) from dbkartei.tab_fichas TX_Login WHERE TX_Cadastrador ='".$loginUsu; 
                    //$sqlFichasIncompletas.="' AND BL_FichaCompleta=0";
                    //echo "sqlFichasIncompletas: ".$sqlFichasIncompletas."<br/>";
                    //$rsDadosFI=mysqli_query($conexao, $sqlFichasIncompletas);
                    //$numFI=mysqli_fetch_assoc($rsDadosFI);
                    $totFichas=intval($numFC)+intval($numFCSI)+intval($numFI);

                    echo "<tr>";
                    echo "  <td><a href='#' onclick='abreCadastroDoUsuario(".$loginUsu.");'>".$nomeUsu."</a></td>";
                    echo "  <td><a href='#' onclick='abreCadastroDoUsuario(".$loginUsu.");'>".$loginUsu."</a></td>";
                    echo "  <td><a href='#' onclick='abreCadastroDoUsuario(".$loginUsu.");'>".$emailUsu."</a></td>";
                    echo "  <td><a href='#' onclick='abreCadastroDoUsuario(".$loginUsu.");'>".$descNivelUsu."</a></td>";
                    echo "  <td><a href='#' onclick='abreCadastroDoUsuario(".$loginUsu.");'>".$numeroFC."</td>";//$numFC
                    echo "  <td><a href='#' onclick='abreCadastroDoUsuario(".$loginUsu.");'>".$numFCSI."</td>";//$numFCSI
                    echo "  <td><a href='#' onclick='abreCadastroDoUsuario(".$loginUsu.");'>".$numFI."</td>";//$numFI
                    echo "  <td><a href='#' onclick='abreCadastroDoUsuario(".$loginUsu.");'>".$totFichas."</td>";//$totFichas
                    echo "</tr>";
                    }          
                mysqli_close($conexao);
                }
              }  
              ?>  
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </main> 

    <script src="login.js"></script>

    <script>
       function abreCadastroDoUsuario(login){

           $.ajax({
             url: 'cadastroDoUsuario.php',
             type: 'post',
             dataType: 'html', // json', //'html'
             async: true,
             data: {
                 varLogin: login 
             },
             success: function(resposta){window.alert("Resposta:"+ resposta);}
         });
       }
   </script>   
</body>
</html>