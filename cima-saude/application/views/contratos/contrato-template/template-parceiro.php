<?php
defined('BASEPATH') OR exit('No direct script access allowed');
$this->load->helper('funcoes');

//$this->load->view('commons/head');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Contrato Cima Saúde</title>

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
<h3>CONTRATO DE PARCERIA DA PRESTAÇÃO DE SERVIÇOS </h3>
<br>

<br>
<p>Pelo presente instrumento e na melhor forma de direito, de um lado como CONTRATANTE, a empresa <b>NISHIMURA SERVICOS MEDICOS E ODONTOLOGICOS LTDA. - EPP</b>, pessoa jurídica de direito privado, inscrita no CNPJ sob o nº. <b>10.965.987/0001-32</b>, situada em Ourinhos, Estado de São Paulo, na Rua Euclides da Cunha n°. 1055, CEP 19.900-043, neste ato representada por seu sócio-administrador Sr. <b>ALEXANDRE DA SILVA NISHIMURA</b>, brasileiro, casado, médico, inscrito no CPF sob o nº. <b>283.057.848-19</b>, portador da carteira de identidade RG nº. 27.780.805-4 SSP/SP, residente e domiciliado em Ourinhos, Estado de São Paulo, na Rua João Moya Restoy nº. 999, Jardim Paulista, CEP 19.906-425, e de outro lado o(a)

<?php if($doc != 'cnpj') {?> Sr(a). <b><?=$parceiro['nome']?></b>, <!--brasileiro, casado,--> <?=$parceiro['tipo']?><?php if($parceiro['texto'] != '') echo ', especialidade(s) ' . $parceiro['texto']?>; inscrito no CPF sob o nº. <b><?=$parceiro['cpf']?></b> e <?=$doc?> nº. <b><?=$parceiro['identificacao']?></b>, portador da carteira de identidade RG nº. <?=$parceiro['rg']?>, residente e domiciliado na cidade <?=$parceiro['cidade']?>, Estado de <?=$parceiro['estado']?>, <?=$parceiro['logradouro']?> nº. <?=$parceiro['numero']?>, no bairro <?=$parceiro['bairro']?>, CEP <?=$parceiro['cep']?>, doravante denominado CONTRATADO, tem entre si ajustado o Contrato de Parceria, que se regerá pelas cláusulas e condições a seguir transcritas, as quais são, desde já, mutuamente aceitas: <?php } else { ?> <?=$parceiro['tipo']?> <b><?=$parceiro['nome']?></b> inscrito no CNPJ sob o nº. <b><?=$parceiro['cnpj']?></b> situado(a) na cidade <?=$parceiro['cidade']?>, Estado de <?=$parceiro['estado']?>, <?=$parceiro['logradouro']?> nº. <?=$parceiro['numero']?>, no bairro <?=$parceiro['bairro']?>, CEP <?=$parceiro['cep']?>, doravante denominado CONTRATADO, tem entre si ajustado o <b>Contrato de Parceria</b>, que se regerá pelas cláusulas e condições a seguir transcritas, as quais são, desde já, mutuamente aceitas:


    <?php } ?></p>

<br>
<h4>CLÁUSULA 1ª. – DO OBJETO DA CONTRATAÇÃO </h4> 
<p>Pelo presente instrumento, o CONTRATADO se compromete a prestar aos beneficiários indicados pela CONTRATANTE, serviços de assistência médica em seu consultório particular na cidade de Ourinhos/SP (endereço), de acordo com suas habilidades, instalações, especialidades e disponibilidades técnico-profissionais, observando os padrões estabelecidos pelos órgãos de classe e instituições de fiscalização profissional em geral.</p>
<p><b>§1º</b>. - Ficam as partes cientes que o presente instrumento não se trata de relação estabelecida entre operadora de plano de saúde e médico, não gerando obrigações e responsabilidades dessa natureza. </p>
<p><b>§2º</b>º. - Os serviços serão prestados pelo CONTRATADO aos beneficiários da CONTRATANTE prioritariamente para: </p>
<p>I - casos de urgência e emergência; <br>
II - associados com 60 (sessenta) anos ou mais de idade; <br>
III - gestantes; <br>
IV – lactantes.  <br>
</p>

<br>
<h4>CLÁUSULA 2ª. - DO PRAZO CONTRATUAL </h4>

<p>O prazo de vigência desse contrato é de 12 (doze) meses a partir da assinatura do instrumento, sendo renovado, automaticamente, por prazo indeterminado, após o período inicial de vigência, caso não haja manifestação em contrário. </p>

<br>
<h4>CLÁUSULA 3ª. – DOS BENEFICIÁRIOS </h4>
<p>São considerados beneficiários, para os fins do presente contrato, somente as pessoas titulares e dependentes credenciadas pela CONTRATANTE, identificados mediante apresentação dos seguintes documentos: </p>
<p>I - carteira de identificação do beneficiário emitida pela CONTRATANTE; <br>
II - documento pessoal de identificação do beneficiário com foto. 
<p>

<br>
<h4>CLÁUSULA 4ª. - DAS CONSULTAS MÉDICAS, PROCEDIMENTOS E EXAMES AMBULATORIAIS </h4>
<p>O valor das consultas, procedimentos e exames ambulatoriais será definido pela Tabela de Preços a ser pactuada, anualmente, entre CONTRATANTE e CONTRATADO, obrigando-se este a respeitá-la, integralmente, sob pena de rescisão, sem prejuízo da indenização cabível. </p>
<p><b>§1º</b>. – O pagamento das consultas, procedimentos e exames ambulatoriais será efetuado pelo beneficiário da CONTRATANTE diretamente ao CONTRATADO no ato da realização dos mesmos. </p>

<br>
<h4>CLÁUSULA 5ª. – DOS SERVIÇOS </h4>
<p>Os serviços serão prestados em regime ambulatorial. </p>
<p><b>§1º</b>. - Na prestação dos serviços será dispensado aos beneficiários da CONTRATANTE o mesmo tratamento concedido aos demais pacientes do CONTRATADO, realizado com padrões técnicos e de conforto material sem qualquer distinção; </p>
<p><b>§2º</b>. - Ficam taxativamente excluídos deste contrato, para todos os fins e efeitos, quaisquer tratamentos ou consultas que requeiram internação hospitalar ou atendimento domiciliar; </p>

<br>
<h4>CLÁUSULA 6ª. - DO LOCAL DA PRESTAÇÃO DE SERVIÇOS  </h4>
<p>Os serviços serão prestados pelo CONTRATADO no endereço indicado na cláusula 1ª. em horários previamente agendados. </p> 
<p><b>§1º</b>. - O CONTRATADO poderá desmarcar a consulta, caso não possa atender naquele dia e/ou horário, adiando-a ou antecipando-a, desde que comunique o fato ao beneficiário. O beneficiário também poderá reagendar seu atendimento de acordo com a disponibilidade do CONTRATADO. </p>
<p><b>§2º</b>. - Consultas domiciliares ou em estabelecimentos hospitalares de saúde, fora do especificado como endereço de atendimento, bem como atendimentos de urgência ou emergência, poderão ser realizados, mediante contraprestação específica, cujos valores serão acordados entre CONTRATADO e beneficiário. </p>

<br>
<h4>CLÁUSULA 7ª. – DOS DEVERES DA CONTRATANTE </h4>
<p>A CONTRATANTE fica obrigada a: </p>
<p>I - dar conhecimento aos beneficiários das obrigações e responsabilidades que lhes cabem acerca dos serviços objeto deste contrato; </p>
<p>II - fornecer identificação ao beneficiário, através de cartão de identificação e/ou autorização de serviços médicos, a fim de que possa se valer dos direitos ora convencionados junto ao CONTRATADO, o qual será apresentado ao CONTRATADO na ocasião do atendimento, acompanhada de documento pessoal; </p>
<p>III - informar previamente o CONTRATADO sobre toda e qualquer anormalidade que possa influir no atendimento de beneficiários. </p>


<br>
<h4>CLÁUSULA 8ª. – DOS DEVERES DO CONTRATADO </h4>
<p>São deveres do CONTRATADO: </p>
<p>I - agendar consultas, procedimentos e exames ambulatoriais no prazo máximo de 30 (trinta) dias corridos contados da solicitação efetuada pelo beneficiário; </p>
<p>II - O prazo acima indicado somente poderá ser descumprido em caso de motivo justo, urgência ou emergência e impossibilidade comprovada de realizá-lo, devendo o CONTRATADO, nessas situações, comunicar à CONTRATANTE no prazo de até 48 (quarenta e oito) horas contados do impedimento. Férias e eventos previsíveis deverão ser comunicados à CONTRATANTE com o prazo mínimo de 30 (trinta) de antecedência. </p>
<p>III - observar como retorno de consulta, o prazo máximo de 21 (vinte e um) dias, a partir de quando poderá ser cobrada nova consulta;</p>
<p>IV -  não delegar ou transferir a terceiros a prestação de serviços ora pactuados, sem prévia autorização, por escrito, da CONTRATANTE; </p>
<p>V - agir com o máximo de zelo e respeito, utilizando o melhor de sua capacidade profissional na atenção à saúde do beneficiário da CONTRATANTE; </p>
<p>VI - guardar sigilo a respeito das informações de que detenha conhecimento sobre o beneficiário da CONTRATANTE, com exceção dos casos previstos em lei; </p>
<p>VII - cumprir o presente contrato, valendo-se das práticas cientificamente reconhecidas, respeitados a legislação vigente e os preceitos éticos;</p>
<p>VIII - manter o consultório em condições dignas, dotado dos equipamentos médicos necessários e pertinentes à área de sua atuação, em perfeitas condições de uso e de higiene; </p>
<p>IX - observar com rigor os preceitos editados pelo Conselho Federal de Medicina e constantes do Código de Ética Médica. </p>



