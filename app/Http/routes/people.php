<?php

Route::resource('people', 'PeopleController', ['except' => ['show'], 'names' => [
    'index'   => 'bookkeeper.people.index',
    'create'   => 'bookkeeper.people.create',
    'store'   => 'bookkeeper.people.store',
    'edit'    => 'bookkeeper.people.edit',
    'update'  => 'bookkeeper.people.update',
    'destroy' => 'bookkeeper.people.destroy',
]]);

Route::get('people/search', [
    'uses' => 'PeopleController@search',
    'as'   => 'bookkeeper.people.search']);

Route::delete('people/destroy/bulk', [
    'uses' => 'PeopleController@bulkDestroy',
    'as'   => 'bookkeeper.people.destroy.bulk']);

Route::get('people/{id}/lists', [
    'uses' => 'PeopleController@lists',
    'as'   => 'bookkeeper.people.lists']);
Route::put('people/{id}/lists', [
    'uses' => 'PeopleController@associateList',
    'as'   => 'bookkeeper.people.lists.associate']);
Route::delete('people/{id}/lists', [
    'uses' => 'PeopleController@dissociateList',
    'as'   => 'bookkeeper.people.lists.dissociate']);