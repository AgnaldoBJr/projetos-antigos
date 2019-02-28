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

                <!-- Page Content -->
                <div class="content">
                    <!-- Dynamic Table Full -->
                    <form action="<?=base_url('c-contratos/proposta/salvar');?>" method="POST">
                        <div class="block">
                            <div class="block-content">
                            
                            <!--Proposta form-->
                                <div class="row">
                                    <div class="form-group col-md-4">
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
                                                    <option value="<?=$data['cod_cliente']?>"><?=$data['nome']?></option>

                                                <?php } ?>
                                            </select>
                                        </div>
                                        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('proposta-cliente')?></div>
                                    </div>
                                    <!--<div class="form-group col-md-1" style="margin-top:28px; margin-left:-15px;">
                                        <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#novoCliente">Novo</button>
                                    </div>-->
                                    <div class="form-group col-md-4">
                                        <label class="control-label" for="proposta-plano">Plano <span class="text-danger">*</span></label>
                                        <div class="">
                                            <select class="form-control" type="text" id="proposta-plano" name="proposta-plano" placeholder="Escolha uma opção...">
                                                <option value=<?php null;?>>Escolha uma opção...</option>
                                                <?php
                                                $s = json_encode($dataPlanos);
                                                    if($dataPlanos) foreach ($dataPlanos as $data){
                                                         
                                                ?>
                                                    <option value="<?=$data['cod_plano']?>"><?=$data['nome']?></option>
                                                <?php } ?>
                                            </select>
                                            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('proposta-plano')?></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><!--Fim de Proposta-form-->
                         
                         <!--Dependentes, Agregados e Colaboradores form-->
                        <div id="plano_section" class="block" 
                            <?php if((isset($a) || isset($d) || isset($c)) && ($a == 1 || $c == 1 || $d == 1)) echo "style='display:block;'"; else echo "style='display:none;'";?>>
                            

                            <div class="block-content">
                                <div id="dependentes_section"
                                <?php if(isset($d) && $d == 1) echo "style='display:block;'"; else echo "style='display:none;'";?>>
                                    

                                    <div class="block-header" style="margin-left: -20px; color:#bbb">
                                        <p class="block-title">Dependentes <button style="margin-left: 25px" class="btn btn-sm btn-primary" id="novo_dependente" type="button">+</button></p>
                                        
                                    </div>
                                    
                                    <div id="dep">
                                        <div class="row">
                                            <div class="form-group col-md-5">
                                                <label class="control-label">Nome <span class="text-danger">*</span></label>
                                                <div class="">
                                                    <input class="form-control" type="text" name="dep-nome[]" placeholder="Insira um nome" value="<?= $this->input->post('dep-nome[]');?>">
                                                </div>
                                                <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('dep-nome[]')?></div>
                                            </div>
                                            <div class="form-group col-md-3">
                                                <label class="control-label">CPF <span class="text-danger">*</span></label>
                                                <div class="">
                                                    <input class="form-control cpf" type="text" name="dep-cpf[]" placeholder="Ex.: 999.999.999-99" value="<?= $this->input->post('dep-cpf[]');?>">
                                                </div>
                                                <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('dep-cpf[]')?></div>
                                            </div>
                                             <div class="form-group col-md-3">
                                                <label class="control-label" >Data de Nasc. <span class="text-danger">*</span></label>
                                                <div class="">
                                                    <input class="form-control data" type="text" name="dep-data-nasc[]" placeholder="Ex.: dd/mm/aaaa" value="<?= $this->input->post('dep-data-nasc[]');?>">
                                                </div>
                                                <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('dep-data-nasc[]')?></div>
                                            
                                            </div>
                                            
                                        </div>
                                    </div>
                                </div>

                                <div id="agregados_section"
                                <?php if(isset($a) && $a == 1) echo "style='display:block;'"; else echo "style='display:none;'";?>>
                                    <div class="block-header" style="margin-left: -20px; color:#bbb">
                                        <p class="block-title">Agregados <button style="margin-left: 40px" class="btn btn-sm btn-primary" type="button" id="novo_agregado">+</button></p>
                                    </div>
                                    <div id="agr">
                                    <div class="row">
                                        <div class="form-group col-md-5">
                                            <label class="control-label"">Nome <span class="text-danger">*</span></label>
                                            <div class="">
                                                <input class="form-control" type="text"  name="agr-nome[]" placeholder="Insira um nome" value="<?= $this->input->post('agr-nome[]');?>">
                                            </div>
                                            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('agr-nome[]')?></div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="control-label" >CPF <span class="text-danger">*</span></label>
                                            <div class="">
                                                <input class="form-control cpf" type="text"  name="agr-cpf[]" placeholder="Ex.: 999.999.999-99" value="<?= $this->input->post('agr-cpf[]');?>">
                                            </div>
                                            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('agr-cpf[]')?></div>
                                        </div>
                                         <div class="form-group col-md-3">
                                            <label class="control-label" >Data de Nasc. <span class="text-danger">*</span></label>
                                            <div class="">
                                                <input class="form-control data" type="text"  name="agr-data-nasc[]" placeholder="Ex.: dd/mm/aaaa" value="<?= $this->input->post('agr-data-nasc[]');?>">
                                            </div>
                                            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('agr-data-nasc[]')?></div>
                                        
                                        </div>
                                       
                                    </div>
                                    </div>
                                </div>

                                <div id="colaboradores_section" 
                                <?php if(isset($c) && $c == 1) echo "style='display:block;'"; else echo "style='display:none;'";?>>
                                    <div class="block-header" style="margin-left: -20px; color:#bbb">
                                        <h3 class="block-title">Colaboradores <button style="margin-left: 20px" class="btn btn-sm btn-primary" type="button" id="novo_colaborador" >+</button></h3>
                                    </div>
                                    <div id="colab">
                                    <div class="row">
                                        <div class="form-group col-md-5">
                                            <label class="control-label">Nome <span class="text-danger">*</span></label>
                                            <div class="">
                                                <input class="form-control" type="text" name="colab-nome[]" placeholder="Insira um nome" value="<?= $this->input->post('colab-nome[]');?>">
                                            </div>
                                            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('colab-nome[]')?></div>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <label class="control-label" >CPF <span class="text-danger">*</span></label>
                                            <div class="">
                                                <input class="form-control cpf" type="text"  name="colab-cpf[]" placeholder="Ex.: 999.999.999-99" value="<?= $this->input->post('colab-cpf[]');?>">
                                            </div>
                                            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('colab-cpf[]')?></div>
                                        </div>
                                         <div class="form-group col-md-3">
                                            <label class="control-label" >Data de Nasc. <span class="text-danger">*</span></label>
                                            <div class="">
                                                <input class="form-control data" type="text"  name="colab-data-nasc[]" placeholder="Ex.: dd/mm/aaaa" value="<?= $this->input->post('colab-data-nasc[]');?>">
                                            </div>
                                            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('colab-data-nasc[]')?></div>
                                        
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            </div>                            
                        </div>



                        <div class="block">
                            <div class="block-content">
                                <div class="row">
                                    <div class="form-group">

                                        <input type="submit" name="proposta-status" class="btn btn-sm btn-primary" style="float: right; margin-right: 20px; margin-bottom: 20px; " value="Gerar contrato"></input>

                                        <input type="submit" name="proposta-status" class="btn btn-sm btn-primary" style="float: right; margin-right: 20px; margin-bottom: 20px; " value="Salvar Proposta"></input>

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