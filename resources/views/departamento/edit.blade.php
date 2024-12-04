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

        <form role="form" method="post" action="{{route('departamento.update',$departamento->id_departamento)}}"  class="bv-form">
           @csrf
           @method('put')

            <div class="form-group">
            <label>Nome</label>
            <input type="text" class="form-control" name="nome" value="{{$departamento->nome}}">


            <small style="display: none" data-bv-validator="notEmpty" data-bv-validator-for="name" class="help-block"></small><small style="display: none;" data-bv-validator="regexp" data-bv-validator-for="name" class="help-block"></small></div>


          <button type="submit" class="btn btn-primary">Salvar</button>
        <input type="hidden" value="">
    </form>
    </div>
</div>












@endsection
