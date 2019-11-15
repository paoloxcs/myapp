@extends('layouts.app')
@section('title','Editar producto')
@section('content')
<div class="container">
        @if(session('message'))
        <div class="alert alert-success" role="alert">
            <span> {{session('message')}} </span>
        </div>
        @endif
        @if($errors->any())
        
        @foreach ($errors->all() as  $error)
            <p class="text-warning">{{$error}}</p>
            
        @endforeach
        
        @endif
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <form action="{{route('products.update', $product->id)}}" method="POST" enctype="multipart/form-data">
                    {{csrf_field()}}
                    {{method_field('PUT')}}
                    <div class="card-header">
                        <div class="card-title">
                            <h5>Editar producto: <strong>{{$product->name}}</strong><a href="{{route('products.index')}}" class="btn btn-orange btn-sm float-right"><i class="fa fa-arrow-left"></i> Regresar</a></h5>
                        </div>
                    </div>
                    <div class="card-body">
                        <h6><i class="fa fa-check"></i> Datos básicos</h6>
                        <hr>
                        <div class="row">
                            <div class="col-xs-12 col-md-6">
                                <div class="row">
                                    <div class="col-xs-12 col-md-8">
                                        <div class="form-group">
                                            <div class="input-group">
                                                <select name="category" class="form-control categories">
                                                @foreach ($categories as $category)
                                                    <option {{$category->id == $product->category_id ? 'selected' : ''}} value="{{$category->id}}">{{$category->name}}</option>
                                                @endforeach
                                                </select>
                                                <div class="input-group-append">
                                                    <a href="{{route('categories.index')}}" class="btn btn-warning"><i class="fa fa-plus"></i></a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-xs-12 col-md-4">
                                        <div class="form-group">
                                            <input type="text" name="name" class="form-control" placeholder="Nombre" value="{{$product->name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-8">
                                        <div class="form-group">
                                            <textarea name="summary" rows="3" class="form-control" placeholder="Escriba aquí un breve resumén">{{$product->summary}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <label id="file-upload" for="file_upload" class="upload-content">
                                            <div class="file-image">
                                                <span id="text-info"><i class="fa fa-upload"></i> Remplazar foto <small>(384 x 216px)</small></span>
                                                
                                                <img id="showImage">
                                            </div>
                                        </label>
                                        <input id="file_upload" data-validate="true" type="file" name="url_image" accept="image/*" style="display: none;" onchange="readImage(this,'showImage');">
                                    </div>
                                    <div class="col-md-12">
                                        
                                        <div class="form-group">
                                            <h6><i class="fa fa-check"></i> Unidad de medida</h6>
                                            <div class="unit_measurements">
                                                @php $pos_measurement = 0 @endphp
                                                @foreach ($measurements as $index => $measure)
                                                    @if ($product->measurements->contains('sigla',$measure->sigla))
                                                        <div class="form-check form-check-inline p-2">
                                                            <input type="checkbox" name="measurements[]" id="inline-checkbox{{$measure->id}}" {{$product->measurements[$pos_measurement]->pivot->measurement_id == $measure->id ? 'checked': ''}} class="form-check-input" value="{{$measure->id}}">
                                                            <label for="inline-checkbox{{$measure->id}}" class="form-check-label">{{$measure->name}}</label>
                                                        </div>
                                                        @php $pos_measurement ++ @endphp
                                                    @else
                                                        <div class="form-check form-check-inline p-2">
                                                            <input type="checkbox" name="measurements[]" id="inline-checkbox{{$measure->id}}"  class="form-check-input" value="{{$measure->id}}">
                                                            <label for="inline-checkbox{{$measure->id}}" class="form-check-label">{{$measure->name}}</label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                        <div class="form-group">
                                            <h6><i class="fa fa-check"></i> Marque las dimensiones que corresponde:</h6><br>
                                            <div class="dimensions">
                                                @php $position = 0 @endphp
                                                @foreach ($dimensions as $dimen)
                                                    @if ($product->dimensions->contains('slug',$dimen->slug))
                                                        
                                                        <div class="form-check form-check-inline p-2" title="{{$dimen->name}}">
                                                            <input type="checkbox" name="dimensions[]" id="inline-checkbox{{$dimen->id}}" {{$product->dimensions[$position]->pivot->dimension_id == $dimen->id ? 'checked' : ''}} class="form-check-input" value="{{$dimen->id}}">
                                                            <label for="inline-checkbox{{$dimen->id}}"  class="form-check-label">{{$dimen->sigla}}</label>
                                                        </div>

                                                        @php $position ++ @endphp
                                                    @else
                                                        <div class="form-check form-check-inline p-2" title="{{$dimen->name}}">
                                                            <input type="checkbox" name="dimensions[]" id="inline-checkbox{{$dimen->id}}" class="form-check-input" value="{{$dimen->id}}">
                                                            <label for="inline-checkbox{{$dimen->id}}"  class="form-check-label">{{$dimen->sigla}}</label>
                                                        </div>
                                                    @endif
                                                @endforeach
                                                
                                            </div>
    
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <h6><i class="fa fa-check"></i> Mercados al que pertenece</h6><br>
                                            
                                            @foreach ($markets as $index => $market)
                                            @if ($product->markets->contains('id', $market->id))
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="markets[]" id="market_{{$index}}" value="{{$market->id}}" checked>
                                                    <label class="form-check-label" for="market_{{$index}}">{{$market->name}}</label>
                                                </div>
                                            @else
                                                <div class="form-check">
                                                    <input class="form-check-input" type="checkbox" name="markets[]" id="market_{{$index}}" value="{{$market->id}}">
                                                    <label class="form-check-label" for="market_{{$index}}">{{$market->name}}</label>
                                                </div>
                                            @endif
                                                
                                            @endforeach
                                        </div>
                                        <hr>
                                        <div class="form-group">
                                            <h6><i class="fa fa-check"></i> Estado del producto</h6><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status" id="active" value="1" {{$product->status == 1 ? 'checked' : ''}}>
                                                <label class="form-check-label" for="active">Activo</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="status" id="inactive" value="0" {{$product->status == 0 ? 'checked' : ''}}>
                                                <label class="form-check-label" for="inactive">Inactivo</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xs-12 col-md-6">
                                <div class="form-group">
                                    <label for="body">Especificaciones del perfil</label>
                                    <textarea name="body" class="ckeditor">{{$product->body}}</textarea>
                                </div>
                            </div>
    
                        </div>
                    </div>
                    <div class="card-footer">
                        <button type="submit" class="btn btn-orange"><i class="fa fa-sync"></i> Guardar cambios</button>
                    </div>
                </form>
                
            </div>
            <hr>
            <div class="card">
                <div class="card-header">
                    <div class="card-title"><h5>Condiciones de operación</h5></div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <form action="{{route('product.operating.condition', $product->id)}}" method="POST">
                            {{ csrf_field() }}
                            {{method_field('PUT')}}
                            <div class="col-12">
                                <div class="form-group">
                                    @foreach($product->measurements as $index => $measure)
                                    @if(!$product->operating_conditions->contains('measurement_id', $measure->id))
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="measurement" id="measurement{{$measure->id}}" value="{{$measure->id}}" {{$index == 0 ? 'checked' : ''}}>
                                        <label class="form-check-label" for="measurement{{$measure->id}}">{{$measure->name}}</label>
                                    </div>
                                    @endif
                                    @endforeach
                                </div>
                                <div class="input-group">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Presión máxima</span>
                                    </div>
                                    <input type="text" name="max_pressure" class="form-control" placeholder="300 Bar">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Velocidad máxima</span>
                                    </div>
                                    <input type="text" name="max_speed" class="form-control" placeholder="0.5m/sec">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Temp. mínima</span>
                                    </div>
                                    <input type="text" name="min_temp" class="form-control" placeholder="-30°C">
                                    <div class="input-group-append">
                                        <span class="input-group-text">Temp. máxima</span>
                                    </div>
                                    <input type="text" name="max_temp" class="form-control" placeholder="100°C">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-blue btn-sm"><i class="fa fa-plus"></i> Agregar</button>
                                    </div>
                                </div>
                            </div>
                        </form>

                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-12">
                            <div class="table-responsive">
                                <table class="table table-hover table-condensed table-sm table-bordered">
                                    <thead>
                                        <th>Id</th>
                                        <th>Presión máxima</th>
                                        <th>Velocidad máxima</th>
                                        <th>Temp. mínima</th>
                                        <th>Temp. máxima</th>
                                        <th>Unidad de mediad</th>
                                        <th>Acción</th>
                                    </thead>
                                    <tbody>
                                        @foreach ($product->operating_conditions as $opera)
                                            <tr>
                                                <td>{{$opera->id}}</td>
                                                <td>{{$opera->max_pressure}}</td>
                                                <td>{{$opera->max_speed}}</td>
                                                <td>{{$opera->min_temp}}</td>
                                                <td>{{$opera->max_temp}}</td>
                                                <td>{{$opera->measurement->name}}</td>
                                                <td>
                                                    <a href="{{route('operating.condition.destroy', $opera->id)}}" onclick="return confirm('¿Seguro de quitar el registro?')" class="btn btn-danger btn-sm">Quitar</a>
                                                </td>
                                                
                                            </tr>       
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card-footer">

                </div>
            </div>
        </div>
    </div>
</div>
@endsection