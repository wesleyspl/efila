@extends('templates.admin1')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-user"></i> <strong>Criar Atendente</strong></h3>
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

        <form role="form" method="post" action="{{ route('atendente.store') }}">
            @csrf
            <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" name="nome" value="{{ old('nome') }}">
            </div>
            <div class="form-group">
                <label>CPF</label>
                <input type="text" class="form-control" name="cpf" value="{{ old('cpf') }}">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" value="{{ old('email') }}">
            </div>
            <div class="form-group">
                <label>Senha</label>
                <input type="password" class="form-control" name="password" value="">
            </div>
            <div class="form-group">
                <label>Repita a senha</label>
                <input type="password" class="form-control" name="password1" value="">
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection