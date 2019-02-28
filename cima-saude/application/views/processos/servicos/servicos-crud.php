<?php 

    $this->load->view('commons/header');
?>

<?php if($this->session->flashdata('msg')){ ?>
                   
        <div class="col-xs-11 col-sm-4 alert alert-success animated fadeIn" id="success-alert" role="alert" style=" margin: 0px auto; position: fixed;  z-index: 1033; top: 20px; right: 20px">
            <button type="button" class="close" style="font-size: 14px" data-dismiss="alert">x</button>
            <strong>Sucesso! </strong>
            <?php echo $this->session->flashdata('msg'); ?>
        </div>
    <?php } ?>
    <?php if($this->session->flashdata('cancel')): ?>
        <div class="col-xs-11 col-sm-4 alert alert-info animated fadeIn" id="info-alert" role="alert" style=" margin: 0px auto; position: fixed;  z-index: 1033; top: 20px; right: 20px">
            <button type="button" class="close" style="font-size: 14px" data-dismiss="alert">x</button>
            <strong>Ok! </strong>
            <?php echo $this->session->flashdata('cancel'); ?>
        </div>
    <?php endif; ?>

    <?php if($this->session->flashdata('error')): ?>
        <div class="col-xs-11 col-sm-4 alert alert-error animated fadeIn" id="info-alert" role="alert" style=" margin: 0px auto; position: fixed;  z-index: 1033; top: 20px; right: 20px">
            <button type="button" class="close" style="font-size: 14px" data-dismiss="alert">x</button>
            <strong>Ok! </strong>
            <?php echo $this->session->flashdata('error'); ?>
        </div>
    <?php endif; ?>

<!-- Main Container -->
            <main id="main-container">
                <!-- Page Header -->
                <div class="content bg-gray-lighter">
                    <div class="row items-push">
                        <div class="col-sm-7">
                            <h1 class="page-heading">
                                Serviços
                            </h1>
                            <span></span> 
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
                                
                            <form action="<?=base_url('c-processos/servico/salvar');?>" method="POST" id="servico">
                            
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="parceiro">Parceiro <span class="text-danger">*</span></label>
                                        <div class="">
                                            <select class="form-control" type="text" name="parceiro" placeholder="Escolha uma opção..." id="parceiro">
                                                <option value=<?php null;?>>Escolha uma opção...</option>
                                                 <?php

                                                    $p = json_encode($dataParceiros);
                                                    
                                                    if($dataParceiros) foreach ($dataParceiros as $data){
                                                ?>
                                                    <option value="<?=$data['cod_parceiro']?>" ><?=$data['nome']?></option>

                                                <?php } ?>
                                            </select>
                                            
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="tipo">Tipo <span class="text-danger">*</span></label>
                                        <div class="">
                                            <select class="form-control" type="text" id="aaaa" name="tipo" placeholder="Escolha uma opção...">
                                                <option value="<?=null;?>">Escolha uma opção...</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                                <option value="Exame">Exame</option>
                                                <option value="Consulta">Consulta</option>
                                                <option value="Procedimento">Procedimento</option>
                                                <option value="Atendimento">Atendimento</option>
                                            </select>
                                        </div>
                                    </div>


                                    <div class="form-group col-md-6" id="exame" style="display: none">
                                        <label class="control-label" for="exame">Exame <span class="text-danger">*</span></label>
                                        <div class="">
                                            <select class="form-control" type="text" name="exame" placeholder="Escolha uma opção...">
                                                <option value=<?php null;?>>Escolha uma opção...</option>
                                                 <?php

                                                    //$p = json_encode($dataExames);
                                                    
                                                    if($dataExames) foreach ($dataExames as $data){
                                                ?>
                                                    <option value="<?=$data['cod_exame']?>" ><?=$data['nome']?></option>

                                                <?php } ?>
                                            </select>
                                            
                                        </div>
                                    </div>

                                    <div class="form-group col-md-6" id="nome" style="display: none">
                                        <label class="control-label" for="nome">Nome do serviço<span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control" type="text" name="nome" placeholder="Insira um nome" value="<?= $this->input->post('nome');?>">
                                            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('nome')?></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="valor_parceiro">Valor do parceiro (R$)<span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control valor" type="text" id="valor_parceiro"name="valor_parceiro" placeholder="Ex.: 99,99" value="<?= $this->input->post('c-pagar-valor');?>">
                                        </div>
                                        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('valor')?></div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="valor_cima">Valor Cima (R$)<span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control valor" type="text" id="valor_cima" name="valor_cima" placeholder="Ex.: 99,99" value="<?= $this->input->post('c-pagar-valor');?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="valor_recibo">Valor com recibo (R$)<span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control valor" type="text" name="valor_recibo" placeholder="Ex.: 99,99" value="<?= $this->input->post('c-pagar-valor');?>">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-2" style="margin-top:23px">
                                        <input type="submit" class="btn btn-primary" value="Cadastrar">
                                    </div>
                                </div>
                            </form>
                            <!--Fim do FORMUlÁRIO-->


                            <div class="block-header" style="margin-left: -20px; color:#bbb">
                                <h3 class="block-title">Lista de serviços</h3>
                            </div>
                        <div class="row">
                            <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
                            <div class="col-lg-12 "><!--col-lg-offset-1-->
                                <table class="table table-bordered table-striped js-dataTable-full" >
                                    <thead>
                                        <tr>
                                            <th class="text-center"></th>
                                            <th>Nome</th>
                                            <th>Parceiro</th>
                                            <th>Valor (R$)</th>
                                            <th>Valor Cima (R$)</th>
                                            <th>Valor Recibo (R$)</th>
                                            <th class="text-center">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                       
                                        if($dataTable) foreach ($dataTable as $data){?>
                                        <tr>
                                            <?php $s = json_encode($data);?>
                                            <td class="text-center"><?=$data['cod_servico']?></td>
                                            <td class="font-w600"><?php if($data['fk_exame']==0) echo $data['nome']; else echo $data['exame'] ?> </td>
                                            <td class="font-w600"><?=$data['parceiro']?> </td>
                                            <td class="font-w600"><?=formata_preco($data['valor_parceiro'])?> </td>
                                            <td class="font-w600"><?=formata_preco($data['valor_cima'])?> </td>
                                            <td class="font-w600"><?=formata_preco($data['valor_recibo'])?> </td>
                                            
                                            <td class="text-center">
                                                <div class="btn-group">
                                                
                                                    <button class="btn btn-xs btn-default" type="button" data-toggle="modal" data-target="#atualizarModal" data-whatever='<?=$s;?>'><i class="fa fa-pencil"></i></button>

                                                     <button class="btn btn-xs btn-default" type="button" data-toggle="modal" data-target="#excluirModal" data-whatever='<?=$s;?>' data-cod="<?=$data['cod_servico']?>"><i class="fa fa-times"></i></button>

                                                </div>
                                            </td>
                                        </tr>
                                    <?php  } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div> 
            </div>   
                <!-- END Dynamic Table Full -->

    
<div class="modal fade" id="atualizarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <form method="POST" action="<?=base_url('c-processos/Servico/atualizar');?>" id="servico_update">
                <div class="modal-content">                        <div class="block block-themed block-transparent remove-margin-b">
                            <div class="block-header bg-primary-dark">
                                <ul class="block-options">
                                    <li>
                                        <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                                    </li>
                                </ul>
                                <h1>
                                <h3 class="block-title">Atualizar Serviço</h3>
                            </div>
                            <div class="block-content">
                                <div class="form-group">
                                    <label class="control-label" for="fk_parceiro">Parceiro <span class="text-danger">*</span></label>
                                    <div class="">
                                        <select class="form-control" type="text" id="fk_parceiro" name="fk_parceiro" placeholder="Escolha uma opção...">
                                            <option value="0">Escolha uma opção...</option>
                                            <?php

                                                if($dataParceiros) foreach ($dataParceiros as $data){
                                            ?>
                                                <option value="<?=$data['cod_parceiro']?>"><?=$data['nome']?></option>

                                            <?php } ?>
                                        </select>
                                    </div>
                                </div>    
                                <div class="form-group">
                                    <label class="control-label" for="nome">Nome <span class="text-danger">*</span></label>
                                    <div class="">
                                        <input class="form-control" type="text" id="nome" name="nome" placeholder="Insira um nome">
                                    </div>
                                </div>

                                    <div class="form-group ">
                                        <div class="">
                                            <label class="control-label" for="valor">Valor<span class="text-danger">*</span></label>
                                            <div class="">
                                                <input class="form-control valor" type="text" name="valor" placeholder="Ex.: 99,99" value="<?= $this->input->post('c-pagar-valor');?>">
                                            </div>
                                        
                                        </div>
                                    </div>
                                    <div class="form-group ">
                                        <div class="">
                                            <label class="control-label" for="valor_cima">Valor Cima (R$)<span class="text-danger">*</span></label>
                                            <div class="">
                                                <input class="form-control valor" type="text" name="valor_cima" placeholder="Ex.: 99,99" value="<?= $this->input->post('c-pagar-valor');?>">
                                            </div>
                                        
                                        </div>
                                    </div>         
                                    <input id="cod_exame" type="hidden" name="cod_exame">
                                </form>                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn btn-sm btn-primary">Atualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Large Modal -->


