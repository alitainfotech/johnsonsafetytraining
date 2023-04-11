<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;


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

Route::get(
    'cache-clear',
    function () {
        Artisan::call('cache:clear');
        Artisan::call('view:clear');
        Artisan::call('route:clear');
        Artisan::call('clear-compiled');
        Artisan::call('config:clear');
        Artisan::call('optimize:clear');
        // Artisan::call('db:wipe');
        // Artisan::call('migrate:fresh --seed');
        return 'cleared';
    }
);

Route::get(
    'db-wipe',
    function () {
        Artisan::call('db:wipe');
        return 'cleared';
    }
);

Route::get(
    'migrate-seed',
    function () {
        Artisan::call('migrate:fresh --seed');
        return 'cleared';
    }
);

Route::namespace('App\Http\Controllers\Admin')->group(function () {
    Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
        Route::group(['middleware' => ['guest']], function () {
            Route::get('/', function () {
                return redirect(route('admin.login'));
            });
        });

        Route::namespace('Auth')->group(function () {
            Route::group(['middleware' => ['guest']], function () {
                Route::get('login', 'AuthController@login')->name('login');
            });
            Route::post('verify-login', 'AuthController@verifyLogin')->name('verify-login');
            Route::get('forgot-password', 'AuthController@forgotPassword')->name('forgot-password');
            Route::post('send-reset-password-link', 'AuthController@sendResetPasswordLink')->name('send-reset-password-link');
            Route::get('reset-password/{token}', 'AuthController@resetPassword')->name('reset-password');
            Route::post('reset-new-password', 'AuthController@resetNewPassword')->name('reset-new-password');
        });

        Route::group(['middleware' => ['auth']], function () {
            Route::get('dashboard', 'DashboardController@index')->name('dashboard');
            // Categories
            Route::post('categories-ajaxIndex', 'CategoryController@ajaxIndex')->name('categories.ajaxIndex');
            Route::resource('categories', 'CategoryController');
            // Products
            Route::post('products-ajaxIndex', 'ProductController@ajaxIndex')->name('products.ajaxIndex');
            Route::delete('delete-image/{image}', 'ProductController@deleteImage')->name('products.deleteImage');
            Route::get('products-avilabledate/{course}', 'ProductController@avilabledate')->name('products.avilabledate');
            Route::post('products-avilabledatestore', 'ProductController@avilabledatestore')->name('products.avilabledatestore');
            Route::get('products-materialshow/{product}', 'ProductController@materialshow')->name('products.materialshow');

            // Route::get('products-studentcourse', 'ProductController@studentcourse')->name('products.studentcourse');
            // Route::get('products-studentmaterial/{key}', 'ProductController@studentmaterial')->name('products.studentmaterial');

            Route::delete('delete-material/{material}', 'ProductController@deletematerial')->name('products.deletematerial');
            Route::post('products-addmaterial/{product}', 'ProductController@addmaterial')->name('products.addmaterial');
            Route::resource('products', 'ProductController');
            // Users
            Route::post('users-password-update', 'UserController@passwordUpdate')->name('users.password.update');
            Route::post('users-profile-update', 'UserController@profileUpdate')->name('users.profile.update');
            Route::get('users-profile', 'UserController@profile')->name('users.profile');
            Route::resource('users', 'UserController');
            //payments
            Route::post('payments-ajaxIndex', 'PaymentController@ajaxIndex')->name('payments.ajaxIndex');
            Route::resource('payments', 'PaymentController');
            // Calendar
            Route::get('calendars-ajaxIndex', 'CalendarController@ajaxIndex')->name('calendars.ajaxIndex');
            Route::get('calendars-ajaxPrevious', 'CalendarController@ajaxPrevious')->name('calendars.ajaxPrevious');
            Route::get('calendars-ajaxNext', 'CalendarController@ajaxNext')->name('calendars.ajaxNext');
            Route::post('calendars-filterCourse', 'CalendarController@filterCourse')->name('calendars.filterCourse');
            Route::post('calendars-ajaxCheckbox', 'CalendarController@ajaxCheckbox')->name('calendars.ajaxCheckbox');
            Route::post('calendars-ajaxCalendar', 'CalendarController@ajaxCalendar')->name('calendars.ajaxCalendar');
            Route::get('calendars-ajaxCalendarLinkGenerate', 'CalendarController@ajaxCalendarLinkGenerate')->name('calendars.ajaxCalendarLinkGenerate');
            Route::match(['get', 'post'], 'calendars-ajaxCalendarExport', 'CalendarController@ajaxCalendarExport')->name('calendars.ajaxCalendarExport');
            Route::resource('calendars', 'CalendarController');

            //Booking
            Route::post('booking-ajaxIndex', 'BookingController@ajaxIndex')->name('booking.ajaxIndex');
            Route::post('booking-ajaxCourses', 'BookingController@ajaxCourses')->name('booking.ajaxCourses');
            Route::post('booking-ajaxReschedule', 'BookingController@ajaxReschedule')->name('booking.ajaxReschedule');
            
            Route::resource('booking', 'BookingController');
            // Auth
            Route::get('logout', 'Auth\AuthController@logout')->name('logout');
        });
    });
});

//user Routes
Route::namespace('App\Http\Controllers')->group(function () {
    // Login Route
    // Route::group(['middleware' => ['guest']], function () {
        Route::get('login', 'Admin\Auth\AuthController@login')->name('user.login');
    // });
    Route::group(['middleware' => ['user_auth']], function () {
        // Route::get('dashboard', 'Admin\DashboardController@index')->name('user.dashboard');
        Route::get('user/products-studentcourse', 'Admin\ProductController@studentcourse')->name('user.products.studentcourse');
        Route::get('user/products-studentmaterial/{key}', 'Admin\ProductController@studentmaterial')->name('user.products.studentmaterial');
        Route::group(['prefix' => 'user', 'as' => 'user.'], function () {
            Route::resource('booking', 'Admin\BookingController');
        });

    });
    //category routes
    Route::resource('categories', 'CategoryController');
    // cart routes
    // Route::resource('carts', 'cartController');
    Route::get('/index', 'cartController@index')->name('carts.index');
    Route::get('add-to-cart/{product}/{avilableId}', 'cartController@create')->name('carts.create');
    Route::patch('update-cart', 'cartController@update')->name('carts.update');
    Route::delete('remove-from-cart', 'cartController@destroy')->name('carts.delete');

    //product routes
    Route::resource('products', 'ProductController')->except('show');
    Route::get('courses/{product:slug}', 'ProductController@show')->name('courses.show');
    Route::get('products-showCourseByCategory/{category:slug}', 'ProductController@showCourseByCategory')->name('products.showCourseByCategory');

    Route::controller(UserController::class)->group(function () {
        Route::get('enrolment/{user_id}/{order_id}', 'enrolmentForm')->name('user.enrolment');
        Route::post('enrolment', 'enrolmentSave')->name('user.enrollment.save');
        
    });
    
    //stripe routes
    Route::controller(StripePaymentController::class)->group(function () {
        Route::get('stripe', 'stripe');
        Route::post('stripe', 'stripePost')->name('stripe.payment');
    });
});


//student Routes
// Route::namespace('App\Http\Controllers\Student')->group(function () {
//     Route::group(['prefix' => 'student', 'as' => 'student.'], function () {
//         Route::resource('changepassword', 'changedpasswordController');
//     });
// });

Route::get('/', function () {
    return view('user.home');
})->name('home');

Route::get('session', function () {
    dd(session()->all());
});