@extends('templates.admin1')

@section('content')
<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-window"></i> <strong>Configurar Painel</strong></h3>
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

        <form role="form" method="post" action="{{ route('painel.save') }}">
            @csrf
            @method('put')

            <div class="form-group">
                <label>Nome</label>
                <input type="text" class="form-control" name="nome" disabled value="{{ $painel->nome }}">
                <input type="hidden" name="id_painel" value="{{ $painel->id_painel }}">
            </div>
            <div class="form-group">
                <label>Obs</label>
                <input type="text" class="form-control" name="obs" disabled value="{{ $painel->obs }}">
            </div>
            <fieldset class="border p-3">
            <div class="form-group">
                <label>Habilitar video </label>
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="player-checkbox" name="player" value="1" onclick="toggleVideoInput(this.checked)">
                    <label class="form-check-label" for="player-checkbox">Video no painel</label>
                </div>
            </div>
            
            <div class="form-group">
                <label>URL do Vídeo</label>
                <input type="text" class="form-control" name="url_midia" id="video-url" disabled value="{{ $painel->url_midia ?? '' }}">
            </div>
            </fieldset>
            <br>
            <fieldset class="border p-3">
                <div class="form-group">
                    <label>Serviços do painel</label>
                    <table class="table table-bordered">
                        @if ($meus_servicos)
                            @foreach ($meus_servicos as $meus)
                                <tr>
                                    <td>{{ $meus->nome }}</td>
                                    <td>
                                        <a href="{{ route('painel.destivaServico', [$painel->id_painel, $meus->id_servico]) }}" class="btn btn-sm btn-danger">
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
<script>
    function toggleVideoInput(enable) {
        const videoUrlInput = document.getElementById('video-url');
        videoUrlInput.disabled = !enable;
    }
</script>
@endsection
