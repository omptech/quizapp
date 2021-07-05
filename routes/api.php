<?php

use Illuminate\Http\Request;

// Settings Api Routes
    Route::get('/settings/all', 'SettingsController@getSettingsApi');

// Players Api Routes
    Route::post('/players/new', 'PlayerController@store');
    Route::post('/players/new/verify', 'PlayerController@verifyBeforeStore');
    Route::post('/players/referral/add', 'PlayerController@addReferral');
    Route::post('/players/send/code', 'PlayerController@sendEmail');
    Route::post('/players/send/code/verify', 'PlayerController@verifyEmailCode');
    Route::post('/players/login', 'PlayerController@login');
    Route::post('/players/situation', 'PlayerController@verifyUserSituation');
    Route::post('/players/getplayerdata', 'PlayerController@getPlayerData');
    Route::get('/players/top10', 'PlayerController@topPlayers');
    Route::get('/players/all/desc', 'PlayerController@allPlayersDesc');
    Route::get('/players/all/asc', 'PlayerController@allPlayersAsc');
    Route::get('/players/all/alpha', 'PlayerController@allPlayersAlpha');
    Route::get('/players/first', 'PlayerController@firstPlayer');
    Route::get('/players/seconds', 'PlayerController@secondAndTirthPlayers');
    Route::post('/players/{player}/update', 'PlayerController@updatePlayerPoints');
    Route::post('/players/password/reset/send', 'PlayerController@sendResetCode');
    Route::post('/players/password/reset/verify', 'PlayerController@verifyResetCode');
    Route::post('/players/password/change', 'PlayerController@changePassword');
    Route::post('/players/edit/profile/all', 'PlayerController@editAllProfileInfos');
    Route::post('/players/image/upload', 'PlayerController@changeImage');

// Categories Api Routes
    Route::get('/categories/all', 'CategoryController@all');
    Route::get('/categories/featured', 'CategoryController@featured');

// Questions Api Routes
    Route::get('/categories/{category}/questions/easy', 'QuestionController@easyQuestions');
    Route::get('/categories/{category}/questions/medium', 'QuestionController@mediumQuestions');
    Route::get('/categories/{category}/questions/hard', 'QuestionController@hardQuestions');
    Route::get('/categories/{category}/questions/expert', 'QuestionController@expertQuestions');
    Route::post('/quiz/passed/update', 'QuestionController@makeQuizPassed');
    Route::post('/quiz/completed/check', 'QuestionController@checkIfQuizCompleted');
    Route::post('/quiz/level/check/questions', 'QuestionController@checkIfQuizContainsQuestions');

// Withdrawals Api Routes
    Route::get('/players/{player}/withdrawals', 'PlayerController@getWithdrawalHistory');
    Route::post('/withdrawals/request/new', 'PlayerController@addNewWithdrawal');

// Payment Methods Routes
    Route::get('/payments/methods/all', 'SettingsController@getPaymentMethods');

// Completed Quiz Routes
    Route::get('/players/{player}/quiz/completed', 'PlayerController@getCompletedQuiz');

// Referral Routes 
    Route::get('/players/{player}/refers', 'PlayerController@getReferralHistory');

// Settings Api Routes
    Route::get('/ads/all', 'SettingsController@getAdsApi');
