@extends('templates.admin1')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-user"></i> <strong>Editar Atendente</strong></h3>
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

        <form role="form" method="post" action="{{ route('atendente.update', $atendente->id_atendente) }}">
            @csrf
            @method('put')
            <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" name="nome" value="{{ $atendente['pessoa']->nome }}">
            </div>
            <div class="form-group">
                <label>CPF</label>
                <input type="text" class="form-control" name="cpf" value="{{ $atendente['pessoa']->cpf }}">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" value="{{ $atendente['pessoa']->email }}">
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection