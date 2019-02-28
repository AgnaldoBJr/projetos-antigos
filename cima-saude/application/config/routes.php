<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Acesso/index';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

//Rotas: Módulo de Configurações
//Tipos de Usuário
$route['tipos-de-usuario'] = 'c-sistema/TipoUsuario/index';
$route['tipos-de-usuario/novo'] = 'c-sistema/TipoUsuario/novo';
$route['tipos-de-usuario/salvar'] = 'c-sistema/TipoUsuario/salvar';
$route['tipos-de-usuario/atualizar/(:num)'] = 'c-sistema/TipoUsuario/atualizar/$1';
$route['tipos-de-usuario/delete'] = 'c-sistema/TipoUsuario/delete';
$route['tipos-de-usuario/alterar'] = 'c-sistema/TipoUsuario/alterar';

//Usuários do Sistema
$route['usuarios-do-sistema'] = 'c-sistema/UsuarioSistema/index';
$route['usuarios-do-sistema/novo'] = 'c-sistema/UsuarioSistema/novo';
$route['usuarios-do-sistema/salvar'] = 'c-sistema/UsuarioSistema/salvar';
$route['usuarios-do-sistema/atualizar/(:num)'] = 'c-sistema/UsuarioSistema/atualizar/$1';
$route['usuarios-do-sistema/delete'] = 'c-sistema/UsuarioSistema/delete';
$route['usuarios-do-sistema/alterar'] = 'c-sistema/UsuarioSistema/alterar';

//Rotas: Módulo cadastros
//Clientes
$route['clientes'] = 'c-cadastros/Cliente/index';
$route['clientes/novo'] = 'c-cadastros/Cliente/novo';
$route['clientes/atualizar/(:num)'] = 'c-cadastros/Cliente/atualizar/$1';
$route['clientes/delete'] = 'c-cadastros/Cliente/delete';

//Beneficiarios
$route['beneficiarios'] = 'c-cadastros/Beneficiario/index';
$route['beneficiarios/novo'] = 'c-cadastros/Beneficiario/novo';
$route['beneficiarios/alterar'] = 'c-cadastros/Beneficiario/alterar';
$route['beneficiarios/atualizar/(:num)/(:num)'] = 'c-cadastros/Beneficiario/atualizar/$1/$2';
$route['beneficiarios/delete'] = 'c-cadastros/Beneficiario/delete';
$route['beneficiarios/visualizar/(:num)/(:num)'] = 'c-cadastros/Beneficiario/visualizar/$1/$2';


$route['carteirinhas'] = 'c-cadastros/Carteirinhas/index';
$route['carteirinhas/relatorios'] = 'c-cadastros/Carteirinhas/relatorios';


//Fornecedores
$route['fornecedores'] = 'c-cadastros/Fornecedor/index';
$route['fornecedores/novo'] = 'c-cadastros/Fornecedor/novo';
$route['fornecedores/atualizar/(:num)'] = 'c-cadastros/Fornecedor/atualizar/$1';
$route['fornecedores/delete'] = 'c-cadastros/Fornecedor/delete';

//Colaboradores
$route['colaboradores'] = 'c-cadastros/Colaborador/index';
$route['colaboradores/novo'] = 'c-cadastros/Colaborador/novo';
$route['colaboradores/atualizar/(:num)'] = 'c-cadastros/Colaborador/atualizar/$1';
$route['colaboradores/delete'] = 'c-cadastros/Colaborador/delete';

//Pareiros
$route['parceiros'] = 'c-cadastros/Parceiro/index';
$route['parceiros/novo'] = 'c-cadastros/Parceiro/novo';
$route['parceiros/atualizar/(:num)'] = 'c-cadastros/Parceiro/atualizar/$1';
$route['parceiros/delete'] = 'c-cadastros/Parceiro/delete';
$route['parceiros/novoPDF/(:num)'] = 'c-cadastros/Parceiro/novoPDF/$1';
$route['parceiros/visualizar/(:num)'] = 'c-cadastros/Parceiro/visualizar/$1';


