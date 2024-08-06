<aside id="left-panel" class="left-panel">
   <nav class="navbar navbar-expand-sm navbar-default">
      <div class="navbar-header">
         <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
            <i class="fa fa-bars"></i>
         </button>
         <a class="navbar-brand" href="./">{{config('app.name')}}</a>
         <a class="navbar-brand hidden" href="./">DC</a>
      </div>
      <div id="main-menu" class="main-menu collapse navbar-collapse">
         <ul class="nav navbar-nav">
            <h3 class="menu-title">MENU</h3><!-- /.menu-title -->


            <li>
               <a href="{{route('home')}}"> <i class="menu-icon fa fa-dashboard"></i>CASA </a>
            </li>



            <li class="menu-item-has-children dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-list"></i> Articulos</a>
               <ul class="sub-menu children dropdown-menu">

                  @can('articulos_listado')
                  <li>
                     <a class="" href="{{ route('articulo.index') }}">
                        <i class="fa fa-file-alt"></i>
                        Articulos
                     </a>
                  </li>
                  @endcan
                  @can('articulos_store')
                  <li>

                     <a class="" href="{{ route('articulo.nuevo') }}">
                        <i class="fa fa-star" aria-hidden="true"></i>
                        Nuevo Articulo
                     </a>
                  </li>
                  @endcan
                  @can('articulos_min_stock')
                  <li>

                     <a class="" href="{{route('articulo.stock')}}">
                        <i class="fa fa-folder"></i>
                        Control de Stock
                     </a>
                  </li>
                  @endcan
                  @can('articulos_compra_store')
                  <li>

                     <a class="" href="{{route('articulo.comprar')}}">
                        <i class="fa fa-cart-plus"></i>
                        Comprar Articulos
                     </a>
                  </li>
                  @endcan

                  @can('articulos_historial')
                  <li>

                     <a class="" href="{{route('articulo.comprarHisto')}}">
                        <i class="fa fa-history"></i>
                        Historial de Compras
                     </a>
                  </li>
                  @endcan
                  <li>
                     <a class="" href="{{route('catalogo.index')}}">
                        <i class="fa fa-ellipsis-v"></i>
                        Articulos En Oferta
                     </a>
                  </li>
                  @can('articulos_catalogo_report')
                  <li>

                     <a class="" href="{{route('articulo.catalogo')}}">
                        <i class="fa fa-info"></i>
                        Ofertas
                     </a>
                  </li>
                  @endcan
                  @can('articulos_report_all')
                  <li>

                     <a class="" href="{{route('articulo.repotes')}}">
                        <i class="fa fa-book"></i>
                        Reportes
                     </a>
                  </li>
                  @endcan


               </ul>
            </li>



            <li class="menu-item-has-children dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="menu-icon fa fa-layer-group"></i>Categorias</a>
               <ul class="sub-menu children dropdown-menu">

                  @can('categoria_list')
                  <li>

                     <i class="fa fa-ellipsis-h"></i>
                     <a class="" href="{{route('categoria.index')}}">
                        Categorias
                     </a>
                  </li>
                  @endcan

                  @can('categoria_create')
                  <li>

                     <i class="fa fa-plus"></i>
                     <a class="" href="{{route('categoria.create')}}">
                        Registrar Categorias
                     </a>
                  </li>
                  @endcan

                  @can('categoria_report')

                  <li>

                     <i class="fa fa-book"></i>
                     <a class="" target="_blank" href="{{route('categoria.reporte')}}">
                        Reportes
                     </a>
                  </li>
                  @endcan


               </ul>
            </li>


            <li class="menu-item-has-children dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user-secret"></i>Proveedores</a>
               <ul class="sub-menu children dropdown-menu">

                  @can('proveedor_list')
                  <li>

                     <a class="" href="{{route('prove.index')}}">
                        Proveedores
                     </a>
                     @endcan
                  </li>

                  @can('proveedor_all')
                  <li>

                     <a class="" href="{{route('prove.create')}}">
                        <i class="fa fa-plus"></i>
                        Registrar Proveedor
                     </a>
                  </li>
                  <li>

                     <a class="" target="_blank" href="{{route('prove.reporte')}}">
                        <i class="fa fa-book"></i>
                        Reportes
                     </a>
                  </li>
                  @endcan


               </ul>
            </li>


            <li class="menu-item-has-children dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-cart-plus"></i>Ventas</a>
               <ul class="sub-menu children dropdown-menu">
                  @can('venta_inicio')
                  <li>

                     <i class="fa fa-shopping-cart"></i>
                     <a class="" target="_blank" href="{{route('venta.index')}}">
                        Vender
                     </a>
                  </li>
                  @endcan

                  @can('venta_historial')
                  <li>

                     <i class="fa fa-plus"></i>
                     <a class="" href="{{route('venta.historial')}}">
                        Historial de Ventas
                     </a>
                  </li>
                  @endcan

                  @can('venta_reports')
                  <li>

                     <i class="fa fa-book"></i>
                     <a class="" href="{{route('venta.reportes')}}">
                        Reportes
                     </a>
                  </li>
                  @endcan

               </ul>
            </li>
            <li class="menu-item-has-children dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-flag"></i> Cortizacion</a>
               <ul class="sub-menu children dropdown-menu">

                  <li>
                     <i class=" fa fa-plus"></i>
                     <a class="" href="{{route('coti.list')}}">
                        Cotizaciones
                     </a>
                  </li>


               </ul>
            </li>

            <li class="menu-item-has-children dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-question"></i>Sugerencias</a>
               <ul class="sub-menu children dropdown-menu">

                  <li>
                     <i class="fa fa-plus"></i>
                     <a class="" href="{{route('suge.index')}}">
                        Sugerencias
                     </a>
                  </li>


               </ul>
            </li>
            <li class="menu-item-has-children dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-money-bill"></i>Caja</a>
               <ul class="sub-menu children dropdown-menu">

                  <li>
                     <i class="fa fa-plus"></i>
                     <a class="" href="{{route('caja.entradas')}}">
                        Caja Chica
                     </a>
                  </li>

                  <li>
                     <i class="fa fa-minus"></i>
                     <a class="" href="{{route('caja.salidas')}}">
                        Gastos
                     </a>
                  </li>

                  @can('caja_cuadre')
                  <li>
                     <i class="fa fa-calculator"></i>
                     <a class="" href="{{route('caja.cuadre')}}">
                        Cuadre De Caja
                     </a>
                  </li>
                  @endcan

                  @canany(['caja_filtrado_cajachica', 'caja_filtrado_gastos', 'caja_movimientos_filtrados', 'caja_movimientos_dia' ])
                  <li>
                     <i class="fa fa-list-alt"></i>
                     <a class="" href="{{route('caja.movimientos')}}">
                        Reportes
                     </a>
                  </li>
                  @endcanany

               </ul>
            </li>
            <li class="menu-item-has-children dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-users"></i></i>Clientes</a>
               <ul class="sub-menu children dropdown-menu">

                  <li>

                     <i class="fa fa-user"></i>
                     <a class="" href="{{route('cliente.index')}}">
                        Clientes
                     </a>
                  </li>
                  <li>

                     <i class="fa fa-credit-card"></i>
                     <a class="" href="{{route('cliente.deudores')}}">
                        Deudores
                     </a>
                  </li>
                  <li>

                     <i class="fa fa-plus"></i>
                     <a class="" href="{{route('cliente.create')}}">
                        Registrar Cliente
                     </a>
                  </li>
                  <li>

                     <i class="fa fa-book"></i>
                     <a class="" href="{{route('cliente.reportes')}}">
                        Reportes
                     </a>
                  </li>


               </ul>
            </li>

            <li class="menu-item-has-children dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-box"></i></i>Paquetes</a>
               <ul class=" sub-menu children dropdown-menu">

                  <li>
                     <i class="fa fa-plus"></i>
                     <a class="" href="{{ route('tra.name') }}">
                        PAQUETES
                     </a>
                  </li>


               </ul>
            </li>


            <li class="menu-item-has-children dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-chair"></i>Mobiliario</a>
               <ul class="sub-menu children dropdown-menu">

                  <li><a href="{{route('mobiliario.index')}}">Inicio</a></li>
                  <li><a href="{{route('mobiliario.create')}}">Registro de Mobiliario</a></li>
                  <li><a href="{{route('mobiliario.reporte')}}">Reportes</a></li>


               </ul>
            </li>

            @canany(['users_access','roles_access','permissions_access'])
            <li class="menu-item-has-children dropdown">
               <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-user-nurse"></i>Usuarios</a>
               <ul class="sub-menu children dropdown-menu">
                  @can('users_access')
                  <li>
                     <i class="menu-icon fa fa-circle"></i>
                     <a class="nav-link  @if(request()->is('/users') || request()->is('/users/*')) is_active @endif" href="{{ route('users.index') }}" aria-expanded="false">
                        <p class="sub-item">Users</p>
                     </a>
                  </li>
                  @endcan

                  @can('roles_access')
                  <li>
                     <i class="menu-icon fa fa-circle"></i>
                     <a class="nav-link  @if(request()->is('/roles') || request()->is('/roles/*')) is_active @endif" href="{{ route('roles.index') }}" aria-expanded="false">
                        <p class="sub-item">Roles</p>
                     </a>
                  </li>
                  @endcan

                  @can('permissions_access')
                  <li>
                     <i class="menu-icon fa fa-circle"></i>
                     <a class="nav-link  @if(request()->is('/permissions') || request()->is('/permissions/*')) is_active @endif" href="{{ route('permissions.index') }}" aria-expanded="false">
                        <p class="sub-item">Permissions</p>
                     </a>
                  </li>
                  @endcan

               </ul>
            </li>
            @endcanany


         </ul>
      </div><!-- /.navbar-collapse -->
   </nav>
</aside>