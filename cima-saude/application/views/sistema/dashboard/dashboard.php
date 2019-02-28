<?php 
    $this->load->view('commons/header');
    $semana = $propostas_graph['semana'];
    $propostas = $propostas_graph['propostas'];
    $contratos = $propostas_graph['contratos'];
    $naoGanhas = $propostas_graph['naoGanhas'];
    $pagar = $total_contas['pagar'];
    $receber = $total_contas['receber'];

    //var_dump($pagar, $receber); die;
?>


 <?php if($this->session->flashdata('msg')){ ?>
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
                <?php } ?>

                 



                <?php if($this->session->flashdata('cancel')): ?>
                    <div class="col-xs-11 col-sm-4 alert alert-info animated fadeIn" id="info-alert" role="alert" style=" margin: 0px auto; position: fixed;  z-index: 1033; top: 20px; right: 20px">
                        <button type="button" class="close" style="font-size: 14px" data-dismiss="alert">x</button>
                        <strong>Ok! </strong>
                        <?php echo $this->session->flashdata('cancel'); ?>
                    </div>
                <?php endif; ?>

                <?php if($this->session->flashdata('error')): ?>
                    <div class="col-xs-11 col-sm-4 alert alert-error animated fadeIn" id="info-alert" role="alert" style=" margin: 0px auto; position: fixed;  z-index: 1033; top: 20px; right: 20px">
                        <button type="button" class="close" style="font-size: 14px" data-dismiss="alert">x</button>
                        <strong>Ok! </strong>
                        <?php echo $this->session->flashdata('error'); ?>
                    </div>
                <?php endif; ?>





