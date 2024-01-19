<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!--<link rel="stylesheet" type="text/css" href="../resources/css/styles.css">-->
    <title>App-bd-distribuidas</title>
    <style>
        * {
            margin: 5px;
        }

        body {
            font-family: Arial, sans-serif;
            background-color: #f2f2f2;
        }

        form {
            margin: 20px;
            padding: 20px;
            border: 1px solid #ccc;
        }

        h1 {
            color: #333;
        }

        input[type="checkbox"] {
            margin-right: 5px;
        }

        button {
            background-color: #4CAF50;
            color: white;
            padding: 10px 15px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .resizable {
            overflow: hidden;
            position: relative;
        }

        .resizable table {
            table-layout: fixed;
            border-collapse: collapse;
            width: 100%;
        }

        .resizable th,
        .resizable td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
            white-space: nowrap;
        }

        .resizable th {
            background-color: #f2f2f2;
        }

        .resizable-handle {
            position: absolute;
            height: 100%;
            width: 10px;
            background: #ddd;
            right: 0;
            cursor: ew-resize;
        }

        #main-container {
            margin: 150px auto;
            width: 600px;
        }

        table {
            background-color: white;
            text-align: left;
            border-collapse: collapse;
            width: 100%;
        }

        th,
        td {
            padding: 20px;
        }

        thead {
            background-color: #769861;
            border-bottom: solid 5px #b2d183;
            color: white;
        }

        tr:nth-child(even) {
            background-color: #ddd;
        }
    </style>
</head>

<body>

    <form action="{{ route('consultar.clientes') }}" method="post">
        <h1>Clientes</h1>
        @csrf
        <input type="checkbox" name="opciones1[]" value="ids"> Consultar los ids de los clientes<br>
        <input type="checkbox" name="opciones1[]" value="nombre"> Consultar los nombres de los clientes<br>
        <input type="checkbox" name="opciones1[]" value="numero"> Consultar los numeros de los clientes <br>
        <button type="submit">Consultar</button>
    </form>



    <form action="{{ route('consultar.ventas') }}" method="post">
        <h1>Ventas</h1>
        @csrf
        <input type="checkbox" name="opciones2[]" value="ids"> Consultar los ids de las ventas<br>
        <input type="checkbox" name="opciones2[]" value="fecha"> Consultar las fechas de las ventas<br>
        <input type="checkbox" name="opciones2[]" value="id_cliente"> Consultar los ids de los cliente de las ventas<br>
        <input type="checkbox" name="opciones2[]" value="id_producto"> Consultar los ids de los productos de las ventas<br>
        <button type="submit">Consultar</button>
    </form>

    <div id="main-container">
        <h2>Sitio agencia de viajes:</h2>
        @if($resultados_postgres && count($resultados_postgres) > 0)
        <table>
            <thead>
                <tr>
                    @foreach(array_keys((array) $resultados_postgres[0]) as $columna)
                    <th>{{ $columna }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($resultados_postgres as $resultado)
                <tr>
                    @foreach((array) $resultado as $valor)
                    <td>{{ $valor }}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>😎👌</p>
        @endif
    </div>

    
    <div id="main-container">
        <h2>Sitio Ferretodo:</h2>
        @if($resultados_mysql && count($resultados_mysql) > 0)
        <table>
            <thead>
                <tr>
                    @foreach(array_keys((array) $resultados_mysql[0]) as $columna)
                    <th>{{ $columna }}</th>
                    @endforeach
                </tr>
            </thead>
            <tbody>
                @foreach($resultados_mysql as $resultado)
                <tr>
                    @foreach((array) $resultado as $valor)
                    <td>{{ $valor }}</td>
                    @endforeach
                </tr>
                @endforeach
            </tbody>
        </table>
        @else
        <p>😎👌</p>
        @endif
    </div>
</body>

</html>