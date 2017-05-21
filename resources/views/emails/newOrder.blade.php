<p>Numero de pedido: {{ $order->id }}</p>
<p>Nombre: {{ $order->name }}</p>
<p>Email: {{ $order->email }}</p>
<p>Phone: {{ $order->phone }}</p>


<h3>Items</h3>

<table>
<caption>Items</caption>
	<thead>
		<tr>
			<th>Producto</th>
			<th>precio</th>
			<th>cantidad</th>
			<th>total</th>
		</tr>
	</thead>
	<tbody>
		@foreach ($order->items as $item)
					<tr>
						<td>{{ $item->id }}</td>
						<td>{{ $item->price }}</td>
						<td>{{ $item->qty }}</td>
						<td>{{ $item->price  * $item->qty }}</td>
					</tr>
		@endforeach
					<tr>
						<td>Total</td>
						<td></td>
						<td></td>
						<td>{{ $order->subtotal }}</td>
					</tr>
	</tbody>
</table>

