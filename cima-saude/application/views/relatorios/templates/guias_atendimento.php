<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('funcoes');

//$this->load->view('commons/head');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Guias de Atendimento</title>
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
<br>

</body>
</html>


