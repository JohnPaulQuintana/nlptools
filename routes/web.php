<?php

use App\Http\Controllers\NLPController;
use Illuminate\Support\Facades\Route;


Route::get('/', [NLPController::class, 'index'])->name('index');

Route::get('/token',[NLPController::class, 'tokenizeInput']);

// Route::get('/nlp', [NLPController::class, 'index']);
// Route::get('/classify-text', [NLPController::class, 'classify']);
// Route::get('/evaluate', [NLPController::class, 'evaluate']);


// Route::get('/classify-and-evaluate', [NLPController::class, 'classifyAndEvaluate']);