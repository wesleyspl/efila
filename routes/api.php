<?php

use App\Http\Requests\ServicoRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (ServicoRequest $request) {
    return $request;
});
