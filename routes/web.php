<?php

use App\Http\Controllers\HomeController;
use App\Http\Controllers\InputDataController;
use App\Http\Controllers\VikorController;

// Home route
Route::get('/', [HomeController::class, 'index'])->name('home');

// Input Data routes
Route::get('/inputdata', [InputDataController::class, 'index'])->name('inputdata.index');
Route::post('/inputdata/create-criteria', [InputDataController::class, 'createCriteria'])->name('inputdata.createCriteria');
Route::delete('/inputdata/delete-criteria', [InputDataController::class, 'deleteCriteria'])->name('inputdata.deleteCriteria');
Route::get('/inputdata/edit-penilaian/{id}', [InputDataController::class, 'editPenilaian'])->name('inputdata.editPenilaian');
Route::post('/inputdata/update-penilaian', [InputDataController::class, 'updatePenilaian'])->name('inputdata.updatePenilaian');
Route::post('/inputdata/create-alternatif', [InputDataController::class, 'createAlternatif'])->name('inputdata.createAlternatif');
Route::delete('/inputdata/delete-alternatif', [InputDataController::class, 'deleteAlternatif'])->name('inputdata.deleteAlternatif');
Route::post('/inputdata/store', [InputDataController::class, 'store'])->name('inputdata.store');
Route::delete('/inputdata/delete-penilaian', [InputDataController::class, 'deletePenilaian'])->name('inputdata.deletePenilaian');
Route::put('/inputdata/update-criteria', [InputDataController::class, 'updateCriteria'])->name('inputdata.updateCriteria');
Route::put('/inputdata/update-alternatif', [InputDataController::class, 'updateAlternatif'])->name('inputdata.updateAlternatif');


// VIKOR route
Route::get('/vikor', [VikorController::class, 'index'])->name('vikor.index');


