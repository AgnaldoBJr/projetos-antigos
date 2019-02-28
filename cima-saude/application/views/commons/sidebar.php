 <!-- Sidebar -->
 <?php
     $this->load->view('commons/head');

 ?>           
            <nav id="sidebar" style="background-image: linear-gradient(45deg, #015f95 , #08afd3);">
                <!-- Sidebar Scroll Container -->
                <div id="sidebar-scroll">
                    <!-- Sidebar Content -->
                    <!-- Adding .sidebar-mini-hide to an element will hide it when the sidebar is in mini mode -->
                    <div class="sidebar-content">
                    <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                            <button class="btn btn-link text-gray pull-right hidden-md hidden-lg" type="button" data-toggle="layout" data-action="sidebar_close">
                                <i class="fa fa-times"></i>
                            </button>
                        <!-- Side Header -->
                        <div  class="side-header side-content bg-white-op" style="background-image: linear-gradient(45deg, #015f95 , #08afd3);">
                            <!--Título Sidebar (Meu Caneco Dev)-->
                            <a class="h5 text-white" href="#">
                                <span class="h4 font-w400 sidebar-mini-hide"><img width="135px" style="text-align: center; margin-bottom: 7px; margin-left: 17px" src="<?=base_url('assets/img/cima/logo-png.png')?>"></span> 
                            </a>
                        </div>
                        <!-- END Side Header -->

                        <!-- Side Content -->
                        <div class="side-content" >
                            <ul class="nav-main">
                                <li>
                                   <a href="<?=base_url('dashboard');?>"><i class="fa fa-bars"></i><span class="sidebar-mini-hide">Dashboard</span></a>
                                </li>
                                
                                <li class="nav-main-heading"><span class="sidebar-mini-hide">Convênio</li>  
                                <li>
                                
                                            <li>
                                                <a href="<?=base_url('clientes');?>"><i class="fa fa-bars"></i>Clientes</a>
                                            </li>
                                            <li>
                                                <a href="<?=base_url('propostas');?>"><i class="fa fa-bars"></i>Propostas</a>
                                            </li>
                                             <li>
                                                <a href="<?=base_url('contratos');?>"><i class="fa fa-bars"></i>Contratos</a>
                                            </li>
                                            <li>
                                                <a href="<?=base_url('beneficiarios');?>"><i class="fa fa-bars"></i>Beneficiários</a>
                                            </li>
                                            
                                            <li>
                                                <a href="<?=base_url('parceiros');?>"><i class="fa fa-bars"></i>Parceiros</a>
                                            </li>
                                            
                                            
                                           
                                            
                                </li>


                                <li class="nav-main-heading"><span class="sidebar-mini-hide">Financeiro</span></li>
                                <li>
                                    
                                    <li>
                                        <a href="<?=base_url('contas-a-receber');?>"><i class="fa fa-bars"></i>Contas à Receber</a>
                                    </li>
                                    
                                    <li>
                                        <a href="<?=base_url('contas-a-pagar');?>"><i class="fa fa-bars"></i>Contas à Pagar</a>
                                    </li>
                                    <!--<li>
                                        <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-bars"></i><span class="sidebar-mini-hide">Relatórios</span></a>
                                        <ul>
                                               <li>
                                                    <a href="#">Nenhum</a>
                                                </li>
                                        </ul>
                                    </li>-->
                                           <li>
                                                <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-bars"></i><span class="sidebar-mini-hide">Outros</span></a>
                                                <ul>
                                                       <li>
                                                            <a href="<?=base_url('categorias-contas-a-receber');?>">Categoria de Contas à Receber</a>
                                                        </li>
                                                        <li>
                                                            <a href="<?=base_url('categorias-contas-a-pagar');?>">Categoria de Contas à Receber</a>
                                                        </li>
                                                     
                                                   
                                                </ul>
                                            </li>
                                     

                                </li>
                                <li class="nav-main-heading"><span class="sidebar-mini-hide">Relatórios</span></li>
                                            <li>
                                                <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-bars"></i><span class="sidebar-mini-hide">Relatórios</span></a>
                                                <ul>
                                                       <li>
                                                            <a href="<?=base_url('carteirinhas');?>">Carteirinhas</a>
                                                        </li>
                                                        <li>
                                                            <a href="<?=base_url('relatorio-contratos');?>">Contratos</a>
                                                        </li>
                                                        <li>
                                                            <a href="<?=base_url('relatorio-atrasados');?>">Atrasados</a>
                                                        </li>
                                                        <li>
                                                            <a href="<?=base_url('relatorio-contas');?>">Contas</a>
                                                        </li>
                                                   
                                                </ul>
                                            </li>
                                
                                

                                 <?php
                                    
                                    //--------------------------------------------------------------
                                    //MÓDULO DE CONFIGURAÇÕES DO SISTEMA
                                    for($i = 0; $i < count($this->session->userdata('permission')); $i++) {
                                        if(($this->session->userdata('permission')[$i]['fk_permissao'] == '1') || ($this->session->userdata('permission')[$i]['fk_permissao'] == '2')) {
                                    
                                ?>      
                                <li class="nav-main-heading"><span class="sidebar-mini-hide">Sistema</span></li>     
                                <li>
                                                <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-bars"></i><span class="sidebar-mini-hide">Outros</span></a>
                                                <ul>
                                                       <li>
                                                            <a href="<?=base_url('especialidades');?>">Especialidades</a>
                                                        </li>
                                                        <li>
                                                            <a href="<?=base_url('exames');?>">Exames</a>
                                                        </li>
                                                        <li>
                                                            <a href="<?=base_url('procedimentos');?>">Procedimentos</a>
                                                        </li>
                                                </ul>
                                            </li>
                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-bars"></i><span class="sidebar-mini-hide">Configurações</span></a>
                                    
                                    <ul>
                                        
                                        <?php
                                            //valida a permissão de Tipos de Usuário
                                            for($i = 0; $i < count($this->session->userdata('permission')); $i++)
                                                if($this->session->userdata('permission')[$i]['fk_permissao'] == '1') {
                                        ?>
                                           <li>
                                                <a href="<?=base_url('tipos-de-usuario');?>">Tipos de Usuário</a>
                                            </li>
                                        <?php } ?> 
                                        

                                        <?php
                                            //valida a permissão de Usuários
                                            for($i = 0; $i < count($this->session->userdata('permission')); $i++)
                                                if($this->session->userdata('permission')[$i]['fk_permissao'] == '2') {
                                        ?>
                                            <li>
                                                <a href="<?=base_url('usuarios-do-sistema');?>">Usuários do Sistema</a>
                                            </li>
                                        <?php } ?> 
                                    </ul>
                                </li>

                                <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-bars"></i><span class="sidebar-mini-hide">Convênio</span></a>
                                    <ul>
                                        <li>
                                            <a href="<?=base_url('planos');?>">Planos</a>
                                        </li>
                                        <li>
                                            <a href="<?=base_url('exames');?>">Exames</a>
                                        </li>
                                        <li>
                                            <a href="<?=base_url('servicos');?>">Serviços</a>
                                        </li>
                                        
                                        
                                    </ul>
                                </li>

                                 <li>
                                    <a class="nav-submenu" data-toggle="nav-submenu" href="#"><i class="fa fa-bars"></i><span class="sidebar-mini-hide">Cadastros Simples</span></a>
                                    <ul>
                                        <li>
                                            <a href="<?=base_url('especialidades');?>">Especialidades Médicas</a>
                                        </li>
                                        <li>
                                                <a href="<?=base_url('categorias-contas-a-receber');?>">Categorias de Contas a Receber</a>
                                            </li>
                                        <?php } ?> 
                                        <?php
                                            //valida a permissão de Categorias
                                            for($i = 0; $i < count($this->session->userdata('permission')); $i++)
                                                if($this->session->userdata('permission')[$i]['fk_permissao'] == '9') {
                                        ?>    
                                            <li>
                                                <a href="<?=base_url('categorias-contas-a-pagar');?>">Categorias de Contas a Pagar</a>
                                            </li>
                                        <?php } ?> 
                                        <?php
                                            //valida a permissão de Centros
                                            for($i = 0; $i < count($this->session->userdata('permission')); $i++)
                                                if($this->session->userdata('permission')[$i]['fk_permissao'] == '10') {
                                        ?>
                                            <li>
                                                <a href="<?=base_url('centro-de-lucro');?>">Centros de Lucro</a>
                                            </li>
                                        <?php } ?> 
                                        <?php
                                            //valida a permissão de Centros
                                            for($i = 0; $i < count($this->session->userdata('permission')); $i++)
                                                if($this->session->userdata('permission')[$i]['fk_permissao'] == '11') {
                                        ?>
                                            <li>
                                                <a href="<?=base_url('centro-de-custo');?>">Centros de Custo</a>
                                            </li>
                                        <?php } ?> 
                                       
                                            <li>
                                                <a href="<?=base_url('contas');?>">Contas</a>
                                            </li>
                                        
                                        
                                    </ul>
                                </li>
                               <?php } ?>

                            </ul>
                        </div>
                        <!-- END Side Content -->
                    </div>
                    <!-- Sidebar Content -->
                </div>
                <!-- END Sidebar Scroll Container -->
            </nav>
            <!-- END Sidebar -->
