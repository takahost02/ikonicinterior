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

use Modules\LandingPage\Http\Controllers\CustomPageController;
use Modules\LandingPage\Http\Controllers\DiscoverController;
use Modules\LandingPage\Http\Controllers\FaqController;
use Modules\LandingPage\Http\Controllers\FeaturesController;
use Modules\LandingPage\Http\Controllers\HomeController;
use Modules\LandingPage\Http\Controllers\JoinUsController;
use Modules\LandingPage\Http\Controllers\LandingPageController;
use Modules\LandingPage\Http\Controllers\ScreenshotsController;
use Modules\LandingPage\Http\Controllers\TestimonialsController;

Route::resource('landingpage', LandingPageController::class)->middleware(['auth', 'XSS']);
// Route::get('landingpage/', 'LandingPageController@index')->name('landingpage.index');


Route::resource('custom_page', CustomPageController::class)->middleware(['auth', 'XSS']);
Route::post('custom_store/', 'CustomPageController@customStore')->name('custom_store');
Route::get('pages/{slug}', 'CustomPageController@customPage')->name('custom.page');



Route::resource('homesection', HomeController::class)->middleware(['auth', 'XSS']);
// Route::get('homesection/', 'HomeController@index')->name('homesection.index');


Route::resource('features', FeaturesController::class)->middleware(['auth', 'XSS']);

Route::get('feature/create/', 'FeaturesController@feature_create')->name('feature_create');
Route::post('feature/store/', 'FeaturesController@feature_store')->name('feature_store');
Route::get('feature/edit/{key}', 'FeaturesController@feature_edit')->name('feature_edit');
Route::post('feature/update/{key}', 'FeaturesController@feature_update')->name('feature_update');
Route::get('feature/delete/{key}', 'FeaturesController@feature_delete')->name('feature_delete');

Route::post('feature_highlight_create/', 'FeaturesController@feature_highlight_create')->name('feature_highlight_create');

Route::get('features/create/', 'FeaturesController@features_create')->name('features_create');
Route::post('features/store/', 'FeaturesController@features_store')->name('features_store');
Route::get('features/edit/{key}', 'FeaturesController@features_edit')->name('features_edit');
Route::post('features/update/{key}', 'FeaturesController@features_update')->name('features_update');
Route::get('features/delete/{key}', 'FeaturesController@features_delete')->name('features_delete');



Route::resource('discover', DiscoverController::class)->middleware(['auth', 'XSS']);
Route::get('discover/create/', 'DiscoverController@discover_create')->name('discover_create');
Route::post('discover/store/', 'DiscoverController@discover_store')->name('discover_store');
Route::get('discover/edit/{key}', 'DiscoverController@discover_edit')->name('discover_edit');
Route::post('discover/update/{key}', 'DiscoverController@discover_update')->name('discover_update');
Route::get('discover/delete/{key}', 'DiscoverController@discover_delete')->name('discover_delete');



Route::resource('screenshots', ScreenshotsController::class)->middleware(['auth', 'XSS']);
Route::get('screenshots/create/', 'ScreenshotsController@screenshots_create')->name('screenshots_create');
Route::post('screenshots/store/', 'ScreenshotsController@screenshots_store')->name('screenshots_store');
Route::get('screenshots/edit/{key}', 'ScreenshotsController@screenshots_edit')->name('screenshots_edit');
Route::post('screenshots/update/{key}', 'ScreenshotsController@screenshots_update')->name('screenshots_update');
Route::get('screenshots/delete/{key}', 'ScreenshotsController@screenshots_delete')->name('screenshots_delete');




Route::resource('faq', FaqController::class)->middleware(['auth', 'XSS']);
Route::get('faq/create/', 'FaqController@faq_create')->name('faq_create');
Route::post('faq/store/', 'FaqController@faq_store')->name('faq_store');
Route::get('faq/edit/{key}', 'FaqController@faq_edit')->name('faq_edit');
Route::post('faq/update/{key}', 'FaqController@faq_update')->name('faq_update');
Route::get('faq/delete/{key}', 'FaqController@faq_delete')->name('faq_delete');


Route::resource('testimonials', TestimonialsController::class)->middleware(['auth', 'XSS']);
Route::get('testimonials/create/', 'TestimonialsController@testimonials_create')->name('testimonials_create');
Route::post('testimonials/store/', 'TestimonialsController@testimonials_store')->name('testimonials_store');
Route::get('testimonials/edit/{key}', 'TestimonialsController@testimonials_edit')->name('testimonials_edit');
Route::post('testimonials/update/{key}', 'TestimonialsController@testimonials_update')->name('testimonials_update');
Route::get('testimonials/delete/{key}', 'TestimonialsController@testimonials_delete')->name('testimonials_delete');


Route::resource('join_us', JoinUsController::class)->middleware(['auth', 'XSS']);
Route::post('join_us/store/', 'JoinUsController@joinUsUserStore')->name('join_us_store');

// Route::get('footer/', 'FooterController@index')->name('footer.index');