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
                                Centros de Lucro
                            </h1>
                            <span> Cadastre e visualize os seus centros de lucro!</span> 
                        </div>
                    </div>
                </div>
                <!-- END Page Header -->

                <!-- Page Content -->
                <div class="content">
                    <!-- Dynamic Table Full -->
                    <div class="block">
                        <div class="block-content">
                            <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
                            <div class="col-lg-8 col-lg-offset-2">
                                <table class="table table-bordered table-striped js-dataTable-full" >
                                    <thead>
                                        <tr>
                                        
                                        
                                            <th class="text-center"></th>
                                            <th ">Nome</th>
                                            <th class="text-center" ">Ações</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                           <!-- <td class="text-center"></td>
                                            <td class="font-w600"></td>
                                            <td class="font-w600"></td>
                                            <td></td>-->
                                            
                                       
                                            <td class="text-center"></td>
                                            <td></td>
                                            <td class="text-center">
                                                <div class="btn-group">
                                                    <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Editar Centro de Lucro"><i class="fa fa-pencil"></i></button>
                                                    <button class="btn btn-xs btn-default" type="button" data-toggle="tooltip" title="Remover Centro de Lucro"><i class="fa fa-times"></i></button>
                                                </div>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                            <div class="row">
                                <div class="col-xs-12">
                                    <a class="btn btn-sm btn-primary" href="<?=base_url('centro-de-lucro/novo')?>" style="float: right; margin-bottom: 20px;" type="submit">Novo</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- END Dynamic Table Full -->
                </div>
                <!-- END Page Content -->
            </main>
            <!-- END Main Container -->

            

<?php $this->load->view('commons/footer');?>