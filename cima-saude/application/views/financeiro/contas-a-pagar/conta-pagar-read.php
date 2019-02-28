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
                <div class="content bg-gray-lighter" style="height: 80px">
                    <div class="row items-push">
                        <div class="col-sm-10">
                            <h1 class="page-heading">
                                Contas à Pagar
                            </h1>

                            
                        </div>
                        <div class="col-sm-2">
                            <a href="contas-a-pagar/novo" class="btn btn-large btn-primary btn-rounded" style="float: right;">Novo</a>
                        </div>
                    </div>
                </div>
                <!-- END Page Header -->

                <!-- ///////////////////////////////////////////////-->
                <div class="content" style="margin-top: -20px" >
                    <!-- Dynamic Table Full -->
                    <div class="block">
                    <form action="<?=base_url('contas-a-pagar/relatorios')?>" method="post" id="filtro"  target="_blank">
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
                                        <label class="control-label">Período</label>
                                        <div class="">
                                            <input type="text" name="periodo" class="form-control" id="reportrange" placeholder="dd/mm/aaaa - dd/mm/aaaa">
                                           
                                        </div>
                                        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('c-inicial')?></div>
                                         <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('c-final')?></div>
                                    </div>
                                    
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="fornecedor">Fornecedor </label>
                                        <div class="">
                                            <select class="form-control" type="text" id="fornecedor" name="fornecedor" placeholder="Escolha uma opção...">
                                                <option value=<?php null;?>>Escolha uma opção...</option>
                                                <?php
                                                    if($dataFornecedor != false)
                                                    if($dataFornecedor) foreach ($dataFornecedor as $data){
                                                ?>
                                                    <option value="<?=$data['cod_fornecedor']?>" <?php if($data['cod_fornecedor'] == $this->input->post('fornecedor')) echo "selected";?>><?=$data['nome']?></option>

                                                <?php }?>
                                            </select>
                                            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('c-pagar-fornecedor')?></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="centro">Centro de Custo</label>
                                        <div class="">
                                            <select class="form-control" type="text"  name="centro" placeholder="Escolha uma opção...">
                                                <option value=<?php null;?>>Escolha uma opção...</option>
                                                <?php
                                                $p = json_encode($dataCentro);
                                                    if($dataCentro) foreach ($dataCentro as $data){
                                                         
                                                ?>
                                                    <option value="<?=$data['cod_centro_de_custo']?>" <?php if($data['cod_centro_de_custo'] == $this->input->post('centro')) echo "selected";?>><?=$data['nome']?></option>
                                                <?php } ?>
                                            </select>
                                            
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="categoria">Categoria</label>
                                        <div class="">
                                            <select class="form-control" type="text"  name="categoria" placeholder="Escolha uma opção...">
                                                <option value=<?php null;?>>Escolha uma opção...</option>
                                                <?php
                                                $p = json_encode($dataCategoria);
                                                    if($dataCategoria) foreach ($dataCategoria as $data){
                                                         
                                                ?>
                                                    <option value="<?=$data['cod_cat_conta_a_pagar']?>" <?php if($data['cod_cat_conta_a_pagar'] == $this->input->post('categoria')) echo "selected";?>><?=$data['nome']?></option>
                                                <?php } ?>
                                            </select>
                                            
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="conta">Conta </label>
                                        <div class="">
                                            <select class="form-control" type="text" id="conta" name="conta" placeholder="Escolha uma opção...">
                                                <option value=<?php null;?>>Escolha uma opção...</option>
                                                <?php
                                                    if($dataConta != false)
                                                    if($dataConta) foreach ($dataConta as $data){
                                                ?>
                                                    <option value="<?=$data['cod_conta']?>" <?php if($data['cod_conta'] == $this->input->post('conta')) echo "selected";?>><?=$data['nome']?></option>

                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label">Status</label>
                                        <div class="">
                                            <select class="form-control" type="text" name="status" placeholder="Escolha uma opção...">
                                                <option value=<?php null;?>>Escolha uma opção...</option>
                                                <option value="T" <?php if("T" == $this->input->post('status')) echo 'selected';?>>Todas</option>
                                                <option value="P" <?php if("P" == $this->input->post('status')) echo 'selected';?>>Pagas</option>
                                                <option value="N" <?php if("N" == $this->input->post('status')) echo 'selected';?>>Não Pagas</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                    </form>
                </div>
                <div class="modal fade" id="avisoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                    <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <p>Função indisponível. Em breve você poderá imprimir os relatórios. Estamos trabalhando nisso :)</p>
                                 </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                                </div>
                            </div>    
                    </div>
                </div>
                <!-- ///////////////////////////////////////////////-->

         	    <!-- Page Content -->
                <div class="content" style="margin-top: -45px">
                    <!-- Dynamic Table Full -->
                    <div class="block">
                        <div class="block-content">
                        <div class="col-lg-12">
                                <table class="table table-bordered table-striped js-dataTable-full" >
                                    <thead>
                                        <tr>
                                            <th class="text-center"></th>
                                            <th>Descrição</th>
                                            <th>Valor (R$)</th>
                                            <th>Data de pagamento</th>
                                            <th>Status</th>
                                            <th class="text-center" ">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if($dataTable) foreach ($dataTable as $data){
                                        ?>
                                        <tr>
                                                <?php $s = json_encode($data);?>
                                                <td class="text-center"><?=$data['cod_conta_a_pagar']?></td>
                                                <td class="font-w600"><?=$data['descricao']?> </td>
                                                <td class="font-w600"><?=formata_preco($data['valor'])?> </td>
                                                <td class="font-w600"><?=formata_data_br($data['dt_pagamento'])?> </td>
                                                <?php if($data['status'] == 1){?>
                                                    <td><a href="contas-a-pagar/status/2/<?=$data['cod_conta_a_pagar']?>"><span class="label label-danger">À pagar</span></a></td>
                                                <?php }else if($data['status'] == 2) {?>    
                                                   <td> <a href="contas-a-pagar/status/1/<?=$data['cod_conta_a_pagar']?>"><span data-toggle="tooltip" data-placement="top" title="Pago em: <?=formata_data_br($data['dt_real'])?>" type="button" class="label label-info">Pago</span></a></td>
                                                <?php }?>
                                                
                                                <td class="text-center">
                                                    <div class="btn-group">
                                                        
                                                        <a class="btn btn-xs btn-default" type="button" href="<?=base_url('contas-a-pagar/atualizar/' . $data['cod_conta_a_pagar'])?>"><i class="fa fa-pencil"></i></a>

                                                        <button class="btn btn-xs btn-default" type="button" data-toggle="modal" data-target="#excluirModal" data-whatever="<?=$data['cod_conta_a_pagar']?>"><i class="fa fa-times"></i></button>

                                                        
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    
                                    <a class="btn btn-primary" style="float: right; margin-bottom: 20px;" href="<?=base_url('contas-a-pagar/novo')?>">Novo</a>
                                </div>
                            </div>
                        </div>
                    </div>

<div class="modal fade" id="excluirModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <form method="POST" action="<?=base_url('contas-a-pagar/delete');?>">
    <div class="modal-content">
      <div class="modal-body">
        <p>Deseja realmente excluir <span id="itemExclusao"></span> </p>
        <input type="hidden" class="form-control" name='cod_conta_a_pagar'>
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
          var modal = $(this)
           modal.find('.modal-body span').text(recipient)
           modal.find('.modal-body input').val(recipient);
        });

