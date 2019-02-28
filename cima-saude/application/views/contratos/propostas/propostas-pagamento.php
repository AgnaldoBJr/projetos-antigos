<?php 
    //echo $this->input->post('dep-nome["0"]'); die;

    $this->load->view('commons/header');

    
?>
<!-- Main Container -->
            <main id="main-container">
                <!-- Page Header -->
                <div class="content bg-gray-lighter">
                    <div class="row items-push">
                        <div class="col-sm-7">
                            <h1 class="page-heading">
                                Nova proposta <small>(Pagamento)</small>
                            </h1>
                        </div>
                    </div>
                </div>
                <!-- END Page Header -->
                <?php if($this->session->flashdata('msg')): ?>
                    <!--<div class="alert alert-success" role="alert"><p></p></div>

                    <div class="alert alert-success" id="success-alert">
                        <button type="button" class="close" data-dismiss="alert">x</button>
                        <strong>Success! </strong>
                        Product have added to your wishlist.
                    </div>
                    -->
                    <div class="col-xs-11 col-sm-4 alert alert-success animated fadeIn" id="success-alert" role="alert" style=" margin: 0px auto; position: fixed;  z-index: 1033; top: 20px; right: 20px">
                        <button type="button" class="close" style="font-size: 14px" data-dismiss="alert">x</button>
                        <strong>Sucesso! </strong>
                        <?php echo $this->session->flashdata('msg'); ?>
                    </div>
                <?php endif; ?>

            <form action="<?=base_url('c-contratos/proposta/verificar');?>" method="POST" id="propostaform"> 
                <!-- Page Content -->
                <div class="content">
                    <div class="block">
                        <div class="block-content">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label class="control-label" for="proposta-numero">Nº da Proposta </label>
                                    <div class="">
                                        <input class="form-control" type="text" id="proposta-numero" name="proposta-numero" value="<?php if($this->input->post('proposta-numero') == null) echo $num_proposta; else echo $this->input->post('proposta-numero'); ?>" readonly="readonly">
                                    </div>
                                </div>
                                <div class="col-md-5"></div>
                                <div class="form-group col-md-3">
                                    <label class="control-label" for="proposta-numero">Total: (R$) </label>
                                    <input type="text" class="form-control" name="subtotal_proposta" value="<?=$subtotal_proposta?>" readonly="readonly" id="subtotal">
                                </div>
                                <div id="subtotal-fixo" style="display: none"><?=$subtotal_proposta?>
                                </div>
                            </div>
                                
                       </div>
                    </div>
                </div>
                
                   
<?php

//Formulário de Dados do contrato
//Input hidden

