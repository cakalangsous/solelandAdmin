<?php

use App\Http\Controllers\Admin\CitiesController;
use App\Http\Controllers\Admin\SolepediaController;
use App\Http\Controllers\Admin\SolepediaImageController;
use Illuminate\Support\Facades\Route;

//all created routes would be here


// routes for cities
Route::resource("/cities", CitiesController::class)->except('show');


// routes for solepedias
Route::resource("/solepedia", SolepediaController::class)->except('show');
Route::get("/solepedia/{id}/images/", [SolepediaController::class, "images"])->name("sole_images");
Route::get("/solepedia/images/{id}", [SolepediaController::class, "images_add"])->name("solepedias_image");


// routes for solepedia_images
Route::resource("/solepedia_images", SolepediaImageController::class)->except('show');
