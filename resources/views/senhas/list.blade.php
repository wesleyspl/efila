@extends('templates.admin1')

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


   
       
      
      @include('senhas.partials.table-senha')


   








 @endsection
