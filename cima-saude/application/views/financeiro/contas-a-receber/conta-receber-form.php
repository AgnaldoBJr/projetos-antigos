
<div class="row">
	<div class="form-group col-md-6">
	    <label class="control-label" for="c-receber-descricao">Descrição <span class="text-danger">*</span></label>
	   	<div class="">
			<input class="form-control" type="text" id="c-receber-descricao" name="c-receber-descricao" placeholder="Insira uma descrição para a conta" value="<?= $this->input->post('c-receber-descricao');?>" onkeyup="caps(this)">
		</div>
		<div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('c-receber-descricao')?></div>
	</div>
	<div class="form-group col-md-3">
	    <label class="control-label" for="c-receber-cliente">Clientes </label>
	   	<div class="">
			<select class="form-control" type="text" id="c-receber-cliente" name="c-receber-cliente" placeholder="Escolha uma opção...">
				<option value=<?php null;?>>Escolha uma opção...</option>
				<?php
					if($dataCliente != false)
                    if($dataCliente) foreach ($dataCliente as $data){
                ?>
                    <option value="<?=$data['cod_cliente']?>" <?php if($data['cod_cliente'] == $this->input->post('c-receber-cliente')) echo "selected";?>><?=$data['nome']?></option>

                <?php }?>
			</select>
			<div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('c-receber-cliente')?></div>
		</div>
	</div>
	
	<div class="form-group col-md-3">
	    <label class="control-label" for="c-receber-categoria">Categoria </label>
	   	<div class="">
			<select class="form-control" type="text" id="c-receber-categoria" name="c-receber-categoria" placeholder="Escolha uma opção...">
				<option value=<?php null;?>>Escolha uma opção...</option>
				<?php
				
					if($dataCategoria != false)
                    if($dataCategoria) foreach ($dataCategoria as $data){

                ?>
                    <option value="<?=$data['cod_cat_conta_a_receber']?>" <?php if($data['cod_cat_conta_a_receber'] == $this->input->post('c-receber-categoria')) echo "selected";?>><?=$data['nome']?></option>

                <?php } ?>
			</select>
			<div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('c-receber-categoria')?></div>
		</div>
	</div>
</div>
<div class="row">
	<div class="form-group col-md-3">
	    <label class="control-label" for="c-receber-valor">Valor (R$)<span class="text-danger">*</span></label>
	   	<div class="">
			<input class="form-control valor" type="text" id="c-receber-valor" name="c-receber-valor" placeholder="Ex.: R$ 99,99" value="<?= $this->input->post('c-receber-valor');?>">
		</div>
		<div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('c-receber-valor')?></div>
	</div>
	<div class="form-group col-md-3">
	    <label class="control-label" for="c-receber-data">Data de recebimento <span class="text-danger">*</span></label>
	   	<div class="">
			<input class="form-control data" type="text" id="c-receber-data" name="c-receber-data" placeholder="Ex.: dd/mm/aaaa" value="<?= $this->input->post('c-receber-data');?>">
		</div>
		<div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('c-receber-data')?></div>
	</div>
	<div class="form-group col-md-3">
	    <label class=" control-label" for="c-receber-status">Status <span class="text-danger">*</span></label>
		<div class="col-xs-12">
            <label class="radio-inline" for="c-receber-status-1">
                <input type="radio" id="c-receber-status-1" name="c-receber-status" value="1" <?php if($this->input->post('c-receber-status') == 1) echo "checked";?>> À receber
            </label>
            <label class="radio-inline" for="c-receber-status-2">
                <input type="radio" id="c-receber-status-2" name="c-receber-status" value="2" <?php if($this->input->post('c-receber-status') == 2) echo "checked";?>> Recebido
            </label>
        </div>
         <div class="help-block text-right animated fadeInDown" style="color: #d26a5c; margin-top: 40px"><?=form_error('c-receber-status')?></div>
	</div>

	<div class="form-group col-md-3">
	    <label class="control-label" for="c-receber-conta">Conta </label>
	   	<div class="">
			<select class="form-control" type="text" id="c-receber-conta" name="c-receber-conta" placeholder="Escolha uma opção...">
				<option value=<?php null;?>>Escolha uma opção...</option>
				<?php
					if($dataConta != false)
                    if($dataConta) foreach ($dataConta as $data){
                ?>
                    <option value="<?=$data['cod_conta']?>" <?php if($data['cod_conta'] == $this->input->post('c-pagar-conta')) echo "selected";?>><?=$data['nome']?></option>

                <?php }?>
			</select>
		</div>
		<div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('c-receber-conta')?></div>
	</div>
</div>
<div class="row">
	<div class="form-group col-md-12">
        <label class="control-label" for="c-receber-observacoes">Observações</label>
        <div class="">
            <textarea class="form-control" id="c-receber-observacoes" name="c-receber-observacoes" rows="2" placeholder="Insira alguma observção desejada" onkeyup="caps(this)"><?= $this->input->post('c-receber-observacoes');?></textarea>
        </div>
    </div>
</div>
<div class="row">
	<div class="form-group col-xs-12 col-md-4">
        <label class="checkbox-inline" for="c-receber-repetir" onclick="repeat()">
            <input type="checkbox" id="c-receber-repetir" name="c-receber-repetir" value="1" <?php if($this->input->post('c-receber-repetir') == '1') echo 'checked';?>> Repetir
        </label>
    </div>
</div>
<div class="row" id="repetir"   <?php if($this->input->post('c-receber-repetir') != '1') echo 'style="display: none;"';?>>
	<div class="form-group col-md-3">
	    <label class="control-label" for="c-receber-quantidade">Quantidade de Parcelas <span class="text-danger">*</span></label>
	   	<div class="">
			<input class="form-control" type="text" id="c-receber-quantidade" name="c-receber-quantidade" placeholder="Insira a qtd de parcelas" value="<?= $this->input->post('c-receber-quantidade');?>">
		</div>
		<div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('c-receber-quantidade')?></div>
	</div>
	<div class="form-group col-md-3">
	    <label class="control-label" for="c-receber-intervalo">Intervalo de Tempo<span class="text-danger">*</span></label>
	   	<div class="">
			<select class="form-control" type="text" id="c-receber-intervalo" name="c-receber-intervalo" placeholder="Escolha uma opção...">
				<!--<option value=<?//php null;?>>Escolha uma opção...</option>--><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                <option value="1" <?php if($this->input->post("c-receber-intervalo")==1) echo 'selected';?>>Mensal</option>
                <option value="2" <?php if($this->input->post("c-receber-intervalo")==2) echo 'selected';?>>Quinzenal</option>
                <option value="3" <?php if($this->input->post("c-receber-intervalo")==3) echo 'selected';?>>Semanal</option>
			</select>
		</div>
		<div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('c-receber-intervalo')?></div>
	</div>
</div>

<script>
	function repeat(){
		if(document.getElementById("c-receber-repetir").checked == true){
			document.getElementById("repetir").style.display = 'block';
		}
		else{
			document.getElementById("repetir").style.display = 'none';
		}
	}
</script>









	