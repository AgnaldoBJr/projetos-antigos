<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('funcoes');

//$this->load->view('commons/head');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Contratos</title>
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
<table>
     <thead>    
        <tr>
            <th>Número</th>
            <th>Cliente</th>
            <th>Data de Contratação</th>
            <th>Data de Vencimento</th>
            <th>Plano</th>
            <th>Status</th> 
        </tr>
    </thead>
    <tbody>
    <?php
        if($dataTable) foreach ($dataTable as $data){
    ?>
        <tr>
        <?php $s = json_encode($data);?>
        <td class="text-center"><?=$data['numero']?></td>
            <td class="font-w600"><?=$data['cliente_nome']?> </td>
            <td class="font-w600"><?=formata_data_br($data['dt_contratacao'])?> </td>
            <td class="font-w600"><?=formata_data_br($data['dt_vencimento'])?> </td>
            
            <td class="font-w600"><?=$data['plano_nome']?> </td>
            <?php if($data['status'] == 'C'){?>
                    <td><span class="label label-success">Em vigor</span></td>
                <?php }else if($data['status'] == 'D'){?>    
                    <td><span class="label label-danger">Cancelado</span></td>
                    <?php }else if($data['status'] == 'V'){?>    
                    <td><span class="label label-warning">Vencido</span></td>
            <?php }?>
            
        </tr>
    <?php } else { ?>
           <tr>
            <td colspan="6">Nenhum resultado encontrado</td>
           </tr>
    <?php }?>
    </tbody>
</table>
<br>

</body>
</html>


