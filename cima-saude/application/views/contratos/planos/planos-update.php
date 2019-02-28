<?php 
    $this->load->view('commons/header');
    $this->load->helper('funcoes');

?>
<!-- Main Container -->
            <main id="main-container">
         	    <!-- Page Header -->
                <div class="content bg-gray-lighter">
                    <div class="row items-push">
                        <div class="col-sm-7">
                            <h1 class="page-heading">
                                Atualizar plano
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
                            <form action="<?=base_url('c-contratos/plano/alterar');?>" method="POST">
                                <input type="hidden" name="cod_plano" value="<?php echo $cod_plano?>"/>
                                
                                <!--INSIRA O FORMULÁRIO DE ALTERAÇÃO-->
                                <div class="row">
    <div class="form-group col-md-6">
        <label class="control-label" for="plano-nome">Nome <span class="text-danger">*</span></label>
        <div class="">
            <input class="form-control" type="text" id="plano-nome" name="plano-nome" placeholder="Insira um nome para o novo plano" value="<?php if($this->input->post('plano-nome') != null) echo $this->input->post('plano-nome'); else echo $nome?>">
        </div>
        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('plano-nome')?></div>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-12">
        <label for="plano-descricao">Descrição</label>
        <div>
            <textarea class="form-control" id="plano-descricao" name="plano-descricao" rows="4" placeholder="Insira alguma descrição para o plano, essa descrição é somente para uso de vendas!"><?php if($this->input->post('plano-descricao') != null) echo $this->input->post('plano-descricao'); else echo $descricao?></textarea>
        </div>
        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('plano-descricao')?></div>
    </div>
</div>
<div class="block-header" style="margin-left: -20px; color:#bbb">
    <h3 class="block-title">Características</h3>
    <br>
</div>
<div class="row">
    <div class="form-group col-xs-12 col-md-6">
        <h5 class="font-w400">Neste plano, será permitido adicionar:</h5>
        <label class="checkbox-inline" for="plano-dependentes">
            <input type="checkbox" id="plano-dependentes" name="plano-dependentes" value="1" <?php if($this->input->post('plano-dependentes') == 1 || $dependentes == 1) echo "checked";?>> Dependentes
        </label>
        <label class="checkbox-inline" for="plano-agregados" onclick="hasAgregados()">
            <input type="checkbox" id="plano-agregados" name="plano-agregados" value="1" <?php if($this->input->post('plano-agregados') == 1 || $agregados == 1) echo "checked";?>> Agregados
        </label>
        <label class="checkbox-inline" for="plano-colaboradores" onclick="hasColaboradores()">
            <input type="checkbox" id="plano-colaboradores" name="plano-colaboradores" value="1" <?php if($this->input->post('plano-colaboradores') == 1 || $colaboradores == 1) echo "checked";?>>Colaboradores (para empresas)
        </label>
    </div>
</div>
<div class="row">    
    <div class="form-group col-md-3" id="agregados" <?php if($this->input->post('plano-agregados') != null || $agregados == 1) echo 'style="display:block;'; else echo 'style="display:none;' ?>">
        <label class="control-label" for="plano-adicional-agregados">Adicional por agregado (R$)</label>
        <div class="">
            <input class="form-control valor" type="text" id="plano-adicional-agregados" name="plano-adicional-agregados" placeholder="Ex.: 50,00" value="<?php if($this->input->post('plano-adicional-agregados') != null) echo $this->input->post('plano-adicional-agregados'); else echo $adicional_agregados;?>">
        </div>
        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('plano-adicional-agregados')?></div>
    </div>

    <div class="form-group col-md-3" id="colaboradores" <?php if($this->input->post('plano-colaboradores') != null || $colaboradores == 1) echo 'style="display:block;'; else echo 'style="display:none;' ?>">
        <label class="control-label" for="plano-adicional-colaboradores">Adicional por colaborador (R$)</label>
        <div class="">
            <input class="form-control valor" type="text" id="plano-adicional-colaboradores" name="plano-adicional-colaboradores" placeholder="Ex.: 50,00" value="<?php if($this->input->post('plano-adicional-colaboradores') != null) echo $this->input->post('plano-adicional-colaboradores'); else echo $adicional_colaboradores; ;?>">
        </div>
        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('plano-adicional-colaboradores')?></div>
    </div>

</div>
<div class="row">
    <div class="form-group col-md-3">
        <label class="control-label" for="plano-valor">Valor (R$)</label>
        <div class="">
            <input class="form-control valor" type="text" id="plano-valor" name="plano-valor" placeholder="Ex. 500,00" value="<?php if($this->input->post('plano-valor') != null) echo $this->input->post('plano-valor'); else echo formata_preco($valor)?>">
        </div>
        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('plano-valor')?></div>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-3">
            <label class="control-label" for="plano-validade">Validade do Contrato <span class="text-danger">*</span></label>
            <div class="">
                <select class="form-control" type="text" id="plano-validade" name="plano-validade" placeholder="Escolha uma opção...">
                    <option value=<?php null;?>>Escolha uma opção...</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                    <option value="1" <?php if("1" == $validade) echo "selected";?>>6 meses</option>
                    <option value="2" <?php if("2" == $validade) echo "selected";?>>1 ano</option>
                    <option value="3" <?php if("3" == $validade) echo "selected";?>>2 anos</option>
                    <option value="4" <?php if("4" == $validade) echo "selected";?>>3 anos</option>
                   
                </select>
                <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('plano-validade')?></div>
            </div>
           
        </div>
</div>
<div class="row">
    <div class="form-group col-md-6">
        <label for="plano-observacoes">Observações</label>
        <div>
            <textarea class="form-control" id="plano-observacoes" name="plano-observacoes" rows="2" placeholder="Insira alguma descrição para o plano"><?php if($this->input->post('plano-observacoes') != null) echo $this->input->post('plano-observacoes'); else echo $observacoes?></textarea>
        </div>
        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('plano-observacoes')?></div>
    </div>
</div>

<script>
    function hasAgregados(){
        if(document.getElementById("plano-agregados").checked == true){
            document.getElementById("agregados").style.display = 'block';
        } else{
            document.getElementById("agregados").style.display = 'none';
        }        
    }


    function hasColaboradores(){
        if(document.getElementById("plano-colaboradores").checked == true){
            document.getElementById("colaboradores").style.display = 'block';
        } else{
            document.getElementById("colaboradores").style.display = 'none';
        }        
    }

</script>




                        
                                <!--FIM DO FORM DE ALTERAÇÂO-->    
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