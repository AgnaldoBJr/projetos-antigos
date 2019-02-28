<?php 
    $this->load->helper('funcoes');
    //echo $dependentes['dep_nome'][0];
    //echo $dependentes['dep_nome'][1]; die;


?>
<!-- Main Container -->
            <main id="main-container">
                <!-- Page Header -->
                <div class="content bg-gray-lighter">
                    <div class="row items-push">
                        <div class="col-sm-10">
                            <h1 class="page-heading">
                                Visualizar Guia de Atendimento<br>
                            </h1>
                        </div>
                         <div class="col-sm-2">

                           
                            <a href="<?=base_url('atendimento/atendimentos/atualizar/' . $dataBeneficiario['cod'] . '/' . $dataBeneficiario['tab'])?>" class="btn btn-large btn-primary btn-rounded" style="float: right; margin-right: 10px">Editar</a>
                        
                           
                        </div>
                    </div>
                </div>

                <div class="content">
                    <div class="block">
                        <div class="block-content">
                        
                            <h3 class="block-title" style="color: #aaa">Dados Gerais</h3>
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Nome: </strong><?= $dataBeneficiario['nome'];?><br>
                                </div>
                                 <div class="col-md-4">
                                    <strong>Data de Nascimento: </strong><?php if($dataBeneficiario['tab'] == '1') {echo $dataBeneficiario['data_nasc'];}else { echo formata_data_br($dataBeneficiario['data_nasc']);}?><br>
                                </div>
                                
                            </div>
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Tipo: </strong><?= $dataBeneficiario['tipo'];?><br>
                                </div>
                                 <div class="col-md-4">
                                    <strong>Carteirinha: </strong><?= $dataBeneficiario['carteirinha'];?><br>
                                </div>
                                <div class="col-md-4">
                                    <strong>Status: </strong>Ativo<br>
                                </div>
                            </div>
                            

                            <br><br>
                            <h3 class="block-title" style="color: #aaa">Guia de Atendimento</h3>
                             <div class="row">
                                <div class="col-md-3">
                                   <strong>Data de Abertura: </strong><?= formata_data_br($dataGuia['dt_abertura']);?>
                                </div>
                                <div class="col-md-3">
                                   <strong>Data de Realização: </strong><?= formata_data_br($dataGuia['dt_realizacao']);?>
                                </div>
                                <div class="col-md-3">
                                   <strong>Horário: </strong><?= $dataGuia['horario'];?>
                                </div>
                                <div class="col-md-3">
                                   <strong>Status: </strong><?= $dataGuia['status'];?>
                                </div>
                                
                            </div>
                           
                            <br><br>
                            
                            <h3 class="block-title" style="color: #aaa">Serviços</h3>
                            <table class="table table-bordered table-striped" >
                                <thead>    
                                    <tr>
                                        <th style="width: 50%">Nome</th>
                                        <th style="width: 25%">Preço <?= $dataGuia['valor_tipo'];?></th>
                                       
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        if($dataServicos) foreach ($dataServicos as $data){
                                    ?>
                                    <tr>
                                        <td class="font-w600"><?php if($data['fk_exame'] == '1') echo $data['nom']; else echo $data['nome']?> </td>
                                        <td class="font-w600"><?php if($dataGuia['valor_tipo'] == 'CIMA') echo formata_preco($data['valor_cima']); else if ($dataGuia['valor_tipo'] == 'Recibo') echo formata_preco($data['valor_recibo'])?> </td>
                                        
                                    </tr>
                                <?php 
                                    } else{
                                    echo "<tr><td colspan='3'> Serviços gerais. Nenhum serviço foi especificado</td></tr>";     
                                }
                                  
                            
                                  
                            ?>
                                </tbody>
                            </table>
                     
                        </div>
                    </div>
                </div>
                

            </main>
                            
                            
                            
 
<?php $this->load->view('commons/footer');?>