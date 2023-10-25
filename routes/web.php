<?php
use App\Http\Controllers\homeController;
use App\Http\Controllers\reporteController;
use Illuminate\Support\Facades\Route;

Route::controller(homeController::class)->group(function(){
    Route::get('/', 'index')->name('index');
    Route::get('reporte','reporte');

});
 



Route::controller(reporteController::class)->group(function(){

    Route::get('/generar-reporte','reporte')->name('generar-reporte');
    Route::post('reportes','store')->name('reportes.store');
});




//Route::get('/', HomeController::class);


