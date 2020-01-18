@extends('layouts.front')
@section('title','Libro de reclamaciones')
@section('content')
<div class="container">
	<div class="row mt-5">
       <section class="col-xs-12 col-sm-12 col-md-9">
   			<h3>Libro de Reclamaciones</h3>
   			<p>Identificador del consumidor reclamante.</p>
   			@if(session('msg'))
   			<div class="alert alert-success">
   				{{session('msg')}}
   			</div>									
   			@endif

   			<form action="{{route('contact')}}" method="POST">
   			{{csrf_field()}}

   			<div class="row">
   				<section class="col-12 col-md-4">
   					<div class="form-group">			    
   						<input type="text" class="form-control" id="name" name="name" placeholder="Nombres" required>
   					</div>
   				</section>
   				<section class="col-12 col-md-4">
   					<div class="form-group">			    
   						<input type="text" class="form-control" id="lastname" name="lastname" placeholder="Apellidos" required>
   					</div>
   				</section>
               <section class="col-12 col-md-4">
                  <div class="form-group">             
                     <input type="text" class="form-control" id="nrs" name="nrs" placeholder="Razón Social">
                  </div>
               </section>
   			</div>

   			<div class="row">
   				<section class="col-12 col-md-4">
   					<div class="form-group">			    
   						<input type="text" class="form-control" id="phone" name="phone" placeholder="Teléfono/Móvil" required>
   					</div>
   				</section>
   				<section class="col-12 col-md-8">
   					<div class="form-group">			    
   						<input type="text" class="form-control" id="address" name="address" placeholder="Dirección" required>
   					</div>
   				</section>
   			</div>

   			<div class="row">
   				<section class="col-12 col-md-4">
   					<div class="form-group">			    
   						<input type="text" class="form-control" id="doc" name="doc" placeholder="Doc. Identidad" required>
   					</div>
   				</section>
   				<section class="col-12 col-md-8">
   					<div class="form-group">			    
   						<input type="email" class="form-control" id="email" name="email" placeholder="Correo electrónico" required>
   					</div>
   				</section>
   			</div>

   			<div class="row">
   				<section class="col-12">
   					<div class="form-group">			    
   						<input type="text" class="form-control" id="reason" name="reason" placeholder="Ingrese la razón de su reclamo" required>
   					</div>
   				</section>
   			</div>

   			<div class="row">
   				<section class="col-12">
   					<div class="form-group">				
   						<textarea name="detail" class="form-control" id="detail" rows="5" placeholder="Ingrese el detalle de su reclamo" required></textarea>
   					</div>   					
   				</section>
   			</div>

   			<div class="row">
   				<div class="col-12">
   					<div class="form-group form-check">
   					  <input type="checkbox" class="form-check-input" id="exampleCheck1">
   					  <label class="form-check-label" for="exampleCheck1"><small>Declaro ser el titular del contenido del presente formulario, manifestando bajo declaración jurada los hechos descritos en él.</small></label>
   					</div>
   					
   				</div>
   			</div>

   			

   			<button type="submit" class="btn btn-orange">Enviar</button>
   			</form>
   		</section>
	</div>
</div>

@endsection

