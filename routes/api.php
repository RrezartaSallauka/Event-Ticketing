<?php


use App\Http\Controllers\EventCreateController;
use App\Http\Controllers\EventDeleteController;
use App\Http\Controllers\EventIndexController;
use App\Http\Controllers\EventUpdateController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\TicketCreateController;
use App\Http\Controllers\TicketIndexController;
use App\Http\Controllers\UserCreateController;
use App\Http\Controllers\VenueCreateController;
use App\Http\Controllers\VenueIndexController;
use App\Http\Middleware\GateCheckerMiddleware;
use Illuminate\Support\Facades\Route;

Route::post('/login', LoginController::class);
Route::post('/register', UserCreateController::class);

Route::middleware(['auth:sanctum'])->group(function () {
    Route::group(['prefix' => '/venues'], function () {
        Route::post('/', VenueCreateController::class);
        Route::get('/', VenueIndexController::class);
    })->middleware(GateCheckerMiddleware::class.':admin-access');
    Route::group(['prefix' => '/events'], function () {
        Route::middleware(GateCheckerMiddleware::class.':admin-access')->group(function () {
            Route::post('/', EventCreateController::class);
            Route::patch('/{eventId}', EventUpdateController::class);
            Route::delete('/{eventId}', EventDeleteController::class);
        });
        Route::get('/', EventIndexController::class);

    });
    Route::group(['prefix' => '/tickets'], function () {
        Route::get('/', TicketIndexController::class);
        Route::post('/', TicketCreateController::class);
    });
});
