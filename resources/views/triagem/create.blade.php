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

        <form role="form" method="post" action="{{route('triagem.store',$atendente->id_atendente)}}"  class="bv-form">
           @csrf
           @method('put')



          <div class="form-group">
            <label>Atendente</label>
            <input type="text" class="form-control" name="nome" disabled value="{{$atendente['pessoa']->nome}}">
          </div>
          <div class="form-group">
            <label>Local</label>

           <select class="form-control" name='local'>
           @if ($local)
              @foreach ($local as $locais)
              <option>{{$locais->nome}}</option>
              @endforeach
           @endif


            </select>
           </div>
          <div class="form-group">
            <label>Numero</label>
            <input type="text" class="form-control"  name="numero" >
          </div>

          <div class="form-group">
            <label class="col-sm-2 control-label">Serviços</label>

            <div class="col-sm-10">

                @if ($servicos)
                @foreach ($servicos as $servico)
                <div class="checkbox">
                  <label>

                    <input type="checkbox" name="id_servico[]" value="{{$servico->id_servico}}">
                     {{$servico->nome}}


                  </label>
                </div>
                @endforeach

                @endif
            </div>

          </div>

          <button type="submit" class="btn btn-primary">Salvar</button>
        <input type="hidden" value="">
    </form>
    </div>
</div>












@endsection
