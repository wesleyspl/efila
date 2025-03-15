@extends('templates.admin1')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-cogs"></i> <strong>Editar Serviço</strong></h3>
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

        <form role="form" method="post" action="{{ route('servicos.update', $servico->id_servico) }}">
            @csrf
            @method('put')

            <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" name="nome" value="{{ $servico->nome }}">
            </div>
            <div class="form-group">
                <label>Sigla</label>
                <input type="text" class="form-control" name="sigla" value="{{ $servico->sigla }}">
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection