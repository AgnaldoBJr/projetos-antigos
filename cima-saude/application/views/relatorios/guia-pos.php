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
                                Guias de Atendimento - Pós atendimento
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
                                            
                                            <th>Beneficiário</th>
                                            <th>Parceiro</th>
                                            <th>Data Realização</th>
                                            <th>Data Avaliação</th>
                                            <th>Avaliação</th>
                                            <th>Detalhes</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        if($dataTable) foreach ($dataTable as $data){
                                    ?>
                                        <tr>
                                        <?php $s = json_encode($data);?>
                                        <td class="text-center"><?=$data['beneficiario']?></td>
                                            <td class="font-w600"><?=$data['parceiro']?> </td>
                                            <td class="font-w600"><?=formata_data_br($data['dt_realizacao'])?> </td>
                                            <td class="font-w600"><?=formata_data_br($data['aval_dt_cadastro'])?> </td>
                                            <?php if($data['avaliacao'] == '1'){?>
                                               <td class="font-w600"> <span class="label label-success">Muito Bom</span></td>
                                            <?php }else if($data['avaliacao'] == '2'){?>    
                                               <td class="font-w600"> <span class="label label-info">Bom</span></td>
                                            <?php }else if($data['avaliacao'] == '3'){?>    
                                                <td class="font-w600"><span class="label label-warning">Regular</span></td>
                                            <?php } else if($data['avaliacao'] == '4'){?>    
                                                <td class="font-w600"><span class="label label-danger">Ruim</span></td></td>
                                             <?php } else if($data['avaliacao'] == '5'){?>    
                                                <td class="font-w600"><span class="label label-danger">Muito Ruim</span></td>
                                            <?php }?>
                                            <td class="font-w600"><?=$data['descricao']?> </td>
                                            
                                            
                                            
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