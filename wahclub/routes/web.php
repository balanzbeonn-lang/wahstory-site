<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\StepFormController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ToolController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route; 


// Main Page & Frontend #################################################
// ######################################################################

 Route::get('/', [MainController::class, 'MainPageData'])->name('mainpage'); 
  

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


Route::get('/thankyou', function() {
    return view('thankyou');
})->name('thankyou');
 
Route::get('/checkoutplan', function() {
    return view('checkoutplan');
})->name('checkoutplan');
 

Route::get('/paymentsuccess', function() {
    return view('paymentsuccess');
})->name('paymentsuccess');

Route::get('/viewcalendar', function() {
    return view('viewcalendar');
})->name('viewcalendar');

Route::get('/shareavailability', function() {
    return view('shareavailability');
})->name('shareavailability');

Route::get('/tcalendar', function() {
    return view('tcalendar');
})->name('tcalendar');


Route::get('/thankyoutest', function() {
    return view('thankyoutest');
})->name('thankyoutest');
 
Route::get('/test', [MainController::class, 'getalltimezones'])->name('test');
Route::post('/update-timezone', [MainController::class, 'updateTimezone'])->name('timezone.update');

  

 
// Individual Portfolio Page ############################################
// ######################################################################
Route::post('/letsconnectformsubmit', [StepFormController::class, 'letsconnectformsubmit']); //Submit lets connect form

//To book a slot
Route::post('/bookaslot', [StepFormController::class, 'bookaslot']);

Route::get('/{slugUsername}', [StepFormController::class, 'getUserPortfolioBySlug'])->name('profile');


Route::fallback(function () {
    return redirect('/');
});