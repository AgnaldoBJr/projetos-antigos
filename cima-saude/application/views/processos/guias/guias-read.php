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
                                Guias de Atendimento
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
                        <div class="block-header" style="margin-left: -20px; color:#bbb">
                                <h3 class="block-title">Lista de Guias de Atendimento</h3>
                            </div>
                        <div class="row">
                            <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
                            <div class="col-lg-12 "><!--col-lg-offset-1-->
                                <table class="table table-bordered table-striped js-dataTable-full" >
                                    <thead>
                                        <tr>
                                            <th></th>
                                            <th>Paciente</th>
                                            <th>Data Abertura</th>
                                            <th>Data Realização</th>
                                            <th>Horário</th>
                                            <th>Parceiro</th>
                                            <th>Status</th>
                                            <th class="text-center">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                       
                                        if($dataTable) foreach ($dataTable as $data){?>
                                        <tr>
                                            <?php $s = json_encode($data);?>
                                            <td class="" style="width: 3%"><?=$data['cod_guia']?></td>
                                            <td class="font-w600"><?=$data['nome']?> </td>
                                            <td class="font-w600"><?=formata_data_br($data['dt_abertura'])?> </td>
                                            <td class="font-w600"><?=($data['dt_realizacao'] != '0000-00-00') ? formata_data_br($data['dt_realizacao']) : ''?> </td>
                                            <td class="font-w600"><?=$data['horario']?> </td>
                                            <td class="font-w600"><?=$data['parceiro']?> </td>
                                            
                                            <?php if($data['status'] == 'p'){?>
                                                <td><button class="label label-warning" type="button" data-toggle="modal" data-target="#atualizarStatusModal" data-whatever='<?=$s;?>'>Pendente</button></td>
                                            <?php }else if($data['status'] == 'c'){?>    
                                                <td><button class="label label-info" type="button" data-toggle="modal" data-target="#atualizarStatusModal" data-whatever='<?=$s;?>'>Confirmada</button></td>
                                            <?php }else if($data['status'] == 'a'){?>    
                                                <td><button class="label label-success" type="button" data-toggle="modal" data-target="#atualizarStatusModal" data-whatever='<?=$s;?>'>Atendido</button></td>
                                            <?php }else if($data['status'] == 'n'){?>    
                                                <td><button class="label label-danger" type="button" data-toggle="modal" data-target="#atualizarStatusModal" data-whatever='<?=$s;?>'>Não compareceu</button></td>
                                            <?php }else if($data['status'] == 'l'){?>    
                                                <td><button class="label label-danger" type="button" data-toggle="modal" data-target="#atualizarStatusModal" data-whatever='<?=$s;?>'>Cancelado</button></td>
                                            <?php }?>

                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a class="btn btn-xs btn-default" type="button" href="<?=base_url('guias/novoPDF/' . $data['cod_guia'])?>"><i class="fa fa-file-text-o"></i></a>
                                               
                                                    <a class="btn btn-xs btn-default" type="button" href="<?=base_url('guias/visualizar/' . $data['cod_guia'])?>"><i class="fa fa-eye"></i></a>
    
                                                
                                                   

                                                    <button class="btn btn-xs btn-default" type="button" data-toggle="modal" data-target="#excluirModal" data-whatever='<?=$s;?>' data-cod="<?=$data['cod_guia']?>"><i class="fa fa-times"></i></button>

                                                </div>
                                            </td>
                                        </tr>
                                    <?php  } ?>
                                    </tbody>
                                </table>
                            </div>
                        <div class="block-header" style="margin-left: -20px; color:#bbb">
                                <h3 class="block-title">Serviços disponíveis</h3>
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
                                       
                                        if($dataServicos) foreach ($dataServicos as $data){?>
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

                            <div class="row">
                                <div class="col-xs-12">
                                    
                                    <a class="btn btn-primary" style="float: right; margin-bottom: 20px;" href="<?=base_url('guias/novo')?>">Novo</a>
                                </div>
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

                                                if($dataCentro) foreach ($dataCentro as $data){
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

<div class="modal fade" id="atualizarStatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <form method="POST" action="<?=base_url('guias/atualizar-status');?>" >
                <div class="modal-content">                        <div class="block block-themed block-transparent remove-margin-b">
                            <div class="block-header bg-primary-dark">
                                <ul class="block-options">
                                    <li>
                                        <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                                    </li>
                                </ul>
                                <h1>
                                <h3 class="block-title">Alterar Status</h3>
                            </div>
                            <div class="block-content">
                                <div class="form-group">
                                    <label class="control-label" for="status">Status </label>
                                    <div class="">
                                        <select class="form-control" type="text" id="status" name="status" placeholder="Escolha uma opção...">
                                            <option value="a">Atendido</option>
                                            <option value="n">Não compareceu</option>
                                            <option value="l">Cancelado</option>
                                            <option value="c">Confirmado</option>
                                            <option value="p">Pendente</option>
                                            
                                        </select>
                                    </div>
                                </div>    
                                       
                                    <input id="cod_guia" type="hidden" name="cod_guia">
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
                            <form method="POST" action="<?=base_url('guias/delete');?>">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <p>Deseja realmente excluir: <span id="codigo_guia"></span> - <span id="nome_guia"></span>?</p>
                                        <input type="hidden" class="form-control" name='cod_guia' id="cod">
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
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->

            

<?php $this->load->view('commons/footer');?>
<script>

        $('#excluirModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          console.log(recipient);
          console.log(recipient.nome);
          var modal = $(this)
          modal.find('#cod').val(recipient.cod_guia)
          modal.find('#nome_guia').text(recipient.nome);
          modal.find('#codigo_guia').text(recipient.cod_guia);
        });

        $('#atualizarStatusModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          console.log(recipient);
          var modal = $(this)
          modal.find('#cod_guia').val(recipient.cod_guia)
          modal.find('#nome').text(recipient.nome);
          modal.find('#codigo').text(recipient.cod_guia);
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