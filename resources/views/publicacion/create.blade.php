@extends('layouts.primary')

@section('content')
<!-- Contenido -->

        <div class="container-fluid">
            <form accept-charset="UTF-8" enctype="multipart/form-data" action="{{route('publicaciones.store')}}" method="post">
            @csrf
            <div class="row page-titles">
                <div class="col-12 align-self-center">
                    <h4 class="text-themecolor">Nueva publicación</h4>
                    <small class="breadcrums"><a href="index.html">Resumen</a> <i class="fa fa-caret-right" aria-hidden="true"></i> <a href="{{route('publicaciones.index')}}">Publicaciones</a> <i class="fa fa-caret-right" aria-hidden="true"></i> Añadir publicación</small>
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 col-md-12 col-lg-9">
                    <div class="card">
                        <div class="card-body">
                            <h5>Información general</h5>
                            <div class="row">
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="nombre">Título</label>
                                        <input type="text" name="name" class="form-control" placeholder="" required>
                                    </div>
                                </div>
                                <div class="col-sm-6 col-lg-6">
                                    <div class="form-group">
                                        <label for="nombre">Categoría</label>
                                        <select class="form-control" name="category" id="">
                                            @foreach ($categorias as $category)
                                                <option value="{{$category->id}}">{{$category->title}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-12 col-lg-12">
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea1">Introducción</label>
                                        <textarea name="introduction" class="form-control" rows="2" maxlength="250" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlTextarea2">Descripción</label>
                                        <textarea name="description" id="editor" class="form-control" rows="2" required></textarea>
                                    </div>
                                    <div class="form-group">
                                        <label for="nombre">Etiquetas</label>
                                        <input type="text" name="topic" class="form-control" placeholder="" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mb-4">
                              <button type="submit" name="publicar" value="1" class="btn btn-info"><i class="fa fa-send-o"></i> Publicar</button> ó
                              <button type="submit" name="borrador" value="1" class="btn btn-info"><i class="fa fa-save"></i> Guardar borrador</button>
                        </div>
                    </div>
                </div>

                <div class="col-12 col-sm-12 col-md-12 col-lg-3">
                    <div class="card">
                        <div class="card-body">
                            <h5>Imagen principal</h5>
                            <label class="fileContainer">
                                <i class="fa fa-picture-o"></i>
                                <input type="file" name="myfile" accept="image/jpg,image/png" />
                            </label>
                            <div class="text-center">
                                Subir imagen
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </form>
        </div>
    <!-- /Contenido -->
@endsection
@section('script')
<script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
<script>
    CKEDITOR.replace( 'editor' );
</script>
@endsection