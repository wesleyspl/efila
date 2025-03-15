@extends('templates.admin1')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-map-marker"></i> <strong>Editar Local</strong></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $erros)
                        <li>{{ $erros }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form role="form" method="post" action="{{ route('local.update', $local->id_local) }}">
            @csrf
            @method('put')
            <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" name="nome" value="{{ $local->nome }}">
                <input type="hidden" name="id_prioridade" value="{{ $local->id_local }}">
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection