<!DOCTYPE html>
<html lang="en">
  <?php include 'head.php'; ?>
  <body>

    <?php include 'menu.php'; ?>
    <?php include 'logout.php'; ?>
      <form>
        <div id="carrossel-passos" class="carousel slide" data-ride="carousel" data-interval="false">
          <h3 class="col-12">NOVA FICHA - Entrada de Dados</h3>
          <h3 class="passos col-12 carousel-indicators">
            <div class="col passo passo-atual active" data-target="#carrossel-passos" data-slide-to="0"><span class="passo-num-txt"><span class="passo-num">1</span><br><span class="passo-txt">Matrícula</span></span></div>
            <div class="col passo" data-target="#carrossel-passos" data-slide-to="1"><a href="#" class="passo-num-txt"><span class="passo-num">2</span><br><span class="passo-txt">Nome</span></a></div>
            <div class="col passo" data-target="" data-slide-to="2"><a href="#" class="passo-num-txt"><span class="passo-num">3</span><br><span class="passo-txt">Nacionalidade</span></a></div>
            <div class="col passo" data-target="" data-slide-to="3"><a href="#" class="passo-num-txt"><span class="passo-num">4</span><br><span class="passo-txt">Profissão</span></a></div>
            <div class="col passo" data-target="" data-slide-to="4"><a href="#" class="passo-num-txt"><span class="passo-num">5</span><br><span class="passo-txt">Filiação</span></a></div>
            <div class="col passo" data-target="" data-slide-to="5"><a href="#" class="passo-num-txt"><span class="passo-num">6</span><br><span class="passo-txt">Proponente</span></a></div>
            <div class="col-auto passo" data-target="" data-slide-to="6"><a href="#" class="passo-num-txt"><span class="passo-num">7</span><br><span class="passo-txt">Outros</span></a></div>
          </h3>
          <div class="carousel-inner">
            <div class="carousel-item">
              <div class="col-12">
                <div class="card card-body">
                  <div class="form-group col-12">
                    <label for="matricula">Número da Matrícula: </label>
                    <input type="text" class="form-control" id="matricula" aria-describedby="matricula">
                  </div>
                  <div class="d-flex">
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="tipoFichaRadios" id="fichaPropria" value="option1">
                      <label class="form-check-label" for="fichaPropria">Ficha Própria</label>
                    </div>
                    <div class="form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="tipoFichaRadios" id="fichaSegundoUsu" value="option2">
                      <label class="form-check-label" for="fichaSegundoUsu">Ficha Segundo Usuário (herdeiro, viúvo/a…)</label>
                    </div>
                  </div>
                </div> 
              </div>
              <div class="col-12 d-flex">                    
                <a class="btn btn-primary ml-auto btn-salvar-passo" href="#" role="button">
                  Salvar
                </a>
                <a class="btn btn-primary disabled btn-proximo-passo" href="#carrossel-passos" role="button" data-slide="next">
                  Continuar »
                </a>
              </div>
            </div>
            <div class="carousel-item active">
              <div class="col-12">
                <div class="card card-body">                  
                  <h4 class="col-12">Matrícula: 1234<span class="float-right">ficha própria</span></h4>
                  <div class="form-group col-12">
                    <label for="sobrenome">Último Sobrenome:</label>                   
                    <input type="text" class="form-control" id="sobrenome">
                  </div>
                  <div class="form-group col-12">
                    <label for="nome">Nome (pré-nome, nome do meio… ex.: Albert Israel; Helga Sara):</label>
                    <input type="text" class="form-control" id="nome">
                  </div>
                  <div class="d-flex">
                    <div class="form-group form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="sexo" id="masc" value="option1">
                      <label class="form-check-label" for="masc">Masculino</label>
                    </div>
                    <div class="form-group form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="sexo" id="fem" value="option2">
                      <label class="form-check-label" for="fem">Feminino</label>
                    </div>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="form-group col-5">
                      <input class="form-check-input" type="radio" name="dataIdade" id="dataNascRadio" value="option2">
                      <label for="dataNasc">Data de Nascimento:</label>                   
                      <input type="date" class="form-control" id="dataNasc">
                    </div>
                    <div class="col-auto">ou</div>
                    <div class="form-group col-5">
                      <input class="form-check-input" type="radio" name="dataIdade" id="idaderadio" value="option2">
                      <label for="idade">Idade:</label>                   
                      <input type="text" class="form-control" id="idade">
                    </div>
                  </div>
                  <div class="d-flex align-items-center">
                    <div class="col-6">
                      <div class="card card-body col-12 card-atencao">
                        O pai dele é um dos listados abaixo?
                        <ul>
                          <li>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="sexo" id="masc" value="option1">
                              <label class="form-check-label" for="masc">Fulano de Tal</label>
                            </div>
                          </li>
                          <li>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="sexo" id="masc" value="option1">
                              <label class="form-check-label" for="masc">Beltrano de Tal</label>
                            </div>
                          <li>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="sexo" id="masc" value="option1">
                              <label class="form-check-label" for="masc">Sicrano de Tal</label>
                            </div>
                        </ul>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="card card-body col-12 card-atencao">
                        A mãe dele é um dos listados abaixo?
                        <ul>
                          <li>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="sexo" id="masc" value="option1">
                              <label class="form-check-label" for="masc">Fulana de Tal</label>
                            </div>
                          </li>
                          <li>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="sexo" id="masc" value="option1">
                              <label class="form-check-label" for="masc">Beltrana de Tal</label>
                            </div>
                          <li>
                            <div class="form-check form-check-inline">
                              <input class="form-check-input" type="radio" name="sexo" id="masc" value="option1">
                              <label class="form-check-label" for="masc">Sicrana de Tal</label>
                            </div>
                        </ul>
                      </div>
                    </div>
                  </div>
                </div> 
              </div>
              <div class="col-12 d-flex"> 
              <a class="btn btn-primary" href="#carrossel-passos" role="button" data-slide="prev">
                    Voltar
                  </a>
                <a class="btn btn-primary ml-auto btn-salvar-passo" href="#" role="button">
                  Salvar
                </a>
                <a class="btn btn-primary disabled btn-proximo-passo" href="#carrossel-passos" role="button" data-slide="next">
                  Continuar »
                </a>
              </div>  
            </div>
            <div class="carousel-item">
              <div class="col-12">
                <div class="card card-body">
                  <h4 class="col-12">Matrícula: 1234<span class="float-right">ficha própria</span></h4>
                  <h4 class="col-12">Fulano de Tal</h4>
                  <div class="form-group col-12">
                    <label for="nacion">Nacionalidade:</label>                   
                    <input type="text" class="form-control" id="nacion">
                  </div>
                  <div class="form-group col-12">
                    <label for="natur">Naturalidade:</label>
                    <input type="text" class="form-control" id="natur">
                  </div>
                  <div class="form-group col-12">
                    <label for="estCivil">Estado civil, quando da associação [solteiro, casado, separado, viúvo):</label>
                    <input type="text" class="form-control" id="estCivil">
                  </div>
                </div> 
                <div class="col-12 no-padding d-flex">          
                  <a class="btn btn-primary" href="#carrossel-passos" role="button" data-slide="prev">
                    Voltar
                  </a>
                  <a class="btn btn-primary ml-auto btn-salvar-passo" href="#" role="button">
                    Salvar
                  </a>
                  <a class="btn btn-primary disabled btn-proximo-passo" href="#carrossel-passos" role="button" data-slide="next">
                    Continuar »
                  </a>
                </div>  
              </div>
            </div>
            <div class="carousel-item">
              <div class="col-12">
                <div class="card card-body">
                  <h4 class="col-12">Matrícula: 1234<span class="float-right">ficha própria</span></h4>
                  <h4 class="col-12">Fulano de Tal</h4>
                  <div class="form-group col-12">
                    <label for="prof">Profissão:</label>                   
                    <input type="text" class="form-control" id="prof">
                  </div>
                  <div class="form-group col-12">
                    <label for="cartId">Carteira de Identidade nº:</label>
                    <input type="text" class="form-control" id="cartId">
                  </div>
                  <div class="form-group col-12">
                    <label for="expedicao">Expedida pela Polícia de:</label>
                    <input type="text" class="form-control" id="expedicao">
                  </div>
                </div> 
                <div class="col-12 no-padding d-flex">          
                  <a class="btn btn-primary" href="#carrossel-passos" role="button" data-slide="prev">
                    Voltar
                  </a>
                  <a class="btn btn-primary ml-auto btn-salvar-passo" href="#" role="button">
                    Salvar
                  </a>
                  <a class="btn btn-primary disabled btn-proximo-passo" href="#carrossel-passos" role="button" data-slide="next">
                    Continuar »
                  </a>
                </div>  
              </div>
            </div>
            <div class="carousel-item">
              <div class="col-12">
                <div class="card card-body">
                  <h4 class="col-12">Filho 1</h4>
                  <div class="form-group col-12">
                    <label for="filho1Sobrenome">Sobrenome:</label>                   
                    <input type="text" class="form-control" id="filho1Sobrenome">
                  </div>
                  <div class="form-group col-12">
                    <label for="filho1Nome">Nome:</label>                   
                    <input type="text" class="form-control" id="filho1Nome">
                  </div>
                  <div class="d-flex">
                    <div class="form-group form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="sexoFilho1" id="mascFilho1" value="option1">
                      <label class="form-check-label" for="mascFilho1">Masculino</label>
                    </div>
                    <div class="form-group form-check form-check-inline">
                      <input class="form-check-input" type="radio" name="sexoFilho1" id="femFilho1" value="option2">
                      <label class="form-check-label" for="femFilho1">Feminino</label>
                    </div>
                  </div>
                  <div class="form-group col-5">
                    <label for="dataNascFilho1">Data de Nascimento:</label>                   
                    <input type="date" class="form-control" id="dataNascFilho1">
                  </div> 
                  <div class="col-12">
                    <button class="btn btn-primary" role="button">
                      Adicionar Filho
                    </button>
                  </div>
                </div> 
                <div class="col-12 no-padding d-flex"> 
                  <a class="btn btn-primary" href="#carrossel-passos" role="button" data-slide="prev">
                    Voltar
                  </a>
                  <a class="btn btn-primary ml-auto btn-salvar-passo" href="#" role="button">
                    Salvar
                  </a>
                  <a class="btn btn-primary disabled btn-proximo-passo" href="#carrossel-passos" role="button" data-slide="next">
                    Continuar »
                  </a>
                </div>  
              </div>
            </div>
            <div class="carousel-item">
              <div class="col-12">
                <div class="card card-body">
                  <div class="form-group col-5">
                    <label for="dataNascProp1">Data da aceitação como sócio:</label>                   
                    <input type="date" class="form-control" id="dataNascProp1">
                  </div>
                  <h4 class="col-12">Proponente 1</h4>
                  <div class="form-group col-12">
                    <label for="Prop1Sobrenome">Sobrenome:</label>                   
                    <input type="text" class="form-control" id="Prop1Sobrenome">
                  </div>
                  <div class="form-group col-12">
                    <label for="Prop1Nome">Nome:</label>                   
                    <input type="text" class="form-control" id="Prop1Nome">
                  </div>
                  <div class="col-12">
                    <button class="btn btn-primary" role="button">
                      Adicionar Proponente
                    </button>
                  </div>
                </div> 
                <div class="col-12 no-padding d-flex">  
                  <a class="btn btn-primary" href="#carrossel-passos" role="button" data-slide="prev">
                    Voltar
                  </a>
                  <a class="btn btn-primary ml-auto btn-salvar-passo" href="#" role="button">
                    Salvar
                  </a>
                  <a class="btn btn-primary disabled btn-proximo-passo" href="#carrossel-passos" role="button" data-slide="next">
                    Continuar »
                  </a>
                </div>  
              </div>
            </div>
            <div class="carousel-item">
              <div class="col-12 no-padding">
                <div class="card card-body">
                  <div class="form-group col-12">
                    <label for="destino">Destino (emigrou, separou-se, desassociou-se, deu baixa…):</label>                   
                    <input type="text" class="form-control" id="destino">
                  </div>
                  <div class="form-group col-5">
                    <label for="dataFalec">Data de falecimento:</label>                   
                    <input type="date" class="form-control" id="dataFalec">
                  </div>
                  <div class="form-group col-12">
                    <label for="Obs">Observações na ficha:</label>                   
                    <textarea class="form-control" id="Obs"></textarea>
                  </div>
                  <div class="form-group col-12">
                    <label for="ObsPesq">Observações do pesquisador:</label>                   
                    <textarea class="form-control" id="ObsPesq"></textarea>
                  </div>
                </div>
              </div> 
              <div class="col-12 no-padding d-flex">          
                <a class="btn btn-primary" href="#carrossel-passos" role="button" data-slide="prev">
                  Voltar
                </a>
                <a class="btn btn-primary ml-auto btn-salvar-passo" href="#" role="button">
                  Salvar
                </a>
                <a class="btn btn-success disabled" href="#" role="button">
                  INSERIR FICHA NO CADASTRO
                </a>
              </div>   
            </div>
          </div>
        </div>
      </form>

   <!-- </main><!-- /.container -->

<?php include 'scripts.php'; ?>
    
    </body>
</html>
