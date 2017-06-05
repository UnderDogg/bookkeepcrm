<?php

require 'routes/auth.php';
require 'routes/common.php';

// Authenticated reactor
Route::group(['middleware' => [
    'auth',
    'set-theme:' . config('themes.active')
]], function () {
    require 'routes/bankaccounts.php';
    require 'routes/companies.php';
    require 'routes/lists.php';
    require 'routes/overview.php';
    require 'routes/people.php';
    require 'routes/profile.php';
    require 'routes/settings.php';
    require 'routes/tags.php';
    require 'routes/transactions.php';
    require 'routes/update.php';
    require 'routes/users.php';
});
