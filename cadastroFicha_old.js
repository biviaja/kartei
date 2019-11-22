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

function novoFilho(botao, fase, matricula, sexoFicha, dtNasc, numFilhos){ //_____________________________________________________ FASE 3 INSERIR
    numFilhos = parseInt(numFilhos);
    //
    varPai='';
    varMae='';

    varBotao=botao;
    varFase=fase;
    varDataNascFicha=dtNasc;
    varAnoNascFicha=parseInt(varDataNascFicha.substring(0,4));

    varErro=0;
    erro="";
    msge="";
    msgeano="";

    verificaNome=false;
    verificaSexo=false;
    verificaDia=false;
    verificaMes=false;
    verificaAno=false;

    varNomeFilho=document.getElementById("TX_NOMEFILHO").value;
    varSexoFilho= getRadioValor('TX_SEXOFILHO');
    varDiaFilho=document.getElementById("TX_DIANASCIMENTOFILHO").value;
    varMesFilho=document.getElementById("TX_MESNASCIMENTOFILHO").value;
    varAnoFilho=document.getElementById("TX_ANONASCIMENTOFILHO").value;


    if(varNomeFilho!==""){verificaNome=true;}else{erro='1';varErro++;
    }
    //   if(varSexoFilho!==""){verificaSexo=true;}else{erro=erro+'2';
    if(varDiaFilho!=="00"){verificaDia=true;}else{erro=erro+'2';varErro++;
    }
    if(varMesFilho!=="00"){verificaMes=true;}else{erro=erro+'3';varErro++;
    }
    if(varAnoFilho!=="0000"){
        anopaiMaisDoze=parseInt(varAnoNascFicha)+12;
        if(parseInt(varAnoFilho)<(parseInt(varAnoNascFicha)+12)){
            msgeano+="O ano selecionado diz que o pai tinha 12 anos ou menos quando o filho nasceu. Verifique";
            erro=erro+'4';
        }else{
                verificaAno=true;
             }
    }else{
          erro=erro+'4';
          msgeano+="O campo ano encontra-se vazio. Por vavor, selecione-o.";
    }

    if(erro.indexOf("1") !== -1){msge+="O campo nome encontra-se vazio. Por vavor, preencha-o.\n";}
    if(erro.indexOf("2") !== -1){msge+="O campo dia encontra-se vazio. Por vavor, selecione-o.\n";}
    if(erro.indexOf("3") !== -1){msge+="O campo mês encontra-se vazio. Por vavor, selecione-o.\n";}
    if(erro.indexOf("4") !== -1){msge+=msgeano;}

    var comboDia = document.getElementById("TX_DIANASCIMENTOFILHO");
    var comboMes = document.getElementById("TX_MESNASCIMENTOFILHO");
    var comboAno = document.getElementById("TX_ANONASCIMENTOFILHO");

    varDia=parseInt(comboDia.options[comboDia.selectedIndex].value, 10);
    varMes=parseInt(comboMes.options[comboMes.selectedIndex].value, 10);
    varAno=parseInt(comboAno.options[comboAno.selectedIndex].value, 10);

    varDataNascimentoFilho=varAno+"/"+varMes+"/"+varDia;
    varNomeConjugeFicha=document.getElementById("TX_NOMECONJUGE").value;
    varObs=document.getElementById("Obs3").value;

    // Atualiza as Obs nas fases
    atualizaObs(varObs);

    if(varNomeFilho.length<1){msge='Campos vazios';}

    // Verifica se há filhos anteriores e pesquisa se já foi incluído
    numFilhos=parseInt(numFilhos);
    if(numFilhos>0){
        for(nf=1;nf<=numFilhos;nf++){

            //pega dado de cada filho que já foi incluído
            campoNomeFilho="NomeFilho"+nf;
            varNomeFilhoOld=document.getElementById(campoNomeFilho).value;
            campoSexoFilho="TX_SexoFilho"+nf;
            varSexoFilhoOld= getRadioValor(campoSexoFilho);
            campoDiaNascFilho="diaNascFilho"+nf;
            campoMesNascFilho="mesNascFilho"+nf;
            campoAnoNascFilho="anoNascFilho"+nf;

            varDiaFilhoOld=parseInt(document.getElementById(campoDiaNascFilho).value);
            varMesFilhoOld=parseInt(document.getElementById(campoMesNascFilho).value);
            varAnoFilhoOld=parseInt(document.getElementById(campoAnoNascFilho).value);

            //verifica se filho já foi incluído
            if((varNomeFilho===varNomeFilhoOld)&&(varSexoFilho===varSexoFilhoOld)&&(parseInt(varDiaFilho)===varDiaFilhoOld)&&(parseInt(varMesFilho)===varMesFilhoOld)&&(parseInt(varAnoFilho)===varAnoFilhoOld)){ // Já incluído - erro=1
                varErro='1';
            }
        }
    }
    // Atualiza as Obs nas fases
    atualizaObs(varObs);
    
    if(erro.indexOf("1") !== -1 && botao==='inserir'){// Se botão = inserir, não pode haver nome vazio
    }else{// Não entrou na regra acima, vai passar para o ajax
        msge="";
         $.ajax({
             url: 'salvarFase3.php',
             type: 'post',
             dataType: 'html', // json', //'html'
             async: true,
             data: {
                 varNomeFilho: varNomeFilho, //$('#TX_NOMEFILHO').val(),
                 varSexoFilho:varSexoFilho,
                 varDataNascimentoFilho: varDataNascimentoFilho,
                 botao:botao,
                 varObs: varObs
             },
             success: function(resposta){
                 //window.alert("Resposta:"+ resposta);
             }
         });
         window.location.href="cadastroFicha.php?mat="+matricula+"&fase=3";
        if (botao==='salvar'){  // Avança se o botão for salvar, mas permanece caso seja inserir
             // Função avançar
             //$('a[data-slide="next"]').click();
        }else{// reseta
            //window.alert("Resetar...");
                  document.getElementById("TX_NOMEFILHO").value='';
                  document.getElementsByName("TX_SEXOFILHO").checked=false;
                  document.getElementById("TX_DIANASCIMENTOFILHO").selectedIndex=0;
                  document.getElementById("TX_MESNASCIMENTOFILHO").selectedIndex=0;
                  document.getElementById("TX_ANONASCIMENTOFILHO").selectedIndex=0;
        }

    }// fim else regra nome vazio
    window.location.reload();
 }
