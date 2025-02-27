@extends('templates.admin')

@section('content')

@if (session('success'))

<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    {{session('success')}}.
</div>

@endif

<div class="widget">
    <div class=" transparent">


    </div>
    <div class="widget-content">

   @include('touch.partials.table-touch')

    </div>



   </div>








 @endsection
