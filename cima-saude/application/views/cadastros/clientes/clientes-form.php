<div class="row">
	<div class="form-group col-md-4">
	    <label class=" control-label" for="cliente-tipo">Tipo de Pessoa <span class="text-danger">*</span></label>
		<div class="col-xs-12">
            <label class="radio-inline" for="tipo-pessoa-pf">
                <input type="radio" id="tipo-pessoa-pf" name="cliente-tipo" value="1" checked="true"  <?php if($this->input->post('cliente-tipo') == 1) echo "checked";?> onclick="pessoaFisica()"> Pessoa Física
            </label>
            <label class="radio-inline" for="pf-genero-pj">
                <input type="radio" id="tipo-pessoa-pj" name="cliente-tipo" value="2"  <?php if($this->input->post('cliente-tipo') == 2) echo "checked";?> onclick="pessoaJuridica()"> Pessoa Jurídica
            </label>
        </div>
	</div>
</div>
<div id="pf" <?php if($this->input->post('cliente-tipo') == 2) echo "style='display:none;'";?> >
    <div class="row">
        <div class="form-group col-md-6">
            <label class="control-label" for="cliente-nome">Nome <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="pf-nome" name="cliente-nome" placeholder="Insira um nome" value="<?= $this->input->post('cliente-nome');?>" onkeyup="caps(this)">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('cliente-nome')?></div>
        </div>
        <div class="form-group col-md-3">
            <label class=" control-label" for="cliente-rg">RG <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="cliente-rg" name="cliente-rg" placeholder="Ex.: 999999999" value="<?= $this->input->post('cliente-rg');?>" onkeyup="caps(this)">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('cliente-rg')?></div>
        </div>
        <div class="form-group col-md-3">
            <label class="control-label" for="cliente-cpf">CPF <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control cpf" type="text" id="cliente-cpf" name="cliente-cpf" placeholder="Ex.: 999.999.999-99" value="<?= $this->input->post('cliente-cpf');?>">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('cliente-cpf')?></div>
        </div>
        
    </div>
    <div class="row">
        <div class="form-group col-md-3">
            <label class="control-label" for="cliente-data-nasc">Data de Nasc. <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control data" type="text" id="cliente-data-nasc" name="cliente-data-nasc" placeholder="Ex.: dd/mm/aaaa" value="<?= $this->input->post('cliente-data-nasc');?>">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('cliente-data-nasc')?></div>
        </div>
        <div class="form-group col-md-3">
            <label class="control-label" for="cliente-estado-civil">Estado Civil <span class="text-danger">*</span></label>
            <div class="">
                <select class="form-control" type="text" id="cliente-estado-civil" name="cliente-estado-civil" placeholder="Escolha uma opção...">
                    <option value=<?php null;?>>Escolha uma opção...</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                    <option value="1" <?php if("1" == $this->input->post('cliente-estado-civil')) echo "selected";?>>SOLTEIRO(A)</option>
                    <option value="2" <?php if("2" == $this->input->post('cliente-estado-civil')) echo "selected";?>>CASADO(A)</option>
                    <option value="3" <?php if("3" == $this->input->post('cliente-estado-civil')) echo "selected";?>>UNIÃO ESTÁVEL</option>
                    <option value="4" <?php if("4" == $this->input->post('cliente-estado-civil')) echo "selected";?>>DIVORCIADO(A)</option>
                    <option value="5" <?php if("5" == $this->input->post('cliente-estado-civil')) echo "selected";?>>VIÚVO(A)</option>

                </select>
                 <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('cliente-estado-civil')?></div>
            </div>
           
        </div>
        <div class="form-group col-md-4">
            <label class=" control-label" for="cliente-genero">Gênero <span class="text-danger">*</span></label>
            <div class="col-xs-12">
                <label class="radio-inline" for="pf-genero-masc">
                    <input type="radio" id="pf-genero-masc" name="cliente-genero" value="1" <?php if($this->input->post('cliente-genero') == 1) echo "checked";?>> Masc
                </label>
                <label class="radio-inline" for="pf-genero-fem">
                    <input type="radio" id="pf-genero-fem" name="cliente-genero" value="2" <?php if($this->input->post('cliente-genero') == 2) echo "checked";?>> Fem
                </label>
            </div>        
        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c; margin-top: 40px"><?=form_error('cliente-genero')?></div>
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
            <label class="control-label " for="cliente-telefone">Telefone <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control fone" type="text" id="cliente-telefone" name="cliente-telefone" placeholder="(99) 9999-9999" value="<?= $this->input->post('cliente-telefone');?>">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('cliente-telefone')?></div>
        </div>
        <div class="form-group col-md-4">
            <label class=" control-label " for="cliente-celular">Celular <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control celular" type="text" id="cliente-celular" name="cliente-celular" placeholder="(99) 99999-9999" value="<?= $this->input->post('cliente-celular');?>">
            </div>
             <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('cliente-celular')?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="control-label" for="cliente-email">E-mail <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="cliente-email" name="cliente-email" placeholder="Insira um e-mail válido" value="<?= $this->input->post('cliente-email');?>">
            </div>
             <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('cliente-email')?></div>
        </div>
    </div>

	<div class="block-header" style="margin-left: -20px; color:#bbb">
        <h3 class="block-title">Mais opções</h3>
    </div>
    <div class="row">
	    <div class="form-group col-xs-12 col-md-4">
            <label class="checkbox-inline" for="o-colaborador">
                <input type="checkbox" id="o-colaborador" name="o-colaborador" value="1" <?php if($this->input->post('o-colaborador') == 1) echo "checked";?>> Colaborador
            </label>
            <!--
            <label class="checkbox-inline" for="o-parceiro" onclick="isMedico()">
                <input type="checkbox" id="o-parceiro" name="o-parceiro" value="2"> Parceiro
            </label>
            <label class="checkbox-inline" for="o-parceiro-medico" id="o-parceiro-medico-label" style="display: none;" onclick="especialidades()" >
                <input type="checkbox" id="o-parceiro-medico" name="o-parceiro-medico" value="1">É médico?
            </label>-->
	    </div>
	    <div class="form-group col-md-4" id="especialidade-medica" style="display: none">
		    <label class="control-label" for="o-parceiro-especialidade">Especialidades Médicas<span class="text-danger">*</span></label>
		   	<div class="">
				<input class="form-control" type="text" id="o-parceiro-especialidade" name="o-parceiro-especialidade" placeholder="Ex.: Cardiologista, oftalmologista">
			</div>
		</div>
	</div>
