<?php 
    $this->load->helper('funcoes');
    //echo $dependentes['dep_nome'][0];
    //echo $dependentes['dep_nome'][1]; die;

    $this->load->view('commons/header');

?>
<!-- Main Container -->
            <main id="main-container">
                <!-- Page Header -->
                <div class="content bg-gray-lighter">
                    <div class="row items-push">
                        <div class="col-sm-10">
                            <h1 class="page-heading">
                                Visualizar Beneficiário<br><small><b>Tipo: </b><?=$tipo_beneficiario?></small>
                            </h1>
                        </div>
                         <div class="col-sm-2">

                           
                            <a href=""<?=base_url('beneficiarios/visualizar/' . $cod . '/' . $tab)?>"" class="btn btn-large btn-primary btn-rounded" style="float: right; margin-right: 10px">Editar</a>
                        
                           
                        </div>
                    </div>
                </div>

                <div class="content">
                    <div class="block">
                        <div class="block-content">
                        
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Tipo: </strong><?= $tipo_beneficiario;?><br>
                                </div>
                                 <div class="col-md-4">
                                    <strong>Carteirinha: </strong><?= $beneficiario['carteirinha'];?><br>
                                </div>
                                <div class="col-md-4">
                                    <strong>Status: </strong>Ativo<br>
                                </div>
                            </div>
                            <br><br>
                            <h3 class="block-title" style="color: #aaa">Dados Gerais</h3>
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Nome: </strong><?= $beneficiario['nome'];?><br>
                                </div>
                                 <div class="col-md-3">
                                    <strong>Data de Nascimento: </strong><?= $beneficiario['data_nasc'];?><br>
                                </div>
                                <div class="col-md-3">
                                    <strong>CPF: </strong><?= $beneficiario['cpf'];?><br>
                                </div>
                                 <div class="col-md-3">
                                    <strong>RG: </strong><?= $beneficiario['rg'];?><br>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-3">
                                   <strong>Gênero: </strong><?= convertGenero($beneficiario['sexo']);?>
                                </div>
                                <div class="col-md-3">
                                   <strong>Estado Civil: </strong><?= convertEstadoCivil($beneficiario['estado_civil']);?>
                                </div>
                                
                            </div>
                            <br><br>
                            <h3 class="block-title" style="color: #aaa">Endereço</h3>
                            <div class="row">
                                <div class="col-md-5">
                                   <strong>Endereço: </strong><?= $beneficiario['logradouro'];?>, <?= $beneficiario['numero'];?> - <?= $beneficiario['bairro'];?>
                                </div>
                                <div class="col-md-3">
                                   <strong>CEP: </strong><?= $beneficiario['cep'];?>
                                </div>
                                <div class="col-md-4">
                                    <strong>Cidade/Estado: </strong><?= $beneficiario['cidade'];?>/<?= $beneficiario['estado'];?>
                                </div>
                            </div>
                            <br><br>
                            <h3 class="block-title" style="color: #aaa">Contato</h3>
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Telefone: </strong><?= $beneficiario['telefone'];?><br>
                                </div>
                                 <div class="col-md-3">
                                    <strong>Celular: </strong><?= $beneficiario['celular'];?><br>
                                </div>
                                <div class="col-md-3">
                                    <strong>Email: </strong><?= $beneficiario['email'];?><br>
                                </div>
                                 <br><br>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <div class="block">
                        <div class="block-content">
                            <h3 class="block-title" style="color: #aaa">Histórico de Consultas</h3>
                             <br><br> <br><br>
                            
                    </div>
                </div>

            </main>
                            
                            
                            
 
<?php $this->load->view('commons/footer');?>