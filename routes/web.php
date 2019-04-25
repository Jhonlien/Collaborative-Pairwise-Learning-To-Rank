<?php
use App\User;
use App\Anime;
use App\Favorite;
use App\Comment;
use App\Rating;

Auth::routes();	

Route::get('/', 'AnimeController@index' )->name('index.user');

Route::get('anime/more/','AnimeController@more')->name('more.anime');
Route::get('anime/more/tv','AnimeController@more')->name('more.anime');
Route::get('anime/more/movie','AnimeController@more')->name('more.anime');
Route::get('anime/more/ova','AnimeController@more')->name('more.anime');
Route::get('anime/more/desc','AnimeController@more')->name('anime.desc');
Route::get('anime/more/asc','AnimeController@more')->name('anime.asc');
Route::get('anime/more/rating','AnimeController@more')->name('anime.rating');
Route::get('anime/more/members','AnimeController@more')->name('anime.members');


Route::post('anime/search', 'AnimeController@search')->name('anime.search');
Route::get('anime/search', 'AnimeController@search')->name('anime.search');
Route::get('/anime/detail/{id}', 'AnimeController@detail')->name('detail.anime');
Route::group(['middleware'=>'auth'], function(){
	Route::get('/edit','UserController@editUser')->name('index.edit');
	Route::get('/manage/user/{username}','UserController@manage')->name('manage');
	Route::get('/favorit/user/{username}','UserController@showFavorite')->name('list.favorit');
	Route::post('/anime/{animes}/givecomment','UserController@giveComment')->name('anime.comment');
	Route::post('anime/add/','UserController@addAnime')->name('anime.add');
	Route::post('/anime/{animes}/giverating', 'UserController@giveRating')->name('anime.rating');
	Route::post('/favorit/{animes}','UserController@postFavorite')->name('anime.favorit');
	Route::get('/anime/recommendation','UserController@recommendation')->name('anime.recommendation');
	Route::post('/edit/save','UserController@SaveEditUser')->name('index.edit.save');

	Route::get('/delete/comment/{id}', 'UserController@deleteCommentUser')->name('delete.comment.user');
	Route::get('/delete/favorit/{id}', 'UserController@deleteFavoritUser')->name('delete.favorit.user');
	Route::get('/delete/anime/{id}', 'UserController@deleteAnimeUser')->name('delete.anime.user');
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
	
	Route::get('/data/animes/delete/{id}','AdminController@deleteAnimes')->name('delete.animes');
	Route::post('/data/animes/add','AdminController@addAnimes')->name('add.animes');
	
	Route::get('/data/recommendation/json','AdminController@getRecommendationJson')->name('data.recommendation.json');
	Route::get('/data/recommendation','AdminController@getRecommendation')->name('data.recommendation');
	
	//UPDATE RECOMMENDATION
	Route::get('/data/update/recommendation','AdminController@recommendation')->name('update.recommendation');
	Route::get('/data/mae','AdminController@mae')->name('mae');
	Route::get('/data/proses',function(){
    	return view('admin.proses');
	});
	
});


Route::get('/data123/','AnimeController@getData')->name('get.data');



