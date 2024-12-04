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
            <h2><i class="icon-chart-pie-1"></i> <strong>Departamentos</strong> Triagem</h2>

        </div>
        <div class="widget-content padding">

             <table class="table responsive">
                <tr>
                    <th>ID</th>
                    <th>DEPARTAMENTO</th>
                    <th>TRIAGEM</th>
                </tr>
                @if ($departamento)
                     @foreach ($departamento as $departamentos)
                         <tr>
                            <td>{{$departamentos->id_departamento}}</td>
                            <td>{{$departamentos->nome}}</td>
                            <td><a href="{{route('senha.triagem',[$departamentos->id_departamento,$departamentos->nome])}}" class="btn btn-primary"><i class="fa fa-ticket"></i> Triagem</td>
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








 @endsection