//Franqueados
$route['franqueados'] = 'c-cadastros/Franqueado/index';
$route['franqueados/novo'] = 'c-cadastros/Franqueado/novo';
$route['franqueados/atualizar/(:num)'] = 'c-cadastros/Franqueado/atualizar/$1';
$route['franqueados/delete'] = 'c-cadastros/Franqueado/delete';

//Rotas: Módulo Processos

//Guias
$route['guias'] = 'c-processos/Guia/index';
$route['guias/novo'] = 'c-processos/Guia/novo';
$route['guias/atualizar/(:num)'] = 'c-processos/Guia/atualizar/$1';
$route['guias/atualizar-status'] = 'c-processos/Guia/atualizarStatus';
$route['guias/delete'] = 'c-processos/Guia/delete';
$route['guias/salvar'] = 'c-processos/Guia/salvar';
$route['guias/visualizar/(:num)'] = 'c-processos/Guia/visualizar/$1';
$route['guias/relatorios'] = 'c-processos/Guia/relatorios';
$route['guias/novoPDF/(:num)'] = 'c-processos/Guia/novoPDF/$1';



//Serviços
$route['servicos'] = 'c-processos/Servico/index';
$route['servicos/novo'] = 'c-processos/Servico/novo';
$route['servicos/salvar'] = 'c-processos/Servico/salvar';
$route['servicos/atualizar/(:num)'] = 'c-processos/Servico/atualizar/$1';
$route['servicos/delete'] = 'c-processos/Servico/delete';
$route['servicos/todos'] =  'c-processos/Servico/todos';
$route['servicos/parceiros/(:num)'] =  'c-processos/Servico/byParceiro/$1';

//Exames
$route['exames'] = 'c-processos/Exame/index';
$route['exames/novo'] = 'c-processos/Exame/novo';
$route['exames/atualizar'] = 'c-processos/Exame/atualizar';
$route['exames/delete'] = 'c-processos/Exame/delete';

//Especialidades
$route['procedimentos'] = 'c-outros/Procedimento/index';
$route['procedimentos/novo'] = 'c-outros/Procedimento/novo';
$route['procedimentos/atualizar'] = 'c-outros/Procedimento/atualizar';
$route['procedimentos/delete'] = 'c-outros/Procedimento/delete';


//Pós-Atendimento
$route['pos-atendimento'] = 'c-processos/PosAtendimento/index';
$route['pos-atendimento/novo'] = 'c-processos/PosAtendimento/novo';
$route['pos-atendimento/atualizar'] = 'c-processos/PosAtendimento/atualizar';
$route['pos-atendimento/delete'] = 'c-processos/PosAtendimento/delete';
$route['pos-atendimento/relatorios'] = 'c-processos/PosAtendimento/relatorios';

//Módulo: Outros
//Especialidades
$route['especialidades'] = 'c-outros/Especialidade/index';
$route['especialidades/novo'] = 'c-outros/Especialidade/novo';
$route['especialidades/atualizar'] = 'c-outros/Especialidade/atualizar';
$route['especialidades/delete'] = 'c-outros/Especialidade/delete';


//Rotas: Módulo contratos
//Planos
$route['planos'] = 'c-contratos/Plano/index';
$route['planos/novo'] = 'c-contratos/Plano/novo';
$route['planos/atualizar/(:num)'] = 'c-contratos/Plano/atualizar/$1';
$route['planos/delete'] = 'c-contratos/Plano/delete';