<br>
<h4>CLÁUSULA 9ª. – DAS RESPONSABILIDADES </h4>
<p>Todos os fatos de natureza conflituosa que vierem a ocorrer no interior dos consultórios e demais dependências, a isso se aplica questões como: atendimento com erros técnicos, reclamações sobre atrasos e faltas, falta de cordialidade no atendimento, orientações clínicas equivocadas, comportamento ético incompatível, assédio moral e sexual, administração e/ou prescrição de medicamentos incorretos, falta de higienização do profissional para o exercício do seu trabalho, complicações decorrentes de tratamento e/ou procedimentos, entre outros de mesma natureza, serão sempre de única, inteira e exclusiva responsabilidade, em todas as esferas, do CONTRATADO. </p>

<br>
<h4>CLÁUSULA 10ª. – DA APRESENTAÇÃO DE RELATÓRIO </h4>
<p>O CONTRATADO apresentará à CONTRATANTE, mensalmente, até o dia 05 (cinco) do mês subsequente ao vencido, a relação de atendimentos prestados no mês anterior.</p>

<br>
<h4>CLÁUSULA 11ª. - DA RESCISÃO </h4>
<p>A qualquer tempo as partes poderão resilir unilateralmente o presente CONTRATO, mesmo antes de findo o prazo contratual inicial de 12 (doze) meses. Nessa hipótese, a parte interessada deverá solicitar a rescisão por escrito, com pelo menos 30 (trinta) dias de antecedência. </p>
<p><b>§1º</b> - O presente contrato também poderá ser rescindido de pleno direito, independentemente de qualquer aviso, interpelação ou notificação judicial ou extrajudicial, nos casos a seguir enumerados, sem prejuízo de outros previstos em lei ou no presente contrato, em caso de: </p>
<p>I – negativa imotivada de atendimento ao beneficiário, sem prévia notificação à CONTRATANTE; </p> 
<p>II - paralisação dos serviços sem prévio e expresso consentimento da CONTRATANTE; </p>
<p>III - transferência total ou parcial deste instrumento, a subcontratação do objeto contratual, a associação com outrem, a cisão, fusão ou incorporação que afete a boa execução deste contrato, sem prévia anuência da CONTRATANTE; </p>
<p>IV – falência, insolvência, dissolução ou liquidação; </p>
<p>V - descumprimento de qualquer cláusula e/ou condição contratual; </p>
<p><b>§2º</b>. - Na hipótese de rescisão do presente instrumento por qualquer das partes contratantes, fica: </p>
<p>I - o CONTRATADO obrigado a: <br>
a) informar no prazo de 10 (dez) dias, contados da data do recebimento da notificação, a relação dos pacientes que estão em tratamento continuado; <br>
b) manter a assistência aos beneficiários já cadastrados até a data estabelecida para encerramento da prestação de serviço; <br>
c) disponibilizar as informações necessárias à continuidade do tratamento com outro profissional de saúde credenciado a CONTRATANTE, desde que requisitado pelo paciente.</p>

<br>
<h4>CLÁUSULA 12ª. – DAS PENALIDADES </h4>
<p>O descumprimento de qualquer cláusula ou dispositivo deste instrumento sujeita o CONTRATADO a exclusão da relação do quadro de prestadores de serviço da CONTRATANTE, sem prejuízo das indenizações por perdas e danos devidas em virtude da violação. </p>
<p><b>Parágrafo Único</b> - Eventual tolerância em relação a qualquer infração ou inadimplência cometida pela outra parte, em relação a qualquer cláusula ou outra obrigação contemplada pelo presente contrato, será considerada como mera liberalidade e não constituirá perdão, renúncia, nem novação de quaisquer direitos ou obrigações, nem tampouco alteração tácita do presente instrumento, podendo a parte tolerante, a qualquer tempo, exigir da outra o fiel cumprimento das obrigações aqui assumidas pela outra parte.</p>

