
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
                                Exames
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
                                <h3 class="block-title">Novo exame</h3>
                                </div>
                                
                            <form action="<?=base_url('atendimento/exames/salvar');?>" method="POST" id="exame">
                            
                                <div class="row">

                                    <div class="form-group col-md-4">
                                        <label class="control-label" for="nome">Nome <span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control" type="text" name="nome" placeholder="Insira um nome" value="<?= $this->input->post('nome');?>">
                                            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('nome')?></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-5">
                                        <label for="descricao">Descrição</label>
                                        <div>
                                            <textarea class="form-control" name="descricao" rows="2" placeholder="Insira alguma descrição para o exame"></textarea>
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-3" style="margin-top:23px">
                                        <input type="submit" class="btn btn-primary" value="Cadastrar">
                                    </div>
                                </div>
                            </form>
                            <!--Fim do FORMUlÁRIO-->


                            <div class="block-header" style="margin-left: -20px; color:#bbb">
                                <h3 class="block-title">Lista de exames</h3>
                            </div>
                        <div class="row">
                            <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
                            <div class="col-lg-12 "><!--col-lg-offset-1-->
                                <table class="table table-bordered table-striped js-dataTable-full" >
                                    <thead>
                                        <tr>
                                            <th class="text-center"></th>
                                            <th>Nome</th> 
                                            <th class="text-center">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                       
                                        if($dataTable) foreach ($dataTable as $data){?>
                                        <tr>
                                            <?php $s = json_encode($data);?>
                                            <td class="text-center"><?=$data['cod_exame']?></td>
                                            <td class="font-w600"><?=$data['nome']?> </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                <?php if($data['fk_parceiro'] != 0) {?>
                                                    <button class="btn btn-xs btn-default" type="button" data-toggle="modal" data-target="#atualizarModal" data-whatever='<?=$s;?>'><i class="fa fa-pencil"></i></button>

                                                     <button class="btn btn-xs btn-default" type="button" data-toggle="modal" data-target="#excluirModal" data-whatever='<?=$s;?>' data-cod="<?=$data['cod_exame']?>"><i class="fa fa-times"></i></button>
                                                <?php } else {?>
                                                    <span class="label label-info">Nenhuma opção disponível</span>
                                                <?php } ?>
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
            <form method="POST" action="<?=base_url('atendimento/exames/atualizar');?>" id="exame_update">
                <div class="modal-content">                        <div class="block block-themed block-transparent remove-margin-b">
                            <div class="block-header bg-primary-dark">
                                <ul class="block-options">
                                    <li>
                                        <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                                    </li>
                                </ul>
                                <h1>
                                <h3 class="block-title">Atualizar Exame</h3>
                            </div>
                            <div class="block-content">
                                <div class="form-group">
                                        <label class="control-label" for="nome">Nome <span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control" type="text" id="nome" name="nome" placeholder="Insira um nome">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="descricao">Descrição</label>
                                        <div>
                                            <textarea class="form-control" name="descricao" rows="2" placeholder="Insira alguma descrição para o exame" id="descricao"></textarea>
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
        <form method="POST" action="<?=base_url('atendimento/exames/delete');?>">
            <div class="modal-content">
                <div class="modal-body">
                    <p>Deseja realmente excluir o parceiro: <span id="codigo"></span> - <span id="nome"></span>?</p>
                    
                    <input type="hidden" class="form-control" name='cod_exame' id="cod_exame">
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
          modal.find('#cod_exame').val(recipient.cod_exame)
          modal.find('#nome').val(recipient.nome);
          modal.find('#descricao').val(recipient.descricao);
        });

        

         $('#excluirModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
          console.log(recipient);
          console.log(recipient.nome);
          var modal = $(this)
          modal.find('#cod_exame').val(recipient.cod_exame)
          modal.find('#nome').text(recipient.nome);
          modal.find('#codigo').text(recipient.cod_exame);
        });

</script>

<script type="text/javascript">
//linha para usar a biblioteca Jquery
    $().ready(function() {
        //utiliza o formulário escolhido por ID
    
        $('#exame').validate({
            // FAZ A VALIDAÇÃO EM TEMPO REAL"
            onkeyup: function(element) {
                this.element(element);
            },
        

            //objeto com duas propriedades rules e messages
            rules: {
                
            
                'nome': {
                    required : true,
                    //dateBR : true 
                },

                
            },

            messages: {
                'nome' : {
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
    
        $('#exame_update').validate({
            // FAZ A VALIDAÇÃO EM TEMPO REAL"
            onkeyup: function(element) {
                this.element(element);
            },
            //objeto com duas propriedades rules e messages
            rules: { 
                'nome': {
                    required : true,
                    //dateBR : true 
                },            
            },
            messages: {
                'nome' : {
                    required : "Campo Obrigatório!",
                    //dateBR : "Data inválida" 
                }, 
            }
        });
    });


</script>