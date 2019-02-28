<div class="row">
	<div class="form-group col-md-4">
	    <label class=" control-label" for="parceiro-tipo">Tipo de Pessoa <span class="text-danger">*</span></label>
		<div class="col-xs-12">
            <label class="radio-inline" for="tipo-pessoa-pf">
                <input type="radio" id="tipo-pessoa-pf" name="parceiro-tipo" value="1" checked="true" onclick="pessoaFisica()"> Pessoa Física
            </label>
            <label class="radio-inline" for="pf-genero-pj">
                <input type="radio" id="tipo-pessoa-pj" name="parceiro-tipo" value="2" onclick="pessoaJuridica()"> Pessoa Jurídica
            </label>
        </div>
	</div>
</div>
<div id="pf">
    <div class="row">
        <div class="form-group col-md-6">
            <label class="control-label" for="parceiro-nome">Nome <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="pf-nome" name="parceiro-nome" placeholder="Insira um nome">
            </div>
        </div>
        <div class="form-group col-md-3">
            <label class=" control-label" for="parceiro-rg">RG <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="parceiro-rg" name="parceiro-rg" placeholder="Ex.: 99.999.999-9">
            </div>
        </div>
        <div class="form-group col-md-3">
            <label class="control-label" for="parceiro-cpf">CPF <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="parceiro-cpf" name="parceiro-cpf" placeholder="Ex.: 999.999.999-99">
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="form-group col-md-2">
            <label class="control-label" for="parceiro-data-nasc">Data de Nasc. <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="parceiro-data-nasc" name="parceiro-data-nasc" placeholder="Ex.: dd/mm/aaaa">
            </div>
        </div>
        <div class="form-group col-md-3">
            <label class="control-label" for="parceiro-estado-civil">Estado Civil <span class="text-danger">*</span></label>
            <div class="">
                <select class="form-control" type="text" id="parceiro-estado-civil" name="parceiro-estado-civil" placeholder="Escolha uma opção...">
                    <option value="0">Escolha uma opção...</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                    <option value="1">Solteiro</option>
                    <option value="2">Casado</option>
                    <option value="3">Viúvo</option>

                </select>
            </div>
        </div>
        <div class="form-group col-md-4">
            <label class=" control-label" for="parceiro-genero">Gênero <span class="text-danger">*</span></label>
            <div class="col-xs-12">
                <label class="radio-inline" for="pf-genero-masc">
                    <input type="radio" id="pf-genero-masc" name="parceiro-genero" value="1"> Masc
                </label>
                <label class="radio-inline" for="pf-genero-fem">
                    <input type="radio" id="pf-genero-fem" name="parceiro-genero" value="2"> Fem
                </label>
                <label class="radio-inline" for="pf-genero-outro">
                    <input type="radio" id="pf-genero-outro" name="parceiro-genero" value="3"> Outro
                </label>
            </div>
        </div>
    </div>

	<div class="block-header" style="margin-left: -20px; color:#bbb">
        <h3 class="block-title">Endereço</h3>
    </div>

<?php	
	//$this->load->view('form-parts/endereco');
?>

    <div class="block-header" style="margin-left: -20px; color:#bbb">
        <h3 class="block-title">Contato</h3>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label class="control-label" for="parceiro-telefone">Telefone <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="parceiro-telefone" name="parceiro-telefone" placeholder="(99) 9999-9999">
            </div>
        </div>
        <div class="form-group col-md-4">
            <label class=" control-label" for="parceiro-celular">Celular <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="parceiro-celular" name="parceiro-celular" placeholder="(99) 99999-9999">
            </div>
        </div>
        <div class="form-group col-md-4">
            <label class="control-label" for="parceiro-email">E-mail <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="parceiro-email" name="parceiro-email" placeholder="Insira um e-mail válido">
            </div>
        </div>
    </div>

	<div class="block-header" style="margin-left: -20px; color:#bbb">
        <h3 class="block-title">Mais opções</h3>
    </div>
    <div class="row">
        <div class="form-group col-xs-12 col-md-4">
            <label class="checkbox-inline" for="o-cliente">
                <input type="checkbox" id="o-cliente" name="o-cliente" value="1"> Cliente
            </label>
            <label class="checkbox-inline" for="o-parceiro-medico" id="o-parceiro-medico-label" onclick="especialidades()" >
                <input type="checkbox" id="o-parceiro-medico" name="o-parceiro-medico" value="1">É médico?
            </label>
            <label class="checkbox-inline" for="o-usuario" onclick="isUsuario()">
                <input type="checkbox" id="o-usuario" name="o-usuario" value="1"> É usuário do sistema?
            </label>
        </div>
        <div class="form-group col-md-4" id="especialidade-medica" style="display: none">
            <label class="control-label" for="o-parceiro-especialidade">Especialidades Médicas<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="o-parceiro-especialidade" name="o-parceiro-especialidade" placeholder="Ex.: Cardiologista, oftalmologista">
            </div>
        </div>
    </div>

