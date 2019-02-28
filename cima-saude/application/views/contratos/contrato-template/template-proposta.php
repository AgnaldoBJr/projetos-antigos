<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('funcoes');

//$this->load->view('commons/head');
?>
<!DOCTYPE html>
<html>
<head>
    <title>Proposta Cima Saúde</title>
    <style type="text/css">
        h1 {
            text-align: center;
        }
        
        h3 {
            font-family: sans-serif;
            font-size: 14px;
            text-align: center;
        }

        h4 {
            font-family: sans-serif;
            font-size: 14px;
            color: #666;
        }

         h5 {
            font-family: sans-serif;
            font-size: 12px;
            color: #999;
        }

        span {
            font-weight: bold;
        }

        p {
            text-align: justify;
            font-size: 12px;
            font-family: sans-serif;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        table, th, td {
            border: 0.5px solid black;
            padding-left: 10px;
            padding-bottom: 5px;
            padding-right: 5px; 
            padding-top: 5px;
            font-size: 12px;
            font-family: sans-serif;
        }
        th {
            text-align: justify;
        }

        .no-borded {
            padding: 10px;
            border: 0px solid black;
        }

    </style>
</head>
<body>

<div style="text-align: center;"><img src="<?=base_url('assets/img/cima/logo-cima.jpg')?>"></div>
<h3>CONTRATO DE PRESTAÇÃO DE SERVIÇOS DE SAÚDE PREVENTIVA JUNTO A REDE CREDENCIADA CIMA SAÚDE</h3>
<br>
<table>
    <tr>
        <td class="no-borded" style="font-size: 14">Número da Proposta: <span><?=$proposta['numero']?></span></td>
        <td class="no-borded" style="font-size: 14">Data de Emissão: <span><?php echo formata_data_br($proposta['dt_contratacao']);?></span></td>
    <?php if($proposta['dt_alteracao'] != null){?>    
        <td class="no-borded" style="font-size: 14">Data de Alteração: <span><?php echo formata_data_br($proposta['dt_alteracao']);?></span></td>
    <?php } ?>
    </tr>
</table>
<br>
<p>Pelo presente Instrumento Particular de Prestação de Serviços de SAÚDE PREVENTIVA por agendamento de Procedimentos Médicos e Odontológicos junto a Rede Credenciada <b>CIMA SAÚDE</b>, e na melhor forma de direito, as partes a saber: 
<br><br><b>1) NISHIMURA SERVICOS MEDICOS E ODONTOLOGICOS LTDA</b>, nome fantasia <b>“CIMA SAÚDE”</b>, pessoa jurídica de direito privado com sede à Rua Euclides da Cunha, 1055, Vila Moraes, na cidade de Ourinhos/SP, <b>CNPJ: 10.965.987/0001-32</b> por seu representante legal infra firmado, doravante denominada CONTRATADA e de outro lado;
<br><br><b>2) Contratante:</b></p>

    
    <table>
        <tr>
            <td colspan="4"><h5>DADOS GERAIS</h5></td>
        </tr>    
        <tr>
            <td colspan="2"><b>Nome:</b> <?=$cliente['nome']?></td>
            <td><b>CPF: </b><?=$cliente['cpf']?></td>
            <td><b>RG: </b> <?=$cliente['rg']?></td>
        </tr>
        <tr>
            <td><b>Data Nasc.:</b><?=$cliente['data_nasc']?> </td>
            <td><b>Estado Civil:</b><?=convertEstadoCivil($cliente['estado_civil'])?></td>
            <td></td>
            <td></td>
        </tr>
        
        
        <tr>
            <td colspan="2"><b>Logradouro:</b> <?=$cliente['logradouro']?><b>, nº</b><?=$cliente['numero']?> <b>- Bairro:</b> <?=$cliente['bairro']?></td>
            <td><b>Complemento:</b><?=$cliente['complemento']?></td>
            <td><b>Cidade/Estado: </b><?=$cliente['cidade']?> <b>/</b> <?=$cliente['estado']?></td>
            
        </tr>
        
        <tr> 
            <td><b>Telefone:</b><?=$cliente['telefone']?></td>
            <td><b>Celular:</b><?=$cliente['celular']?></td>
            <td colspan="2"><b>E-mail:</b> <?=$cliente['email']?><b></td>
        <tr>
    </table>
    <br>
