


            <main id="main-container">
         	    <!-- Page Header -->
                <div class="content bg-gray-lighter">
                    <div class="row items-push">
                        <div class="col-sm-7">
                            <h1 class="page-heading">
                                Atendimentos
                            </h1>
                        </div>
                        <div class="col-sm-5">
                            <a href="<?=base_url('atendimento/atendimentos/novo')?>" class="btn btn-large btn-primary btn-rounded" type="button" style="float: right;">Novo Atendimento</a> 
                        
                            <!--<a href="" class="btn btn-large btn-primary btn-rounded" style="float: right;">Novo Atendimento</a>
                        -->
                           
                        </div>
                    </div>
                </div>
                <!-- END Page Header -->
                <?php if($this->session->flashdata('msg')): ?>
                  
                    <div class="col-xs-11 col-sm-4 alert alert-success animated fadeIn" id="success-alert" role="alert" style=" margin: 0px auto; position: fixed;  z-index: 1033; top: 20px; right: 20px">
                        <button type="button" class="close" style="font-size: 14px" data-dismiss="alert">x</button>
                        <strong>Sucesso! </strong>
                        <?php echo $this->session->flashdata('msg'); ?>
                    </div>
                <?php endif; ?>
         	    <!-- Page Content -->

<!-- ///////////////////////////////////////////////-->
                <div class="content" style="margin-top: -20px" >
                    <!-- Dynamic Table Full -->
                    <div class="block">
                    <form action="<?=base_url('atendimento/atendimentos/relatorios')?>" method="post" id="filtro"  target="_blank">
                        <div class="block-content">
                    
                              
                                <div class="row">
                                     <div class="form-group col-md-3">
                                        <label class="control-label">Beneficiário (Carteira)</label>
                                        
                                        <input class="form-control" type="text" name="carteiras" list="carteiras_num" id="carteiras">
                                        <datalist id="carteiras_num">
                                        <?php
                                            if($dataBeneficiario) foreach ($dataBeneficiario as $data){
                                               
                                        ?>
                                                    <option><?=$data['carteirinha']?></option>

                                        <?php } ?>
                                        </datalist>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label">Tipo</label>
                                        <div class="">
                                            <select class="form-control" type="text" name="status" placeholder="Escolha uma opção...">
                                                <option value=<?php null;?>>Escolha uma opção...</option>
                                                <option value="c" <?php if("c" == $this->input->post('status')) echo 'selected';?>>Consulta</option>
                                                <option value="r" <?php if("r" == $this->input->post('status')) echo 'selected';?>>Retorno</option>
                                                
                                            </select>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="dt_realizacao">Data de realização</label>
                                        <div class="">
                                            <input class="form-control data" type="text" id="dt_realizacao" name="dt_realizacao" placeholder="Ex.: dd/mm/aaaa" value="<?php echo date('d/m/Y');?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="horario">Horário</label>
                                        <div class="">
                                            <input class="form-control horario" type="text" id="horario" name="horario" placeholder="Ex.: hh:mm" value="<?php if ($this->input->post('horario') != null) echo $this->input->post('horario');// else echo $horario;?>">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-5" id="dados" >
                                    
                                    </div>
                                </div>
                                    
                                
                        </div>
                    <p id="json" style="display: none"><?=$json?></p>
                    </form>
                </div>
                
                <!-- ///////////////////////////////////////////////-->
<script type="text/javascript">
    var json = JSON.parse(document.getElementById('json').innerHTML);
    console.log(json)
    console.log(json.length)
    console.log(json[0]['carteirinha'])



    var carteiras = document.getElementById('carteiras');
    carteiras.addEventListener('change', function(){
        console.log(carteiras.value);

        for(var i = 0; i < json.length; i++){
            if(json[i]['carteirinha'] == carteiras.value){


                document.getElementById('dados').display = 'block'
                document.getElementById('dados').innerHTML = json[i]['nome']
            }
        }
    })

</script>



                <div class="content" style="margin-top: -45px">
                    <!-- Dynamic Table Full -->
                    <div class="block">
                        <div class="block-content">
                        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
                           
                        <div class="row">
                            <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
                            <div class="col-lg-12 "><!--col-lg-offset-1-->
                                <table class="table table-bordered table-striped js-dataTable-full" >
                                    <thead>
                                        <tr>
                                            <th class="text-center"></th>
                                            <th>Beneficiário</th>
                                            <th>Data Abertura</th>
                                            <th>Data Realização</th>
                                            <th>Horário</th>
                                            
                                            <th>Status</th>
                                            <th class="text-center">Ações</th>
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
                                                    <a class="btn btn-xs btn-default" type="button" href="<?=base_url('atendimento/atendimentos/novoPDF/' . $data['cod_guia'])?>"><i class="fa fa-file-text-o"></i></a>
                                               
                                                    <a class="btn btn-xs btn-default" type="button" href="<?=base_url('atendimento/atendimentos/visualizar/' . $data['cod_guia'])?>"><i class="fa fa-eye"></i></a>

                                                     <a class="btn btn-xs btn-default" type="button" href="<?=base_url('atendimento/atendimentos/atualizar/' . $data['cod_guia'])?>"><i class="fa fa-pencil"></i></a>
    
                                                
                                                    
                                                    <button class="btn btn-xs btn-default" type="button" data-toggle="modal" data-target="#excluirModal" data-whatever='<?=$s;?>' data-cod="<?=$data['cod_guia']?>"><i class="fa fa-times"></i></button>

                                                </div>
                                            </td>
                                        </tr>
                                    <?php  } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Dynamic Table Full -->
                    <div class="modal fade" id="fIndisponivelModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <p>Funcionalidade em desenvolvimento!</p>
                                     </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                                    </div>
                                </div>    
                        </div>
                    </div>

<div class="modal fade" id="atualizarStatusModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <form method="POST" action="<?=base_url('atendimento/atendimentos/atualizar-status');?>" >
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
                            <form method="POST" action="<?=base_url('atendimento/atendimentos/delete');?>">
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