<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::post('oauth/access_token', function() {
    return Response::json(Authorizer::issueAccessToken());
});

Route::group(['middleware' => 'oauth'], function () {

    Route::get('authroute', function() {
        //OAuth will be required to access this route
        return 'asdf';
    });

    Route::post('postwithauth', function(Request $request) {
        $userID = Authorizer::getResourceOwnerId();
        $input = $request->input();
        return response()->json(array('userID' => $userID, 'input' => $input));
    });

});

Route::get('noauthroute', function () {
    //No authorization will be required to access this route
    return 'tanpa authorization';
});