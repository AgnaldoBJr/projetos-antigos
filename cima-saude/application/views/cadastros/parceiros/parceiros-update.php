
<!-- Main Container -->
            <main id="main-container">
         	    <!-- Page Header -->
                <div class="content bg-gray-lighter">
                    <div class="row items-push">
                        <div class="col-sm-7">
                            <h1 class="page-heading">
                                Atualizar parceiro
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
                            <form action="<?=base_url('c-cadastros/parceiro/alterar');?>" method="POST" id="parceiro">
                                <input type="hidden" name="cod_parceiro" value="<?php echo $cod_parceiro?>"/>
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label class="control-label" for="nome">Nome <span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control" type="text" name="nome" placeholder="Insira um nome" onkeyup="caps(this)" value="<?php echo $nome?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="tipo">Tipo <span class="text-danger">*</span></label>
                                        <div class="">
                                            <select class="form-control" type="text" id="tipo" name="tipo" placeholder="Escolha uma opção...">
                                                <option value="<?=null;?>">ESCOLHA UMA OPÇÃO...</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                                <option value="CLÍNICA" <?php if($tipo == 'CLÍNICA') echo 'selected';?>>CLÍNICA</option>
                                                <option value="LABORATÓRIO" <?php if($tipo == 'LABORATÓRIO') echo 'selected';?>>LABORATÓRIO</option>
                                                <option value="MÉDICO" <?php if($tipo == 'MÉDICO') echo 'selected';?>>MÉDICO</option>
                                                <option value="DENTISTA" <?php if($tipo == 'DENTISTA') echo 'selected';?>>DENTISTA</option>
                                                <option value="FISIOTERAPEUTA/TERAPEUTA" <?php if($tipo == 'FISIOTERAPEUTA/TERAPEUTA') echo 'selected';?>>FISIOTERAPEUTA/TERAPEUTA</option>
                                                <option value="PSICÓLOGO" <?php if($tipo == 'PSICÓLOGO') echo 'selected';?>>PSICÓLOGO</option>
                                                <option value="NUTRICIONISTA" <?php if($tipo == 'NUTRICIONISTA') echo 'selected';?>>NUTRICIONISTA</option>
                                            </select>
                                        </div>
                                    </div>
                                    
                                    <div class="form-group col-md-3" <?php if($tipo != 'CLÍNICA' && $tipo != 'LABORATÓRIO') echo 'style="display: none"'?> id="cnpj">
                                        <label class="control-label" for="cnpj">CNPJ <span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control cnpj" type="text" name="cnpj" placeholder="Insira um cnpj" value="<?= $cnpj?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row" id="pf" <?php if($tipo == 'CLÍNICA' || $tipo == 'LABORATÓRIO') echo 'style="display: none"'?>>
                                <div class="form-group col-md-4" <?php if($tipo != 'MÉDICO') echo 'style="display: none"'?> id="crm">
                                        <label class="control-label" for="identificacao">Identificação (CRM)<span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control" type="text"  name="identificacao-crm" placeholder="Ex.: CRM (Somente números)" onkeypress='return SomenteNumero(event)' value="<?= $identificacao?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4" <?php if($tipo != 'DENTISTA') echo 'style="display: none"'?> id="cro">
                                        <label class="control-label" for="identificacao">Identificação (CRO)<span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control" type="text"  name="identificacao-cro" placeholder="Ex.: CRO (Somente números)" onkeypress='return SomenteNumero(event)' value="<?= $identificacao?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4" <?php if($tipo != 'FISIOTERAPEUTA/TERAPEUTA') echo 'style="display: none"'?> id="coffito">
                                        <label class="control-label" for="identificacao">Identificação (Coffito)<span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control" type="text"  name="identificacao-coffito" placeholder="Ex.: Coffito(Somente números)" onkeypress='return SomenteNumero(event)' value="<?= $identificacao?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4" <?php if($tipo != 'PSICÓLOGO') echo 'style="display: none"'?> id="crp">
                                        <label class="control-label" for="identificacao">Identificação (CRP) <span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control" type="text"  name="identificacao-crp" placeholder="Ex.: CRP (Somente números)" onkeypress='return SomenteNumero(event)' value="<?= $identificacao?>">
                                        </div>
                                    </div>

                                    <div class="form-group col-md-4"  <?php if($tipo != 'NUTRICIONISTA') echo 'style="display: none"'?> id="cfn">
                                        <label class="control-label" for="identificacao">Identificação (CFN) <span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control" type="text"  name="identificacao-cfn" placeholder="Ex.: CFN (Somente números)" onkeypress='return SomenteNumero(event)' value="<?= $identificacao?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class=" control-label" for="rg">RG <span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control" type="text" id="rg" name="rg" placeholder="Ex.: 999999999" value="<?= $rg?>">
                                        </div>
                                        
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="control-label" for="cpf">CPF <span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control cpf" type="text" id="cpf" name="cpf" placeholder="Ex.: 999.999.999-99" value="<?= $cpf?>">
                                        </div>

                                    </div>                            
                                </div>
                                <div id="especialidades" <?php if($tipo == 'CLÍNICA' || $tipo == 'LABORATÓRIO') echo 'style="display: none"'?>>
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
                                                    <option value="<?=$data['cod_especialidade']?>" <?php if($especialidade[0] == $data['cod_especialidade']) echo 'selected'?>><?=$data['nome']?></option>

                                                <?php } ?>
                                                </select>
                                            </div>
                                        </div>
                                    </div>

                                    
                                </div>
                                
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
            <label class="control-label" for="logradouro">Logradouro<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="logradouro" name="endereco-logradouro" placeholder="Ex.: Rua, Av., Travessa..." value="<?php echo $logradouro?>">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('logradouro')?></div>
        </div>
        <div class="form-group col-md-2">
            <label class=" control-label" for="numero">Número<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="numero" name="endereco-numero" placeholder="Ex.: 999" value="<?php echo $numero?>" onkeypress='return SomenteNumero(event)'>
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('numero')?></div>
        </div>
        <div class="form-group col-md-3">
            <label class="control-label" for="bairro">Bairro<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="bairro" name="endereco-bairro" placeholder="Insira um bairro" value="<?php echo $bairro?>">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('bairro')?></div>
        </div>
        <div class="form-group col-md-3">
            <label class="control-label" for="complemento">Complemento</label>
            <div class="">
                <input class="form-control" type="text" id="complemento" name="endereco-complemento" placeholder="" value="<?php echo $complemento?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label class="control-label" for="cep">CEP<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control cep" type="text" id="cep" name="endereco-cep" placeholder="Ex.: 99999-999" value="<?php echo $cep?>">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('cep')?></div>
        </div>
        <div class="form-group col-md-4">
            <label class=" control-label" for="cidade">Cidade<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="cidade" name="endereco-cidade" placeholder="Insira uma cidade" value="<?php echo $cidade?>">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('cidade')?></div>
        </div>
        <div class="form-group col-md-2">
            <label class="control-label" for="estado">Estado<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="estado" name="endereco-estado" placeholder="" value="<?php echo $estado?>">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('estado')?></div>
        </div>  
    </div>




    <div class="block-header" style="margin-left: -20px; color:#bbb">
        <h3 class="block-title">Contato</h3>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label class="control-label " for="telefone">Telefone <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control fone" type="text" id="telefone" name="telefone" placeholder="(99) 9999-9999" value="<?php echo $telefone?>">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('telefone')?></div>
        </div>
        <div class="form-group col-md-4">
            <label class=" control-label " for="celular">Celular <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control celular" type="text" id="celular" name="celular" placeholder="(99) 99999-9999" value="<?php echo $celular?>">
            </div>
             <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('celular')?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="control-label" for="email">E-mail <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="email" name="email" placeholder="Insira um e-mail válido" value="<?php echo $email?>"">
            </div>
             <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('email')?></div>
        </div>
    </div>
    <div class="block-header" style="margin-left: -20px; color:#bbb">
        <h3 class="block-title">Acesso</h3>
    </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="control-label" for="nome_usuario">Usuário <span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control" type="text" name="usuario" placeholder="Insira um nome de usuário" value="<?php echo $nome_usuario?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="control-label" for="senha">Senha <span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control" type="password" name="senha" placeholder="Insira uma senha" value="<?php echo $senha?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group">
                                        <button type="submit" class="btn btn-sm btn-primary" style="float: right; margin-right: 20px; margin-bottom: 20px;">Alterar</button>

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
                
            }

        });
    });

</script>