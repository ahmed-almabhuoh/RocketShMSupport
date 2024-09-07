<?php

use App\Livewire\HelpCenterComponent;
use Illuminate\Support\Facades\Route;


Route::prefix('')->group(function () {


    Route::get('', HelpCenterComponent::class);

});
