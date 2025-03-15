@extends('templates.admin1')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-cogs"></i> <strong>Criar Serviço</strong></h3>
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

        <form role="form" method="post" action="{{ route('servicos.store') }}" class="bv-form">
            @csrf

            <div class="form-group">
                <label>Departamento</label>
                <select class="form-control" name="departamento">
                    @if ($departamentos)
                        @foreach ($departamentos as $departamento)
                            <option>{{ $departamento->nome }}</option>
                        @endforeach
                    @endif
                </select>
            </div>

            <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" name="nome" value="{{ old('nome') }}">
            </div>
            <div class="form-group">
                <label>Sigla</label>
                <input type="text" class="form-control" name="sigla" value="{{ old('sigla') }}">
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection