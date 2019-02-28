            <!-- Header -->
            <header id="header-navbar" class="content-mini content-mini-full" style="background: #00518b">
               
        
                <a href="<?=base_url('atendimento/logout');?>" style="margin-top: 10px" class="btn btn-default pull-right" type="button">
                    <i class="si si-login pull-right"></i>Logout
                </a>
                <!-- Header Navigation Left -->
                <ul class="nav-header pull-left">
                    <li class="hidden-md hidden-lg">
                        <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                        <button class="btn btn-default" data-toggle="layout" data-action="sidebar_toggle" type="button">
                            <i class="fa fa-navicon"></i>
                        </button>
                    </li>
                    <li class="">
                        <!-- Layout API, functionality initialized in App() -> uiLayoutApi() -->
                        <img src="<?=base_url('assets/img/cima/logo-png.png')?>" height="50px">
                        
                    </li>
                    <!--
                    <li class="" style="margin-left: 120px; margin-top: 20px;">
                        <a href="<?//=base_url('atendimento/clientes');?>"><h5 style="color: white; font-weight: 400">Beneficiários</h5></a>
                        
                    </li>

                    <li class="" style="margin-left: 20px; margin-top: 20px;">
                        <a href="<?//=base_url('atendimento/atendimentos');?>"><h5 style="color: white; font-weight: 400">Atendimentos</h5></a>
                    </li>

                    <li class="" style="margin-left: 20px; margin-top: 20px;">
                        <a href="<?//=base_url('atendimento/servicos');?>"><h5 style="color: white; font-weight: 400">Serviços</h5></a>
                    </li>
                    <li class="" style="margin-left: 20px; margin-top: 20px;">
                        <a href="<?//=base_url('atendimento/exames');?>"><h5 style="color: white; font-weight: 400">Exames</h5></a>
                    </li>
                    <li class="" style="margin-left: 20px; margin-top: 20px;">
                        <a href="<?//=base_url('atendimento/perfil/' . $this->session->userdata('id'));?>"><h5 style="color: white; font-weight: 400">Perfil</h5></a>
                    </li>
-->

                    <!--<li class="hidden-xs hidden-sm">
                         Layout API, functionality initialized in App() -> uiLayoutApi()
                        <button class="btn btn-default" data-toggle="layout" data-action="sidebar_mini_toggle" type="button">
                            <i class="fa fa-ellipsis-v"></i>
                        </button>
                    </li>-->
                    
                    <!--<li class="visible-xs">
                         Toggle class helper (for .js-header-search below), functionality initialized in App() -> uiToggleClass() 
                        <button class="btn btn-default" data-toggle="class-toggle" data-target=".js-header-search" data-class="header-search-xs-visible" type="button">
                            <i class="fa fa-search"></i>
                        </button>
                    </li>-->
                    <!--
                    <li class="js-header-search header-search">
                        <form class="form-horizontal" action="start_backend.html" method="post">
                            <div class="form-material form-material-primary input-group remove-margin-t remove-margin-b">
                                <input class="form-control" type="text" id="base-material-text" name="base-material-text" placeholder="Pesquisar..">
                                <span class="input-group-addon"><i class="si si-magnifier"></i></span>
                            </div>
                        </form>
                    </li>-->
                </ul>
                <!-- END Header Navigation Left -->
            </header>
            <!-- END Header -->
