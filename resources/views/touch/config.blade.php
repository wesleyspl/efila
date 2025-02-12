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

        <form role="form" method="post" action="{{route('touch.save')}}"  class="bv-form">
           @csrf
           @method('put')



          <div class="form-group">
            <label>Nome</label>
            <input type="text" class="form-control" name="nome"  value="{{$painel->nome}}">
            <input type="hidden" name="id_painel" value="{{$painel->id_touch}}">
          </div>
          <div class="form-group">
            <label>Obs</label>
            <input type="text" class="form-control" name="obs" value="{{$painel->obs}}">
          </div>

          <fieldset class="border p-3">
          <div class="form-group">
            <label class="col-sm-2 control-label">Serviços do painel</label>
             <br>
            <div class="col-sm-10">


    <table class="table" style="border-spacing: 0;">
        @if ($meus_servicos)
            @foreach ($meus_servicos as $meus)
                <tr>
                    <td>
                        <label>{{$meus['servico']->nome}}</label>
                    </td>
                    <td>
                      <a href="{{ route('touch.destivaServico', [$painel->id_touch,$meus->servico_id]) }}"  value="{{$meus->id_servico}}" class="btn btn-sm btn-danger">
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
            <label class="col-sm-2 control-label">Serviços</label>

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
