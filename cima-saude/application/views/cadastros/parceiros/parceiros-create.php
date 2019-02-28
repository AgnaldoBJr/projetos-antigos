<?php 
    $this->load->view('commons/header');
?>
<!-- Main Container -->
            <main id="main-container">
         	    <!-- Page Header -->
                <div class="content bg-gray-lighter">
                    <div class="row items-push">
                        <div class="col-sm-7">
                            <h1 class="page-heading">
                                Novo parceiro
                            </h1>
                        </div>
                    </div>
                </div>
                <!-- END Page Header -->

         	    <!-- Page Content -->
                <div class="content">
                    <!-- Dynamic Table Full -->
                    <div class="block">
                        <div class="block-content">
                            <form action="<?=base_url('c-cadastros/parceiro/salvar');?>" method="POST" id="parceiro">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="nome">Nome <span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control" type="text" name="nome" placeholder="Insira um nome" onkeyup="caps(this)">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="tipo">Tipo <span class="text-danger">*</span></label>
                                        <div class="">
                                            <select class="form-control" type="text" id="tipo" name="tipo" placeholder="Escolha uma opção...">
                                                <option value="<?=null;?>">ESCOLHA UMA OPÇÃO...</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                                <option value="CLÍNICA">CLÍNICA</option>
                                                <option value="LABORATÓRIO">LABORATÓRIO</option>
                                                <option value="MÉDICO">MÉDICO</option>
                                                <option value="DENTISTA">DENTISTA</option>
                                                <option value="FISIOTERAPEUTA/TERAPEUTA">FISIOTERAPEUTA/TERAPEUTA</option>
                                                <option value="PSICÓLOGO">PSICÓLOGO</option>
                                                <option value="NUTRICIONISTA">NUTRICIONISTA</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-md-3" style="display: none" id="cnpj">
                                        <label class="control-label" for="cnpj">CNPJ <span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control cnpj" type="text" name="cnpj" placeholder="Insira um cnpj">
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="pf" style="display: none">
                                <div class="form-group col-md-4" style="display: none" id="crm">
                                        <label class="control-label" for="identificacao">Identificação (CRM)<span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control" type="text"  name="identificacao-crm" placeholder="Ex.: CRM (Somente números)" onkeypress='return SomenteNumero(event)'>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4" style="display: none" id="cro">
                                        <label class="control-label" for="identificacao">Identificação (CRO)<span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control" type="text"  name="identificacao-cro" placeholder="Ex.: CRO (Somente números)" onkeypress='return SomenteNumero(event)'>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4" style="display: none" id="coffito">
                                        <label class="control-label" for="identificacao">Identificação (Coffito)<span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control" type="text"  name="identificacao-coffito" placeholder="Ex.: Coffito(Somente números)" onkeypress='return SomenteNumero(event)'>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4" style="display: none" id="crp">
                                        <label class="control-label" for="identificacao">Identificação (CRP) <span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control" type="text"  name="identificacao-crp" placeholder="Ex.: CRP (Somente números)" onkeypress='return SomenteNumero(event)'>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4" style="display: none" id="cfn">
                                        <label class="control-label" for="identificacao">Identificação (CFN) <span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control" type="text"  name="identificacao-cfn" placeholder="Ex.: CFN (Somente números)" onkeypress='return SomenteNumero(event)'>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class=" control-label" for="rg">RG <span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control" type="text" id="rg" name="rg" placeholder="Ex.: 999999999" value="<?= $this->input->post('rg');?>">
                                        </div>
                                        
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="control-label" for="cpf">CPF <span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control cpf" type="text" id="cpf" name="cpf" placeholder="Ex.: 999.999.999-99" value="<?= $this->input->post('cpf');?>">
                                        </div>

                                    </div>                            
                                </div>
                                <div id="especialidades" style="display: none">
                                    <div class="block-header" style="margin-left: -20px; color:#bbb">
                                        <h3 class="block-title">Especialidades</h3>
                                    </div>
                                    <div class="row">
                                        <div class="form-group">
                                            <div class="col-md-3">
                                                <select class="form-control" type="text" id="especialidade1" name="especialidade1" placeholder="Escolha uma opção...">
                                                    <option value="<?=null;?>">ESCOLHA UMA OPÇÃO...</option>
                                                    <?php

                                                    if($dataEspecialidades) foreach ($dataEspecialidades as $data){
                                                ?>
                                                    <option value="<?=$data['cod_especialidade']?>"><?=$data['nome']?></option>

                                                <?php } ?>
                                                </select>
                                            </div>
                                        </div>   
                                    </div>
                                </div>

