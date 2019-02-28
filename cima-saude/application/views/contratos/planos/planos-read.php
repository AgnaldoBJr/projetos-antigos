<?php 
    $this->load->view('commons/header');
    $this->load->helper('funcoes');
?>
<!-- Main Container -->
            <main id="main-container">
         	    <!-- Page Header -->
                <div class="content bg-gray-lighter">
                    <div class="row items-push">
                        <div class="col-sm-7">
                            <h1 class="page-heading">
                                Planos
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
                        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
                            <div class="col-lg-12">
                                <table class="table table-bordered table-striped js-dataTable-full" >
                                    <thead>    
                                        <tr>
                                            <th class="text-center"></th>
                                            <th>Nome</th>
                                            <th>Descrição</th>
                                            <th>Valor (R$)</th>
                                            <th class="text-center">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        if($dataTable) foreach ($dataTable as $data){
                                    ?>
                                        <tr>
                                        <?php $s = json_encode($data);?>
                                        <td class="text-center"><?=$data['cod_plano']?></td>
                                            <td class="font-w600"><?=$data['nome']?> </td>
                                            <td class="font-w600"><?=$data['descricao']?> </td>
                                            <td class="font-w600"><?php echo formata_preco($data['valor']);?> </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    
                                                    <a class="btn btn-xs btn-default" type="button" href="<?=base_url('planos/atualizar/' . $data['cod_plano'])?>"><i class="fa fa-pencil"></i></a>

                                                    <button class="btn btn-xs btn-default" type="button" data-toggle="modal" data-target="#excluirModal" data-whatever='<?=$s?>'><i class="fa fa-times"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>   
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    
                                    <a class="btn btn-primary" style="float: right; margin-bottom: 20px;" href="<?=base_url('planos/novo')?>">Novo</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Dynamic Table Full -->
                       

                    <div class="modal fade" id="excluirModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog" role="document">
                            <form method="POST" action="<?=base_url('planos/delete');?>">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <p>Deseja realmente excluir o plano: <span id="codigo"></span> - <span id="nome"></span>?</p>
                                        <input type="hidden" class="form-control" name='cod_plano' id="cod_plano">
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
          modal.find('#cod_plano').val(recipient.cod_plano)
          modal.find('#nome').text(recipient.nome);
          modal.find('#codigo').text(recipient.cod_plano);
        });

</script>