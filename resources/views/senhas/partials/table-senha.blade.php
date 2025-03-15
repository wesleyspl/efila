<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="icon-chart-pie-1"></i> <strong>Emitir</strong> Senhas</h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>SERVIÇO</th>
                        <th>SIGLA</th>
                        <th><center>EMITIR</center></th>
                    </tr>
                </thead>
                <tbody>
                    @if ($servico)
                        @foreach ($servico as $servicos)
                            <tr>
                                <td>{{ $servicos->id_servico }}</td>
                                <td>{{ $servicos->nome }}</td>
                                <td>{{ $servicos->sigla }}</td>
                                <td>
                                    <center>
                                        <a href="{{ route('senha.emitir', [$servicos->id_servico, 0]) }}" class="btn btn-primary btn-sm"><i class="fa fa-ticket"></i> Normal</a>
                                        <a href="{{ route('senha.emitir', [$servicos->id_servico, 1]) }}" class="btn btn-danger btn-sm"><i class="fa fa-ticket"></i> Preferencial</a>
                                    </center>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="4">NENHUM DEPARTAMENTO</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->