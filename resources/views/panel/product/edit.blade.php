@extends('layouts.app')
@section('title','Editar producto')
@section('content')
<div class="container">
    <div class="row mt-3">
        <div class="col-md-12">
            <div class="card">
                <form action="#">
                    <div class="card-header">
                        <div class="card-title">Editar producto: <strong>{{$product->name}}</strong></div>
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
                                    </div>
                                    
                                    {{-- <div class="col-md-12">
                                        <h6><i class="fa fa-check"></i> Condiciones de operación</h6>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="max_pressure">Presión máxima</label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" name="max_pressure" class="form-control">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">bar</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="max_speed">Velocidad máxima</label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" name="max_speed" class="form-control">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">mt/sec</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="min_temp">Temperatura mínima</label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" name="min_temp" class="form-control">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">°C</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-xs-12 col-md-6">
                                                <div class="form-group">
                                                    <label for="max_temp">Temperatura máxima</label>
                                                    <div class="input-group input-group-sm">
                                                        <input type="text" name="max_temp" class="form-control">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">°C</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> --}}
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
        </div>
    </div>
</div>
@endsection