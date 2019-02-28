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
                                Pós-Atendimento
                            </h1>
                            <span></span> 
                        </div>
                    </div>
                </div>
                <!-- END Page Header -->
                <!-- ///////////////////////////////////////////////-->
                <div class="content" style="margin-top: -20px" >
                    <!-- Dynamic Table Full -->
                    <div class="block">
                        <form action="<?=base_url('pos-atendimento/relatorios')?>" method="post" id="filtro"  target="_blank">
                            <div class="block-content">
                                <div class="row">
                                    <div class="col-sm-11">
                                        
                                    </div>
                                    <div class="col-sm-1" style="float: right;">
                                        
                                        <button class="btn btn-xs btn-default" name="relatorio" type="submit" value="pdf"><i class="fa fa-file-text-o"></i></button>
                                        
                                        <button class="btn btn-xs btn-default" name="relatorio" type="submit" value="rel"><i class="fa fa-list-alt"></i></button>
                                    </div>
                                </div>
                              
                                <div class="row">    
                                    <div class="form-group col-md-3">
                                        <label class="control-label">Período de Avaliação</label>
                                        <div class="">
                                            <input type="text" name="periodo" class="form-control" id="reportrange" placeholder="dd/mm/aaaa - dd/mm/aaaa">
                                           
                                        </div>
                                        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('c-inicial')?></div>
                                         <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('c-final')?></div>
                                    </div>
                                    
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="parceiro">Parceiro </label>
                                        <div class="">
                                            <select class="form-control" type="text" id="parceiro" name="parceiro" placeholder="Escolha uma opção...">
                                                <option value=<?php null;?>>Escolha uma opção...</option>
                                                <?php
                                                    if($dataParceiro != false)
                                                    if($dataParceiro) foreach ($dataParceiro as $data){
                                                ?>
                                                    <option value="<?=$data['cod_parceiro']?>" <?php if($data['cod_parceiro'] == $this->input->post('parceiro')) echo "selected";?>><?=$data['nome']?></option>

                                                <?php }?>
                                            </select>
                                           
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label">Status</label>
                                        <div class="">
                                            <select class="form-control" type="text" name="status" placeholder="Escolha uma opção...">
                                                <option value=<?php null;?>>Escolha uma opção...</option>
                                                <option value="1" <?php if("1" == $this->input->post('status')) echo 'selected';?>>Muito Bom</option>
                                                <option value="2" <?php if("2" == $this->input->post('status')) echo 'selected';?>>Bom</option>
                                                <option value="3" <?php if("3" == $this->input->post('status')) echo 'selected';?>>Regular</option>
                                                <option value="4" <?php if("4" == $this->input->post('status')) echo 'selected';?>>Ruim</option>
                                            </select>
                                        </div>
                                    </div>
                                

                                    
                                </div>
                            </div>
                    </form>
                </div>
            </div>   
                <!-- ///////////////////////////////////////////////-->



                <!-- Page Content -->
                <div class="content">
                    <!-- Dynamic Table Full -->
                    <div class="block">
                        <div class="block-content">
                       
                        <div class="row">
                            <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
                            <div class="col-lg-12 "><!--col-lg-offset-1-->
                                <table class="table table-bordered table-striped js-dataTable-full" >
                                    <thead>
                                        <tr>
                                            <th class="text-center"></th>
                                            <th>Paciente</th>
                                            <th>Data Abertura</th>
                                            <th>Data Realização</th>
                                            <th>Horário</th>
                                            <th>Parceiro</th>
                                            <th>Status</th>
                                            <th class="text-center" width="30%">Avaliação</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                       
                                        if($dataTable) foreach ($dataTable as $data){?>
                                        <tr>
                                            <?php $s = json_encode($data);?>
                                            <td class="text-center"><?=$data['cod_guia']?></td>
                                            <td class="font-w600"><?=$data['nome']?> </td>
                                            <td class="font-w600"><?=formata_data_br($data['dt_abertura'])?> </td>
                                            <td class="font-w600"><?=($data['dt_realizacao'] != '0000-00-00') ? formata_data_br($data['dt_realizacao']) : ''?> </td>
                                            <td class="font-w600"><?=$data['horario']?> </td>
                                            <td class="font-w600"><?=$data['nome_realizador']?> </td>
                                            
                                             <?php if($data['status'] == 'p'){?>
                                                <td><span class="label label-warning">Pendente</span></td>
                                            <?php }else if($data['status'] == 'c'){?>    
                                                <td><span class="label label-info">Confirmada</span></td>
                                            <?php }else if($data['status'] == 'a'){?>    
                                                <td><span class="label label-success">Atendido</span></td>
                                            <?php }?>

                                            <td class="text-center">
                                                <div class="btn-group">
                                                   
                                                    <?php if($data['avaliacao'] != ''){ ?>
                                                        <?php if($data['avaliacao'] == '1'){?>
                                                            <span class="label label-success" data-toggle="tooltip" data-placement="top" title="Muito Bom! <?=$data['descricao']?>">Muito Bom</span>
                                                        <?php }else if($data['avaliacao'] == '2'){?>    
                                                            <span class="label label-info" data-placement="top" title="Bom! <?=$data['descricao']?>">Bom</span>
                                                        <?php }else if($data['avaliacao'] == '3'){?>    
                                                            <span class="label label-warning" data-placement="top" title="Regular! <?=$data['descricao']?>">Regular</span>
                                                        <?php } else if($data['avaliacao'] == '4'){?>    
                                                            <span class="label label-danger" data-placement="top" title="Ruim! <?=$data['descricao']?>">Ruim</span></td>
                                                         <?php } else if($data['avaliacao'] == '5'){?>    
                                                            <span class="label label-danger" data-placement="top" title="Muito Ruim! <?=$data['descricao']?>">Muito Ruim</span></td>
                                                        <?php }?>


                                                    <?php } ?>
                                                
                                                    <button class="btn btn-xs btn-default" type="button" data-toggle="modal" data-target="#atualizarModal" data-whatever='<?=$s;?>'><i class="fa fa-check"></i></button>

                                                
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
            <form method="POST" action="<?=base_url('c-processos/PosAtendimento/atualizar');?>" >
                <div class="modal-content">                        <div class="block block-themed block-transparent remove-margin-b">
                            <div class="block-header bg-primary-dark">
                                <ul class="block-options">
                                    <li>
                                        <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                                    </li>
                                </ul>
                                <h1>
                                <h3 class="block-title">Avaliar Atendimento</h3>
                            </div>
                            <div class="block-content">
                                <div class="form-group">
                                    <label class="control-label" for="avaliacao">Avaliação </label>
                                    <div class="">
                                        <select class="form-control" type="text" id="avaliacao" name="avaliacao" placeholder="Escolha uma opção...">
                                            <option value="1">Muito bom</option>
                                            <option value="2">Bom</option>
                                            <option value="3">Regular</option>
                                            <option value="4">Ruim</option>
                                            
                                        </select>
                                    </div>
                                </div>    
                                    <textarea rows="3" class="form-control" name='descricao' id="descricao"></textarea>   
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
                    <p>Deseja realmente excluir a guia número: <span id="codigo"></span> do paciente <span id="nome"></span>?</p>
                    
                    <input type="hidden" class="form-control" name='cod_guia' id="cod_guia">
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

            

<?php $this->load->view('commons/footer');?>
<script>

         $('#atualizarModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          console.log(recipient);
          var modal = $(this)
          modal.find('#cod_guia').val(recipient.cod_guia)
          modal.find('#nome').text(recipient.nome);
          modal.find('#codigo').text(recipient.cod_guia);
          modal.find('#descricao').text(recipient.descricao);
        });

        

        $('#excluirModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          console.log(recipient);
          console.log(recipient.nome);
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