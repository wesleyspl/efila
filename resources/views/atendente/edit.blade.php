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

        <form role="form" method="post" action="{{route('atendente.update',$atendente->id_atendente)}}"  class="bv-form">
           @csrf
           @method('put')
          <div class="form-group">
            <label>Nome</label>
            <input type="text" class="form-control" name="nome" value="{{$atendente['pessoa']->nome}}">
          </div>
          <div class="form-group">
            <label>CPF</label>
            <input type="text" class="form-control" name="cpf" value="{{$atendente['pessoa']->cpf}}">
          </div>
          <div class="form-group">
            <label>Email</label>
            <input type="text" class="form-control" name="email" value="{{$atendente['pessoa']->email}}">
          </div>


          <button type="submit" class="btn btn-primary">Salvar</button>
        <input type="hidden" value="">
    </form>
    </div>
</div>












@endsection
