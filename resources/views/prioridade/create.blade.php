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

        <form role="form" method="post" action="{{route('prioridade.store')}}"  class="bv-form">
           @csrf
            <div class="form-group">
            <label>Nome</label>
            <input type="text" class="form-control" name="nome" value="{{ old('nome') }}">
          </div>
          <div class="form-group">
            <label>Peso</label>
            <input type="text" class="form-control" name="peso" value="{{ old('peso') }}">
          </div>


          <button type="submit" class="btn btn-primary">Salvar</button>
        <input type="hidden" value="">
    </form>
    </div>
</div>












@endsection
