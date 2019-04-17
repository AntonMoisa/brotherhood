<?php

Route::group(['prefix' => 'frontend'], function (){
    Route::get('/', function () { return view('frontend.index'); });
    Route::get('/login', function () { return view('frontend.login'); });
    Route::get('/builders', function () { return view('frontend.builders'); });
    // Route::get('/admin/dashboard', function () { return view('frontend.modules.admin.content.dashboard'); });    
    // Route::get('/admin/users', function () { return view('frontend.modules.admin.content.users'); });    
    Route::get('/admin/{slug}', function () { return view('frontend.layouts.admin'); })->where('slug', '.*');
});

