@extends('templates.admin1')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-user"></i> <strong>Detalhes da Triagem</strong></h3>
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

        <form role="form" method="post" action="">
            @csrf
            @method('put')

            <div class="form-group">
                <label><strong>Atendente:</strong> {{ $pessoa }}</label>
            </div>
            <div class="form-group">
                <label><strong>Local:</strong> {{ $local->nome }}</label>
            </div>
            <div class="form-group">
                <label><strong>Numero:</strong> {{ $numero }}</label>
            </div>

            <hr>

            <h5><strong>SERVIÇOS</strong></h5>
            <hr>
            <table class="table table-bordered">
                @foreach ($servico as $servicos)
                    <tr>
                        <td>{{ $servicos->nome }}</td>
                        <td>
                            <a href="{{ route('triagem.destroy', [$servicos->id_servico, $atendente->id_atendente]) }}" class="btn btn-danger btn-sm">
                                <i class="fa fa-trash"></i>
                            </a>
                        </td>
                    </tr>
                @endforeach
            </table>

            <hr>

            <a class="btn btn-primary" href="{{ route('triagem') }}"><i class="fa fa-refresh"></i> Voltar</a>
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection