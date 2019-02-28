<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('funcoes');

//$this->load->view('commons/head');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Pós Atendimento - Guias de Atendimento</title>
    <style type="text/css">
        h1 {
            text-align: center;
        }
        
        h3 {
            font-family: sans-serif;
            font-size: 14px;
            text-align: center;
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

<br>
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
<br>

</body>
</html>


