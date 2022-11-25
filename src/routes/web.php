<?php

use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\ShortLinkController;

//Public routes
Route::get('/', [ShortLinkController::class, 'index'])->name('generate.shorten.link');
Route::post('/', [ShortLinkController::class, 'store'])->name('generate.shorten.link.post');
Route::get('{code}', [ShortLinkController::class, 'shortenLink'])->name('shorten.link');
