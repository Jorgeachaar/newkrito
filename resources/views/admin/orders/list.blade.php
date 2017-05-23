@extends('layouts.admin.base')

@section('title_page_header', 'Pedidos: ')

@section('description_page_header', '')

@section('content')

<div class="box">
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Total</th>
                  <th>cart_paypal</th>
                  <th>Options</th>                  
                </tr>
                </thead>
                <tbody>
                @foreach ($orders as $item)
                <tr>
                  <td>{{ $item->id }}</td>
                  <td>{{ $item->subtotal }}</td>
                  <td>{{ $item->subtotal }}</td>
                  <td>
                    <a href="{{ route('orders.edit', $item->id) }}" class="btn btn-warning btn-sm pull-left"><i class="fa fa-refresh"></i> update</a>
                    <a 
                      href="{{ route('orders.destroy', $item->id) }}" 
                      class="btn btn-danger btn-sm pull-left"
                      onclick="event.preventDefault();
                                if (confirm('Esta seguro de eliminar el pedido {{ $item->id }}?')) {
                                  document.getElementById('destroy-form-{{ $item->id }}').submit();
                                } else {
                                }"
                    >
                      <i class="fa  fa-trash"></i> 
                      delete
                    </a>
                    {{ Form::open(array('route' => array('orders.destroy', $item->id), 'method' => 'delete', 'id'=>'destroy-form-'. $item->id)) }}
                    {{ Form::close() }}
                    <a href="{{ route('orders.edit', $item->id) }}" class="btn btn-warning btn-sm pull-left"><i class="fa fa-refresh"></i> details</a>
                  </td>
                </tr>  
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>id</th>
                  <th>Total</th>
                  <th>cart_paypal</th>
                  <th>Options</th>
                </tr>
                </tfoot>
              </table>
            </div>
            <!-- /.box-body -->
          </div>

@endsection

@section('js')
<script type="text/javascript">
	$(document).ready(function() {		
		$("#example1").DataTable();		
	});		
</script>
@endsection