//Propostas
$route['propostas'] = 'c-contratos/Proposta/index';
$route['propostas/novo'] = 'c-contratos/Proposta/novo';
$route['propostas/atualizar/(:num)'] = 'c-contratos/Proposta/atualizar/$1';
$route['propostas/update'] = 'c-contratos/Proposta/update';
$route['propostas/delete'] = 'c-contratos/Proposta/delete';
$route['propostas/ganhar'] = 'c-contratos/Proposta/ganhar';
$route['propostas/pagamento'] = 'c-contratos/Proposta/pagamento';
$route['propostas/contratar'] = 'c-contratos/Proposta/contratar';
$route['propostas/visualizar/(:num)'] = 'c-contratos/Proposta/visualizar/$1';
$route['propostas/novoPDF/(:num)'] = 'c-contratos/Proposta/novoPDF/$1';
$route['propostas/novoContratoPDF/(:num)'] = 'c-contratos/Proposta/novoContratoPDF/$1';
$route['enviar-email'] = "c-contratos/Proposta/enviarEmail";


//Contratos
$route['contratos'] = 'c-contratos/Contratos/index';
//$route['contratos/novo'] = 'c-contratos/Contratos/novo';
//$route['contratos/atualizar/(:num)'] = 'c-contratos/Contratos/atualizar/$1';
//$route['contratos/update'] = 'c-contratos/Contratos/update';
//$route['contratos/delete'] = 'c-contratos/Contratos/delete';
$route['contratos/visualizar/(:num)'] = 'c-contratos/Contratos/visualizar/$1';
$route['contratos/novoPDF/(:num)'] = 'c-contratos/Contratos/novoPDF/$1';
//$route['contratos/novoContratoPDF/(:num)'] = 'c-contratos/Contratos/novoContratoPDF/$1';
$route['contratos/relatorios'] = 'c-contratos/Contratos/relatorios';

//Rotas: Módulo financeiro
//Exames
$route['contas'] = 'c-Financeiro/Contas/index';
$route['contas/novo'] = 'c-Financeiro/Contas/novo';
$route['contas/atualizar'] = 'c-Financeiro/Contas/atualizar';
$route['contas/delete'] = 'c-Financeiro/Contas/delete';

$route['contas-a-pagar'] = 'c-financeiro/ContaPagar/index';
$route['contas-a-pagar/novo'] = 'c-financeiro/ContaPagar/novo';
$route['contas-a-pagar/salvar'] = 'c-financeiro/ContaPagar/salvar';
$route['contas-a-pagar/atualizar/(:num)'] = 'c-financeiro/ContaPagar/atualizar/$1';
$route['contas-a-pagar/delete'] = 'c-financeiro/ContaPagar/delete';
$route['contas-a-pagar/alterar'] = 'c-financeiro/ContaPagar/alterar';
$route['contas-a-pagar/status/(:num)/(:num)'] = 'c-financeiro/ContaPagar/status/$1/$2';

$route['contas-a-receber'] = 'c-financeiro/ContaReceber/index';
$route['contas-a-receber/novo'] = 'c-financeiro/ContaReceber/novo';
$route['contas-a-receber/salvar'] = 'c-financeiro/ContaReceber/salvar';
$route['contas-a-receber/atualizar/(:num)'] = 'c-financeiro/ContaReceber/atualizar/$1';
$route['contas-a-receber/delete'] = 'c-financeiro/ContaReceber/delete';
$route['contas-a-receber/alterar'] = 'c-financeiro/ContaReceber/alterar';
$route['contas-a-receber/status/(:num)/(:num)'] = 'c-financeiro/ContaReceber/status/$1/$2';

$route['centro-de-custo'] = 'c-financeiro/CentroCusto/index';
$route['centro-de-lucro'] = 'c-financeiro/CentroLucro/index';
$route['categorias-contas-a-pagar'] = 'c-financeiro/CategoriaContaPagar/index';
$route['categorias-contas-a-receber'] = 'c-financeiro/CategoriaContaReceber/index';

