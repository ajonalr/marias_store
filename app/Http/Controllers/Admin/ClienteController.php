<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AbonoCliente;
use App\Models\Caja;
use App\Models\Cliente;
use App\Models\DeudaCliente;
use Facade\FlareClient\Http\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ClienteController extends Controller
{
    // devuelve el lista dode los clientes
    public function index()
    {
        return view('admin.clientes.index', ['clientes' => Cliente::all()]);
    }

    // muetra el perfil de un cliente
    public function show($id)
    {
        $deudas =  DeudaCliente::where('cliente_id', $id)
            ->where('estado', 'DEUDA')
            ->get();
        $pagos = DeudaCliente::where('cliente_id', $id)
            ->where('estado', 'PAGADO')
            ->get();
        $abonos =  AbonoCliente::where('cliente_id', $id)->get();
        return view('admin.clientes.show', ['cliente' => Cliente::find($id), 'deudas' => $deudas, 'pagos' => $pagos, 'abonos' => $abonos]);
    }

    // acctualiza un cliente
    public function update(Request $data, $id)
    {
        $cliente = Cliente::find($id);

        $cliente->nombre = $data->nombre;
        $cliente->nit = $data->nit;
        $cliente->direccion = $data->direccion;
        $cliente->telefono1 = $data->telefono1;
        $cliente->telefono2 = $data->telefono2;
        $cliente->deuda = $data->deuda;
        $cliente->save();

        return back()->with(['info' => "Cliente $cliente->nombre Actualizado Con Exito", 'color' => 'warning']);
    }

    // elimiena un cliente
    public function delete($id)
    {
        $cliente = Cliente::find($id);

        $cliente->delete();
        return back()->with(['info' => "Cliente $cliente->nombre Elimindao Con Exito", 'color' => 'danger']);
    }

    // vista para crear cliene
    public function create()
    {
        return view('admin.clientes.create');
    }

    // gaurada un cliente
    public function store(Request $data)
    {
        $cliente = new Cliente();
        $cliente->nombre = $data->nombre;
        $cliente->nit = $data->nit;
        $cliente->direccion = $data->direccion;
        $cliente->telefono1 = $data->telefono1;
        $cliente->telefono2 = $data->telefono2;
        $cliente->save();
        return back()->with(['info' => "Cliente $cliente->nombre Registrado Con Exito, Su Codigo es:  - $cliente->id -", 'color' => 'success']);
    }

    // devuelve la lista de los deudores para acceder a su perfil
    public function deudores()
    {
        $deudores = $this->deudoresFunction();

        return view('admin.clientes.deudores', ['deudores' => $deudores]);
    }

    // devuelve la vista para imprimir las deudas del cliente
    public function reporteDeudore($id)
    {
        $deuda = DB::table('venta_articulos AS ven')
            ->join('clientes AS cli', 'ven.cliente_id', '=', 'cli.id')
            ->join('articulos AS art', 'ven.articulo_id', '=', 'art.id')
            ->select(
                'ven.id',
                'ven.factura_id',
                'ven.cantidad',
                'ven.cliente_id',
                'ven.total',
                'ven.credito',
                'ven.created_at as fechaVenta',
                'cli.nombre',
                'cli.direccion',
                'cli.telefono1',
                'cli.telefono2',
                'art.nombre as nomArt',
                'art.cod_barras',
                'art.descripcion'
            )
            ->where('cliente_id', $id)
            ->where('ven.credito', 1)
            ->get();

        $totalDeuda = 0;
        $nombre = '';
        foreach ($deuda as $deu) {
            $totalDeuda =  $deu->total + $totalDeuda;
            $nombre = $deu->nombre;
        }



        return view('admin.reports.clientes.deudascliente', ['deuda' => $deuda, 'totalDeuda' => $totalDeuda, 'cliente' => $nombre]);
    }

    // devuelve el listado disponible para clientes 
    public function reportes()
    {
        return view('admin.clientes.reportes');
    }

    // devuenve la vista de toos los deuduoires
    public function reportesAllDeudores()
    {
        $deudores = $this->deudoresFunction();
        return view('admin.reports.clientes.deudores', ['deudores' => $deudores]);
    }

    // reporte gneral de clietes
    public function reportesAllClientes()
    {
        $clientes = Cliente::all();
        $total = 0;
        foreach ($clientes as $cli) {
            $total++;
        }
        return view('admin.reports.clientes.clientes', ['clientes' => $clientes, 'total' => $total]);
    }

    // para reciclado0 de codigo = deurodores alll
    public function deudoresFunction()
    {
        return Cliente::where('deuda', '>', 0)->get();
    }

    // guarda la deuda de un cliente
    public function saveDeuda(Request $request)
    {

        $t_deuda = 0;
        $t_abono = 0;
        $deudas =  DeudaCliente::where('cliente_id', $request->cliente_id)
            ->where('estado', 'DEUDA')
            ->get();

        $abonos =  AbonoCliente::where('cliente_id', $request->cliente_id)->get();

        foreach ($deudas as $d) {
            $t_deuda += $d->total;
        }

        foreach ($abonos as $a) {
            $t_abono += $a->total;
        }

        if (($t_deuda - $t_abono) > 2500 && ($request->salto !== '1')) {
            return back()->with(['info' => "NO SE PUEDE ASIGNAR EL CREIDO YA QUE ESTA BLOQUEADO", 'color' => 'danger']);
        }

        DeudaCliente::create($request->all());
        $cli = Cliente::findOrFail($request->cliente_id);
        $cli->deuda += $request->total;
        $cli->save();


        $caja = new Caja();
        $caja->valor = $request->total;
        $caja->descripcion = "CREDITO DE $cli->nombre por: $request->descripcion";
        $caja->operacion = 'd';
        $caja->fecha = date('Y-m-d');
        $caja->user_id = Auth::user()->id;
        $caja->save();

        return back()->with(['info' => "CREDITO ASIGNADO", 'color' => 'success']);
    }

    public function deleteCredito($id)
    {
        $d = DeudaCliente::findOrfail($id);
        $c = Cliente::find($d->cliente_id);
        $c->deuda-= $d->total;

        $d_caja = Caja::where('operacion', 'd')
        ->whereDate('fecha', $d->created_at)
        ->where('valor', $d->total)
        ->first();    
    

        $d_caja->delete();

        $c->save();
        $d->delete();
        return back()->with(['info' => 'deuda eliminada con exito', 'color' => 'success']);
    }

    // cambia el estado de una deuda a cambiado
    public function pagarDeuda($id)
    {
        $deu = DeudaCliente::findOrFail($id);
        $deu->estado = 'PAGADO';
        $deu->save();
        return back()->with(['info' => "deuda actualizada", 'color' => 'success']);
    }

    // asigna el abono de una deuda
    public function abonosNew(Request $request)
    {
        AbonoCliente::create($request->all());
        $cli = Cliente::findOrFail($request->cliente_id);
        $cli->deuda -= $request->total;
        $cli->save();
        // TODO: pensar en colocar tipo en caja para tenrer referencia de cuadre
        $caja = new Caja();
        $caja->valor = $request->total;
        $caja->descripcion = "ABONO  $cli->nombre por: $request->descripcion";
        $caja->operacion = 'e';
        $caja->fecha = date('Y-m-d');
        $caja->user_id = Auth::user()->id;
        $caja->save();

        return back()->with(['info' => "ABONO REALIZADO CON EXITO", 'color' => 'success']);
    }

    public function deleteAbono($id)
    {
        $a = AbonoCliente::findorfail($id);
        $c = Cliente::find($a->cliente_id);
        $c->deuda += $a->total;
        $c->save();
        $a->delete();
        return back()->with(['info' => 'abono eliminado con exito', 'color' => 'success']);
    }

    // retorna el reporte de ventas de un cliente en concreto
    public function reportVentaToClienteAndDate(Request $request)
    {
        $cliente = Cliente::findOrFail($request->cliente_id);
        $deuda = DeudaCliente::where('cliente_id', $request->cliente_id)
            ->whereBetween('created_at', [$request->inicio, $request->fin])
            ->get();
        $abonos =  AbonoCliente::where('cliente_id', $request->cliente_id)
            ->whereBetween('created_at', [$request->inicio, $request->fin])
            ->get();
        return view('admin.reports.clientes.deudas', ['deudas' => $deuda, 'abonos' => $abonos, 'cli' => $cliente, 'inicio' => $request->inicio, 'fin' => $request->fin]);
    }

    // imprime el recibo de  creditos
    public function print_credito($id)
    {
        $deuda =  DeudaCliente::findOrFail($id);
        return view('admin.reports.clientes.credito', ['data' => $deuda]);
    }

    // imprime el recibo de  abono
    public function print_abonos($id)
    {
        $abono = AbonoCliente::findOrFail($id);
        return view('admin.reports.clientes.abono', ['data' => $abono]);
    }

    // retorna el reporte de los abonos realizado por los clientes
    public function abonos_report_filter(Request $request)
    {
        $data = AbonoCliente::whereBetween('created_at', [$request->inicio, $request->fin])->get();
        return view('admin.reports.clientes.abonos_report', ['data' => $data]);
    }
}
