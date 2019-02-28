<?php 
    //var_dump($dependentes); die;
    //echo $dependentes['dep_nome'][1]; die;

    $this->load->view('commons/header');

?>
<!-- Main Container -->
            <main id="main-container">
                <!-- Page Header -->
                <div class="content bg-gray-lighter">
                    <div class="row items-push">
                        <div class="col-sm-7">
                            <h1 class="page-heading">
                                Atualizar proposta <small>(Confirmar dados)</small>
                            </h1>
                        </div>
                    </div>
                </div>
                <!-- END Page Header -->
                <?php if($this->session->flashdata('msg')): ?>
                    <div class="col-xs-11 col-sm-4 alert alert-success animated fadeIn" id="success-alert" role="alert" style=" margin: 0px auto; position: fixed;  z-index: 1033; top: 20px; right: 20px">
                        <button type="button" class="close" style="font-size: 14px" data-dismiss="alert">x</button>
                        <strong>Sucesso! </strong>
                        <?php echo $this->session->flashdata('msg'); ?>
                    </div>
                <?php endif; ?>

                <!-- Page Content -->
                <div class="content">
                    <div class="block">
                        <div class="block-content">
                            <h3 class="block-title" style="color: #aaa">Dados Gerais</h3>
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Número da proposta: </strong><?= $numero_proposta;?><br>
                                </div>
                                 <div class="col-md-4">
                                    <strong>Data de Contratação: </strong><?= $datas['contratacao'];?><br>
                                </div>
                            </div>
                            <br><br>


                            <h3 class="block-title" style="color: #aaa">Dados do Cliente</h3>
                            <div class="row">
                                <div class="col-md-3">
                                   <strong>Nome: </strong><?= $cliente['nome'];?>
                                </div>
                                <div class="col-md-3">
                                   <strong>CPF: </strong><?= $cliente['cpf'];?>
                                </div>
                                <div class="col-md-3">
                                    <strong>RG: </strong><?= $cliente['rg'];?>
                                </div>
                                <div class="col-md-3">
                                   <strong>Dt Nasc.: </strong><?= $cliente['data_nasc'];?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-5">
                                   <strong>Endereço: </strong><?= $cliente['logradouro'];?>, <?= $cliente['numero'];?> - <?= $cliente['bairro'];?>
                                </div>
                                <div class="col-md-3">
                                   <strong>CEP: </strong><?= $cliente['cep'];?>
                                </div>
                                <div class="col-md-4">
                                    <strong>Cidade/Estado: </strong><?= $cliente['cidade'];?>/<?= $cliente['estado'];?>
                                </div>
                            </div>
                            <br><br>

            
                            
                            
                            <h3 class="block-title" style="color: #aaa">Dados de Pagamento</h3>
                            <div class="row">
                                <div class="col-md-3">
                                   <strong>Nome do Plano: </strong><?= $plano['nome'];?><br>
                                </div>
                                <div class="col-md-3">
                                   <strong>Subtotal: </strong><?= $pagamento['subtotal'];?>
                                </div>
                                <div class="col-md-3">
                                    <strong>Desconto: </strong><?= $pagamento['desconto'];?>
                                </div>
                                <div class="col-md-3">
                                     <strong>Total: </strong><?= $pagamento['total'];?>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-10"><strong>Forma de Pagamento: </strong><?= $pagamento['modo'];?><?php if($pagamento['texto'] != ''){?>  (<?= $pagamento['texto'];?>) <?php } ?></div>
                                
                            </div>
                            <br><br>

                                
                           
                            
                        <?php if($plano['dependentes']){ ?>

                            <h3 class="block-title" style="color: #aaa">Dependentes</h3>
                            <table class="table table-bordered table-striped" >
                                <thead>    
                                    <tr>
                                        <th style="width: 50%">Nome</th>
                                        <th style="width: 25%">Data Nasc.</th>
                                        <th style="width: 25%">Parentesco</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php if($dependentes['dep_nome'] != ""){
                                        for($i = 0; $i < count($dependentes['dep_nome']); $i++) {
                                ?>           
                                    <tr>
                                        <td class="font-w600"><?=$dependentes['dep_nome'][$i]?></td>
                                        <td class="font-w600"><?=$dependentes['dep_data'][$i]?></td>
                                        <td class="font-w600"><?=$dependentes['dep_parentesco'][$i]?> </td>
                                    </tr>
                                <?php 
                                    }
                                } else{
                                    echo "<tr><td colspan='3'> Nenhum </td></tr>";     
                                }
                                  
                            ?>
                                </tbody>
                            </table>
                     
                        <?php } ?>


                        <?php if($plano['agregados']){ ?>

                            <h3 class="block-title" style="color: #aaa">Agregados</h3>
                            <table class="table table-bordered table-striped" >
                                <thead>    
                                    <tr>
                                        <th style="width: 50%">Nome</th>
                                        <th style="width: 25%">Data Nasc.</th>
                                        <th style="width: 25%">Parentesco</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php 
                                    //var_dump($agregados['agr_nome'], count($agregados['agr_nome'])); die;
                                    if($agregados['agr_nome'] != ""){
                                        for($i = 0; $i < count($agregados['agr_nome']); $i++) {
                                ?>  
                                    <tr>
                                        <td class="font-w600"><?=$agregados['agr_nome'][$i]?> </td>
                                        <td class="font-w600"><?=$agregados['agr_data'][$i]?> </td>
                                        <td class="font-w600"><?=$agregados['agr_parentesco'][$i]?> </td>
                                    </tr>
                                <?php 
                                    }
                                } else{
                                    echo "<tr><td colspan='3'> Nenhum </td></tr>";     
                                }
                                  
                            ?>
                                </tbody>
                            </table>

                        <?php } ?>


                        <?php if($plano['colaboradores']){ ?>

                            <h3 class="block-title" style="color: #aaa">Colaboradores</h3>
                            <table class="table table-bordered table-striped" >
                                <thead>    
                                    <tr>
                                       <th style="width: 70%">Nome</th>
                                        <th style="width: 30%">Data Nasc.</th>
                                    </tr>
                                </thead>
                                <tbody>
                               <?php if($colaboradores['colab_nome'] != ""){
                                        for($i = 0; $i < count($colaboradores['colab_nome']); $i++) {
                                ?>  
                                    <tr>
                                        <td class="font-w600"><?=$colaboradores['colab_nome'][$i]?> </td>
                                        <td class="font-w600"><?=$colaboradores['colab_data'][$i]?> </td>
                                    </tr>
                                <?php 
                                    }
                                } else{
                                    echo "<tr><td colspan='3'> Nenhum </td></tr>";     
                                }
                                  
                            ?>
                                </tbody>
                            </table>

                        <?php } ?>

                       </div>
                    </div>
                </div>


                <div class="block">
                            <div class="block-content">
                                <div class="row">
                                    <form action="<?=base_url('propostas/update');?>" method="post">

