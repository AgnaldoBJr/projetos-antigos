<!-- Footer -->
            <!--<footer style="position:fixed; bottom:0px; width: 100%;" class="content-mini content-mini-full font-s12 bg-gray-lighter clearfix custom">
               
                <div class="pull-left">
                     <a class="font-w600" href="http://goo.gl/6LF10W" target="_blank">Developed by ITTOW</a> &copy; <span>2017</span>
                </div>

                
            </footer>-->
            <!-- END Footer -->
        </div>
        <!-- END Page Container -->

        
        
       <!-- OneUI Core JS: jQuery, Bootstrap, slimScroll, scrollLock, Appear, CountTo, Placeholder, Cookie and App.js -->
        <script src="<?=base_url('assets/js/core/jquery.min.js');?>"></script>
        <script src="<?=base_url('assets/js/core/bootstrap.min.js');?>"></script>
        <script src="<?=base_url('assets/js/core/jquery.slimscroll.min.js');?>"></script>
        <script src="<?=base_url('assets/js/core/jquery.scrollLock.min.js');?>"></script>
        <script src="<?=base_url('assets/js/core/jquery.appear.min.js');?>"></script>
        <script src="<?=base_url('assets/js/core/jquery.countTo.min.js');?>"></script>
        <script src="<?=base_url('assets/js/core/jquery.placeholder.min.js');?>"></script>
        <script src="<?=base_url('assets/js/core/js.cookie.min.js');?>"></script>
        
        <script src="<?=base_url('assets/js/app.js');?>"></script>


        <script src="<?=base_url('assets/js/plugins/masked-inputs/jquery.maskedinput.min.js');
        ?>"></script>
        <script src="<?=base_url('assets/js/plugins/masked-inputs/jquery.maskedmoney.min.js');
        ?>"></script>
        <script type="text/javascript">
                $(document).ready(function(){
                        $(".horario").mask("99:99");
                        $(".data").mask("99/99/9999");
                        $(".cpf").mask("999.999.999-99");
                        $(".cnpj").mask("99.999.999/9999-99");
                        $(".rg").mask("99.999.999-*");
                        $(".cep").mask("99.999-999");
                        $(".fone").mask("(99) 9999-9999");
                        $(".celular").mask("(99) 9999-9999?9");
                        $('.celular').focusout(function(){
                            var phone, element;
                            element = $(this);
                            element.unmask();
                            phone = element.val().replace(/\D/g, '');
                            if(phone.length > 10) {
                                element.mask("(99) 99999-999?9");
                            } else {
                                element.mask("(99) 9999-9999?9");
                            }
                        }).trigger('focusout');
                        $(".valor").maskMoney({
                             //prefix: "R$ ",
                             decimal: ",",
                             thousands: "."
                         });
                });
        </script>


        
        <!-- Page JS Plugins -->
        <script src="<?=base_url('assets/js/plugins/datatables/jquery.dataTables.min.js');?>"></script>
        <script src="<?=base_url('assets/js/plugins/select2/select2.full.min.js');?>"></script>
        <script src="<?=base_url('assets/js/plugins/jquery-validation/jquery.validate.min.js');?>"></script>
        <script src="<?=base_url('assets/js/plugins/jquery-validation/additional-methods.min.js');?>"></script>

        <!-- Page JS Code -->
        <script src="<?=base_url('assets/js/pages/base_tables_datatables.js');?>"></script>
        <script>
            jQuery(function () {
                // Init page helpers (Select2 plugin)
                App.initHelpers('select2');
            });
        </script>
        <script src="<?=base_url('assets/js/pages/base_forms_validation.js');?>"></script>

        <script>
            $(function(){
                $('#slim-scroll').slimScroll({
                    height: '500px'
                });
            });
        </script>

        <script language='JavaScript'>
            function SomenteNumero(e){
                var tecla=(window.event)?event.keyCode:e.which;   
                if((tecla>47 && tecla<58)) return true;
                else{
                    if (tecla==8 || tecla==0) return true;
                else  return false;
                }
            }
        </script>

         <script>
            jQuery(function () {
                // Init page helpers (SlimScroll plugin)
                App.initHelpers('slimscroll');
            });
        </script>
        <script>
             $(".edit").slimScroll({
                            color: '#666',
                            position: 'right',
                            alwaysVisible: false
             });
        </script>
        <script>
            jQuery(function () {
                // Init page helpers (BS Notify Plugin)
                App.initHelpers('notify');
            });
        </script>  

      <script type="text/javascript">

            $(document).ready(function () {
             
            window.setTimeout(function() {
                $(".alert").fadeTo(1000, 0).slideUp(1000, function(){
                    $(this).remove(); 
                });
            }, 4000);
             
            });


        </script>
        <script type="text/javascript">
            function caps(element){
                element.value = element.value.toUpperCase();
            }

        </script>







    <script type="text/javascript" src="//cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <!-- Include Date Range Picker -->
    <script type="text/javascript" src="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.js"></script>
    <link rel="stylesheet" type="text/css" href="//cdn.jsdelivr.net/bootstrap.daterangepicker/2/daterangepicker.css" />



    <script type="text/javascript">

    $(function() {

       
        var start = moment().subtract(29, 'days');
        var end = moment();

        function cb(start, end) {
            $('#reportrange span').html(start.format('DD/MM/YYYY') + ' - ' + end.format('DD/MM/YYYY'));
        }



        $('#reportrange').daterangepicker({
            autoUpdateInput: false,
            locale: {
            "format": "DD/MM/YYYY",
            "separator": " - ",
            "applyLabel": "Aplicar",
            "cancelLabel": "Cancelar",
            "fromLabel": "De",
            "toLabel": "Até",
            "customRangeLabel": "Personalizado",
            "weekLabel": "W",
            "daysOfWeek": [
                "Dom",
                "Seg",
                "Ter",
                "Qua",
                "Qui",
                "Sex",
                "Sab"
            ],
            "monthNames": [
                "Janeiro",
                "Fevereiro",
                "Março",
                "Abril",
                "Maio",
                "Junho",
                "Julho",
                "Agosto",
                "Setembro",
                "Outubro",
                "Novembro",
                "Dezembro"
            ],
            "firstDay": 1,
            
        },
           
            ranges: {
               'Hoje': [moment(), moment()],
               'Ontem': [moment().subtract(1, 'days'), moment().subtract(1, 'days')],
               'Últimos 7 dias': [moment().subtract(6, 'days'), moment()],
               'Últimos 30 dias': [moment().subtract(29, 'days'), moment()],
               'Este mês': [moment().startOf('month'), moment().endOf('month')],
               'Último mês': [moment().subtract(1, 'month').startOf('month'), moment().subtract(1, 'month').endOf('month')]
            },
            dayNamesMin: ['D','S','T','Q','Q','S','S','D'],
            dayNamesShort: ['Dom','Seg','Ter','Qua','Qui','Sex','Sáb','Dom'],
            dayNames: ['Domingo','Segunda','Terça','Quarta','Quinta','Sexta','Sábado'],
            monthNamesShort: ['Jan','Fev','Mar','Abr','Mai','Jun','Jul','Ago','Set','Out','Nov','Dez'],
            monthNames: ['Janeiro','Fevereiro','Março','Abril','Maio','Junho','Julho','Agosto','Setembro','Outubro','Novembro','Dezembro'],
            dateFormat: 'dd/mm/yy',
            nextText: 'Próximo',
            prevText: 'Anterior'
        });

        //cb(start, end);

        $('input[id="reportrange"]').on('apply.daterangepicker', function(ev, picker) {
          $(this).val(picker.startDate.format('DD/MM/YYYY') + ' - ' + picker.endDate.format('DD/MM/YYYY'));
      });

      $('input[id="reportrange"]').on('cancel.daterangepicker', function(ev, picker) {
          $(this).val('');
      });
        
    });
    </script>






    </body>
</html>