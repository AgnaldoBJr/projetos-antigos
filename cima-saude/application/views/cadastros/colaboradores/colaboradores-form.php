<div id="pf">
    <div class="row">
        <div class="form-group col-md-6">
            <label class="control-label" for="nome">Nome <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="nome" name="nome" placeholder="Insira um nome">
            </div>
        </div>
        <div class="form-group col-md-3">
            <label class=" control-label" for="rg">RG <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="rg" name="rg" placeholder="Ex.: 99.999.999-9">
            </div>
        </div>
        <div class="form-group col-md-3">
            <label class="control-label" for="cpf">CPF <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="cpf" name="cpf" placeholder="Ex.: 999.999.999-99">
            </div>
        </div>
        
    </div>
    <div class="row">
        <div class="form-group col-md-2">
            <label class="control-label" for="data_nasc">Data de Nasc. <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="data_nasc" name="data_nasc" placeholder="Ex.: dd/mm/aaaa">
            </div>
        </div>
        <div class="form-group col-md-3">
            <label class="control-label" for="estado_civil">Estado Civil <span class="text-danger">*</span></label>
            <div class="">
                <select class="form-control" type="text" id="estado_civil" name="estado_civil" placeholder="Escolha uma opção...">
                    <option value="0">Escolha uma opção...</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                    <option value="1">Solteiro</option>
                    <option value="2">Casado</option>
                    <option value="3">Viúvo</option>

                </select>
            </div>
        </div>
        <div class="form-group col-md-4">
            <label class=" control-label" for="sexo">Gênero <span class="text-danger">*</span></label>
            <div class="col-xs-12">
                <label class="radio-inline" for="pf-genero-masc">
                    <input type="radio" id="pf-genero-masc" name="sexo" value="1"> Masc
                </label>
                <label class="radio-inline" for="pf-genero-fem">
                    <input type="radio" id="pf-genero-fem" name="sexo" value="2"> Fem
                </label>
                <label class="radio-inline" for="pf-genero-outro">
                    <input type="radio" id="pf-genero-outro3" name="sexo" value="3"> Outro
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
            <label class="control-label" for="contato-telefone">Telefone <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="contato-telefone" name="contato-telefone" placeholder="(99) 9999-9999">
            </div>
        </div>
        <div class="form-group col-md-4">
            <label class=" control-label" for="contato-celular">Celular <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="contato-celular" name="contato-celular" placeholder="(99) 99999-9999">
            </div>
        </div>
        <div class="form-group col-md-4">
            <label class="control-label" for="contato-email">E-mail <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="contato-email" name="contato-email" placeholder="Insira um e-mail válido">
            </div>
        </div>
    </div>

    <div class="block-header" style="margin-left: -20px; color:#bbb">
        <h3 class="block-title">Mais opções</h3>
    </div>
    <div class="row">
        <div class="form-group col-xs-12 col-md-5">
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
    <div id="usuario" style="display: none">
        <?php   
            $this->load->view('form-parts/usuario');
        ?>
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


</script>



