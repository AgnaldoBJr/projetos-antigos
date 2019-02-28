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
                        <div class="col-sm-10" >
                            <h1 class="page-heading">
                                Propostas
                            </h1>
                        </div>
                        <div class="col-sm-2">
                            <a href="propostas/novo" class="btn btn-large btn-primary btn-rounded" style="float: right;">Novo</a>

                           
                        </div>
                    </div>
                    <!--<div class="row"> <a class="btn btn-large btn-default btn-rounded" type="button" href="<?//=base_url('enviar-email')?>">Enviar</a></div>-->
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

<!--
             <div class="content">
                    <div class="block">
                        <div class="block-content">
                        <div class="block-header" style="margin-left: -20px; color:#bbb">
                            <h3 class="block-title">EMAIL TESTE</h3>
                        </div>
                        <form method="POST" action="<?//=base_url('enviar-email')?>">
 
<div>
    <label>Seu nome</label>
    <input type="text" name="nome" required/>
</div>
 

 
<div>
    <label>Uma mensagem pra você</label>
    <textarea name="mensagem" rows="6" required></textarea>
</div>
 
<div>
    <label><input type="checkbox" name="anexo"/><strong>Enviar anexo</strong></label>
</div>
 
<div>
    <label><input type="checkbox" name="template"/><strong>Usar template</strong></label>
</div>
 
<div>
    <input type="submit" value="Enviar"/>
</div>
 
</form>
                        
                        </div>
                    </div>
                </div>
-->

















                <!-- Page Content -->
                <div class="content" style="margin-top: -20px">
                    <!-- Dynamic Table Full -->
                    <div class="block">
                    <form action="<?=base_url('propostas/relatorios')?>" method="post" id="filtro"  target="_blank">
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
                                                <option value=<?php null;?>>Escolha uma opção...</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                                <option value="C" <?php if("C" == $this->input->post('status')) echo 'selected';?>>Propostas Ganhas</option>
                                                <option value="S" <?php if("S" == $this->input->post('status')) echo 'selected';?>>Propostas Salvas</option>
                                            </select>
                                             <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?//=form_error('pag-modo')?></div>
                                        </div>
                                    </div>
                                     
                                </div>
                               

                              
                        </div>
                    </div>
                    </form>
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
                                        <?php $s = json_encode($data); $email = $data['cliente_email']?>
                                        
                                            <td class="font-w600" ><?=$data['numero']?> </td>
                                            <td class="font-w600"><?=$data['cliente_nome']?> </td>
                                            <td class="font-w600"><?=$data['plano_nome']?> </td>

                                            <?php if($data['status'] == 'C'){?>
                                                    <td><span class="label label-success">Proposta Ganha</span></td>
                                                <?php }else if($data['status'] == 'S'){?>    
                                                    <td><span class="label label-info">Proposta Salva</span></td>
                                            <?php }?>

                                            <td class="text-center">
                                                <div class="btn-group">
                                                    
                                                   
                                                    <a class="btn btn-xs btn-default" type="button" href="<?=base_url('propostas/novoPDF/' . $data['cod_proposta'])?>"><i class="fa fa-file-text-o"></i></a>
                                               
                                                    <a class="btn btn-xs btn-default" type="button" href="<?=base_url('propostas/visualizar/' . $data['cod_proposta'])?>"><i class="fa fa-eye"></i></a>
    
                                            <?php if($data['status'] != 'C'){ ?>
                                                   

                                                    <button class="btn btn-xs btn-default" type="button" data-toggle="modal" data-target="#excluirModal" data-whatever='<?=$s?>'><i class="fa fa-times"></i></button>

                                                    <button class="btn btn-xs btn-default" type="button" data-toggle="modal" data-target="#ganharModal" data-whatever='<?=$s?>'><i class="fa fa-check-square-o"></i> Ganhar</button>

                                            <?php } else { ?>
                                                   

                                                    <button class="btn btn-xs btn-default" type="button" data-toggle="modal" data-target="#naoExcluirModal"><i class="fa fa-times"></i></button>
                                            <?php } ?>
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>   
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    
                                    <a class="btn btn-primary" style="float: right; margin-bottom: 20px;" href="<?=base_url('propostas/novo')?>">Novo</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Dynamic Table Full -->
                       

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
                            <form method="POST" action="<?=base_url('propostas/delete');?>">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <p>Você não pode realizar esta operação! Um contrato já foi gerado.</p>
                                     </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-primary" data-dismiss="modal">Fechar</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>


<form method="POST" action="<?=base_url('propostas/ganhar');?>">
                    <div class="modal fade" id="ganharModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog" role="document">
                                
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <p>Deseja realmente gerar o contrato da proposta: <span id="numero_ganhar"></span>?<span id="emailcliente"></span></p><br>
                                        <p><small>Obs.: Isso gerará a(s) respectiva(s) conta(s) a receber e número(s) de carteirinha(s).</small>
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
                                        <p>Deseja realizar mais alguma tarefa?<span id="cmail"></span></p>
                                        
                                        <div class="form-group" style="margin-left: 50px">
                                            <label class="checkbox">
                                                <input type="checkbox" name="imprimir" value="1"> Imprimir
                                            </label>
                                            <label class="checkbox" onclick="checkEmail()">
                                                <input type="checkbox" name="email" id="emailCheck" value="1"> Enviar por e-mail
                                            </label>
                                            <div style="margin-left: -50px; display: none" id="dest">
                                                <input class="form-control" type="text" name="destino" placeholder="Endereço de email" id="emailcliente">
                                            </div>
                                            
                                        </div>
                                        <div class="form-group" style="display: none" id="msgdiv">
                                            <label for="msg">Mensagem</label>
                                            <div>
                                                <textarea class="form-control" name="msg" rows="4" placeholder="Insira uma mensagem de e-mail">Olá, segue em anexo o contrato do seu convênio CIMA.</textarea>
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

        var email = '';
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
          console.log(recipient.numero);
          console.log(recipient.cliente_email);
          email = recipient.cliente_email;
          var modal = $(this)
          modal.find('#cod_proposta_ganhar').val(recipient.cod_proposta);
          modal.find('#emailcliente').val(recipient.cliente_email);  
          modal.find('#numero_ganhar').text(recipient.numero);
          modal.find('#proposta_ganhar').text(recipient.cod_proposta);
        });

        $('#proximoPasso').on('show.bs.modal', function (event) {
           var button = $(event.relatedTarget)
           var modal = $(this)
          modal.find('#emailcliente').val(email);  
         
        });
</script>

<script type="text/javascript">
    function checkEmail(){
        if(document.getElementById("emailCheck").checked == true){
            document.getElementById("dest").style.display = 'block';
            document.getElementById("msgdiv").style.display = 'block';
        } else{
            document.getElementById("dest").style.display = 'none';
            document.getElementById("msgdiv").style.display = 'none';
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
                    //required : "#c-final:filled",
                    dateBR : true },
            
                'c-final': {
                    //required : "#c-inicial:filled",
                    dateBR : true },

                'v-inicial' : {
                    //required : "#v-final:filled",
                    dateBR : true },
            
                'v-final': {
                    //required : "#v-inicial:filled",
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