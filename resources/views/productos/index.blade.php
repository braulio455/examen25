@extends('layouts.app')

@section('title', 'Listado de Productos')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-3">
    <h1>Productos</h1>
    <a href="{{ route('productos.create') }}" class="btn btn-success">Nuevo Producto</a>
</div>

<div class="list-group" id="productos-list">
    @forelse ($productos as $producto)
        <div class="list-group-item fade-in" style="animation-delay: {{ $loop->index * 0.1 }}s;">
            <h5>
                {{ $producto->nombre }}
                <small class="text-muted">${{ number_format($producto->precio, 2) }}</small>
            </h5>
            <p>{{ $producto->descripcion }}</p>
            <small>Stock: {{ $producto->stock }}</small>
            <div class="mt-2">
                <a href="{{ route('productos.show', $producto) }}" class="btn btn-info btn-sm">Ver</a>
                <a href="{{ route('productos.edit', $producto) }}" class="btn btn-primary btn-sm">Editar</a>
                <button class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#deleteModal" data-id="{{ $producto->id }}">Eliminar</button>
            </div>
        </div>
    @empty
        <div class="alert alert-warning">No hay productos registrados.</div>
    @endforelse
</div>

<div class="mt-3">{{ $productos->links() }}</div>

<div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form id="deleteForm" method="POST">
      @csrf
      @method('DELETE')
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="deleteModalLabel">Confirmar eliminación</h5>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
        </div>
        <div class="modal-body">
          ¿Estás seguro de que deseas eliminar este producto?
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
          <button type="submit" class="btn btn-danger">Eliminar</button>
        </div>
      </div>
    </form>
  </div>
</div>

@push('scripts')
<script>
    var deleteModal = document.getElementById('deleteModal');
    deleteModal.addEventListener('show.bs.modal', function (event) {
      var button = event.relatedTarget;
      var id = button.getAttribute('data-id');
      var form = document.getElementById('deleteForm');
      form.action = '/productos/' + id;
    });
</script>
@endpush

@endsection