$route['dashboard'] = 'c-sistema/Dashboard/index';
$route['dashboard/relatorio'] = 'c-sistema/Dashboard/relatorioDiario';
$route['dashboard/demonstrativo-mensal'] = 'c-sistema/Dashboard/demonstrativoMensal';
$route['dashboard/demonstrativo-semanal'] = 'c-sistema/Dashboard/demonstrativoSemanal';
$route['dashboard/proximos-lancamentos'] = 'c-sistema/Dashboard/proximosLancamentos';
$route['dashboard/contas-receber'] = 'c-sistema/Dashboard/contasReceber';
$route['dashboard/contas-pagar'] = 'c-sistema/Dashboard/contasPagar';
$route['dashboard/contas-a-pagar/status/(:num)/(:num)'] = 'c-sistema/Dashboard/statusPagar/$1/$2';
$route['dashboard/contas-a-receber/status/(:num)/(:num)'] = 'c-sistema/Dashboard/statusReceber/$1/$2';


$route['dashboard/demonstrativo-mensal-pesquisa/(:num)'] = 'c-sistema/Dashboard/demonstrativoMensalWithMonth/$1';




//Rotas: Relatórios
$route['propostas/relatorios'] = 'c-contratos/Proposta/relatorios';
$route['contratos/relatorios'] = 'c-contratos/Contratos/relatorios';
$route['carteirinhas/relatorios'] = 'c-cadastros/Carteirinhas/relatorios';
$route['clientes/relatorios'] = 'c-cadastros/Cliente/relatorios';
$route['parceiros/relatorios'] = 'c-cadastros/Parceiro/relatorios';
$route['contas-a-pagar/relatorios'] = 'c-financeiro/ContaPagar/relatorios';
$route['contas-a-receber/relatorios'] = 'c-financeiro/ContaReceber/relatorios';

//Rotas: Módulo de Atendimento
$route['atendimento/beneficiarios'] = 'c-atendimento/BeneficiariosAtendimento/index';
$route['atendimento/beneficiarios/contar'] = 'c-atendimento/BeneficiariosAtendimento/contar';
//$route['atendimento/beneficiarios/visualizar/(:num)/(:num)'] = 'c-atendimento/ClientesAtendimento/visualizar/$1/$2';
//$route['atendimento/beneficiarios/alterar'] = 'c-atendimento/ClientesAtendimento/alterar';


//Perfil
$route['atendimento/perfil/(:num)'] = 'c-atendimento/PerfilAtendimento/atualizar/$1';
$route['atendimento/perfil/alterar'] = 'c-atendimento/PerfilAtendimento/alterar';

//---------------------------------------------------------------------------
//Módulo: Agenda
$route['agenda-cima'] = 'c-agenda/Agenda/index';


//Módulo: Relatórios
$route['relatorio-contratos'] = 'c-relatorios/Relatorios/contratos';
$route['relatorio-atrasados'] = 'c-relatorios/Relatorios/atrasados';
$route['relatorio-contas'] = 'c-relatorios/Relatorios/contas';
$route['relatorios/contratos'] = 'c-relatorios/Relatorios/relatorioContratos';
$route['relatorios/contratos/este-mes'] = 'c-relatorios/Relatorios/esteMesContratos';
$route['relatorios/contratos/esta-semana'] = 'c-relatorios/Relatorios/estaSemanaContratos';

//---------------------------------------------------------------------------
//Acesso
$route['agenda'] = 'c-agenda/AcessoAgenda';
$route['agenda/login'] = 'c-agenda/AcessoAgenda/login';
$route['agenda/logout'] = 'c-agenda/AcessoAgenda/logout';
$route['agenda/(:any)'] = 'c-agenda/AcessoAgenda/login';



$route['atendimento'] = 'c-atendimento/AcessoAtendimento/login';
$route['atendimento/login'] = 'c-atendimento/AcessoAtendimento/login';
$route['atendimento/logout'] = 'c-atendimento/BeneficiariosAtendimento/logout';
$route['atendimento/(:any)'] = 'c-atendimento/AcessoAtendimento/login';
//Rotas: Módulo de acesso - Default
$route['login'] = 'Acesso/login';
$route['(:any)'] = 'Acesso/index';