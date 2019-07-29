@extends('layouts.auth')

@section('content')
  <div id="loginFullContainer" class="vhflex" style="width:100%;min-height:100vh;">
      <div id="loginContainer" class="row">
          <div id="loginImg" class="col-sm-6 d-none d-sm-block">
          </div>
          <div class="col-sm-6 vhflex">
              <div class="text-center">
                  <img id="logo" src="/assets/img/logo-hor-gde.png" alt="Logotipo">
                  <form method="POST" action="{{ route('password.email') }} " class="form-row mt-4">
                    @csrf
                      <div class="col-10 mx-auto">
                          <div class="form-group text-left">
                              <label for="">Correo electrónico</label>
                              <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>

                              @if ($errors->has('email'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>Direccion invalida o no registrada</strong>
                                  </span>
                              @endif

                          </div>
                      </div>


                      <div class="col-6 mx-auto">
                        <button type="submit" class="btn btn-info btn-block btn-lg">
                            {{ __('Recuperar contraseña') }}
                        </button>

                      </div>
                  </form>
                  <div id="urls" class="row fixed-bottom">
                      <div class="col-12">
                          <p><small><a href="#">Aviso de Privacidad</a> | <a href="#">Términos y condiciones</a></small></p>
                      </div>
                  </div>
              </div>
          </div>
      </div>
  </div>

@endsection
