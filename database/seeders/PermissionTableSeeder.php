<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions = [

            // admin panel permissions

            [
                'name' => 'admin_panel_access',
                'description' => 'PERMITE EL ACCESO AL SISTEMA'
            ],

            // user permissions

            [
                'name' => 'users_access',
                'description' => 'PERMITE LISTAR LOS USUARIOS'
            ],

            [
                'name' => 'user_edit',
                'description' => 'PERMITE EDITAR LOS USUARIOS'
            ],

            [
                'name' => 'user_delete',
                'description' => 'PERMITE ELIMINAR A UN USUARIO'
            ],

            [
                'name' => 'user_create',
                'description' => 'PERMITE REGISTRAR A UN USUARIO'
            ],

            [
                'name' => 'user_show',
                'description' => 'VER PERFIL DE USUARIO'
            ],


            // role permissions

            [
                'name' => 'roles_access',
                'description' => 'PERMITE LISTAR LOS ROLES'
            ],

            [
                'name' => 'role_edit',
                'description' => 'PERMITE EDITAR LOS ROLES'
            ],

            [
                'name' => 'role_delete',
                'description' => 'PERMITE ELIMINAR UN ROL'
            ],

            [
                'name' => 'role_create',
                'description' => 'PERMITE CREAR UN ROL'
            ],

            [
                'name' => 'role_show',
                'description' => 'PERMITE VISUALIZAR UN ROL'
            ],


            // permission permissions

            [
                'name' => 'permissions_access',
            ],

            [
                'name' => 'permission_edit',
            ],

            [
                'name' => 'permission_delete',
            ],

            [
                'name' => 'permission_create',
            ],

            // ARTICULOS    

            [
                'name' => 'articulos_listado',
                'description' => 'PERMITE LISTAR TODOS LOS ARTICULOS'
            ],
            [
                'name' => 'articulos_show',
                'description' => 'PERMITE VER Y ACTUALIZR EL PERFIL DE LOS ARTICULOS'
            ],
            [
                'name' => 'articulos_store',
                'description' => 'PERMITE REGISTAR UN NUEVO ARTICULO'
            ],
            [
                'name' => 'articulos_delete',
                'description' => 'PERMITE ELIMINAR UN ARTICULO'
            ],
            [
                'name' => 'articulos_min_stock',
                'description' => 'PERMITE VISUALIZAR LOS ARTICULOS CON MINIMO DE STOCK'
            ],
            [
                'name' => 'articulos_compra_store',
                'description' => 'PERMITE GURARDAR UNA COMPRA DE UN ARTICULO YA EXISTENTE'
            ],
            [
                'name' => 'articulos_historial',
                'description' => 'PERMITE VER EL HISTORIAL DE COMPRAS DE LOS ARTICULOS'
            ],
            [
                'name' => 'articulos_hitorial_delete',
                'description' => 'PERMITE ELIMINAR UN ARTICULO DEL HISTORIAL DE COMPRAS'
            ],
            [
                'name' => 'articulos_report_all',
                'description' => 'PERMITE VER TODOS LOS REPORTES DE LOS ARTICULOS'
            ],
            [
                'name' => 'articulos_catalogo_add',
                'description' => 'PERMITE AÑADIR UN ARTICULO PARA EL CATALOGO'
            ],
            [
                'name' => 'articulos_catalogo_update',
                'description' => 'PERMITE ACTUALIZAR UN ARTICULO EN CATALOGO'
            ],
            [
                'name' => 'articulos_catalog_delete',
                'description' => 'PERMITE ELIMINAR UN ARTICULO EN CATLOGO'
            ],
            [
                'name' => 'articulos_catalogo_report',
                'description' => 'PERMITE GENERAR EL REPORTE DE ARTICULOS EN CATALOGO'
            ],


            // CLIENTES
            [
                'name' => 'clientes_all',
                'description' => 'PERMITE USO DE MODULO DE CLIENTES'
            ],

            // CATEGORIAS
            [
                'name' => 'categoria_list',
                'description' => 'PERMITE LISTAR TODAS LAS CATEGORIAS'
            ],
            [
                'name' => 'categoria_show',
                'description' => 'PERMITE VER EL PERFIL DE CATEGORIAS / ACTUALIZAR'
            ],
            [
                'name' => 'categoria_delete',
                'description' => 'PERMITE ELIMINAR UNA CATEGORIA'
            ],
            [
                'name' => 'categoria_create',
                'description' => 'PERMITE CREAR UNA NUEVA CATEGORIA'
            ],
            [
                'name' => 'categoria_report',
                'description' => 'PERMITE GENERAR EL REPORTE DE CATEGORIAS'
            ],

            // VENTAS
            [
                'name' => 'venta_inicio',
                'description' => 'PERMITE REALIZAR VENTAS E IMPRIMIR RECIBOS'
            ],
            [
                'name' => 'venta_historial',
                'description' => 'PERMITE VER EL HITORIAL DE VENTAS'
            ],
            [
                'name' => 'venta_recibo',
                'description' => 'PERMITE LA REIMPRESION DE RECIBOS DE VETAS'
            ],
            [
                'name' => 'venta_anulacion',
                'description' => 'PERMITE LA ANULACION DE UNA VENTA'
            ],
            [
                'name' => 'venta_reports',
                'description' => 'PERMITE GENERAR TODOS LOS REPORTES DE VENTAS'
            ],

            // caja
            [
                'name' => 'caja_registro_cajachica',
                'description' => 'PERMITE REGISTRAR DATOS EN CAJA CHICA'
            ],
            [
                'name' => 'caja_registro_gastos',
                'description' => 'PERMITE REGISTRAR GASTOS'
            ],
            [
                'name' => 'caja_cuadre',
                'description' => 'PERMITE REALIZAR UN CUADRE'
            ],
            [
                'name' => 'caja_cuadre_delete',
                'description' => 'PERMITE ELIMINAR REPORTE DE CUADRES DE CAJA'
            ],
            [
                'name' => 'caja_delete_cajachica',
                'description' => 'PERMITE ELIMINAR UN DATO DE CAJA CHICA'
            ],
            [
                'name' => 'caja_delete_gasto',
                'description' => 'PERMITE ELIMINAR UN DATO DE GASTOS'
            ],
            [
                'name' => 'caja_filtrado_cajachica',
                'description' => 'PERMITE VER MOVIMIENTOS DE CAJA CHICA FILTRADOS'
            ],
            [
                'name' => 'caja_filtrado_gastos',
                'description' => 'PERMITE VER MOVIMIENTOS DE GASTOS FILTRADOS'
            ],
            [
                'name' => 'caja_movimientos_filtrados',
                'description' => 'PERMITE VER LOS MOVIMIENTOS DEL MES / FILTRADOS'
            ],
            [
                'name' => 'caja_movimientos_dia',
                'description' => 'PERMITE VER LOS MOVIMIENTOS DEL DIA'
            ],
            // tracking
            [
                'name' => 'tracking_all',
                'description' => 'PERMITE USO DE MODULO DE TRACKINGS'
            ],

            // PROVEEDORES  
            [
                'name' => 'proveedor_list',
                'description' => 'PERMITE LISTAR A TODOS LOS PROVEEDORES'
            ],
            [
                'name' => 'proveedor_all',
                'description' => 'PERMITE VISUALIZAR EL PERFIL DE CADA PROVEEDOR PARA ACTUALIZAR DATOS Y ASIGNAR FACTURAS DE PAGO'
            ],
            [
                'name' => 'proveedor_create',
                'description' => 'PERMITE REGISTRAR UN NUEVO PROVEEDOR'
            ],

            [
                'name' => 'caja_independiente',
                'description' => 'PERMITE TENER CONTROL TOTAL DE CAJA INDEPENDIENTE'
            ],
            [
                'name' => 'table_all',
                'description' => 'PERMITE TENER CONTROL TOTAL DE MODULO DE TABLAS'
            ],
            [
                'name' => 'perdidas',
                'description' => 'PERMITE TENER CONTROL TOTAL DE MODULO DE PERDIDAS'
            ],
            [
                'name' => 'admin',
                'description' => 'PERMISOS SOLO PARA ADMINISTRADOR'
            ]

        ];

        foreach ($permissions as $permission) {
            Permission::create($permission);
        }
    }
}
