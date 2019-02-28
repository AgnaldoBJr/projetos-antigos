<?php
    $this->load->view('commons/header');
?>
<!-- Main Container -->
            <main id="main-container">
         	    <!-- Page Header -->
                <div class="content bg-gray-lighter" style="height: 80px">
                    <div class="row items-push">
                        <div class="col-sm-10">
                            <h1 class="page-heading">
                                Relatório: Contratos
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
                    <form action="<?=base_url('relatorios/contratos')?>" method="post" id="filtro"  target="_blank">
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
                                    <label class="control-label">Período</label>
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
                    </form>
                              
                        </div>
                    </div>
                    

                   
                   
                        <div class="block-content">
                        <div class="block-header" style="margin-left: -20px;  color:#bbb">
                           
                            <div class="col-sm-11">
                                <h3 class="block-title">Favoritos</h3><br>
                            </div>
                           <div class="row">
                        <div class="col-sm-6 col-lg-4">
                            <a class="block block-link-hover3" href="<?=base_url('relatorios/contratos/este-mes')?>">
                                <div class="block-header">
                                    <h3 class="block-title">Este mês</h3>
                                </div>
                              </a>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <a class="block block-link-hover3" href="<?=base_url('relatorios/contratos/esta-semana')?>">
                                <div class="block-header">
                                    <h3 class="block-title">Esta semana</h3>
                                </div>
                               
                            </a>
                        </div>
                        
                    </div>
                
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

                