<?php

// Individual Portfolio Page ############################################
// ######################################################################
Route::post('/letsconnectformsubmit', [StepFormController::class, 'letsconnectformsubmit']);

Route::get('/{slugUsername}', [StepFormController::class, 'getUserPortfolioBySlug'])->name('profile');