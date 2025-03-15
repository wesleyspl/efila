@extends('templates.admin1')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-user"></i> <strong>Configurar Triagem</strong></h3>
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

        <form role="form" method="post" action="{{ route('triagem.store', $atendente->id_atendente) }}">
            @csrf
            @method('put')

            <div class="form-group">
                <label>Atendente</label>
                <input type="text" class="form-control" name="nome" disabled value="{{ $atendente['pessoa']->nome }}">
            </div>
            <div class="form-group">
                <label>Local</label>
                <select class="form-control" name="local">
                    @if ($local)
                        @foreach ($local as $locais)
                            <option>{{ $locais->nome }}</option>
                        @endforeach
                    @endif
                </select>
            </div>
            <div class="form-group">
                <label>Numero</label>
                <input type="text" class="form-control" name="numero">
            </div>

            <fieldset class="border p-3">
                <div class="form-group">
                    <label>Serviços ativos para o atendente</label>
                    <table class="table table-bordered">
                        @if ($meus_servicos)
                            @foreach ($meus_servicos as $meus)
                                <tr>
                                    <td>{{ $meus->nome }}</td>
                                    <td>
                                        <a href="{{ route('triagem.destivaServico', [$meus->id_servico, $atendente->id_atendente]) }}" class="btn btn-sm btn-danger">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                    </table>
                </div>
            </fieldset>

            <hr>

            <div class="form-group">
                <label>Serviços para ativar</label>
                <div>
                    @if ($servico)
                        @foreach ($servico as $servicos)
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="id_servico[]" value="{{ $servicos->id_servico }}">
                                <label class="form-check-label">{{ $servicos->nome }}</label>
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <button type="submit" class="btn btn-primary">Salvar</button>
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection