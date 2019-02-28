
<!-- Main Container -->
            <main id="main-container">
         	    <!-- Page Header -->
                <div class="content bg-gray-lighter">
                    <div class="row items-push">
                        <div class="col-sm-7">
                            <h1 class="page-heading">
                                Atualizar Guia de Atendimento<br>
                            </h1>
                        </div>
                    </div>
                </div>
                <!-- END Page Header -->

         	    <!-- Page Content -->
                <div class="content">
                    <!-- Dynamic Table Full -->
                    <form action="<?=base_url('atendimento/atendimentos/alterar');?>" method="POST" id="guias">
                        <input type="hidden" name="cod_guia" value="<?=$dataGuia['cod_guia']?>">
                        <div class="block">
                            <div class="block-content">
                            
                            <!--Proposta form-->
                                <div class="row">
                                    
                                    <div class="form-group col-md-4">
                                        <label class="control-label" for="beneficiario">Beneficiário <span class="text-danger">*</span></label>
                                        <div>
                                            <select class="form-control" type="text" id="beneficiario" name="beneficiario" placeholder="Escolha uma opção...">
                                                <option value=<?php null;?>>Escolha uma opção...</option>
                                                <?php
                                                    if($dataPacientes) foreach ($dataPacientes as $data){
                                                       
                                                ?>
                                                    <option value="<?php echo $data['cod'] . '-' . $data['tab']?>" <?php if($dataBeneficiario['chave'] == ($data['cod'] . '-' . $data['tab'])) echo 'selected'?>><?=$data['nome']?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                        
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="dt_abertura">Data de abertura <span class="text-danger">*</span></label>
                                        <div class="">
                                            <input class="form-control data" type="text" id="dt_abertura" name="dt_abertura" placeholder="Ex.: dd/mm/aaaa" value="<?= formata_data_br($dataGuia['dt_abertura']);?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-3">
                                        <label class="control-label" for="dt_realizacao">Data de realização</label>
                                        <div class="">
                                            <input class="form-control data" type="text" id="dt_realizacao" name="dt_realizacao" placeholder="Ex.: dd/mm/aaaa" value="<?= formata_data_br($dataGuia['dt_realizacao']);?>">
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2">
                                        <label class="control-label" for="horario">Horário</label>
                                        <div class="">
                                            <input class="form-control horario" type="text" id="horario" name="horario" placeholder="Ex.: hh:mm" value="<?= $dataGuia['horario'];?>?>">
                                        </div>
                                    </div>
                                    
                                </div>
                                <input type="hidden" id="parceiro" name="parceiro" value="<?=$this->session->userdata('id')?>">
                                <div class="row">
                                   
                                    <div class="form-group col-md-4">
                                        <label class="control-label" for="pagamento">Tipo</label>
                                        <div>
                                              <select class="form-control" type="text" id="pagamento" name="pagamento" placeholder="Escolha uma opção...">
                                                <option value="c" <?php if($dataGuia['valor_tipo'] == 'CIMA') echo 'selected'?>>Valor Cima</option>
                                                <option value="r" <?php if($dataGuia['valor_tipo'] == 'Recibo') echo 'selected'?>>Valor com recibo</option>
                                            </select>
                                        </div>
                                  
                                    </div>
                               
                            </div>
                        </div><!--Fim de Proposta-form-->

                        <div class="block">
                            <div class="block-content">
                         <div class="block-header" style="margin-left: -20px; color:#bbb">
                                <h3 class="block-title">Lista de serviços</h3>
                            </div>
                        <div class="row">
                            <!-- DataTables init on table by adding .js-dataTable-full class, functionality initialized in js/pages/base_tables_datatables.js -->
                            <div class="col-lg-12 "><!--col-lg-offset-1-->
                                <table class="table table-bordered table-striped js-dataTable-full" >
                                    <thead>
                                        <tr>
                                            <th class="text-center"></th>
                                            <th class="text-center" style="width: 55%">Nome</th>
                                            <th>Valor (R$)</th>
                                            <th>Valor Cima (R$)</th>
                                            <th>Valor Recibo (R$)</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody id='lista_servicos'>
                                    <?php
                                       
                                        if($dataServicosTodos) foreach ($dataServicosTodos as $data){?>
                                        <tr>
                                            <td>
                                                <input type="checkbox" name="<?php echo 'servico-' . $data['cod_servico']?>" 
                                                <?php if($dataServicos) foreach ($dataServicos as $dataS){ if($data['cod_servico'] == $dataS['cod_servico']) echo 'checked';} ?>>
                                            </td>
                                            <td class="text-center"><?php if($data['fk_exame']== '1') echo $data['nom']; else echo $data['nome']?></td>
                                            <td class="font-w600"><?=formata_preco($data['valor_parceiro'])?> </td>
                                            <td class="font-w600"><?=formata_preco($data['valor_cima'])?> </td>
                                            <td class="font-w600"><?=formata_preco($data['valor_recibo'])?> </td>
                                         </tr>
                                        
                                    </tbody>

                                    <?php  } ?>
                                </table>
                            </div>
                        </div>

                        <ul id="list_item"></div>
                        </div></div>

                        <div class="block">
                            <div class="block-content">
                                <div class="row">
                                    <div class="form-group">

                                        <input type="submit" name="proposta-status" class="btn btn-sm btn-primary" style="float: right; margin-right: 20px; margin-bottom: 20px; " name="proximo" value="Alterar"></input>

                                    
                                    

                                    </div>
                                </div>
                            
                            </div>
                        </div>
                    </form>
                </div>
<?php $this->load->view('commons/footer');?>