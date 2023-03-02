<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ImageController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RealtorController;
use App\Http\Controllers\OfferController;
use App\Http\Controllers\AcceptOfferController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\NotificationSeenController;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return redirect()->route('listings.index');
});

// Route::resource('listings', ListingController::class)->except(['index', 'show'])->middleware('auth');
// Route::resource('listings', ListingController::class)->only(['index', 'show']);

Route::resource('listings', ListingController::class)->only(['index', 'show']);

Route::resource('listing.offer', OfferController::class)->only(['store'])->middleware('auth');

Route::resource('notifications', NotificationController::class)->only(['index'])->middleware('auth');


Route::get('login', [AuthController::class, 'create'])->name('login');
Route::post('login', [AuthController::class, 'store'])->name('login.store');
Route::delete('logout', [AuthController::class, 'destroy'])->name('logout');


Route::get('email/verify', function () {
    return inertia('Auth/VerifyEmail');
})->middleware('auth')->name('verification.notice');

Route::get('/email/verify/{id}/{hash}', function (EmailVerificationRequest $request) {
    $request->fulfill();

    return redirect('/listings')->with('success', 'Email verified!');
})->middleware(['auth', 'signed'])->name('verification.verify');


Route::post('/email/verification-notification', function (Request $request) {
    $request->user()->sendEmailVerificationNotification();

    return back()->with('message', 'Verification link sent!');
})->middleware(['auth', 'throttle:6,1'])->name('verification.send');




Route::resource('user', UserController::class)
    ->only(['create', 'store']);

Route::prefix('realtor')->name('realtor.')->middleware(['auth', 'verified'])->group(function () {

    Route::name('listings.restore')->put('listings/{listing}/restore', [RealtorController::class, 'restore'])->withTrashed();
    Route::resource('listings', RealtorController::class)->withTrashed();

    Route::resource('listing.image', ImageController::class)->only(['create', 'store', 'destroy']);

    Route::name('offer.accept')
        ->put(
            'offer/{offer}/accept',
            AcceptOfferController::class
        );
});

Route::put('notification/{notification}/seen', [NotificationSeenController::class, 'read'])->middleware('auth')->name('notification.seen');
Route::put('notification/seen', [NotificationSeenController::class, 'readAll'])->middleware('auth')->name('notification.seen.all');
