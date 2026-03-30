<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController as ApiUserController;


Route::get('/clubusers', [ApiUserController::class, 'AllClubUsers']);
?>