<?php 
    //echo $this->input->post('dep-nome["0"]'); die;

    $this->load->view('commons/header');

    
?>
<!-- Main Container -->
            <main id="main-container">
                <!-- Page Header -->
                <div class="content bg-gray-lighter">
                    <div class="row items-push">
                        <div class="col-sm-7">
                            <h1 class="page-heading">
                                Nova proposta
                            </h1>
                        </div>
                    </div>
                </div>
                <!-- END Page Header -->
                <?php if($this->session->flashdata('msg')): ?>
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
                <?php endif; ?>

                <!-- Page Content -->
                <div class="content">
                    <!-- Dynamic Table Full -->
                    <form action="<?=base_url('c-contratos/proposta/pagamento');?>" method="POST" id="form1">
                        <div class="block">
                            <div class="block-content">
                            
                            <!--Proposta form-->
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="proposta-numero">Nº da Proposta </label>
                                        <div class="">
                                            <input class="form-control" type="text" id="proposta-numero" name="proposta-numero" value="<?php echo $propostaNumero?>" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-4">
                                        <label class="control-label" for="proposta-cliente">Cliente <span class="text-danger">*</span></label>
                                        <div>
                                            <select class="form-control" type="text" id="proposta-cliente" name="proposta-cliente" placeholder="Escolha uma opção...">
                                                <option value=<?php null;?>>Escolha uma opção...</option>
                                                <?php
                                                    if($dataClientes) foreach ($dataClientes as $data){
                                                       
                                                ?>
                                                    <option value="<?=$data['cod_pessoa']?>" <?php if($data['cod_pessoa'] == $this->input->post('proposta-cliente')) echo "selected";?>><?=$data['nome']?></option>

                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('proposta-cliente')?></div>
                                    </div>
                                    <!--<div class="form-group col-md-1" style="margin-top:28px; margin-left:-15px;">
                                        <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#novoCliente">Novo</button>
                                    </div>-->
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="proposta-plano">Plano <span class="text-danger">*</span></label>
                                        <div class="">
                                            <select class="form-control" type="text" id="proposta-plano" name="proposta-plano" placeholder="Escolha uma opção...">
                                                <option value=<?php null;?>>Escolha uma opção...</option>
                                                <?php
                                                $s = json_encode($dataPlanos);
                                                    if($dataPlanos) foreach ($dataPlanos as $data){
                                                         
                                                ?>
                                                    <option value="<?=$data['cod_plano']?>" <?php if($data['cod_plano'] == $this->input->post('proposta-plano')) echo "selected";?>><?=$data['nome']?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('proposta-plano')?></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
       
                                        <label class="checkbox-inline" for="cortesia">
                                            <input type="checkbox" id="cortesia" name="cortesia" value="1" <?php if($this->input->post('cortesia') == 1) echo "checked";?>> Cortesia
                                        </label>
                                        
                                    </div>
                                    
                                 </div>
                                 <div class="row">
                                     <div class="form-group col-md-2">
                                         <label class="checkbox-inline" for="indicacao" onclick="isIndicado()">
                                            <input type="checkbox" id="indicacao" name="indicacao" value="1" <?php if($this->input->post('indicacao') == 1) echo "checked";?> > Indicação
                                        </label>
                                     </div>
                                     <div id="indicacao-div" style="display: none">
                                         <div class="form-group col-md-4">
                                            <label class="control-label" for="indicacao-nome">Nome </label>
                                            <div class="">
                                                <input class="form-control" type="text" id="indicacao-nome" name="indicacao-nome" placeholder="Nome da pessoa que fez a indicação">
                                            </div>
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label class="control-label" for="indicacao-celular">Celular </label>
                                            <div class="">
                                                <input class="form-control celular" type="text" id="indicacao-celular" name="indicacao-celular" placeholder="Celular da pessoa que fez a indicação">
                                            </div>
                                        </div>
                                    </div>
                                 </div>

                                </div>
                            </div>
                        </div><!--Fim de Proposta-form-->
                         
                        <!--Dependentes, Agregados e Colaboradores form-->
                        <div id="plano_section" class="block" style="display: none">
                            <div class="block-content">
                                <div id="dependentes_section">
                                    <div class="block">
                                       <div class="block-header" style="margin-left: -20px; color:#bbb">
                                            <h3 class="block-title">Dependentes</h3>
                                        </div>
                                        <table class="table table-striped table-responsive">
                                            <thead>    
                                                <tr>
                                                    <th class="text-center"></th>
                                                    <th style="width: 50%">Nome</th>
                                                    <th style="width: 25%">Data de Nascimento</th>
                                                    <th style="width: 25%">Parentesco</th>

                                                </tr>
                                            </thead>
                                        </table>
                                        <table class="table table-striped" >
                                            <tbody>
                                                
                                            <?php for($i = 1; $i <= 10; $i++){?>
                                                <tr>
                                                    <td class="font-w600" style="width: 50%">
                                                        <div class="">
                                                            <input class="form-control" type="text" name="<?php echo 'dep-nome[' . $i . ']';?>" placeholder="Insira um nome" value="<?= $this->input->post('dep-nome['. $i .']');?>" onkeyup="caps(this)">
                                                        </div>
                                                        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('dep-nome['. $i .']')?></div>
                                                    </td>
                                                    <td style="width: 25%"> 
                                                        <div class="">
                                                            <input class="form-control data" type="text" name="<?php echo 'dep-data-nasc[' . $i . ']';?>" placeholder="Ex.: dd/mm/aaaa" value="<?= $this->input->post('dep-data-nasc[' . $i . ']');?>">
                                                        </div>
                                                        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('dep-data-nasc['. $i .']')?></div>
                                                    </td>
                                                    <td>
                                                        <div class="">

                                                            <div class="">
                                                                <select class="form-control" type="text" name="<?php echo 'dep-parentesco[' . $i . ']';?>" placeholder="Escolha uma opção...">
                                                                    <option value=<?php null;?>>Escolha uma opção...</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                                                    <option value="CONJUGÊ" <?php if("CONJUGÊ" == $this->input->post('dep-parentesco[' . $i . ']')) echo "selected";?>>CONJUGÊ</option>
                                                                    <option value="FILHO(A)" <?php if("FILHO(A)" == $this->input->post('dep-parentesco[' . $i . ']')) echo "selected";?>>FILHO(A)</option>
                                                                    <option value="ENTEADO(A)" <?php if("ENTEADO(A)" == $this->input->post('dep-parentesco[' . $i . ']')) echo "selected";?>>ENTEADO(A)</option>
                                                                    <option value="OUTRO" <?php if("OUTRO" == $this->input->post('dep-parentesco[' . $i . ']')) echo "selected";?>>OUTRO</option>

                                                                </select>
                                                                 <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('dep-parentesco['. $i .']')?></div>
                                                            </div>

                                                        </div>
                                                    </td>
                                                </tr>
                                             <?php } ?>
                                            </tbody>
                                        </table>            
                                    </div>
                                </div>


                                <div id="agregados_section">
                                    <div class="block">
                                       <div class="block-header" style="margin-left: -20px; color:#bbb">
                                            <h3 class="block-title">Agregados</h3>
                                        </div>
                                        <table class="table table-striped table-responsive">
                                            <thead>    
                                                <tr>
                                                    <th class="text-center"></th>
                                                    <th style="width: 50%">Nome</th>
                                                    <th style="width: 25%">Data de Nascimento</th>
                                                    <th style="width: 25%">Parentesco</th>
                                                </tr>
                                            </thead>
                                        </table>
                                        <table class="table table-striped" >
                                            <tbody>
                                                
                                            <?php for($i = 1; $i <= 10; $i++){?>
                                                <tr>
                                                    <td class="font-w600" style="width: 50%">
                                                        <div class="">
                                                            <input class="form-control" type="text" name="<?php echo 'agr-nome[' . $i . ']';?>" placeholder="Insira um nome" value="<?= $this->input->post('agr-nome['. $i .']');?>" onkeyup="caps(this)">
                                                        </div>
                                                        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('agr-nome['. $i .']')?></div>
                                                    </td>
                                                    <td style="width: 25%"> 
                                                        <div class="">
                                                            <input class="form-control data" type="text" name="<?php echo 'agr-data-nasc[' . $i . ']';?>" placeholder="Ex.: dd/mm/aaaa" value="<?= $this->input->post('agr-data-nasc[' . $i . ']');?>">
                                                        </div>
                                                        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('agr-data-nasc['. $i .']')?></div>
                                                    </td>
                                                    <td>
                                                        <div class="">

                                                            <div class="">
                                                                <select class="form-control" type="text" name="<?php echo 'agr-parentesco[' . $i . ']';?>" placeholder="Escolha uma opção...">
                                                                    <option value=<?php null;?>>Escolha uma opção...</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                                                    <option value="PAI" <?php if("PAI" == $this->input->post('agr-parentesco[' . $i . ']')) echo "selected";?>>PAI</option>
                                                                    <option value="MÃE" <?php if("MÃE" == $this->input->post('agr-parentesco[' . $i . ']')) echo "selected";?>>MÃE</option>
                                                                    <option value="SOGRO(A)" <?php if("SOGRO(A)" == $this->input->post('agr-parentesco[' . $i . ']')) echo "selected";?>>SOGRO(A)</option>
                                                                    <option value="OUTRO" <?php if("OUTRO" == $this->input->post('agr-parentesco[' . $i . ']')) echo "selected";?>>OUTRO</option>

                                                                </select>
                                                                 <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('agr-parentesco['. $i .']')?></div>
                                                            </div>

                                                        </div>
                                                    </td>
                                                </tr>
                                             <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <div id="colaboradores_section">
                                    <div class="block">
                                       <div class="block-header" style="margin-left: -20px; color:#bbb">
                                            <h3 class="block-title">Colaboradores</h3>
                                            <table class="table table-striped table-responsive">
                                                <thead>    
                                                    <tr>
                                                        <th class="text-center"></th>
                                                        <th style="width: 70%">Nome</th>
                                                        <th style="width: 30%">Data de Nascimento</th>
                                                        
                                                    </tr>
                                                </thead>
                                            </table>
                                            <table class="table table-striped" >
                                                <tbody>
                                                    
                                                <?php for($i = 1; $i <= 10; $i++){?>
                                                    <tr>
                                                        <td class="font-w600" style="width: 70%">
                                                            <div class="">
                                                                <input class="form-control" type="text" name="<?php echo 'colab-nome[' . $i . ']';?>" placeholder="Insira um nome" value="<?= $this->input->post('colab-nome['. $i .']');?>" onkeyup="caps(this)">
                                                            </div>
                                                            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('colab-nome['. $i .']')?></div>
                                                        </td>
                                                        <td style="width: 30%"> 
                                                            <div class="">
                                                                <input class="form-control data" type="text" name="<?php echo 'colab-data-nasc[' . $i . ']';?>" placeholder="Ex.: dd/mm/aaaa" value="<?= $this->input->post('colab-data-nasc[' . $i . ']');?>">
                                                            </div>
                                                            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('colab-data-nasc['. $i .']')?></div>
                                                        </td>
                                                    </tr>
                                                 <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>

                                </div>
                            </div>                      
                       



                        <div class="block">
                            <div class="block-content">
                                <div class="row">
                                    <div class="form-group">

                                        <input type="submit" name="proposta-status" class="btn btn-sm btn-primary" style="float: right; margin-right: 20px; margin-bottom: 20px; " name="proximo" value="Continuar"></input>

                                    
                                        <!--<input type="submit" name="proposta-status" class="btn btn-sm btn-info" style="float: right; margin-right: 20px; margin-bottom: 20px; " value="Avaliar"></input>-->
                                        

                                    </div>
                                </div>
                            
                            </div>
                        </div>
                    </form>
                </div>
                <!-- END Dynamic Table Full -->

<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $("#novo_dependente").click(function() {
          var novoItem = $("#dep").clone().removeAttr('id'); // para não ter id duplicado
          novoItem.children('input').val(''); //limpa o campo quantidade
          $("#dependentes_section").append(novoItem);
        });

        $("#novo_agregado").click(function() {
          var novoItem = $("#agr").clone().removeAttr('id'); // para não ter id duplicado
          novoItem.children('input').val(''); //limpa o campo quantidade
          $("#agregados_section").append(novoItem);
        });

        $("#novo_colaborador").click(function() {
          var novoItem = $("#colab").clone().removeAttr('id'); // para não ter id duplicado
          novoItem.children('input').val(''); //limpa o campo quantidade
          $("#colaboradores_section").append(novoItem);
        });
      });
</script>
<script type="text/javascript">
    function isIndicado(){
        if(document.getElementById("indicacao").checked == true){
            document.getElementById("indicacao-div").style.display = 'block';
        } else{
            document.getElementById("indicacao-div").style.display = 'none';
        }
    }


</script>
<script type="text/javascript">
   var s = <?=$s?>;
   var items = document.getElementById('proposta-plano');
    items.addEventListener('change', function(){
    //console.log("O indice é: " + items.selectedIndex);
    //console.log("O texto é: " + items.options[items.selectedIndex].text);
    //console.log("A chave é: " + items.options[items.selectedIndex].value);
    
    //console.log(s[0].nome);
    //console.log(s);

    if(items.selectedIndex == 0){
        document.getElementById("plano_section").style.display = 'none';
        document.getElementById("dependentes_section").style.display = 'none';
        document.getElementById("colaboradores_section").style.display = 'none';
        document.getElementById("agregados_section").style.display = 'none';
    }
    for ( var i = 0; i < s.length; i++ ) {
        //document.write( i );
        if(items.options[items.selectedIndex].value == s[i].cod_plano){
            document.getElementById("plano_section").style.display = 'none';
            document.getElementById("dependentes_section").style.display = 'none';
            document.getElementById("colaboradores_section").style.display = 'none';
            document.getElementById("agregados_section").style.display = 'none';

            if(s[i].dependentes == 1){
                console.log("dependentes");
                document.getElementById("plano_section").style.display = 'block';
                document.getElementById("dependentes_section").style.display = 'block';
            }
            if(s[i].colaboradores == 1){
                console.log("colaboradores");             
                document.getElementById("plano_section").style.display = 'block';
                document.getElementById("colaboradores_section").style.display = 'block';
            }
            if(s[i].agregados == 1){
                console.log("agregados");
                document.getElementById("plano_section").style.display = 'block';
                document.getElementById("agregados_section").style.display = 'block';
            }
        } 
    } 
});
</script>
<?php $this->load->view('commons/footer');?>
