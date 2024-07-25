<div class="sidebar-menu">
   <div class="sidebar-header" style="padding: 0px 0px 5px 0px;">
      <div class="logo">
         <a href="{{route('home')}}"><img style="width: 75%;" src="{{asset('logos/main.jpg')}}" class="rounded" alt="logo"></a>
      </div>
   </div>
   <div class="main-menu">
      <div class="menu-inner">
         <nav>
            <ul class="metismenu" id="menu">


               <li><a href="{{route('home')}}">CASA</a></li>

               <li class="">
                  <a href="#" class='sidebar-link'>
                     <i class="fa fa-medkit" aria-hidden="true"></i>
                     <span>MENUS</span>
                  </a>
                  <ul class="submenu ">

                     @can('articulos_listado')
                     <li>
                        <a class="px-3" href="{{ route('articulo.index') }}">
                           <i class="fa fa-file-alt"></i>
                           Articulos
                        </a>
                     </li>
                     @endcan
                     @can('articulos_store')
                     <li>

                        <a class="px-3" href="{{ route('articulo.nuevo') }}">
                           <i class="fa fa-star" aria-hidden="true"></i>
                           Nuevo Articulo
                        </a>
                     </li>
                     @endcan
                     @can('articulos_min_stock')
                     <li>
                        <a class="px-3" href="{{route('articulo.stock')}}">
                           <i class="fa fa-folder"></i>
                           Control de Stock
                        </a>
                     </li>
                     @endcan
                     @can('articulos_compra_store')


                     @endcan

                     @can('articulos_historial')

                     @endcan

                     @can('articulos_catalogo_report')

                     @endcan
                     @can('articulos_report_all')
                     <li>

                        <a class="px-3" href="{{route('articulo.repotes')}}">
                           <i class="fa fa-book"></i>
                           Reportes
                        </a>
                     </li>
                     @endcan

                  </ul>
               </li>

               <li>
                  <a href="#" class='sidebar-link'>
                     <i class="fa fa-medkit" aria-hidden="true"></i>
                     <span>INGREDIENTES</span>
                  </a>
                  <ul class="collapse ">
                     <li>
                        <a class="px-3" href="{{ route('ingrediente.index') }}">
                           <i class="fa fa-file-alt"></i>
                           INGREDIENTES
                        </a>
                     </li>
                     <li>
                        <a class="px-3" href="{{ route('ingrediente.ingredienteMenuf') }}">
                           <i class="fa fa-file-alt"></i>
                           COMPONER MENU
                        </a>
                     </li>
                     <li>
                        <a class="px-3" href="{{ route('ingrediente.compra_index') }}">
                           <i class="fa fa-file-alt"></i>
                           Compra de ingredient
                        </a>
                     </li>
                     <li>
                        <a class="px-3" href="{{ route('ingrediente.reportes') }}">
                           <i class="fa fa-file-alt"></i>
                           Reportes
                        </a>
                     </li>
                  </ul>
               </li>

               <!-- CATEGORIAS -->
               <li class="">
                  <a href="#" class='sidebar-link'>
                     <i class="fa fa-tags" aria-hidden="true"></i>
                     <span>CATEGORIAS</span>
                  </a>
                  <ul class="submenu ">
                     @can('categoria_list')
                     <li>
                        <a class=" px-3" href="{{route('categoria.index')}}">
                           <i class="fa fa-ellipsis-h"></i>
                           Categorias
                        </a>
                     </li>
                     @endcan

                     @can('categoria_create')
                     <li>
                        <a class=" px-3" href="{{route('categoria.create')}}">
                           <i class="fa fa-plus"></i>
                           Registrar Categorias
                        </a>
                     </li>
                     @endcan

                     @can('categoria_report')
                     <li>
                        <a class=" px-3" target="_blank" href="{{route('categoria.reporte')}}">
                           <i class="fa fa-book"></i>
                           Reportes
                        </a>
                     </li>
                     @endcan

                  </ul>
               </li>

               <!-- CATEGORIAS -->
               <li class="">
                  <a href="#" class='sidebar-link'>
                     <!-- <i class="fa fa-tags" aria-hidden="true"></i> -->
                     <span>PERDIDAS</span>
                  </a>
                  <ul class="submenu ">

                     <li>
                        <a class=" px-3" href="{{route('perdida.index')}}">
                           <i class="fa fa-ellipsis-h"></i>
                           LISTADO
                        </a>
                     </li>

                     <li>
                        <a class=" px-3" href="{{route('perdida.create')}}">
                           <i class="fa fa-plus"></i>
                           Registrar Perdida
                        </a>
                     </li>

                     <li>
                        <a class=" px-3" target="_blank" href="">
                           <i class="fa fa-book"></i>
                           Reportes
                        </a>
                     </li>


                  </ul>
               </li>

               <!-- PROVEEDORES -->
               <li class="">
                  <a href="#" class='sidebar-link'>
                     <i class="fa fa-ellipsis-h"></i>
                     <span>PROVEEDORES</span>
                  </a>
                  <ul class="submenu ">

                     @can('proveedor_list')
                     <li>
                        <a class="px-3" href="{{route('prove.index')}}">
                           <i class="fa fa-list-alt" aria-hidden="true"></i>
                           Proveedores
                        </a>
                     </li>
                     @endcan

                     @can('proveedor_create')
                     <li>
                        <a class="px-3" href="{{route('prove.create')}}">
                           <i class="fa fa-plus"></i>
                           Registrar Proveedor
                        </a>
                     </li>
                     @endcan

                     @can('proveedor_all')
                     <li>
                        <a class="px-3" href="{{route('prove.getAllDeudaToProveedo')}}">
                           <i class="fa fa-plus"></i>
                           Acreedores
                        </a>
                     </li>

                     <li>
                        <a class="px-3" href="{{route('prove.reportes')}}">
                           <i class="fa fa-book"></i>
                           Reportes
                        </a>
                     </li>
                     @endcan

                  </ul>
               </li>

            


               <!-- VENTAS  -->
               <li class="">
                  <a href="#" class='sidebar-link'>
                     <i class="fa fa-shopping-bag" aria-hidden="true"></i>
                     <span>VENTAS</span>
                  </a>
                  <ul class="submenu ">
                     @can('venta_inicio')
                     <li>
                        <a class="px-3" target="_blank" href="{{route('venta.index')}}">
                           <i class="fa fa-shopping-cart"></i>
                           Vender
                        </a>
                     </li>
                     @endcan

                     @can('venta_historial')
                     <li>
                        <a class="px-3" href="{{route('venta.historial')}}">
                           <i class="fa fa-plus"></i>
                           Historial de Ventas
                        </a>
                     </li>
                     @endcan

                     @can('venta_reports')
                     <li>
                        <a class="px-3" href="{{route('venta.reportes')}}">
                           <i class="fa fa-book"></i>
                           Reportes
                        </a>
                     </li>
                     @endcan
                  </ul>
               </li>

               <!-- COTIZACIONES -->
               <li class="">
                  <a href="#" class='sidebar-link'>
                     <i class="fa fa-sticky-note" aria-hidden="true"></i>
                     <span>COTIZACION</span>
                  </a>
                  <ul class="submenu ">
                     <li>
                        <a class="px-3" href="{{route('coti.list')}}">
                           <i class=" fa fa-plus"></i>
                           Cotizaciones
                        </a>
                     </li>
                     <!-- <li>
                     <a class="px-3"href="{{route('coti.index')}}">
                        <i class="fa fa-plus"></i>
                        Cotizar
                     </a>
                  </li> -->

                  </ul>
               </li>

               <!-- SUGERENCIA -->
               <li class="">
                  <a href="#" class='sidebar-link'>
                     <i class="fa fa-list" aria-hidden="true"></i>

                     <span>SUGERENCIA</span>
                  </a>
                  <ul class="submenu ">

                     <li>
                        <a class="px-3" href="{{route('suge.index')}}">
                           <i class="fa fa-plus"></i>
                           Sugerencias
                        </a>
                     </li>

                  </ul>
               </li>


               <!-- CLIENTES -->
               <li class="">
                  <a href="#" class='sidebar-link'>
                     <i class="fa fa-user-graduate    "></i>
                     <span>CLIENTES</span>
                  </a>
                  <ul class="submenu ">

                     <li>

                        <a class="px-3" href="{{route('cliente.index')}}">
                           <i class="fa fa-user"></i>
                           Clientes
                        </a>
                     </li>

                     <li>
                        <a class="px-3" href="{{route('cliente.deudores')}}">
                           <i class="fa fa-credit-card"></i>
                           Deudores
                        </a>
                     </li>

                     <li>

                        <a class="px-3" href="{{route('cliente.create')}}">
                           <i class="fa fa-plus"></i>
                           Registrar Cliente
                        </a>
                     </li>

                     <li>

                        <a class="px-3" href="{{route('cliente.reportes')}}">
                           <i class="fa fa-book"></i>
                           Reportes
                        </a>
                     </li>

                  </ul>
               </li>


               <!-- CAJA -->
               <li class="">
                  <a href="#" class='sidebar-link'>
                     <i class="fas fa-cash-register"></i>
                     <span>CAJA</span>
                  </a>
                  <ul class="submenu ">

                     @can('caja_independiente')
                     <li>

                        <a class="px-3" href="{{route('cajai.index')}}">
                           <i class="fa fa-list" aria-hidden="true"></i>
                           Caja Independiente
                        </a>
                     </li>
                     @endcan

                     @can('admin')
                     <li>
                        <a class="px-3" href="{{route('cuac.index')}}">
                           <i class="fa fa-money" aria-hidden="true"></i>
                           Caja Fuerte
                        </a>
                     </li>
                     @endcan

                     <li>

                        <a class="px-3" href="{{route('caja.entradas')}}">
                           <i class="fa fa-plus"></i>
                           Caja Chica
                        </a>
                     </li>

                     <li>

                        <a class="px-3" href="{{route('caja.salidas')}}">
                           <i class="fa fa-minus"></i>
                           Gastos
                        </a>
                     </li>

                     @can('caja_cuadre')
                     <li>

                        <a class="px-3" href="{{route('caja.cuadre')}}">
                           <i class="fa fa-calculator"></i>
                           Cuadre De Caja
                        </a>
                     </li>
                     @endcan

                     @canany(['caja_filtrado_cajachica', 'caja_filtrado_gastos', 'caja_movimientos_filtrados', 'caja_movimientos_dia' ])
                     <li>

                        <a class="px-3" href="{{route('caja.movimientos')}}">
                           <i class="fa fa-list-alt"></i>
                           Reportes
                        </a>
                     </li>
                     @endcanany

                  </ul>
               </li>



               <li class="">
                  <a href="#" class='sidebar-link'>
                     <i class="fa fa-child" aria-hidden="true"></i>
                     <span>MOBILIARIO</span>
                  </a>
                  <ul class="submenu ">
                     <li><a href="{{route('mobiliario.index')}}">Inicio</a></li>
                     <li><a href="{{route('mobiliario.create')}}">Registro de Mobiliario</a></li>
                     <li><a href="{{route('mobiliario.reporte')}}">Reportes</a></li>
                  </ul>
               </li>


               <!-- ARCHIVOS -->
               <li class="">
                  <a href="#" class='sidebar-link'>
                     <i data-feather="briefcase" width="20"></i>
                     <span>ARCHIVO</span>
                  </a>
                  <ul class="submenu ">

                     <li>
                        <a class="px-3" href="{{route('archi.index')}}">
                           <i class="fas fa-upload    "></i>
                           ARCHIVOS
                        </a>
                     </li>

                     <li>
                        <a class="px-3" href="{{ route('archi.reportes') }}">
                           <i class="fa fa-list" aria-hidden="true"></i>
                           REPORTES
                        </a>
                     </li>

                  </ul>
               </li>

               <!-- TABLAS -->
               @can('table_all')
               <li class="">
                  <a href="#" class='sidebar-link'>
                     <i data-feather="briefcase" width="20"></i>
                     <span>TABLAS</span>
                  </a>
                  <ul class="submenu ">

                     <li>
                        <a class="px-3" href="{{route('table.index')}}">
                           <i class="fa fa-table" aria-hidden="true"></i>
                           TABLAS
                        </a>
                     </li>

                  </ul>
               </li>
               @endcan


               @canany(['users_access','roles_access','permissions_access'])
               <li class="">
                  <a href="#" class='sidebar-link'>
                     <i class="fa fa-users" aria-hidden="true"></i>

                     <span>USUARIOS</span>
                  </a>
                  <ul class="submenu ">
                     @can('users_access')

                     <li>

                        <a class="px-3" href="{{ route('users.index') }}" aria-expanded="false">
                           <i class="fa fa-users" aria-hidden="true"></i>
                           Users
                        </a>
                     </li>
                     @endcan

                     @can('roles_access')
                     <li>

                        <a class="px-3" href="{{ route('roles.index') }}" aria-expanded="false">
                           <i class="fa fa-star" aria-hidden="true"></i>
                           Roles
                        </a>
                     </li>

                     @endcan

                     @can('permissions_access')

                     <!-- 
                  <li>
                     <a class="px-3"href="{{ route('permissions.index') }}" aria-expanded="false">
                        <i class="mr-3 mdi mdi-key" aria-hidden="false"></i>
                        <span class="hide-menu">Permissions</span>
                     </a>
                  </li>
                  -->
                     @endcan

                     <li>
                        <a class="px-3" href="{{ route('user.report') }}" aria-expanded="false">
                           <i class="fa fa-list" aria-hidden="true"></i>
                           Reportes
                        </a>
                     </li>

                  </ul>
               </li>
               @endcanany



            </ul>
         </nav>
      </div>
   </div>

</div>