
<!-- Main Container -->
            <main id="main-container">
         	   
                <!-- Page Header -->
                <div class="content bg-gray-lighter">
                    <div class="row items-push">
                        <div class="col-sm-7">
                            <h1 class="page-heading">
                                Beneficiários
                            </h1>
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
                <div class="content">
                    <!-- Dynamic Table Full -->
                    <div class="block">
                        <div class="block-content">
                        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
                            <div class="col-lg-12">
                                <table class="table table-bordered table-striped js-dataTable-full" id="dataTeste">
                                    <thead>    
                                        <tr>
                                            <th width="40%">Nome</th>
                                            <th width="20%">Data Nasc.</th>
                                            <th width="20%">Carteirinha</th>
                                            <th width="10%">Tipo</th>
                                            <th width="10%">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        if($dataTable) foreach ($dataTable as $data){
                                    ?>
                                        <tr>
                                        <?php 
                                            $data['data_nasc'] = formata_data_br($data['data_nasc']);
                                            if($data['status'] == 'i'){
                                                $data['status'] = 'Inativo';
                                            } else {
                                                $data['status'] = 'Ativo';
                                            }

                                            if($data['tipo'] == 't'){
                                               $data['tipo'] ='Titular';
                                            
                                            }else if($data['tipo'] == 'd'){  
                                                $data['tipo']= 'Dependente';
                                            }else if($data['tipo'] == 'a'){   
                                                $data['tipo'] = 'Agregado';
                                            }else if($data['tipo'] == 'c'){
                                                $data['tipo'] = 'Colaborador';
                                            }
                                                
                                            $s = json_encode($data);?>
                                            <td class=""><?=$data['nome']?></td>
                                            <td class="font-w600"><?=$data['data_nasc']?> </td>
                                            <td class="font-w600"><?=$data['carteirinha']?> </td>
                                            
                                            <td>
                                            <?=$data['tipo']?>
                                            </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-xs btn-default" type="button" data-toggle="modal" data-backdrop="static" data-target="#beneficiarioModal" data-whatever='<?=$s;?>'><i class="fa fa-eye"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>   
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                
                            </div>
                        </div>
                    </div>
                    <!-- END Dynamic Table Full -->
                       

                    <div class="modal fade" id="beneficiarioModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog" role="document">
                            <form method="POST" action="<?=base_url('atendimento/beneficiarios/contar');?>">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        Nome: <b><span id="nomeModal"></span></b><br>
                                        Carteira: <b><span id="carteirinhaModal"></span></b><br>
                                        Tipo: <b><span id="tipoModal"></span></b><br>
                                        Data de Nascimento: <b><span id="dataNascModal"></span><br><br>
                                        <p  class="bg-primary" id="statusModal" style="padding: 10px 20px; text-align: center; margin-bottom: -30px"></p></b><br>
                                        <input type="hidden" name="cod_pessoa" id="codigoModal">
                                     </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-default" ">Ok</button>
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
        $('#beneficiarioModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          console.log(recipient);
          console.log(recipient.nome);
          var modal = $(this)
          modal.find('#nomeModal').text(recipient.nome);
          modal.find('#tipoModal').text(recipient.tipo);
          modal.find('#dataNascModal').text(recipient.data_nasc);
          modal.find('#carteirinhaModal').text(recipient.carteirinha);
          modal.find('#statusModal').text(recipient.status);
          modal.find('#codigoModal').val(recipient.cod_pessoa);
        });

</script>


