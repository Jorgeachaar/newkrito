@extends('layouts.admin.base')

@section('title_page_header', 'Posts')

@section('description_page_header', '')

@section('content')

<div class="box">
            <div class="box-header">
              <a href="{{ route('posts.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Nuevo</a>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Título</th>
                  <th>Fecha</th>
                  <th>Opciones</th>                  
                </tr>
                </thead>
                <tbody>
                @foreach ($list as $item)
                <tr>
                  <td>{{ $item->title }}</td>
                  <td>{{ $item->created_at->format('M jS Y') }}</td>
                  <td>
                    <a href="{{ route('posts.edit', $item->id) }}" class="btn btn-warning btn-sm pull-left"><i class="fa fa-refresh"></i> update</a>
                    <a 
                      href="{{ route('posts.destroy', $item->id) }}" 
                      class="btn btn-danger btn-sm pull-left"
                      onclick="event.preventDefault();
                                if (confirm('Esta seguro de eliminar el post {{ $item->title }}?')) {
                                  document.getElementById('destroy-form-{{ $item->id }}').submit();
                                } else {
                                }"
                    >
                      <i class="fa  fa-trash"></i> 
                      delete
                    </a>
                    {{ Form::open(array('route' => array('posts.destroy', $item->id), 'method' => 'delete', 'id'=>'destroy-form-'. $item->id)) }}                       
                    {{ Form::close() }}
                    
                    {{-- <a href="{{ route('picCategories.images.show', $item->id) }}" class="btn btn-success btn-sm pull-left"><i class="fa fa-picture-o"></i> IMG</a> --}}
                  </td>
                </tr>  
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Título</th>
                  <th>Fecha</th>
                  <th>Opciones</th> 
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