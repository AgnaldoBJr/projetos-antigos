
    <div class="row">
        <div class="form-group col-md-6">
            <label class="control-label" for="nome">Nome <span class="text-danger">*</span></label>
            <div class="">
                <input class="form-control" type="text" id="pf-nome" name="nome" placeholder="Insira um nome" value="<?= $this->input->post('nome');?>" onkeyup="caps(this)">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('nome')?></div>
        </div>
        <div class="form-group col-md-6">
            <label class=" control-label" for="descricao">Descrição</label>
            <div class="">
                <textarea class="form-control" id="descricao" name="descricao" rows="3" placeholder="Insira algo sobre esse fornecedor" onkeyup="caps(this)"></textarea>
            </div>
        </div>
    </div>


    <div class="block-header" style="margin-left: -20px; color:#bbb">
        <h3 class="block-title">Contato</h3>
    </div>
    <div class="row">
        <div class="form-group col-md-4">
            <label class="control-label " for="telefone">Telefone </label>
            <div class="">
                <input class="form-control fone" type="text" id="telefone" name="telefone" placeholder="(99) 9999-9999" value="<?= $this->input->post('telefone');?>">
            </div>
            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('telefone')?></div>
        </div>
        <div class="form-group col-md-4">
            <label class=" control-label " for="celular">Celular </label>
            <div class="">
                <input class="form-control celular" type="text" id="celular" name="celular" placeholder="(99) 99999-9999" value="<?= $this->input->post('celular');?>">
            </div>
             <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('celular')?></div>
        </div>
        <div class="form-group col-md-4">
            <label class="control-label" for="email">E-mail</label>
            <div class="">
                <input class="form-control" type="text" id="email" name="email" placeholder="Insira um e-mail válido" value="<?= $this->input->post('email');?>">
            </div>
             <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('email')?></div>
        </div>
    </div>



<div class="block-header" style="margin-left: -20px; color:#bbb">
    <h3 class="block-title">Observações</h3>
</div>
<div class="row">
    <div class="form-group col-md-6">
        <label class=" control-label" for="observacoes">Observações Gerais</label>
        <div class="">
            <textarea class="form-control" id="observacoes" name="observacoes" rows="3" placeholder="Insira alguma observação sobre o fornecedor" onkeyup="caps(this)"></textarea>
        </div>
    </div>
</div>
    

