@extends('templates.admin1')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-map-marker"></i> <strong>Criar Local</strong></h3>
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

        <form role="form" method="post" action="{{ route('local.store') }}">
            @csrf
            <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" name="nome" value="{{ old('nome') }}">
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection