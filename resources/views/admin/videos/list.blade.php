@extends('layouts.admin.base')

@section('title_page_header', 'Videos')

@section('description_page_header', 'lista de videos')

@section('content')

<div class="box">
            <div class="box-header">
              <a href="{{ route('videos.create') }}" class="btn btn-success"><i class="fa fa-plus"></i> Nuevo</a>
              {{-- <a href="{{ route('tattoos.multi.show') }}" class="btn btn-success"><i class="fa fa-plus"></i> Agregar varios</a> --}}
            </div>
            <!-- /.box-header -->
            <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                <thead>
                <tr>
                  <th>Posición</th>
                  <th>Título</th>
                  <th>url</th>
                  <th>Premium</th>
                  <th>Options</th>                  
                </tr>
                </thead>
                <tbody>
                @foreach ($list as $item)
                <tr>
                  <td>{{ $item->position }}</td>
                  <td>{{ $item->title }}</td>
                  <td>{{ $item->url }}</td>
                  <td>{{ $item->premium }}</td>
                  <td>
                    <a href="{{ route('videos.edit', $item->id) }}" class="btn btn-warning btn-sm pull-left"><i class="fa fa-refresh"></i> update</a>
                    <a 
                      href="{{ route('videos.destroy', $item->id) }}" 
                      class="btn btn-danger btn-sm pull-left"
                      onclick="event.preventDefault();
                                if (confirm('Esta seguro de eliminar el video {{ $item->title }}?')) {
                                  document.getElementById('destroy-form-{{ $item->id }}').submit();
                                } else {
                                }"
                    >
                      <i class="fa  fa-trash"></i> 
                      delete
                    </a>
                    {{ Form::open(array('route' => array('videos.destroy', $item->id), 'method' => 'delete', 'id'=>'destroy-form-'. $item->id)) }}
                    {{ Form::close() }}
                  </td>
                </tr>  
                @endforeach
                </tbody>
                <tfoot>
                <tr>
                  <th>Posición</th>
                  <th>Título</th>
                  <th>url</th>
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