/* 
Script para cadastroFicha by LH.
*/
var fase=0;
    function salvar(fase){
    //    window.alert("Salvar fase:"+fase);
        switch (fase){
            case "0":
                verificaFase0();break;// Fase 0: matrícula e tipo ficha
            case "1":
                verificaFase1();break;// Nome, sobrenome etc
            case "2":
                verificaFase2();break;//Nacionalidade    3- Filhos; 4 PROPONENTES
            case "5":
                verificaFase5();break; 
            case "6":
                verificaFase6();break;
            default:
                return; break;
        } //end switch
    }// end function salvarFase

function verificaFase0(){ //________________________________________________________________________________________ FASE 0

    verifMatricula=false;
    verificaTipoFicha=false;
    Matricula=document.getElementById("TX_MATRICULA_DIG").value;

        tamMatricula=Matricula.length;

    tipoFichaPropria=document.getElementById("fichaPropria").checked; 
    tipoFichaSegundoUsu=document.getElementById("fichaSegundoUsu").checked; 

    msgeT="O tipo da ficha não foi selecionado. Por favor, selecione.";
        if(tipoFichaPropria){
           varTpFicha= "Ficha Propria";
            verificaTipoFicha=true;
            msgeT="";
        }else{
            if(tipoFichaSegundoUsu){
           varTpFicha= "Ficha Segundo Usuário (herdeiro, viúvo/a…";
            verificaTipoFicha=true;
            msgeT="";
            }
        }
    msge=msgeT;
    matricula=$('#TX_MATRICULA').val();
    matricula=matricula.toLowerCase();
    if(verificaTipoFicha){
        document.getElementById("divErroTipoFicha").innerHTML="";

            $.ajax({
                url: 'salvarFase0.php',
                type: 'post',
                dataType: 'html', // json', //'html'
                async: true,
                data: {
                    varMatricula:matricula, // $('# TX_MATRICULA').val(),
                    varTipoFicha: varTpFicha
                 },
                success: function(resposta){
                    if(parseInt(resposta)===0){
                        document.getElementById("divErroMatricula").innerHTML="Já existe uma ficha com esta matrícula. Verifique o número.";
                    }else{
                        document.getElementById("divErroMatricula").innerHTML="";
                        //Funçao avançar carousel
                        $('#carrossel-passos').carousel('next');
                    }
                }
            });
            //location.reload();
               varMat_Tipo="<h4 class='col-12 px-0'>Matrícula: "+matricula+"</h4>";
               document.getElementById("matriculaFase2").innerHTML=varMat_Tipo;
    }else{ //anuncia erro tipo ficha
        document.getElementById("divErroTipoFicha").innerHTML=msgeT;
    }
    return; // data;
}
// ------------------------------------------------------------------------------------------------------------------FIM FASE 0
function verificaFase1(){ //________________________________________________________________________________________ FASE 1
    erro="";
    msge="";
    verificaSobrenome=false;
    verificaNome=false;
    varNome=document.getElementById("TX_NOME").value;
    varSobrenome=document.getElementById("TX_SOBRENOME").value;
    matricula=$('#TX_MATRICULA').val();
            if(varNome!==""){
                verificaNome=true;
            }else{
                erro="1";
            }
            if(varSobrenome!==""){
                verificaSobrenome=true;
            }else{
                erro=erro+"2";
            }

            if(erro==="1"){
            msge="O campo nome encontra-se vazio. Por vavor, preencha-o.";
            }
            if(erro==="2"){
            msge="O campo sobrenome encontra-se vazio. Por vavor, preencha-o.";
            }
            if(erro==="12"){
            msge="O campo nome e o campo sobrenome encontram-se vazios. Por vavor, preencha-os.";
            }

        varSexoFicha= getRadioValor('TX_SEXO');
        varEstadoCivilFicha= getRadioValor('TX_ESTADOCIVIL');

        var comboDia = document.getElementById("TX_DIANASCIMENTO");
        var comboMes = document.getElementById("TX_MESNASCIMENTO");
        var comboAno = document.getElementById("TX_ANONASCIMENTO");

        varDia=parseInt(comboDia.options[comboDia.selectedIndex].value, 10);
        varMes=parseInt(comboMes.options[comboMes.selectedIndex].value, 10);
        varAno=parseInt(comboAno.options[comboAno.selectedIndex].value, 10);

        varDataNascimentoFicha=varAno+"/"+varMes+"/"+varDia;
        varIdadeFicha=document.getElementById("TX_IDADE").value;

        varSobrenomeSolteiraFicha=document.getElementById("TX_SOBRENOMESOLTEIRAFICHA").value;

        varNomeConjugeFicha=document.getElementById("TX_NOMECONJUGE").value;
        varSobrenomeConjugeFicha=document.getElementById("TX_SOBRENOMECONJUGE").value;
        varSobrenomeSolteiraConjuge=document.getElementById("TX_SOBRENOMESOLTEIRACONJUGE").value;
        varPai="";
        varMae="";
        varObs=document.getElementById("Obs1").value;
        varTituloPessoa=document.getElementById("TX_TITULOPESSOA").value;
        if(verificaNome && verificaSobrenome){
            msge="";
                $.ajax({
                    url: 'salvarFase1.php',
                    type: 'post',
                    dataType: 'html', // json', //'html'
                    async: true,
                    data: {
                        varTituloPessoa: varTituloPessoa, //$('#TX_TITULOPESSOA').val(),
                        varSobrenome: varSobrenome, //$('#TX_SOBRENOME').val(),
                        varNome: varNome, //$('#TX_NOME').val(),
                        varSexo: varSexoFicha,
                        varDataNascimento: varDataNascimentoFicha,
                        varIdade:varIdadeFicha,
                        varEstadoCivil: varEstadoCivilFicha,
                        varSobrenomeSolteiraFicha: varSobrenomeSolteiraFicha,
                        varNomeConjuge: varNomeConjugeFicha,
                        varSobrenomeSolteira: varSobrenomeSolteiraFicha,
                        varSobrenomeSolteiraConjuge: varSobrenomeSolteiraConjuge,
                        varPai:varPai,
                        varMae:varMae,
                        varObs: varObs
                    },
                    success: function(resposta){
                        if(parseInt(resposta)===1){
                                document.getElementById("divErroTipoFicha").innerHTML=msge;
                        }
                        else{
                            varMat_Nome="<h4 class='col-12 px-0'>Matrícula: "+matricula+"<span class='col float-right'>"+varTituloPessoa+" "+varNome+" "+varSobrenome+"</span></h4>";
                            document.getElementById("matriculaFase3").innerHTML=varMat_Nome;
                            document.getElementById("matriculaFase4").innerHTML=varMat_Nome;
                            document.getElementById("matriculaFase5").innerHTML=varMat_Nome;
                            document.getElementById("matriculaFase6").innerHTML=varMat_Nome;
                            document.getElementById("matriculaFase7").innerHTML=varMat_Nome;
                            //Funçao avançar carousel
                               $('#carrossel-passos').carousel('next');
                        }
                    }
                });
                // Atualiza as Obs nas fases
                atualizaObs(varObs);
        }
        return;
}
//-------------------------------------------------------------------------------------------------------------------FIM FASE 1
function verificaFase2(){ //________________________________________________________________________________________ FASE 2
    varObs=document.getElementById('Obs2').value;
    // Atualiza as Obs nas fases
                atualizaObs(varObs); 

                $.ajax({
                    url: 'salvarFase2.php',
                    type: 'post',
                    dataType: 'html', // json', //'html'
                    async: true,
                    data: {
                        //'varFase': $('#formFase1').val(),
                        varNacionalidade: $('#TX_NACIONALIDADE').val(),
                        varNaturalidade: $('#TX_NATURALIDADE').val(),
                        varProfissao: $('#TX_PROFISSAO').val(),
                        varIdentidade: $('#TX_IDENTIDADE').val(),
                        varExpedicao:$('#TX_EXPEDICAO').val(),
                        varObs:$('#Obs2').val()
                    },
                    success: function(resposta){//alert("Resposta:"+resposta);
                    }
                });
                //Funçao avançar carousel
               $('#carrossel-passos').carousel('next');
        return;
}
//-------------------------------------------------------------------------------------------------------------------FIM FASE 2

function novoFilho(){ //________________________________________________________________________________________ FASE 3 INSERIR
 }
//-------------------------------------------------------------------------------------------------------------------FIM FASE 3 INSERIR
function salvarFilhos(){ //_____________________________________________________________________________________________ FASE 3 SALVAR
     
     // Atualiza as Obs nas fases
     varObs=document.getElementById("Obs3").value;
     atualizaObs(varObs); // aqui precisa salvar também, por enquanto está só passando para os demais campos
     //Funçao avançar carousel
     $('#carrossel-passos').carousel('next');
}
//-------------------------------------------------------------------------------------------------------------------FIM FASE 3 SALVAR
function salvarProponente(){ //_____________________________________________________________________________ FASE 5 SALVAR PROPONENTES
    //inserirProponente();
    varFase=fase;

    varSexoProponente1= getRadioValor('TX_SexoProponente1A');
    if(document.getElementById('TX_NomeProponente1').value===""){
        varTituloProponente=document.getElementById("TX_TituloProponente1A").value;
        varNomeProponente=document.getElementById("TX_NomeProponente1A").value;
        varSobrenomeProponente=document.getElementById("TX_SobrenomeProponente1A").value;
    }
    else{
        varTituloProponente=document.getElementById("TX_TituloProponente1").value;
        varNomeProponente=document.getElementById("TX_NomeProponente1").value;
        varSobrenomeProponente=document.getElementById("TX_SobrenomeProponente1").value;
        if(varSexoProponente1==="M"){
            document.getElementById("mascProponente1").checked=true;
            document.getElementById("femProponente1").checked=false;
        }
        if(varSexoProponente1==="F"){
            document.getElementById("mascProponente1").checked=false;
            document.getElementById("femProponente1").checked=true;
        }
    }

    varTituloProponente2=document.getElementById("TX_TituloProponente2").value;
    varNomeProponente2=document.getElementById("TX_NomeProponente2").value;
    varSobrenomeProponente2=document.getElementById("TX_SobrenomeProponente2").value;
    varSexoProponente2= getRadioValor('TX_SexoProponente2');

    var comboDia = document.getElementById("TX_DIAACEITACAO");
    var comboMes = document.getElementById("TX_MESACEITACAO");
    var comboAno = document.getElementById("TX_ANOACEITACAO");

    varDia=parseInt(comboDia.options[comboDia.selectedIndex].value, 10);
    varMes=parseInt(comboMes.options[comboMes.selectedIndex].value, 10);
    varAno=parseInt(comboAno.options[comboAno.selectedIndex].value, 10);

    varDataAceitacao=varAno+"/"+varMes+"/"+varDia;
    varObs=document.getElementById("Obs4").value;

         $.ajax({
             url: 'salvarFase4.php',
             type: 'post',
             dataType: 'html', // json', //'html'
             async: true,
             data: {
                 varDataAceitacao:varDataAceitacao,
                 varTituloProponente1: varTituloProponente, //$('#TX_TituloProponente1').val(),
                 varNomeProponente1: varNomeProponente, //$('#TX_NomeProponente1').val(),
                 varSobrenomeProponente1: varSobrenomeProponente, // $('#TX_SobrenomeProponente1').val(),
                 varSexoProponente1:varSexoProponente1,
                 varTituloProponente2: varTituloProponente2, //$('#TX_TituloProponente2').val(),
                 varNomeProponente2: varNomeProponente2, //$('#TX_NomeProponente2').val(),
                 varSobrenomeProponente2: varSobrenomeProponente2, // $('#TX_SobrenomeProponente2').val(),
                 varSexoProponente2:varSexoProponente2,
                 varObs: varObs
             },
             success: function(resposta){
                // window.alert("Resposta:"+ resposta);
             }
         });
        // Atualiza as Obs nas fases
        atualizaObs(varObs);
        //window.location.href="cadastroFicha.php?mat="+matricula+"&fase=5";
        //Funçao avançar carousel
        $('#carrossel-passos').carousel('next');
    }
//-------------------------------------------------------------------------------------------- FIM FASE 4 SALVAR PROPONENTE
function verificaFase5(){ //______________________________________________________________________________ FASE 5 - DESTINO
        varDestino= getRadioValor('radiosDestino');

        var comboDia = document.getElementById("TX_DIAFALECIMENTO");
        var comboMes = document.getElementById("TX_MESFALECIMENTO");
        var comboAno = document.getElementById("TX_ANOFALECIMENTO");

        varDia=parseInt(comboDia.options[comboDia.selectedIndex].value, 10);
        varMes=parseInt(comboMes.options[comboMes.selectedIndex].value, 10);
        varAno=parseInt(comboAno.options[comboAno.selectedIndex].value, 10);
        varDataFalecimento=varAno+"/"+varMes+"/"+varDia;

        var comboDiaJud = document.getElementById("TX_DIAFALECIMENTOJUD");
        var comboMesJud = document.getElementById("TX_MESFALECIMENTOJUD");
        var comboAnoJud = document.getElementById("TX_ANOFALECIMENTOJUD");
        varDiaFalecimentoJud=comboDiaJud.options[comboDiaJud.selectedIndex].value;
        varMesFalecimentoJud=comboMesJud.options[comboMesJud.selectedIndex].value;
        varAnoFalecimentoJud=comboAnoJud.options[comboAnoJud.selectedIndex].value;

        varObs=document.getElementById("Obs5").value;
     // Atualiza as Obs nas fases
        atualizaObs(varObs);  

                    $.ajax({
                        url: 'salvarFase5.php',
                        type: 'post',
                        dataType: 'html', // json', //'html'
                        async: true,
                        data: {
                            varDestino: varDestino,
                            varDataFalecimento: varDataFalecimento,
                            varDiaFalecimentoJud:varDiaFalecimentoJud,
                            varMesFalecimentoJud: varMesFalecimentoJud,
                            varAnoFalecimentoJud: varAnoFalecimentoJud,
                            varObs: varObs
                        },
                        success: function(resposta){
                            //window.alert("Resposta:"+resposta);
                        }
                    });
                    //Funçao avançar carousel
                    $('#carrossel-passos').carousel('next');
                    location.reload();

}
//-----------------------------------------------------------------------------------------------------------FIM FASE 5 - DESTINO
function verificaFase6(){ //________________________________________________________________________________________ FASE FINAL 6
  
   $.ajax({
                    url: 'salvarFase6.php',
                    type: 'post',
                    dataType: 'html', // json', //'html'
                    async: true,
                    data: 
                    $("#FORM_Fichas").serialize(),
                    success: function(resposta){
                       // window.alert("Resposta:"+resposta);
                        if(parseInt(resposta)===1){
                                document.getElementById("divErroTipoFicha").innerHTML=msge;
                        }
                        else{
                            //Funçao Modal
                               $('#modalFinal').modal('show');
                        }
                    }
                });
}
/*
// ##################################################################################################################################
SÓ ATUALIZAR APÒS CONCLUIR EDIÇÃO DESTA FUNÇÃO 
+++++++++++++++++++++++++++++++++++++++++++++++

PEGAR OS NOMES DOS CAMPOS
Os que não tiverem id ou name, colocar e atualizar na cadastroFicha.php 

    id="TX_TITULOPESSOA_final"
    <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varNome']; ?>">
    <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varSobrenome']; ?>">
    <label for="">do sexo</label>
    <input class="form-check-input" type="radio" name="TX_SEXO_Final" id="masc_Final" value="M" onclick="mascFem('M');" <?php if($_SESSION['ficha']['varSexo']==="M"){ echo "checked";} ?>>
    <label class="form-check-label" for="masc">Masculino</label>
    <input class="form-check-input" type="radio" name="TX_SEXO_Final" id="fem_Final" value="F" onclick="mascFem('F');" <?php if($_SESSION['ficha']['varSexo']==="F"){ echo "checked";} ?>>
    <label class="form-check-label" for="fem">Feminino</label>
    <input class="form-check-input" type="radio" name="dataIdade_Final" id="dataNascRadio_Final" value="option2" <?php if($_SESSION['ficha']['varDataNascimento']!==""){ echo "checked";} ?> onClick="verificaNascIdade('dt');">
    <label for="dataNascRadio">nascid<span class="vogalSexo">o</span> em </label>
    <select class="form-control" id="TX_DIANASCIMENTO_Final" name="TX_DIANASCIMENTO_Final" onClick="verificaNascIdade('dt');">
    <select class="form-control" id="TX_MESNASCIMENTO_Final" name="TX_MESNASCIMENTO_Final">
    <select class="form-control" id="TX_ANONASCIMENTO_Final" name="TX_ANONASCIMENTO_Final" style="width:90px;">
    <input class="form-check-input" type="radio" name="dataIdade_Final" id="idaderadio_Final" value="option2" onClick="verificaNascIdade('id');" <?php if($_SESSION['ficha']['varIdade']!==""){ echo "checked";} ?>>
    <label for="idaderadio">Idade:</label>
    <input type="text" style="width:80px" class="form-control" id="TX_IDADE_Final" name="TX_IDADE_Final" onClick="verificaNascIdade('id');" value="<?php echo $_SESSION['ficha']['varIdade']; ?>">
    <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varNacionalidade']; ?>">
    <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varNaturalidade']; ?>">
    <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varNomeConjuge']; ?>">
    <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varSobrenomeConjuge']; ?>">
    <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varSobrenomeSolteira']; ?>">
    <input type='text' class='d-none' id='id_NOMEFILHO".$nff."' value='".$idFilho[$nff]."'>
    <input type='text' class='form-control' name='TX_NOMEFILHO".$nff."' id='TX_NOMEFILHO".$nff."' value='".$nmFilho[$nff]."'>
    <select class='form-control' id='diaNasc".$nff."'>
    <select class='form-control' id='TX_MESNASCIMENTO".$nff."' name='TX_MESNASCIMENTO".$nff."'>
    <select class='form-control' id='TX_ANONASCIMENTO".$nff."' name='TX_ANONASCIMENTO".$nff."'>
    <input class='form-check-input' type='radio' name='TX_ESCOLHECONJUGE' id='TX_ESCOLHECONJUGE' value='C1'>
    <input class='form-check-input' type='radio' name='TX_ESCOLHECONJUGE' id='TX_ESCOLHECONJUGE' value='C2'>
    <label class='form-check-label' for='divorc'>Beltrano de Tal</label>
    <input class='form-check-input' type='radio' name='TX_ESCOLHECONJUGE' id='TX_ESCOLHECONJUGE' value='C3'>
    <input class='form-check-input' type='radio' name='TX_ESCOLHECONJUGE' id='TX_ESCOLHECONJUGE' value='C3'>
    <input type='text' class='form-control' id='TX_NOMEFILHO".$nff."' value='".$nmFilho[$nff]."'>
    <select class='form-control' id='diaNasc'>
    <select class='form-control' id='TX_MESNASCIMENTO' name='TX_MESNASCIMENTO'>
    <select class='form-control' id='TX_ANONASCIMENTO' name='TX_ANONASCIMENTO'>
    <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varProfissao']; ?>">
    <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varIdentidade']; ?>">
    <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varExpedicao']; ?>">
    <select class="form-control" id="TX_DIAACEITACAO_Final" name="TX_DIAACEITACAO_Final">
    <select class="form-control" id="TX_MESACEITACAO_Final" name="TX_MESACEITACAO_Final">
    <select class="form-control" id="TX_ANOACEITACAO_Final" name="TX_ANOACEITACAO_Final" style="width:90px;">
    <input type="text" class="form-control" style="width:50px" value="<?php echo $_SESSION['ficha']['varTituloProponente1']; ?>">
    <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varNomeProponente1']; ?>">
    <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varSobrenomeProponente1']; ?>">
    <input type="text" class="form-control" style="width:50px" value="<?php echo $_SESSION['ficha']['varTituloProponente2']; ?>">
    <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varNomeProponente2']; ?>">
    <input type="text" class="form-control" value="<?php echo $_SESSION['ficha']['varSobrenomeProponente2']; ?>">
    <select class="form-control" id="TX_DESTINO_FINAL" name="TX_DESTINO_FINAL">
    <select class="form-control" id="TX_DIAFALECIMENTO_Final" name="TX_DIAFALECIMENTO_Final">
    <select class="form-control" id="TX_MESFALECIMENTO_Final" name="TX_MESFALECIMENTO_Final" style="width:100px">
    <select class="form-control" id="TX_ANOFALECIMENTO_Final" name="TX_ANOFALECIMENTO_Final" style="width:90px;">
    <select class="form-control" id="TX_DIAFALECIMENTOJUD_Final" name="TX_DIAFALECIMENTOJUD_Final">
    <select class="form-control" id="TX_MESFALECIMENTOJUD_Final" name="TX_MESFALECIMENTOJUD_Final" style="width:100px">
    <select class="form-control" id="TX_ANOFALECIMENTOJUD_Final" name="TX_ANOFALECIMENTOJUD_Final" style="width:90px;">


// ##################################################################################################################################


        varDestino= getRadioValor('radiosDestino_Final');

        var comboDia = document.getElementById("TX_DIAFALECIMENTO");
        var comboMes = document.getElementById("TX_MESFALECIMENTO");
        var comboAno = document.getElementById("TX_ANOFALECIMENTO");

        varDia=parseInt(comboDia.options[comboDia.selectedIndex].value, 10);
        varMes=parseInt(comboMes.options[comboMes.selectedIndex].value, 10);
        varAno=parseInt(comboAno.options[comboAno.selectedIndex].value, 10);

        varDataFalecimento=varAno+"/"+varMes+"/"+varDia;

        var comboDiaJud = document.getElementById("TX_DIAFALECIMENTOJUD");
        var comboMesJud = document.getElementById("TX_MESFALECIMENTOJUD");
        var comboAnoJud = document.getElementById("TX_ANOFALECIMENTOJUD");

        varDiaFalecimentoJud=comboDiaJud.options[comboDiaJud.selectedIndex].value;
        varMesFalecimentoJud=comboMesJud.options[comboMesJud.selectedIndex].value;
        varAnoFalecimentoJud=comboAnoJud.options[comboAnoJud.selectedIndex].value;
        

        
        varObs=document.getElementById("Obs7").value;
     // Atualiza as Obs nas fases
        atualizaObs(varObs);  

            var form = document.querySelector('form'); /// ?????
                var data = new FormData(form);         /// ?????
        
                console.log(data); 
                
 /*               
 >>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>  CRIAR AS VARIÁVEIS DE TODOS OS CAMPOS (7 filhos também)               
                
varNrIdFilho1=VALOR_DO_INPUT_ID_FILHO_1
varNrIdFilho2=VALOR_DO_INPUT_ID_FILHO_2
varNrIdFilho3=VALOR_DO_INPUT_ID_FILHO_3
varNrIdFilho4=VALOR_DO_INPUT_ID_FILHO_4
varNrIdFilho5=VALOR_DO_INPUT_ID_FILHO_5
varNrIdFilho6=VALOR_DO_INPUT_ID_FILHO_6
varNrIdFilho7=VALOR_DO_INPUT_ID_FILHO_7
varTxNmFilho1=VALOR_DO_INPUT_NOME_FILHO_1
varTxNmFilho2=VALOR_DO_INPUT_NOME_FILHO_2
varTxNmFilho3=VALOR_DO_INPUT_NOME_FILHO_3
varTxNmFilho4=VALOR_DO_INPUT_NOME_FILHO_4
varTxNmFilho5=VALOR_DO_INPUT_NOME_FILHO_5
varTxNmFilho6=VALOR_DO_INPUT_NOME_FILHO_6
varTxNmFilho7=VALOR_DO_INPUT_NOME_FILHO_7
varTxSxFilho1=VALOR_DO_INPUT_SEXO_FILHO_1
varTxSxFilho2=VALOR_DO_INPUT_SEXO_FILHO_2
varTxSxFilho3=VALOR_DO_INPUT_SEXO_FILHO_3
varTxSxFilho4=VALOR_DO_INPUT_SEXO_FILHO_4
varTxSxFilho5=VALOR_DO_INPUT_SEXO_FILHO_5
varTxSxFilho6=VALOR_DO_INPUT_SEXO_FILHO_6
varTxSxFilho7=VALOR_DO_INPUT_SEXO_FILHO_7
varTxDtFilho1=VALOR_DO_INPUT_DATANASCIMENTO_FILHO_1
varTxDtFilho2=VALOR_DO_INPUT_DATANASCIMENTO_FILHO_2
varTxDtFilho3=VALOR_DO_INPUT_DATANASCIMENTO_FILHO_3
varTxDtFilho4=VALOR_DO_INPUT_DATANASCIMENTO_FILHO_4
varTxDtFilho5=VALOR_DO_INPUT_DATANASCIMENTO_FILHO_5
varTxDtFilho6=VALOR_DO_INPUT_DATANASCIMENTO_FILHO_6
varTxDtFilho7=VALOR_DO_INPUT_DATANASCIMENTO_FILHO_7
>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>

                   //window.alert("Vai chamar o ajax7... ");
                    $.ajax({
                        url: 'salvarFase6.php',
                        type: 'post',
                        dataType: 'html', // json', //'html'
                        async: true,
                        data: {
                            varNumFilhos:varNumFilhos, //parâmetro passado = nff (número de filhos da página cadastroFichas
                            varDestino: varDestino,
                            varDataFalecimento: varDataFalecimento_Final,
                            varDiaFalecimentoJud:varDiaFalecimentoJud_Final,
                            varMesFalecimentoJud: varMesFalecimentoJud_Final,
                            varAnoFalecimentoJud: varAnoFalecimentoJud_Final,
                            varObs: varObs
                            
                        },
                        success: function(resposta){
                            //window.alert("Resposta:"+resposta);
                        }
                    });
                    //
                    //}
                  
                    //Funçao avançar carousel
                    $('#carrossel-passos').carousel('next');
*/
///}
//-------------------------------------------------------------------------------------------------------------------FIM FASE 6

// ==================================================================== FIM VERIFICA =================================================================

jQuery('#TX_MATRICULA_DIG').keyup(function () {
    this.value = this.value.replace(/[^0-9]/g,'');
    //alert(this.value);
});
function tipoMatricula(tipo){ //Vai definir o número da matrícula
    Matricula=document.getElementById("TX_MATRICULA_DIG").value;
    Matricula="0000"+Matricula;
    if(tipo==="Própria"){
        Matricula=Matricula.substring(Matricula.length-4,Matricula.length);
    }
    if(tipo==="Segundo"){
        Matricula=Matricula.substring(Matricula.length-4,Matricula.length)+"y";
    }
    document.getElementById("TX_MATRICULA").value=Matricula;
}

function getRadioValor(nameRadio){
    var radios = document.getElementsByName(nameRadio);

    radiovazio=true;
    for(var c = 0; c < radios.length; c++){
//        window.alert(" c radio: "+c);
     if(radios[c].checked){
         radiovazio=false;
         escolhido=radios[c].value;
     }
    } 
     if(radiovazio){
             mserro=''; //"Não há opção selecionada";
            return mserro;
         }else{
            return escolhido;
         }
}

function verificaNascIdade(opc){
    //alert("Opção"+opc);
    if (opc==='dt'){
        document.getElementById("TX_IDADE").disabled=true;
        document.getElementById("TX_IDADE").value='';
        document.getElementById("TX_DIANASCIMENTO").disabled=false;
        document.getElementById("TX_MESNASCIMENTO").disabled=false;
        document.getElementById("TX_ANONASCIMENTO").disabled=false;
        document.getElementById("idaderadio").checked=false;
        document.getElementById("dataNascRadio").checked=true;
    }
    if (opc==='id'){
        document.getElementById("TX_DIANASCIMENTO").disabled=true;
        document.getElementById("TX_MESNASCIMENTO").disabled=true;
        document.getElementById("TX_ANONASCIMENTO").disabled=true;
        document.getElementById("TX_DIANASCIMENTO").selectedIndex=0;
        document.getElementById("TX_MESNASCIMENTO").selectedIndex=0;
        document.getElementById("TX_ANONASCIMENTO").selectedIndex=0;
        document.getElementById("TX_IDADE").disabled=false;
        document.getElementById("idaderadio").checked=true;
        document.getElementById("dataNascRadio").checked=false;
    }
}

function conferePais(){
    document.getElementById("FORM_Fichas").action="conferePais.php";
    document.getElementById("FORM_Fichas").submit();
}

function inserirProponente(){
    if(document.getElementById('TX_NomeProponente2').value===""){
      document.getElementById('TX_TituloProponente1').value=document.getElementById('TX_TituloProponente1A').value;
      document.getElementById('TX_NomeProponente1').value=document.getElementById('TX_NomeProponente1A').value;
      document.getElementById('TX_SobrenomeProponente1').value=document.getElementById('TX_SobrenomeProponente1A').value;
    }
    varSexoChecked = getRadioValor('TX_SexoProponente1A');
    if(varSexoChecked==='M'){
     document.getElementById('mascProponente1').checked=true;
    }
    if(varSexoChecked==='F'){
     document.getElementById('femProponente1').checked=true;
    }
      document.getElementById('proponente1').classList.remove('d-none');
      document.getElementById('proponente2').classList.remove('d-none');
      document.getElementById('proponente1A').classList.add('d-none');
      document.getElementById('btnAdicionarProponente').classList.add('d-none');
}
function maisDeUmProponente(){
  document.getElementById('proponente1').classList.remove('d-none');
  document.getElementById('proponente2').classList.remove('d-none');
  document.getElementById('proponente1A').classList.add('d-none');
  document.getElementById('btnAdicionarProponente').classList.add('d-none');
}

function atualizaObs(Obs){
    for (nfases=1;nfases<7;nfases++){
        campoObs="Obs"+nfases;
        document.getElementById(campoObs).innerHTML=varObs;
    }
}
function estadoCivil(estCivil){
    if(document.getElementById('masc').checked){
        sexo='M';
    }
    if(document.getElementById('fem').checked){
        sexo='F';
    }

    switch (estCivil){
        case 'Solteiro':
            $('#TX_SOBRENOMECONJUGE').val('');
            $('#TX_NOMECONJUGE').val('');
            $('#TX_SOBRENOMESOLTEIRACONJUGE').val('');
            $('.sobrenome-conjuge').addClass('d-none');
            $('.nome-conjuge').addClass('d-none');
            $('.label-conjuge').addClass('d-none');
            $('.sobrenome-solteira-ficha').addClass('d-none');
            $('.sobrenome-solteira-conjuge').addClass('d-none');
            break;
        case 'Casado':
            $('.tipo-conjuge').text('cônjuge');
            $('.label-conjuge').removeClass('d-none');
            $('.sobrenome-conjuge').removeClass('d-none');
            $('.nome-conjuge').removeClass('d-none');
                if(sexo==='F'){
                    $('.sobrenome-solteira-ficha').removeClass('d-none');
                    $('.sobrenome-solteira-conjuge').addClass('d-none');
                    $('#TX_SOBRENOMESOLTEIRACONJUGE').val('');
                    $('.conjugeNascida').addClass('d-none');
                }
                if(sexo==='M'){
                    $('.sobrenome-solteira-ficha').addClass('d-none');
                    $('.sobrenome-solteira-conjuge').removeClass('d-none');
                    $('#TX_SOBRENOMESOLTEIRAFICHA').val('');
                    $('.conjugeNascida').removeClass('d-none');
                }
            break;
        case 'Divorciado':
            $('.label-conjuge').removeClass('d-none');
            $('.sobrenome-conjuge').removeClass('d-none');
            $('.nome-conjuge').removeClass('d-none');
            $('.tipo-conjuge').text('ex-cônjuge');
                if(sexo==='F'){
                    $('.sobrenome-solteira-ficha').removeClass('d-none');
                    $('.sobrenome-solteira-conjuge').addClass('d-none');
                    $('#TX_SOBRENOMESOLTEIRACONJUGE').val('');
                    $('.conjugeNascida').addClass('d-none');
                }
                if(sexo==='M'){
                    $('.sobrenome-solteira-ficha').addClass('d-none');
                    $('.sobrenome-solteira-conjuge').removeClass('d-none');
                    $('#TX_SOBRENOMESOLTEIRAFICHA').val('');
                    $('.conjugeNascida').removeClass('d-none');
                }
            break;
        case 'Viúvo':
            $('.label-conjuge').removeClass('d-none');
            $('.tipo-conjuge').text('cônjuge');
            $('.sobrenome-conjuge').removeClass('d-none');
            $('.nome-conjuge').removeClass('d-none');
                if(sexo==='F'){
                    $('.sobrenome-solteira-ficha').removeClass('d-none');
                    $('.sobrenome-solteira-conjuge').addClass('d-none');
                    $('#TX_SOBRENOMESOLTEIRACONJUGE').val('');
                    $('.conjugeNascida').addClass('d-none');
                    console.log('mulher');
                }
                if(sexo==='M'){
                    $('.sobrenome-solteira-ficha').addClass('d-none');
                    $('.sobrenome-solteira-conjuge').removeClass('d-none');
                    $('#TX_SOBRENOMESOLTEIRAFICHA').val(''); 
                    $('.conjugeNascida').removeClass('d-none');
                }           
            break;
        default:
        break;
    }
}

function mascFem(sexo){ // F ou M
    estCivil=getRadioValor('TX_ESTADOCIVIL');
    if(sexo==='M'){
        $('.vogalSexo').text('o');
        $('.vogalSexoContrario').text('a');
        estadoCivil(estCivil);
 
    }
    if(sexo==='F'){
        $('.vogalSexo').text('a');
        $('.vogalSexoContrario').text('o');
        estadoCivil(estCivil);
    }
}

//$tp1A=document.getElementById("TX_TituloProponente1A").value.length;
//$tp1=document.getElementById("TX_TituloProponente1").value.length;
//$tp2=document.getElementById("TX_TituloProponente2").value.length;
$np1A=document.getElementById('TX_NomeProponente1A').value.length;
$np1=document.getElementById('TX_NomeProponente1').value.length;
$np2=document.getElementById('TX_NomeProponente2').value.length;
$sp1A=document.getElementById('TX_SobrenomeProponente1A').value.length;
$sp1=document.getElementById('TX_SobrenomeProponente1').value.length;
$sp2=document.getElementById('TX_SobrenomeProponente2').value.length;

    if($np1A>0 || $np1>0 || $np2>0 || $sp1>0 || $sp1>0 || $sp2>0  ){
        maisDeUmProponente();
    }