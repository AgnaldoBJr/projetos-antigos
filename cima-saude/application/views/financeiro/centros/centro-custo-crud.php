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
                               Centros de Custo
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
                            <!--FORMULÁRIO DE NOVO CENTRO DE CUSTO
                            Nome*  |  Cadastrar -->
                            <div class="block-header" style="margin-left: -20px; color:#bbb">
                                <h3 class="block-title">Novo Centro de Custo</h3>
                            </div>
                            <form method="POST" action="<?=base_url('c-financeiro/CentroCusto/inserir')?>">
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="control-label" for="centro-custo-nome">Nome <span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control" type="text" id="centro-custo-nome" name="centro-custo-nome" placeholder="Insira um nome" value="<?= $this->input->post('centro-custo-nome');?>">
                                        </div>
                                        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('centro-custo-nome')?></div>
                                    </div>
                                    <div class="col-md-3" style="margin-top:23px">
                                        <input type="submit" class="btn btn-primary" value="Cadastrar">
                                    </div>
                                </div>
                            </form>
                            <!--Fim do FORMUlÁRIO-->

                            <div class="block-header" style="margin-left: -20px; color:#bbb">
                                <h3 class="block-title">Lista de Centros de Custo</h3>
                            </div>
                            <div class="row">
                                <div class="col-lg-8 col-lg-offset-2">
                                    <table class="table table-bordered table-striped js-dataTable-full" >
                                        <thead>
                                            <tr>
                                                <th class="text-center"></th>
                                                <th ">Nome</th>
                                                <th class="text-center" ">Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                           
                                            if($dataTable) foreach ($dataTable as $data){?>
                                            <tr>
                                                <?php $s = json_encode($data);?>
                                                <td class="text-center"><?=$data['cod_centro_de_custo']?></td>
                                                <td class="font-w600"><?=$data['nome']?> </td>
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        
                                                        <button class="btn btn-xs btn-default" type="button" data-toggle="modal" data-target="#atualizarModal" data-whatever='<?=$s;?>'><i class="fa fa-pencil"></i></button>

                                                        <button class="btn btn-xs btn-default" type="button" data-toggle="modal" data-target="#excluirModal" data-whatever='<?=$s;?>'><i class="fa fa-times"></i></button>

                                                        
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                           
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Dynamic Table Full -->

<div class="modal fade" id="atualizarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <form method="POST" action="<?=base_url('c-financeiro/CentroCusto/atualizar');?>">
                <div class="modal-content">                        <div class="block block-themed block-transparent remove-margin-b">
                            <div class="block-header bg-primary-dark">
                                <ul class="block-options">
                                    <li>
                                        <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                                    </li>
                                </ul>
                                <h1>
                                <h3 class="block-title">Atualizar Centro de Custo</h3>
                            </div>
                            <div class="block-content">
                                <div class="form-group">
                                        <label class="control-label" for="nome">Nome <span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control" type="text" id="nome" name="nome" placeholder="Insira um nome">
                                        </div>
                                    </div>
                                    <input id="cod_centro_de_custo" type="hidden" name="cod_centro_de_custo">
                                </form>                
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-sm btn-primary" value="Atualizar">
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <!-- END Large Modal -->


<div class="modal fade" id="excluirModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
    <div class="modal-dialog" role="document">
        <form method="POST" action="<?=base_url('c-financeiro/CentroCusto/delete');?>">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Deseja realmente excluir o registro: <span id="nome"></span> ?</p>
                    
                    <input type="hidden" class="form-control" name='cod_centro_de_custo' id="cod_centro_de_custo">
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

         $('#atualizarModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          console.log(recipient);
          var modal = $(this)
          modal.find('#cod_centro_de_custo').val(recipient.cod_centro_de_custo)
          modal.find('#nome').val(recipient.nome);
        });

        

        $('#excluirModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          console.log(recipient);
          console.log(recipient.nome);
          var modal = $(this)
          modal.find('#cod_centro_de_custo').val(recipient.cod_centro_de_custo)
          modal.find('#nome').text(recipient.nome);
        });

</script>