<?php //Formulário para salvar a proposta. Parte Final. ?>
     <input type="hidden" name="cod_proposta" value="<?=$codigo?>">
    <input type="hidden" name="numero_proposta" value="<?=$numero_proposta?>">
    <input type="hidden" name="dt_contratacao" value="<?=$datas['contratacao']?>">
    <input type="hidden" name="dt_vencimento" value="<?=$datas['vencimento']?>">
 

    <input type="hidden" name="cod_cliente" value="<?=$cliente['cod_cliente']?>">
    <input type="hidden" name="cod_plano" value="<?=$plano['cod_plano']?>">
    
    
    <input type="hidden" name="subtotal" value="<?=$pagamento['subtotal']?>">
    <input type="hidden" name="desconto" value="<?=$pagamento['desconto']?>">
    <input type="hidden" name="total" value="<?=$pagamento['total']?>">
    <input type="hidden" name="cod_modo_pagamento" value="<?=$pagamento['modo_cod']?>">
    <input type="hidden" name="modo" value="<?=$pagamento['modo']?>">
    <input type="hidden" name="qtd_parcelas" value="<?=$pagamento['qtd_parcelas']?>">
    <input type="hidden" name="valor_parcelas" value="<?=$pagamento['valor_parcelas']?>">
    <input type="hidden" name="texto" value="<?=$pagamento['texto']?>">
    <input type="hidden" name="melhor_dia" value="<?=$pagamento['melhor_dia']?>">

    <input type="hidden" name="observacoes" value="<?=$observacoes?>">
    
    <?php if($dependentes['dep_nome'] != "") {foreach ($dependentes['dep_nome'] as $data) {?>
        <input type="hidden" name="dep_nome[]" value="<?=$data?>">
    <?php }}?>
    
    <?php if($dependentes['dep_nome'] != "") {foreach ($dependentes['dep_data'] as $data) {?>
            <input type="hidden" name="dep_data[]" value="<?=$data?>">
    <?php }}?>
    <?php if($dependentes['dep_nome'] != "") {foreach ($dependentes['dep_parentesco'] as $data) {?>
            <input type="hidden" name="dep_parentesco[]" value="<?=$data?>">
    <?php }}?>

    <?php if($agregados['agr_nome'] != "") {foreach ($agregados['agr_nome'] as $data) {?>
            <input type="hidden" name="agr_nome[]" value="<?=$data?>">
    <?php }}?>
    
    <?php if($agregados['agr_nome'] != "") {foreach ($agregados['agr_data'] as $data) {?>
            <input type="hidden" name="agr_data[]" value="<?=$data?>">
    <?php }}?>
    <?php if($agregados['agr_nome'] != "") {foreach ($agregados['agr_parentesco'] as $data) {?>
            <input type="hidden" name="agr_parentesco[]" value="<?=$data?>">
    <?php }}?>

    <?php if($colaboradores['colab_nome'] != "") {foreach ($colaboradores['colab_nome'] as $data) {?>
            <input type="hidden" name="colab_nome[]" value="<?=$data?>">
    <?php }}?>
    
    <?php if($colaboradores['colab_nome'] != "") {foreach ($colaboradores['colab_data'] as $data) {?>
            <input type="hidden" name="colab_data[]" value="<?=$data?>">
    <?php }}?>
    <?php
    // Fim do Formulário?>


                                        <div class="form-group">

                                            <!--<input type="submit" name="proposta-status" class="btn btn-sm btn-primary" style="float: right; margin-right: 20px; margin-bottom: 20px;" value="Salvar Proposta"></input>-->
                                            
                                            <!--<input type="submit" name="proposta-status" class="btn btn-sm btn-primary" style="float: right; margin-right: 20px; margin-bottom: 20px;" value="Contratar"></input>
                                            
                                            <input type="submit" name="proposta-status" class="btn btn-sm btn-primary" style="float: right; margin-right: 20px; margin-bottom: 20px;" value="Gerar PDF"></input>-->
                                            
                                            <button class="btn btn-sm btn-primary" style="float: right; margin-right: 20px" type="button" data-toggle="modal" data-target="#proximoPasso" data-whatever="<?//=$data['cod_proposta']?>">Salvar Alterações</button>

                                            <input type="submit" name="proposta-status" class="btn btn-sm btn-info" style="float: right; margin-right: 20px; margin-bottom: 20px; " value="Cancelar"></input>
                                        </div>

                    <div class="modal fade" id="proximoPasso" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel">
                        <div class="modal-dialog" role="document">
                        <div class="block-header bg-primary-dark">
                            <ul class="block-options">
                                <li>
                                    <button data-dismiss="modal" type="button"><i class="si si-close"></i></button>
                                </li>
                            </ul>
                            <h3 class="block-title" style="color:white">Salvar Alterações</h3>
                        </div>
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <p>Deseja realizar mais alguma tarefa?</p>
                                        
                                        <div class="form-group" style="margin-left: 50px">
                                            <label class="checkbox">
                                                <input type="checkbox" name="imprimir" value="1"> Imprimir
                                            </label>
                                            <label class="checkbox" onclick="checkEmail()">
                                                <input type="checkbox" name="email" id="emailCheck" value="1"> Enviar por e-mail
                                            </label>
                                            <div style="margin-left: -50px; display: none" id="dest">
                                                <input class="form-control" type="text" name="destino" placeholder="Endereço de email" value="<?=$cliente['email']?>">
                                            </div>
                                            
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <input type="submit" name="proposta-status" class="btn btn-primary" value="Concluir"></input>
                                        
                                        <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>
                                    </div>
                                </div>
                            
                        </div>
                    </div>
                                    </form>
                                </div>                      
                            </div>
                        </div>


