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

Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath', 'ipAddressChecked']], function() {
    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/about-us', 'HomeController@aboutUs')->name('about-us');
    Route::get('/contact-us', 'HomeController@contactUs')->name('contact-us');
    Route::post('/send-contact', 'HomeController@sendContact')->name('send-contact');
    Route::post('/send-collaborate', 'HomeController@sendCollaborate')->name('send-collaborate');
    Route::post('/send-feedback', 'HomeController@sendFeedback')->name('send-feedback');
    Route::get('/team', 'HomeController@team')->name('team');
    Route::get('/services', 'HomeController@services')->name('services');
    Route::get('/service/{service}', 'HomeController@service')->name('service');
    Route::get('/blogs', 'HomeController@blogs')->name('blogs');
    Route::get('/blog/{blog}', 'HomeController@blog')->name('blog');
    Route::get('/portfolio', 'HomeController@portfolio')->name('portfolio');

    Auth::routes();
});

Route::namespace('BackEnd')->prefix('admin')->middleware('auth')->group(function() {
    Route::get('/dashboard', 'DashboardController@index')->name('backend.dashboard');
    Route::resource('/about', 'AboutController');
    Route::resource('/blogs', 'BlogController');
    Route::resource('/clients', 'ClientsController');
    Route::resource('/contacts', 'ContactController');
    Route::resource('/contact_us', 'ContactUsController');
    Route::resource('/feedbacks', 'FeedbackController');
    Route::resource('/projects', 'ProjectsController');
    Route::resource('/services', 'ServicesController');
    Route::resource('/sliders', 'SlidersController');
    Route::resource('/teams', 'TeamsController');
    Route::resource('/projects', 'ProjectsController');
    Route::resource('/banner_images', 'BannerImagesController');
    Route::resource('/main', 'MainController');
    Route::resource('/about_us_page', 'AboutUsPageController');
    Route::resource('/services_page', 'ServicesPageController');
});

Auth::routes();
