<form action="{{ route('consultar.clientes') }}" method="post">
    <h1>clientes</h1>
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