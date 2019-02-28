<?php 

//var_dump($proposta); die;
    $this->load->view('commons/header');
    $this->load->helper('funcoes');

?>
<!-- Main Container -->
            <main id="main-container">
         	    <!-- Page Header -->
                <div class="content bg-gray-lighter">
                    <div class="row items-push">
                        <div class="col-sm-7">
                            <h1 class="page-heading">
                                Atualizar Proposta
                            </h1>
                        </div>
                    </div>
                </div>
                <!-- END Page Header -->
            <form action="<?=base_url('c-contratos/proposta/alterar');?>" method="POST" id="propostaformupdate">
         	    <!-- Page Content -->
                <div class="content">
                    <!-- Dynamic Table Full -->
                    <div class="block">
                        <div class="block-content">
                            
                                <input type="hidden" name="cod_proposta" value="<?php echo $proposta['cod_proposta']?>"  />
                                <input type="hidden" name="cod_cliente" value="<?php echo $proposta['fk_cliente']?>"  />
                                <input type="hidden" name="cod_plano" value="<?php echo $proposta['fk_plano']?>"  />
                                
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label class="control-label" for="proposta-numero">Nº da Proposta </label>
                                        <div class="">
                                            <input class="form-control" type="text" id="proposta-numero" name="proposta-numero" value="<?php echo $proposta['numero']?>" readonly="readonly">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="proposta-cliente">Cliente <span class="text-danger">*</span></label>
                                        <div >
                                            <select class="form-control" type="text" id="proposta-cliente" name="proposta-cliente" placeholder="Escolha uma opção..." readonly="readonly" disabled>
                                                <option value="<?=$cliente['cod_cliente']?>" ><?=$cliente['nome']?></option>


                                            </select>
                                        </div>
                                    </div>
                               
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="proposta-plano">Plano <span class="text-danger">*</span></label>
                                        <div class="">
                                            <select class="form-control" type="text" id="proposta-plano" name="proposta-plano" placeholder="Escolha uma opção..." readonly="readonly" disabled>
                                            
                                                    <option value="<?=$plano['cod_plano']?>"><?=$plano['nome']?></option>
                                               
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-2" style="float: right; margin-top: 5px">
                                         <div class="block-content block-content-full">
                                    <button class="btn btn-sm btn-default" data-toggle="popover" title="Alteração" data-placement="top" data-content="Adicione uma nova proposta para poder editar os campos desabilitados" type="button"><i class="si si-info"></i></button>
                                        
                                    </div>
                                </div>  
                            </div>
                        </div>
                    </div>
                </div>
               

                <div class="content" style="margin-top: -50px;">
                <!--Dependentes, Agregados e Colaboradores form-->
                    <div id="plano_section" class="block" 
                        <?php  
                            if($plano['dependentes'] == '1' || $plano['agregados'] == '1' || $plano['colaboradores'] == '1'){ 
                                echo "style='display:block;'"; 
                            }else {
                                echo "style='display:none;'";}
                        ?>
                    >

                        <div class="block-content">
                            <div id="dependentes_section"
                            <?php if($plano['dependentes'] == '1') echo "style='display:block;'"; else echo "style='display:none;'";?>>

                                <div class="row">
                                    <div class="col-md-12">
                                    <!-- Always Visible Scrollbar -->
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
                                            <div class="">
                                                <!-- SlimScroll Container -->
                                                <div class="edit" data-toggle="slimscroll" data-always-visible="true" >
                                                <!-- data-height="300px" -->
                                                   <table class="table table-striped" >
                                                        <tbody>
                                                            
                                                        <?php for($i = 0; $i < 10; $i++){?>
                                                            <tr>
                                                                <td class="font-w600" style="width: 50%">
                                                                    <div class="">
                                                                        <input class="form-control" type="text" name="<?php echo 'dep-nome[' . $i . ']';?>" id="<?php echo 'dep-nome' . $i;?>" placeholder="Insira um nome" value="<?php if(isset($dependentes[$i]['nome'])) echo $dependentes[$i]['nome']?>">
                                                                    </div>
                                                                    <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('dep-nome['. $i .']')?></div>
                                                                </td>
                                                                <td style="width: 25%"> 
                                                                    <div class="">
                                                                        <input class="form-control data" type="text" name="<?php echo 'dep-data-nasc[' . $i . ']';?>" id="<?php echo 'dep-data' . $i;?>" placeholder="Ex.: dd/mm/aaaa" value="<?php if(isset($dependentes[$i]['data_nasc'])) echo formata_data_br($dependentes[$i]['data_nasc'])?>">
                                                                    </div>
                                                                    <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('dep-data-nasc['. $i .']')?></div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
        
                                                                        <div class="">
                                                                            <select class="form-control" type="text" name="<?php echo 'dep-parentesco[' . $i . ']';?>"  id="<?php echo 'dep-parentesco' . $i;?>" placeholder="Escolha uma opção...">
                                                                                <option value=<?php null;?>>Escolha uma opção...</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                                                                <option value="Cônjuge" <?php if(isset($dependentes[$i]['parentesco'])) if("Cônjuge" == $dependentes[$i]['parentesco']) echo "selected";?>>Cônjuge</option>
                                                                                <option value="Filho(a)" <?php  if(isset($dependentes[$i]['parentesco'])) if("Filho(a)" == $dependentes[$i]['parentesco']) echo "selected";?>>Filho(a)</option>
                                                                                <option value="Enteado(a)" <?php  if(isset($dependentes[$i]['parentesco'])) if("Enteado(a)" == $dependentes[$i]['parentesco']) echo "selected";?>>Enteado(a)</option>

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
                                                <!-- END SlimScroll Container -->
                                            </div>
                                        </div>
                                        <!-- END Always Visible Scrollbar -->
                                    </div>
                                </div>  
                            </div>

                            <div id="agregados_section"
                            <?php if($plano['agregados'] == '1') echo "style='display:block;'"; else echo "style='display:none;'";?>>
                                <div class="row">
                                    <div class="col-md-12">
                                    <!-- Always Visible Scrollbar -->
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
                                            <div class="">
                                                <!-- SlimScroll Container -->
                                                <div class="edit" data-toggle="slimscroll" data-always-visible="true" >
                                                <!-- data-height="300px" -->
                                                   <table class="table table-striped" >
                                                        <tbody>
                                                            
                                                        <?php for($i = 0; $i < 10; $i++){?>
                                                            <tr>
                                                                <td class="font-w600" style="width: 50%">
                                                                    <div class="">
                                                                        <input class="form-control" id="<?php echo 'agr-nome' . $i;?>" type="text" name="<?php echo 'agr-nome[' . $i . ']';?>" placeholder="Insira um nome" value="<?php if(isset($agregados[$i]['nome'])) echo $agregados[$i]['nome']?>">
                                                                    </div>
                                                                    <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('agr-nome['. $i .']')?></div>
                                                                </td>
                                                                <td style="width: 25%"> 
                                                                    <div class="">
                                                                        <input class="form-control data" id="<?php echo 'agr-data' . $i;?>" type="text" name="<?php echo 'agr-data-nasc[' . $i . ']';?>" placeholder="Ex.: dd/mm/aaaa" value="<?php if(isset($agregados[$i]['data_nasc'])) echo formata_data_br($agregados[$i]['data_nasc']);?>">
                                                                    </div>
                                                                    <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('agr-data-nasc['. $i .']')?></div>
                                                                </td>
                                                                <td>
                                                                    <div class="">
        
                                                                        <div class="">
                                                                            <select class="form-control" id="<?php echo 'agr-parentesco' . $i;?>" type="text" name="<?php echo 'agr-parentesco[' . $i . ']';?>" placeholder="Escolha uma opção...">
                                                                                <option value=<?php null;?>>Escolha uma opção...</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                                                                <option value="Pai" <?php  if(isset($agregados[$i]['parentesco'])) if("Pai" == $agregados[$i]['parentesco']) echo "selected";?>>Pai</option>
                                                                                <option value="Mãe" <?php if(isset($agregados[$i]['parentesco'])) if("Mãe" == $agregados[$i]['parentesco']) echo "selected";?>>Mãe</option>
                                                                                <option value="Sogro(a)" <?php  if(isset($agregados[$i]['parentesco'])) if("Sogro(a)" == $agregados[$i]['parentesco']) echo "selected";?>>Sogro(a)</option>

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
                                                <!-- END SlimScroll Container -->
                                            </div>
                                        </div>
                                        <!-- END Always Visible Scrollbar -->
                                    </div>
                                </div>
                            </div>

                            <div id="colaboradores_section" 
                            <?php if($plano['colaboradores'] == '1') echo "style='display:block;'"; else echo "style='display:none;'";?>>
                                <div class="row">
                                    <div class="col-md-12">
                                    <!-- Always Visible Scrollbar -->
                                        <div class="block">
                                           <div class="block-header" style="margin-left: -20px; color:#bbb">
                                                <h3 class="block-title">Colaboradores</h3>
                                            </div>
                                            <table class="table table-striped table-responsive">
                                                <thead>    
                                                    <tr>
                                                        <th class="text-center"></th>
                                                        <th style="width: 70%">Nome</th>
                                                        <th style="width: 30%">Data de Nascimento</th>
                                                    </tr>
                                                </thead>
                                            </table>
                                            <div class="">
                                                <!-- SlimScroll Container -->
                                                <div class="edit" data-toggle="slimscroll" data-always-visible="true" >
                                                <!-- data-height="300px" -->
                                                   <table class="table table-striped" >
                                                        <tbody>
                                                            
                                                        <?php for($i = 0; $i < 10; $i++){?>
                                                            <tr>
                                                                <td class="font-w600" style="width: 70%">
                                                                    <div class="">
                                                                        <input class="form-control" id="<?php echo 'colab-nome' . $i;?>" type="text" name="<?php echo 'colab-nome[' . $i . ']';?>" placeholder="Insira um nome" value="<?php if(isset($colaboradores[$i]['nome'])) echo $colaboradores[$i]['nome']?>">
                                                                    </div>
                                                                    <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('colab-nome['. $i .']')?></div>
                                                                </td>
                                                                
                                                                <td style="width: 30%"> 
                                                                    <div class="">
                                                                        <input class="form-control data" id="<?php echo 'colab-data' . $i;?>" type="text" name="<?php echo 'colab-data-nasc[' . $i . ']';?>" placeholder="Ex.: dd/mm/aaaa" value="<?php if(isset($colaboradores[$i]['data_nasc'])) echo formata_data_br($colaboradores[$i]['data_nasc'])?>">
                                                                    </div>
                                                                    <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('colab-data-nasc['. $i .']')?></div>
                                                                </td>
                                                               
                                                            </tr>
                                                         <?php } ?>
                                                        </tbody>
                                                    </table>
                                                    
                                                </div>
                                                <!-- END SlimScroll Container -->
                                            </div>
                                        </div>
                                        <!-- END Always Visible Scrollbar -->
                                    </div>
                                </div>
                            </div>
                        </div>                            
                    </div>
                </div>
                <div class="content" style="margin-top: -50px;">
                    <div class="block">
                        <div class="block-content">
                            <div class="row">    
                                <div class="form-group col-md-4">
                                    <label class="control-label" for="pag-contratacao">Data da Proposta <span class="text-danger">*</span></label>
                                    <div class="">
                                        <input class="form-control data" type="text" id="pag-contratacao" name="pag-contratacao" placeholder="Ex.: dd/mm/aaaa" value="<?=formata_data_br($proposta['dt_contratacao']);?>">
                                    </div>
                                    <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('pag-contratacao')?></div>
                                </div>
                                <div class="form-group col-md-4">
                                    <label class="control-label" for="pag-desconto">Desconto(%)</label>
                                    <div class="">
                                        <input class="form-control" id="desconto" type="text" id="pag-desconto" name="pag-desconto" placeholder="Número de 1 a 10" value="<?php echo ($proposta['pag_desconto'] != 'Não aplicado') ? $proposta['pag_desconto'] : ''; ?>" onkeypress='return SomenteNumero(event)'>
                                    </div>
                                    <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('pag-desconto')?></div>
                                </div>
                                <div class="form-group col-md-3">
                                    <label class="control-label" for="pag-modo">Modo de Pagamento <span class="text-danger">*</span></label>
                                    <div class="">
                                        <select class="form-control" type="text" id="pag-modo" name="pag-modo" placeholder="Escolha uma opção...">
                                            <option value=<?php null;?>>Escolha uma opção...</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                            <option value="1" <?php if($proposta['pag_modo_pagamento'] == '1') echo 'selected'; ?>>Dinheiro</option>
                                            <option value="2" <?php if($proposta['pag_modo_pagamento'] == '2') echo 'selected'; ?>>Cartão - Débito</option>
                                            <option value="3" <?php if($proposta['pag_modo_pagamento'] == '3') echo 'selected'; ?>>Cheque</option>
                                            <option value="4" <?php if($proposta['pag_modo_pagamento'] == '4') echo 'selected'; ?>>Boleto</option>
                                            <option value="5" <?php if($proposta['pag_modo_pagamento'] == '5') echo 'selected'; ?>>Cartão - Crédito</option>
                                        </select>
                                         <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('pag-modo')?></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                
                                <div  id="parcelas">
                                    <div class="form-group col-md-2" id="parcelas_num" <?php if($proposta['pag_modo_pagamento'] == '4' || $proposta['pag_modo_pagamento'] == '5') echo 'style="display: block"'; else echo 'style="display: none"';?> >
                                        <label class=" control-label" for="pag-numero">Parcelas<span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control" type="text" id="pag-numero" name="pag-num" placeholder="Ex.: 3" onkeypress='return SomenteNumero(event)' value="<?= $proposta['pag_qtd_parcelas']; ?>">
                                        </div>
                                        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('pag-numero')?></div>
                                    </div>
                                    <div class="form-group col-md-3" id="select-venc" <?php if($proposta['pag_modo_pagamento'] == '4') echo 'style="display: block"'; else echo 'style="display: none"';?>>
                                        <label class="control-label" for="pag-modo">Dia para vencimento <span class="text-danger">*</span></label>
                                        <select class="form-control" type="text"  name="melhor-dia" placeholder="Escolha uma opção...">
                                            <option value="<?php null;?>">Escolha uma opção...</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                            <option value="5" <?php if($proposta['pag_melhor_dia'] == '5') echo 'selected';?>>Dia 5</option>
                                            <option value="10" <?php if($proposta['pag_melhor_dia'] == '10') echo 'selected';?>>Dia 10</option>
                                            <option value="15" <?php if($proposta['pag_melhor_dia'] == '15') echo 'selected';?>>Dia 15</option>
                                            <option value="20" <?php if($proposta['pag_melhor_dia'] == '20') echo 'selected';?>>Dia 20</option>
                                            <option value="25" <?php if($proposta['pag_melhor_dia'] == '25') echo 'selected';?>>Dia 25</option>
                                            <option value="30" <?php if("5" == $this->input->post('pag-modo')) echo "selected";?>>Dia 30</option>
                                        </select>
                                     </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="plano-observacoes">Observações</label>
                                    <div>
                                        <textarea class="form-control" id="plano-observacoes" name="plano-observacoes" rows="2" placeholder="Insira alguma descrição para o plano" value="<?= $proposta['observacoes']; ?>"><?php ?></textarea>
                                    </div>
                                    <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('plano-observacoes')?></div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label class="control-label" for="proposta-subtotal">Subtotal </label>
                                    <div class="">
                                        <input class="form-control" type="text" id="proposta-subtotal" name="proposta-subtotal" value="<?php echo formata_preco($proposta['pag_subtotal'])?>" readonly="readonly">
                                    </div>
                                </div>
                               
                                <div class="form-group col-md-4">
                                    <label class="control-label" for="proposta-texto">Parcelas </label>
                                    <div class="">
                                        <input class="form-control" type="text" id="proposta-texto" name="proposta-texto" value="<?php echo $proposta['pag_texto']?>" readonly="readonly">
                                    </div>
                                </div>
                                 <div class="form-group col-md-4">
                                    <label class="control-label" for="proposta-total">Total </label>
                                    <div class="">
                                        <input class="form-control" type="text" id="proposta-total" name="proposta-total" value="<?php echo formata_preco($proposta['pag_total'])?>" readonly="readonly">
                                    </div>
                                </div>
                               
                            </div>
                       </div>
                    </div>
                </div>

                <div class="content" style="margin-top: -50px;">
                    <div class="block">
                        <div class="block-content">
                            
                            <div class="row">
                                <div class="form-group">
                                    <input type="submit" name="alterar" class="btn btn-sm btn-primary" style="float: right;  margin-bottom: 20px; " value="Alterar"></input>
                                </div>
                            </div>

                        </div>
                    </div>     
                </div>
            </form>          
<script type="text/javascript">
   
    var items = document.getElementById('pag-modo');
    items.addEventListener('change', function(){
        //console.log("O indice é: " + items.selectedIndex);
        //console.log("O texto é: " + items.options[items.selectedIndex].text);
        //console.log("A chave é: " + items.options[items.selectedIndex].value);
        
        //console.log(s[0].nome);
        console.log(document.getElementsByName("pag-num").value);

        document.getElementById("parcelas_num").style.display = 'none';
        document.getElementById("select-venc").style.display = 'none';
        document.getElementById("pag-numero").value = '';

        if(items.options[items.selectedIndex].value == "5"){
            document.getElementById("parcelas_num").style.display = 'block';
            document.getElementById("select-venc").style.display = 'none';
        } else if(items.options[items.selectedIndex].value == "4"){
            document.getElementById("parcelas_num").style.display = 'block';
            document.getElementById("select-venc").style.display = 'block';
        }
        
    });
</script>


<?php $this->load->view('commons/footer');?>

<script src="<?=base_url('assets/js/validation/proposta-update.js');?>"></script>
