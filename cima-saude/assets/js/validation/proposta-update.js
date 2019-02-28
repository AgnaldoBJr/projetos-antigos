//linha para usar a biblioteca Jquery
    $().ready(function() {
        //utiliza o formulário escolhido por ID
        $('#propostaformupdate').validate({
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
                'pag-numero': {
                    required : true
                },
                'pag-num': {
                    required : true
                },
                'melhor-dia' :  {
                    required :  true
                },

                'dep-nome[0]' :  {
                    required : function(element){
                        if($('#dep-data0').val()!="" || $('#dep-parentesco0').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'dep-data-nasc[0]' :  {
                    required : function(element){
                        if($('#dep-nome0').val()!="" || $('#dep-parentesco0').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'dep-parentesco[0]' :  {
                    required : function(element){
                        if($('#dep-data0').val()!="" || $('#dep-nome0').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                 'dep-nome[1]' :  {
                    required : function(element){
                        if($('#dep-data1').val()!="" || $('#dep-parentesco1').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'dep-data-nasc[1]' :  {
                    required : function(element){
                        if($('#dep-nome1').val()!="" || $('#dep-parentesco1').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'dep-parentesco[1]' :  {
                    required : function(element){
                        if($('#dep-data1').val()!="" || $('#dep-nome1').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                 'dep-nome[2]' :  {
                    required : function(element){
                        if($('#dep-data2').val()!="" || $('#dep-parentesco2').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'dep-data-nasc[2]' :  {
                    required : function(element){
                        if($('#dep-nome2').val()!="" || $('#dep-parentesco2').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'dep-parentesco[2]' :  {
                    required : function(element){
                        if($('#dep-data2').val()!="" || $('#dep-nome2').val()!="")
                            return true; 
                        else 
                            return false;}
                },
                 'dep-nome[3]' :  {
                    required : function(element){
                        if($('#dep-data3').val()!="" || $('#dep-parentesco3').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'dep-data-nasc[3]' :  {
                    required : function(element){
                        if($('#dep-nome3').val()!="" || $('#dep-parentesco3').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'dep-parentesco[3]' :  {
                    required : function(element){
                        if($('#dep-data3').val()!="" || $('#dep-nome3').val()!="")
                            return true; 
                        else 
                            return false;}
                },
                 'dep-nome[4]' :  {
                    required : function(element){
                        if($('#dep-data4').val()!="" || $('#dep-parentesco4').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'dep-data-nasc[4]' :  {
                    required : function(element){
                        if($('#dep-nome4').val()!="" || $('#dep-parentesco4').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'dep-parentesco[4]' :  {
                    required : function(element){
                        if($('#dep-data4').val()!="" || $('#dep-nome4').val()!="")
                            return true; 
                        else 
                            return false;}
                },
                 'dep-nome[5]' :  {
                    required : function(element){
                        if($('#dep-data5').val()!="" || $('#dep-parentesco5').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'dep-data-nasc[5]' :  {
                    required : function(element){
                        if($('#dep-nome5').val()!="" || $('#dep-parentesco5').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'dep-parentesco[5]' :  {
                    required : function(element){
                        if($('#dep-data5').val()!="" || $('#dep-nome5').val()!="")
                            return true; 
                        else 
                            return false;}
                },
                 'dep-nome[6]' :  {
                    required : function(element){
                        if($('#dep-data6').val()!="" || $('#dep-parentesco6').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'dep-data-nasc[6]' :  {
                    required : function(element){
                        if($('#dep-nome6').val()!="" || $('#dep-parentesco6').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'dep-parentesco[6]' :  {
                    required : function(element){
                        if($('#dep-data6').val()!="" || $('#dep-nome6').val()!="")
                            return true; 
                        else 
                            return false;}
                },
                 'dep-nome[7]' :  {
                    required : function(element){
                        if($('#dep-data7').val()!="" || $('#dep-parentesco7').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'dep-data-nasc[7]' :  {
                    required : function(element){
                        if($('#dep-nome7').val()!="" || $('#dep-parentesco7').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'dep-parentesco[7]' :  {
                    required : function(element){
                        if($('#dep-data7').val()!="" || $('#dep-nome7').val()!="")
                            return true; 
                        else 
                            return false;}
                },
                 'dep-nome[8]' :  {
                    required : function(element){
                        if($('#dep-data8').val()!="" || $('#dep-parentesco8').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'dep-data-nasc[8]' :  {
                    required : function(element){
                        if($('#dep-nome8').val()!="" || $('#dep-parentesco8').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'dep-parentesco[8]' :  {
                    required : function(element){
                        if($('#dep-data8').val()!="" || $('#dep-nome8').val()!="")
                            return true; 
                        else 
                            return false;}
                },
                 'dep-nome[9]' :  {
                    required : function(element){
                        if($('#dep-data9').val()!="" || $('#dep-parentesco9').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'dep-data-nasc[9]' :  {
                    required : function(element){
                        if($('#dep-nome9').val()!="" || $('#dep-parentesco9').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'dep-parentesco[9]' :  {
                    required : function(element){
                        if($('#dep-data9').val()!="" || $('#dep-nome9').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'agr-nome[0]' :  {
                    required : function(element){
                        if($('#agr-data0').val()!="" || $('#agr-parentesco0').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'agr-data-nasc[0]' :  {
                    required : function(element){
                        if($('#agr-nome0').val()!="" || $('#agr-parentesco0').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'agr-parentesco[0]' :  {
                    required : function(element){
                        if($('#agr-data0').val()!="" || $('#agr-nome0').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                 'agr-nome[1]' :  {
                    required : function(element){
                        if($('#agr-data1').val()!="" || $('#agr-parentesco1').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'agr-data-nasc[1]' :  {
                    required : function(element){
                        if($('#agr-nome1').val()!="" || $('#agr-parentesco1').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'agr-parentesco[1]' :  {
                    required : function(element){
                        if($('#agr-data1').val()!="" || $('#agr-nome1').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                 'agr-nome[2]' :  {
                    required : function(element){
                        if($('#agr-data2').val()!="" || $('#agr-parentesco2').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'agr-data-nasc[2]' :  {
                    required : function(element){
                        if($('#agr-nome2').val()!="" || $('#agr-parentesco2').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'agr-parentesco[2]' :  {
                    required : function(element){
                        if($('#agr-data2').val()!="" || $('#agr-nome2').val()!="")
                            return true; 
                        else 
                            return false;}
                },
                 'agr-nome[3]' :  {
                    required : function(element){
                        if($('#agr-data3').val()!="" || $('#agr-parentesco3').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'agr-data-nasc[3]' :  {
                    required : function(element){
                        if($('#agr-nome3').val()!="" || $('#agr-parentesco3').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'agr-parentesco[3]' :  {
                    required : function(element){
                        if($('#agr-data3').val()!="" || $('#agr-nome3').val()!="")
                            return true; 
                        else 
                            return false;}
                },
                 'agr-nome[4]' :  {
                    required : function(element){
                        if($('#agr-data4').val()!="" || $('#agr-parentesco4').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'agr-data-nasc[4]' :  {
                    required : function(element){
                        if($('#agr-nome4').val()!="" || $('#agr-parentesco4').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'agr-parentesco[4]' :  {
                    required : function(element){
                        if($('#agr-data4').val()!="" || $('#agr-nome4').val()!="")
                            return true; 
                        else 
                            return false;}
                },
                 'agr-nome[5]' :  {
                    required : function(element){
                        if($('#agr-data5').val()!="" || $('#agr-parentesco5').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'agr-data-nasc[5]' :  {
                    required : function(element){
                        if($('#agr-nome5').val()!="" || $('#agr-parentesco5').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'agr-parentesco[5]' :  {
                    required : function(element){
                        if($('#agr-data5').val()!="" || $('#agr-nome5').val()!="")
                            return true; 
                        else 
                            return false;}
                },
                 'agr-nome[6]' :  {
                    required : function(element){
                        if($('#agr-data6').val()!="" || $('#agr-parentesco6').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'agr-data-nasc[6]' :  {
                    required : function(element){
                        if($('#agr-nome6').val()!="" || $('#agr-parentesco6').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'agr-parentesco[6]' :  {
                    required : function(element){
                        if($('#agr-data6').val()!="" || $('#agr-nome6').val()!="")
                            return true; 
                        else 
                            return false;}
                },
                 'agr-nome[7]' :  {
                    required : function(element){
                        if($('#agr-data7').val()!="" || $('#agr-parentesco7').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'agr-data-nasc[7]' :  {
                    required : function(element){
                        if($('#agr-nome7').val()!="" || $('#agr-parentesco7').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'agr-parentesco[7]' :  {
                    required : function(element){
                        if($('#agr-data7').val()!="" || $('#agr-nome7').val()!="")
                            return true; 
                        else 
                            return false;}
                },
                 'agr-nome[8]' :  {
                    required : function(element){
                        if($('#agr-data8').val()!="" || $('#agr-parentesco8').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'agr-data-nasc[8]' :  {
                    required : function(element){
                        if($('#agr-nome8').val()!="" || $('#agr-parentesco8').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'agr-parentesco[8]' :  {
                    required : function(element){
                        if($('#agr-data8').val()!="" || $('#agr-nome8').val()!="")
                            return true; 
                        else 
                            return false;}
                },
                 'agr-nome[9]' :  {
                    required : function(element){
                        if($('#agr-data9').val()!="" || $('#agr-parentesco9').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'agr-data-nasc[9]' :  {
                    required : function(element){
                        if($('#agr-nome9').val()!="" || $('#agr-parentesco9').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'agr-parentesco[9]' :  {
                    required : function(element){
                        if($('#agr-data9').val()!="" || $('#agr-nome9').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'colab-nome[0]' :  {
                    required : function(element){
                        if($('#colab-data0').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'colab-data-nasc[0]' :  {
                    required : function(element){
                        if($('#colab-nome0').val()!="")
                            return true; 
                        else 
                            return false;}
                },


                 'colab-nome[1]' :  {
                    required : function(element){
                        if($('#colab-data1').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'colab-data-nasc[1]' :  {
                    required : function(element){
                        if($('#colab-nome1').val()!="")
                            return true; 
                        else 
                            return false;}
                },

               

                 'colab-nome[2]' :  {
                    required : function(element){
                        if($('#colab-data2').val()!="" )
                            return true; 
                        else 
                            return false;}
                },

                'colab-data-nasc[2]' :  {
                    required : function(element){
                        if($('#colab-nome2').val()!="" )
                            return true; 
                        else 
                            return false;}
                },

                
                 'colab-nome[3]' :  {
                    required : function(element){
                        if($('#colab-data3').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'colab-data-nasc[3]' :  {
                    required : function(element){
                        if($('#colab-nome3').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                
                 'colab-nome[4]' :  {
                    required : function(element){
                        if($('#colab-data4').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'colab-data-nasc[4]' :  {
                    required : function(element){
                        if($('#colab-nome4').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                 'colab-nome[5]' :  {
                    required : function(element){
                        if($('#dep-data5').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'colab-data-nasc[5]' :  {
                    required : function(element){
                        if($('#colab-nome5').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                 'colab-nome[6]' :  {
                    required : function(element){
                        if($('#colab-data6').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'colab-data-nasc[6]' :  {
                    required : function(element){
                        if($('#colab-nome6').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                 'colab-nome[7]' :  {
                    required : function(element){
                        if($('#colab-data7').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'colab-data-nasc[7]' :  {
                    required : function(element){
                        if($('#colab-nome7').val()!="")
                            return true; 
                        else 
                            return false;}
                },


                 'colab-nome[8]' :  {
                    required : function(element){
                        if($('#colab-data8').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'colab-data-nasc[8]' :  {
                    required : function(element){
                        if($('#colab-nome8').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                 'colab-nome[9]' :  {
                    required : function(element){
                        if($('#colab-data9').val()!="")
                            return true; 
                        else 
                            return false;}
                },

                'colab-data-nasc[9]' :  {
                    required : function(element){
                        if($('#colab-nome9').val()!="")
                            return true; 
                        else 
                            return false;}
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
                   required : "Escolha uma opção"
                },
                'pag-numero': {
                    required : "O campo deve ser preenchido"
                },
                'pag-num': {
                    required : "O campo deve ser preenchido"
                },
                'melhor-dia' :  {
                    required : "Escolha uma opção"
                },
                //validação de cada campo do array dep
                'dep-nome[0]' :  {
                    required : "O campo deve ser preenchido"
                },

                'dep-data-nasc[0]' :  {
                    required : "O campo deve ser preenchido"
                },

                'dep-parentesco[0]' :  {
                    required : "Escolha uma opção"
                },

                'dep-nome[1]' :  {
                    required : "O campo deve ser preenchido"
                },

                'dep-data-nasc[1]' :  {
                    required : "O campo deve ser preenchido"
                },

                'dep-parentesco[1]' :  {
                    required : "Escolha uma opção"
                },

                'dep-nome[2]' :  {
                    required : "O campo deve ser preenchido"
                },

                'dep-data-nasc[2]' :  {
                    required : "O campo deve ser preenchido"
                },

                'dep-parentesco[2]' :  {
                    required : "Escolha uma opção"
                },
                'dep-nome[3]' :  {
                    required : "O campo deve ser preenchido"
                },

                'dep-data-nasc[3]' :  {
                    required : "O campo deve ser preenchido"
                },

                'dep-parentesco[3]' :  {
                    required : "Escolha uma opção"
                },
                'dep-nome[4]' :  {
                    required : "O campo deve ser preenchido"
                },

                'dep-data-nasc[4]' :  {
                    required : "O campo deve ser preenchido"
                },

                'dep-parentesco[4]' :  {
                    required : "Escolha uma opção"
                },
                'dep-nome[5]' :  {
                    required : "O campo deve ser preenchido"
                },

                'dep-data-nasc[5]' :  {
                    required : "O campo deve ser preenchido"
                },

                'dep-parentesco[5]' :  {
                    required : "Escolha uma opção"
                },
                'dep-nome[6]' :  {
                    required : "O campo deve ser preenchido"
                },

                'dep-data-nasc[6]' :  {
                    required : "O campo deve ser preenchido"
                },

                'dep-parentesco[6]' :  {
                    required : "Escolha uma opção"
                },
                'dep-nome[7]' :  {
                    required : "O campo deve ser preenchido"
                },

                'dep-data-nasc[7]' :  {
                    required : "O campo deve ser preenchido"
                },

                'dep-parentesco[7]' :  {
                    required : "Escolha uma opção"
                },
                'dep-nome[8]' :  {
                    required : "O campo deve ser preenchido"
                },

                'dep-data-nasc[8]' :  {
                    required : "O campo deve ser preenchido"
                },

                'dep-parentesco[8]' :  {
                    required : "Escolha uma opção"
                },
                'dep-nome[9]' :  {
                    required : "O campo deve ser preenchido"
                },

                'dep-data-nasc[9]' :  {
                    required : "O campo deve ser preenchido"
                },

                'dep-parentesco[9]' :  {
                    required : "Escolha uma opção"
                },

                //validação de cada campo do array agr
                'agr-nome[0]' :  {
                    required : "O campo deve ser preenchido"
                },

                'agr-data-nasc[0]' :  {
                    required : "O campo deve ser preenchido"
                },

                'agr-parentesco[0]' :  {
                    required : "Escolha uma opção"
                },

                'agr-nome[1]' :  {
                    required : "O campo deve ser preenchido"
                },

                'agr-data-nasc[1]' :  {
                    required : "O campo deve ser preenchido"
                },

                'agr-parentesco[1]' :  {
                    required : "Escolha uma opção"
                },

                'agr-nome[2]' :  {
                    required : "O campo deve ser preenchido"
                },

                'agr-data-nasc[2]' :  {
                    required : "O campo deve ser preenchido"
                },

                'agr-parentesco[2]' :  {
                    required : "Escolha uma opção"
                },
                'agr-nome[3]' :  {
                    required : "O campo deve ser preenchido"
                },

                'agr-data-nasc[3]' :  {
                    required : "O campo deve ser preenchido"
                },

                'agr-parentesco[3]' :  {
                    required : "Escolha uma opção"
                },
                'agr-nome[4]' :  {
                    required : "O campo deve ser preenchido"
                },

                'agr-data-nasc[4]' :  {
                    required : "O campo deve ser preenchido"
                },

                'agr-parentesco[4]' :  {
                    required : "Escolha uma opção"
                },
                'agr-nome[5]' :  {
                    required : "O campo deve ser preenchido"
                },

                'agr-data-nasc[5]' :  {
                    required : "O campo deve ser preenchido"
                },

                'agr-parentesco[5]' :  {
                    required : "Escolha uma opção"
                },
                'agr-nome[6]' :  {
                    required : "O campo deve ser preenchido"
                },

                'agr-data-nasc[6]' :  {
                    required : "O campo deve ser preenchido"
                },

                'agr-parentesco[6]' :  {
                    required : "Escolha uma opção"
                },
                'agr-nome[7]' :  {
                    required : "O campo deve ser preenchido"
                },

                'agr-data-nasc[7]' :  {
                    required : "O campo deve ser preenchido"
                },

                'agr-parentesco[7]' :  {
                    required : "Escolha uma opção"
                },
                'agr-nome[8]' :  {
                    required : "O campo deve ser preenchido"
                },

                'agr-data-nasc[8]' :  {
                    required : "O campo deve ser preenchido"
                },

                'agr-parentesco[8]' :  {
                    required : "Escolha uma opção"
                },
                'agr-nome[9]' :  {
                    required : "O campo deve ser preenchido"
                },

                'agr-data-nasc[9]' :  {
                    required : "O campo deve ser preenchido"
                },

                'agr-parentesco[9]' :  {
                    required : "Escolha uma opção"
                },

                //validação de cada campo do array colab
                'colab-nome[0]' :  {
                    required : "O campo deve ser preenchido"
                },

                'colab-data-nasc[0]' :  {
                    required : "O campo deve ser preenchido"
                },

                'colab-funcao[0]' :  {
                    required : "O campo deve ser preenchido"
                },

                'colab-nome[1]' :  {
                    required : "O campo deve ser preenchido"
                },

                'colab-data-nasc[1]' :  {
                    required : "O campo deve ser preenchido"
                },

                'colab-funcao[1]' :  {
                    required : "O campo deve ser preenchido"
                },

                'colab-nome[2]' :  {
                    required : "O campo deve ser preenchido"
                },

                'colab-data-nasc[2]' :  {
                    required : "O campo deve ser preenchido"
                },

                'colab-funcao[2]' :  {
                    required : "O campo deve ser preenchido"
                },
                'colab-nome[3]' :  {
                    required : "O campo deve ser preenchido"
                },

                'colab-data-nasc[3]' :  {
                    required : "O campo deve ser preenchido"
                },

                'colab-funcao[3]' :  {
                    required : "O campo deve ser preenchido"
                },
                'colab-nome[4]' :  {
                    required : "O campo deve ser preenchido"
                },

                'colab-data-nasc[4]' :  {
                    required : "O campo deve ser preenchido"
                },

                'colab-funcao[4]' :  {
                    required : "O campo deve ser preenchido"
                },
                'colab-nome[5]' :  {
                    required : "O campo deve ser preenchido"
                },

                'colab-data-nasc[5]' :  {
                    required : "O campo deve ser preenchido"
                },

                'colab-funcao[5]' :  {
                    required : "O campo deve ser preenchido"
                },
                'colab-nome[6]' :  {
                    required : "O campo deve ser preenchido"
                },

                'colab-data-nasc[6]' :  {
                    required : "O campo deve ser preenchido"
                },

                'colab-funcao[6]' :  {
                    required : "O campo deve ser preenchido"
                },
                'colab-nome[7]' :  {
                    required : "O campo deve ser preenchido"
                },

                'colab-data-nasc[7]' :  {
                    required : "O campo deve ser preenchido"
                },

                'colab-funcao[7]' :  {
                    required : "O campo deve ser preenchido"
                },
                'colab-nome[8]' :  {
                    required : "O campo deve ser preenchido"
                },

                'colab-data-nasc[8]' :  {
                    required : "O campo deve ser preenchido"
                },

                'colab-funcao[8]' :  {
                    required : "O campo deve ser preenchido"
                },
                'colab-nome[9]' :  {
                    required : "O campo deve ser preenchido"
                },

                'colab-data-nasc[9]' :  {
                    required : "O campo deve ser preenchido"
                },

                'colab-funcao[9]' :  {
                    required : "O campo deve ser preenchido"
                },


                
            }
        });
/*
        $('input[id^="dep-nome"]').each(function(){
            $(this).rules('add', {
                required:true,
                messages: {
                    required: "requerido"
                }
            });
        });
*/
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

