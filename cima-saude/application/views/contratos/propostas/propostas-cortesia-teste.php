
    <form action="<?=base_url('c-contratos/proposta/verificar');?>" method="POST" id="propostaform" name="cortesiaform">             
        <input type="hidden" name="proposta-numero" value="<?=$dados['numero']?>">
        <input type="hidden" name="proposta-plano" value="<?=$dados['fk_plano']?>">
        <input type="hidden" name="proposta-cliente" value="<?=$dados['fk_cliente']?>">
        
    <?php if($indicacao == 0){ ?>
    <input type="hidden" name="indicacao" value="0">
    <?php } else { ?>
    <input type="hidden" name="indicacao" value="1">
    <input type="hidden" name="indicacao-nome" value="<?=$indicacao_nome?>">
    <input type="hidden" name="indicacao-celular" value="<?=$indicacao_celular?>">

    <?php }?>



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

    

    <input type="hidden" name="subtotal_proposta" value="0,00">
    <input class="form-control data" type="hidden"  name="pag-contratacao" value="<?=$contratacao_proposta;?>">
    <input type="hidden" name="pag-modo" value="6">
    <input type="hidden" name="pag-desconto" value="">
    <input type="hidden" name="pag-num" value="">
    <input type="hidden" name="melhor-dia" value="">
    <input type="hidden" name="plano-observacoes" value="">
    <input type="hidden" name="proposta-status" value="Finalizar">


    </form>


<?php $this->load->view('commons/footer');?>
<script language=javascript>
    $(document).ready(function(){
     $("#propostaform").submit();
});
</script>