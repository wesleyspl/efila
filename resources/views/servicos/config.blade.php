@extends('templates.admin1')

@section('content')

@if (session('success'))
<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    {{ session('success') }}.
</div>
@endif

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><i class="fa fa-ticket"></i> <strong>Configurar Senhas</strong></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <h4><strong>SERVIÇO:</strong> {{ $servico->nome }}</h4>
        <hr>
        <h4><strong>SIGLA:</strong> {{ $servico->sigla }}</h4>
        <hr>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title"><strong>Prioridades</strong></h3>
    </div>
    <!-- /.card-header -->
    <div class="card-body">
        <form action="{{ route('servico.prioridade.update', $servico->id_servico) }}" method="post">
            @csrf
            @method('PUT')
            <div class="form-row">
                <div class="form-group col-md-3">
                    <label for="prioridade">Prioridade</label>
                    <input type="text" class="form-control" id="prioridade" name="prioridade" value="{{ $ordenacao->prio_total }}" placeholder="Prioridade" maxlength="3" pattern="\d{1,3}" title="Please enter a number between 1 and 999">
                </div>
                <div class="form-group col-md-3">
                    <label for="normal">Normal</label>
                    <input type="text" class="form-control" id="normal" name="normal" value="{{ $ordenacao->nor_total }}" placeholder="Normal" maxlength="3" pattern="\d{1,3}" title="Please enter a number between 1 and 999">
                </div>
                <div class="form-group col-md-4">
                    <p>Configure a frequência das senhas a serem chamadas. A lógica é: A cada x prioritárias chamar x normais.</p>
                </div>
            </div>
            <div class="form-group col-md-12">
                <button type="submit" class="btn btn-primary">Salvar</button>
            </div>
        </form>
    </div>
    <!-- /.card-body -->
</div>
<!-- /.card -->

@endsection