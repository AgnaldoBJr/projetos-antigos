<div onload="Submeter()">
            <form action="<?=base_url('c-contratos/proposta/verificar');?>" method="POST" id="propostaform" name="cortesiaform"> 
                
                                        <input class="form-control" type="text" id="proposta-numero" name="proposta-numero" value="<?php if($this->input->post('proposta-numero') == null) echo $num_proposta; else echo $this->input->post('proposta-numero'); ?>" readonly="readonly">
                                    
                                    <input type="text" class="form-control" name="subtotal_proposta" value="0" readonly="readonly" id="subtotal">
                                
                
                   

<input type="hidden" name="proposta-numero" value="<?=$dados['numero']?>">
<input type="hidden" name="proposta-plano" value="<?=$dados['fk_plano']?>">
<input type="hidden" name="proposta-cliente" value="<?=$dados['fk_cliente']?>">

<?php foreach ($dep_nome as $data) {?>
        <input type="hidden" name="dep-nome[]" value="<?=$data?>">
<?php }?>
<?php foreach ($dep_data_nasc as $data) {?>
        <input type="hidden" name="dep-data-nasc[]" value="<?=$data?>">
<?php }?>
<?php foreach ($dep_parentesco as $data) {?>
        <input type="hidden" name="dep-parentesco[]" value="<?=$data?>">
<?php }?>

<?php foreach ($agr_nome as $data) {?>
        <input type="hidden" name="agr-nome[]" value="<?=$data?>">
<?php }?>
<?php foreach ($agr_data_nasc as $data) {?>
        <input type="hidden" name="agr-data-nasc[]" value="<?=$data?>">
<?php }?>
<?php foreach ($agr_parentesco as $data) {?>
        <input type="hidden" name="agr-parentesco[]" value="<?=$data?>">
<?php }?>

<?php foreach ($colab_nome as $data) {?>
        <input type="hidden" name="colab-nome[]" value="<?=$data?>">
<?php }?>
<?php foreach ($colab_data_nasc as $data) {?>
        <input type="hidden" name="colab-data-nasc[]" value="<?=$data?>">
<?php }?>




                
                                    
                               
            </form>
</div>
            <script language=javascript>
                function Submeter()
                {
                    document.forms.cortesiaform.submit(); 
                }
            </script>