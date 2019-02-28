<?php 
    $this->load->view('commons/header');
?>
<?php if($this->session->flashdata('imprimir')){?>
    <script type="text/javascript">    
        window.onload = function() {
            document.getElementById("elementoTeste").click();
        }
    </script>
    
        <a class="btn btn-xs btn-default" type="button" id="elementoTeste" href="<?=base_url('parceiros/novoPDF/' . $this->session->flashdata('imprimir'))?>"  style="display: none"></a>
        
<?php }?>
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
                                Parceiros
                            </h1>
                        </div>
                        <div class="col-sm-2">
                            <a href="parceiros/novo" class="btn btn-large btn-primary btn-rounded" style="float: right;">Novo</a>
                        </div>
                    </div>
                </div>
                <!-- END Page Header -->

                <!-- ///////////////////////////////////////////////-->
                <div class="content" style="margin-top: -20px" >
                    <!-- Dynamic Table Full -->
                    <div class="block">
                    <form action="<?=base_url('parceiros/relatorios')?>" method="post" id="filtro"  target="_blank">
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
                                        <label class="control-label">Contratos</label>
                                        <div class="">
                                            <select class="form-control" type="text" name="status" placeholder="Escolha uma opção...">
                                                <option value=<?php null;?>>Escolha uma opção...</option>
                                                <option value="A" <?php if("A" == $this->input->post('status')) echo 'selected';?>>Ativo</option>
                                                <option value="I" <?php if("I" == $this->input->post('status')) echo 'selected';?>>Inativo</option>
                                                <option value="C" <?php if("C" == $this->input->post('status')) echo 'selected';?>>Cancelado</option>
                                                <option value="V" <?php if("V" == $this->input->post('status')) echo 'selected';?>>Vencido</option>
                                                <option value="N" <?php if("N" == $this->input->post('status')) echo 'selected';?>>Sem Contrato</option>
                                                
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
                        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
                            <div class="col-lg-12">
                                <table class="table table-bordered table-striped js-dataTable-full" >
                                    <thead>    
                                        <tr>
                                            <th class="text-center"></th>
                                            <th>Nome</th>
                                            <th>Tipo</th>
                                            <th>Nome de Usuário</th>
                                            <th class="text-center">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        if($dataTable) foreach ($dataTable as $data){
                                    ?>
                                        <tr>
                                        <?php $s = json_encode($data);?>
                                        <td class="text-center"><?=$data['cod_parceiro']?></td>
                                            <td class="font-w600"><?=$data['nome']?> </td>
                                            <td class="font-w600"><?=$data['tipo']?> </td>
                                            <td class="font-w600"><?=$data['nome_usuario']?> </td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <a class="btn btn-xs btn-default" type="button" href="<?=base_url('parceiros/visualizar/' . $data['cod_parceiro'])?>"><i class="fa fa-eye"></i></a>

                                                     <a class="btn btn-xs btn-default" type="button" href="<?=base_url('parceiros/novoPDF/' . $data['cod_parceiro'])?>"><i class="fa fa-file-text-o"></i></a>
                                                  
                                                    <a class="btn btn-xs btn-default" type="button" href="<?=base_url('parceiros/atualizar/' . $data['cod_parceiro'])?>"><i class="fa fa-pencil"></i></a>

                                                     <button class="btn btn-xs btn-default" type="button" data-toggle="modal" data-target="#excluirModal" data-whatever='<?=$s;?>' data-cod="<?=$data['cod_parceiro']?>"><i class="fa fa-times"></i></button>
                                                    
                                                </div>
                                            </td>
                                        </tr>
                                    <?php } ?>   
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    
                                    <a class="btn btn-primary" style="float: right; margin-bottom: 20px;" href="<?=base_url('parceiros/novo')?>">Novo</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Dynamic Table Full -->
                       

    <div class="modal fade" id="excluirModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
        <div class="modal-dialog" role="document">
            <form method="POST" action="<?=base_url('parceiros/delete');?>">
                <div class="modal-content">
                    <div class="modal-body">
                        <p>Deseja realmente excluir o parceiro: <span id="codigo"></span> - <span id="nome"></span>?</p>
                        
                        <input type="hidden" class="form-control" name='cod_parceiro' id="cod_parceiro">
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
          modal.find('#cod_parceiro').val(recipient.cod_parceiro)
          modal.find('#nome').text(recipient.nome);
          modal.find('#codigo').text(recipient.cod_parceiro);
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