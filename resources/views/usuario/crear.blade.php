@extends('layouts.primary')

@section('content')
  <div class="container-fluid">

      <div class="row page-titles">
          <div class="col-12 align-self-center">
              <h4 class="text-themecolor">Nuevo usuario</h4>
               <small class="breadcrums"><a href="index.html">Resumen</a> <i class="fa fa-caret-right" aria-hidden="true"></i> <a href="usuarios.html">Usuarios</a> <i class="fa fa-caret-right" aria-hidden="true"></i> Añadir usuario</small>
          </div>
      </div>

      <div class="row">
          <div class="col-12">
              <div class="card">
                  <div class="card-body">
                      <h5>Información</h5>
                      <form>
                        <div class="row">
                            <div class="col-12">
                                  <div class="form-group">
                                      <div class="avatar-upload">
                                          <div class="avatar-edit">
                                              <input type='file' id="imageUpload" name="myfile" accept=".png, .jpg, .jpeg" />
                                              <label for="imageUpload"></label>
                                          </div>
                                          <div class="avatar-preview">
                                              <div id="imagePreview"></div>
                                          </div>
                                          <div class="text-center mt-2">Subir Foto/Logotipo</div>
                                      </div>
                                  </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                  <div class="form-group">
                                      <label for="">Nombre<span class="requerido">*</span></label>
                                      <input type="text" class="form-control" id="exampleFormControlInput1" name="nombres" placeholder="">
                                  </div>
                            </div>
                            <div class="col-12 col-sm-4">
                                  <div class="form-group">
                                      <label for="">Apellido<span class="requerido">*</span></label>
                                      <input type="text" class="form-control" id="exampleFormControlInput1" name="apellidos" placeholder="">
                                  </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                  <div class="form-group">
                                      <label for="origin">Empresa<span class="requerido">*</span></label>
                                      <input type="text" class="form-control" id="exampleFormControlInput1" name="empresa" placeholder="">
                                  </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                  <div class="form-group">
                                      <label for="">Correo electrónico<span class="requerido">*</span></label>
                                      <input type="email" class="form-control" id="exampleFormControlInput1" name="email" placeholder="" required>
                                  </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                  <div class="form-group">
                                      <label for="">Celular</label>
                                      <input type="tel" class="form-control" name="celular" id="exampleFormControlInput1" placeholder="">
                                  </div>
                            </div>

                            <div class="col-12 col-sm-4">
                                  <div class="form-group">
                                      <label for="">Rol</label>
                                      <select class="form-control" id="exampleFormControlSelect1" name="rol">
                                          <option>Seleccionar...</option>
                                          <option>Administrador</option>
                                          <option>Cliente</option>
                                      </select>
                                  </div>
                            </div>

                            <div class="col-12">
                                  <div class="form-group">
                                      <label for="">Datos fiscales</label>
                                      <textarea class="form-control" id="" name="datos_fiscales" rows="3" Placeholder="(Sólo si es cliente)"></textarea>
                                  </div>
                            </div>


                        </div>
                        <div class="mt-4"></div>
                      </form>
                      <div class="row mt-5">
                          <div class="col-12">
                              <h5>Proyectos</h5>
                              <hr>
                          </div>
                          <div class="col-12">
                              <form class="form-row" action="#">
                                  <div class="col-12 col-sm-6">
                                      <div class="form-group">
                                          <label for="">Proyecto<span class="requerido">*</span></label>
                                          <select class="form-control" id="exampleFormControlSelect1">
                                              <option>Seleccionar...</option>
                                              <option>Proyecto 1</option>
                                              <option>Proyecto 2</option>
                                              <option>Proyecto 3</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-12 col-sm-6">
                                      <div class="form-group">
                                          <label for="">Rol<span class="requerido">*</span></label>
                                          <select class="form-control" id="exampleFormControlSelect1">
                                              <option>Seleccionar...</option>
                                              <option>Administrador A</option>
                                              <option>Administrador B</option>
                                              <option>Administrador C</option>
                                              <option>Colaborador</option>
                                              <option>Cliente</option>
                                          </select>
                                      </div>
                                  </div>
                                  <div class="col-12 text-right mt-2">
                                      <button class="btn btn-primary btn-sm">
                                          + Asignar proyecto
                                      </button>
                                  </div>
                              </form>
                          </div>
                          <div class="col-12 text-center mt-5 mb-4">
                              <button class="btn btn-info">Crear usuario</button>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
      </div>

  </div>
@endsection