<?php if($plano['dependentes']){ ?>                       
    <table class="table table-bordered table-striped" >
        <thead> 
            <tr>
            <td colspan="3"> <h5>DEPENDENTES</h5><br></td>
            </tr> 
            <tr>
                <th>Nome</th>
                <th>Data Nasc.</th>
                <th>Parentesco</th>
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
        <?php } else {?>
            <tr>
                <td colspan="3" class="font-w600">Nenhum </td>
            </tr>
         <?php } ?>
        </tbody>
    </table>
<?php } ?>
<br>

<?php if($plano['agregados']){ ?>
    <table class="table table-bordered table-striped" >
        <thead> 
            <tr>
            <td colspan="3"> <h5>AGREGADOS</h5><br></td>
            </tr>  
            <tr>
                <th>Nome</th>
                <th>Data Nasc.</th>
                <th>Parentesco</th>
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
        <?php } else {?>
            <tr>
                <td colspan="3" class="font-w600">Nenhum </td>
            </tr>
         <?php } ?>
        </tbody>
    </table>
<?php } ?>

<br>
<?php if($plano['colaboradores']){ ?>

    <table class="table table-bordered table-striped" >
        <thead> 
            <tr>
            <td colspan="2"> <h5>COLABORADORES</h5><br></td>
            </tr>    
            <tr>
                <th>Nome</th>
                <th>Data Nasc</th>
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
        <?php } else {?>
            <tr>
                <td colspan="2" class="font-w600">Nenhum </td>
            </tr>
         <?php } ?>
        </tbody>
    </table>
<?php } ?>


<br>
<h4>CLÁUSULA PRIMEIRA – DO OBJETO DO CONTRATO:</h4> 
<p>1.   A prestação de serviços de saúde preventiva através da rede de profissionais prestando atendimento em especialidades médicas, odontológicas, fisioterapia, saúde familiar, saúde ocupacional e de exame de diagnósticos laboratoriais e de imagem ao TITULAR CONTRATANTE e seus dependentes pela rede profissional e independente credenciada pelo CIMA SAÚDE na modalidade de atendimento eletivo de livre escolha e pagamento pelo TITULAR CONTRATANTE,  diretamente aos profissionais prestadores de serviço credenciados.</p>

<br>
<h4>CLÁUSULA SEGUNDA – DA TAXA DE ADESÃO/ANUIDADE E RESTRIÇÕES POR NÃO PAGAMENTO</h4>
<p>1.   O TITULAR CONTRATANTE pagará uma taxa de adesão do plano <b><?=$plano['nome']?></b>, com validade de <b><?=convertCodigoValidadePlanosAnos($plano['validade'])?></b>, a quantia total de <b>R$ <?= formata_preco($proposta['pag_total'])?></b> para tornar-se apto a desfrutar dos serviços ofertados pela rede credenciada CIMA SAÚDE com a opção de pagamento <b><?=$proposta['modo']?></b>
<?php if($proposta['pag_texto'] != ""){?>
, pagos em: <?php echo '<b>' . $proposta['pag_texto']?>

 <?php } ?>.</p>
        

<p>2.      Após o pagamento da taxa de adesão e da primeira parcela da anuidade, o TITULAR CONTRATANTE receberá em até 15 dias a sua carteira de associado e a de seus DEPENDENTES que terá validade de  12 meses  e  dará acesso à  Rede Credenciada  CIMA SAÚDE, permitindo realizar agendamentos para atendimento(s) eletivo(s), consultas médicas, odontológicas e multiprofissionais, bem como, exames e procedimentos eletivos no(s) serviço(s) homologado(s) e autorizado(s) pela rede credenciada  CIMA SAÚDE.</p>

