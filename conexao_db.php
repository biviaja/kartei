<?php
global $conexao, $url, $usuario, $senha, $banco;
    
  
  
//  $pdo = new PDO("mysql:host=HOST;dbname=BASE", "USUARIO", "SENHA"); 
// localhost:3306', 'kartei', 'ktARI#19', 'DBkartei

  
class Conexao {
  private $servidor='localhost';
  private $usuario='kartei';
  private $senha='ktARI#19';
  private $nomeBanco='dbkartei';
  private $banco;
 
  function __construct($servidor="localhost", $usuario="kartei", $senha="ktARI#19", $nomeBanco="dbkartei"){
      $this->setServidor($servidor);
      $this->SetUsuario($usuario);
      $this->SetSenha($senha);
      $this->SetNomeBanco($nomeBanco);
      $this->Conectar();  
  }

    public function SetServidor($servidor){
       $this->servidor = $servidor; 
    }
    public function GetServidor(){
        return $this->servidor;   
    }

    public function SetUsuario($usuario){
       $this->usuario=$usuario; 
    }
    public function GetUsuario(){
        return $this->usuario;   
    }

    public function SetSenha($senha){
       $this->senha=$senha; 
    }
    public function GetSenha(){
        return $this->senha;   
    }

    public function SetNomeBanco($nomeBanco){
       $this->nomeBanco=$nomeBanco; 
    }
    public function GetNomeBanco(){
        return $this->nomeBanco;   
    }


    public function Conectar(){
      $this->banco = new mysqli(
          $this->GetServidor(),
          $this->GetUsuario(),
          $this->GetSenha(),
          $this->GetNomeBanco()
      );
      if($this->banco->connect_error) {
          die('Erro de conexão('. $this->banco->connect_errno . '):'. $this->banco->connect_error. ' - PHP: ' . PHP_EOL);
          exit;
      }
    }    
    public function GetBanco(){
        return $this->banco;
    }

    public function Desconectar(){
        $this->banco->close();
    }
}

/*

    $conexao = mysqli_connect('66.33.203.11', 'kartei', 'ktARI#19', 'dbkartei'); // Produção
        // $conexao = mysqli_connect("mysql.cs2rio.com", "heritagehistory", "me22olatto", "hhdatabase"); // Site
        if (!$conexao ) {
            echo "Error: Connection with DB MySQL is fail." . PHP_EOL;
            echo "Debugging error: " . mysqli_connect_error() . PHP_EOL;
            exit;
        }
        else{
            //echo "Sucesso ao conectar-se com a base de dados DBUpload (MySQL).<br>" . PHP_EOL; 
        }
}
function fecha_conexao(){
    //fecha a conexão
       mysqli_close($conexao);
    
}
  */  
?>
