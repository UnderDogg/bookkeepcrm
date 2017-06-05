<?php

Route::resource('bankaccounts', 'BankAccountsController', ['except' => ['show'], 'names' => [
    'index' => 'bookkeeper.bankaccounts.index',
    'create' => 'bookkeeper.bankaccounts.create',
    'store' => 'bookkeeper.bankaccounts.store',
    'edit' => 'bookkeeper.bankaccounts.edit',
    'update' => 'bookkeeper.bankaccounts.update',
    'destroy' => 'bookkeeper.bankaccounts.destroy',
]]);

Route::get('bankaccounts/search', [
    'uses' => 'BankAccountsController@search',
    'as' => 'bookkeeper.bankaccounts.search']);

Route::delete('bankaccounts/destroy/bulk', [
    'uses' => 'BankAccountsController@bulkDestroy',
    'as' => 'bookkeeper.bankaccounts.destroy.bulk']);

Route::get('bankaccounts/{id}/overview', [
    'uses' => 'BankAccountsController@overview',
    'as' => 'bookkeeper.bankaccounts.overview']);

Route::get('bankaccounts/{id}/transactions', [
    'uses' => 'BankAccountsController@transactions',
    'as' => 'bookkeeper.bankaccounts.transactions']);