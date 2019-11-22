<?php
global $lang, $lang_index, $minha_url, $ini, $fim;
$nArq= count($_FILES['arquivos']['name']);
echo '<script> alert("Iniciando envio dos '.$nArq.' arquivos...");</script>';
// Pasta onde o arquivo vai ser salvo
//  echo "PRJ: ". $_GET['proj'] ."<br
//  
// Para verificar se um arquivo existe:
// if(file_exists("CAMINHO_QUE_VEM_DO_BD")) echo "O arquivo existe";
//    else echo "O arquivo nao existe";


//$proj = filter_input_array(INPUT_GET,'proj'); 

//$user_name=(string) filter_input_array(INPUT_POST,'user_name'); 
//$user_fname=(string) filter_input_array(INPUT_POST,'user_fname'); 
//$nome = $user_fname.", ".$user_name;
//$user_email=(string) filter_input_array(INPUT_POST,'user_email'); 
//$user_link=(string) filter_input_array(INPUT_POST,'user_link'); 
//$escolhas=(string) filter_input_array(INPUT_POST,'escolhas'); 
//$user_msg=(string) filter_input_array(INPUT_POST,'user_msg'); 


if(isset($_GET['proj'])){
    $proj=$_GET['proj'];
}
if(isset($_POST['user_name'])){
    $nome = $_POST['user_fname'].", ".$_POST['user_name'];
    $email = $_POST['user_email'];
    $link = $_POST['user_link'];
    $opcoes = $_POST['escolhas'];
    $mensagem = $_POST['user_msg'];
    
    echo "nome :". $nome. "<br>";
    echo "email :". $email. "<br>";
    echo "link :". $link. "<br>";
    echo "mensagem :". $mensagem. "<br>";
}
$_UP['pasta'] = 'P'.$proj.'/'; //C:/inetpub/wwwroot/PHP/_CHARLES/P'
echo ' Pasta: '.$_UP['pasta']."<br>";
// Read and write for owner, read for everybody else
chmod(_UP['pasta'], 0777);//0644


// Tamanho máximo do arquivo (em Bytes)
$_UP['tamanho'] = 1024 * 1024 * 2; // 2Mb
// Array com as extensões permitidas
$_UP['extensoes'] = array('jpg', 'JPG', 'png', 'PNG', 'gif', 'GIF', 'pdf', 'PDF');
// Renomeia o arquivo? (Se true, o arquivo será salvo como .jpg e um nome único)
$_UP['renomeia'] = false;

// Array com os tipos de erros de upload do PHP
$_UP['erros'][0] = 'Não houve erro';
$_UP['erros'][1] = 'O arquivo no upload é maior do que o limite do PHP';
$_UP['erros'][2] = 'O arquivo ultrapassa o limite de tamanho especifiado no HTML';
$_UP['erros'][3] = 'O upload do arquivo foi feito parcialmente';
$_UP['erros'][4] = 'Não foi feito o upload do arquivo';

//Loop com o número de arquivos

