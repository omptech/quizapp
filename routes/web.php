<?php

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

	// Dashboard
	Route::get('/', 'HomeController@index')->name('home');
	// Players Management
	Route::get('/players', 'HomeController@players')->name('players');
	Route::post('players/add', 'HomeController@newPlayer')->name('player.add');
	Route::get('/players/{player}/delete', 'HomeController@destroyPlayer')->name('player.destroy');
	// Categories Management
	Route::get('/categories', 'HomeController@categories')->name('categories');
    Route::get('/categories/{category}/delete', 'HomeController@destroyCategory')->name('category.delete');
    Route::post('/categories/{category}/update', 'HomeController@updateCategory')->name('category.update');
    Route::post('/categories/add', 'HomeController@newCategory')->name('category.add');
    // Questions Management
    Route::get('/questions', 'HomeController@questions')->name('questions');
    Route::get('/questions/{id}', 'HomeController@relatedQuestions')->name('related.questions');
    Route::get('/questions/{question}/delete', 'HomeController@destroyQuestion')->name('question.delete');
    Route::post('/questions/{id}/add', 'HomeController@newQuestion')->name('question.add');
    Route::post('/questions/{id}/bulk', 'HomeController@bulkImport')->name('question.bulk.import');
    Route::post('/questions/{question}/update', 'HomeController@updateQuestion')->name('question.update');
    // Withdrawals Management
    Route::get('/withdrawals', 'HomeController@withdrawals')->name('withdrawals');
    Route::post('/withdrawals/{id}/update', 'HomeController@updateWithdrawal')->name('withdrawal.update');
    // Settings Management
    Route::get('/settings', 'HomeController@settings')->name('settings');
    Route::post('/settings/update', 'HomeController@updateSettings')->name('settings.update');
    // Payment Methods
    Route::get('/payment/methods', 'HomeController@paymentMethods')->name('payment.methods');
    Route::post('payment/add', 'HomeController@newPaymentMethod')->name('payment.method.add');
    Route::get('/payment/{method}/delete', 'HomeController@destroyPaymentMethod')->name('payment.method.destroy');
    // Admins Management
    Route::get('/admins', 'HomeController@admins')->name('admins');
    Route::post('/admins/add', 'HomeController@newAdmin')->name('admin.add');
    Route::get('/admins/{admin}/delete', 'HomeController@destroyAdmin')->name('admin.destroy');

    // Ads Management
    Route::get('/ads', 'HomeController@ads')->name('ads');
    Route::post('/ads/update', 'HomeController@updateAds')->name('ads.update');

});
