<?php

Auth::routes();	

Route::get('/', 'AnimeController@index' )->name('index.user');

Route::get('anime/more/','AnimeController@more')->name('more.anime');
Route::get('anime/more/tv','AnimeController@more')->name('more.anime');
Route::get('anime/more/movie','AnimeController@more')->name('more.anime');
Route::get('anime/more/ova','AnimeController@more')->name('more.anime');
Route::get('anime/more/desc','AnimeController@more')->name('anime.desc');
Route::get('anime/more/asc','AnimeController@more')->name('anime.asc');


Route::post('anime/search', 'AnimeController@search')->name('anime.search');
Route::get('anime/search', 'AnimeController@search')->name('anime.search');
Route::get('/anime/detail/{id}', 'AnimeController@detail')->name('detail.anime');
Route::group(['middleware'=>'auth'], function(){
	Route::get('/edit','UserController@editUser')->name('index.edit');
	Route::get('/favorit/user/{username}','UserController@showFavorite')->name('list.favorit');
	Route::post('/anime/{animes}/givecomment','UserController@giveComment')->name('anime.comment');
	Route::post('/anime/{animes}/giverating', 'UserController@giveRating')->name('anime.rating');
	Route::post('/favorit/{animes}','UserController@postFavorite')->name('anime.favorit');
	Route::get('/anime/recommendation','UserController@recommendation')->name('anime.recommendation');
	Route::post('/edit/save','UserController@SaveEditUser')->name('index.edit.save');
});
Route::get('/logout','Auth\LoginController@logout')->name('logout');

Route::get('/administrator','AdminController@getLogin')->name('form.login');
Route::post('/administrator/login','AdminController@postLogin')->name('post.login');
Route::get('/administrator/logout','AdminController@logout')->name('admin.logout');

Route::group(['prefix' => 'administrator','middleware'=>'auth:admin'],function(){
	Route::get('/dashboard','AdminController@dashboard')->name('dashboard');
	Route::match(['GET','POST'],'/data/users','AdminController@getUsers')->name('dataProcessing');
	Route::match(['GET','POST'],'/data/animes','AdminController@getAnimes')->name('dataAnime');
	Route::get('/data/users/delete/{id}','AdminController@deleteUser')->name('delete.users');
	Route::get('/data/users/edit/{id}','AdminController@editUser')->name('edit.users');
	Route::get('/data/comment/','AdminController@getComments')->name('data.comments');
	Route::get('/data/comment/json','AdminController@getCommentsJson')->name('data.comment.json');
	Route::post('/data/users/update/{id}','AdminController@updateUser')->name('update.users');

	Route::get('/data/recommendation/json','AdminController@getRecommendationJson')->name('data.recommendation.json');
	Route::get('/data/recommendation','AdminController@getRecommendation')->name('data.recommendation');
	
	//UPDATE RECOMMENDATION
	Route::get('/data/update/recommendation','AdminController@recommendation')->name('update.recommendation');
	Route::get('/mae','AdminController@mae')->name('mae');
});


