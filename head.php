<?php
    // inicia a sessão
    //  <?php !isset($_SESSION['ficha'])?session_start():null; ? > 
     !isset($_SESSION)?session_start():null;
    // session_start();
    // session_name();
     //echo "Sessiom fase: ". $_SESSION['ficha']['fase']."...<br>";
?>
<!DOCTYPE html>
<html lang="pt-BR">
    <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <meta property="og:url"           content="http://www.heritageandhistory.ch/" />
    <meta property="og:type"          content="website" />
    <meta property="og:title"         content="Heritage and History" />
    <meta property="og:description"   content="H&amp;H researches the cultural, scientific and economic contribution of German-Jewish immigrants to the Brazilian society. | H&amp;H möchte den kulturellen, wissenschaftlichen und wirtschaftlichen Beitrag der deutsch-jüdischen Einwanderer für die brasilianische Gesellschaft herausarbeiten. | H&amp;H pretende pesquisar a contribuição cultural, científica e econômica dos imigrantes judeus-alemães na sociedade brasileira." />
    <meta property="og:image"         content="http://www.heritageandhistory.ch/img/og_image.jpg" />

    <link rel="icon" href="favicon.ico">

    <title>Heritage History</title>

    <!-- Bootstrap -->
    <!-- Latest compiled and minified CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <script src="https://kit.fontawesome.com/5120b5b257.js" crossorigin="anonymous"></script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,300i,400,400i,600,600i,700,700i" rel="stylesheet">
    <link href="css/heritagesystem.css" rel="stylesheet">
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script> -->
    <script src="jquery-3.4.1.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>

  </head>