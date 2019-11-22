<?php
    // inicia a sessão
    !isset($_SESSION['ficha'])?session_start():null;
        $_SESSION['ficha']['fase']=0;//----------------------------------- 35
    
// coloca os valores na SESSION, se não for nulo
//        $_SESSION['ficha']['varMatricula']="";//------------------------ 01
//        $_SESSION['ficha']['varTipoFicha']="";//------------------------ 02
        $_SESSION['ficha']['varTituloPessoa']='';// ---------------------- 03
        $_SESSION['ficha']['varNome']='';// ------------------------------ 04
        $_SESSION['ficha']['varSobrenome']='';// ------------------------- 05
        $_SESSION['ficha']['varSobrenomeSolteira']='';// ----------------- 06
        $_SESSION['ficha']['varSexo']='';// ------------------------------ 07
        $_SESSION['ficha']['varDataNascimento']='';// -------------------- 08
        $_SESSION['ficha']['varIdade']='';// ----------------------------- 09
        $_SESSION['ficha']['varEstadoCivil']='';// ----------------------- 10
        $_SESSION['ficha']['varSobrenomeConjuge']='';// ------------------ 11
        $_SESSION['ficha']['varNomeConjuge']='';// ----------------------- 12
        $_SESSION['ficha']['varPai']='';// ------------------------------- 13
        $_SESSION['ficha']['varMae']='';// ------------------------------- 14
        $_SESSION['ficha']['varNacionalidade']='';// --------------------- 15
        $_SESSION['ficha']['varNaturalidade']='';// ---------------------- 16
        $_SESSION['ficha']['varIdentidade']='';// ------------------------ 17
        $_SESSION['ficha']['varExpedicao']='';// ------------------------- 18
        $_SESSION['ficha']['varProfissao']='';// --------------------------19
        $_SESSION['ficha']['varDataAceitacao']='';// --------------------- 20
        $_SESSION['ficha']['varTituloProponente1']='';// ----------------- 21
        $_SESSION['ficha']['varNomeProponente1']='';// ------------------- 22
        $_SESSION['ficha']['varSobrenomeProponente1']='';// -------------- 23
        $_SESSION['ficha']['varSexoProponente1']='';// ------------------- 24
        $_SESSION['ficha']['varTituloProponente2']='';// ----------------- 25
        $_SESSION['ficha']['varNomeProponente2']='';// ------------------- 26
        $_SESSION['ficha']['varSobrenomeProponente2']='';// -------------- 27
        $_SESSION['ficha']['varSexoProponente2']='';// ------------------- 28
        $_SESSION['ficha']['varDestino']='';// --------------------------- 29
        $_SESSION['ficha']['varDataFalecimento']='';// ------------------- 30
        $_SESSION['ficha']['varDiaFalecimento_Jud']='';// ---------------- 31
        $_SESSION['ficha']['varMesFalecimento_Jud']='';// ---------------- 32
        $_SESSION['ficha']['varAnoFalecimento_Jud']='';// ---------------- 33
        $_SESSION['ficha']['varObs']='';// ------------------------------- 34
        $_SESSION['ficha']['varFichaCompleta']='';// --------------------- 36
        $_SESSION['ficha']['varNumImagensFicha']='';// ------------------- 37
        $_SESSION['ficha']['varCadastrador']='';// ----------------------- 38
        $_SESSION['ficha']['varDataCadastro']='';// ---------------------- 39
        $_SESSION['ficha']['varHoraCadastro']='';// ---------------------- 40

     header("Location:cadastroFicha.php");
     //echo "<script>javascript:location.href='cadastroNovaFicha.php'</script>";
?>