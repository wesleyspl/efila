@extends('templates.admin1')

@section('content')

@if (session('success'))

<div class="alert alert-success alert-dismissable">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
    {{session('success')}}.
</div>

@endif


 <div class="row">
    <x-card-dashboard
    count="{{ $total_servicos }}" 
    title="Serviços" 
    icon="fa fa-paste" 
    link="/servico/" 
    bgColor="bg-light" 
/>
<x-card-dashboard
count="{{ $total_atendentes }}" 
title="Atendentes" 
icon="fa fa-users" 
link="/atendente/" 
bgColor="bg-light" 
/>

<x-card-dashboard
count="{{ $total_locais }}" 
title="Locais de Atendimento" 
icon="fa fa-map" 
link="/local/" 
bgColor="bg-light" 
/>

<x-card-dashboard
count="{{ $total_PSenha }}" 
title="Painel de Senhas" 
icon="fa fa-tv" 
link="/painel/" 
bgColor="bg-light" 
/>

<x-card-dashboard
count="{{ $total_touch }}" 
title="Painel Auto Atendimento" 
icon="fa fa-tablet" 
link="/touch/" 
bgColor="bg-light" 
/>

        </div>







 @endsection
