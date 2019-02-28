<?php 
    $this->load->helper('funcoes');
    $this->load->view('commons/header');

?>
<!-- Main Container -->
            <main id="main-container">
                <!-- Page Header -->
                <div class="content bg-gray-lighter">
                    <div class="row items-push">
                        <div class="col-sm-10">
                            <h1 class="page-heading">
                                Visualizar Guia de Atendimento
                            </h1>
                        </div>
                         <div class="col-sm-2">

                            <a class="btn btn-default" type="button" style="float: right;" href="<?=base_url('guias/novoPDF/' . $guia['cod_guia'])?>"><i class="fa fa-file-text-o"></i></a>
                            <a href="<?=base_url('guias/atualizar/' . $guia['cod_guia'])?>" class="btn btn-large btn-primary btn-rounded" style="float: right; margin-right: 10px">Editar</a>
                        
                           
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
                            <h3 class="block-title" style="color: #aaa">Dados do Paciente</h3>
                            <div class="row">
                                <div class="col-md-3">
                                   <strong>Paciente: </strong><?= $guia['nome'];?>
                                </div>
                            </div>
                             <div class="row">
                                <div class="col-md-3">
                                   <strong>Titular: </strong><?= $cliente['nome'];?>
                                </div>
                             </div>
                             <div class="row">
                                <div class="col-md-3">
                                    <strong>Celular: </strong><?= $cliente['celular'];?>
                                </div>
                                <div class="col-md-3">
                                   <strong>E-mail: </strong><?= $cliente['email'];?>
                                </div>
                            </div><!--
                            <div class="row">
                                <div class="col-md-5">
                                   <strong>Endereço: </strong><?//= $cliente['logradouro'];?>, <?//= $cliente['numero'];?> - <?//= $cliente['bairro'];?>
                                </div>
                                <div class="col-md-3">
                                   <strong>CEP: </strong><?//= $cliente['cep'];?>
                                </div>
                                <div class="col-md-4">
                                    <strong>Cidade/Estado: </strong><?//= $cliente['cidade'];?>/<?//= $cliente['estado'];?>
                                </div>
                            </div>-->
                            <br><br>



                            <h3 class="block-title" style="color: #aaa">Dados Gerais</h3>
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Número da Guia: </strong><?= $guia['cod_guia'];?><br>
                                </div>
                                 <div class="col-md-3">
                                    <strong>Data de Abertura: </strong><?= formata_data_br($guia['dt_abertura']);?><br>
                                </div>
                                <div class="col-md-3">
                                    <strong>Data de Realização: </strong><?= ($guia['dt_realizacao'] == '0000-00-00') ? '' : formata_data_br($guia['dt_realizacao']);?><br>
                                </div>
                                <div class="col-md-3">
                                    <strong>Horário: </strong><?= $guia['horario'];?><br>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                   <strong><?= $guia['tipo'];?>: </strong><?= $guia['parceiro'];?><br>
                                </div>
                                <div class="col-md-3">
                                   <strong>Emitido por: </strong><?= $guia['emissor'];?>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-3">
                                    <strong>Situação: </strong><?php 
                                                                    if($guia['status']=='p') 
                                                                        echo 'Pendente';
                                                                    else if ($guia['status']=='c') 
                                                                        echo 'Confirmada';
                                                                     
                                                                ?>
                                </div>
                                <div class="col-md-3">
                                    <?php if($guia['valor_tipo'] == 'c')  echo '<strong>Emissão de recibo:</strong> Não'; else echo '<strong>Emissão de recibo:</strong> Sim';?>

                                </div>
                                <div class="col-md-3">
                                    <strong>Valor total (R$): </strong><?= formata_preco($guia['valor_guia']);?>
                                </div>
                            </div>
                            <br><br>
 
                                
                           
                            
                        <?php if($servicos){ ?>

                            <h3 class="block-title" style="color: #aaa">Serviços</h3>
                            <table class="table table-bordered table-striped" >
                                <thead>    
                                    <tr>
                                        <th style="width: 65%">Nome</th>
                                        <th style="width: 35%">Valor (R$)</th>
                                        
                                    </tr>
                                </thead>
                                <tbody>
                                <?php
                                        if($servicos) foreach ($servicos as $data){
                                    ?>
                                    <tr>
                                        <td class="font-w600"><?php if($data['fk_exame']==0) echo $data['nome']; else echo $data['exame'] ?></td>
                                        <td class="font-w600"><?php if($guia['valor_tipo'] == 'c') echo formata_preco($data['valor_cima']); else if($guia['valor_tipo'] == 'r') echo formata_preco($data['valor_recibo'])?> </td>
                                        
                                    </tr>
                                <?php 
                                    } else{
                                    echo "<tr><td colspan='2'> Nenhum </td></tr>";     
                                }
                                  
                            
                                  
                            ?>
                                </tbody>
                            </table>
                     
                        <?php } ?>


                        

                <div class="block">
                            <div class="block-content">
                                <div class="row">
                                    


                                        <div class="form-group">

                                            <a href="<?=base_url('guias/atualizar/' . $guia['cod_guia'])?>" type="submit" name="proposta-status" class="btn btn-sm btn-primary" style="float: right; margin-right: 20px; margin-bottom: 20px;" >Atualizar Guia</a>
                                            
                                            
                                            <a href="<?=base_url('guias')?>"  class="btn btn-sm btn-info" style="float: right; margin-right: 20px; margin-bottom: 20px; ">Voltar</a>
                                        </div>
                                    
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