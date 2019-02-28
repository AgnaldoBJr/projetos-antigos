
<!-- Main Container -->
            <main id="main-container">
         	    <!-- Page Header -->
                <div class="content bg-gray-lighter">
                    <div class="row items-push">
                        <div class="col-sm-7">
                            <h1 class="page-heading">
                                Atualizar Serviço<br>
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

                            <!--FORMULÁRIO DE NOVA CATEGORIA DE CONTAS A RECEBER
                            Nome*  |   Centro de Custo*   |  Cadastrar -->
                            <div class="block-header" style="margin-left: -20px; color:#bbb">
                                <h3 class="block-title">Novo serviço</h3>
                                </div>
                                
                            <form action="<?=base_url('atendimento/servicos/alterar');?>" method="POST" id="servico">
                            
                                <div class="row">
                                   <input type="hidden" name="cod_servico" value=<?=$servico['cod_servico']?>>
                                   <input type="hidden" name="parceiro" value=<?=$servico['fk_parceiro']?>>

                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="tipo">Tipo <span class="text-danger">*</span></label>
                                        <div class="">
                                            <select class="form-control" type="text" id="aaaa" name="tipo" placeholder="Escolha uma opção...">
                                                <option value="<?=null;?>">Escolha uma opção...</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                                <option value="Exame" <?php if($servico['tipo']=='Exame') echo 'selected';?>>Exame</option>
                                                <option value="Consulta" <?php if($servico['tipo']=='Consulta') echo 'selected';?>>Consulta</option>
                                                <option value="Procedimento" <?php if($servico['tipo']=='Procedimento') echo 'selected';?>>Procedimento</option>
                                                <option value="Atendimento" <?php if($servico['tipo']=='Atendimento') echo 'selected';?>>Atendimento</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group col-md-6" id="exame" <?php if($servico['tipo']!='Exame') echo 'style="display: none"'?>>
                                        <label class="control-label" for="exame">Exame <span class="text-danger">*</span></label>
                                        <div class="">
                                            <select class="form-control" type="text" name="exame" placeholder="Escolha uma opção...">
                                                <option value=<?php null;?>>Escolha uma opção...</option>
                                                 <?php

                                                    //$p = json_encode($dataExames);
                                                    
                                                    if($dataExames) foreach ($dataExames as $data){
                                                ?>
                                                    <option value="<?=$data['cod_exame']?>" <?php if($servico['fk_exame'] == $data['cod_exame']) echo 'selected'?>><?=$data['nome']?></option>

                                                <?php } ?>
                                            </select>
                                            
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6" id="nome" <?php if($servico['tipo']=='Exame') echo 'style="display: none"'?>>
                                        <label class="control-label" for="nome">Nome do serviço<span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control" type="text" name="nome" id="input_nome" placeholder="Insira um nome" value="<?=$servico['nome']?>">
                                            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('nome')?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="valor_parceiro">Valor do parceiro (R$)<span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control valor" type="text" id="valor_parceiro" name="valor_parceiro" placeholder="Ex.: 99,99" value="<?= formata_preco($servico['valor_parceiro'])?>">
                                        </div>
                                        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('valor')?></div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="valor_cima">Valor Cima (R$)<span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control valor" type="text" id="valor_cima" name="valor_cima" placeholder="Ex.: 99,99" value="<?= formata_preco($servico['valor_cima'])?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="valor_recibo">Valor com recibo (R$)<span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control valor" type="text" name="valor_recibo" placeholder="Ex.: 99,99" value="<?= formata_preco($servico['valor_recibo'])?>">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2" style="margin-top:23px">
                                        <input type="submit" class="btn btn-primary" value="Alterar">
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
<?php $this->load->view('commons/footer');?>
<script type="text/javascript">
   //var s = <?//=$s?>;
   var items = document.getElementById('aaaa');
    items.addEventListener('change', function(){
    console.log("O indice é: " + items.selectedIndex);
    //console.log("O texto é: " + items.options[items.selectedIndex].text);
    //console.log("A chave é: " + items.options[items.selectedIndex].value);
    
    //console.log(s[0].nome);
    //console.log(s);

    if(items.selectedIndex == 0){
        document.getElementById("exame").style.display = 'none';
        document.getElementById("nome").style.display = 'none';
        
    }
    else if(items.selectedIndex == 1){
        document.getElementById("exame").style.display = 'block';
        document.getElementById("nome").style.display = 'none';
        
    }
    else if(items.selectedIndex == 2){
        document.getElementById("exame").style.display = 'none';
        document.getElementById("nome").style.display = 'block';
        document.getElementById("input_nome").value = 'Consulta';
        
    }
    else if(items.selectedIndex == 3){
        document.getElementById("exame").style.display = 'none';
        document.getElementById("nome").style.display = 'block';
        document.getElementById("input_nome").value = '';
        
    } 
    else if(items.selectedIndex == 4){
        document.getElementById("exame").style.display = 'none';
        document.getElementById("nome").style.display = 'block';
        document.getElementById("input_nome").value = 'Atendimento';
        
    } 
});
</script> 