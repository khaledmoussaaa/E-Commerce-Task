<?php

use App\Livewire\CartComponent;
use App\Livewire\ProductComponent;
use Illuminate\Support\Facades\Route;

// ================== Home ================ //
// Products Route
Route::get('/', ProductComponent::class);

// Carts Route
Route::get('/carts', CartComponent::class);
