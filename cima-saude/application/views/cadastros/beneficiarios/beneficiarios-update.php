
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
                                Atualizar beneficiário<br><small><b>Tipo: </b><?=$tipo_beneficiario?></small>
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
                            <form action="<?=base_url('beneficiarios/alterar');?>" method="POST">
                                <input type="hidden" name="cod" value="<?= $cod?>"/>
                                <input type="hidden" name="tab" value="<?= $tab?>"/>
                                <input type="hidden" name="tipo" value="<?= $tipo_beneficiario?>"/>
                               

<div id="pf" <?php if($tipo == '2') echo "style='display:none;'";?> >
    <div class="row">
        <div class="form-group col-md-6">
            <label class="control-label" for="cliente-nome">Nome <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="pf-nome" name="cliente-nome" placeholder="Insira um nome" value="<?= $nome;?>">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('cliente-nome')?></div>
        </div>
        <div class="form-group col-md-3">
            <label class=" control-label" for="cliente-rg">RG <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="cliente-rg" name="cliente-rg" placeholder="Ex.: 999999999" value="<?= $rg;?>">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('cliente-rg')?></div>
        </div>
        <div class="form-group col-md-3">
            <label class="control-label" for="cliente-cpf">CPF <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control cpf" type="text" id="cliente-cpf" name="cliente-cpf" placeholder="Ex.: 999.999.999-99" value="<?= $cpf;?>">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('cliente-cpf')?></div>
        </div>
        
    </div>
    <div class="row">
        <div class="form-group col-md-3">
            <label class="control-label" for="cliente-data-nasc">Data de Nasc. <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control data" type="text" id="cliente-data-nasc" name="cliente-data-nasc" placeholder="Ex.: dd/mm/aaaa" value="<?php if($tab=='1'){ echo $data_nasc;} else echo formata_data_br($data_nasc);?>">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('cliente-data-nasc')?></div>
        </div>
        <div class="form-group col-md-3">
            <label class="control-label" for="cliente-estado-civil">Estado Civil <span class="text-danger">*</span></label>
            <div class="">
                <select class="form-control" type="text" id="cliente-estado-civil" name="cliente-estado-civil" placeholder="Escolha uma opção...">
                    <option value=<?php null;?>>Escolha uma opção...</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                    <option value="1" <?php if("1" == $estado_civil) echo "selected";?>>Solteiro(a)</option>
                    <option value="2" <?php if("2" == $estado_civil) echo "selected";?>>Casado(a)</option>
                    <option value="3" <?php if("3" == $estado_civil) echo "selected";?>>União estável</option>
                    <option value="4" <?php if("4" == $estado_civil) echo "selected";?>>Divorciado(a)</option>
                    <option value="5" <?php if("5" == $estado_civil) echo "selected";?>>Viúvo(a)</option>


                </select>
                 <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('cliente-estado-civil')?></div>
            </div>
           
        </div>
        <div class="form-group col-md-4">
            <label class=" control-label" for="cliente-genero">Gênero <span class="text-danger">*</span></label>
            <div class="col-xs-12">
                <label class="radio-inline" for="pf-genero-masc">
                    <input type="radio" id="pf-genero-masc" name="cliente-genero" value="1" <?php if($sexo == 1) echo "checked";?>> Masc
                </label>
                <label class="radio-inline" for="pf-genero-fem">
                    <input type="radio" id="pf-genero-fem" name="cliente-genero" value="2" <?php if($sexo == 2) echo "checked";?>> Fem
                </label>
            </div>        
        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c; margin-top: 40px"><?=form_error('cliente-genero')?></div>
        </div>
       
    </div>

    <div class="block-header" style="margin-left: -20px; color:#bbb">
        <h3 class="block-title">Endereço</h3>
    </div>

    <?php/*
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
                <input class="form-control" type="text" id="endereco-logradouro" name="endereco-logradouro" placeholder="Ex.: Rua, Av., Travessa..." value="<?= $logradouro;?>">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('endereco-logradouro')?></div>
        </div>
        <div class="form-group col-md-2">
            <label class=" control-label" for="endereco-numero">Número<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="endereco-numero" name="endereco-numero" placeholder="Ex.: 999" value="<?= $numero?>" onkeypress='return SomenteNumero(event)'>
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('endereco-numero')?></div>
        </div>
        <div class="form-group col-md-3">
            <label class="control-label" for="endereco-bairro">Bairro<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="endereco-bairro" name="endereco-bairro" placeholder="Insira um bairro" value="<?= $bairro?>">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('endereco-bairro')?></div>
        </div>
        <div class="form-group col-md-3">
            <label class="control-label" for="endereco-complemento">Complemento</label>
            <div class="">
                <input class="form-control" type="text" id="endereco-complemento" name="endereco-complemento" placeholder="" value="<?= $complemento;?>">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label class="control-label" for="endereco-cep">CEP<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control cep" type="text" id="endereco-cep" name="endereco-cep" placeholder="Ex.: 99999-999" value="<?= $cep?>">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('endereco-cep')?></div>
        </div>
        <div class="form-group col-md-4">
            <label class=" control-label" for="endereco-cidade">Cidade<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="endereco-cidade" name="endereco-cidade" placeholder="Insira uma cidade" value="<?= $cidade?>">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('endereco-cidade')?></div>
        </div>
        <div class="form-group col-md-2">
            <label class="control-label" for="endereco-estado">Estado<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="endereco-estado" name="endereco-estado" placeholder="" value="<?= $estado?>">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('endereco-estado')?></div>
        </div>  
    </div>




    <div class="block-header" style="margin-left: -20px; color:#bbb">
        <h3 class="block-title">Contato</h3>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label class="control-label " for="cliente-telefone">Telefone <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control fone" type="text" id="cliente-telefone" name="cliente-telefone" placeholder="(99) 9999-9999" value="<?= $telefone;?>">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('cliente-telefone')?></div>
        </div>
        <div class="form-group col-md-4">
            <label class=" control-label " for="cliente-celular">Celular <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control celular" type="text" id="cliente-celular" name="cliente-celular" placeholder="(99) 99999-9999" value="<?=$celular;?>">
            </div>
             <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('cliente-celular')?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="control-label" for="cliente-email">E-mail <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="cliente-email" name="cliente-email" placeholder="Insira um e-mail válido" value="<?= $email;?>">
            </div>
             <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('cliente-email')?></div>
        </div>
    </div>

    
</div>
<script>
    function pessoaFisica(){
        
            document.getElementById("pf").style.display = 'block';
            document.getElementById("pj").style.display = 'none';
        
    }

    function pessoaJuridica(){
            document.getElementById("pj").style.display = 'block';
            document.getElementById("pf").style.display = 'none';
        
    }

    function isMedico(){
        if(document.getElementById("o-parceiro").checked == true){
            document.getElementById("o-parceiro-medico").checked = false;
            document.getElementById("o-parceiro-medico-label").style.display = 'inline-block';
        } else{
            document.getElementById("o-parceiro-medico-label").style.display = 'none';
            document.getElementById("especialidade-medica").style.display = 'none';
        }
    }

    function especialidades(){
        if(document.getElementById("o-parceiro-medico").checked == true){
            
            document.getElementById("o-parceiro-especialidade").value = '';
            document.getElementById("especialidade-medica").style.display = 'block';
        } else{
            document.getElementById("especialidade-medica").style.display = 'none';
        }
    }

    function isFornecedor(){
        if(document.getElementById("o-fornecedor").checked == true){
            document.getElementById("o-fornecedor-obs").value = '';
            document.getElementById("observacoes-fornecedor").style.display = 'block';
        } else{
            document.getElementById("observacoes-fornecedor").style.display = 'none';
        }
    }

    function isParceiro(){
        if(document.getElementById("o-fornecedor").checked == true){
            document.getElementById("o-fornecedor-obs").value = '';
            document.getElementById("observacoes-fornecedor").style.display = 'block';
        } else{
            document.getElementById("observacoes-fornecedor").style.display = 'none';
        }
    }
</script>
                            
                        

                                    <div class="row">
                                        <div class="form-group">
                                            <input type="submit" name="alterar" class="btn btn-sm btn-primary" style="float: right; margin-right: 20px; margin-bottom: 20px; " value="Alterar"></input>
                                        </div>
                                    </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END Dynamic Table Full -->
<?php $this->load->view('commons/footer');?>