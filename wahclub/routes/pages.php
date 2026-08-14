<?php
Route::get('/thankyou', function() {
    return view('thankyou');
})->name('thankyou');
 
Route::get('/checkoutplan', function() {
    return view('checkoutplan');
})->name('checkoutplan');
 

Route::get('/paymentsuccess', function() {
    return view('paymentsuccess');
})->name('paymentsuccess');