<p>3.   O atraso no pagamento da Taxa adesão/Anuidade superior a 15 (quinze) dias, implicará a critério da CONTRATADA, na suspensão automática dos serviços aqui contratados, sem prejuízo das penalidades previstas em Lei e no presente Contrato.</p>

<p>4.   Caso o TITULAR CONTRATANTE necessite da mudança da data de vencimento previamente estipulada ou a remissão do boleto de cobrança em função de extravio, será cobrado os valores de baixa e emissão de novo boleto de cada parcela.</p>

<p>5.   Na hipótese de persistir a inadimplência superior a 30 (trinta) dias o presente instrumento particular poderá ser rescindido ficando os valores já pagos como multa contratual.</p>

<br>
<h4>CLAÚSULA TERCEIRA – DO USO DA REDE CREDENCIADA CIMA SAÚDE:</h4>
<p>1.   O TITULAR CONTRATANTE estando em dia com o pagamento de sua anuidade poderá utilizar os serviços de agendamento de serviços de consultas médicas, odontológicas e multiprofissionais, bem como, de exames e procedimentos eletivos homologados e autorizados pela rede credenciada da CONTRATADA.</p>
<p>2.   O TITULAR CONTRATANTE pagará, diretamente ao profissional médico/dentista/multiprofissional da rede credenciada, o valor da consulta e/ou procedimento(s) e/ou exame(s), conforme consultado e orientado, previamente, por intermédio da Central de Atendimento Telefônico da CONTRATADA<p>

<br>
<h4>CLAÚSULA QUARTA – DA INCLUSÃO DE NOVOS DEPENDENTES.</h4>
<p>1.   Estabelecem as partes que poderão ser incluídos novos DEPENDENTES DO TITULAR CONTRATANTE após a celebração do presente Instrumento Particular desde que a anuidade esteja, rigorosamente, em dia.</p>
<p>2.   Pelo o ingresso de novo dependente será cobrado valor de Taxa/Anuidade proporcional ao prazo em aberto da validade do plano anual do titular através de boleto bancário a ser emitido pela CONTRATADA em nome do TITULAR CONTRATANTE. Somente será considerado apto para o atendimento na rede credenciada CIMA SAÚDE, após o pagamento da taxa/complementação da anuidade referente ao dependente incluso.</p>
<p>3.   Qualquer alteração em dados cadastrais do TITULAR CONTRATANTE ou de seus dependentes deverá ser informado à CONTRATADA para que esta mantenha atualizado seu cadastro de usuários perante a rede credenciada CIMA SAÚDE.</p>

<br>
<h4>CLAÚSULA QUINTA - DA VIGÊNCIA E RENOVAÇÃO</h4>
<p>1.   O prazo de vigência do presente instrumento será de 12 (doze) meses a contar do pagamento e compensação da 1ª parcela da Taxa/Anuidade, renovando-se automaticamente por períodos iguais e sucessivos, caso não haja manifestação expressa de qualquer uma das partes</p>
<p>2.   Os valores da taxa de adesão, anuidades e renovação de contratos serão corrigidos pela CONTRATADA a cada 12(doze) meses através da aplicação do Índice IGP –DI (Índice Geral de Preços – Disponibilidade Interna) divulgado pela Fundação Getúlio Vargas –FGV, ou no caso de sua extinção, por outro índice que melhor reflita a perda do poder aquisitivo da moeda nacional ocorrida no período. O valor da anuidade do plano vigente será comunicado ao TITULAR CONTRATANTE via correspondência escrita ou por e-mail, com antecedência de 30 (trinta) dias do seu vencimento contratual.</p>
<p>3.   O não cancelamento formal do presente contrato pelo TITULAR CONTRATANTE demonstra a intenção em que o mesmo seja automaticamente renovado, que autoriza a emissão dos boletos de pagamento da anuidade do novo período.</p>

<br>
<h4>CLAÚSULA SEXTA – DA RESCISÃO CONTRATUAL E MULTA </h4>
<p>1.   O não pagamento da Taxa de Adesão/Anuidade ou atrasos superior a 30 (trinta) dias no pagamento da parcela vencida acarretará na rescisão imediata do presente contrato com o bloqueio do uso pelo titular e seus dependentes da Rede Credenciada CIMA SAÚDE.</p> 
<p>2.   Qualquer uma das partes poderá solicitar a rescisão do presente instrumento particular, comunicando a outra parte com a antecedência mínima de 60 (sessenta) dias, de forma expressa. </p>
<p>3.   No caso de rescisão contratual comunicada e aceita, o TITULAR CONTRATANTE deverá imediatamente abster-se do uso da Rede Credenciada CIMA SAÚDE e entregar/inutilizar seus cartões de identificação, sob a pena de multa no valor da anuidade total ou ações legais cabíveis. </p>
<p>4.   A multa rescisória contratual é o valor da anuidade conforme plano contratado: individual ou familiar, devendo o TITULAR CONTRATANTE proceder com o pagamento integral dos valores em aberto ou responder judicialmente por sua cobrança legal, acrescido de custos advocatícios de 20% e demais despesas processuais. </p>

<br>
<h4>CLAÚSULA SÉTIMA – DISPOSIÇÕES GERAIS</h4>
<p>1.   A CONTRATADA não oferece diretamente, ao TITULAR CONTRATANTE serviços de assistência médica, odontológica ou multiprofissional, bem como a realização de exames ou quaisquer tratamentos, não garantindo de forma parcial ou integral, qualquer custo direto na utilização de serviços profissionais ou exames que não estejam homologados e autorizados pela Rede Credenciada CIMA SAÚDE.</p>
<p>2.   O TITULAR CONTRATANTE da ciência e concorda saber que é de sua única responsabilidade efetuar o pagamento das consultas; dos procedimentos médicos, odontológicos e multiprofissionais; e de exames, diretamente, aos profissionais e clínicas homologadas e autorizadas pela rede credenciada CIMA SAÚDE.</p>
<p>3.   O TITULAR CONTRANTE declara que tem consciência que o CIMA SAÚDE não é plano de saúde ou de intermediação médica, sendo uma rede privada de credenciamento e administração de profissionais que atuam no segmento de saúde preventiva e familiar. </p>
<p>4.   O presente termo de contrato é intransferível ficando sua renovação automática findo o prazo de 12 meses, sendo devido o pagamento de nova anuidade conforme enquadramento do plano utilizado: individual, casal, familiar para manter o direito de uso da Rede Credenciada CIMA SAÚDE.</p>
<p>5.   Mesmo que o TITULAR CONTRATANTE ou seus dependentes informados não venham a utilizar quaisquer dos serviços de consultas médicas, odontológicas e multiprofissionais de forma eletiva ou realização de serviços por parceiros homologados pela Rede Credenciada CIMA SAÚDE ficará, sem prejuízo anterior, obrigado a efetuar o pagamento de nova anuidade em parcela única ou a prazo para continuar a ter a sua disposição o direito de uso da rede credenciada.</p>
<p>6.   Eventuais alterações contratuais, exclusões, inclusões serão comunicado por correspondência enviada ou por correio eletrônico, sendo realizadas por termo aditivo.</p>

<br>
<h4>CLAÚSULA OITAVA – DO FORO:</h4>
<p>Estabelecem as partes que fica eleito o Foro da Comarca da cidade de Ourinhos/SP, com a renúncia de qualquer outro, por mais privilegiado que seja, dirimir qualquer questão decorrente deste instrumento particular.</p>
<p>E assim, por todos os esclarecimentos efetuados entre as partes, de forma justa e contratada, celebram o presente contrato em 2 vias de igual teor na presença de testemunhas abaixo qualificadas.</p>


<h5 style="color:black"><?=dataContrato('Ourinhos/SP', $proposta['dt_contratacao'])?></h5>


        <p>Contratante:  _______________________________________ &nbsp; &nbsp; &nbsp; Contradado(a):  ____________________________________________</p>        
    
        <p>Testemunha 1:  _______________________________________ &nbsp; &nbsp; &nbsp;
        Testemunha 2:  __________________________________________</p>        
</body>
</html>


