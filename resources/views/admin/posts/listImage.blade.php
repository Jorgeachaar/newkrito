@extends('layouts.admin.base')

@section('title_page_header', 'Imagenes para el post: ' . $post->title)

@section('description_page_header', 'Imágenes')

@section('content')

    {!! Form::open(['method' => 'POST', 'route' => 'posts.images.store', 'enctype'=>'multipart/form-data']) !!}

      {!! Form::hidden('post_id', $post->id)!!}
      {!! Form::file('image[]', array('multiple'=>true)) !!}

      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Aceptar</button>
      </div>

    {!! Form::close() !!}
    
    <h3>Lista de imagenes</h3>
    
    <div class="row" style="margin-left: 10px">
      @foreach ($post->images as $image)
        <div class="pull-left">
          <div class="thumbnail">
            <img src="{{ $image->image }}" alt="">
            {{-- <img src="{{ $image->url_thumbnail_image }}" alt=""> --}}
            {{-- <div class="caption">
            {{ Form::model($image, array('route' => array('picCategoryImages.update', $image->id), 'method' => 'PUT')) }}
                {!! Field::number('position') !!}
                <button type="submit" class="btn btn-primary">Refrescar</button>
            {{ Form::close() }}
              <p><a 
                  href="{{ route('picCategoryImages.destroy', $image->id) }}" 
                  class="btn btn-danger btn-sm"
                  onclick="event.preventDefault();
                          if (confirm('Esta seguro de eliminar la imagen?')) {
                            document.getElementById('destroy-form-{{ $image->id }}').submit();
                          } else {
                          }"
              >
                <i class="fa  fa-trash"></i> 
                delete
              </a></p>
              {{ Form::open(array('route' => array('picCategoryImages.destroy', $image->id), 'method' => 'delete', 'id'=>'destroy-form-'. $image->id)) }}
              {{ Form::close() }}
            </div> --}}
          </div>
        </div>
      @endforeach
    </div>






@endsection

