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

        <form role="form" method="post" action="{{route('servico.prioridade',$servico->id_servico)}}"  class="bv-form">
           @csrf
           @method('put')
           <div class="form-group">
            <label>Departamento</label>

           <select class="form-control" name='departamento'>
           @if ($departamentos)
              @foreach ($departamentos as $departamento)
              <option>{{$departamento->nome}}</option>
              @endforeach
           @endif


            </select>
           </div>


            <div class="form-group">
            <label>Nome</label>
            <input type="text" class="form-control" name="nome" value="{{$servico->nome }}">

           </div>
           <div class="form-group">
            <label>Sigla</label>
            <input type="text" class="form-control" name="sigla" value="{{$servico->sigla }}">

           </div>

          <button type="submit" class="btn btn-primary">Salvar</button>
        <input type="hidden" value="">
    </form>
    </div>
</div>












@endsection