</script>

<script type="text/javascript">
//linha para usar a biblioteca Jquery
    $().ready(function() {
        //utiliza o formulário escolhido por ID
    
        $('#filtro').validate({
            // FAZ A VALIDAÇÃO EM TEMPO REAL"
                 //onkeyup: function(element) {
                 //   this.element(element);
                //},
        

            //objeto com duas propriedades rules e messages
            rules: {
                'c-inicial' : {
                    required : "#c-final:filled",
                    dateBR : true },
            
                'c-final': {
                    required : "#c-inicial:filled",
                    dateBR : true },

                'v-inicial' : {
                    required : "#v-final:filled",
                    dateBR : true },
            
                'v-final': {
                    required : "#v-inicial:filled",
                    dateBR : true },
            },

            messages: {
                'c-inicial' : {
                    required : "Preencha o filtro corretamente",
                    dateBR : "Data inválida" },
                'c-final' : {
                    required : "Preencha o filtro corretamente",
                    dateBR : "Data inválida" },
                'v-inicial' : {
                    required : "Preencha o filtro corretamente",
                    dateBR : "Data inválida" },
                'v-final' : {
                    required : "Preencha o filtro corretamente",
                    dateBR : "Data inválida" },
            }

        });
    });

/*
* Este método pode ser adicionado dentro do $('ducument').ready();
*/
$.validator.addMethod("dateBR", function(value, element) {
            if(value == "") return true;

            if(value.length!=10) return false;
            // verificando data
            var data       = value;
            var dia         = data.substr(0,2);
            var barra1   = data.substr(2,1);
            var mes        = data.substr(3,2);
            var barra2   = data.substr(5,1);
            var ano         = data.substr(6,4);
            if(data.length!=10||barra1!="/"||barra2!="/"||isNaN(dia)||isNaN(mes)||isNaN(ano)||dia>31||mes>12)return false;
            if((mes==4||mes==6||mes==9||mes==11) && dia==31)return false;
            if(mes==2  &&  (dia>29||(dia==29 && ano%4!=0)))return false;
            if(ano < 1900)return false;
            return true;
        }, "Informe uma data válida");  // Mensagem padrão


</script>

