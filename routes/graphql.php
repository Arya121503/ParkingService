<?php
use Illuminate\Support\Facades\Route;

Route::post('/graphql', '\Nuwave\Lighthouse\Support\Http\Controllers\GraphQLController@query');
