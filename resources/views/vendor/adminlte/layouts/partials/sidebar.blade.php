<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->username }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- search form (Optional) -->
        <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="{{ trans('adminlte_lang::message.search') }}..."/>
              <span class="input-group-btn">
                <button type='submit' name='search' id='search-btn' class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
        </form>
        <!-- /.search form -->

        <!-- Sidebar Menu -->
        @if (Auth::user()->tipo_users_id==1)
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('home') }}"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Pacientes</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('Paciente')}}">Registro</a></li>                    
                </ul>
            </li>            
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Consulta</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('Consulta')}}">Registro</a></li>
                    <li><a href="{{url('Historia')}}">Historias</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Companias</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('Aseguradora')}}">Registro de aseguradora</a></li>
                    <li><a href="{{url('compania')}}">Registro de Companias</a></li>
                    <li><a href="{{url('Costos')}}">Registro de Costos</a></li>
                </ul>
            </li>      
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('ParteDiario')}}">Parte Diario</a></li>
                    <li><a href="{{url('ReporteDiagnostico')}}">Por Diagnosticos</a></li>
                    <li><a href="{{url('ReporteProcedimiento')}}">Por Procedimientos</a></li>
                    <li><a href="{{url('ReporteEdad')}}">Por Edades</a></li>
                </ul>
            </li>  
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Pagos</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('Pagos')}}">Verificacion de Pagos</a></li>
                    <li><a href="{{url('Costos')}}">Modificar Pagos</a></li>
                    <!--<li><a href="{{url('Costos')}}">Generar Report1es</a></li> -->
                    <li><a href="{{url('Consolidado')}}">Consolidado</a></li>
                </ul>               
            </li>      
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Usuario</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('Usuario')}}">Registro</a></li>
                    <li><a href="{{url('ListaU')}}">Mantenimiento</a></li>
                </ul>               
            </li>                                        
        </ul><!-- /.sidebar-menu -->

        <div class="" id="campoHistorias" style="background-color: white;">
            <h4>Historias Registradas</h4>
        </div>
        @elseif(Auth::user()->tipo_users_id==2)
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('home') }}"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Pacientes</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('Paciente')}}">Registro</a></li>                    
                </ul>
            </li>            
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Consulta</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('Consulta')}}">Registro</a></li>
                    <li><a href="{{url('Historia')}}">Historias</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Companias</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('Aseguradora')}}">Registro de aseguradora</a></li>
                    <li><a href="{{url('compania')}}">Registro de Companias</a></li>
                    <li><a href="{{url('Costos')}}">Registro de Costos</a></li>
                </ul>
            </li>      
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Reportes</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('ParteDiario')}}">Parte Diario</a></li>
                    <li><a href="{{url('ReporteDiagnostico')}}">Por Diagnosticos</a></li>
                    <li><a href="{{url('ReporteProcedimiento')}}">Por Procedimientos</a></li>
                    <li><a href="{{url('ReporteEdad')}}">Por Edades</a></li>
                </ul>
            </li>  
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Pagos</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('Pagos')}}">Verificacion de Pagos</a></li>
                    <li><a href="{{url('compania')}}">Modificar Pagos</a></li>
                    <li><a href="{{url('Costos')}}">Generar Reportes</a></li> 
                </ul>               
            </li>      
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Usuario</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('Usuario')}}">Registro</a></li>
                    <li><a href="{{url('ListaU')}}">Mantenimiento</a></li>
                </ul>               
            </li>                                        
        </ul><!-- /.sidebar-menu -->
        <div class="" id="campoHistorias" style="background-color: white;">
            <h4>Historias Registradas</h4>
        </div>
        @else
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('home') }}"><i class='fa fa-link'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Pacientes</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('Paciente')}}">Registro</a></li>                    
                </ul>
            </li>            
            <li class="treeview">
                <a href="#"><i class='fa fa-link'></i> <span>Companias</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('Aseguradora')}}">Registro de aseguradora</a></li>
                    <li><a href="{{url('compania')}}">Registro de Companias</a></li>
                </ul>
            </li>          
        </ul><!-- /.sidebar-menu -->
        @endif

    </section>
    <!-- /.sidebar -->
</aside>
