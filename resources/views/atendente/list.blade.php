@extends('templates.admin1')

@section('content')

@if (session('success'))

<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    {{session('success')}}.
</div>

@endif



   
@include('atendente.partials.table-atendente')
  






 @endsection
