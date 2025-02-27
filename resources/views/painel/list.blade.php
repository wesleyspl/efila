@extends('templates.admin')

@section('content')

@if (session('success'))

<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    {{session('success')}}.
</div>

@endif

<div class="widget">
    
    <div class="widget-content">
       
        @include('painel.partials.table-painel')

   </div>








 @endsection
