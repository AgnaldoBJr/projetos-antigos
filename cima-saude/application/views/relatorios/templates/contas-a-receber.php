<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('funcoes');

//$this->load->view('commons/head');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Contas a Receber</title>
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
<br>

</body>
</html>


