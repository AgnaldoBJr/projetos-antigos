
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
                                Atualizar conta a pagar
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
                            <form action="<?=base_url('contas-a-pagar/alterar');?>" method="POST">
                                <input type="hidden" name="cod_conta_a_pagar" value="<?php echo $cod_conta_a_pagar?>"/>


                                <div class="row">
    <div class="form-group col-md-6">
        <label class="control-label" for="c-pagar-descricao">Descrição <span class="text-danger">*</span></label>
        <div class="">
            <input class="form-control" type="text" id="c-pagar-descricao" name="c-pagar-descricao" placeholder="Insira uma descrição para a conta" value="<?= $descricao?>" onkeyup="caps(this)">
        </div>
        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('c-pagar-descricao')?></div>
    </div>
    <div class="form-group col-md-3">
        <label class="control-label" for="c-pagar-fornecedor">Fornecedor </label>
        <div class="">
            <select class="form-control" type="text" id="c-pagar-fornecedor" name="c-pagar-fornecedor" placeholder="Escolha uma opção...">
                <option value=<?php null;?>>Escolha uma opção...</option>
                <?php
                    if($dataFornecedor != false)
                    if($dataFornecedor) foreach ($dataFornecedor as $data){
                ?>
                    <option value="<?=$data['cod_fornecedor']?>" <?php if($data['cod_fornecedor'] == $this->input->post('c-pagar-fornecedor')) echo "selected";?> <?php if($data['cod_fornecedor'] == $fk_fornecedor) echo 'selected';?> ><?=$data['nome']?></option>

                <?php }?>
            </select>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('c-pagar-fornecedor')?></div>
        </div>
    </div>
    
    <div class="form-group col-md-3">
        <label class="control-label" for="c-pagar-categoria">Categoria </label>
        <div class="">
            <select class="form-control" type="text" id="c-pagar-categoria" name="c-pagar-categoria" placeholder="Escolha uma opção...">
                <option value=<?php null;?>>Escolha uma opção...</option>
                <?php
                    if($dataCategoria != false)
                    if($dataCategoria) foreach ($dataCategoria as $data){
                ?>
                    <option value="<?=$data['cod_cat_conta_a_pagar']?>" <?php if($data['cod_cat_conta_a_pagar'] == $this->input->post('c-pagar-categoria')) echo "selected";?> <?php if($data['cod_cat_conta_a_pagar'] == $fk_categoria) echo 'selected';?>><?=$data['nome']?></option>

                <?php }?>
            </select>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('c-pagar-categoria')?></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-3">
        <label class="control-label" for="c-pagar-valor">Valor (R$)<span class="text-danger">*</span></label>
        <div class="">
            <input class="form-control valor" type="text" id="c-pagar-valor" name="c-pagar-valor" placeholder="Ex.: R$ 99,99" value="<?= formata_preco($valor);?>">
        </div>
        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('c-pagar-valor')?></div>
    </div>
    <div class="form-group col-md-3">
        <label class="control-label" for="c-pagar-data">Data de pagamento <span class="text-danger">*</span></label>
        <div class="">
            <input class="form-control data" type="text" id="c-pagar-data" name="c-pagar-data" placeholder="Ex.: dd/mm/aaaa" value="<?= formata_data_br($dt_pagamento);?>">
        </div>
        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('c-pagar-data')?></div>
        
    </div>
    <div class="form-group col-md-3">
        <label class=" control-label" for="c-pagar-status">Status <span class="text-danger">*</span></label>
        <div class="col-xs-12">
            <label class="radio-inline" for="c-pagar-status-1">
                <input type="radio" id="c-pagar-status-1" name="c-pagar-status" value="1" <?php if($status == 1) echo "checked";?>> À pagar
            </label>
            <label class="radio-inline" for="c-pagar-status-2">
                <input type="radio" id="c-pagar-status-2" name="c-pagar-status" value="2" <?php if($status == 2) echo "checked";?>> Pago
            </label>
        </div>
        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c; margin-top: 40px"><?=form_error('c-pagar-status')?></div>
    </div>

    <div class="form-group col-md-3">
        <label class="control-label" for="c-pagar-conta">Conta </label>
        <div class="">
            <select class="form-control" type="text" id="c-pagar-conta" name="c-pagar-conta" placeholder="Escolha uma opção...">
                <option value=<?php null;?>>Escolha uma opção...</option>
                <?php
                    if($dataConta != false)
                    if($dataConta) foreach ($dataConta as $data){
                ?>
                    <option value="<?=$data['cod_conta']?>" <?php if($data['cod_conta'] == $this->input->post('c-pagar-conta')) echo "selected";?> <?php if($data['cod_conta'] == $fk_conta) echo 'selected';?>><?=$data['nome']?></option>

                <?php }?>
            </select>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('c-pagar-conta')?></div>
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group col-md-12">
        <label class="control-label" for="c-pagar-observacoes">Observações</label>
        <div class="">
            <textarea class="form-control" id="c-pagar-observacoes" name="c-pagar-observacoes" rows="2" placeholder="Insira alguma observção desejada" onkeyup="caps(this)"><?= $this->input->post('c-pagar-observacoes');?><?=$observacoes?></textarea>
        </div>
    </div>
</div>
<div class="row">
    <div class="form-group col-xs-12 col-md-4">
        <label class="checkbox-inline" for="c-pagar-repetir" onclick="repeat()">
            <input type="checkbox" id="c-pagar-repetir" name="c-pagar-repetir" value="1" <?php if($repetir == '1') echo 'checked';?>> Repetir
        </label>
    </div>
</div>
<div class="row" id="repetir" <?php if($repetir != '1') echo 'style="display: none;"';?>>
    <div class="form-group col-md-3">
        <label class="control-label" for="c-pagar-quantidade">Quantidade de Parcelas <span class="text-danger">*</span></label>
        <div class="">
            <input class="form-control" type="text" id="c-pagar-quantidade" name="c-pagar-quantidade" placeholder="Insira a qtd de parcelas" value="<?= $this->input->post('c-pagar-quantidade');?>">
        </div>
        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('c-pagar-quantidade')?></div>
    </div>
    <div class="form-group col-md-3">
        <label class="control-label" for="c-pagar-intervalo">Intervalo de Tempo<span class="text-danger">*</span></label>
        <div class="">
            <select class="form-control" type="text" id="c-pagar-intervalo" name="c-pagar-intervalo" placeholder="Escolha uma opção...">
                <!--<option value=<?//php null;?>>Escolha uma opção...</option>--><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                <option value="1" <?php if($this->input->post("c-pagar-intervalo")==1) echo 'selected';?>>Mensal</option>
                <option value="2" <?php if($this->input->post("c-pagar-intervalo")==2) echo 'selected';?>>Quinzenal</option>pagar
                <option value="3" <?php if($this->input->post("c-pagar-intervalo")==3) echo 'selected';?>>Semanal</option>
            </select>
        </div>
        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('c-pagar-intervalo')?></div>
    </div>
</div>

<script>
    function repeat(){
        if(document.getElementById("c-pagar-repetir").checked == true){
            document.getElementById("repetir").style.display = 'block';
        }
        else{
            document.getElementById("repetir").style.display = 'none';
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