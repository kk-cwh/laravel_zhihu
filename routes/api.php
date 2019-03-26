<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('topics', function (Request $request) {
    $topics = \App\Topic::where('name', 'like', '%'.$request->input('q', '').'%')->get();

    return $topics;
});

Route::post('question/follower', function (Request $request) {
    $followed = (bool) DB::table('user_questions')->where('user_id', $request->input('user'))->where('question_id', $request->input('question'))->count();

    return compact('followed');
});

Route::post('question/follow', function (Request $request) {
    $user = \App\User::find($request->input('user'));
    $user->questions()->toggle($request->input('question'));
    $followed = $user->followed($request->input('question'));

    return compact('followed');
});