<div class="modal fade" id="excluirModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <form method="POST" action="<?=base_url('servicos/delete');?>">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Deseja realmente excluir o parceiro: <span id="codigo"></span> - <span id="nome"></span>?</p>
                    
                    <input type="hidden" class="form-control" name='cod_servico' id="cod_servico">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                <button type="submit" class="btn btn-primary">Excluir</button>
                </div>
            </div>
        </form>
    </div>
</div>
                
                </div>
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->

            
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
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
        
    }
    else if(items.selectedIndex == 3){
        document.getElementById("exame").style.display = 'none';
        document.getElementById("nome").style.display = 'block';
        
    } 
    else if(items.selectedIndex == 4){
        document.getElementById("exame").style.display = 'none';
        document.getElementById("nome").style.display = 'block';
        
    } 
});
</script>

<?php $this->load->view('commons/footer');?>
<script>

         $('#atualizarModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          console.log(recipient);
          var modal = $(this)
          modal.find('#cod_cat_conta_a_receber').val(recipient.cod_cat_conta_a_receber)
          modal.find('#nome').val(recipient.nome);
          modal.find('#fk_parceiro').val(recipient.fk_parceiro);
        });

        

        $('#excluirModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          console.log(recipient);
          console.log(recipient.nome);
          var modal = $(this)
          modal.find('#cod_servico').val(recipient.cod_servico)
          modal.find('#nome').text(recipient.nome);
          modal.find('#codigo').text(recipient.cod_servico);
        });

</script>


<script type="text/javascript">
//linha para usar a biblioteca Jquery
    $().ready(function() {
        //utiliza o formulário escolhido por ID
    
        $('#servico').validate({
            // FAZ A VALIDAÇÃO EM TEMPO REAL"
            onkeyup: function(element) {
                this.element(element);
            },
        

            //objeto com duas propriedades rules e messages
            rules: {
                'parceiro' : {
                    required : true,
                    //dateBR : true 
                },

                'tipo' : {
                    required : true,
                    //dateBR : true 
                },

                'exame': {
                    required : true,
                    //dateBR : true 
                },

                'nome': {
                    required : true,
                    //dateBR : true 
                },

                'valor_parceiro' : {
                    required : true,
                    //dateBR : true 
                },

                'valor_cima' : {
                    required : true,
                    //dateBR : true 
                },
            },

            messages: {
                'parceiro' : {
                    required : "Escolha uma opção",
                    //dateBR : "Data inválida" 
                },

                'tipo' : {
                    required : "Escolha uma opção",
                    //dateBR : "Data inválida" 
                },

                'nome' : {
                    required : "Campo Obrigatório!",
                    //dateBR : "Data inválida" 
                },

                'exame' : {
                    required : "Escolha uma opção",
                    //dateBR : "Data inválida" 
                },
                
                'valor_parceiro' : {
                    required : "Campo Obrigatório!",
                    //dateBR : "Data inválida" 
                },

                'valor_cima' : {
                    required : "Campo Obrigatório!",
                    //dateBR : "Data inválida" 
                },
                

                
            }

        });
    });

</script>

<script type="text/javascript">
//linha para usar a biblioteca Jquery
    $().ready(function() {
        //utiliza o formulário escolhido por ID
    
        $('#servico_update').validate({
            // FAZ A VALIDAÇÃO EM TEMPO REAL"
            onkeyup: function(element) {
                this.element(element);
            },
        

            //objeto com duas propriedades rules e messages
            rules: {
                'parceiro' : {
                    required : true,
                    //dateBR : true 
                },
            
                'nome': {
                    required : true,
                    //dateBR : true 
                },

                
                'valor_cima' : {
                    required : true,
                    //dateBR : true 
                },
            },

            messages: {
                'parceiro' : {
                    required : "Escolha uma opção",
                    //dateBR : "Data inválida" 
                },
                'nome' : {
                    required : "Campo Obrigatório!",
                    //dateBR : "Data inválida" 
                },
                
                'valor_cima' : {
                    required : "Campo Obrigatório!",
                    //dateBR : "Data inválida" 
                },
                

                
            }

        });
    });

</script>