<br>
    <div class="block-header" style="margin-left: -20px; color:#bbb">
        <h3 class="block-title">Endereço</h3>
    </div>
                                 <?php /*
    FORMULÁRIO ENDEREÇO

    Campos
    Logradouro* | Número* | Bairro* | Complemento
    Bairro* | Cidade* | Estado*

    */
    ?>
    <div class="row">
        <div class="form-group col-md-4">
            <label class="control-label" for="endereco-logradouro">Logradouro<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="endereco-logradouro" name="endereco-logradouro" placeholder="Ex.: Rua, Av., Travessa..." value="<?= $this->input->post('endereco-logradouro');?>" onkeyup="caps(this)">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('endereco-logradouro')?></div>
        </div>
        <div class="form-group col-md-2">
            <label class=" control-label" for="endereco-numero">Número<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="endereco-numero" name="endereco-numero" placeholder="Ex.: 999" value="<?= $this->input->post('endereco-numero');?>" onkeypress='return SomenteNumero(event)'>
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('endereco-numero')?></div>
        </div>
        <div class="form-group col-md-3">
            <label class="control-label" for="endereco-bairro">Bairro<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="endereco-bairro" name="endereco-bairro" placeholder="Insira um bairro" value="<?= $this->input->post('endereco-bairro');?>" onkeyup="caps(this)">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('endereco-bairro')?></div>
        </div>
        <div class="form-group col-md-3">
            <label class="control-label" for="endereco-complemento">Complemento</label>
            <div class="">
                <input class="form-control" type="text" id="endereco-complemento" name="endereco-complemento" placeholder="" value="<?= $this->input->post('endereco-complemento');?>" onkeyup="caps(this)"> 
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label class="control-label" for="endereco-cep">CEP<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control cep" type="text" id="endereco-cep" name="endereco-cep" placeholder="Ex.: 99999-999" value="<?= $this->input->post('endereco-cep');?>">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('endereco-cep')?></div>
        </div>
        <div class="form-group col-md-4">
            <label class=" control-label" for="endereco-cidade">Cidade<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="endereco-cidade" name="endereco-cidade" placeholder="Insira uma cidade" value="<?= $this->input->post('endereco-cidade');?>" onkeyup="caps(this)">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('endereco-cidade')?></div>
        </div>
        <div class="form-group col-md-2">
            <label class="control-label" for="endereco-estado">Estado<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="endereco-estado" name="endereco-estado" placeholder="" value="<?= $this->input->post('endereco-estado');?>" onkeyup="caps(this)">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('endereco-estado')?></div>
        </div>  
    </div>




    <div class="block-header" style="margin-left: -20px; color:#bbb">
        <h3 class="block-title">Contato</h3>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label class="control-label " for="telefone">Telefone <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control fone" type="text" id="telefone" name="telefone" placeholder="(99) 9999-9999" value="<?= $this->input->post('telefone');?>">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('telefone')?></div>
        </div>
        <div class="form-group col-md-4">
            <label class=" control-label " for="celular">Celular <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control celular" type="text" id="celular" name="celular" placeholder="(99) 99999-9999" value="<?= $this->input->post('celular');?>">
            </div>
             <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('celular')?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="control-label" for="email">E-mail <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="email" name="email" placeholder="Insira um e-mail válido" value="<?= $this->input->post('email');?>">
            </div>
             <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('email')?></div>
        </div>
    </div>
    <div class="block-header" style="margin-left: -20px; color:#bbb">
        <h3 class="block-title">Acesso</h3>
    </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="control-label" for="usuario">Usuário <span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control" type="text" name="usuario" placeholder="Insira um nome de usuário">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="control-label" for="senha">Senha <span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control" type="password" name="senha" placeholder="Insira uma senha">
                                        </div>
                                    </div>
                                </div>

    <div class="block-header" style="margin-left: -20px; color:#bbb">
        <h3 class="block-title">Serviços</h3>
    </div>
    

    <div class="block-header" style="margin-left: -20px; color:#bbb">
        <h3 class="block-title">Ações</h3>
    </div>
    <div class="row">


        <div class="form-group col-md-3" style="margin-left: 20px" >
            <label class="checkbox">
                <input type="checkbox" name="imprimir" value="1"> Imprimir contrato
            </label>
            <label class="checkbox">
                <input type="checkbox" name="enviarEmail" id="emailCheck" value="1"> Enviar por e-mail
            </label>
            
        </div>
    </div>







                                <div class="row">
                                    <div class="form-group">
                                        <input type="submit" name="salvar" class="btn btn-sm btn-primary" style="float: right; margin-right: 20px; margin-bottom: 20px; " value="Salvar"></input>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END Dynamic Table Full -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script type="text/javascript">
   //var s = <?//=$s?>;
   var items = document.getElementById('tipo');
    items.addEventListener('change', function(){
    console.log("O indice é: " + items.selectedIndex);
    //console.log("O texto é: " + items.options[items.selectedIndex].text);
    //console.log("A chave é: " + items.options[items.selectedIndex].value);
    
    //console.log(s[0].nome);
    //console.log(s);

    if(items.selectedIndex == 0){//escolha uma opção
        document.getElementById("cnpj").style.display = 'none';
        document.getElementById("crm").style.display = 'none';
        document.getElementById("cro").style.display = 'none';
        document.getElementById("coffito").style.display = 'none';
        document.getElementById("crp").style.display = 'none';
        document.getElementById("cfn").style.display = 'none';
        document.getElementById("pf").style.display = 'none';
        document.getElementById("especialidades").style.display = 'none';
        
    }
    else if(items.selectedIndex == 1){//cnpj
        document.getElementById("cnpj").style.display = 'block';
        document.getElementById("crm").style.display = 'none';
        document.getElementById("cro").style.display = 'none';
        document.getElementById("coffito").style.display = 'none';
        document.getElementById("crp").style.display = 'none';
        document.getElementById("cfn").style.display = 'none';
        document.getElementById("pf").style.display = 'none';
        document.getElementById("especialidades").style.display = 'none';
    }
    else if(items.selectedIndex == 2){//cnpj
        document.getElementById("cnpj").style.display = 'block';
        document.getElementById("crm").style.display = 'none';
        document.getElementById("cro").style.display = 'none';
        document.getElementById("coffito").style.display = 'none';
        document.getElementById("crp").style.display = 'none';
        document.getElementById("cfn").style.display = 'none';
        document.getElementById("pf").style.display = 'none';
        document.getElementById("especialidades").style.display = 'none';
    }
    else if(items.selectedIndex == 3){//médico
        document.getElementById("cnpj").style.display = 'none';
        document.getElementById("crm").style.display = 'block';
        document.getElementById("cro").style.display = 'none';
        document.getElementById("coffito").style.display = 'none';
        document.getElementById("crp").style.display = 'none';
        document.getElementById("cfn").style.display = 'none';
        document.getElementById("pf").style.display = 'block';
        document.getElementById("especialidades").style.display = 'block';
    } 
    else if(items.selectedIndex == 4){//dentista
        document.getElementById("cnpj").style.display = 'none';
        document.getElementById("crm").style.display = 'none';
        document.getElementById("cro").style.display = 'block';
        document.getElementById("coffito").style.display = 'none';
        document.getElementById("crp").style.display = 'none';
        document.getElementById("cfn").style.display = 'none';
        document.getElementById("pf").style.display = 'block';
        document.getElementById("especialidades").style.display = 'block';
    }
    else if(items.selectedIndex == 5){//fisioterapeuta e terapeuta ocupacional
        document.getElementById("cnpj").style.display = 'none';
        document.getElementById("crm").style.display = 'none';
        document.getElementById("cro").style.display = 'none';
        document.getElementById("coffito").style.display = 'block';
        document.getElementById("crp").style.display = 'none';
        document.getElementById("cfn").style.display = 'none';
        document.getElementById("pf").style.display = 'block';
        document.getElementById("especialidades").style.display = 'block';
    } 
    else if(items.selectedIndex == 6){//psicologo
        document.getElementById("cnpj").style.display = 'none';
        document.getElementById("crm").style.display = 'none';
        document.getElementById("cro").style.display = 'none';
        document.getElementById("coffito").style.display = 'none';
        document.getElementById("crp").style.display = 'block';
        document.getElementById("cfn").style.display = 'none';
        document.getElementById("pf").style.display = 'block';
        document.getElementById("especialidades").style.display = 'block';
    } 
    else if(items.selectedIndex == 7){//nutricionista
        document.getElementById("cnpj").style.display = 'none';
        document.getElementById("crm").style.display = 'none';
        document.getElementById("cro").style.display = 'none';
        document.getElementById("coffito").style.display = 'none';
        document.getElementById("crp").style.display = 'none';
        document.getElementById("cfn").style.display = 'block';
        document.getElementById("pf").style.display = 'block';
        document.getElementById("especialidades").style.display = 'block';
    } 
});
</script>


