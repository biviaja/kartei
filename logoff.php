<html><head><?php 
    if(isset($_SESSION['logado'])){
       session_destroy();
       echo "APAPOHA!";
       
    }
?>
    <script> window.location.href = 'index.php';</script>
    </head>
    <body>APAPOHA</body>
</html>