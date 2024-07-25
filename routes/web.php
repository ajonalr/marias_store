
<?php

use App\Http\Controllers\Admin\AbonoProyectoController;
use App\Http\Controllers\Admin\ArticuloController;
use App\Http\Controllers\Admin\ArticulosCatalogoController;
use App\Http\Controllers\Admin\CajaController;
use App\Http\Controllers\Admin\CajaIndependienteController;
use App\Http\Controllers\Admin\CategoriaController;
use App\Http\Controllers\Admin\ClienteController;
use App\Http\Controllers\Admin\CompraController;
use App\Http\Controllers\Admin\CotizacionController;
use App\Http\Controllers\Admin\CuadreCajaController;
use App\Http\Controllers\Admin\FacturaController;
use App\Http\Controllers\Admin\IngredienteController;
use App\Http\Controllers\Admin\MobiliarioEquipoController;
use App\Http\Controllers\Admin\PerdidaController;
use App\Http\Controllers\Admin\ProveedorController;
use App\Http\Controllers\Admin\SugerenciasController;
use App\Http\Controllers\Admin\TablaController;
use App\Http\Controllers\Admin\TrakingController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\VehiculoController;
use App\Http\Controllers\Admin\VentasController;
use App\Http\Controllers\ArchivoController;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect('login');
});

Auth::routes();

// rauta para ejecutar comando artisan desde la web
Route::get('artisan/{comando}/{contra}', function ($comando, $contra) {
    if ($contra === 'Taylor110eAA.') {
        // ejemplo www.decodev.net/cmd/migrate
        Artisan::call($comando);
        dd(Artisan::output());
    } else {
        echo 'NO ACCESO';
    }
});


