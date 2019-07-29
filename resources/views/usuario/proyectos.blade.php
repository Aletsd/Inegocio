<select class="form-control" id="selectproyectos" onchange="getPermisos({{$usuario_id}},this.value)">
  <option value='0'>Seleccionar...</option>
  @foreach ($proyectos as $proyecto)
    <option value="{{$proyecto->id}}">{{$proyecto->nombre}}</option>
  @endforeach

</select>
