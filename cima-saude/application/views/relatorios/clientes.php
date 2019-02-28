<?php 
    $this->load->view('commons/head-relatorios');
   
?>
		<!-- Main Container -->
            <main id="main-container">
         	    <!-- Page Header -->
                <div class="content bg-gray-lighter">
                    <div class="row items-push">
                        <div class="col-sm-10">
                            <h1 class="page-heading">
                                Clientes
                            </h1>
                        </div>
                        <div class="col-sm-2">
                            <!--<button type="submit" style="float: right;" class="btn btn-default" value="1"><i class="fa fa-file-text-o"></i></button>-->
                            <button class="btn btn-default" type="button" data-toggle="modal" data-target="#avisoModal"><i class="fa fa-file-text-o"></i></button>
                        </div>
                    </div>
                </div>
            
         	    <!-- Page Content -->
                <div class="content">
                    <!-- Dynamic Table Full -->
                    <div class="block">
                        <div class="block-content">
                        <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
                            <div class="col-lg-12">
                                <table class="table table-bordered table-striped" >
                                    <thead>    
                                        <tr>
                                            <th>Nome</th>
                                            <th>Data Nasc.</th>
                                            <th>Celular</th>
                                            <th>Contrato</th>
                                            <th>Data Contrato</th>
                                            <th>Status</th>
                                             
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        if($dataTable) foreach ($dataTable as $data){
                                    ?>
                                        <tr>
                                        <?php $s = json_encode($data);?>
                                            <td class="text-center"><?=$data['nome']?></td>
                                            <td class="font-w600"><?=$data['data_nasc']?> </td>
                                            <td class="font-w600"><?=$data['celular']?> </td>
                                            <td class="font-w600"><?=$data['numero']?> </td>

                                            <td class="font-w600"><?=formata_data_br($data['dt_contratacao'])?> </td>
                                            <?php if($data['status'] == 'C'){?>
                                                    <td><span class="label label-success">Ativo</span></td>
                                                <?php }else if($data['status'] == 'I'){?>    
                                                    <td><span class="label label-danger">Inativo</span></td>
                                                <?php }else if($data['status'] == 'A'){?>    
                                                    <td><span class="label label-info">Cancelado</span></td>
                                                <?php }else if($data['status'] == 'V'){?>    
                                                    <td><span class="label label-warning">Vencido</span></td>
                                                <?php }else if($data['status'] == 'N'){?>    
                                                    <td><span class="label label-warning">Sem Contrato</span></td>
                                            <?php }?>
                                            
                                        </tr>
                                    <?php } else { ?>
                                           <tr>
                                            <td colspan="6">Nenhum resultado encontrado</td>
                                           </tr>
                                    <?php }?>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                
                            </div>
                        </div>
                    </div>
                    <!-- END Dynamic Table Full -->
                       
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


<?php $this->load->view('commons/footer');?>