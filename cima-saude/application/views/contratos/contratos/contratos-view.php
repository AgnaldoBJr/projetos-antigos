<?php 
    $this->load->helper('funcoes');
    //echo $dependentes['dep_nome'][0];
    //echo $dependentes['dep_nome'][1]; die;

    $this->load->view('commons/header');

?>
<!-- Main Container -->
            <main id="main-container">
                <!-- Page Header -->
                <div class="content bg-gray-lighter">
                    <div class="row items-push">
                        <div class="col-sm-10">
                            <h1 class="page-heading">
                                Visualizar Contrato <small><?= $contrato['numero'];?></small>
                            </h1>
                        </div>
                         <div class="col-sm-2">
                             <!--<button type="submit" style="float: right;" class="btn btn-default" value="1"><i class="fa fa-file-text-o"></i></button>-->
                            <!--<a href="propostas/editar" class="btn btn-large btn-primary btn-rounded" style="float: right; margin-right: 10px">Editar</a>-->
                            <a class="btn btn-default" type="button" style="float: right;" href="<?=base_url('contratos/novoPDF/' . $contrato['cod_proposta'])?>"><i class="fa fa-file-text-o"></i></a>
                           
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

                <!-- Page Content -->
                <div class="content">
                    <div class="block">
                        <div class="block-content">
                            

                            <h3 class="block-title" style="color: #aaa">Dados Gerais</h3>
                            <div class="row">
                                <div class="col-md-4">
                                    <strong>Número do Contrato: </strong><?= $contrato['numero'];?><br>
                                </div>
                                 <div class="col-md-4">
                                    <strong>Data de Contratação: </strong><?= $contrato['dt_contratacao'];?><br>
                                </div>
                                <div class="col-md-4">
                                    <strong>Data de Vencimento: </strong><?= $contrato['dt_vencimento'];?><br>
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
                                   <strong>Subtotal: </strong><?= $contrato['pag_subtotal'];?>
                                </div>
                                <div class="col-md-3">
                                    <strong>Desconto: </strong><?= $contrato['pag_desconto'];?>
                                </div>
                                <div class="col-md-3">
                                     <strong>Total: </strong><?= $contrato['pag_total'];?>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col-sm-10"><strong>Forma de Pagamento: </strong><?= $contrato['modo'];?><?php if($contrato['pag_texto'] != ''){?>  (<?= $contrato['pag_texto'];?>) <?php } ?></div>
                                
                            </div>

                            <?php if($contrato['pag_texto'] != ""){?>

                            <table class="table table-bordered table-striped" >
                                <thead>    
                                    <tr>
                                        <th>Nº Parcela</th>
                                        <th>Valor (R$)</th>
                                        <th>Data de Vencimento</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        if($contas) foreach ($contas as $data){
                                    ?>
                                    <tr>
                                        <td class="font-w600">Parcela <?=$data['num_repeticao']?> </td>
                                        <td class="font-w600"><?=formata_preco($data['valor'])?> </td>
                                        <td class="font-w600"><?=formata_data_br($data['dt_recebimento'])?> </td>
                                    </tr>
                                <?php }  ?>
                                </tbody>
                            </table>
                            <?php } else {?>
                            <div class="row">
                                <div class="col-sm-10"><strong>Vencimento: </strong><?=formata_data_br($contas[0]['dt_recebimento'])?></div>
                                
                            </div>

                            <?php }?>
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
                                <?php
                                        if($dependentes) foreach ($dependentes as $data){
                                    ?>
                                    <tr>
                                        <td class="font-w600"><?=$data['nome']?> </td>
                                        <td class="font-w600"><?=formata_data_br($data['data_nasc'])?> </td>
                                        <td class="font-w600"><?=$data['parentesco']?> </td>
                                    </tr>
                                <?php 
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
                                        if($agregados) foreach ($agregados as $data){
                                    ?>
                                    <tr>
                                        <td class="font-w600"><?=$data['nome']?> </td>
                                        <td class="font-w600"><?=formata_data_br($data['data_nasc'])?> </td>
                                        <td class="font-w600"><?=$data['parentesco']?> </td>
                                    </tr>
                                <?php } else{
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
                               <?php
                                        if($colaboradores) foreach ($colaboradores as $data){
                                    ?>
                                    <tr>
                                        <td class="font-w600"><?=$data['nome']?> </td>
                                        <td class="font-w600"><?=formata_data_br($data['data_nasc'])?> </td>
                                    </tr>
                                <?php 
                                    
                                }  else{
                                    echo "<tr><td colspan='3'> Nenhum </td></tr>";     
                                }
                                  
                            ?>
                                </tbody>
                            </table>

                        <?php } ?>

                <div class="block">
                            <div class="block-content">
                                <div class="row">
                                    <form action="<?=base_url('propostas/contratar');?>" method="post">


                                        <div class="form-group">

                                           <!-- <a href="#" type="submit" name="proposta-status" class="btn btn-sm btn-primary" style="float: right; margin-right: 20px; margin-bottom: 20px;" >Atualizar Proposta</a>
                                            
                                            <a href="#" type="submit" name="proposta-status" class="btn btn-sm btn-primary" style="float: right; margin-right: 20px; margin-bottom: 20px;" >Gerar PDF</a>-->
                                            
                                            <a href="<?=base_url('contratos')?>" type="submit" name="proposta-status" class="btn btn-sm btn-info" style="float: right; margin-right: 20px; margin-bottom: 20px; ">Voltar</a>
                                        </div>
                                    </form>
                                </div>                      
                            </div>
                        </div>


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