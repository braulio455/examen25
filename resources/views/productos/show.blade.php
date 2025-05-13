@extends('layouts.app')
@section('title','Detalle del Producto')
@section('content')
<h1>Detalle del Producto</h1>
<div class="card">
    <div class="card-body">
        <h5 class="card-title">{{ $producto->nombre }}</h5>
        <p class="card-text">{{ $producto->descripcion }}</p>
        <p class="card-text"><small class="text-muted">Precio: ${{ number_format($producto->precio, 2) }}</small></p>
        <p class="card-text"><small class="text-muted">Stock: {{ $producto->stock }}</small></p>
        <a href="{{ route('productos.index') }}" class="btn btn-primary">Volver</a>
    </div>
</div>
@endsection
