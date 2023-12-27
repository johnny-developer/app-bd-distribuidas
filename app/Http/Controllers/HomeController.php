<?php

namespace App\Http\Controllers;

use App\Models\Clientes;
use App\Models\Conexiones;
use App\Models\Ventas;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpFoundation\Exception\BadRequestException;

class HomeController extends Controller
{
    public function __invoke() {
        return view('home');
    }
    
    public function realizarConexionPostgres($datos){
        $config = [
            'driver' => 'pgsql',
            'host' => $datos['conexiones_postgres']->ip,
            'port' => $datos['conexiones_postgres']->puerto,
            'database' => $datos['conexiones_postgres']->bd,
            'username' => $datos['conexiones_postgres']->usuario,
            'password' => $datos['conexiones_postgres']->contraseña,
        ];
        DB::purge('pgsql');
        config(['database.connections.pgsql' => $config]); 
        return DB::connection('pgsql');
    }

    public function consultaGlobales()
    {
        $conexiones_postgres = Conexiones::where('sitio', '1')->firstOrFail();
        $clientes_postgres = Clientes::where('sitio', '1')->firstOrFail();
        $ventas_postgres = Ventas::where('sitio', '1')->firstOrFail();
        //$conexiones_mysql = Conexiones::where('sitio', '2')->firstOrFail();
        //$clientes_mysql = Clientes::where('sitio', '2')->firstOrFail();
        //$ventas_mysql = Ventas::where('sitio', '2')->firstOrFail();
        return [
            'conexiones_postgres' => $conexiones_postgres,
            'clientes_postgres' => $clientes_postgres,
            'ventas_postgres' => $ventas_postgres,
            //'conexiones_mysql' => $conexiones_mysql,
            //'clientes_mysql' => $clientes_mysql,
            //'ventas_mysql' => $ventas_mysql,
            
        ];
    }

    

    public function consultarClientes(Request $request)
    {
        $opciones = $request->input('opciones1', []);
        $datos = $this->consultaGlobales();
        $consulta_postgres = "";
        $consulta_mysql = "";
        foreach ($opciones as $op) {
            if ($op == 'ids') {
                $consulta_postgres .= ($consulta_postgres === "") ? $datos['clientes_postgres']->ids : ',' . $datos['clientes_postgres']->ids;
                // Lo mismo para los clientes MySQL
            }
            if ($op == 'nombre') {
                $consulta_postgres .= ($consulta_postgres === "") ? $datos['clientes_postgres']->nombre : ',' . $datos['clientes_postgres']->nombre;
                // Lo mismo para los clientes MySQL
            }
            if ($op == 'numero') {
                $consulta_postgres .= ($consulta_postgres === "") ? $datos['clientes_postgres']->numero : ',' . $datos['clientes_postgres']->numero;
                // Lo mismo para los clientes MySQL
            }
        }
        $sitio_conexion = $this->realizarConexionPostgres($datos);
        $tabla_postgres = $datos['clientes_postgres']->tabla;
        $resultados_postgres = $sitio_conexion->select("SELECT $consulta_postgres FROM $tabla_postgres");
        
        //TODO: Falta implementar las consultas a la base de datos del equipo mysql.

        return $resultados_postgres;
        //return view("home", ["resultados_postgres" => $resultados_postgres]);
    }

    

    public function consultarVentas(Request $request)
    {
        $opciones = $request->input('opciones2', []);
        $datos = $this->consultaGlobales();
        $consulta_postgres = "";
        $consulta_mysql = "";
        foreach ($opciones as $op) {
            if ($op == 'ids') {
                $consulta_postgres .= ($consulta_postgres === "") ? $datos['ventas_postgres']->ids : ',' . $datos['ventas_postgres']->ids;
                // Lo mismo para los clientes MySQL
            }
            if ($op == 'fecha') {
                $consulta_postgres .= ($consulta_postgres === "") ? $datos['ventas_postgres']->fecha : ',' . $datos['ventas_postgres']->fecha;
                // Lo mismo para los clientes MySQL
            }
            if ($op == 'id_cliente') {
                $consulta_postgres .= ($consulta_postgres === "") ? $datos['ventas_postgres']->id_cliente : ',' . $datos['ventas_postgres']->id_cliente;
                // Lo mismo para los clientes MySQL
            }
            if ($op == 'id_producto') {
                $consulta_postgres .= ($consulta_postgres === "") ? $datos['ventas_postgres']->id_producto : ',' . $datos['ventas_postgres']->id_producto;
                // Lo mismo para los clientes MySQL
            }
        }
        $sitio_conexion = $this->realizarConexionPostgres($datos);
        $tabla_postgres = $datos['ventas_postgres']->tabla;
        $resultados_postgres = $sitio_conexion->select("SELECT $consulta_postgres FROM $tabla_postgres");
        
        //TODO: Falta implementar las consultas a la base de datos del equipo mysql.

        return $resultados_postgres;
        //return view("home", ["resultados_postgres" => $resultados_postgres]);
    }
    

    
}
