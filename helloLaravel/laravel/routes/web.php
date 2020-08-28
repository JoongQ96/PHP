<?php

use Illuminate\Support\Facades\Route;

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

// url 등록
Route::get('/', function () {
    // resource/views/welcome.blade.php file 반환
    return view('welcome');
});

// test용
//Route::get('/', function (){
//    $webPrograms = [
//        'html',
//        'css',
//        'javascript',
//        'php',
//    ];
//    return view('test')->with([
//        'webPrograms' => $webPrograms
//    ]);
////    return view('test', [
////        'webPrograms' => $webPrograms
////    ]);
//});
                       // 사용할 컨트롤러@함수 이름
// Route::get('/', 'HomeController@index');

Route::get('/projects', 'ProjectController@index');


///////////////////////////////////////////////////
Route::get('/AllList',function () {
    // 전체 게시글 리스트 페이지
    return view('AllList');
});

Route::get('/AllList',function () {
    // 공지 사항 페이지
    return view('AllList');
});

Route::get('/userList',function () {
    // 이용자 페이지
    return view('AllList');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('home/show', 'HomeController@show')->name('home.show');

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
// --> 글 작가 페이지
Route::get('/writers/writer', 'WriterController@writer')->name('writers.writer');     // home
Route::get('/writers/{writer}', 'WriterController@show')->name('writers.show');       // view

Route::get('/writers/{writer}/edit', 'WriterController@edit')->name('writers.edit');  // modify
Route::put('/writers/{writer}', 'WriterController@update')->name('writers.update');   // modify_process

Route::delete('/writers/{writer}', 'WriterController@destroy');                           // delete

Route::get('/create', 'WriterController@create')->name('writers.create')->middleware('auth'); // write
//Route::get('/writers/create', 'WriterController@create')->name('writer.create')->middleware('auth'); // write -> 오류.. 왜..?
Route::post('/writers', 'WriterController@store');                                                           // write_process

///////////////////////////////////////////////////
// --> 그림 작가 페이지
Route::get('/painters/painter', 'PainterController@painter')->name('painters.painter');  // home
Route::get('/painters/{painter}', 'PainterController@show')->name('painters.show');       // view

Route::get('/painters/{painter}/edit', 'PainterController@edit')->name('painters.edit');  // modify
Route::put('/painters/{painter}', 'PainterController@update')->name('painters.update');   // modify_process

Route::delete('/painters/{painter}', 'PainterController@destroy');                           // delete

Route::get('/input', 'PainterController@create')->name('painters.input')->middleware('auth'); // write
//Route::get('/painters/create', 'PainterController@create')->name('painters.create')->middleware('auth'); // write
Route::post('/painters', 'PainterController@store');                                                           // write_process


///////////////////////////////////////////////////
// --> 운영자 페이지