<?php $this->load->view('commons/footer');?>
<script type="text/javascript">
//linha para usar a biblioteca Jquery
    $().ready(function() {
        //utiliza o formulário escolhido por ID
    
        $('#parceiro').validate({
            // FAZ A VALIDAÇÃO EM TEMPO REAL"
            onkeyup: function(element) {
                this.element(element);
            },
        

            //objeto com duas propriedades rules e messages
            rules: {
                'nome' : {
                    required : true,
                    //dateBR : true 
                },
            
                'tipo': {
                    required : true,
                    //dateBR : true 
                },

                // 'cnpj': {
                //    required : true,
                    //dateBR : true 
                //},

                // 'cpf': {
                //    required : true,
                //    cpfBR : true 
                //},

                // 'rg': {
                //    required : true,
                    //dateBR : true 
                //},

                 'identificacao': {
                    required : true,
                    //dateBR : true 
                },

                'endereco-logradouro' : {
                    required : true,
                    //dateBR : true 
                },

                'endereco-numero' : {
                    required : true,
                    //dateBR : true 
                },

                'endereco-bairro' : {
                    required : true,
                    //dateBR : true 
                },
            
                'endereco-cidade': {
                    required : true,
                    //dateBR : true 
                },

                'endereco-estado' : {
                    required : true,
                    //dateBR : true 
                },

                'endereco-cep' : {
                    required : true,
                    //dateBR : true 
                },

                'endereco-bairro' : {
                    required : true,
                    //dateBR : true 
                },
            
                'telefone': {
                    required : true,
                    //dateBR : true 
                },

                'celular' : {
                    required : true,
                    //dateBR : true 
                },
            
                'email': {
                    required : true,
                    //dateBR : true 
                },

                'usuario' : {
                    required : true,
                    //dateBR : true 
                },

                'senha' : {
                    required : true,
                    //dateBR : true 
                },


                'serv_desconto' : {
                    range : [0, 100],
                },


                'serv_acrescimo' : {
                    range : [0, 100],
                },
    
            },

            messages: {
               
                'nome' : {
                    required : "Campo Obrigatório!",
                    //dateBR : "Data inválida" 
                },

                'tipo' : {
                    required : "Escolha uma opção",
                    //dateBR : "Data inválida" 
                },

                //'cnpj' : {
                //    required : "Campo Obrigatório!",
                    //dateBR : "Data inválida" 
               // },

                //'cpf' : {
                //    required : "Campo Obrigatório!",
                    //dateBR : "Data inválida" 
                //},

                //'rg' : {
                //    required : "Campo Obrigatório!",
                    //dateBR : "Data inválida" 
                //},
                'identificacao' : {
                    required : "Campo Obrigatório!",
                    //dateBR : "Data inválida" 
                },

                 'endereco-logradouro' : {
                    required : "Campo Obrigatório!",
                    //dateBR : true 
                },

                'endereco-numero' : {
                    required : "Campo Obrigatório!",
                    //dateBR : true 
                },

                'endereco-bairro' : {
                    required : "Campo Obrigatório!",
                    //dateBR : true 
                },
            
                'endereco-cidade': {
                    required : "Campo Obrigatório!",
                    //dateBR : true 
                },

                'endereco-estado' : {
                    required : "Campo Obrigatório!",
                    //dateBR : true 
                },

                'endereco-cep' : {
                    required : "Campo Obrigatório!",
                    //dateBR : true 
                },

                'endereco-bairro' : {
                    required : "Campo Obrigatório!",
                    //dateBR : true 
                },
            
                'telefone': {
                    required : "Campo Obrigatório!",
                    //dateBR : true 
                },

                'celular' : {
                    required : "Campo Obrigatório!",
                    //dateBR : true 
                },
            
                'email': {
                    required : "Campo Obrigatório!",
                    //dateBR : true 
                },

                'usuario' : {
                    required : "Campo Obrigatório!",
                    //dateBR : "Data inválida" 
                },
                
                'senha' : {
                    required : "Campo Obrigatório!",
                    //dateBR : "Data inválida" 
                },


                'serv_desconto' : {
                    range : 'O valor deve estar entre 0 e 100',
                },

                
                'serv_acrescimo' : {
                    range : 'O valor deve estar entre 0 e 100',
                },
                
            }

        });
        
        
    });

 /*
 * Brazillian CPF number (Cadastrado de Pessoas Físicas) is the equivalent of a Brazilian tax registration number.
 * CPF numbers have 11 digits in total: 9 numbers followed by 2 check numbers that are being used for validation.
 */
