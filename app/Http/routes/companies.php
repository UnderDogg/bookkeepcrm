<?php

Route::resource('companies', 'CompaniesController', ['except' => ['show'], 'names' => [
    'index' => 'bookkeeper.companies.index',
    'create' => 'bookkeeper.companies.create',
    'store' => 'bookkeeper.companies.store',
    'edit' => 'bookkeeper.companies.edit',
    'update' => 'bookkeeper.companies.update',
    'destroy' => 'bookkeeper.companies.destroy',
]]);

Route::get('companies/search', [
    'uses' => 'CompaniesController@search',
    'as' => 'bookkeeper.companies.search']);

Route::delete('companies/destroy/bulk', [
    'uses' => 'CompaniesController@bulkDestroy',
    'as' => 'bookkeeper.companies.destroy.bulk']);

Route::get('companies/{id}/overview', [
    'uses' => 'CompaniesController@overview',
    'as' => 'bookkeeper.companies.overview']);

Route::get('companies/{id}/transactions', [
    'uses' => 'CompaniesController@transactions',
    'as' => 'bookkeeper.companies.transactions']);