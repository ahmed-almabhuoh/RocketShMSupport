<?php

use App\Livewire\BlogComponent;
use App\Livewire\HelpCenterComponent;
use Illuminate\Support\Facades\Route;


Route::prefix('')->group(function () {


    Route::get('', HelpCenterComponent::class);

    Route::get('blog/{slug}', BlogComponent::class)->name('blogs.view');
});
