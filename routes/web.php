<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

// Route::get('/assets', function () {
//     return redirect(resource_path('assets/img'));
// });

// Route::get('/assets/{folder}/{filename}', function($folder,$filename){
//     $path = resource_path() . '/assets/' . $folder . '/' . $filename;
    
//     if(!File::exists($path)) {
//         return response()->json(['message' => 'Image not found.'], 404);
//     }

//     $file = File::get($path);
//     $type = File::mimeType($path);

//     $response = Response::make($file, 200);
//     $response->header("Content-Type", $type);

//     return $response;
// });



Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
