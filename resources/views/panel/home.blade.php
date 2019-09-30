@extends('layouts.app')
@section('title','Panel de Administración')
@section('content')
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <nav aria-label="breadcrumb">
                      <ol class="breadcrumb">
                        <li class="breadcrumb-item active" aria-current="page"><i class="fas fa-table"></i> Dashboard</li>
                      </ol>
                    </nav>
                </div>
                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
                    @endif

                    Panel de administración...
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
