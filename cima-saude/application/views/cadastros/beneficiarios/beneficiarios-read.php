<?php 
    $this->load->view('commons/header');
?>
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
                                <table class="table table-bordered table-striped js-dataTable-full" >
                                    <thead>    
                                        <tr>
                                            <th>Nome</th>
                                            <th>Carteirinha</th>
                                            <th>Tipo</th>
                                            <th>Status</th>
                                            <th class="text-center">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        if($dataTable) foreach ($dataTable as $data){
                                    ?>
                                        <tr>
                                        <?php $s = json_encode($data);?>
                                            <td class=""><?=$data['nome']?></td>
                                            <td class="font-w600"><?=$data['carteirinha']?> </td>
                                            
                                            <?php if($data['tab'] == '1'){?>
                                                    <td>Titular</td>
                                                <?php }else if($data['tab'] == '2'){?>    
                                                    <td>Dependente</td>
                                                <?php }else if($data['tab'] == '3'){?>    
                                                    <td>Agregado</td>
                                                <?php }else if($data['tab'] == '4'){?>    
                                                    <td>Colaborador</td>
                                            <?php }?>
                                            <td class="font-w600"><span class="label label-success">Ativo</span></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    
                                                    <a class="btn btn-xs btn-default" type="button" href="<?=base_url('beneficiarios/atualizar/' . $data['cod'] . '/' . $data['tab'])?>"><i class="fa fa-pencil"></i></a>

                                                     <a class="btn btn-xs btn-default" type="button" href="<?=base_url('beneficiarios/visualizar/' . $data['cod'] . '/' . $data['tab'])?>"><i class="fa fa-eye"></i></a>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>   
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    
                                    <a class="btn btn-primary" style="float: right; margin-bottom: 20px;" href="<?=base_url('clientes/novo')?>">Novo</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Dynamic Table Full -->
                       

                    <div class="modal fade" id="excluirModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog" role="document">
                            <form method="POST" action="<?=base_url('clientes/delete');?>">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <p>Deseja realmente excluir: <span id="codigo"></span> - <span id="nome"></span>?</p>
                                        <input type="hidden" class="form-control" name='cod_cliente' id="cod_cliente">
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
          modal.find('#cod_cliente').val(recipient.cod_cliente)
          modal.find('#nome').text(recipient.nome);
          modal.find('#codigo').text(recipient.cod_cliente);
        });

</script>