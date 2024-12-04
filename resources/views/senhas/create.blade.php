@extends('templates.admin')

@section('content')

@if (session('success'))

<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    {{session('success')}}.
</div>

@endif
@if (session('error'))

<div class="alert alert-danger alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    {{session('error')}}.
</div>

@endif


    <div class="widget">
        <div class="widget-header ">
            <h2><i class="icon-chart-pie-1"></i> <strong>{{$departamento}}</strong> Triagem</h2>

        </div>
        <div class="widget-content padding">

             <table class="table responsive">
                <tr>
                    <th>ID</th>
                    <th>SEVIÇO</th>
                    <th>EMITIR SENHA</th>
                </tr>

                @if ($servicos)
                     @foreach ($servicos as $servico)
                         <tr>
                            <td>{{$servico[0]->id_servico}}</td>
                            <td>{{$servico[0]->nome}}</td>
                            <td><a  id="generatePasswordBtn" href="{{route('senha.emitir',[$servico[0]->id_servico,$departamento,1])}}" class="btn btn-success"><i class="fa fa-ticket"></i> Normal</a>
                                <a href="" class="btn btn-danger"><i class="fa fa-ticket"></i> Preferencial</a>
                            </td>
                         </tr>
                      @endforeach
                @else
                <tr>
                 <td colspan="3">NENHUM DEPARTAMENTO</td>
                </tr>
                @endif

             </table>


        </div>
    </div>








</script>
 @endsection
