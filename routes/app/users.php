<?php

use Illuminate\Support\Facades\Route;
use LaravelLiberu\Users\Http\Controllers\Create;
use LaravelLiberu\Users\Http\Controllers\Destroy;
use LaravelLiberu\Users\Http\Controllers\Edit;
use LaravelLiberu\Users\Http\Controllers\ExportExcel;
use LaravelLiberu\Users\Http\Controllers\InitTable;
use LaravelLiberu\Users\Http\Controllers\Options;
use LaravelLiberu\Users\Http\Controllers\ResetPassword;
use LaravelLiberu\Users\Http\Controllers\Show;
use LaravelLiberu\Users\Http\Controllers\Store;
use LaravelLiberu\Users\Http\Controllers\TableData;
use LaravelLiberu\Users\Http\Controllers\Update;

Route::prefix('users')
    ->as('users.')
    ->group(function () {
        Route::get('create/{person}', Create::class)->name('create');
        Route::post('', Store::class)->name('store');
        Route::get('{user}/edit', Edit::class)->name('edit');
        Route::patch('{user}', Update::class)->name('update');
        Route::delete('{user}', Destroy::class)->name('destroy');

        Route::get('initTable', InitTable::class)->name('initTable');
        Route::get('tableData', TableData::class)->name('tableData');
        Route::get('exportExcel', ExportExcel::class)->name('exportExcel');

        Route::get('options', Options::class)->name('options');

        Route::get('{user}', Show::class)->name('show');

        Route::post('{user}/resetPassword', ResetPassword::class)->name('resetPassword');

        require __DIR__.'/token/tokens.php';
        require __DIR__.'/session/sessions.php';
    });