//-------------------------------------------------------------------------------------------------------------------FIM FASE 3 INSERIR
function salvarFake(botao, fase, matricula, sexoFicha, dtNasc, numFilhos){ // :::::::::::::::::::::::::::::::::::::: FASE 3 SALVAR FAKE
//window.alert("FAKE: NOVO FILHO: numFilhos="+numFilhos);
    numFilhos = parseInt(numFilhos);
    //
    varPai='';
    varMae='';

    varBotao=botao;
    varFase=fase;
    varDataNascFicha=dtNasc;
    varAnoNascFicha=parseInt(varDataNascFicha.substring(0,4));

    varErro=0;
    erro="";
    msge="";
    msgeano="";

    verificaNome=false;
    verificaSexo=false;
    verificaDia=false;
    verificaMes=false;
    verificaAno=false;

    varNomeFilho=document.getElementById("TX_NOMEFILHO").value;
    varSexoFilho= getRadioValor('TX_SEXOFILHO');
    varDiaFilho=document.getElementById("TX_DIANASCIMENTOFILHO").value;
    varMesFilho=document.getElementById("TX_MESNASCIMENTOFILHO").value;
    varAnoFilho=document.getElementById("TX_ANONASCIMENTOFILHO").value;

    if(varNomeFilho!==""){verificaNome=true;}else{erro='1';varErro++; 
     }
    //   if(varSexoFilho!==""){verificaSexo=true;}else{erro=erro+'2';varErro++;alert("Erro 2";}
    if(varDiaFilho!=="00"){verificaDia=true;}else{erro=erro+'2';varErro++;
    }
    if(varMesFilho!=="00"){verificaMes=true;}else{erro=erro+'3';varErro++;
    }
    if(varAnoFilho!=="0000"){
        anopaiMaisDoze=parseInt(varAnoNascFicha)+12;
        if(parseInt(varAnoFilho)<(parseInt(varAnoNascFicha)+12)){
            msgeano+="O ano selecionado diz que o pai tinha 12 anos ou menos quando o filho nasceu. Verifique";
            erro=erro+'4';
        }else{
                verificaAno=true;
             }
    }else{
          erro=erro+'4';///alert("Erro 4:"+erro);
          msgeano+="O campo ano encontra-se vazio. Por vavor, selecione-o.";
    }

    if(erro.indexOf("1") !== -1){msge+="O campo nome encontra-se vazio. Por vavor, preencha-o.\n";}
    if(erro.indexOf("2") !== -1){msge+="O campo dia encontra-se vazio. Por vavor, selecione-o.\n";}
    if(erro.indexOf("3") !== -1){msge+="O campo mês encontra-se vazio. Por vavor, selecione-o.\n";}
    if(erro.indexOf("4") !== -1){msge+=msgeano;}

    var comboDia = document.getElementById("TX_DIANASCIMENTOFILHO");
    var comboMes = document.getElementById("TX_MESNASCIMENTOFILHO");
    var comboAno = document.getElementById("TX_ANONASCIMENTOFILHO");

    varDia=parseInt(comboDia.options[comboDia.selectedIndex].value, 10);
    varMes=parseInt(comboMes.options[comboMes.selectedIndex].value, 10);
    varAno=parseInt(comboAno.options[comboAno.selectedIndex].value, 10);

    varDataNascimentoFilho=varAno+"/"+varMes+"/"+varDia;
    varNomeConjugeFicha=document.getElementById("TX_NOMECONJUGE").value;
    varObs=document.getElementById("Obs3").value;

    if(varNomeFilho.length<1){msge='Campos vazios';}

    // Verifica se há filhos anteriores e pesquisa se já foi incluído
    numFilhos=parseInt(numFilhos);
    if(numFilhos>0){
        for(nf=1;nf<=numFilhos;nf++){
            //pega dado de cada filho que já foi incluído
            campoNomeFilho="NomeFilho"+nf;
            varNomeFilhoOld=document.getElementById(campoNomeFilho).value;
            campoSexoFilho="TX_SexoFilho"+nf;
            varSexoFilhoOld= getRadioValor(campoSexoFilho);
            campoDiaNascFilho="diaNascFilho"+nf;
            campoMesNascFilho="mesNascFilho"+nf;
            campoAnoNascFilho="anoNascFilho"+nf;

            varDiaFilhoOld=parseInt(document.getElementById(campoDiaNascFilho).value);
            varMesFilhoOld=parseInt(document.getElementById(campoMesNascFilho).value);
            varAnoFilhoOld=parseInt(document.getElementById(campoAnoNascFilho).value);

            //verifica se filho já foi incluído
            if((varNomeFilho===varNomeFilhoOld)&&(varSexoFilho===varSexoFilhoOld)&&(parseInt(varDiaFilho)===varDiaFilhoOld)&&(parseInt(varMesFilho)===varMesFilhoOld)&&(parseInt(varAnoFilho)===varAnoFilhoOld)){ // Já incluído - erro=1
                varErro='1';
              //  window.alert("Esse filho já foi incluído.");
            }
        }
    }

    if(erro.indexOf("1") !== -1 && botao==='inserir'){ // Se botão = inserir, não pode haver nome vazio
               window.alert(msge);
    }else{// Não entrou na regra acima, vai passar para o ajax
        msge="";
        //window.alert("Vai chamar o ajax2... Dados: +dados + '.'");
         $.ajax({
             url: 'salvarFase3.php',
             type: 'post',
             dataType: 'html', // json', //'html'
             async: true,
             data: {
                 varNomeFilho: varNomeFilho, //$('#TX_NOMEFILHO').val(),
                 varSexoFilho:varSexoFilho,
                 varDataNascimentoFilho: varDataNascimentoFilho,
                 botao:botao,
                 varObs: varObs
             },
             success: function(resposta){
                 //window.alert("Resposta:"+ resposta);
             }
         });
        if (botao==='salvar'){// Avança se o botão for salvar, mas permanece caso seja inserir
             // Função avançar
             //$('a[data-slide="next"]').click();
        }else{// reseta
            //window.alert("Resetar...");
                  document.getElementById("TX_NOMEFILHO").value='';
                  document.getElementsByName("TX_SEXOFILHO").checked=false;
                  document.getElementById("TX_DIANASCIMENTOFILHO").selectedIndex=0;
                  document.getElementById("TX_MESNASCIMENTOFILHO").selectedIndex=0;
                  document.getElementById("TX_ANONASCIMENTOFILHO").selectedIndex=0;
        }

    }// fim else regra nome vazio
    //document.location.reload(false);
    //varObs=document.getElementById('Obs2');
     // Atualiza as Obs nas fases
        atualizaObs(varObs);
    //Funçao avançar carousel
        $('#carrossel-passos').carousel('next');
}
//:::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::::: FIM FASE 4 SALVAR FAKE