$i=0;
foreach ($_FILES['arquivos']['error'] as $key => $error)  //foreach ($_FILES['arquivos']['error'] as $key => $error)  //foreach ($_FILES['arquivo'] as $arqs) 
{
    $nome_final = $_POST['user_fname'].'_'. $_FILES['arquivos']['name'][$i];
    echo "__________________________________________________________________<br>"; 
    echo 'arquivo['.$i.']:   ' . $_FILES['arquivos']['name'][$i] . '<br>';
     echo 'nome novo['.$i.']: ' . $nome_final . '<br>';
     echo 'Tamanho['.$i.']:   ' . $_FILES['arquivos']['size'][$i]. '<br>';
//     $i++;
//}
//echo "---------------------------------------------------------<br>";
//for($i = 0; $i < count($_FILES['arquivos']); $i++) //sizeof($_FILES['arquivo'])
//{
//     $nome_final = $_POST['user_fname'].'_'. $_FILES['arquivos']['name'][$i];
     
//     echo 'arquivo:   ' . $_FILES['arquivos']['name'][$i] . '<br>';
//     echo 'nome novo: ' . $nome_final . '<br>';
//     echo 'Tamanho:   ' . $_FILES['arquivos']['size'][$i]. '<br>';

        //echo $files['name']; 

    //   echo 'arquivo:   ' . $_FILES['arquivos']['name'] . '<br>';
    // echo 'nome novo: ' . $nome_final . '<br>';
    // echo 'Tamanho:   ' . $_FILES['arquivo']['size'] '<br>';
    // echo 'Nome:      ' . $_POST['user_name']. '<br>';
    // echo 'Sobrenome: ' . $_POST['user_fname']. '<br>';
    // echo 'email:     ' . $_POST['user_email']. '<br>';
    // echo 'link:      ' . $_POST['user_link']. '<br>';
    // echo 'msg:       ' . $_POST['user_msg']. '<br>';
    // echo 'Pasta:     ' . $_UP['pasta']. '<br>';
     
    // Verifica se houve algum erro com o upload. Se sim, exibe a mensagem do erro
    if ($_FILES['arquivos']['error'][$i] != 0) {
      die("Não foi possível fazer o upload, erro:" . $_UP['erros'][$_FILES['arquivo']['error'][$i]]);
      exit; // Para a execução do script
    }
    // Caso script chegue a esse ponto, não houve erro com o upload e o PHP pode continuar
    // Faz a verificação da extensão do arquivo
    $extensao = strtolower(end(explode('.', $_FILES['arquivos']['name'][$i])));
    if (array_search($extensao, $_UP['extensoes']) === false) {
      echo "Por favor, envie arquivos APENAS com as seguintes extensões: gif, jpg, png ou pdf";
      exit;
    }
    // Faz a verificação do tamanho do arquivo
    if ($_UP['tamanho'] < $_FILES['arquivos']['size'][$i]) {
      echo "O arquivo enviado é muito grande, envie arquivos de até 2Mb.";
      exit;
    }
    // O arquivo passou em todas as verificações, hora de tentar movê-lo para a pasta
    // Primeiro verifica se deve trocar o nome do arquivo

    if ($_UP['renomeia'] == true) {
      // Cria um nome baseado no UNIX TIMESTAMP atual e com extensão .jpg
      $nome_final = $_POST['user_fname'].'_'.md5(time()).'.jpg';
    } else {
      // Mantém o nome original do arquivo
      $nome_final = $_POST['user_fname'].'_'. $nome_final;
      //echo 'nome_final:   ' . $nome_final . '<br>';
    }

    // Depois verifica se é possível mover o arquivo para a pasta escolhida
    if (move_uploaded_file($_FILES['arquivos']['tmp_name'][$i], $_UP['pasta'] . $nome_final)) {
      // Upload efetuado com sucesso, exibe uma mensagem e um link para o arquivo
      echo "Upload efetuado com sucesso!";
      echo '<a href="' . $_UP['pasta'] . $nome_final . '">Clique aqui para acessar o arquivo</a>';
      echo '<a href="http://localhost/PHP/_CHARLES"> <br><br>ou clique aqui para voltar para o site';
    } else {
      // Não foi possível fazer o upload, provavelmente a pasta está incorreta
      echo "Não foi possível enviar o arquivo, tente novamente. <br>";
    }
$i++;
}
 // envia e-mail
 
echo '<script> alert("Iniciando envio do e-mail...");</script>';

//$nome = $_POST['user_fname']+", "+$_POST['user_name'];
//$email = $_POST['user_email'];
//$link = $_POST['user_link'];
//$opcoes = $_POST['escolhas'];
//$mensagem = $_POST['user_msg']+" - link para a pasta dos arquivos" ;
$data_envio = date('dd/mm/Y');
$hora_envio = date('H:i:s');
// emails para quem será enviado o formulário
  $emailenviar = "charles@cs2rio.com";
  $destino = $emailenviar;
  $assunto = "Arquivo enviado pelo Site por "+$nome;

  // É necessário indicar que o formato do e-mail é html
  $headers  = 'MIME-Version: 1.0' . "\r\n";
      $headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
      $headers .= 'From: $nome <$email>';
  //$headers .= "Bcc: $EmailPadrao\r\n";
  
  $enviaremail = mail($destino, $assunto, $arquivo, $headers);
  if($enviaremail){
  $mgm = "Seu e-mail foi enviado com sucesso <br> O link será enviado para ". $email;
  //echo " <meta http-equiv='refresh' content='10;URL=contato.php'>";
  } else {
  $mgm = "ERRO AO ENVIAR E-MAIL!";
  echo "";
  }

?>