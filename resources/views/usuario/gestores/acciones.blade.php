<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
 
    <a href="{{ route('editarGestor',$user->id) }}" class="btn btn-info"  data-toggle="tooltip" data-placement="top" title="Editar {{ $user->name }}">
        <i class="fas fa-edit"></i>
    </a>
    
    <button onclick="eliminar(this);" data-id="{{ $user->id }}" type="button" class="btn btn-danger" data-toggle="tooltip" data-placement="top" title="Eliminar {{ $user->name }}">
        <i class="fas fa-trash-alt"></i>
    </button>
</div>