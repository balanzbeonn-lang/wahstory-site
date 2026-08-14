<?php

// Categories ############################

Route::get('members/{category}', [CategoryController::class, 'getUsersbySingleCategory'])
    ->name('singlecat');

Route::get('members/', [MainController::class, 'getAllUsers'])->name('showallusers');    

Route::post('/connectwithclubmember', [MainController::class, 'connectwithclubMember']);
    

// Skills ############################

Route::get('skills/{slug}', [SkillController::class, 'GetMembersBySkill'])
    ->name('singleskill');

Route::get('skills/', function() {
    return redirect('/');
}); 


// Tools ############################

Route::get('tools/{slug}', [ToolController::class, 'getMembersByTool'])
    ->name('singletool');

Route::get('tools/', function() {
    return redirect('/');
}); 


// Show & Search All Users ############################

Route::get('showallusers', [MainController::class, 'getAllUsers'])->name('showallusers'); 

Route::get('search-results', [MainController::class, 'getUserswithSearch'])->name('search-results'); 

