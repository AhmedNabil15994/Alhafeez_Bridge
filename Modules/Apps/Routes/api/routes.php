<?php

Route::controller(CategoryController::class)->prefix('/categories')->group(function (){
    Route::get('/'   , 'index')->name('api.categories.index');
    Route::get('/children/{parent_id}'   , 'getChildren')->name('api.categories.index');
});
