<?php

// WAHClub Registration & Profile Complition Form #######################
// ######################################################################

Route::get('build-my-presence/', function() {
    return redirect('/');  // Or abort(404);
});

Route::get('build-my-presence/{userid}', [StepFormController::class, 'combinedMethod'])->name('build-my-presence'); 
  
Route::post('submit-form', [UserController::class, 'store']);

Route::post('/regenerate-story', [StepFormController::class, 'regenerate']);

Route::post('/test-storygenerate', [StepFormController::class, 'testregeneratestory']);

Route::post('/savedatainsteps', [StepFormController::class, 'savedatainsteps']);