$.validator.addMethod("cpfBR", function(value) {
  if(value == "") return true;
  // Removing special characters from value
  value = value.replace(/([~!@#$%^&*()_+=`{}\[\]\-|\\:;'<>,.\/? ])+/g, "");

  // Checking value to have 11 digits only
  if (value.length !== 11) {
    return false;
  }

  var sum = 0,
    firstCN, secondCN, checkResult, i;

  firstCN = parseInt(value.substring(9, 10), 10);
  secondCN = parseInt(value.substring(10, 11), 10);

  checkResult = function(sum, cn) {
    var result = (sum * 10) % 11;
    if ((result === 10) || (result === 11)) {result = 0;}
    return (result === cn);
  };

  // Checking for dump data
  if (value === "" ||
    value === "00000000000" ||
    value === "11111111111" ||
    value === "22222222222" ||
    value === "33333333333" ||
    value === "44444444444" ||
    value === "55555555555" ||
    value === "66666666666" ||
    value === "77777777777" ||
    value === "88888888888" ||
    value === "99999999999"
  ) {
    return false;
  }

  // Step 1 - using first Check Number:
  for ( i = 1; i <= 9; i++ ) {
    sum = sum + parseInt(value.substring(i - 1, i), 10) * (11 - i);
  }

  // If first Check Number (CN) is valid, move to Step 2 - using second Check Number:
  if ( checkResult(sum, firstCN) ) {
    sum = 0;
    for ( i = 1; i <= 10; i++ ) {
      sum = sum + parseInt(value.substring(i - 1, i), 10) * (12 - i);
    }
    return checkResult(sum, secondCN);
  }
  return false;

}, "Informe um cpf válido, campo obrigatório");
    
    
</script>