<br>
<h4>CLÁUSULA 13ª. - DOS ENCARGOS </h4>
<p>O CONTRATADO será responsável por todos os encargos de natureza tributária incidentes sobre os valores dos serviços prestados, bem como pelas obrigações trabalhistas, previdenciárias, fiscais e quaisquer outras existentes ou que venham a ser criadas, relativamente a seus empregados. </p>

<br>
<h4>CLÁUSULA 14ª. - DO VÍNCULO </h4>
<p>O presente contrato não gera vínculo empregatício, de qualquer natureza, entre o CONTRATADO e a CONTRATANTE. </p>

<br>
<h4>CLÁSULA 15ª. – DA AUSÊNCIA DE EXCLUSIVIDADE </h4>
<p>O presente contrato não é gravado com cláusula de exclusividade, como também de restrição à atividade profissional, ficando livre o CONTRATADO para continuar a atender em seu domicílio profissional, pacientes particulares, bem como beneficiários de operadoras de planos de saúde e outros convênios públicos ou privados, na forma que melhor lhe convier. </p>

<br>
<h4>CLÁUSULA 16ª. – DA DIVULGAÇÃO, PUBLICIDADE E PROPAGANDA </h4>
<p>O CONTRATADO, desde já, autoriza a divulgação de seu nome e dos seus serviços em campanhas publicitárias promovidas pela CONTRATANTE, em seu Manual e outros meios que julgar necessário. </p>
<p>Parágrafo único - O CONTRATADO declara-se ciente e de pleno acordo de que a CONTRATANTE fará apenas a divulgação de serviços, mas caberá exclusivamente ao beneficiário fazer a escolha do prestador de serviços médicos que melhor lhe convier. </p>

<br>
<h4>CLÁUSULA 17ª. – DAS OBRIGAÇÕES GERAIS </h4>
<p>§1º. - Qualquer alteração das cláusulas estipuladas neste contrato somente poderá ser efetivada mediante Aditivo Contratual, sendo que sua validade dependerá da anuência expressa de ambas as partes. </p>
<p>§2º. - Caso a CONTRATANTE venha a ser acionada judicialmente em decorrência de qualquer desses atendimentos, fica-lhe assegurado o direito de regresso, nos termos da lei, em face do CONTRATADO, por quaisquer indenizações ou pagamentos que lhe venha a ser impostos, inclusive por custas, despesas processuais e honorários advocatícios, sem prejuízo dela CONTRATANTE requerer indenização pelos danos causados ao seu nome e à sua imagem. </p>
<p>§2º. - Caso a CONTRATANTE venha a ser acionada judicialmente em decorrência de qualquer desses atendimentos, fica-lhe assegurado o direito de regresso, nos termos da lei, em face do CONTRATADO, por quaisquer indenizações ou pagamentos que lhe venha a ser impostos, inclusive por custas, despesas processuais e honorários advocatícios, sem prejuízo dela CONTRATANTE requerer indenização pelos danos causados ao seu nome e à sua imagem. </p>
<p>§3º. - Os casos omissos serão resolvidos, de comum acordo, entre as partes contratantes. </p>

<br>
<h4>CLÁUSULA 18ª. – DO REGISTRO DO CONTRATO </h4>
<p>As despesas de registro junto às autoridades cartoriais, em sendo de desejo das partes, referente ao presente contrato, são de responsabilidade da CONTRATANTE. </p>

<br>
<h4>CLÁUSULA 19ª. – DO FORO </h4>
<p>Para dirimir toda e qualquer dúvida porventura suscitada na execução deste contrato fica eleito o Foro da Comarca de Ourinhos/SP. </p>
<p>E por estarem assim justas e contratadas as partes assinam o presente instrumento com 8 (oito) páginas em 2 (duas) vias, de igual teor e para o mesmo fim, conjuntamente com as duas testemunhas também signatárias, prometendo fazê-lo sempre em bom e válido, por si e por seus sucessores. </p>
<br>
<br>
<h5 style="color:black"><?=dataContrato('Ourinhos/SP', $parceiro['data'])?></h5>


      
    <div>
        <div style="width: 45%; float:left;">
            <p>Contratado(a):  <br> _______________________________________________________</p>
        </div>
        <div style="width: 45%; float: right;">
            <p>Contratante:  <b>NISHIMURA SERVICOS MEDICOS E ODONTOLOGICOS LTDA. - EPP </b> </p>      
        </div>
    </div>
<br><br>
    <div>
        <div style="width: 45%; float:left;">
            <p>Testemunha 1:  _______________________________________<br>
            CPF:<br>
            RG:</p>
        </div>
        <div style="width: 45%; float: right;">
            <p>Testemunha 2:  _______________________________________<br>
            CPF:<br>
            RG:</p>
        </div>
    </div>
</body>
</html>


