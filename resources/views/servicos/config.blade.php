@extends('templates.admin')

@section('content')

@if (session('success'))

<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    {{session('success')}}.
</div>

@endif

<div class="col-sm-12 portlets ui-sortable">
    <div class="widget">
        <div class="widget-header ">
            <h3><i class="fa fa-ticket"></i> <strong> </strong>Configurar senhas </h2>

        </div>
        <div class="widget-content padding">
           <h4><strong>SERVIÇO:</strong> {{$servico->nome}} </h4>
        </hr>
        <h4><strong>SIGLA:</strong> {{$servico->sigla}} </h4>
    </hr>

        </div>
    </div>
</div>


<div class="col-md-12">
    <div class="widget">
        <div class="widget-header transparent">
            <h2><strong>Prioridades</strong></h2>

        </div>
        <hr>
        <div class="form-group">
            <form action="{{route('servico.prioridade.update', $servico->id_servico)}}" method="post">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="form-group col-md-3">
                        <label for="prioridade">Prioridade</label>
                        <input type="text" class="form-control" id="prioridade" name="prioridade" value="{{$ordenacao->prio_total}}" placeholder="Prioridade" maxlength="3" pattern="\d{1,3}" title="Please enter a number between 1 and 999">
                    </div>
                    <div class="form-group col-md-3">
                        <label for="normal">Normal</label>
                        <input type="text" class="form-control" id="normal" name="normal" value="{{$ordenacao->nor_total}}" placeholder="Normal" maxlength="3" pattern="\d{1,3}" title="Please enter a number between 1 and 999">
                    </div>
                  
                    <div class="form-group col-md-4">
                        <p>Configure a frequencia das senhas a serem chamadas.A  logica é : A cada x priotarias chamar x normais.</p>

                    </div>
                </div>
                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary">Salvar</button>
                </div>
               
            </form>
        </div>
</div>
</div>





 @endsection
