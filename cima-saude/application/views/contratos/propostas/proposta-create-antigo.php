                        <div id="plano_section" class="block" 
                            <?php 
                                if((isset($a) || isset($d) || isset($c)) && ($a == 1 || $c == 1 || $d == 1)){ echo "style='display:block;'"; 
                                }else {
                                    echo "style='display:none;'";}?>>
  
                            <div class="block-content">
                                <div id="dependentes_section"
                                <?php if(isset($d) && $d == 1) echo "style='display:block;'"; else echo "style='display:none;'";?>>
                                    

                                    
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
                                                                
                                                            <?php for($i = 1; $i <= 10; $i++){?>
                                                                <tr>
                                                                    <td class="font-w600" style="width: 50%">
                                                                        <div class="">
                                                                            <input class="form-control" type="text" name="<?php echo 'dep-nome[' . $i . ']';?>" placeholder="Insira um nome" value="<?= $this->input->post('dep-nome['. $i .']');?>">
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
                                                                                    <option value="Cônjuge" <?php if("Cônjuge" == $this->input->post('dep-parentesco[' . $i . ']')) echo "selected";?>>Cônjuge</option>
                                                                                    <option value="Filho(a)" <?php if("Filho(a)" == $this->input->post('dep-parentesco[' . $i . ']')) echo "selected";?>>Filho(a)</option>
                                                                                    <option value="Enteado(a)" <?php if("Enteado(a)" == $this->input->post('dep-parentesco[' . $i . ']')) echo "selected";?>>Enteado(a)</option>
                                                                                    <option value="Outro" <?php if("Outro" == $this->input->post('dep-parentesco[' . $i . ']')) echo "selected";?>>Outro</option>

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
                                <?php if(isset($a) && $a == 1) echo "style='display:block;'"; else echo "style='display:none;'";?>>
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
                                                                
                                                            <?php for($i = 1; $i <= 10; $i++){?>
                                                                <tr>
                                                                    <td class="font-w600" style="width: 50%">
                                                                        <div class="">
                                                                            <input class="form-control" type="text" name="<?php echo 'agr-nome[' . $i . ']';?>" placeholder="Insira um nome" value="<?= $this->input->post('agr-nome['. $i .']');?>">
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
                                                                                    <option value="Pai" <?php if("Pai" == $this->input->post('agr-parentesco[' . $i . ']')) echo "selected";?>>Pai</option>
                                                                                    <option value="Mãe" <?php if("Mãe" == $this->input->post('agr-parentesco[' . $i . ']')) echo "selected";?>>Mãe</option>
                                                                                    <option value="Sogro(a)" <?php if("Sogro(a)" == $this->input->post('agr-parentesco[' . $i . ']')) echo "selected";?>>Sogro(a)</option>
                                                                                    <option value="Outro" <?php if("Outro" == $this->input->post('agr-parentesco[' . $i . ']')) echo "selected";?>>Outro</option>

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
                                <?php if(isset($c) && $c == 1) echo "style='display:block;'"; else echo "style='display:none;'";?>>
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
                                                                
                                                            <?php for($i = 1; $i <= 10; $i++){?>
                                                                <tr>
                                                                    <td class="font-w600" style="width: 70%">
                                                                        <div class="">
                                                                            <input class="form-control" type="text" name="<?php echo 'colab-nome[' . $i . ']';?>" placeholder="Insira um nome" value="<?= $this->input->post('colab-nome['. $i .']');?>">
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
                                                    <!-- END SlimScroll Container -->
                                                </div>
                                            </div>
                                            <!-- END Always Visible Scrollbar -->
                                        </div>
                                    </div>
                                </div>
                            