?>
<?php if($indicacao == 0){ ?>
    <input type="hidden" name="indicacao" value="0">
<?php } else { ?>
    <input type="hidden" name="indicacao" value="1">
    <input type="hidden" name="indicacao-nome" value="<?=$indicacao_nome?>">
    <input type="hidden" name="indicacao-celular" value="<?=$indicacao_celular?>">

<?php }?>


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




                <div class="content" style="margin-top: -50px;">
                    <div class="block">
                        <div class="block-content">
                            <div class="row">    
                                <div class="form-group col-md-3">
                                    <label class="control-label" for="pag-contratacao">Data da Proposta <span class="text-danger">*</span></label>
                                    <div class="">
                                        <input class="form-control data" type="text" id="pag-contratacao" name="pag-contratacao" placeholder="Ex.: dd/mm/aaaa" value="<?php if ($this->input->post('pag-contratacao') != null) echo $this->input->post('pag-contratacao'); else echo $contratacao_proposta;?>">
                                    </div>
                                    <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('pag-contratacao')?></div>
                                </div>
                                    
                                <div class="form-group col-md-3">
                                    <label class="control-label" for="pag-modo">Modo de Pagamento <span class="text-danger">*</span></label>
                                    <div class="">
                                        <select class="form-control" type="text" id="pag-modo" name="pag-modo" placeholder="Escolha uma opção...">
                                            <option value=<?php null;?>>Escolha uma opção...</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                            <option value="1" <?php if("1" == $this->input->post('pag-modo')) echo "selected";?>>Dinheiro</option>
                                            <option value="2" <?php if("2" == $this->input->post('pag-modo')) echo "selected";?>>Cartão - Débito</option>
                                            <option value="3" <?php if("3" == $this->input->post('pag-modo')) echo "selected";?>>Cheque</option>
                                            <option value="4" <?php if("4" == $this->input->post('pag-modo')) echo "selected";?>>Boleto</option>
                                            <option value="5" <?php if("5" == $this->input->post('pag-modo')) echo "selected";?>>Cartão - Crédito</option>
                                        </select>
                                         <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('pag-modo')?></div>
                                    </div>
                                </div>
                               
                                <div id="desc-div" style="display: none">
                                    <div class="form-group col-md-3" >
                                        <label class="control-label" for="pag-desconto">Desconto(%)</label>
                                        <div class="">
                                            <input class="form-control" type="text" id="pag-desconto" name="pag-desconto" placeholder="Número de 1 a 10" value="<?= $this->input->post('pag-desconto');?>" onkeypress='return SomenteNumero(event)' onkeyup="descont()">
                                        </div>
                                        <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('pag-desconto')?></div>
                                    </div>
                                </div>
                                <div  id="parcelas">
                                    <div class="form-group col-md-3" id="parcelas_num" style="display: none">
                                        <label class=" control-label" for="pag-numero">Parcelas<span class="text-danger">*</span></label>
                                         <select class="form-control" type="text"  id="pag-num" name="pag-num" placeholder="Escolha uma opção...">
                                            <option value=<?php null;?>>Escolha uma opção...</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                            <option value="1" <?php if("1" == $this->input->post('pag-num')) echo "selected";?>>1 parcelas</option>
                                            <option value="2" <?php if("2" == $this->input->post('pag-num')) echo "selected";?>>2 parcelas</option>
                                            <option value="3" <?php if("3" == $this->input->post('pag-num')) echo "selected";?>>3 parcelas</option>
                                            <option value="4" <?php if("4" == $this->input->post('pag-num')) echo "selected";?>>4 parcelas</option>
                                            <option value="5" <?php if("5" == $this->input->post('pag-num')) echo "selected";?>>5 parcelas</option>
                                             <option value="6" <?php if("6" == $this->input->post('pag-num')) echo "selected";?>>6 parcelas</option>
                                            <option value="7" <?php if("7" == $this->input->post('pag-num')) echo "selected";?>>7 parcelas</option>
                                            <option value="8" <?php if("8" == $this->input->post('pag-num')) echo "selected";?>>8 parcelas</option>
                                            <option value="9" <?php if("9" == $this->input->post('pag-num')) echo "selected";?>>9 parcelas</option>
                                            <option value="10" <?php if("10" == $this->input->post('pag-num')) echo "selected";?>>10 parcelas</option>
                                            <option value="11" <?php if("11" == $this->input->post('pag-num')) echo "selected";?>>11 parcelas</option>
                                            <option value="12" <?php if("12" == $this->input->post('pag-num')) echo "selected";?>>12 parcelas</option>
                                        </select>
                                        <div class="help-block text-right animated fadeInDown" id="val-parcelas" style="color:#666"></div>
                                    </div>
                                    <div class="form-group col-md-3" id="select-venc" style="display: none">
                                        <label class="control-label" for="pag-modo">Dia para vencimento <span class="text-danger">*</span></label>
                                        <select class="form-control" type="text"  name="melhor-dia" id="melhor-dia" placeholder="Escolha uma opção...">
                                            <option value=<?php null;?>>Escolha uma opção...</option><!-- Required for data-placeholder attribute to work with Select2 plugin -->
                                            <option value="5" <?php if("1" == $this->input->post('melhor-dia')) echo "selected";?>>Dia 5</option>
                                            <option value="10" <?php if("10" == $this->input->post('melhor-dia')) echo "selected";?>>Dia 10</option>
                                            <option value="15" <?php if("15" == $this->input->post('melhor-dia')) echo "selected";?>>Dia 15</option>
                                            <option value="20" <?php if("20" == $this->input->post('melhor-dia')) echo "selected";?>>Dia 20</option>
                                            <option value="25" <?php if("25" == $this->input->post('melhor-dia')) echo "selected";?>>Dia 25</option>
                                            <option value="30" <?php if("30" == $this->input->post('melhor-dia')) echo "selected";?>>Dia 30</option>
                                        </select>
                                     </div>
                                </div>
                            </div>  
                            <div class="row">
                                <div class="form-group col-md-12">
                                    <label for="plano-observacoes">Observações</label>
                                    <div>
                                        <textarea class="form-control" id="plano-observacoes" name="plano-observacoes" rows="2" placeholder="Insira alguma descrição para o plano"><?= $this->input->post('plano-observacoes');?></textarea>
                                    </div>
                                    <div class="help-block text-right animated fadeInDown" style="color: #d26a5c"><?=form_error('plano-observacoes')?></div>
                                </div>
                           </div>
                        </div>
                    </div>
                
                    <div class="block">
                        <div class="block-content">
                            <div class="row">
                                <div class="form-group">
                                    <input type="submit" name="proposta-status" class="btn btn-sm btn-primary" style="float: right; margin-right: 20px; margin-bottom: 20px; " name="proximo" value="Finalizar">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>