</div>






<div id="pj" style="display: none">
    <div class="row">
        <div class="form-group col-md-4">
            <label class="control-label" for="pj-razao-social">Razão Social<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="pj-razao-social" name="pj-razao-social" placeholder="Insira a razão social">
            </div>
        </div>
        <div class="form-group col-md-4">
            <label class=" control-label" for="pj-fantasia">Nome fantasia <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="pj-fantasia" name="pj-fantasia" placeholder="Insira o nome fantaia, se houver.">
            </div>
        </div>
        <div class="form-group col-md-4">
            <label class="control-label" for="pj-cnpj">CNPJ <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="pj-cnpj" name="pj-cnpj" placeholder="Ex.: 999.999.999/0001-99">
            </div>
        </div>
    </div>


	<div class="block-header" style="margin-left: -20px; color:#bbb">
        <h3 class="block-title">Endereço do Negócio</h3>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label class="control-label" for="endereco-logradouro">Logradouro<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="endereco-logradouro" name="endereco-logradouro" placeholder="Ex.: Rua, Av., Travessa...">
            </div>
        </div>
        <div class="form-group col-md-2">
            <label class=" control-label" for="endereco-numero">Número<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="endereco-numero" name="endereco-numero" placeholder="Ex.: 999">
            </div>
        </div>
        <div class="form-group col-md-3">
            <label class="control-label" for="endereco-bairro">Bairro<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="endereco-bairro" name="endereco-bairro" placeholder="Insira um bairro">
            </div>
        </div>
        <div class="form-group col-md-3">
            <label class="control-label" for="endereco-complemento">Complemento</label>
            <div class="">
                <input class="form-control" type="text" id="endereco-complemento" name="endereco-complemento" placeholder="">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label class="control-label" for="endereco-cep">CEP<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="endereco-cep" name="endereco-cep" placeholder="Ex.: 99999-999">
            </div>
        </div>
        <div class="form-group col-md-4">
            <label class=" control-label" for="endereco-cidade">Cidade<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="endereco-cidade" name="endereco-cidade" placeholder="Insira uma cidade">
            </div>
        </div>
        <div class="form-group col-md-2">
            <label class="control-label" for="endereco-estado">Estado<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="endereco-estado" name="endereco-estado" placeholder="">
            </div>
        </div>
        
    </div>

    <div class="block-header" style="margin-left: -20px; color:#bbb">
        <h3 class="block-title">Representantes (Sócios)</h3>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label class="control-label" for="pj-representante">Representante <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="pj-representante" name="pj-representante" placeholder="Insira o nome de um representante">
            </div>
        </div>
        <div class="form-group col-md-3">
            <label class=" control-label" for="pj-rg">RG <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="pj-rg" name="pj-rg" placeholder="Ex.: 99.999.999-9">
            </div>
        </div>
        <div class="form-group col-md-3">
            <label class="control-label" for="pj-cpf">CPF <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="pj-cpf" name="pj-cpf" placeholder="Ex.: 999.999.999-99">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label class="control-label" for="pj-representante-2">Representante 2</label>
            <div class="">
                <input class="form-control" type="text" id="pj-representante-2" name="pj-representante-2" placeholder="Insira o nome de outro representante">
            </div>
        </div>
        <div class="form-group col-md-3">
            <label class=" control-label" for="pj-rg-2">RG</label>
            <div class="">
                <input class="form-control" type="text" id="pj-rg-2" name="pj-rg-2" placeholder="Ex.: 99.999.999-9">
            </div>
        </div>
        <div class="form-group col-md-3">
            <label class="control-label" for="pj-cpf-2">CPF</label>
            <div class="">
                <input class="form-control" type="text" id="pj-cpf-2" name="pj-cpf-2" placeholder="Ex.: 999.999.999-99">
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
                <input class="form-control" type="text" id="completo-telefone" name="completo-telefone" placeholder="(99) 9999-9999">
            </div>
        </div>
        <div class="form-group col-md-4">
            <label class=" control-label" for="completo-celular">Celular <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="completo-celular" name="completo-celular" placeholder="(99) 99999-9999">
            </div>
        </div>
        <div class="form-group col-md-4">
            <label class=" control-label" for="completo-celular-2">Celular 2</label>
            <div class="">
                <input class="form-control" type="text" id="completo-celular-2" name="completo-celular-2" placeholder="(99) 99999-9999">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label class="control-label" for="  email">E-mail <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="    email" name="   email" placeholder="Insira um e-mail válido">
            </div>
        </div>
        <div class="form-group col-md-6">
            <label class=" control-label" for="completo-site">Site</label>
            <div class="">
                <input class="form-control" type="text" id="completo-site" name="completo-site" placeholder="Ex.: www.site.com">
            </div>
        </div>
    </div>

	<div class="block-header" style="margin-left: -20px; color:#bbb">
        <h3 class="block-title">Contato na Empresa</h3>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label class="control-label" for="empresa-nome">Nome<span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="empresa-nome" name="empresa-nome" placeholder="Insira o nome de um contato na empresa">
            </div>
        </div>
        <div class="form-group col-md-4">
            <label class=" control-label" for="empresa-celular">Celular</label>
            <div class="">
                <input class="form-control" type="text" id="empresa-celular" name="empresa-celular" placeholder="(99) 99999-9999">
            </div>
        </div>
        <div class="form-group col-md-4">
            <label class="control-label" for="empresa-email">E-mail</label>
            <div class="">
                <input class="form-control" type="text" id="empresa-email" name="empresa-email" placeholder="Insira um e-mail válido">
            </div>
        </div>
    </div>
    <div class="row">
        <div class="form-group col-md-6">
            <label class=" control-label" for="empresa-obs">Observações</label>
            <div class="">
                <input class="form-control" type="text" id="empresa-obs" name="empresa-obs" placeholder="Insira um cargo, função ou outra identificação para o contato">
            </div>
        </div>
    </div>

    <div class="block-header" style="margin-left: -20px; color:#bbb">
        <h3 class="block-title">Mais opções</h3>
    </div>
    <div class="row">
        <div class="form-group col-xs-12 col-md-4">
            <label class="checkbox-inline" for="o-fornecedor" onclick="isFornecedor()">
                <input type="checkbox" id="o-fornecedor" name="o-fornecedor" value="2"> Fornecedor
            </label>
            <label class="checkbox-inline" for="o-clinica">
                <input type="checkbox" id="o-clinica" name="o-clinica" value="2"> É Clínica?
            </label>
            <label class="checkbox-inline" for="o-laboratorio">
                <input type="checkbox" id="o-laboratorio" name="o-laboratorio" value="2"> É Laboratório?
            </label>
        </div>
        <div class="form-group col-md-6" id="observacoes-fornecedor" style="display: none">
            <label class="col-xs-12" for="o-fornecedor-obs">Observações</label>
            <div class="col-xs-12">
                <textarea class="form-control" id="o-fornecedor-obs" name="o-fornecedor-obs" rows="3" placeholder="Insira alguma observção sobre a empresa"></textarea>
            </div>
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

    function especialidades(){
        if(document.getElementById("o-parceiro-medico").checked == true){
            
            document.getElementById("o-parceiro-especialidade").value = '';
            document.getElementById("especialidade-medica").style.display = 'block';
        } else{
            document.getElementById("especialidade-medica").style.display = 'none';
        }
    }

    function isUsuario(){
        if(document.getElementById("o-usuario").checked == true){
            document.getElementById("usuario-email").value = '';
            document.getElementById("usuario-senha").value = '';
            document.getElementById("usuario-tipo").value = '';
            document.getElementById("usuario").style.display = 'block';
        } else{
            document.getElementById("usuario").style.display = 'none';
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
</script>