Route::group(['prefix' => "admin", 'namespace' => 'App\Http\Controllers\Admin', 'middleware' => ['auth', 'AdminPanelAccess']], function () {

    Route::get('/', 'HomeController@index')->name('home');

    // vechiculos
    Route::prefix('vehiculos')->group(function () {
        Route::get('', [VehiculoController::class, 'index'])->name('vehiculos.index');
        Route::get('/create', [VehiculoController::class, 'create'])->name('vehiculos.create');
        Route::get('perfil/{id}', [VehiculoController::class, 'show'])->name('vehiculos.show');
        Route::post('', [VehiculoController::class, 'store'])->name('vehiculos.store');
        Route::put('/{id}', [VehiculoController::class, 'update'])->name('vehiculos.update');
        Route::delete('/{id}', [VehiculoController::class, 'delete'])->name('vehiculos.delete');
        // reporetes
        Route::get('reporte', [VehiculoController::class, 'reportAll'])->name('vehiculos.reportAll');
    });


     // vechiculos
     Route::prefix('ingrediente')->group(function () {
        Route::get('index', [IngredienteController::class, 'index'])->name('ingrediente.index');
        Route::get('perfil/{ing}', [IngredienteController::class, 'show'])->name('ingrediente.show');
        Route::get('menu-armado', [IngredienteController::class, 'ingredienteMenuf'])->name('ingrediente.ingredienteMenuf');
        Route::post('store', [IngredienteController::class, 'store'])->name('ingrediente.store');
        Route::post('store-ingrediente-menu', [IngredienteController::class, 'store_ingredienteMenu'])->name('ingrediente.store_ingredienteMenu');
        
        Route::put('update/{id}', [IngredienteController::class, 'update'])->name('ingrediente.update');
        Route::delete('delete/{id}', [IngredienteController::class, 'delete'])->name('ingrediente.delete');
        Route::delete('delete-ingrediente-menu/{d}', [IngredienteController::class, 'deleteIngredienteMenu'])->name('ingrediente.deleteIngredienteMenu');
        
        Route::get('compra-index', [IngredienteController::class, 'compra_index'])->name('ingrediente.compra_index');
        Route::get('compra-delete/{cmp}', [IngredienteController::class, 'delete_compra'])->name('ingrediente.delete_compra');
        Route::post('store-compra', [IngredienteController::class, 'compra_store'])->name('ingrediente.compra_store');
        Route::get('reportes', [IngredienteController::class, 'reportes'])->name('ingrediente.reportes');
        Route::get('reportes-all', [IngredienteController::class, 'report_allIngredient'])->name('ingrediente.report_allIngredient');
        Route::get('reportes-compras', [IngredienteController::class, 'reporte_hitorial'])->name('ingrediente.reporte_hitorial');
        
        
    });

    // perdidas
    Route::prefix('perdida')->group(function () {
        Route::get('', [PerdidaController::class, 'index'])->name('perdida.index');
        Route::get('/create', [PerdidaController::class, 'create'])->name('perdida.create');
        Route::get('perfil/{id}', [PerdidaController::class, 'show'])->name('perdida.show');
        Route::post('', [PerdidaController::class, 'store'])->name('perdida.store');
        Route::put('/{id}', [PerdidaController::class, 'update'])->name('perdida.update');
        Route::delete('/{id}', [PerdidaController::class, 'delete'])->name('perdida.delete');
        // Route::get('reporte', [PerdidaController::class, 'reportAll'])->name('perdida.reportAll');
    });


    // articulos
    Route::group(['prefix' => 'articulos'], function () {
        Route::get('', [ArticuloController::class, 'index'])->name('articulo.index')->middleware('can:articulos_listado');
        Route::get('articulo/{id}', [ArticuloController::class, 'show'])->name('articulo.show')->middleware('can:articulos_show');
        Route::get('nuevo', [ArticuloController::class, 'create'])->name('articulo.nuevo')->middleware('can:articulos_store');
        Route::post('store', [ArticuloController::class, 'store'])->name('articulo.store')->middleware('can:articulos_store');
        Route::put('update/{id}', [ArticuloController::class, 'update'])->name('articulo.update')->middleware('can:articulos_show');
        Route::get('delete/{id}', [ArticuloController::class, 'destroy'])->name('articulo.delete')->middleware('can:articulos_delete');
        Route::get('control/stock', [ArticuloController::class, 'controlStock'])->name('articulo.stock')->middleware('can:articulos_min_stock');

        // articulos DB
        Route::get('articulos-db', [ArticuloController::class, 'articuloDB'])->name('articulo.articuloDB');



        // compra de articulos
        Route::get('comprar', [CompraController::class, 'index'])->name('articulo.comprar')->middleware('can:articulos_compra_store');
        Route::post('compra', [CompraController::class, 'store'])->name('articulo.compraStore')->middleware('can:articulos_compra_store');

        Route::get('registro-factura', [CompraController::class, 'factrura_Create'])->name('articulo.factrura_Create')->middleware('can:articulos_compra_store');

        Route::post('registro-factura', [CompraController::class, 'store_factura'])->name('articulo.store_factura')->middleware('can:articulos_compra_store');

        Route::get('historial/compra', [CompraController::class, 'shows'])->name('articulo.comprarHisto')->middleware('can:articulos_historial');
        Route::get('historial/compra/delete/{id}/{idArt}', [CompraController::class, 'delete'])->name('articulo.compradelete')->middleware('can:articulos_hitorial_delete');


        // reportes
        Route::get('compras/reporte', [CompraController::class, 'report'])->name('articulo.compraReport')->middleware('can:articulos_report_all');
        Route::get('reportes', [ArticuloController::class, 'reportes'])->name('articulo.repotes')->middleware('can:articulos_report_all');
        Route::get('reportes/all', [ArticuloController::class, 'reportAll'])->name('articulo.repotesAll')->middleware('can:articulos_report_all');
        Route::get('reportes/allmin', [ArticuloController::class, 'reportAllmin'])->name('articulo.repotesAllmin')->middleware('can:articulos_report_all');
        Route::get('reportes/control/stock', [ArticuloController::class, 'stockControl'])->name('articulo.stockControl')->middleware('can:articulos_report_all');
        Route::get('reportes/control/stock/salidas', [ArticuloController::class, 'articulosvendidos'])->name('articulo.articulosvendidos')->middleware('can:articulos_report_all');

        Route::get('reportes/articulo-por-fecha', [ArticuloController::class, 'registerToDate'])->name('articulo.registerToDate')->middleware('can:articulos_report_all');

        Route::get('reportes/articulo-vendido', [ArticuloController::class, 'articulo_vendido'])->name('articulo.articulo_vendido')->middleware('can:articulos_report_all');

        // Export Data imprimir cosido de barras
        Route::get('articulo/data/{id}', [ArticuloController::class, 'dataPrint'])->name('articulo.exportdata');
    });

    //  articulos en catalogo
    Route::group(['prefix' => 'articulos/catalogo'], function () {
        Route::get('inicio', [ArticulosCatalogoController::class, 'index'])->name('catalogo.index');
        Route::get('show/{id}', [ArticulosCatalogoController::class, 'show'])->name('catalogo.show')->middleware('can:articulos_catalogo_update');
        Route::get('delete/{id}', [ArticulosCatalogoController::class, 'delete'])->name('catalogo.delete')->middleware('can:articulos_catalog_delete');
        Route::post('store', [ArticulosCatalogoController::class, 'store'])->name('catalogo.store')->middleware('can:articulos_catalogo_add');
        Route::put('update', [ArticulosCatalogoController::class, 'update'])->name('catalogo.update')->middleware('can:articulos_catalogo_update');
        Route::get('reportes', [ArticulosCatalogoController::class, 'catalogo'])->name('articulo.catalogo')->middleware('can:articulos_catalogo_report');
    });

    // clientes
    Route::group(['prefix' => 'clientes'], function () {
        Route::get('index', [ClienteController::class, 'index'])->name('cliente.index');
        Route::get('delete/{id}', [ClienteController::class, 'delete'])->name('cliente.delete');
        Route::get('show/{id}', [ClienteController::class, 'show'])->name('cliente.show');
        Route::put('update/{id}', [ClienteController::class, 'update'])->name('cliente.update');
        Route::post('store', [ClienteController::class, 'store'])->name('cliente.store');
        Route::get('create', [ClienteController::class, 'create'])->name('cliente.create');
        Route::get('deudores', [ClienteController::class, 'deudores'])->name('cliente.deudores');
        Route::get('pagar/deuda/{id}', [ClienteController::class, 'pagarDeuda'])->name('pagarDeuda');
        Route::delete('eliminar-deuda/{id}', [ClienteController::class, 'deleteCredito'])->name('cliente.deleteCredito');
        Route::delete('eliminar-abono/{id}', [ClienteController::class, 'deleteAbono'])->name('cliente.deleteAbono');

        // reportes
        Route::get('reporte/deudas/{id}', [ClienteController::class, 'reporteDeudore'])->name('cliente.deudasReport');
        Route::get('reportes', [ClienteController::class, 'reportes'])->name('cliente.reportes');
        Route::get('reportes/deudores', [ClienteController::class, 'reportesAllDeudores'])->name('cliente.reportesDeudores');
        Route::get('reportes/all', [ClienteController::class, 'reportesAllClientes'])->name('cliente.reportesAllClientes');

        // asigan la deuda / credito
        Route::post('credito', [ClienteController::class, 'saveDeuda'])->name('cliente.saveDeuda');
        // guarda el abono de un cliente
        Route::post('abono', [ClienteController::class, 'abonosNew'])->name('cliente.abonosNew');

        // retorna el reporte de deudas
        Route::post('report/crediros', [ClienteController::class, 'reportVentaToClienteAndDate'])->name('cliente.reportVentaToClienteAndDate');

        // retorna los recibos de abonos y creditos
        Route::get('pinrt/credito/{id}', [ClienteController::class, 'print_credito'])->name('cliente.print_credito');
        Route::get('pinrt/abono/{id}', [ClienteController::class, 'print_abonos'])->name('cliente.print_abonos');

        Route::post('reporte-abonos-deudores', [ClienteController::class, 'abonos_report_filter'])->name('cliente.abonos_report_filter');
    });

    // categorias
    Route::group(['prefix' => 'categorias'], function () {
        Route::get('index', [CategoriaController::class, 'index'])->name('categoria.index');
        Route::get('delete/{id}', [CategoriaController::class, 'delete'])->name('categoria.delete')->middleware('can:categoria_delete');
        Route::get('show/{id}', [CategoriaController::class, 'show'])->name('categoria.show')->middleware('can:categoria_show');
        Route::put('update/{id}', [CategoriaController::class, 'update'])->name('categoria.update')->middleware('can:categoria_show');
        Route::post('store', [CategoriaController::class, 'store'])->name('categoria.store')->middleware('can:categoria_create');
        Route::get('create', [CategoriaController::class, 'create'])->name('categoria.create')->middleware('can:categoria_create');
        Route::get('reporte', [CategoriaController::class, 'reporte'])->name('categoria.reporte')->middleware('can:categoria_report');
    });

    // ventas
    Route::group(['prefix' => 'ventas'], function () {
        Route::get('index', [VentasController::class, 'index'])->name('venta.index')->middleware('can:venta_inicio');
        Route::post('store', [VentasController::class, 'store'])->name('venta.store')->middleware('can:venta_inicio');
        Route::get('factura/print/{idFactura}/{idCliente}', [VentasController::class, 'ventaPrint'])->name('venta.facturaPrint');
        Route::get('factura-comanda/print/{idFactura}/{idCliente}', [VentasController::class, 'ventaPrintComanda'])->name('venta.ventaPrintComanda');
        Route::get('historial/ventas', [VentasController::class, 'historial'])->name('venta.historial')->middleware('can:venta_historial');
        Route::get('anular/{id}/{idArt}', [VentasController::class, 'destroy'])->name('venta.delete')->middleware('can:venta_anulacion');

        Route::get('/find/article', [VentasController::class, 'findArticle'])->name('venta.findArticle');
        Route::get('/find-categoria', [VentasController::class, 'serach_to_categoria'])->name('venta.serach_to_categoria');
        // ventas filtradas
        Route::get('venta-editar/{id}', [VentasController::class, 'showventa'])->name('venta.showventa');
        Route::delete('venta-delelte/{id}', [VentasController::class, 'deleteVentaEspecific'])->name('venta.deleteVentaEspecific');

        // reportes
        Route::get('reportes', [VentasController::class, 'reportes'])->name('venta.reportes')->middleware('can:venta_reports');
        Route::get('reportes/ventas', [VentasController::class, 'reportesVentasAll'])->name('venta.reportesAll')->middleware('can:venta_reports');
        Route::get('reporte/dia', [VentasController::class, 'ventasDia'])->name('venta.diaReport')->middleware('can:venta_reports');
        Route::get('reporte/movimientos', [VentasController::class, 'movimientos'])->name('venta.movimientos')->middleware('can:venta_reports');
        Route::get('estadistica', [VentasController::class, 'estadistica'])->name('venta.estadistica')->middleware('can:venta_reports');
        Route::post('simples/facturas', [VentasController::class, 'fucturasSimples'])->name('venta.fucturasSimples');
        Route::post('vetasn-tipo-fecha', [VentasController::class, 'reportVentasToTipoAndDate'])->name('ventas.reportVentasToTipoAndDate');
        Route::post('venta-more-data', [VentasController::class, 'store_venta_existfactura'])->name('ventas.store_venta_existfactura');
        Route::post('propinas-save', [VentasController::class, 'generatePropina'])->name('ventas.generatePropina');

    });


    // caja independiente
    Route::prefix('caja-independiente')->group(function () {
        Route::get('/index', [CajaIndependienteController::class, 'index'])->name('cajai.index');
        Route::post('/store', [CajaIndependienteController::class, 'store'])->name('cajai.store');
        Route::delete('/{id}', [CajaIndependienteController::class, 'destroy'])->name('cajai.destroy');
        Route::get('update/{id}', [CajaIndependienteController::class, 'show'])->name('cajai.show');
        Route::put('edit/{id}', [CajaIndependienteController::class, 'update'])->name('cajai.update');
    });

    // caja independiente
    Route::prefix('cuadres-caja')->group(function () {
        Route::get('/index', [CuadreCajaController::class, 'index'])->name('cuac.index');
        Route::post('/store', [CuadreCajaController::class, 'store'])->name('cuac.store');
        Route::delete('/{id}', [CuadreCajaController::class, 'destroy'])->name('cuac.destroy');
        Route::get('update/{id}', [CuadreCajaController::class, 'show'])->name('cuac.show');
        Route::put('edit/{id}', [CuadreCajaController::class, 'update'])->name('cuac.update');
    });

    // caja
    Route::group(['prefix' => 'caja'], function () {
        Route::get('entradas', [CajaController::class, 'showEntrdas'])->name('caja.entradas');
        Route::get('salidas', [CajaController::class, 'showSalidas'])->name('caja.salidas');
        Route::get('cuadre', [CajaController::class, 'cuadre'])->name('caja.cuadre');
        Route::post('cuadre/store', [CajaController::class, 'cuadreStore'])->name('caja.cuadreStore')->middleware('can:caja_registro_cajachica');
        Route::get('cuadre/report', [CajaController::class, 'cuadrereport'])->name('caja.cuadreReport');
        Route::post('salidas/registro', [CajaController::class, 'salida'])->name('caja.salidaStore')->middleware('can:caja_registro_cajachica');
        Route::post('entradas/registro', [CajaController::class, 'entrada'])->name('caja.entradaStore')->middleware('can:caja_registro_cajachica');
        Route::get('cuadre/delete/{id}', [CajaController::class, 'deleteCuadre'])->name('caja.deleteCuadre')->middleware('can:caja_registro_cajachica');
        Route::get('entrada/delete/{id}', [CajaController::class, 'entradaDelete'])->name('caja.deleteentrada')->middleware('can:caja_registro_cajachica');
        Route::get('salida/delete/{id}', [CajaController::class, 'salidaDelete'])->name('caja.deletesalida')->middleware('can:caja_registro_cajachica');

        // reporte de Movimientos
        Route::get('movimientos', [CajaController::class, 'movimientos'])->name('caja.movimientos');
        Route::post('movimientos/salidas', [CajaController::class, 'salidaReport'])->name('caja.salidaReport')->middleware('can:caja_filtrado_cajachica');
        Route::post('movimientos/entradas', [CajaController::class, 'entradasReport'])->name('caja.entradasReport')->middleware('can:caja_filtrado_cajachica');
        Route::get('movimientos/filtro', [CajaController::class, 'cuadrereportFilter'])->name('caja.cuadrereportFilter')->middleware('can:caja_movimientos_filtrados');
        Route::get('movimientos/fecha/{fecha}', [CajaController::class, 'cuadreFecha'])->name('caja.cuadreFecha')->middleware('can:caja_movimientos_dia');

        // para imprimir el cuadre impresora termica
        Route::get('cuadre/{id}', [CajaController::class, 'printCuadre'])->name('caja.printCuadre');
        // imprimir los movimiento de la MOVIMIENTOS por fecha
        Route::post('movimientos-dia', [CajaController::class, 'movimientos_dia'])->name('caja.movimientos_dia');
        Route::post('ganacias', [CajaController::class, 'ganancias'])->name('caja.ganancias');
    });

    // cotizacion
    Route::group(['prefix' => 'cotizar'], function () {
        Route::get('articulos', [CotizacionController::class, 'index'])->name('coti.index');
        Route::get('index', [CotizacionController::class, 'list'])->name('coti.list');
        Route::get('show/{codigo}', [CotizacionController::class, 'show'])->name('coti.show');
        Route::post('save', [CotizacionController::class, 'store'])->name('coti.store');
        Route::get('cotizado/{codigo}', [CotizacionController::class, 'print_cotizacion'])->name('coti.print_cotizacion');
    });

    // tracking
    Route::group(['prefix' => 'tracking'], function () {
        Route::get('index', [TrakingController::class, 'index'])->name('tra.name');
        Route::get('eliminar/{id}', [TrakingController::class, 'destroy'])->name('tra.destroy');
        Route::post('store', [TrakingController::class, 'store'])->name('tra.store');
        Route::get('entregados/{id}', [TrakingController::class, 'entre'])->name('tra.entre');
        Route::get('regresar/estado/{id}', [TrakingController::class, 'regresar'])->name('tra.reg');
    });

    // proveedores
    Route::group(['prefix' => 'proveedor'], function () {
        Route::get('index', [ProveedorController::class, 'index'])->name('prove.index')->middleware('can:proveedor_list');
        Route::get('create', [ProveedorController::class, 'create'])->name('prove.create')->middleware('can:proveedor_all');
        Route::post('create', [ProveedorController::class, 'store'])->name('prove.store')->middleware('can:proveedor_all');
        Route::put('update/{id}', [ProveedorController::class, 'update'])->name('prove.update')->middleware('can:proveedor_all');
        Route::get('show/{id}', [ProveedorController::class, 'show'])->name('prove.show')->middleware('can:proveedor_all');
        Route::get('reportes', [ProveedorController::class, 'reporte'])->name('prove.reporte')->middleware('can:proveedor_all');

        // facturas
        Route::post('factura/create', [ProveedorController::class, 'facturacreate'])->name('prove.facturacreate')->middleware('can:proveedor_all');
        Route::get('factura/delete/{id}', [ProveedorController::class, 'facturadelete'])->name('prove.facturadelete')->middleware('can:proveedor_all');

        // abonos
        Route::get('factura/abonos/{id}', [ProveedorController::class, 'abonos'])->name('prove.abonos')->middleware('can:proveedor_all');
        Route::post('abonar', [ProveedorController::class, 'abonoRegistro'])->name('prove.abonar')->middleware('can:proveedor_all');
        Route::get('abono/delete/{id}', [ProveedorController::class, 'deleteAbono'])->name('prove.deleteAbono')->middleware('can:proveedor_all');

        // compra a proveedores
        Route::get('mas/comprado/{id}', [ProveedorController::class, 'mascomprado'])->name('prove.mascomprado')->middleware('can:proveedor_all');
        Route::get('delete/{id}', [ProveedorController::class, 'delete'])->name('prove.delete')->middleware('can:proveedor_all');

        // retorna la vista para poder realizar reportes
        Route::get('reporte', [ProveedorController::class, 'reportes'])->name('prove.reportes');

        Route::post('reporte-abonos', [ProveedorController::class, 'reportToAbono'])->name('prove.reportToAbono');

        // retorna el reporte de los proveedores a los que les debemos
        Route::get('reporte-deudas', [ProveedorController::class, 'getAllDeudaToProveedo'])->name('prove.getAllDeudaToProveedo');

        Route::get('factura-cambio/{id}', [ProveedorController::class, 'changeTipoToFactura'])->name('prove.changeTipoToFactura');
        Route::POST('factura-reporte', [ProveedorController::class, 'facturas_compras'])->name('prove.facturas_compras');
    });

    // rutas para usuarios
    Route::resource('/users', 'UserController');
    Route::resource('/roles', 'RoleController');
    Route::resource('/permissions', 'PermissionController');


    Route::prefix('user')->group(function () {
        Route::get('report', [UserController::class, 'report'])->name('user.report');
        Route::post('allventa', [UserController::class, 'getVentasToUserAndDate'])->name('user.getVentasToUserAndDate');
    });

    // rutas para facturas
    Route::prefix('facturas')->group(function () {
        Route::get('incio', [FacturaController::class, 'index'])->name('factura.index');
        Route::get('emitit/{id}', [FacturaController::class, 'factura'])->name('factura.factura');
        Route::get('filtrados', [FacturaController::class, 'filtrados'])->name('factura.filtrados');
        Route::get('reportes', [FacturaController::class, 'reportes'])->name('factura.reportes');
        Route::post('reportes/mensual', [FacturaController::class, 'reporteMensual'])->name('factura.reporteMensual');
    });

    // rutas para sugerencias
    Route::prefix('sugerencias')->group(function () {
        Route::get('incio', [SugerenciasController::class, 'index'])->name('suge.index');
        Route::post('store', [SugerenciasController::class, 'store'])->name('suge.store');
        Route::delete('delete/{id}', [SugerenciasController::class, 'destroy'])->name('suge.destroy');
    });

    Route::resource('proyectos', 'ProyectoController');

    Route::prefix('abono-proyecto')->group(function () {
        Route::post('sotre', [AbonoProyectoController::class, 'store'])->name('abp.store');
        Route::delete('destroy/{id}', [AbonoProyectoController::class, 'destroy'])->name('abp.destroy');
        Route::get('recibo/{id}', [AbonoProyectoController::class, 'print_abono'])->name('abp.print_abono');
    });

    Route::prefix('archivos')->group(function () {
        Route::get('index', [ArchivoController::class, 'index'])->name('archi.index');
        Route::post('store', [ArchivoController::class, 'store'])->name('archi.store');
        Route::delete('destroy/{id}', [ArchivoController::class, 'delte'])->name('archi.delete');
        Route::get('perfil/{id}', [ArchivoController::class, 'show'])->name('archi.show');
        Route::post('foto-archivos', [ArchivoController::class, 'setFirma'])->name('arch.setFirma');
        Route::get('foto-archivos-eliminar/{id}', [ArchivoController::class, 'deleteFotoToArchivos'])->name('archi.deleteFotoToArchivos');
        Route::get('reportes/', [ArchivoController::class, 'reportes'])->name('archi.reportes');
        Route::post('getFotoToArchivoReport', [ArchivoController::class, 'getFotoToArchivoReport'])->name('archi.getFotoToArchivoReport');

        Route::post('setFotoMultiple', [ArchivoController::class, 'setFotoMultiple'])->name('archi.setFotoMultiple');
    });

    Route::prefix('tablas')->group(function () {
        Route::get('index/', [TablaController::class, 'index'])->name('table.index');
        Route::post('store', [TablaController::class, 'store'])->name('table.store');
        Route::get('perfil/{id}', [TablaController::class, 'show'])->name('table.show');
        Route::delete('destroy/{id}', [TablaController::class, 'destroy'])->name('table.destroy');
        Route::put('actualizar/{id}', [TablaController::class, 'update'])->name('table.update');
    });


    // mobiliario y equipo
    Route::prefix('mobiliario-equipo')->group(function () {
        Route::get('', [MobiliarioEquipoController::class, 'index'])->name('mobiliario.index');
        Route::get('/create', [MobiliarioEquipoController::class, 'create'])->name('mobiliario.create');
        Route::get('show/{id}', [MobiliarioEquipoController::class, 'show'])->name('mobiliario.show');
        Route::post('', [MobiliarioEquipoController::class, 'store'])->name('mobiliario.store');
        Route::put('/{id}', [MobiliarioEquipoController::class, 'update'])->name('mobiliario.update');
        Route::delete('/{id}', [MobiliarioEquipoController::class, 'delete'])->name('mobiliario.delete');
        // reportes

        Route::get('reporte/', [MobiliarioEquipoController::class, 'reporte'])->name('mobiliario.reporte');
        Route::get('reporte/mobililarios', [MobiliarioEquipoController::class, 'allreport'])->name('mobiliario.allreport');
        Route::get('reporte/mobililarios/control', [MobiliarioEquipoController::class, 'allcontrol'])->name('mobiliario.allcontrol');
    });
});