function salvarFilhos(botao, fase, matricula, sexoFicha, dtNasc, numFilhos){ //_____________________________________________________ FASE 4 SALVAR
    //
    varPai='';
    varMae='';
    var totFILHOS=0;
    ///window.alert("(tem de ser 0 > totFILHOS:"+totFILHOS); ========> OK
    var nFilhos=parseInt(numFilhos);
    totFILHOS=nFilhos+1;
  //  window.alert("SALVAR filho: botão="+botao+" dtNasc="+dtNasc+"\n Número de filhos anteriores: "+nFilhos+"\n totFILHOS:"+totFILHOS); //========> OK

    varBotao=botao;
    varFase=fase;
    varDataNascFicha=dtNasc;
    varAnoNascFicha=parseInt(varDataNascFicha.substring(0,4));

//    if(sexoFicha==='M'){
//        varPai=matricula;
//    }else{
//        varMae=matricula;
//    }

//    alert("varAnoNascFicha="+varAnoNascFicha);
    varErro=0;
    erro="";
    msge="";
    msgeano="";
    // Se todos os campos estiverem vazios, passa direto. Senão TODOS os campos precisam estar preenchidos

    verificaNome=false;
    verificaSexo=false;
    verificaDia=false;
    verificaMes=false;
    verificaAno=false;

    varNomeFilho=document.getElementById("TX_NOMEFILHO").value;
    varSexoFilho= getRadioValor('TX_SEXOFILHO');

    var comboDia = document.getElementById("TX_DIANASCIMENTOFILHO");
    var comboMes = document.getElementById("TX_MESNASCIMENTOFILHO");
    var comboAno = document.getElementById("TX_ANONASCIMENTOFILHO");

    varDia=parseInt(comboDia.options[comboDia.selectedIndex].value, 10);
    varMes=parseInt(comboMes.options[comboMes.selectedIndex].value, 10);
    varAno=parseInt(comboAno.options[comboAno.selectedIndex].value, 10);

    varDiaFilho=document.getElementById("TX_DIANASCIMENTOFILHO").value;
    varMesFilho=document.getElementById("TX_MESNASCIMENTOFILHO").value;
    varAnoFilho=document.getElementById("TX_ANONASCIMENTOFILHO").value;
/*
   window.alert("varNomeFilho:"+varNomeFilho);
   window.alert("varSexoFilho:"+varSexoFilho);
   window.alert("varDiaFilho:"+varDiaFilho);
   window.alert("varMesFilho:"+varMesFilho);
   window.alert("________________________________ varAnoFilho:"+varAnoFilho);
//
//    window.alert("varAnoNascFicha:"+varAnoNascFicha);


//    if(varNomeFilho!==""){verificaNome=true;}else{erro='1';varErro++;alert("Erro 1:"+erro );}
//            if(varSexoFilho!==""){verificaSexo=true;}else{erro=erro+'2';varErro++;alert("Erro 2";}
//    if(varDiaFilho!=="00"){verificaDia=true;}else{erro=erro+'2';varErro++;alert("Erro 2:"+erro);}
//    if(varMesFilho!=="00"){verificaMes=true;}else{erro=erro+'3';varErro++;alert("Erro 3:"+erro);}
//    if(varAnoFilho!=="0000"){
       // window.alert("varAnoFilho========================================: "+varAnoFilho);
//        anopaiMaisDoze=parseInt(varAnoNascFicha)+12;
       // window.alert("anopaiMaisDoze=====================================: "+anopaiMaisDoze);
//        if(parseInt(varAnoFilho)<(parseInt(varAnoNascFicha)+12)){
//            msgeano+="O ano selecionado diz que o pai tinha 12 anos ou menos quando o filho nasceu. Verifique";
//            erro=erro+'4';
//        }else{
//                verificaAno=true;
//             }
//    }else{
//          erro=erro+'4';alert("Erro 4 - Pai muito novo:"+erro);
//          msgeano+="O campo ano encontra-se vazio. Por vavor, selecione-o.";
//    }


//    if(erro.indexOf("1") !== -1){msge+="O campo nome encontra-se vazio. Por vavor, preencha-o.\n";}
//    if(erro.indexOf("2") !== -1){msge+="O campo dia encontra-se vazio. Por vavor, selecione-o.\n";}
//    if(erro.indexOf("3") !== -1){msge+="O campo mês encontra-se vazio. Por vavor, selecione-o.\n";}
//    if(erro.indexOf("4") !== -1){msge+=msgeano;}
     //window.alert("verifMatricula: "+verifMatricula);

    var comboDia = document.getElementById("TX_DIANASCIMENTOFILHO");
    var comboMes = document.getElementById("TX_MESNASCIMENTOFILHO");
    var comboAno = document.getElementById("TX_ANONASCIMENTOFILHO");

    varDia=parseInt(comboDia.options[comboDia.selectedIndex].value, 10);
    varMes=parseInt(comboMes.options[comboMes.selectedIndex].value, 10);
    varAno=parseInt(comboAno.options[comboAno.selectedIndex].value, 10);

    varDataNascimentoFilho=varAno+"/"+varMes+"/"+varDia;
    varNomeConjugeFicha=document.getElementById("TX_NOMECONJUGE").value;
    varObs=document.getElementById("Obs3").value;

    window.alert("Botão:"+ botao);

//    if(varNomeFilho.length<1){varObs='Campos vazios';}
//        window.alert("OBS: "+varObs);

//    if(erro.indexOf("1") !== -1){// Se botão = inserir, não pode haver nome vazio
//               window.alert(msge);
//    }else{// Não entrou na regra acima, vai passar para o ajax
        // loop para pegar os campos e valores de cada filho
        var campoNome=[];
        var campoDia=[];
        var campoMes=[];
        var campoAno=[];
        var campoSexo=[];
        var campoIdFilhoOld=[];
        var varOldId=[];
        var varOldNome=[];
        var varOldDia=[];
        var varComboDiaOld=[];
        var varOldMes=[];
        var varComboMesOld=[];
        var varOldAno=[];
        var varComboAnoOld=[];
        var varOldSexo=[];
        var varOldDataNasc=[];
        var dadosAnteriories="";
        var dadosFilhosAnteriories=[];
        var dadosParaAjax={dados:[]};
        var varNumeroDeFilhos="varNumeroDeFilhos";
        dadosIniciais={varNumeroDeFilhos:totFILHOS};
        dadosParaAjax.dados.push(dadosIniciais);
        console.log(dadosParaAjax.dados[0].varNumeroDeFilhos);
        alert("dadosParaAjax.dados[0].varNumeroDeFilhos: "+dadosParaAjax.dados[0].varNumeroDeFilhos);
        
        for(var nf=1;nf<=nFilhos;nf++){
            //campos
            campoIdFilhoOld[nf]="idFilho"+(nf);//alert("campoIdFilhoOld["+nf+"]:"+campoIdFilhoOld[nf] );
            campoNome[nf]="NomeFilho"+(nf);//alert("campoNome["+nf+"]:"+campoNome[nf] );
            campoDia[nf]="diaNascFilho"+(nf);//alert("campoDia["+nf+"]:"+campoDia[nf] );
            campoMes[nf]="mesNascFilho"+(nf);//alert("campoMes["+nf+"]:"+campoMes[nf] );
            campoAno[nf]="anoNascFilho"+(nf);//alert("campoAno["+nf+"]:"+campoAno[nf] );
            campoSexo[nf]="TX_SexoFilho"+(nf);//alert("campoSexo["+nf+"]:"+campoSexo[nf] );
            
            varOldSexo[nf]= getRadioValor(campoSexo[nf]);//alert("varOldSexo["+nf+"]:"+varOldSexo[nf] );

            varOldId[nf]=document.getElementById(campoIdFilhoOld[nf]).value;//alert("campoIdFilhoOld["+nf+"]:"+campoIdFilhoOld[nf]);
            varOldNome[nf]=document.getElementById(campoNome[nf]).value;//alert("varOldId["+nf+"]:"+varOldId[nf] );

            varComboDiaOld[nf] = document.getElementById(campoDia[nf]);
            varComboMesOld[nf] = document.getElementById(campoMes[nf]);
            varComboAnoOld[nf] = document.getElementById(campoAno[nf]);

            varOldDia[nf]=parseInt(varComboDiaOld[nf].options[varComboDiaOld[nf].selectedIndex].value, 10);
            varOldMes[nf]=parseInt(varComboMesOld[nf].options[varComboMesOld[nf].selectedIndex].value, 10);
            varOldAno[nf]=parseInt(varComboAnoOld[nf].options[varComboAnoOld[nf].selectedIndex].value, 10);
            alert("varOldDia["+nf+"]:"+varOldDia[nf] );
            alert("varOldMes["+nf+"]:"+varOldMes[nf] );
            alert("varOldAno["+nf+"]:"+varOldAno[nf] );
            varOldDataNasc[nf]=varOldAno[nf]+"/"+varOldMes[nf]+"/"+varOldDia[nf];//alert("varOldDataNasc["+nf+"]:"+varOldDataNasc[nf]);
            
            varOldDia[nf]=document.getElementById(campoDia[nf]).value;alert("varOldDia["+nf+"]:"+varOldDia[nf] );
            varOldMes[nf]=document.getElementById(campoMes[nf]).value;alert("varOldMes["+nf+"]:"+varOldMes[nf] );
            varOldAno[nf]=document.getElementById(campoAno[nf]).value;alert("varOldAno["+nf+"]:"+varOldAno[nf] );
            
            
            // Monta Dados Anteriores
            varTxId="varIdFilho"+nf;
            varTxNm="varNomeFilho"+nf;
            varTxSx="varSexoFilho"+nf;
            varTxDt="varDataNascimentoFilho"+nf;
            
            dadosAnteriories+=varTxId+":"+varOldId[nf]+",\n"; //alert("dadosAnteriories:"+dadosAnteriories);
            dadosAnteriories+=varTxNm+":'"+varOldNome[nf]+"',\n"; //alert("dadosAnteriories:"+dadosAnteriories);
            dadosAnteriories+=varTxSx+":'"+varOldSexo[nf]+"',\n"; //alert("dadosAnteriories:"+dadosAnteriories);
            dadosAnteriories+=varTxDt+":'"+varOldDataNasc[nf]+"',\n"; //alert("dadosAnteriories:"+dadosAnteriories);
            
            dados={
                varTxId:varOldId[nf],
                varTxNm:varOldNome[nf],
                varTxSx:varOldSexo[nf],
                varTxDt:varOldDataNasc[nf]
            };
            dadosParaAjax.dados.push(dados);
            
            console.log(dadosParaAjax.dados[nf].varTxId);
            console.log(dadosParaAjax.dados[nf].varTxNm);
            console.log(dadosParaAjax.dados[nf].varTxSx);
            console.log(dadosParaAjax.dados[nf].varTxDt);
            
            var alerta=varTxId+":"+dadosParaAjax.dados[nf].varTxId+", ";
            alerta+=varTxNm+":"+dadosParaAjax.dados[nf].varTxNm+", ";
            alerta+=varTxSx+":"+dadosParaAjax.dados[nf].varTxSx+", ";
            alerta+=varTxDt+":"+dadosParaAjax.dados[nf].varTxDt;
            window.alert(alerta);
            
            //dadosFilhosAnteriories[nf]=[varTxId=>varOldId[nf],varTxNm=>varOldNome[nf],varTxSx=>varOldSexo[nf],varTxDt=>varOldDataNasc[nf]];
            
            ///            window.alert("dadosAnteriores_"+nf+"):\n"+dadosAnteriories);
            
        } // Fim for filhos anteriores
        alert("totFILHOS ===============> "+totFILHOS);
        var linha1="varNumeroDeFilhos"+":"+totFILHOS+",\n";
        dadosJQ="";
        dadosJQ+=linha1;
        dadosJQ+=dadosAnteriories;
        dadosJQ+="varNomeFilho: '"+varNomeFilho+"',\n";
        dadosJQ+="varSexoFilho: '"+varSexoFilho+"',\n";
        dadosJQ+="varDataNascimentoFilho: '"+varDataNascimentoFilho+"',\n";
        dadosJQ+="botao: "+varBotao+",\n";
        dadosJQ+="varObs: "+varObs;
///        window.alert("dadosJQ:\n"+dadosJQ);
        
 */       
        var dadosFilhosAjax=$("#FORM_Fichas").serializeArray();
        
        msge="";
        // window.alert("Vai chamar o AJAX SALVA... <br>");
         $.ajax({
             url: 'salvarFase3S.php',
             type: 'post',
             dataType: 'html', // 'json', //'html'
             async: true,
             data: {
                    dadosAjax:$("#FORM_Fichas").serializeArray()
                    /*  dadosJQ
                 varNumeroDeFilhos:3,
                 varIdFilho1:72,
                 varNomeFilho1: "Jose 1",
                 varSexoFilho1:'M',
                 varDataNascimentoFilho1: "1961/1/1",
                 varIdFilho2:73,
                 varNomeFilho2: "Maria 2",
                 varSexoFilho2:'F',
                 varDataNascimentoFilho2: "1962/2/2",
                 varIdFilho3:74,
                 varNomeFilho3: "Zefa 3",
                 varSexoFilho3:"F",
                    varDataNascimentoFilho3: "1963/3/3",
                    varIdFilho3:28,
                     varNomeFilho3: 'Carambola',
                     varSexoFilho3:'M',
                     varDataNascimentoFilho3: '1969/9/6',
                     varNomeFilho: 'Zica',
                     varSexoFilho:'F',
                     varDataNascimentoFilho: '1970/12/10',*/
            //         botao:botao,
            //         varObs: varObs //*/
                },
             success: function(resposta){
               // window.alert("Resposta:"+ resposta);
             }
         });
         //varObs=document.getElementById('Obs2');
     // Atualiza as Obs nas fases
     //   atualizaObs(varObs);
        //Funçao avançar carousel
        $('#carrossel-passos').carousel('next');

 //   }// fim else regra nome vazio
    //return;// data;
}
//-------------------------------------------------------------------------------------------------------------------FIM FASE 3 SALVAR
//================================================================================================================== FASE 4 ==========
function salvarProponente(){ //_____________________________________________________________________________ FASE 5 SALVAR PROPONENTES

    //window.alert("Incluir proponente: botão="+botao+" fase="+fase);
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

   // window.alert("varTituloProponente:"+varTituloProponente);
   // window.alert("varNomeProponente:"+varNomeProponente);
   // window.alert("varSobrenomeProponente:"+varSobrenomeProponente);
   // window.alert("varSexoProponente1:"+varSexoProponente1);

    varTituloProponente2=document.getElementById("TX_TituloProponente2").value;
    varNomeProponente2=document.getElementById("TX_NomeProponente2").value;
    varSobrenomeProponente2=document.getElementById("TX_SobrenomeProponente2").value;
    varSexoProponente2= getRadioValor('TX_SexoProponente2');

   // window.alert("varTituloProponente2:"+varTituloProponente2);
   // window.alert("varNomeProponente2:"+varNomeProponente2);
   // window.alert("varSobrenomeProponente2:"+varSobrenomeProponente2);
   // window.alert("varSexoProponente2:"+varSexoProponente2);

    var comboDia = document.getElementById("TX_DIAACEITACAO");
    var comboMes = document.getElementById("TX_MESACEITACAO");
    var comboAno = document.getElementById("TX_ANOACEITACAO");

    varDia=parseInt(comboDia.options[comboDia.selectedIndex].value, 10);
    varMes=parseInt(comboMes.options[comboMes.selectedIndex].value, 10);
    varAno=parseInt(comboAno.options[comboAno.selectedIndex].value, 10);

    varDataAceitacao=varAno+"/"+varMes+"/"+varDia;
    varObs=document.getElementById("Obs4").value;
    //window.alert("OBSERVAÇÃO" + varObs);

  //  window.alert("Vai chamar o ajax5... Dados: +dados + '.'");
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
    }// fim else regra nome vazio
    //return;// data;
