@extends('layouts.admin.base')

@section('title_page_header', 'Categorias')

@section('description_page_header', 'lista de categoría')

@section('content')

<div class="box">
            <div class="box-header">
              <a href="{{ route('picCategories.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Nuevo</a>
              {{-- <a href="{{ route('tattoos.multi.show') }}" class="btn btn-success"><i class="fa fa-plus"></i> Agregar varios</a> --}}
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Posición</th>
                  <th>Título</th>
                  <th>Categoria</th>
                  <th>Image</th>
                  <th>Image2</th>
                  <th>Premium</th>
                  <th>Options</th>                  
                </tr>
                </thead>
                <tbody>
                @foreach ($list as $item)
                <tr>
                  <td>{{ $item->position }}</td>
                  <td>{{ $item->title }}</td>
                  @if ($item->pic_category_id)
                    <td>{{ $item->category->title }}</td>
                  @else
                    <td>--</td>
                  @endif
                  <td><img src="{{ $item->url_thumbnail_image }}" alt=""></td>
                  <td><img src="{{ $item->url_thumbnail_image2 }}" alt=""></td>
                  <td>{{ $item->premium }}</td>
                  <td>
                    <a href="{{ route('picCategories.edit', $item->id) }}" class="btn btn-warning btn-sm pull-left"><i class="fa fa-refresh"></i> update</a>
                    <a 
                      href="{{ route('picCategories.destroy', $item->id) }}" 
                      class="btn btn-danger btn-sm pull-left"
                      onclick="event.preventDefault();
                                if (confirm('Esta seguro de eliminar la categoria {{ $item->description }}?')) {
                                  document.getElementById('destroy-form-{{ $item->id }}').submit();
                                } else {
                                }"
                    >
                      <i class="fa  fa-trash"></i> 
                      delete
                    </a>
                    {{ Form::open(array('route' => array('picCategories.destroy', $item->id), 'method' => 'delete', 'id'=>'destroy-form-'. $item->id)) }}                       
                    {{ Form::close() }}
                    
                    <a href="{{ route('picCategories.images.show', $item->id) }}" class="btn btn-success btn-sm pull-left"><i class="fa fa-picture-o"></i> IMG</a>
                  </td>
                </tr>  
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Posición</th>
                  <th>Título</th>
                  <th>Categoria</th>
                  <th>Image</th>
                  <th>Image2</th>
                  <th>Premium</th>
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