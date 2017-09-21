<?php
use App\Route as Route;
Route::set('/', 'Home');
Route::set('login', 'Home');
Route::set('/page/{page}', 'Home');
Route::set('/page/{user}/{page}', 'Home');
