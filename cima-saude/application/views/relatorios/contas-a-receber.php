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
                                Contas à Receber
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
                                            <th>Descrição</th>
                                            <th>Categoria</th>
                                            <th>Centro de Lucro</th>
                                            <th>Data de Recebimento</th>
                                            <th>Valor</th>
                                            <th>Status</th> 
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        if($dataTable) foreach ($dataTable as $data){
                                    ?>
                                        <tr>
                                        <?php $s = json_encode($data);?>
                                        <td class="text-center"><?=$data['descricao']?></td>
                                            <?php if($data['nome_categoria'] == ''){?>
                                                <td class="font-w600">Clientes</td>
                                             <?php }else {?>  
                                                <td class="font-w600"><?=$data['nome_categoria']?> </td>
                                             <?php }?>
                                            <?php if($data['nome_centro'] == ''){?>   
                                            <td class="font-w600">Convênio</td>
                                            <?php }else {?>  
                                                <td class="font-w600"><?=$data['nome_centro']?> </td>
                                             <?php }?>
                                            <td class="font-w600"><?=formata_data_br($data['dt_recebimento'])?> </td>
                                           
                                            <td class="font-w600"><?=formata_preco($data['valor'])?> </td>
                                            <?php if($data['status'] == 1){?>
                                                    <td><span class="label label-danger">À Receber</span></td>
                                                <?php }else {?>    
                                                    <td><span class="label label-info">Recebido</span></td>
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