@extends('templates.admin1')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-window"></i> <strong>Configurar Painel Touch</strong></h3>
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

        <form role="form" method="post" action="{{ route('touch.save') }}">
            @csrf
            @method('put')

            <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" name="nome" value="{{ $painel->nome }}">
                <input type="hidden" name="id_painel" value="{{ $painel->id_touch }}">
            </div>
            <div class="form-group">
                <label>Obs</label>
                <input type="text" class="form-control" name="obs" value="{{ $painel->obs }}">
            </div>

            <fieldset class="border p-3">
                <div class="form-group">
                    <label>Serviços do painel</label>
                    <table class="table table-bordered">
                        @if ($meus_servicos)
                            @foreach ($meus_servicos as $meus)
                                <tr>
                                    <td>{{ $meus['servico']->nome }}</td>
                                    <td>
                                        <a href="{{ route('touch.destivaServico', [$painel->id_touch, $meus->servico_id]) }}" class="btn btn-sm btn-danger">
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
                <label>Serviços</label>
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