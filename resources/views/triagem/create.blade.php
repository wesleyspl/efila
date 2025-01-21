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
            <input type="text" class="form-control"  value="{{$numero->numero}}" name="numero" >
          </div>


            <fieldset class="border p-3">
                <div class="form-group">
                  <label class="col-sm-2 control-label">Serviços ativos para o atendente</label>
                   <br>
                  <div class="col-sm-10">


          <table class="table" style="border-spacing: 0;">
              @if ($meus_servicos)
                  @foreach ($meus_servicos as $meus)
                      <tr>
                          <td>
                              <label>{{$meus->nome}}</label>
                          </td>
                          <td>
                              <a href="{{ route('triagem.destivaServico', [$meus->id_servico,$atendente->id_atendente]) }}"  value="{{$meus->id_servico}}" class="btn btn-sm btn-danger">
                                  <i class="fa fa-trash"></i>
                              </a>
                          </td>
                      </tr>
                  @endforeach
              @endif
          </table>

                </div>
                </fieldset>



                <hr color="silver">

                <div class="form-group">
                  <label class="col-sm-2 control-label">Serviços para ativar</label>

                  <div class="col-sm-10">

                      @if ($servico)
                      @foreach ($servico as $servicos)
                      <div class="checkbox">
                        <label>

                          <input type="checkbox" name="id_servico[]" value="{{$servicos->id_servico}}">
                           {{$servicos->nome}}


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
