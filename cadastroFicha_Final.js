
function novoFilho(botao, fase, matricula, sexoFicha, dtNasc, numFilhos){ //_____________________________________________________ FASE 4 INSERIR
   window.alert("NOVO FILHO: numFilhos="+numFilhos);
    numFilhos = parseInt(numFilhos);
    //
    varPai='';
    varMae='';

    varBotao=botao;
    varFase=fase;
    varDataNascFicha=dtNasc;
    varAnoNascFicha=parseInt(varDataNascFicha.substring(0,4));

//    if(sexoFicha==='M'){
//        varPai=matricula;
//    }else{
//        varMae=matricula;
//    }

    //alert("varAnoNascFicha="+varAnoNascFicha);
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

    varNomeFilho=document.getElementById("TX_NOMEFILHO_FINAL").value;
    varSexoFilho= getRadioValor('TX_SEXOFILHO_FINAL');
    varDiaFilho=document.getElementById("TX_DIANASCIMENTOFILHO_FINAL").value;
    varMesFilho=document.getElementById("TX_MESNASCIMENTOFILHO_FINAL").value;
    varAnoFilho=document.getElementById("TX_ANONASCIMENTOFILHO_FINAL").value;

    //window.alert("varNomeFilho:"+varNomeFilho);
    //window.alert("varSexoFilho:"+varSexoFilho);
    //window.alert("varDiaFilho:"+varDiaFilho);
    //window.alert("varMesFilho:"+varMesFilho);
    //window.alert("_____________________________________________ varAnoFilho:"+varAnoFilho);

    //window.alert("varAnoNascFicha:"+varAnoNascFicha);

    if(varNomeFilho!==""){verificaNome=true;}else{erro='1';varErro++;alert("Erro 1:"+erro );}
    //   if(varSexoFilho!==""){verificaSexo=true;}else{erro=erro+'2';varErro++;alert("Erro 2";}
    if(varDiaFilho!=="00"){verificaDia=true;}else{erro=erro+'2';varErro++;alert("Erro 2:"+erro);}
    if(varMesFilho!=="00"){verificaMes=true;}else{erro=erro+'3';varErro++;alert("Erro 3:"+erro);}
    if(varAnoFilho!=="0000"){
        //window.alert("varAnoFilho========================================: "+varAnoFilho);
        anopaiMaisDoze=parseInt(varAnoNascFicha)+12;
        //window.alert("anopaiMaisDoze========================================: "+anopaiMaisDoze);
        if(parseInt(varAnoFilho)<(parseInt(varAnoNascFicha)+12)){
            msgeano+="O ano selecionado diz que o pai tinha 12 anos ou menos quando o filho nasceu. Verifique";
            erro=erro+'4';
        }else{
                verificaAno=true;
             }
    }else{
          erro=erro+'4';alert("Erro 4:"+erro);
          msgeano+="O campo ano encontra-se vazio. Por vavor, selecione-o.";
    }

    if(erro.indexOf("1") !== -1){msge+="O campo nome encontra-se vazio. Por vavor, preencha-o.\n";}
    if(erro.indexOf("2") !== -1){msge+="O campo dia encontra-se vazio. Por vavor, selecione-o.\n";}
    if(erro.indexOf("3") !== -1){msge+="O campo mês encontra-se vazio. Por vavor, selecione-o.\n";}
    if(erro.indexOf("4") !== -1){msge+=msgeano;}
     //window.alert("verifMatricula: "+verifMatricula);

    var comboDia = document.getElementById("TX_DIANASCIMENTOFILHO_FINAL");
    var comboMes = document.getElementById("TX_MESNASCIMENTOFILHO_FINAL");
    var comboAno = document.getElementById("TX_ANONASCIMENTOFILHO_FINAL");

    varDia=parseInt(comboDia.options[comboDia.selectedIndex].value, 10);
    varMes=parseInt(comboMes.options[comboMes.selectedIndex].value, 10);
    varAno=parseInt(comboAno.options[comboAno.selectedIndex].value, 10);

    varDataNascimentoFilho=varAno+"/"+varMes+"/"+varDia;
    varNomeConjugeFicha=document.getElementById("TX_NOMECONJUGE").value;
    varObs=document.getElementById("Obs3_FINAL").value;
    
    //varObs=document.getElementById('Obs2');
                    for (nfases=1;nfases<7;nfases++){
                        campoObs="Obs"+nfases;
                        document.getElementById(campoObs).innerHTML=varObs;
                    }

    //window.alert("Botão:"+ botao);

    if(varNomeFilho.length<1){msge='Campos vazios';}
        //window.alert("Erro campos vazios: "+msge);

    // Verifica se há filhos anteriores e pesquisa se já foi incluído
    numFilhos=parseInt(numFilhos);
    ///window.alert("Número de filhos anteriores:"+numFilhos);
    if(numFilhos>0){
       // alert("numFilhos =" +numFilhos);
        for(nf=1;nf<=numFilhos;nf++){

            //pega dado de cada filho que já foi incluído
            campoNomeFilho="NomeFilho_FINAL"+nf;//alert(campoNomeFilho);
            varNomeFilhoOld=document.getElementById(campoNomeFilho).value;//alert(varNomeFilhoOld);//ok
            campoSexoFilho="TX_SexoFilho_FINAL"+nf; //alert(campoSexoFilho);
            varSexoFilhoOld= getRadioValor(campoSexoFilho);//alert(varSexoFilhoOld);
            campoDiaNascFilho="diaNascFilho_FINAL"+nf;//alert(campoDiaNascFilho);
            campoMesNascFilho="mesNascFilho_FINAL"+nf;//alert(campoMesNascFilho);
            campoAnoNascFilho="anoNascFilho_FINAL"+nf;//alert(campoAnoNascFilho);

            varDiaFilhoOld=parseInt(document.getElementById(campoDiaNascFilho).value);//alert(varDiaFilhoOld);
            varMesFilhoOld=parseInt(document.getElementById(campoMesNascFilho).value);//alert(varMesFilhoOld);
            varAnoFilhoOld=parseInt(document.getElementById(campoAnoNascFilho).value);//alert(varAnoFilhoOld);
            //window.alert("Filho anterior "+nf);
            //window.alert("Nime:"+varNomeFilho+"="+varNomeFilhoOld+"?");
            //window.alert("Nime:"+varSexoFilho+"="+varSexoFilhoOld+"?");
            //window.alert("Nime:"+varDiaFilho+"="+varDiaFilhoOld+"?");
            //window.alert("Nime:"+varMesFilho+"="+varMesFilhoOld+"?");
            //window.alert("Nime:"+varAnoFilho+"="+varAnoFilhoOld+"?");

            //verifica se filho já foi incluído
            if((varNomeFilho===varNomeFilhoOld)&&(varSexoFilho===varSexoFilhoOld)&&(parseInt(varDiaFilho)===varDiaFilhoOld)&&(parseInt(varMesFilho)===varMesFilhoOld)&&(parseInt(varAnoFilho)===varAnoFilhoOld)){ // Já incluído - erro=1
                varErro='1';
                window.alert("Esse filho já foi incluído.");
            }
        }
    }

    if(erro.indexOf("1") !== -1 && botao==='inserir'){// Se botão = inserir, não pode haver nome vazio
               window.alert(msge);
    }else{// Não entrou na regra acima, vai passar para o ajaz
        msge="";
        //window.alert("Vai chamar o ajax2... Dados: +dados + '.'");
         $.ajax({
             url: 'salvarFase4.php',
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
                  document.getElementById("TX_NOMEFILHO_FINAL").value='';
                  document.getElementsByName("TX_SEXOFILHO_FINAL").checked=false;
                  document.getElementById("TX_DIANASCIMENTOFILHO_FINAL").selectedIndex=0;
                  document.getElementById("TX_MESNASCIMENTOFILHO_FINAL").selectedIndex=0;
                  document.getElementById("TX_ANONASCIMENTOFILHO_FINAL").selectedIndex=0;
        }

    }// fim else regra nome vazio
    atualizaObs();
    window.location.reload();
 }
    //return;// data;

//-------------------------------------------------------------------------------------------------------------------FIM FASE 5
function verificaFase6(){ //________________________________________________________________________________________ FASE 6
    window.alert("Verificando campos da fase 6");

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
        
        alert(" Dia: "+varDiaFalecimentoJud);
        alert(" Mes"+varMesFalecimentoJud);
        alert(" Ano"+varAnoFalecimentoJud);

        varObs=document.getElementById("Obs5").value;
        for (nfases=1;nfases<7;nfases++){
           campoObs="Obs"+nfases;
           document.getElementById(campoObs).innerHTML=varObs;

    var form = document.querySelector('form');
        var data = new FormData(form);

        console.log(data);       

                   //window.alert("Vai chamar o ajax6... ");
                    $.ajax({
                        url: 'salvarFase6.php',
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
                            window.alert("Resposta:"+resposta);
                        }
                    });
                    //
                    }
                    atualizaObs();
                    //Funçao avançar carousel
                    $('#carrossel-passos').carousel('next');

}
//-------------------------------------------------------------------------------------------------------------------FIM FASE 6

// ==================================================================== FIM VERIFICA =================================================================

jQuery('#TX_MATRICULA').keyup(function () {
    this.value = this.value.replace(/[^yY0-9]/g,'');
    //alert(this.value);
});

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
  document.getElementById('TX_TituloProponente1').value=document.getElementById('TX_TituloProponente1A').value;
  document.getElementById('TX_NomeProponente1').value=document.getElementById('TX_NomeProponente1A').value;
  document.getElementById('TX_SobrenomeProponente1').value=document.getElementById('TX_SobrenomeProponente1A').value;
  varSexoChecked = getRadioValor('TX_SexoProponente1A');
  if(varSexoChecked==='M'){
    document.getElementById('mascProponente1').checked=true;
  }
  else{
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

function mascFem(sexo){ // F ou M    
    if(sexo==='M'){
        $('.vogalSexo').text('o');
        $('.vogalSexoContrario').text('a'); 
    }
    if(sexo==='F'){
        $('.vogalSexo').text('a');
        $('.vogalSexoContrario').text('o');
    }
}