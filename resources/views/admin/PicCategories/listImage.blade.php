@extends('layouts.admin.base')

@section('title_page_header', 'Imagenes para Categorias: ' . $category->title)

@section('description_page_header', 'lista de categoría de imágenes')

@section('content')

    {!! Form::open(['method' => 'POST', 'route' => 'picCategories.images.store', 'enctype'=>'multipart/form-data']) !!}

      {!! Form::hidden('pic_category_id', $category->id)!!}
      {!! Form::file('image[]', array('multiple'=>true)) !!}

      <div class="box-footer">
        <button type="submit" class="btn btn-primary">Aceptar</button>
      </div>

    {!! Form::close() !!}

    @foreach ($category->images as $image)
      {{ $image->image }}
    @endforeach



@endsection

