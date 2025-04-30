<?php

use Illuminate\Support\Facades\Route;
use MySoftITWebInstaller\Controllers\InstallController;

Route::group([
    'prefix' => 'install',
    'as' => 'installer.',
    'middleware' => ['web', 'can_install']
], function () {
    Route::get('/', [InstallController::class, 'index'])->name('index');
    Route::get('/requirements', [InstallController::class, 'requirements'])->name('requirements');
    Route::get('/license', [InstallController::class, 'license'])->name('license');
    Route::post('/license', [InstallController::class, 'verifyLicense'])->name('verify-license');
    Route::get('/database', [InstallController::class, 'database'])->name('database');
    Route::post('/database', [InstallController::class, 'saveDatabase'])->name('save-database');
    Route::get('/import', [InstallController::class, 'import'])->name('import');
    Route::post('/import', [InstallController::class, 'processImport'])->name('process-import');
    Route::get('/admin', [InstallController::class, 'admin'])->name('admin');
    Route::post('/admin', [InstallController::class, 'saveAdmin'])->name('save-admin');
    Route::get('/complete', [InstallController::class, 'complete'])->name('complete');
});