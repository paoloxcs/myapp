@extends('layouts.app')
@section('title','Compatibilidad del producto')
@section('content')
<div class="container">
    @if(session('message'))
    <div class="alert alert-success" role="alert">
        <span> {{session('message')}} </span>
    </div>
    @endif
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <form action=" {{route('products.compatibility', $product->id)}} " method="POST">
                    {{ method_field('PUT') }}
                    {{ csrf_field() }}
                    <div class="card-header">
                        <div class="card-title">Compatibilidad de producto: <strong> {{$product->name}} </strong></div>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12" id="compatibilities">
                                @foreach($compatibilities as  $compat)
                                @if($compat->level == 1)
                                <table class="table table-striped table-bordered table-sm">
                                        <thead>
                                            <tr>
                                            <th scope="col">{{$compat->name}}</th>
                                            <th scope="col" colspan="2">Tipo de aplicación</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($compatibilities as $compat2)
                                            @if($compat2->parent_id == $compat->id)
                                                <tr>
                                                    <td scope="row">{{$compat2->name}}</td>
                                                    <input type="hidden" name="compats[]" value="{{$compat2->id}}">
                                                    
                                                    @if($product->compatibilities->contains('compatibility_id', $compat2->id))
                                                        @foreach ($product->compatibilities as $index => $prod_compat)
                                                        @if($prod_compat->compatibility_id == $compat2->id)
                                                            @if($prod_compat->type_field === 'DYNAMIC')
                                                                <td>
                                                                    {{-- <span>{{$prod_compat->type_field}}</span> --}}
                                                                    <span>Dinámica</span>
                                                                    <div class="form-check" title="Recomendado">
                                                                        <input class="form-check-input" type="radio" name="compat_dynamic_{{$compat2->id}}" id="drecomended{{$index}}" 
                                                                        value="1" {{$prod_compat->value_field == 1 ? 'checked' : ''}}>
                                                                        <label class="form-check-label" for="drecomended{{$index}}">
                                                                        <i class="fas fa-check text-success"></i>
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check" title="Posible">
                                                                        <input class="form-check-input" type="radio" name="compat_dynamic_{{$compat2->id}}" id="dposible{{$index}}" 
                                                                        value="2" {{$prod_compat->value_field == 2 ? 'checked' : ''}}>
                                                                        <label class="form-check-label" for="dposible{{$index}}">
                                                                        <i class="fas fa-dot-circle text-primary"></i>
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check" title="No adecuado">
                                                                        <input class="form-check-input" type="radio" name="compat_dynamic_{{$compat2->id}}" id="dna{{$index}}" 
                                                                        value="3" {{$prod_compat->value_field == 3 ? 'checked' : ''}}>
                                                                        <label class="form-check-label" for="dna{{$index}}">
                                                                            <i class="fas fa-times text-danger"></i>
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                            @else
                                                                <td>
                                                                    <span>Estática</span>
                                                                    <div class="form-check" title="Recomendado">
                                                                        <input class="form-check-input" type="radio" name="compat_static_{{$compat2->id}}" id="srecomended{{$index}}" 
                                                                        value="1" {{$prod_compat->value_field == 1 ? 'checked' : ''}}>
                                                                        <label class="form-check-label" for="srecomended{{$index}}">
                                                                        <i class="fas fa-check text-success"></i>
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check" title="Posible">
                                                                        <input class="form-check-input" type="radio" name="compat_static_{{$compat2->id}}" id="sposible{{$index}}" 
                                                                        value="2" {{$prod_compat->value_field == 2 ? 'checked' : ''}}>
                                                                        <label class="form-check-label" for="sposible{{$index}}">
                                                                        <i class="fas fa-dot-circle text-primary"></i>
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check" title="No adecuado">
                                                                        <input class="form-check-input" type="radio" name="compat_static_{{$compat2->id}}" id="sna{{$index}}" 
                                                                        value="3" {{$prod_compat->value_field == 3 ? 'checked' : ''}}>
                                                                        <label class="form-check-label" for="sna{{$index}}">
                                                                            <i class="fas fa-times text-danger"></i>
                                                                        </label>
                                                                    </div>
                                                                </td>
                                                            @endif
                                                        @endif
                                                        @endforeach
                                                        
                                                    @else
                                                        <td>
                                                            <span>Dinámica</span>
                                                            <div class="form-check" title="Recomendado">
                                                            <input class="form-check-input" type="radio" name="compat_dynamic_{{$compat2->id}}" id="drecomended{{$compat2->id}}" value="1" checked>
                                                                <label class="form-check-label" for="drecomended{{$compat2->id}}">
                                                                <i class="fas fa-check text-success"></i>
                                                                </label>
                                                            </div>
                                                            <div class="form-check" title="Posible">
                                                                <input class="form-check-input" type="radio" name="compat_dynamic_{{$compat2->id}}" id="dposible{{$compat2->id}}" value="2">
                                                                <label class="form-check-label" for="dposible{{$compat2->id}}">
                                                                <i class="fas fa-dot-circle text-primary"></i>
                                                                </label>
                                                            </div>
                                                            <div class="form-check" title="No adecuado">
                                                                <input class="form-check-input" type="radio" name="compat_dynamic_{{$compat2->id}}" id="dna{{$compat2->id}}" value="3">
                                                                <label class="form-check-label" for="dna{{$compat2->id}}">
                                                                    <i class="fas fa-times text-danger"></i>
                                                                </label>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <span>Estática</span>
                                                            <div class="form-check" title="Recomendado">
                                                                <input class="form-check-input" type="radio" name="compat_static_{{$compat2->id}}" id="srecomended{{$compat2->id}}" value="1" checked>
                                                                <label class="form-check-label" for="srecomended{{$compat2->id}}">
                                                                <i class="fas fa-check text-success"></i>
                                                                </label>
                                                            </div>
                                                            <div class="form-check" title="Posible">
                                                                <input class="form-check-input" type="radio" name="compat_static_{{$compat2->id}}" id="sposible{{$compat2->id}}" value="2">
                                                                <label class="form-check-label" for="sposible{{$compat2->id}}">
                                                                <i class="fas fa-dot-circle text-primary"></i>
                                                                </label>
                                                            </div>
                                                            <div class="form-check" title="No adecuado">
                                                                <input class="form-check-input" type="radio" name="compat_static_{{$compat2->id}}" id="sna{{$compat2->id}}" value="3">
                                                                <label class="form-check-label" for="sna{{$compat2->id}}">
                                                                    <i class="fas fa-times text-danger"></i>
                                                                </label>
                                                            </div>					      	
                                                        </td>
                                                    @endif
                                                    
                                                </tr>
                                            @endif
                                                
                                            @endforeach
                                            
                                        </tbody>
                                    </table>
                                @endif
                                @endforeach
                                
                            </div>
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-orange"><i class="fa fa-save"></i> Guardar cambios</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection