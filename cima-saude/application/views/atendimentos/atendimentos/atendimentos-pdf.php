<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('funcoes');

//$this->load->view('commons/head');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Guia de Atendimento Cima Saúde</title>

    <style type="text/css">
        h1 {
            font-family: sans-serif;
            font-size: 18px;
            text-align: center;
        }
        
        h3 {
            font-family: sans-serif;
            font-size: 14px;
        }

        h4 {
            font-family: sans-serif;
            font-size: 14px;
            color: #666;
        }

         h5 {
            font-family: sans-serif;
            font-size: 12px;
            color: #999;
        }

        span {
            font-weight: bold;
        }

        p {
            text-align: justify;
            font-size: 12px;
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 0.5px solid black;
            padding-left: 10px;
            padding-bottom: 5px;
            padding-right: 5px; 
            padding-top: 5px;
            font-size: 12px;
            font-family: sans-serif;
        }
        th {
            text-align: justify;
        }

        .no-borded {
            padding: 10px;
            border: 0px solid black;
        }

    </style>
</head>
<body>

<div style="text-align: center;"><img src="<?=base_url('assets/img/cima/logo-cima.jpg')?>"></div>
<!-- Main Container -->
            <main id="main-container">
                <!-- Page Header -->
                            <h1 class="page-heading">
                                GUIA DE ATENDIMENTO<br>
                            </h1>

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
                            </div>
                            

                            <br><br>
                            <h3 class="" style="color: #aaa">Guia de Atendimento</h3>
                             <div class="row">
                                <div class="col-md-3">
                                   <strong>Realizado por: </strong><?= $this->session->userdata('nome');?>
                                </div>
                             </div>
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
                            
                            
    </body>
</html>