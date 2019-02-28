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
                                Nova conta a receber
                            </h1>
                        </div>
                    </div>
                </div>
                <!-- END Page Header -->

         	    <!-- Page Content -->
                <div class="content">
                    <!-- Dynamic Table Full -->
                    <div class="block">
                        <div class="block-content">
                            <form action="<?=base_url('contas-a-receber/salvar');?>" method="POST">
                                <?php $this->load->view('financeiro/contas-a-receber/conta-receber-form');?>

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