</div>
<div id="pj" <?php if($this->input->post('cliente-tipo') == 2) echo "style='display:block;'"; else echo "style='display:none;'"?> >
    <div class="row">
        <div class="form-group col-md-4">
            <label class="control-label" for="pj-razao-social">Razão Social<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="pj-razao-social" name="pj-razao-social" placeholder="Insira a razão social">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('pj-razao-social')?></div>
        </div>
        <div class="form-group col-md-4">
            <label class=" control-label" for="pj-fantasia">Nome fantasia</label>
            <div class="">
                <input class="form-control" type="text" id="pj-fantasia" name="pj-fantasia" placeholder="Insira o nome fantaia, se houver." onkeyup="caps(this)">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('pj-fantasia')?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="control-label" for="pj-cnpj">CNPJ <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control cnpj" type="text" id="pj-cnpj" name="pj-cnpj" placeholder="Ex.: 999.999.999/0001-99">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('pj-cnpj')?></div>
        </div>
    </div>


	<div class="block-header" style="margin-left: -20px; color:#bbb">
        <h3 class="block-title">Endereço do Negócio</h3>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label class="control-label" for="endereco-logradouro-pj">Logradouro<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="endereco-logradouro-pj" name="endereco-logradouro-pj" placeholder="Ex.: Rua, Av., Travessa..." onkeyup="caps(this)">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('endereco-logradouro-pj')?></div>
        </div>
        <div class="form-group col-md-2">
            <label class=" control-label" for="endereco-numero-pj">Número<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="endereco-numero-pj" name="endereco-numero-pj" placeholder="Ex.: 999" onkeypress='return SomenteNumero(event)'>
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('endereco-numero-pj')?></div>
        </div>
        <div class="form-group col-md-3">
            <label class="control-label" for="endereco-bairro-pj">Bairro<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="endereco-bairro-pj" name="endereco-bairro-pj" placeholder="Insira um bairro" onkeyup="caps(this)">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('endereco-bairro-pj')?></div>
        </div>
        <div class="form-group col-md-3">
            <label class="control-label" for="endereco-complemento-pj">Complemento</label>
            <div class="">
                <input class="form-control" type="text" id="endereco-complemento-pj" name="endereco-complemento-pj" placeholder="" onkeyup="caps(this)">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('endereco-complemento-pj')?></div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label class="control-label" for="endereco-cep-pj">CEP<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control cep" type="text" id="endereco-cep-pj" name="endereco-cep-pj" placeholder="Ex.: 99999-999">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('endereco-cep-pj')?></div>
        </div>
        <div class="form-group col-md-4">
            <label class=" control-label" for="endereco-cidade-pj">Cidade<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="endereco-cidade-pj" name="endereco-cidade-pj" placeholder="Insira uma cidade" onkeyup="caps(this)">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('endereco-cidade-pj')?></div>
        </div>
        <div class="form-group col-md-2">
            <label class="control-label" for="endereco-estado-pj">Estado<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="endereco-estado-pj" name="endereco-estado-pj" placeholder="" onkeyup="caps(this)">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('endereco-estado-pj')?></div>
        </div>
        
    </div>

    <div class="block-header" style="margin-left: -20px; color:#bbb">
        <h3 class="block-title">Representantes (Sócios)</h3>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label class="control-label" for="pj-representante">Representante <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="pj-representante" name="pj-representante" placeholder="Insira o nome de um representante" onkeyup="caps(this)">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('pj-representante')?></div>
        </div>
        <div class="form-group col-md-3">
            <label class=" control-label" for="pj-rg">RG <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="pj-rg" name="pj-rg" placeholder="Ex.: 999999999" onkeyup="caps(this)">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('pj-rg')?></div>
        </div>
        <div class="form-group col-md-3">
            <label class="control-label" for="pj-cpf">CPF <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control cpf" type="text" id="pj-cpf" name="pj-cpf" placeholder="Ex.: 999.999.999-99">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('pj-cpf')?></div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label class="control-label" for="pj-representante-2">Representante 2</label>
            <div class="">
                <input class="form-control" type="text" id="pj-representante-2" name="pj-representante-2" placeholder="Insira o nome de outro representante" onkeyup="caps(this)">
            </div>
        </div>
        <div class="form-group col-md-3">
            <label class=" control-label" for="pj-rg-2">RG</label>
            <div class="">
                <input class="form-control" type="text" id="pj-rg-2" name="pj-rg-2" placeholder="Ex.: 999999999" onkeyup="caps(this)">
            </div>
        </div>
        <div class="form-group col-md-3">
            <label class="control-label" for="pj-cpf-2">CPF</label>
            <div class="">
                <input class="form-control cpf" type="text" id="pj-cpf-2" name="pj-cpf-2" placeholder="Ex.: 999.999.999-99">
            </div>
        </div>
    </div>

	<div class="block-header" style="margin-left: -20px; color:#bbb">
        <h3 class="block-title">Contato</h3>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label class="control-label" for="completo-telefone">Telefone <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control fone" type="text" id="completo-telefone" name="completo-telefone" placeholder="(99) 9999-9999">
            </div>
             <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('completo-telefone')?></div>
        </div>
        <div class="form-group col-md-4">
            <label class=" control-label" for="completo-celular">Celular <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control celular" type="text" id="completo-celular" name="completo-celular" placeholder="(99) 99999-9999">
            </div>
             <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('completo-celular')?></div>
        </div>
        <!--
        <div class="form-group col-md-4">
            <label class=" control-label" for="completo-celular-2">Celular 2</label>
            <div class="">
                <input class="form-control" type="text" id="completo-celular-2" name="completo-celular-2" placeholder="(99) 99999-9999">
            </div>
        </div>
        -->
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label class="control-label" for="completo-email">E-mail <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="completo-email" name="completo-email" placeholder="Insira um e-mail válido">
            </div>
             <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('completo-email')?></div>
        </div>
        <div class="form-group col-md-6">
            <label class=" control-label" for="completo-site">Site</label>
            <div class="">
                <input class="form-control" type="text" id="completo-site" name="completo-site" placeholder="Ex.: www.site.com">
            </div>
             <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('completo-site')?></div>
        </div>
    </div>



	<div class="block-header" style="margin-left: -20px; color:#bbb">
        <h3 class="block-title">Mais opções</h3>
    </div>
    <div class="row">
	    <div class="form-group col-xs-12 col-md-2">
            <label class="checkbox-inline" for="o-fornecedor">
                <input type="checkbox" id="o-fornecedor" name="o-fornecedor" value="1" <?php if($this->input->post('o-fornecedor') == 1) echo "checked";?>> Fornecedor
            </label>
	    </div>
        <div class="form-group col-xs-12 col-md-2">
            <label class="checkbox-inline" for="o-parceiro">
                <input type="checkbox" id="o-parceiro" name="o-parceiro" value="1" <?php if($this->input->post('o-parceiro') == 1) echo "checked";?>> Parceiro
            </label>
        </div>
        <!--
		<div class="form-group col-md-6" id="observacoes-fornecedor" style="display: none">
            <label class="col-xs-12" for="o-fornecedor-obs">Observações</label>
            <div class="col-xs-12">
                <textarea class="form-control" id="o-fornecedor-obs" name="o-fornecedor-obs" rows="3" placeholder="Insira alguma observção sobre a empresa"></textarea>
            </div>
        </div>
        -->
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