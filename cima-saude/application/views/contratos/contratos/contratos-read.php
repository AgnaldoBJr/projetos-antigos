<?php
    //var_dump($this->session->flashdata('msg'), $this->session->flashdata('err'), $this->session->flashdata('imprimir'), $this->session->flashdata('enviar')) ; die;

    $this->load->view('commons/header');
?>
<?php if($this->session->flashdata('imprimir')){?>
    <script type="text/javascript">    
        window.onload = function() {
            document.getElementById("elementoTeste").click();
        }
    </script>
    
        <a class="btn btn-xs btn-default" type="button" id="elementoTeste" href="<?=base_url('propostas/novoPDF/' . $this->session->flashdata('imprimir'))?>"  style="display: none""></a>
        
<?php }?>
<?php if($this->session->flashdata('imprimirContrato')){?>
    <script type="text/javascript">    
        window.onload = function() {
            document.getElementById("elementoTeste2").click();
        }
    </script>
        <a class="btn btn-xs btn-default" type="button" id="elementoTeste2" href="<?=base_url('propostas/novoContratoPDF/' . $this->session->flashdata('imprimirContrato'))?>"  style="display: none""></a>
        
<?php }?>
<!-- Main Container -->
            <main id="main-container">
         	    <!-- Page Header -->
                <div class="content bg-gray-lighter" style="height: 80px">
                    <div class="row items-push">
                        <div class="col-sm-10">
                            <h1 class="page-heading">
                                Contratos
                            </h1>
                        </div>
                        
                    </div>
                </div>
                <!-- END Page Header -->
                <?php if($this->session->flashdata('msg')){ ?>
                    <!--<div class="alert alert-success" role="alert"><p></p></div>

                    <div class="alert alert-success" id="success-alert">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong>Success! </strong>
                        Product have added to your wishlist.
                    </div>
                    -->
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

<!-- Page Content -->
                <div class="content" style="margin-top: -20px">
                    <!-- Dynamic Table Full -->
                    <div class="block">
                    <form action="<?=base_url('contratos/relatorios')?>" method="post" id="filtro"  target="_blank">
                        <div class="block-content">
                        <div class="block-header" style="margin-left: -20px;  color:#bbb">
                           
                            <div class="col-sm-11">
                                <h3 class="block-title">Filtros</h3>
                            </div>
                            <div class="col-sm-1" style="float: right;">
                                
                                <button class="btn btn-xs btn-default" name="relatorio" type="submit" value="pdf"><i class="fa fa-file-text-o"></i></button>
                                
                                <button class="btn btn-xs btn-default" name="relatorio" type="submit" value="rel"><i class="fa fa-list-alt"></i></button>
                            </div>
                           
                        </div>
                              
                                <div class="row">    
                                    <div class="form-group col-md-3">
                                        <label class="control-label">Período de Emissão</label>
                                        <div class="">
                                            <input class="form-control data" type="text" name="c-inicial"  id="c-inicial" placeholder="Data inicial" value="<?php if ($this->input->post('c-inicial') != null) echo $this->input->post('c-inicial'); ?>">
                                            <input style="margin-top: 5px;" class="form-control data" type="text" name="c-final" id="c-final" placeholder="Data final" value="<?php if ($this->input->post('c-final') != null) echo $this->input->post('c-final');?>">
                                        </div>
                                        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('c-inicial')?></div>
                                         <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('c-final')?></div>
                                    </div>
                                    
                                    <div class="form-group col-md-3">
                                        <label class="control-label">Período de Vencimento</label>
                                        <div class="">
                                            <input class="form-control data" type="text" name="v-inicial" id="v-inicial" placeholder="Data inicial" value="<?php if ($this->input->post('v-inicial') != null) echo $this->input->post('v-inicial'); ?>">
                                             <input style="margin-top: 5px;" class="form-control data" type="text" name="v-final" id="v-final" placeholder="Data final" value="<?php if ($this->input->post('v-final') != null) echo $this->input->post('v-final'); ?>">
                                        </div>
                                        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('v-inicial')?></div>
                                        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('v-final')?></div>
                                    </div>
                                     
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="plano">Plano</label>
                                        <div class="">
                                            <select class="form-control" type="text"  name="plano" placeholder="Escolha uma opção...">
                                                <option value=<?php null;?>>Escolha uma opção...</option>
                                                <?php
                                                $p = json_encode($dataPlanos);
                                                    if($dataPlanos) foreach ($dataPlanos as $data){
                                                         
                                                ?>
                                                    <option value="<?=$data['cod_plano']?>" <?php if($data['cod_plano'] == $this->input->post('plano')) echo "selected";?>><?=$data['nome']?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('plano')?></div>
                                        </div>
                                    </div>
                                 
                                     <div class="form-group col-md-3">
                                        <label class="control-label">Status</label>
                                        <div class="">
                                            <select class="form-control" type="text" name="status" placeholder="Escolha uma opção...">
                                                <option value=<?php null;?>>Escolha uma opção...</option>
                                                <option value="C" <?php if("C" == $this->input->post('status')) echo 'selected';?>>Ativo</option>
                                                <option value="I" <?php if("I" == $this->input->post('status')) echo 'selected';?>>Inativo</option>
                                                <option value="A" <?php if("A" == $this->input->post('status')) echo 'selected';?>>Cancelado</option>
                                                <option value="V" <?php if("V" == $this->input->post('status')) echo 'selected';?>>Vencido</option>
                                                <option value="N" <?php if("N" == $this->input->post('status')) echo 'selected';?>>Sem Contrato</option>
                                                
                                            </select>
                                             <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?//=form_error('pag-modo')?></div>
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



         	    <!-- Page Content -->
                <div class="content" style="margin-top: -45px">
                    <!-- Dynamic Table Full -->
                    <div class="block">
                        <div class="block-content">
                        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
                            <div class="col-lg-12">
                                <table class="table table-bordered table-striped js-dataTable-full" >
                                    <thead>    
                                        <tr>
                                            
                                            <th style="width: 20%">Nº da Proposta</th>
                                            <th>Cliente</th>
                                            <th>Plano</th>
                                            <th>Status</th>
                                            <th class="text-center">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        if($dataTable) foreach ($dataTable as $data){
                                    ?>
                                        <tr>
                                        <?php $s = json_encode($data); $email = $data['cliente_email']; $d = $data?>
                                        
                                            <td class="font-w600" ><?=$data['numero']?> </td>
                                            <td class="font-w600"><?=$data['cliente_nome']?> </td>
                                            <td class="font-w600"><?=$data['plano_nome']?> </td>

                                            <?php if($data['status'] == 'C'){?>
                                                    <td><span class="label label-success">Em vigor</span></td>
                                                <?php }else if($data['status'] == 'D'){?>    
                                                    <td><span class="label label-danger">Cancelada</span></td>
                                                 <?php }else if($data['status'] == 'V'){?>    
                                                    <td><span class="label label-warning">Vencido</span></td>
                                                <?php }?>

                                            <td class="text-center">
                                                <div class="btn-group">
                                                    
                                                   
                                                    <a class="btn btn-xs btn-default" type="button" href="<?=base_url('contratos/novoPDF/' . $data['cod_contrato'])?>"><i class="fa fa-file-text-o"></i></a>
                                               
                                                    <a class="btn btn-xs btn-default" type="button" href="<?=base_url('contratos/visualizar/' . $data['cod_contrato'])?>"><i class="fa fa-eye"></i></a>
                                                <!--
                                                    <a class="btn btn-xs btn-default" type="button" href="<?//=base_url('contratos/atualizar/' . $data['cod_contrato'])?>"><i class="fa fa-pencil"></i></a>

                                                    <button class="btn btn-xs btn-default" type="button" data-toggle="modal" data-target="#atualizarModal" data-whatever='<?//=$s?>'><i class="fa fa-pencil"></i></button>

                                                    <button class="btn btn-xs btn-default" type="button" data-toggle="modal" data-target="#naoExcluirModal"><i class="fa fa-times"></i></button>
                                                -->
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
                    
                    <div class="modal fade" id="atualizarModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog" role="document">
                            <div class="block-header bg-primary-dark">
                                <ul class="block-options">
                                    <li>
                                        <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                                    </li>
                                </ul>
                                <h3 class="block-title" style="color:white">Atualizar Datas de Pagamento</h3>
                            </div>
                            <form method="POST" action="<?=base_url('propostas/delete');?>">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <div class="form-group col-md-8" >
                                            <label class="control-label">Nova Data</label>
                                             <input class="form-control data" type="text" name="c-inicial"  id="c-inicial" placeholder="Nova data" value="<?php if ($this->input->post('c-inicial') != null) echo $this->input->post('c-inicial'); ?>">
                                            <label class="checkbox" style="margin-left: 20px">
                                                <input  type="checkbox" name="mudar_todas" value="1"> Mudar todas as ocorrências seguintes
                                            </label>
                                        </div>
                                        <div class="row" ></div>
                                        <?php 
                                            $k=0;
                                            foreach ($contas as $data) {
                                                if($d['cod_contrato'] == $data['fk_contrato']){
                                                  $k++;
                                                }
                                            }
                                        ?>    
                                            <table class="table table-bordered table-striped" >
                                                <thead>    
                                                    <tr>
                                                        <th>Nº Parcela</th>
                                                        <th>Valor (R$)</th>
                                                        <th>Data de Vencimento</th>
                                                    </tr>
                                                </thead>
                                                <tbody>


                                                <?php
                                                    if($k == 1){
                                                        foreach ($contas as $data) {
                                                            if($d['cod_contrato'] == $data['fk_contrato']){?>
                                                        <tr>
                                                            <td class="font-w600">Parcela Única?> </td>
                                                            <td class="font-w600"><?=formata_preco($data['valor'])?> </td>
                                                            <td class="font-w600"><?=formata_data_br($data['dt_recebimento'])?> </td>
                                                        </tr>  
                                                    <?php    }
                                                        }
                                                    } else if($k>1){
                                                        foreach ($contas as $data) { 
                                                        if($d['cod_contrato'] == $data['fk_contrato']){


                                                           

                                                        ?>
                                                        <tr>
                                                            <td class="font-w600">Parcela <?=$data['num_repeticao']?> </td>
                                                            <td class="font-w600"><?=formata_preco($data['valor'])?> </td>
                                                            <td class="font-w600"><input class="form-control data" type="text" name="c-inicial"  id="c-inicial" placeholder="Nova data" value="<?=formata_data_br($data['dt_recebimento'])?>" <?php  if(strtotime(date('Y-m-d')) > strtotime($data['dt_recebimento'])) echo 'readonly' ?>> </td>
                                                        </tr>
                
                                                <?php   }  
                                                    } 
                                                }
                                                ?>        
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>




                    <div class="modal fade" id="excluirModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog" role="document">
                            <form method="POST" action="<?=base_url('propostas/delete');?>">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <p>Deseja realmente excluir a proposta: <span id="numero"></span>?</p>
                                        <input type="hidden" class="form-control" name='cod_proposta' id="cod_proposta">
                                     </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Excluir</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="modal fade" id="naoExcluirModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <p>Você não pode realizar esta operação! Um contrato já foi gerado.</p>
                                     </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                                    </div>
                                </div>    
                        </div>
                    </div>


<form method="POST" action="<?=base_url('propostas/ganhar');?>">
                    <div class="modal fade" id="ganharModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog" role="document">
                                
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <p>Deseja realmente gerar o contrato da proposta: <span id="numero_ganhar"></span>?</p><br>
                                        <p><small>Obs.: Isso gerará a(s) respectiva(s) conta(s) a receber.</small>
                                        <input type="hidden" class="form-control" name='cod_proposta' id="cod_proposta_ganhar">
                                     </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                        <button type="button" class="btn btn-primary"  data-toggle="modal" data-target="#proximoPasso" data-dismiss="modal">Sim</button>
                                    </div>
                                </div>
                            
                        </div>
                    </div>

                    <div class="modal fade" id="proximoPasso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog" role="document">
                        <div class="block-header bg-primary-dark">
                            <ul class="block-options">
                                <li>
                                    <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                                </li>
                            </ul>
                            <h3 class="block-title" style="color:white">Salvar Contrato</h3>
                        </div>
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <p>Deseja realizar mais alguma tarefa?</p>
                                        
                                        <div class="form-group" style="margin-left: 50px">
                                            <label class="checkbox">
                                                <input type="checkbox" name="imprimir" value="1"> Imprimir
                                            </label>
                                            <label class="checkbox" onclick="checkEmail()">
                                                <input type="checkbox" name="email" id="emailCheck" value="1"> Enviar por e-mail
                                            </label>
                                            <div style="margin-left: -50px; display: none" id="dest">
                                                <input class="form-control" type="text" name="destino" placeholder="Endereço de email" value="<?=$email?>">
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Gerar Contrato</button>
                                    </div>
                                </div>
                            
                        </div>
                    </div>
     </form>           
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
          console.log(recipient.numeroproposta);
          var modal = $(this)
          modal.find('#cod_proposta').val(recipient.cod_proposta)
          modal.find('#numero').text(recipient.numero);
          modal.find('#proposta').text(recipient.cod_proposta);
        });

        $('#ganharModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
          // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
           console.log(recipient);
          console.log(recipient.numeroproposta);
          var modal = $(this)
          modal.find('#cod_proposta_ganhar').val(recipient.cod_proposta)
          modal.find('#numero_ganhar').text(recipient.numero);
          modal.find('#proposta_ganhar').text(recipient.cod_proposta);
        });

</script>

<script type="text/javascript">
    function checkEmail(){
        if(document.getElementById("emailCheck").checked == true){
            document.getElementById("dest").style.display = 'block';
        } else{
            document.getElementById("dest").style.display = 'none';
        }
    }
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