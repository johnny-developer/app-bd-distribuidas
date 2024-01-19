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
        $resultados_postgres = [];
        return view('home')->with('resultados_postgres', $resultados_postgres);
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


    private function realizarConexionMySQL($datos){
    config(['database.connections.mysql' => [
        'driver' => 'mysql',
        'host' => $datos['clientes_mysql']->host,
        'port' => $datos['clientes_mysql']->puerto, // Agrega el puerto si es necesario
        'database' => $datos['clientes_mysql']->base_datos,
        'username' => $datos['clientes_mysql']->usuario,
        'password' => $datos['clientes_mysql']->password,
        'charset' => 'utf8mb4',
        'collation' => 'utf8mb4_unicode_ci',
        'prefix' => '',
        'strict' => true,
        ]]);
        return DB::connection('mysql');
    }


    public function consultaGlobales()
    {
        $conexiones_postgres = Conexiones::where('sitio', '1')->firstOrFail();
        $clientes_postgres = Clientes::where('sitio', '1')->firstOrFail();
        $ventas_postgres = Ventas::where('sitio', '1')->firstOrFail();
        
        /*
        $conexiones_mysql = Conexiones::where('sitio', '2')->firstOrFail();
        $clientes_mysql = Clientes::where('sitio', '2')->firstOrFail();
        $ventas_mysql = Ventas::where('sitio', '2')->firstOrFail();
        */
        return [
            'conexiones_postgres' => $conexiones_postgres,
            'clientes_postgres' => $clientes_postgres,
            'ventas_postgres' => $ventas_postgres,
            /*
            'conexiones_mysql' => $conexiones_mysql,
            'clientes_mysql' => $clientes_mysql,
            'ventas_mysql' => $ventas_mysql,
            */
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
                //$consulta_mysql .= ($consulta_mysql === "") ? $datos['clientes_mysql']->ids : ',' . $datos['clientes_mysql']->ids;
            }
            if ($op == 'nombre') {
                $consulta_postgres .= ($consulta_postgres === "") ? $datos['clientes_postgres']->nombre : ',' . $datos['clientes_postgres']->nombre;
                //$consulta_mysql .= ($consulta_mysql === "") ? $datos['clientes_mysql']->nombre : ',' . $datos['clientes_mysql']->nombre;
            }
            if ($op == 'numero') {
                $consulta_postgres .= ($consulta_postgres === "") ? $datos['clientes_postgres']->numero : ',' . $datos['clientes_postgres']->numero;
                //$consulta_mysql .= ($consulta_mysql === "") ? $datos['clientes_mysql']->numero : ',' . $datos['clientes_mysql']->numero;
            }
        }
        $sitio_conexion = $this->realizarConexionPostgres($datos);
        //$sitio_conexion_mysql = $this->realizarConexionMySQL($datos);

        $tabla_postgres = $datos['clientes_postgres']->tabla;
        //$tabla_mysql = $datos['clientes_mysql']->tabla;

        $resultados_postgres = $sitio_conexion->select("SELECT $consulta_postgres FROM $tabla_postgres");
        //$resultados_mysql = $sitio_conexion_mysql->select("SELECT $consulta_mysql FROM $tabla_mysql");
        
        //return $resultados_postgres;
        //return $resultados_mysql;
        return view('home')->with('resultados_postgres', $resultados_postgres);
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
                //$consulta_mysql .= ($consulta_mysql === "") ? $datos['ventas_mysql']->ids : ',' . $datos['ventas_mysql']->ids;
            }
            if ($op == 'fecha') {
                $consulta_postgres .= ($consulta_postgres === "") ? $datos['ventas_postgres']->fecha : ',' . $datos['ventas_postgres']->fecha;
                //$consulta_mysql .= ($consulta_mysql === "") ? $datos['ventas_mysql']->fecha : ',' . $datos['ventas_mysql']->fecha;
            }
            if ($op == 'id_cliente') {
                $consulta_postgres .= ($consulta_postgres === "") ? $datos['ventas_postgres']->id_cliente : ',' . $datos['ventas_postgres']->id_cliente;
                //$consulta_mysql .= ($consulta_mysql === "") ? $datos['ventas_mysql']->id_cliente : ',' . $datos['ventas_mysql']->id_cliente;
            }
            if ($op == 'id_producto') {
                $consulta_postgres .= ($consulta_postgres === "") ? $datos['ventas_postgres']->id_producto : ',' . $datos['ventas_postgres']->id_producto;
                //$consulta_mysql .= ($consulta_mysql === "") ? $datos['ventas_mysql']->id_producto : ',' . $datos['ventas_mysql']->id_producto;
            }
        }
        $sitio_conexion = $this->realizarConexionPostgres($datos);
        //$sitio_conexion_mysql = $this->realizarConexionMySQL($datos);

        $tabla_postgres = $datos['ventas_postgres']->tabla;
        //$tabla_mysql = $datos['ventas_mysql']->tabla;

        $resultados_postgres = $sitio_conexion->select("SELECT $consulta_postgres FROM $tabla_postgres");
        //$resultados_mysql = $sitio_conexion_mysql->select("SELECT $consulta_mysql FROM $tabla_mysql");

        return view('home')->with('resultados_postgres', $resultados_postgres);
        //return $resultados_mysql;
    }
    

    
}
