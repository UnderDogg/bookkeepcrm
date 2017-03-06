<?php

Route::resource('tags', 'TagsController', ['except' => ['show'], 'names' => [
    'index'   => 'bookkeeper.tags.index',
    'create'  => 'bookkeeper.tags.create',
    'store'   => 'bookkeeper.tags.store',
    'edit'    => 'bookkeeper.tags.edit',
    'update'  => 'bookkeeper.tags.update',
    'destroy' => 'bookkeeper.tags.destroy',
]]);

Route::get('tags/search', [
    'uses' => 'TagsController@search',
    'as'   => 'bookkeeper.tags.search']);

Route::get('tags/{id}/transactions', [
    'uses' => 'TagsController@transactions',
    'as'   => 'bookkeeper.tags.transactions']);