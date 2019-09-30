<button type="button" class="btn btn-orange btn-lg btn-block" data-toggle="modal" data-target="#converter">
	<i class="fas fa-calculator"></i> Convertidor
</button>
<!-- Modal Calculadora -->
<div class="modal" id="converter" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Calculadora de Conversiones</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
      	<div class="container-fluid">
      		{{-- Longitud --}}
      		<div class="input-group input-group-sm mb-3">
      		  <div class="input-group-prepend">
      		    <span class="input-group-text" id="inputGroup-sizing-sm">Longitud</span>
      		  </div>
      		  <input type="text" onkeyup="lconverter()" id="longitud" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">

      		  <span class="input-group-append">
      		  	<span class="input-group-text"> > </span>
      		  </span>

      		  <select name="length" class="form-control form-control-sm" id="length" onchange="lconverter()">
      		  	<option value="1" selected>pulgadas</option>
      		  	<option value="2">milimetros</option>
      		  	<option value="3">metros</option>
      		  	<option value="4">pies</option>
      		  	<option value="5">micras</option>
      		  </select>
      		  <span class="input-group-append">
      		  	<span class="input-group-text" id="lresult">0</span>
      		  </span>
      		</div>
      		{{-- Longitud --}}

      		{{-- Presión --}}

      		<div class="input-group input-group-sm mb-3">
      		  <div class="input-group-prepend">
      		    <span class="input-group-text" id="inputGroup-sizing-sm">Presión</span>
      		  </div>
      		  <input type="text" onkeyup="pconverter()" id="presion" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">
      		  <select name="pressure" class="form-control form-control-sm" id="pressure" onchange="pconverter()">
      		  	<option value="1" selected>bar</option>
      		  	<option value="2">p.s.i</option>
      		  	<option value="3">MPa</option>
      		  	<option value="4">KPa</option>
      		  </select>
      		  <span class="input-group-append">
      		  	<span class="input-group-text"> &nbsp; </span>
      		  </span>
      		  <span class="input-group-append">
      		  	<span class="input-group-text" id="presult">0</span>
      		  </span>
      		  <select name="pressure2" class="form-control form-control-sm" id="pressure2" onchange="pconverter()">
      		  	<option value="1" selected>bar</option>
      		  	<option value="2">p.s.i</option>
      		  	<option value="3">MPa</option>
      		  	<option value="4">KPa</option>
      		  </select>
      		</div>
      		{{-- Presión --}}

      		{{-- Speed --}}
      		<div class="input-group input-group-sm mb-3">
      		  <div class="input-group-prepend">
      		    <span class="input-group-text" id="inputGroup-sizing-sm">Velocidad</span>
      		  </div>
      		  <input type="text" onkeyup="sconverter()" id="velocidad" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">

      		  <span class="input-group-append">
      		  	<span class="input-group-text"> > </span>
      		  </span>

      		  <select name="length" class="form-control form-control-sm" id="speed" onchange="sconverter()">
      		  	<option value="1" selected>ft/segundos</option>
      		    <option value="2">m/segundos</option>
      		  </select>
      		  <span class="input-group-append">
      		  	<span class="input-group-text" id="sresult">0</span>
      		  </span>
      		</div>
      		{{-- Speed --}}

      		{{-- Temp --}}

      		<div class="input-group input-group-sm mb-3">
      		  <div class="input-group-prepend">
      		    <span class="input-group-text" id="inputGroup-sizing-sm">Temperatura</span>
      		  </div>
      		  <input type="text" onkeyup="tconverter()" id="temperatura" class="form-control" aria-label="Sizing example input" aria-describedby="inputGroup-sizing-sm">

      		  <span class="input-group-append">
      		  	<span class="input-group-text"> > </span>
      		  </span>

      		  <select name="length" class="form-control form-control-sm" id="temp" onchange="tconverter()">
      		  	<option value="1" selected>°C</option>
      		    <option value="2">°F</option>
      		  </select>
      		  <span class="input-group-append">
      		  	<span class="input-group-text" id="tresult">0</span>
      		  </span>
      		</div>
      		{{-- Temp --}}
      	</div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>			        
      </div>
    </div>
  </div>
</div>
<!-- Modal Calculadora -->