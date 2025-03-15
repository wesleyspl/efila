<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="icon-home-3"></i> <strong>Locais</strong></h3>
        <div class="card-tools">
            <a href="{{ route('local.create') }}" class="btn btn-success btn-sm"><i class="fa fa-plus-circle"></i> Novo</a>
        </div>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Ações</th>
                    </tr>
                </thead>
                <tbody>
                    @if ($local)
                        @foreach ($local as $locais)
                            <tr>
                                <td>{{ $locais->id_local }}</td>
                                <td>{{ $locais->nome }}</td>
                                <td>
                                    <a class="btn btn-danger btn-sm" title="Deletar" href="{{ route('local.delete', $locais->id_local) }}"><i class="fa fa-trash-o"></i></a>
                                    <a class="btn btn-warning btn-sm" title="Editar" href="{{ route('local.edit', $locais->id_local) }}"><i class="fa fa-edit"></i></a>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr>
                            <td colspan="3">NENHUM CADASTRO</td>
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
                <p>Página Atual: {{ $local->currentPage('pagination::simple-bootstrap-4') }} de {{ $local->lastPage('pagination::simple-bootstrap-4') }}</p>
            </div>
            <div class="col-md-6">
                <div class="float-right">
                    {{ $local->links('pagination::simple-bootstrap-4') }}
                </div>
            </div>
        </div>
    </div>
    <!-- /.card-footer -->
</div>
<!-- /.card -->