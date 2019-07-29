<input type="hidden" id="permiso_id" value='{{$permisos->id}}'>
<div class="col-sm-3 mt-4">
    <div class="custom-control custom-checkbox">
      <input type="checkbox" class="custom-control-input" id="diseñocheck" @if ($permisos->diseño)checked  @endif>
      <label class="custom-control-label" for="diseñocheck">Diseño de Propuesta</label>
    </div>
</div>
<div class="col-sm-3 mt-4">
    <div class="custom-control custom-checkbox">
      <input type="checkbox" class="custom-control-input" id="desarrollocheck" @if ($permisos->desarrollo)checked  @endif>
      <label class="custom-control-label" for="desarrollocheck">Desarrollo</label>
    </div>
</div>
<div class="col-sm-3 mt-4">
    <div class="custom-control custom-checkbox">
      <input type="checkbox" class="custom-control-input" id="operacioncheck" @if ($permisos->operacion)checked  @endif>
      <label class="custom-control-label" for="operacioncheck">Administración del proyecto</label>
    </div>
</div>
<div class="col-sm-3 mt-4">
    <div class="custom-control custom-checkbox">
      <input type="checkbox" class="custom-control-input" id="gestioncheck" @if ($permisos->gestion)checked  @endif>
      <label class="custom-control-label" for="gestioncheck" >Gestion de Empresa</label>
    </div>
</div>