<!-- Main Container -->
            <main id="main-container">
         	    
                <div class="content content-boxed">
                    <h1 class="content-heading">Propostas e Contratos</h1>
        
                    <div class="row">
                        <div class="col-sm-6 col-md-3">
                            <a class="block block-link-hover3 text-center" href="javascript:void(0)">
                                <div class="block-content block-content-full">
                                    <div class="h1 font-w700 " data-toggle="countTo" data-to="35"><?= $propostas_month?></div>
                                </div>
                                <div class="block-content block-content-full block-content-mini bg-gray-lighter text-muted font-w600">Propostas (Esse mês)</div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <a class="block block-link-hover3 text-center" href="javascript:void(0)">
                                <div class="block-content block-content-full">
                                    <div class="h1 font-w700" data-toggle="countTo" data-to="120"><?= $propostas_week?></div>
                                </div>
                                <div class="block-content block-content-full block-content-mini bg-gray-lighter text-muted font-w600">Propostas (Essa semana)</div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <a class="block block-link-hover3 text-center" href="javascript:void(0)">
                                <div class="block-content block-content-full">
                                    <div class="h1 font-w700" data-toggle="countTo" data-to="260"><?= $contratos_month?></div>
                                </div>
                                <div class="block-content block-content-full block-content-mini bg-gray-lighter text-muted font-w600">Contratos (Esse mês)</div>
                            </a>
                        </div>
                        <div class="col-sm-6 col-md-3">
                            <a class="block block-link-hover3 text-center" href="javascript:void(0)">
                                <div class="block-content block-content-full">
                                    <div class="h1 font-w700" data-toggle="countTo" data-to="57890"><?= $contratos_week?></div>
                                </div>
                                <div class="block-content block-content-full block-content-mini bg-gray-lighter text-muted font-w600">Contratos (Essa semana)</div>
                            </a>
                        </div>
                    </div>
                    <!-- END Header Tiles -->
                </div>
                
                <!-- Page Content -->
                <div class="content" style="margin-top: -20px">
                    <!-- Dynamic Table Full -->
                     <div class="row">
                        <div class="col-lg-7 col-md-7">    
                            <div class="block">
                            <div class="block-header">
                                    
                                    <h3 class="block-title">Propostas e Contratos (Últimos dias)</h3>
                                </div>
                                <div class="block-content">
                           
                                    <div style="height: 400px;"><canvas id="myChart2"></canvas></div>

                                </div>
                            </div>
                        </div>
                            
                        <div class="col-lg-5 col-md-5">
                            <div class="block">
                                <div class="block-header">
                                    
                                    <h3 class="block-title">Últimas Propostas</h3>
                                </div>
                                
                                <div class="block-content">
                                    <div class="pull-t pull-r-l">
                                    
                                        <div class="js-slider remove-margin-b" >
                                            <div>
                                            
                                                <table class="table remove-margin-b font-s13">
                                                <?php
                                                    if($propostas_ultimas) foreach ($propostas_ultimas as $data){
                                                ?>
                                                    <tbody>
                                                        <tr>
                                                            <td class="font-w600">
                                                                <?=$data['numero']?> 
                                                            </td>
                                                            <?php if($data['status'] == 'C'){?>
                                                    <td><span class="label label-success">Proposta Ganha</span></td>
                                                <?php }else if($data['status'] == 'S'){?>    
                                                    <td><span class="label label-info">Proposta Salva</span></td>
                                            <?php }?>
                                                       
                                                        <td class="hidden-xs text-muted text-right" ><?=formata_data_hora_br($data['dt_cadastro'])?></td>
                                                    <?php } ?>
                                                    </tbody>
                                                       
                                                </table>
                                            </div>
                                        </div>
                                    </div>
                            
                                </div>
                            
                            
                            </div>
                        </div>
                    </div>
                </div>
                    <!-- END Dynamic Table Full -->
               
                <!-- END Page Content -->
                
                
                <div class="content" >
                    <h1 class="content-heading">Financeiro</h1>
        
                    <div class="row">
                        <div class="col-lg-6">
                            <!-- Lines Chart -->
                            <div class="block">
                                <div class="block-header">
                                   
                                  <div class="row">
                                        <div class="col-md-5">
                                            <h3 class="block-title">Contas a Receber</h3>
                                            
                                        </div>
                                    </div>
                                    

                                </div>
                                <div class="block-content block-content-full ">
                                   <a href="<?=base_url('dashboard/contas-receber')?>">
                                   <div style="height: 90px;">
                                        <div class="row">
                                            <div class="col-md-6 text-left">
                                                <p >Este mês</p>
                                            </div>

                                            <div class="col-md-6 text-left">
                                                <p >Próximo mês</p>
                                            </div>
                                        </div>        
                                         <div class="row">
                                             <div class="col-sm-2 col-md-2">

                                                <div class="h1 font-w700" style="color:#666;" data-toggle="countTo" data-to="35"><?= $contas_contagem['receber_mes']['quantidade']?></div>
                                            </div>
                                            <div class="col-sm-3 col-md-3">
                                                <div class="h1 font-w500 text-info"  data-toggle="countTo" data-to="35"><?= formata_preco($contas_contagem['receber_mes']['valor'])?></div>
                                            </div>
                                            <div class="col-sm-1 col-md-1"></div>
                                            <div class="col-sm-2 col-md-2">
                                                <div class="h1 font-w700" style="color:#666;" data-toggle="countTo" data-to="35"><?= $contas_contagem['receber_proximo']['quantidade']?></div>
                                            </div>
                                            <div class="col-sm-3 col-md-3">
                                                <div class="h1 font-w500 text-info" data-toggle="countTo" data-to="35"><?= formata_preco($contas_contagem['receber_proximo']['valor'])?></div>
                                            </div>
                                        </div>
                                    </div>
                                    </a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <!-- Lines Chart -->
                            <div class="block">
                                <div class="block-header">
                                   
                                    <div class="row">
                                        <div class="col-md-5">
                                            <h3 class="block-title">Contas a Pagar</h3>
                                            
                                        </div>
                                    </div>
                                     
                                    
                                        <!--<div class="col-md-6">
                                            
                                            <input type="text" name="periodo" class="form-control" id="reportrange" placeholder="dd/mm/aaaa - dd/mm/aaaa">
                                        
                                        </div>
                                        <div class="col-md-1">
                                             <ul class="block-options">
                                                <li>
                                                    <button type="button" data-toggle="block-option" data-action="refresh_toggle" data-action-mode="demo"><i class="si si-refresh"></i></button>
                                                </li>

                                            </ul>
                                        </div>-->
                                </div>
                                <div class="block-content block-content-full ">
                                    <a href="<?=base_url('dashboard/contas-pagar')?>">
                                    <div style="height: 90px;">
                                        <div class="row">
                                            <div class="col-md-6 text-left">
                                                <p >Este mês</p>
                                            </div>

                                            <div class="col-md-6 text-left">
                                                <p >Próximo mês</p>
                                            </div>
                                        </div>        
                                         <div class="row">
                                             <div class="col-sm-2 col-md-2">

                                                <div class="h1 font-w700" style="color: #666;" data-toggle="countTo" data-to="35"><?= $contas_contagem['pagar_mes']['quantidade']?></div>
                                            </div>
                                            <div class="col-sm-3 col-md-3">
                                                <div class="h1 font-w500 text-danger"  data-toggle="countTo" data-to="35"><?= formata_preco($contas_contagem['pagar_mes']['valor'])?></div>
                                            </div>
                                            <div class="col-sm-1 col-md-1"></div>
                                            <div class="col-sm-2 col-md-2">
                                                <div class="h1 font-w700" style="color: #666;" data-toggle="countTo" data-to="35"><?= $contas_contagem['pagar_proximo']['quantidade']?></div>
                                            </div>
                                            <div class="col-sm-3 col-md-3">
                                                <div class="h1 font-w500 text-danger " data-toggle="countTo" data-to="35"><?= formata_preco($contas_contagem['pagar_proximo']['valor'])?></div>
                                            </div>
                                        </div>

                                    </div>
                                    </a>
                                </div>
                            </div>
                            
                        </div>
                        

                    </div>

                    <div class="row">
                        <div class="col-sm-6 col-lg-4">
                            <a class="block block-link-hover3" href="<?=base_url('dashboard/demonstrativo-mensal')?>">
                                <div class="block-header">
                                    <h3 class="block-title">Demonstrativo Mensal</h3>
                                </div>
                              </a>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <a class="block block-link-hover3" href="<?=base_url('dashboard/demonstrativo-semanal')?>">
                                <div class="block-header">
                                    <h3 class="block-title">Demonstrativo Semanal</h3>
                                </div>
                               
                            </a>
                        </div>
                        <div class="col-sm-6 col-lg-4">
                            <a class="block block-link-hover3" href="<?=base_url('dashboard/proximos-lancamentos')?>">
                                <div class="block-header">
                                    <h3 class="block-title">Próximos Lançamentos</h3>
                                </div>
                              
                            </a>
                        </div>
                    </div>

                </div>
                    


                
         	    
            </main>
            <!-- END Main Container -->

            

<?php $this->load->view('commons/footer');?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.4.0/Chart.min.js"></script>

<script type="text/javascript">
    
    
var formatedString = '<%= "R$ " + value.toString().split(".").join(",") %>';
    var ctx = document.getElementById('myChart').getContext('2d');
var chart = new Chart(ctx, {
    // The type of chart we want to create
    type: 'line',

    // The data for our dataset
    data: {
        labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho"],
        datasets: [
        {
            label: "Contas a Pagar",
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255,99,132,1)',
            data: [0, 10, 5, 2, 20, 30, 45],
        },
        {
            label: "Contas a Receber",
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            data: [3, 16, 23, 11, 45, 50, 40],
        },



        ]
    },

    // Configuration options go here
    options: {
        responsive: true,
        tooltipTemplate: formatedString,
        scaleLabel: formatedString}
});
</script>

<script>
var semana = <?php echo json_encode($semana, JSON_PRETTY_PRINT) ?>;
var propostas = <?php echo json_encode($propostas, JSON_PRETTY_PRINT) ?>;
var contratos = <?php echo json_encode($contratos, JSON_PRETTY_PRINT) ?>;
var naoGanhas = <?php echo json_encode($naoGanhas, JSON_PRETTY_PRINT) ?>;

console.log(semana);
console.log('ola');
var ctx = document.getElementById("myChart2");
var myChart = new Chart(ctx, {
    type: 'horizontalBar',
    data: {
        labels: semana,
        datasets: [{
            label: 'Propostas Salvas',
            data: propostas,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        },
        {
            label: 'Contratos',
            data: contratos,
            backgroundColor: 'rgba(35,35,142, 0.2)',
            borderColor:  'rgba(77,77,255, 1)',
            borderWidth: 1
        },
        {
            label: 'Propostas não ganhas',
            data: naoGanhas,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255,99,132,1)',
            borderWidth: 1
        },


        ]
    },
    options: {
        scales: {
        xAxes: [{
            stacked: true,
        }],
        yAxes: [{
            stacked: true,
            ticks: {
                beginAtZero: true
            }
        }]
        }
    }
   /* options: {
        scales: {
            yAxes: [{
                ticks: {
                    beginAtZero:true
                }
            }]
        }
    }*/
});
</script>

<script>

var pagar = <?php echo $pagar?>;
var receber = <?php echo $receber ?>;
console.log(pagar, receber);

var data  = [];
data.push(pagar);

var data1  = [];
data1.push(receber);

var formatedString = '<%= "R$ " + value.toString().split(".").join(",") %>';
var ctx = document.getElementById("myChart3");
var myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        
        datasets: [{
            label: 'Contas a Receber',
            data: data1,
            backgroundColor: 'rgba(54, 162, 235, 0.2)',
            borderColor: 'rgba(54, 162, 235, 1)',
            borderWidth: 1
        },
        
        {
            label: 'Contas a Pagar',
            data: data,
            backgroundColor: 'rgba(255, 99, 132, 0.2)',
            borderColor: 'rgba(255,99,132,1)',
            borderWidth: 1
        },


        ]
    },
    options: {
        tooltip: {
           mode: 'label',
           label: 'mylabel',
           callbacks: {
               label: function(tooltipItem, data) {
                   return tooltipItem.yLabel.toString().replace(/(\d{2})$/,",$1"); }, },},
        
        scales: {
            xAxes: [{
                stacked: true,
            }],
            yAxes: [{
                stacked: true,
                ticks: {
                    beginAtZero: true,
                    callback: function(value, index, values) {
                                    if(parseInt(value) >= 1000){
                                        return 'R$' + value.toString().replace(/(\d{2})$/,",$1");
                                    } else {
                                        return 'R$' + value;
                                }
                        }
                }

            }]
        }
    }
    
});
 
</script>