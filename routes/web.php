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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('/', function () {
        return view('dashboard');
    });

    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');

    Route::get('/news', 'NewsController@index')->name('news');
    Route::get('/news/listuser', 'NewsController@listNews')->name('list.news');
    Route::get('/news/add', 'NewsController@add')->name('news.add');
    Route::post('/news/store', 'NewsController@store')->name('news.store');
    Route::get('/news/edit/{id}', 'NewsController@edit')->name('news.edit');
    Route::put('/news/update/{id}', 'NewsController@update')->name('news.update');
    Route::get('/news/delete/{id}', 'NewsController@delete')->name('news.delete');

    Route::get('/category', 'CategoryController@index')->name('category');
    Route::get('/category/listcategory', 'CategoryController@listCategory')->name('list.category');
    Route::get('/category/add', 'CategoryController@add')->name('category.add');
    Route::post('/category/store', 'CategoryController@store')->name('category.store');
    Route::get('/category/edit/{id}', 'CategoryController@edit')->name('category.edit');
    Route::put('/category/update/{id}', 'CategoryController@update')->name('category.update');
    Route::get('/category/delete/{id}', 'CategoryController@delete')->name('category.delete');

    Route::get('/tag', 'TagController@index')->name('tag');
    Route::get('/tag/listtag', 'TagController@listTag')->name('list.tag');
    Route::get('/tag/add', 'TagController@add')->name('tag.add');
    Route::post('/tag/store', 'TagController@store')->name('tag.store');
    Route::get('/tag/edit/{id}', 'TagController@edit')->name('tag.edit');
    Route::put('/tag/update/{id}', 'TagController@update')->name('tag.update');
    Route::get('/tag/delete/{id}', 'TagController@delete')->name('tag.delete');

    Route::get('/trendingtag', 'TrendingTagController@index')->name('trendingtag');
    Route::get('/trendingtag/listtrendingtag', 'TrendingTagController@listTrendingTag')->name('list.trendingtag');
    Route::get('/trendingtag/add', 'TrendingTagController@add')->name('trendingtag.add');
    Route::post('/trendingtag/store', 'TrendingTagController@store')->name('trendingtag.store');
    Route::get('/trendingtag/edit/{id}', 'TrendingTagController@edit')->name('trendingtag.edit');
    Route::put('/trendingtag/update/{id}', 'TrendingTagController@update')->name('trendingtag.update');
    Route::get('/trendingtag/delete/{id}', 'TrendingTagController@delete')->name('trendingtag.delete');

    Route::get('/headline', 'HeadlineController@index')->name('headline');
    Route::get('/headline/listheadline', 'HeadlineController@listHeadline')->name('list.headline');
    Route::get('/headline/add', 'HeadlineController@add')->name('headline.add');
    Route::post('/headline/store', 'HeadlineController@store')->name('headline.store');
    Route::get('/headline/edit/{id}', 'HeadlineController@edit')->name('headline.edit');
    Route::put('/headline/update/{id}', 'HeadlineController@update')->name('headline.update');
    Route::get('/headline/delete/{id}', 'HeadlineController@delete')->name('headline.delete');

    Route::get('/recommended', 'RecommendedController@index')->name('recommended');
    Route::get('/recommended/listrecommended', 'RecommendedController@listRecommended')->name('list.recommended');
    Route::get('/recommended/add', 'RecommendedController@add')->name('recommended.add');
    Route::post('/recommended/store', 'RecommendedController@store')->name('recommended.store');
    Route::get('/recommended/edit/{id}', 'RecommendedController@edit')->name('recommended.edit');
    Route::put('/recommended/update/{id}', 'RecommendedController@update')->name('recommended.update');
    Route::get('/recommended/delete/{id}', 'RecommendedController@delete')->name('recommended.delete');

    Route::get('/breakingnews', 'BreakingNewsController@index')->name('breakingnews');
    Route::get('/breakingnews/listbreakingnews', 'BreakingNewsController@listBreakingNews')->name('list.breakingnews');
    Route::get('/breakingnews/add', 'BreakingNewsController@add')->name('breakingnews.add');
    Route::post('/breakingnews/store', 'BreakingNewsController@store')->name('breakingnews.store');
    Route::get('/breakingnews/edit/{id}', 'BreakingNewsController@edit')->name('breakingnews.edit');
    Route::put('/breakingnews/update/{id}', 'BreakingNewsController@update')->name('breakingnews.update');
    Route::get('/breakingnews/delete/{id}', 'BreakingNewsController@delete')->name('breakingnews.delete');

    Route::get('/contactus', 'ContactUsController@index')->name('contactus');
    Route::get('/contactus/listcontactus', 'ContactUsController@listContactUs')->name('list.contactus');

    Route::get('/newsletter', 'NewsletterController@index')->name('newsletter');
    Route::get('/newsletter/listnewsletter', 'NewsletterController@listnewsletter')->name('list.newsletter');

    Route::get('/user', 'UserController@index')->name('user');
    Route::get('/user/listuser', 'UserController@listUser')->name('list.user');
    Route::get('/user/add', 'UserController@add')->name('user.add');
    Route::post('/user/store', 'UserController@store')->name('user.store');
    Route::get('/user/edit/{id}', 'UserController@edit')->name('user.edit');
    Route::put('/user/update/{id}', 'UserController@update')->name('user.update');
    Route::get('/user/delete/{id}', 'UserController@delete')->name('user.delete');

    Route::get('/group', 'GroupController@index')->name('group');
    Route::get('/group/listgroup', 'GroupController@listGroup')->name('list.group');
    Route::get('/group/add', 'GroupController@add')->name('group.add');
    Route::post('/group/store', 'GroupController@store')->name('group.store');
    Route::get('/group/edit/{id}', 'GroupController@edit')->name('group.edit');
    Route::put('/group/update/{id}', 'GroupController@update')->name('group.update');
    Route::get('/group/delete/{id}', 'GroupController@delete')->name('group.delete');
});
