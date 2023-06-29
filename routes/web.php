<?php

use GMarineau\LaravelPwa\Http\Controllers\LaravelPwaController;

Route::group(['as' => 'laravelpwa.'], function () {
    Route::get('manifest.json', [LaravelPwaController::class, 'manifestJson'])
        ->name('manifest');
    Route::get('offline', [LaravelPwaController::class, 'offline']);
});
