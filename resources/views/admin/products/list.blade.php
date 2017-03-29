@extends('layouts.admin.base')

@section('title_page_header', 'Productos de la categoria: ' . $category->title)

@section('description_page_header', '')

@section('content')

<div class="box">
            <div class="box-header">
              <a href="{{ route('products.create') }}" class="btn btn-success" 
                onclick=" event.preventDefault();
                          document.getElementById('create-form-{{ $category->id }}').submit();
                        "
              ><i class="fa fa-plus"></i> Nuevo</a>
              {{ Form::open(array('route' => array('products.create', $category->id), 'method' => 'get', 'id'=>'create-form-'. $category->id)) }}
                {!! Form::hidden('id', $category->id) !!}                       
              {{ Form::close() }}
              {{-- <a href="{{ route('tattoos.multi.show') }}" class="btn btn-success"><i class="fa fa-plus"></i> Agregar varios</a> --}}
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>id</th>
                  <th>Título</th>
                  <th>Precio</th>
                  <th>Options</th>                  
                </tr>
                </thead>
                <tbody>
                @foreach ($category->products as $item)
                <tr>
                  <td>{{ $item->id }}</td>
                  <td>{{ $item->title }}</td>
                  <td>{{ $item->price }}</td>
                  <td>
                    <a href="{{ route('productCategory.edit', $item->id) }}" class="btn btn-warning btn-sm pull-left"><i class="fa fa-refresh"></i> update</a>
                    <a 
                      href="{{ route('productCategory.destroy', $item->id) }}" 
                      class="btn btn-danger btn-sm pull-left"
                      onclick="event.preventDefault();
                                if (confirm('Esta seguro de eliminar la categoria {{ $item->title }}?')) {
                                  document.getElementById('destroy-form-{{ $item->id }}').submit();
                                } else {
                                }"
                    >
                      <i class="fa  fa-trash"></i> 
                      delete
                    </a>
                    {{ Form::open(array('route' => array('productCategory.destroy', $item->id), 'method' => 'delete', 'id'=>'destroy-form-'. $item->id)) }}                       
                    {{ Form::close() }}
                    <a href="{{ route('productCategory.edit', $item->id) }}" class="btn btn-warning btn-sm pull-left"><i class="fa fa-refresh"></i> update</a>
                    
                  </td>
                </tr>  
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>id</th>
                  <th>Título</th>
                  <th>Price</th>
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