<script type="text/javascript">
    var subtotal = document.getElementById('subtotal-fixo').innerHTML.replace(',','');
    var subtotalString =  document.getElementById('subtotal-fixo').innerHTML;
    
    var items = document.getElementById('pag-modo');
    items.addEventListener('change', function(){
        //console.log("O indice é: " + items.selectedIndex);
        //console.log("O texto é: " + items.options[items.selectedIndex].text);
        //console.log("A chave é: " + items.options[items.selectedIndex].value);
        
        //console.log(s[0].nome);
        //console.log(s);

        document.getElementById("parcelas_num").style.display = 'none';
        document.getElementById("select-venc").style.display = 'none';
        document.getElementById("desc-div").style.display = 'none';
        document.getElementById('subtotal').value = subtotalString;
        document.getElementById('pag-num').selectedIndex = "0";
        document.getElementById('melhor-dia').selectedIndex = "0";
        document.getElementById("val-parcelas").innerHTML = '';
         document.getElementById("pag-desconto").value = '';


        if(items.options[items.selectedIndex].value == "5"){
            document.getElementById("parcelas_num").style.display = 'block';
            document.getElementById("select-venc").style.display = 'none';
            document.getElementById("desc-div").style.display = 'none';
            
        } else if(items.options[items.selectedIndex].value == "4"){
            document.getElementById("parcelas_num").style.display = 'block';
            document.getElementById("select-venc").style.display = 'block';
            document.getElementById("desc-div").style.display = 'none';
            
        } else if(items.options[items.selectedIndex].value == "1"){
            document.getElementById("parcelas_num").style.display = 'none';
            document.getElementById("select-venc").style.display = 'none';
            document.getElementById("desc-div").style.display = 'block';
            
        } else if(items.options[items.selectedIndex].value == "3"){
            document.getElementById("parcelas_num").style.display = 'block';
            document.getElementById("select-venc").style.display = 'none';
            document.getElementById("desc-div").style.display = 'none';
            
        }
    });


    console.log(document.getElementById('subtotal-fixo').innerHTML.replace(',',''), document.getElementById('subtotal').value.replace(',','').length);

    var parcelas = document.getElementById('pag-num');
    parcelas.addEventListener('change', function(){
       
        var sub = 0;

         if(parcelas.options[parcelas.selectedIndex].value == "1"){
            sub = subtotal * 1;
            document.getElementById("val-parcelas").innerHTML = '';
        }

        else if(parcelas.options[parcelas.selectedIndex].value == "2"){
            sub = subtotal * 1;
            parcela = sub/2;
            parcela = parcela.toFixed();
            str3 = parcela.toString().substring(0, parcela.toString().length -2);
            str4 = parcela.toString().substring(parcela.toString().length -2);
            str5 = str3 + "," + str4;
            document.getElementById("val-parcelas").innerHTML = '2 x R$ ' +  str5; 
        }

        else if(parcelas.options[parcelas.selectedIndex].value == "3"){
            sub = subtotal * 1.05;
            parcela = sub/3;
            parcela = parcela.toFixed();
            str3 = parcela.toString().substring(0, parcela.toString().length -2);
            str4 = parcela.toString().substring(parcela.toString().length -2);
            str5 = str3 + "," + str4;
            document.getElementById("val-parcelas").innerHTML = '3 x R$ ' +  str5;

        }
        else if(parcelas.options[parcelas.selectedIndex].value == "4"){
            sub = subtotal * 1.05;
            parcela = sub/4;
            parcela = parcela.toFixed();
            str3 = parcela.toString().substring(0, parcela.toString().length -2);
            str4 = parcela.toString().substring(parcela.toString().length -2);
            str5 = str3 + "," + str4;
            document.getElementById("val-parcelas").innerHTML = '4 x R$ ' +  str5;
        }
        else if(parcelas.options[parcelas.selectedIndex].value == "5"){
            sub = subtotal * 1.06;
             parcela = sub/5;
            parcela = parcela.toFixed();
            str3 = parcela.toString().substring(0, parcela.toString().length -2);
            str4 = parcela.toString().substring(parcela.toString().length -2);
            str5 = str3 + "," + str4;
            document.getElementById("val-parcelas").innerHTML = '5 x R$ ' +  str5;
        }
        else if(parcelas.options[parcelas.selectedIndex].value == "6"){
            sub = subtotal * 1.08;
             parcela = sub/6;
            parcela = parcela.toFixed();
            str3 = parcela.toString().substring(0, parcela.toString().length -2);
            str4 = parcela.toString().substring(parcela.toString().length -2);
            str5 = str3 + "," + str4;
            document.getElementById("val-parcelas").innerHTML = '6 x R$ ' +  str5;
        }
        else if(parcelas.options[parcelas.selectedIndex].value == "7"){
            sub = subtotal * 1.1;
             parcela = sub/7;
            parcela = parcela.toFixed();
            str3 = parcela.toString().substring(0, parcela.toString().length -2);
            str4 = parcela.toString().substring(parcela.toString().length -2);
            str5 = str3 + "," + str4;
            document.getElementById("val-parcelas").innerHTML = '7 x R$ ' +  str5;
        }
        else if(parcelas.options[parcelas.selectedIndex].value == "8"){
            sub = subtotal * 1.12;
             parcela = sub/8;
            parcela = parcela.toFixed();
            str3 = parcela.toString().substring(0, parcela.toString().length -2);
            str4 = parcela.toString().substring(parcela.toString().length -2);
            str5 = str3 + "," + str4;
            document.getElementById("val-parcelas").innerHTML = '8 x R$ ' +  str5;
        }
        else if(parcelas.options[parcelas.selectedIndex].value == "9"){
            sub = subtotal * 1.14;
             parcela = sub/9;
            parcela = parcela.toFixed();
            str3 = parcela.toString().substring(0, parcela.toString().length -2);
            str4 = parcela.toString().substring(parcela.toString().length -2);
            str5 = str3 + "," + str4;
            document.getElementById("val-parcelas").innerHTML = '9 x R$ ' +  str5;
        }
        else if(parcelas.options[parcelas.selectedIndex].value == "10"){
            sub = subtotal * 1.16;
             parcela = sub/10;
            parcela = parcela.toFixed();
            str3 = parcela.toString().substring(0, parcela.toString().length -2);
            str4 = parcela.toString().substring(parcela.toString().length -2);
            str5 = str3 + "," + str4;
            document.getElementById("val-parcelas").innerHTML = '10 x R$ ' +  str5;
        }
        else if(parcelas.options[parcelas.selectedIndex].value == "11"){
            sub = subtotal * 1.18;
             parcela = sub/11;
            parcela = parcela.toFixed();
            str3 = parcela.toString().substring(0, parcela.toString().length -2);
            str4 = parcela.toString().substring(parcela.toString().length -2);
            str5 = str3 + "," + str4;
            document.getElementById("val-parcelas").innerHTML = '11 x R$ ' +  str5;
        }
        else if(parcelas.options[parcelas.selectedIndex].value == "12"){
            sub = subtotal * 1.2;
            parcela = sub/12;
            parcela = parcela.toFixed();
            str3 = parcela.toString().substring(0, parcela.toString().length -2);
            str4 = parcela.toString().substring(parcela.toString().length -2);
            str5 = str3 + "," + str4;
            document.getElementById("val-parcelas").innerHTML = '12 x R$ ' +  str5;
        }
        else{
            sub = subtotal * 1;
            document.getElementById("val-parcelas").innerHTML = '';
        }
        console.log(sub.toFixed());
        sub = sub.toFixed();
        str1 = sub.toString().substring(0, sub.toString().length -2);
        str2 = sub.toString().substring(sub.toString().length -2);
        document.getElementById('subtotal').value = str1 + ',' + str2;
    });

    function descont(){
        var desconto = (document.getElementById('pag-desconto').value);
        if(desconto >= 0 && desconto <= 10){
            sub = subtotal * (1 - (desconto/100));
            sub = sub.toFixed();
            str1 = sub.toString().substring(0, sub.toString().length -2);
            str2 = sub.toString().substring(sub.toString().length -2);
            document.getElementById('subtotal').value = str1 + ',' + str2;  
        } else {
            document.getElementById('subtotal').value = subtotalString;  
        }
    }
        
      

    
