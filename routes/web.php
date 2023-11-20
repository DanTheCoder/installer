<?php

use Illuminate\Support\Facades\Route;
use DanTheCoder\Installer\Http\Controllers\CreateUserController;
use DanTheCoder\Installer\Http\Controllers\RequirementController;
use DanTheCoder\Installer\Http\Controllers\RunCommandsController;
use DanTheCoder\Installer\Http\Controllers\ConfigurationController;

Route::middleware(['web', 'install_completed'])->prefix('install')->name('installer::')->group(function () {
    Route::resource('/', RequirementController::class)->only(['index']);
    Route::resource('/configuration', ConfigurationController::class)->only(['index', 'store']);
    Route::get('/run-commands', RunCommandsController::class)->name('run-commands');
    Route::resource('/create-user', CreateUserController::class)->only(['index', 'store']);
});
