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
                                Guias de Atendimento
                            </h1>
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
                                            <th>Beneficiario</th>
                                            <th>Data Abertura</th>
                                            <th>Data Realização</th>
                                            <th>Horário</th>
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
                                            <td class="font-w600"><?=formata_data_br($data['dt_abertura'])?> </td>
                                            <td class="font-w600"><?=formata_data_br($data['dt_realizacao'])?> </td>
                                            <td class="font-w600"><?=$data['horario']?> </td>
                                            <?php if($data['status'] == 'p'){?>
                                                <td><span class="label label-warning" type="button" data-toggle="modal" data-target="#atualizarStatusModal" data-whatever='<?=$s;?>'>Pendente</span></td>
                                            <?php }else if($data['status'] == 'c'){?>    
                                                <td><span class="label label-info" type="button" data-toggle="modal" data-target="#atualizarStatusModal" data-whatever='<?=$s;?>'>Confirmada</span></td>
                                            <?php }else if($data['status'] == 'a'){?>    
                                                <td><span class="label label-success" type="button" data-toggle="modal" data-target="#atualizarStatusModal" data-whatever='<?=$s;?>'>Atendido</span></td>
                                            <?php }else if($data['status'] == 'n'){?>    
                                                <td><span class="label label-danger" type="button" data-toggle="modal" data-target="#atualizarStatusModal" data-whatever='<?=$s;?>'>Não compareceu</span></td>
                                            <?php }else if($data['status'] == 'l'){?>    
                                                <td><span class="label label-danger" type="button" data-toggle="modal" data-target="#atualizarStatusModal" data-whatever='<?=$s;?>'>Cancelado</span></td>
                                            <?php }?>
                                            
                                            
                                            
                                        </tr>
                                    <?php } else { ?>
                                           <tr>
                                            <td colspan="7">Nenhum resultado encontrado</td>
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