</script>
<?php $this->load->view('commons/footer');?>

<script type="text/javascript">
//linha para usar a biblioteca Jquery
    $().ready(function() {
        //utiliza o formulário escolhido por ID
    
        $('#propostaform').validate({
            // FAZ A VALIDAÇÃO EM TEMPO REAL"
                 onkeyup: function(element) {
                    this.element(element);
                },
        

            //objeto com duas propriedades rules e messages
            rules: {
                'pag-contratacao' : {
                    required : true,
                    dateBR : true },
            
                'pag-vencimento': {
                    required : true,
                    dateBR : true },
            
                'pag-desconto' :  {
                    range: [1, 10]
                },

                "pag-modo" : {
                    required : true
                },
                
                "pag-num" : {
                    required : true
                },

                "melhor-dia" : {
                    required : true
                },

                'pag-numero': {
                    required : true
                },
                'pag-parcelas' :  {
                    required : true
                },
            },

            messages: {
                'pag-contratacao' : {
                    required : "O campo deve ser preenchido",
                    dateBR : "Data inválida" },
            
                'pag-vencimento': {
                   required : "O campo deve ser preenchido",
                    dateBR : "Data inválida" },
            
                'pag-desconto' :  {
                    range: "Digite um número entre 1 e 10"
                },

                "pag-modo" : {
                   required : "O campo deve ser preenchido"
                },

                "pag-num" : {
                   required : "Escolha uma opção"
                },

                "melhor-dia" : {
                   required : "Escolha uma opção"
                },

                'pag-numero': {
                    required : "O campo deve ser preenchido"
                },
                'pag-parcelas' :  {
                    required : "O campo deve ser preenchido"
                },
            }

        });
    });

    /*
 * Brazillian CPF number (Cadastrado de Pessoas Físicas) is the equivalent of a Brazilian tax registration number.
 * CPF numbers have 11 digits in total: 9 numbers followed by 2 check numbers that are being used for validation.
 */
$.validator.addMethod("cpfBR", function(value) {
  if(value == "") return true;
  // Removing special characters from value
  value = value.replace(/([~!@#$%^&*()_+=`{}\[\]\-|\\:;'<>,.\/? ])+/g, "");

  // Checking value to have 11 digits only
  if (value.length !== 11) {
    return false;
  }

  var sum = 0,
    firstCN, secondCN, checkResult, i;

  firstCN = parseInt(value.substring(9, 10), 10);
  secondCN = parseInt(value.substring(10, 11), 10);

  checkResult = function(sum, cn) {
    var result = (sum * 10) % 11;
    if ((result === 10) || (result === 11)) {result = 0;}
    return (result === cn);
  };

  // Checking for dump data
  if (value === "" ||
    value === "00000000000" ||
    value === "11111111111" ||
    value === "22222222222" ||
    value === "33333333333" ||
    value === "44444444444" ||
    value === "55555555555" ||
    value === "66666666666" ||
    value === "77777777777" ||
    value === "88888888888" ||
    value === "99999999999"
  ) {
    return false;
  }

  // Step 1 - using first Check Number:
  for ( i = 1; i <= 9; i++ ) {
    sum = sum + parseInt(value.substring(i - 1, i), 10) * (11 - i);
  }

  // If first Check Number (CN) is valid, move to Step 2 - using second Check Number:
  if ( checkResult(sum, firstCN) ) {
    sum = 0;
    for ( i = 1; i <= 10; i++ ) {
      sum = sum + parseInt(value.substring(i - 1, i), 10) * (12 - i);
    }
    return checkResult(sum, secondCN);
  }
  return false;

}, "Informe um cpf válido, campo obrigatório");


/*
* Este método pode ser adicionado dentro do $('ducument').ready();
*/
$.validator.addMethod("dateBR", function(value, element) {
            if(value == "") return true;

            if(value.length!=10) return false;
            // verificando data
            var data       = value;
            var dia         = data.substr(0,2);
            var barra1   = data.substr(2,1);
            var mes        = data.substr(3,2);
            var barra2   = data.substr(5,1);
            var ano         = data.substr(6,4);
            if(data.length!=10||barra1!="/"||barra2!="/"||isNaN(dia)||isNaN(mes)||isNaN(ano)||dia>31||mes>12)return false;
            if((mes==4||mes==6||mes==9||mes==11) && dia==31)return false;
            if(mes==2  &&  (dia>29||(dia==29 && ano%4!=0)))return false;
            if(ano < 1900)return false;
            return true;
        }, "Informe uma data válida");  // Mensagem padrão


</script>

