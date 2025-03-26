<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="icon-window"></i> <strong>Configurar</strong> Triagem</h3>
        <div class="card-tools">
            <a href="#" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Novo</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Atendente</th>
                        <th>CPF</th>
                        <th>Email</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($atendente)
                        @foreach ($atendente as $atendentes)
                            <tr>
                                <td>{{ $atendentes['pessoa']->id_pessoa }}</td>
                                <td>{{ $atendentes['pessoa']->nome }}</td>
                                <td>{{ $atendentes['pessoa']->cpf }}</td>
                                <td>{{ $atendentes['pessoa']->email }}</td>
                                <td>
                                    <a class="btn btn-info btn-sm" title="Visualizar" href="{{ route('triagem.show', $atendentes->id_atendente) }}"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-primary btn-sm" title="Configurar" href="{{ route('triagem.config', $atendentes->id_atendente) }}"><i class="fa fa-solid fa-gamepad"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="5">NENHUM CADASTRO</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <div class="row">
            <div class="col-md-6">
                <p>Página Atual: {{ $atendente->currentPage('pagination::simple-bootstrap-4') }} de {{ $atendente->lastPage('pagination::simple-bootstrap-4') }}</p>
            </div>
            <div class="col-md-6">
                <div class="float-right">
                    {{ $atendente->links('pagination::simple-bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-footer -->
</div>
<!-- /.card -->