//------------------------------------------------------------------------------------------------------------------ FIM FASE 4 SALVAR
function verificaFase5(){ //________________________________________________________________________________________ FASE 5
   // window.alert("Verificando campos da fase 6");

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

        //alert(" Dia: "+varDiaFalecimentoJud);
        //alert(" Mes"+varMesFalecimentoJud);
        //alert(" Ano"+varAnoFalecimentoJud);

        varObs=document.getElementById("Obs5").value;
     // Atualiza as Obs nas fases
        atualizaObs(varObs);  

            var form = document.querySelector('form'); /// ?????
                var data = new FormData(form);         /// ?????

                console.log(data);

                   //window.alert("Vai chamar o ajax6... ");
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
                    //
                    //}
                  
                    //Funçao avançar carousel
                    $('#carrossel-passos').carousel('next');

}
//-------------------------------------------------------------------------------------------------------------------FIM FASE 5
function verificaFase6(){ //________________________________________________________________________________________ FASE FINAL 6
   // window.alert("Verificando campos da fase 6");
  
   $.ajax({
                    url: 'salvarFase6_provisorio.php',
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
SÓ ATUALIZAR ApÒS CONCLUIR EDIÇÃO DESTA FUNÇÃO 
+++++++++++++++++++++++++++++++++++++++++++++++

PEGAR OS NOMES DOS CAMPOS
Os que não tiverem id ou name, colocar e atualizar na cadastroFicha.php 

    <input type="text" name="TX_TITULOPESSOA_Final" id="TX_TITULOPESSOA_final" class="form-control" value="<?php echo $_SESSION['ficha']['varTituloPessoa']; ?>">
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

//    window.alert(" nome do Radio: "+nameRadio);
//    window.alert(" radios: "+radios);

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