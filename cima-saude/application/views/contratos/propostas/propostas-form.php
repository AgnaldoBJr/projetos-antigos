<div class="row">
    <div class="form-group col-md-4">
        <label class="control-label" for="proposta-numero">Nº da Proposta </label>
        <div class="">
            <input class="form-control" type="text" id="proposta-numero" name="proposta-numero" value="<?php echo $propostaNumero?>" readonly="readonly">
        </div>
    </div>
    <div class="form-group col-md-4">
        <label class="control-label" for="proposta-cliente">Cliente <span class="text-danger">*</span></label>
        <div>
            <select class="form-control" type="text" id="proposta-cliente" name="proposta-cliente" placeholder="Escolha uma opção...">
                <option>Escolha uma opção...</option>
                <?php
                    if($dataClientes) foreach ($dataClientes as $data){
                       
                ?>
                    <option value="<?=$data['cod_cliente']?>"><?=$data['nome']?></option>

                <?php } ?>
            </select>
        </div>
        
    </div>
    <!--<div class="form-group col-md-1" style="margin-top:28px; margin-left:-15px;">
        <button class="btn btn-sm btn-primary" type="button" data-toggle="modal" data-target="#novoCliente">Novo</button>
    </div>-->
    <div class="form-group col-md-4">
        <label class="control-label" for="proposta-plano">Plano <span class="text-danger">*</span></label>
        <div class="">
            <select class="form-control" type="text" id="proposta-plano" name="proposta-plano" placeholder="Escolha uma opção...">
                <option>Escolha uma opção...</option>
                <?php
                $s = json_encode($dataPlanos);
                    if($dataPlanos) foreach ($dataPlanos as $data){
                         
                ?>
                    <option value="<?=$data['cod_plano']?>"><?=$data['nome']?></option>
                <?php } ?>
            </select>
           
        </div>
    </div>
</div>
<script type="text/javascript">
   var s = <?=$s?>;
   var items = document.getElementById('proposta-plano');
    items.addEventListener('change', function(){
    //console.log("O indice é: " + items.selectedIndex);
    //console.log("O texto é: " + items.options[items.selectedIndex].text);
    //console.log("A chave é: " + items.options[items.selectedIndex].value);
    
    //console.log(s[0].nome);
    //console.log(s);

    for ( var i = 0; i < s.length; i++ ) {
        //document.write( i );
        if(items.options[items.selectedIndex].value == s[i].cod_plano){
            if(s[i].dependentes == 1){
                console.log("dependentes");
            }
            if(s[i].colaboradores == 1){
                console.log("colaboradores");
            }
            if(s[i].agregados == 1){
                console.log("agregados");
            }

        }
        
    } 

});
</script>
<!-- Novo Cliente Modal -->
        <div class="modal fade" id="novoCliente" tabindex="-1" role="dialog" aria-hidden="true">
            <div class="modal-dialog modal-dialog-top modal-lg">
                    <div class="modal-content">
                        <div class="block block-themed block-transparent remove-margin-b">
                            <div class="block-header bg-primary-dark">
                                <ul class="block-options">
                                    <li>
                                        <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                                    </li>
                                </ul>
                                
                                <h3 class="block-title">Novo Cliente</h3>
                            </div>
                            <div class="block-content" id="slim-scroll">
                                    <?php 
                                        $this->load->view('cadastros/clientes/clientes-form');
                                    ?>               
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button class="btn btn-sm btn-default" type="button" data-dismiss="modal">Cancelar</button>
                            <input type="submit" class="btn btn-sm btn-primary" value="Cadastrar">
                        </div>
                    </div>
                
            </div>
        </div>
        <!-- END Cliente Modal -->