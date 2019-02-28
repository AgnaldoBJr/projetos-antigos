<?php

	//echo $tipo['cod_tipo_usuario'];die;
	//echo $p['1']['nome']; die;

	

    $this->load->view('commons/header');
?>


<!-- Main Container -->
            <main id="main-container">
         	    <!-- Page Header -->
                <div class="content bg-gray-lighter">
                    <div class="row items-push">
                        <div class="col-sm-7">
                            <h1 class="page-heading">
                                Atualizar Tipo de Usuário
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


                    


			</script>

         	    <!-- Page Content -->
                <div class="content">
                    <!-- Dynamic Table Full -->
                    <div class="block">
                        <div class="block-content">
                            <form action="<?=base_url('tipos-de-usuario/alterar');?>" method="POST">
                            	<div class="row">
                            		<input type="hidden" name="cod_tipo_usuario" value="<?php echo $tipo['cod_tipo_usuario'];?>">
							        <div class="form-group col-md-6">
							            <label class="control-label" for="tipo-nome">Nome <span class="text-danger">*</span></label>
							            <div class="">
							                <input class="form-control" type="text" id="tipo-nome" name="tipo-nome" placeholder="Insira um nome" 
							                value="<?php if($this->input->post('tipo-nome') == null) echo $tipo['nome']; else echo $this->input->post('tipo-nome');?>">
							            </div>
							            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('tipo-nome')?></div>
							        </div>
							    </div>
							    
							    <div class="row">
									<div class="col-md-12">
			                            <!-- Always Visible Scrollbar -->
			                            <div class="block">
			                               <div class="block-header" style="margin-left: -20px; color:#bbb">
        										<h3 class="block-title">Permissões</h3>
    										</div>
			                                <table class="table table-striped table-responsive">
                                    <thead>    
                                        <tr>
                                            <th class="text-center"></th>
                                           
                                            <th style="width: 5%">Cod.</th>
                                            <th style="width: 30%">Nome</th>
                                            <th style="width: 15%">Inserir</th>
                                            <th style="width: 15%">Vizualizar</th>
                                            <th style="width: 15%">Atualizar</th>
                                            <th style="width: 20%">Excluir</th>
                                            
                                            
                                        </tr>
                                    </thead>
                                    </table>
			                                <div class="block-content block-content-full">
			                                    <!-- SlimScroll Container -->
			                                    <div class="edit" data-toggle="slimscroll" data-always-visible="true" >
			                                    <!-- data-height="300px" -->
			                                       <table class="table table-striped" >
					                                    <tbody>
					                                    <?php
					                                        if($p) foreach ($p as $data){
					                                        	
					                                    ?>
					                                        <tr>
					                                        <?php $s = json_encode($data);?>
					                                        <td class="text-center" style="width: 5%"><?=$data['cod_permissao']?></td>
					                                        <td class="font-w600" style="width: 35%"><?=$data['nome']?> 
					                                        </td>
					                                        <td style="width: 15%"> 
					                                            <label>
                													<input type="checkbox" name="<?='i-' . $data['cod_permissao'];?>" value="1" 
                											<?php 

																if ($this->input->post('insert') == null) 
																	if ($data['insert'] == 1) 
																		echo 'checked'; 
																
																else 
																	if ($this->input->post('insert') == '1') 
																		echo 'ckecked'; 

															?>>
           														</label> 
           														</td>
           														<td style="width: 15%"> 
					                                            <label>
                													<input type="checkbox" name="<?='r-' . $data['cod_permissao'];?>" value="1" 
															<?php 

																if ($this->input->post('read') == null) 
																	if ($data['read'] == 1) 
																		echo 'checked'; 
																
																else 
																	if ($this->input->post('read') == '1') 
																		echo 'ckecked'; 

															?>>
           														</label> 
           														</td>
           														<td style="width: 15%"> 
					                                            <label >
                													<input type="checkbox" name="<?='u-' . $data['cod_permissao'];?>" value="1" 
                											<?php 

																if ($this->input->post('update') == null) 
																	if ($data['update'] == 1) 
																		echo 'checked'; 
																
																else 
																	if ($this->input->post('update') == '1') 
																		echo 'ckecked'; 

															?>>
           														</label> 
           														</td>
           														<td style="width: 15%"> 
					                                            <label>
                													<input type="checkbox" name="<?='d-' . $data['cod_permissao'];?>" value="1" 
                											<?php 

																if ($this->input->post('delete') == null) 
																	if ($data['delete'] == 1) 
																		echo 'checked'; 
																
																else 
																	if ($this->input->post('delete') == '1') 
																		echo 'ckecked'; 

															?>>
           														</label> 
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
								<div class="row">
									<div class="form-group col-md-12">
							            <label for="tipo-descricao">Descrição</label>
							            <div>
							                <textarea class="form-control" id="tipo-descricao" name="tipo-descricao" rows="2" placeholder="Insira alguma sobre o tipo de usuário"><?php if($this->input->post('tipo-descricao') == null) echo $tipo['descricao']; else echo $this->input->post('tipo-descricao');?></textarea>
							            </div>
							        </div>
							    </div>
                                <div class="row">
                                	<!-- Enviar para a função a quantidade de permissões que existem no banco -->
                                	<input type="hidden" name="size" value="<?php echo $size;?>">
                                    <div class="form-group">
                                        <input type="submit" name="salvar" class="btn btn-sm btn-primary" style="float: right; margin-right: 20px; margin-bottom: 20px; " value="Salvar"></input>

                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- END Dynamic Table Full -->

<?php $this->load->view('commons/footer');?>
