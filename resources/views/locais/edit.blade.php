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

        <form role="form" method="post" action="{{route('local.update',$local->id_local)}}"  class="bv-form">
           @csrf
           @method('put')
            <div class="form-group">
            <label>Nome</label>
            <input type="text" class="form-control" name="nome" value="{{$local->nome}}">
            <input type="hidden" name="id_prioridade" value="{{$local->id_local}}">
          </div>



          <button type="submit" class="btn btn-primary">Salvar</button>
        <input type="hidden" value="">
    </form>
    </div>
</div>












@endsection
