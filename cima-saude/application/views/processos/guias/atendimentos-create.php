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
                                Nova Guia de Atendimento
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
                    <form action="<?=base_url('guias/salvar');?>" method="POST" id="guias">
                        <div class="block">
                            <div class="block-content">
                            
                            <!--Proposta form-->
                                <div class="row">
                                    
                                    <div class="form-group col-md-4">
                                        <label class="control-label" for="beneficiario">Beneficiário <span class="text-danger">*</span></label>
                                        <div>
                                            <select class="form-control" type="text" id="beneficiario" name="beneficiario" placeholder="Escolha uma opção...">
                                                <option value=<?php null;?>>Escolha uma opção...</option>
                                                <?php
                                                    if($dataPacientes) foreach ($dataPacientes as $data){
                                                       
                                                ?>
                                                    <option value="<?php echo $data['cod'] . '-' . $data['tab']?>" <?php if($this->input->post('beneficiario') == ($data['cod'] . '-' . $data['tab'])) echo 'selected'?>><?=$data['nome']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="dt_abertura">Data de abertura <span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control data" type="text" id="dt_abertura" name="dt_abertura" placeholder="Ex.: dd/mm/aaaa" value="<?php echo date('d-m-Y')?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="dt_realizacao">Data de realização</label>
                                        <div class="">
                                            <input class="form-control data" type="text" id="dt_realizacao" name="dt_realizacao" placeholder="Ex.: dd/mm/aaaa" value="<?php if ($this->input->post('dt_realizacao') != null) echo $this->input->post('dt_realizacao');// else echo $dt_realizacao;?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label" for="horario">Horário</label>
                                        <div class="">
                                            <input class="form-control horario" type="text" id="horario" name="horario" placeholder="Ex.: hh:mm" value="<?php if ($this->input->post('horario') != null) echo $this->input->post('horario');// else echo $horario;?>">
                                        </div>
                                    </div>
                                    
                                </div>
                                <input type="hidden" id="parceiro" name="parceiro" value="<?=$this->session->userdata('id')?>">
                                <div class="row">
                                   
                                    <div class="form-group col-md-4">
                                        <label class="control-label" for="pagamento">Tipo</label>
                                        <div>
                                              <select class="form-control" type="text" id="pagamento" name="pagamento" placeholder="Escolha uma opção...">
                                                <option value="c">Valor Cima</option>
                                                 <option value="r">Valor com recibo</option>
                                            </select>
                                        </div>
                                  
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="control-label" for="parceiro">Parceiro <span class="text-danger">*</span></label>
                                        <div>
                                            <select class="form-control" type="text" id="parceiro" name="parceiro" placeholder="Escolha uma opção...">
                                                <option value=<?php null;?>>Escolha uma opção...</option>
                                                <?php
                                                    if($dataParceiros) foreach ($dataParceiros as $data){
                                                       
                                                ?>
                                                    <option value="<?php echo $data['cod_parceiro']?>" <?php if($this->input->post('parceiro') == $data['cod_parceiro']) echo 'selected'?>><?=$data['nome']?></option>

                                                <?php } ?>
                                            </select>
                                        </div>
                                        
                                    </div>
                               
                            </div>
                        </div><!--Fim de Proposta-form-->

                        <div class="block">
                            <div class="block-content">
                         <div class="block-header" style="margin-left: -20px; color:#bbb">
                                <h3 class="block-title">Lista de serviços</h3>
                            </div>
                        <div class="row">
                            <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
                            <div class="col-lg-12 "><!--col-lg-offset-1-->
                                <table class="table table-bordered table-striped js-dataTable-full" >
                                    <thead>
                                        <tr>
                                            <th class="text-center"></th>
                                            <th class="text-center" style="width: 55%">Nome</th>
                                            <th>Valor (R$)</th>
                                            <th>Valor Cima (R$)</th>
                                            <th>Valor Recibo (R$)</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody id='lista_servicos'>
                                    <?php
                                       
                                        if($dataServicos) foreach ($dataServicos as $data){?>
                                        <tr>
                                            <?php $s = json_encode($data);?>
                                            

                                            <td>
                                                <input type="checkbox" name="<?php echo 'servico-' . $data['cod_servico']?>">
                                            

                                            </td>
                                            <td class="text-center"><?php if($data['fk_exame']== '1') echo $data['nom']; else echo $data['nome']?></td>
                                            <td class="font-w600"><?=formata_preco($data['valor_parceiro'])?> </td>
                                            <td class="font-w600"><?=formata_preco($data['valor_cima'])?> </td>
                                            <td class="font-w600"><?=formata_preco($data['valor_recibo'])?> </td>
                                         </tr>
                                    </tbody>

                                    <?php  } ?>
                                </table>
                            </div>
                        </div>

                        <ul id="list_item"></div>
                        </div></div>

                        <div class="block">
                            <div class="block-content">
                                <div class="row">
                                    <div class="form-group">

                                        <input type="submit" name="proposta-status" class="btn btn-sm btn-primary" style="float: right; margin-right: 20px; margin-bottom: 20px; " name="proximo" value="Salvar"></input>

                                    
                                    

                                    </div>
                                </div>
                            
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END Dynamic Table Full -->

<?php $this->load->view('commons/footer');?>


<script>
    $(document).ready(function() {
            var cod = $('#parceiro').val();
            $.ajax({
                url: "<?php echo base_url();?>/servicos/parceiros/" + cod,
                datatype: 'json',
                type:'POST',
                success: function(result){
                    //alert(result);
                    $.each(result.results, function(item){
                        $('ul').append('<li>' + item + '</li>')
                    });

                   var obj = $.parseJSON(result);
                   $.each(obj, function (index, object){
                        //$('#list_item').append('<li>' + (object['nome']!= ''? object['nome'] : object['exame']) + '</li>');

                        $('#lista_servicos').append('<tr><td>' + object['cod_servico'] + '</td><td>' + (object['nome']!= ''? object['nome'] : object['exame']) + '</td><td>' + object['valor_parceiro'] + '</td><td>' + object['valor_cima'] + '</td><td>' + object['valor_recibo'] + '</td><td><input type="checkbox" name="c-' + object['cod_servico'] +'"></td></tr>' )
                   })

                }

            });

            //$('#tab').dataTable({
           //     language:{
            //        'emptyTable': false
            //    }
           // });
      });
</script>
<script type="text/javascript">
//linha para usar a biblioteca Jquery
    $().ready(function() {
        //utiliza o formulário escolhido por ID
    
        $('#guias').validate({
            // FAZ A VALIDAÇÃO EM TEMPO REAL"
            onkeyup: function(element) {
                this.element(element);
            },
        

            //objeto com duas propriedades rules e messages
            rules: {
                'paciente' : {
                    required : true,
                    //dateBR : true 
                },

                'dt_abertura' : {
                    required : true,
                    dateBR : true,
                },

                'dt_realizacao': {
                    required : "#horario:filled",
                    dateBR : true,
                },

                'parceiro': {
                    required : true,
                    //dateBR : true 
                },

                
            },

            messages: {
                'paciente' : {
                    required : "Escolha uma opção",
                    //dateBR : "Data inválida" 
                },

                'dt_abertura' : {
                    required : "Escolha uma opção",
                    dateBR : "Data inválida",
                },

                'dt_realizacao' : {
                   required : "Preencha este campo para definir a hora",
                    dateBR : "Data inválida", 
                },

                'parceiro' : {
                    required : "Escolha uma opção",
                    //dateBR : "Data inválida" 
                },

             
                
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