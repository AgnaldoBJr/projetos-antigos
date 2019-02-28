<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('funcoes');

//$this->load->view('commons/head');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Relatório Diário CIMA Saúde</title>
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
<h3>RELATÓRIO DIÁRIO CIMA SAÚDE</h3>
<h5 style="text-align: center"><?php echo date('d/m/Y');?></h5>
<br>

<table>
        <tr>
            <td colspan="2"><h5>DADOS GERAIS</h5></td>
        </tr>    
        <tr>
            <td><b>Pessoas Cadastradas:</b> <?=$pessoas?></td>
            <td><b>Propostas Salvas: </b><?=$propostas?></td>
            
        </tr>
        <tr>
           <td><b>Contratos Fechados: </b> <?=$contratos?></td>
           <td><b>Saldo do dia (movimentações financeiras): </b> <?=formata_preco($movimentacoes)?></td>
        </tr>
        
</table>
<br><br>
              
    <table class="table table-bordered table-striped" >
        <thead> 
            <tr>
            <td colspan="4"> <h5>CONTRATOS FECHADOS</h5><br></td>
            </tr> 
            <tr>
                <th>Número</th>
                <th>Nome</th>
                <th>Plano</th>
                <th>Valor total(R$)</th>
            </tr>
        </thead>
        <tbody>
        <?php
                if($contratos_lista) foreach ($contratos_lista as $data){
            ?>
            <tr>
                <td class="font-w600"><?=$data['numero']?> </td>
                <td class="font-w600"><?=$data['cliente_nome']?> </td>
                <td class="font-w600"><?=$data['plano_nome']?> </td>   
                <td class="font-w600"><?=formata_preco($data['pag_total'])?> </td>
            </tr>
        <?php } else {?>
            <tr>
                <td colspan="3" class="font-w600">Nenhum </td>
            </tr>
         <?php } ?>
        </tbody>
    </table>


<br><br>
                     
    <table class="table table-bordered table-striped" >
        <thead> 
            <tr>
            <td colspan="4"> <h5>CONTAS PAGAS HOJE</h5><br></td>
            </tr> 
            <tr>
                <th>Descrição</th>
                <th>Fornecedor</th>
                <th>Data de Vencimento</th>
                <th>Valor(R$)</th>
            </tr>
        </thead>
        <tbody>
        <?php
                if($c_pagar_hoje) { foreach ($c_pagar_hoje as $data){
            ?>
            <tr>
                <td class="font-w600"><?=$data['descricao']?> </td>
                <td class="font-w600"><?=$data['fornecedor_nome']?> </td>
                <td class="font-w600"><?=formata_data_br($data['dt_pagamento'])?> </td>
                <td class="font-w600"><?=formata_preco($data['valor'])?> </td>
            </tr>
        <?php } ?>
            <tr>
                <td colspan="2"></td>
                <td><b>Total:</b></td>
                <td><?=formata_preco($c_pagar_hoje_total)?> </td>
            </tr>

        <?php }else {?>
            <tr>
                <td colspan="4" class="font-w600">Nenhum </td>
            </tr>
         <?php } ?>
        </tbody>
    </table>
<br><br>
    <table class="table table-bordered table-striped" >
        <thead> 
            <tr>
            <td colspan="4"> <h5>CONTAS RECEBIDAS HOJE</h5><br></td>
            </tr> 
            <tr>
                <th>Descrição</th>
                <th>Cliente</th>
                <th>Data de Vencimento</th>
                <th>Valor(R$)</th>
            </tr>
        </thead>
        <tbody>
        <?php
                if($c_receber_hoje) { foreach ($c_receber_hoje as $data){
            ?>
            <tr>
                <td class="font-w600"><?=$data['descricao']?> </td>
                <td class="font-w600"><?=$data['cliente_nome']?> </td>
                <td class="font-w600"><?=formata_data_br($data['dt_recebimento'])?> </td>
                <td class="font-w600"><?=formata_preco($data['valor'])?> </td>
            </tr>
        <?php } ?>
            <tr>
                <td colspan="2"></td>
                <td><b>Total:</b></td>
                <td><?=formata_preco($c_receber_hoje_total)?> </td>
            </tr>

        <?php }else {?>
            <tr>
                <td colspan="4" class="font-w600">Nenhum </td>
            </tr>
         <?php } ?>
        </tbody>
    </table>
<br><br>
    <table class="table table-bordered table-striped" >
        <thead> 
            <tr>
            <td colspan="4"> <h5>CONTAS A PAGAR GERADAS</h5><br></td>
            </tr> 
            <tr>
                <th>Descrição</th>
                <th>Fornecedor</th>
                <th>Data de Vencimento</th>
                <th>Valor(R$)</th>
            </tr>
        </thead>
        <tbody>
        <?php
                if($c_pagar_cad) { foreach ($c_pagar_cad as $data){
            ?>
            <tr>
                <td class="font-w600"><?=$data['descricao']?> </td>
                <td class="font-w600"><?=$data['fornecedor_nome']?> </td>
                <td class="font-w600"><?=formata_data_br($data['dt_pagamento'])?> </td>
                <td class="font-w600"><?=formata_preco($data['valor'])?> </td>
            </tr>
        <?php } ?>
            <tr>
                <td colspan="2"></td>
                <td><b>Total:</b></td>
                <td><?=formata_preco($c_pagar_cad_total)?> </td>
            </tr>

        <?php }else {?>
            <tr>
                <td colspan="4" class="font-w600">Nenhum </td>
            </tr>
         <?php } ?>
        </tbody>
    </table>
<br><br>
    <table class="table table-bordered table-striped" >
        <thead> 
            <tr>
            <td colspan="4"> <h5>CONTAS A RECEBER GERADAS</h5><br></td>
            </tr> 
            <tr>
                <th>Descrição</th>
                <th>Cliente</th>
                <th>Data de Vencimento</th>
                <th>Valor(R$)</th>
            </tr>
        </thead>
        <tbody>
        <?php
                if($c_receber_cad) { foreach ($c_receber_cad as $data){
            ?>
            <tr>
                <td class="font-w600"><?=$data['descricao']?> </td>
                <td class="font-w600"><?=$data['cliente_nome']?> </td>
                <td class="font-w600"><?=formata_data_br($data['dt_recebimento'])?> </td>
                <td class="font-w600"><?=formata_preco($data['valor'])?> </td>
            </tr>
        <?php } ?>
            <tr>
                <td colspan="2"></td>
                <td><b>Total:</b></td>
                <td><?=formata_preco($c_receber_cad_total)?> </td>
            </tr>

        <?php }else {?>
            <tr>
                <td colspan="4" class="font-w600">Nenhum </td>
            </tr>
         <?php } ?>
        </tbody>
    </table>




</body>
</html>


