<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/



Auth::routes();

Route::group([
  'middleware' => 'auth'
],function(){
  Route::resource('material', 'MaterialController');
  Route::get('/', 'HomeController@resumen')->name('resumen');
  Route::resource('proyectos', 'ProyectoController');
  Route::resource('usuario', 'UsuarioController');
  Route::get('/usuario/delete/{id}', 'UsuarioController@deleteUser')->name('deleteUser');
  Route::resource('mensaje', 'MensajeController');
  Route::resource('categorias', 'BlogCategoryController');
  Route::get('/categorias/delete/{id}', 'BlogCategoryController@deleteCategory')->name('deleteCategory');
  Route::post('/publicaciones/{id}', 'BlogPostController@update');
  Route::get('/publicaciones/delete/{id}', 'BlogPostController@deletePost')->name('deletePost');
  Route::resource('publicaciones', 'BlogPostController');
  Route::get('/usuarios', 'UsuarioController@usuarios')->name('usuarios');
  Route::get('/mi-perfil', 'UsuarioController@perfil')->name('perfil');
  Route::get('/archivo/{id}', 'MaterialController@descargarArchivo')->name('descargarArchivo');
  Route::get('/material/delete/{id}', 'MaterialController@deleteArchivo')->name('deleteArchivo');
  Route::post('/getchat', 'MensajeController@getchat');
  Route::post('/agregar-usuario', 'ProyectoController@agregarUsuario');
  Route::post('/buscarUsuario', 'ProyectoController@buscarUsuario');
  Route::post('/buscar-mensaje', 'MensajeController@buscarMensaje');
  Route::post('/visto', 'MensajeController@Visto');
  Route::post('check-archivos', 'DocumentosController@CheckArchivos');
  Route::resource('documentos', 'DocumentosController');
  Route::get('/documento/{id}', 'DocumentosController@descargarDocumento')->name('documento');
  Route::get('/getdocumento', 'DocumentosController@GetDocumento');
  Route::get('/getdocumentohistorico', 'DocumentosController@GetDocumentoHistorico');
  Route::post('restaura-documento', 'DocumentosController@RestauraDocumento');
  Route::get('eliminar-permanente-documento/{id}', 'DocumentosController@EliminarPermanenteDocumento');
  Route::post('/actualizarproyecto', 'ProyectoController@update')->name('actualizarproyecto');
  Route::get('/restaurar-proyecto/{proyecto_id}', 'ProyectoController@RestaurarProyecto');
  Route::get('/eliminar-permanente-royecto/{proyecto_id}', 'ProyectoController@EliminarPermanenteProyecto');
  Route::get('/get-proyectos/{usuario_id}', 'UsuarioController@getProyectos');
  Route::get('/get-permisos/{proyecto_id}/{usuario_id}', 'UsuarioController@getPermisos');
  Route::post('/guardar-permisos', 'UsuarioController@GuardarPermiso');
  Route::get('/detachProyect/{usuario_id}/{proyecto_id}', 'UsuarioController@detachProyect');





});
Route::get('/home', 'HomeController@resumen')->name('resumen');
