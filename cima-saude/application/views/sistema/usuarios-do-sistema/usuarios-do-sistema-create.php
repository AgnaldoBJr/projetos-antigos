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
                                Novo Usuário do Sistema
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
                    <div class="block">
                        <div class="block-content">


							<form action="<?=base_url('usuarios-do-sistema/salvar');?>" method="POST">
		                        <div class="row">
							        <div class="form-group col-md-5">
							            <label class="control-label" for="username">Username <span class="text-danger">*</span></label>
							            <div class="">
							                <input class="form-control" type="text" id="username" name="username" placeholder="Insira um nome de usuário" value="<?= $this->input->post('username');?>">
							            </div>
							            <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('username')?></div>
							        </div>
							        <div class="form-group col-md-4">
							            <label class="control-label" for="email">E-mail <span class="text-danger">*</span></label>
							            <div class="">
							                <input class="form-control" type="text" id="email" name="email" placeholder="Insira um e-mail válido" value="<?= $this->input->post('email');?>">
							            </div>
							             <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('email')?></div>
							        </div>
							        <div class="form-group col-md-3">
									    <label class="control-label" for="tipo">Tipo <span class="text-danger">*</span></label>
									   	<div class="">
											<select class="form-control" type="text" id="tipo" name="tipo" placeholder="Escolha uma opção...">
												<option value=<?php null;?>>Escolha uma opção...</option>
												<?php
													if($tipo != false)
								                    if($tipo) foreach ($tipo as $data){
								                ?>
								                    <option value="<?=$data['cod_tipo_usuario']?>" <?php if($data['cod_tipo_usuario'] == $this->input->post('tipo')) echo "selected";?>><?=$data['nome']?></option>

								                <?php }?>
											</select>
											<div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('tipo')?></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="form-group col-sm-5">   
		                                <div class="">
		                                	<label for="senha">Senha</label>
		                                    <input class="form-control" type="password" name="senha" placeholder="Digite uma senha">
		                                </div>
		                                <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('senha')?></div>
		                            </div>
		                            <div class="form-group col-sm-5">
		                                <div class="">
		                                    <label for="c_senha">Confirmar Senha</label>
		                                    <input class="form-control" type="password" name="c_senha" placeholder="Digite a senha novamente">
		                                </div>
		                                <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('c_senha')?></div>
		                            </div>
		                        </div>
		                        <div class="row">
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
