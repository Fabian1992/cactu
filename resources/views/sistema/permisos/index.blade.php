@extends('layouts.app',['title'=>'Permisos'])

@section('breadcrumbs', Breadcrumbs::render('permisos',$rol))

@section('barraLateral')

    <div class="breadcrumb justify-content-center">
        <a href="{{ route('roles') }}" class="breadcrumb-elements-item">
            <i class="fas fa-arrow-left"></i> Atras
        </a>
    </div>
@endsection

@section('content')

<form action="{{ route('sincronizarPermiso') }}" method="post">
    @csrf
    <input type="hidden" name="rol" value="{{ $rol->id }}" required>
    <div class="card">
        <div class="card-header">
            Permisos en rol {{ $rol->name }}
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Nombre</th>
                        <th scope="col">Asignado</th>
                    </tr>
                    </thead>
                    <tbody>
                    
                    @foreach ($permisos as $per)
                        <tr>
                            <th scope="row">{{ $per->name }}</th>
                            <td>
                                <input name="permisos[]" value="{{ $per->id }}" type="checkbox" {{ $rol->hasPermissionTo($per) ?'checked':'' }}  data-toggle="toggle" data-on="SI" data-off="NO" data-onstyle="success" data-offstyle="danger" data-size="xs">
                            </td>
                        </tr>
    
                        @endforeach
    
                    </tbody>
                </table>
            </div>
        </div>
        <div class="card-footer text-muted">
            <button class="btn btn-primary">Actualizar permisos <i class="icon-paperplane ml-2"></i></button>
        </div>
    </div>
</form>

@push('linksCabeza')


@endpush

@prepend('linksPie')
    <script>
        $('#menuRoles').addClass('active');
    </script>

    
@endprepend

@endsection