<script type="text/javascript">
    function checkEmail(){
        if(document.getElementById("emailCheck").checked == true){
            document.getElementById("dest").style.display = 'block';
        } else{
            document.getElementById("dest").style.display = 'none';
        }
    }
</script>
<script type="text/javascript">
    var items = document.getElementById('pag-modo');
    items.addEventListener('change', function(){
        //console.log("O indice é: " + items.selectedIndex);
        //console.log("O texto é: " + items.options[items.selectedIndex].text);
        //console.log("A chave é: " + items.options[items.selectedIndex].value);
        
        //console.log(s[0].nome);
        //console.log(s);

        document.getElementById("parcelas").style.display = 'none';
        document.getElementById("entrada_parcelas").style.display = 'none';
       
        if(items.options[items.selectedIndex].value == "2"){
            document.getElementById("parcelas").style.display = 'block';
        } else if(items.options[items.selectedIndex].value == "4"){
            document.getElementById("entrada_parcelas").style.display = 'block';
        } else if(items.options[items.selectedIndex].value == "5"){
            document.getElementById("entrada_parcelas").style.display = 'block';
        }
        
    });
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
                    range: [1, 100]
                },

                "pag-modo" : {
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
                    range: "Digite um número entre 1 e 100"
                },

                "pag-modo" : {
                   required : "O campo deve ser preenchido"
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