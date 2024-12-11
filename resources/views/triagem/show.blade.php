@extends('templates.admin')

@section('content')



<div class="widget">


    <div class="widget-content padding">
         @if ($errors->any())
        <div class="alert alert-danger nomargin">
         <ul>
            @foreach ($errors->all() as $erros)
           <li> {{$erros}}</li>
        @endforeach
         </ul>
    </div>
        @endif

        <form role="form" method="post" action=""  class="bv-form">
           @csrf
           @method('put')


<label><strong>Atendente:</strong> {{$pessoa}}</label>
<br>

<label><strong>Local:</strong> {{$local->nome}}</label>
<br>
<label><strong>  Numero: </strong> {{$numero}}</label>
<hr color="red">
 <h5><strong>SERVICOS</strong></h5>
 <hr color="red">
 <table>

 @foreach ($servico as $servicos)
 <tr>
 <td>
 <label>{{$servicos->nome}}</label> </td>
 <td>
    <a href="{{ route('triagem.destroy', [$servicos->id_servico,$atendente->id_atendente]) }}" class="btn btn-danger">
        <i class="fa fa-trash"></i>
    </a>   </tr>

 <br>
 @endforeach
 </table>
 <hr color="red">
 <a class="btn btn-primary" href="{{route('triagem')}}"><i class="fa fa-refresh"></i> Voltar</a>
    </form>
    </div>
</div>












@endsection
