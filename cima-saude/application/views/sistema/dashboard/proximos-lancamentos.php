<?php 
    $this->load->view('commons/header');
 ?>

 <main id="main-container">
         	    <div class="content bg-gray-lighter">
                    <div class="row items-push">
                        <div class="col-sm-10">
                            <h1 class="page-heading">
                                Próximos lançamentos
                            </h1>
                            <p>Contas geradas para os próximos 15 dias</p>
                        </div>
                        <div class="col-sm-2">
                            
                        </div>
                    </div>
                </div>
            
         	    <div class="content">
                    <div class="block">
                        <div class="block-content">
                            <div class="col-lg-12">
                                <table class="table table-bordered table-striped" >
                                    <thead>    
                                        <tr>
                                            <th>Descrição</th>
                                            <th>Data Prevista</th>
                                            <th>Valor (R$)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        if($dataTable)  foreach ($dataTable as $data){
                                    ?>
                                        <tr>
                                        <?php $s = json_encode($data);?>
                                        <td class=""><?=$data['descricao']?></td>
                                        <td class="font-w600"><?=formata_data_br($data['data_prevista'])?> </td>
                                            
                                        <?php if($data['id_table']=='1'){?>
                                        <td class="font-w600" style="color: red"><?=formata_preco($data['valor'])?> </td>
                                        <?php } else { ?>
										<td class="font-w600" style="color:blue"><?=formata_preco($data['valor'])?> </td>
                                        <?php } ?>    
                                            
                                        </tr>

                                    <?php } else { ?>
                                           <tr>
                                            <td colspan="3">Nenhum resultado encontrado</td>
                                           </tr>
                                    <?php }?>
                                    </tbody>

                                </table>
                            </div>
                            <div class="row">
                                <div class="form-group">
                                        <a href="<?=base_url('dashboard')?>" type="submit" name="salvar" class="btn btn-sm btn-primary" style="float: right; margin-right: 20px; margin-bottom: 20px;">Voltar</a>

                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Dynamic Table Full -->


<?php $this->load->view('commons/footer');?>