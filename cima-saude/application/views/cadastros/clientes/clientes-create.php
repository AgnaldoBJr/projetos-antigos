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
                                Novo cliente
                            </h1>
                        </div>
                    </div>
                </div>
                <!-- END Page Header -->

                <?php if($this->session->flashdata('msg')): ?>
                   
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
                            <form action="<?=base_url('c-cadastros/cliente/salvar');?>" method="POST">
                                <?php $this->load->view('cadastros/clientes/clientes-form');?>

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