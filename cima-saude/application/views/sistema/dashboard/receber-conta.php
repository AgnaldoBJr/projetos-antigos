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
                                Contas à Receber
                            </h1>
                        </div>
                        
                    </div>
                </div>
                <!-- END Page Header -->

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
                                            <th>Cliente</th>
                                            <th>Descrição</th>
                                            <th>Valor (R$)</th>
                                            <th>Data de recebimento</th>
                                            <th>Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if($dataTable) foreach ($dataTable as $data){
                                        ?>
                                        <tr>
                                                <?php $s = json_encode($data);?>
                                                <td class="text-center"><?=$data['cod_conta_a_receber']?></td>
                                                <td class="font-w600"><?=$data['nome']?> </td>
                                                <td class="font-w600"><?=$data['descricao']?> </td>
                                                <td class="font-w600"><?=formata_preco($data['valor'])?> </td>
                                                <td class="font-w600"><?=formata_data_br($data['dt_recebimento'])?> </td>
                                                <?php if($data['status'] == 1){?>
                                                    <td><a href="contas-a-receber/status/2/<?=$data['cod_conta_a_receber']?>"><span class="label label-danger">À Receber</span></a></td>
                                                <?php }else if($data['status'] == 2) {?>   
                                                    <td><a href="contas-a-receber/status/1/<?=$data['cod_conta_a_receber']?>"><span data-toggle="tooltip" data-placement="top" title="Recebido em: <?=formata_data_br($data['dt_real'])?>" type="button" class="label label-info">Recebido</span></a></td>
                                                <?php }?>
                                                
                                                
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                        <a href="<?=base_url('dashboard')?>" type="submit" name="salvar" class="btn btn-sm btn-primary" style="float: right; margin-right: 20px; margin-bottom: 20px;">Voltar</a>

                                </div>
                            </div>
                        </div>
                    </div>

<div class="modal fade" id="excluirModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
  <div class="modal-dialog" role="document">
    <form method="POST" action="<?=base_url('contas-a-receber/delete');?>">
    <div class="modal-content">
      <div class="modal-body">
        <p>Deseja realmente excluir <span id="itemExclusao"></span> </p>
        <input type="hidden" class="form-control" name='cod_conta_a_receber'>
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
             