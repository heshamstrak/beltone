<?php

Route::middleware([
    // 'localeSessionRedirect',
    // 'localizationRedirect',
    // 'localeViewPath',
    'auth',
    'role:admin|super_admin',
])
    ->group(function () {

        Route::name('admin.')->prefix('admin')->group(function () {

            //home
            Route::get('/home/top_statistics', 'HomeController@topStatistics')->name('home.top_statistics');
            Route::get('/home/movies_chart', 'HomeController@moviesChart')->name('home.movies_chart');
            Route::get('/home', 'HomeController@index')->name('home');

            //role routes
            Route::get('/roles/data', 'RoleController@data')->name('roles.data');
            Route::delete('/roles/bulk_delete', 'RoleController@bulkDelete')->name('roles.bulk_delete');
            Route::resource('roles', 'RoleController');

            //admin routes
            Route::get('/admins/data', 'AdminController@data')->name('admins.data');
            Route::delete('/admins/bulk_delete', 'AdminController@bulkDelete')->name('admins.bulk_delete');
            Route::resource('admins', 'AdminController');

            //user routes
            Route::get('/users/data', 'UserController@data')->name('users.data');
            Route::delete('/users/bulk_delete', 'UserController@bulkDelete')->name('users.bulk_delete');
            Route::resource('users', 'UserController');

            //About routes
            Route::get('/abouts/data', 'AboutController@data')->name('abouts.data');
            Route::delete('/abouts/bulk_delete', 'AboutController@bulkDelete')->name('abouts.bulk_delete');
            Route::resource('abouts', 'AboutController');

            //Slide routes
            Route::get('/slides/data', 'SlideController@data')->name('slides.data');
            Route::delete('/slides/bulk_delete', 'SlideController@bulkDelete')->name('slides.bulk_delete');
            Route::resource('slides', 'SlideController');

            //Blog routes
            Route::get('/blogs/data', 'BlogController@data')->name('blogs.data');
            Route::delete('/blogs/bulk_delete', 'BlogController@bulkDelete')->name('blogs.bulk_delete');
            Route::resource('blogs', 'BlogController');

            //Careers routes
            Route::get('/careers/data', 'CareerController@data')->name('careers.data');
            Route::delete('/careers/bulk_delete', 'CareerController@bulkDelete')->name('careers.bulk_delete');
            Route::resource('careers', 'CareerController');

            //Teams routes
            Route::get('/teams/data', 'TeamController@data')->name('teams.data');
            Route::delete('/teams/bulk_delete', 'TeamController@bulkDelete')->name('teams.bulk_delete');
            Route::resource('teams', 'TeamController');

            //Cateogory routes
            Route::get('/categories/data', 'CategoryController@data')->name('categories.data');
            Route::delete('/categories/bulk_delete', 'CategoryController@bulkDelete')->name('categories.bulk_delete');
            Route::resource('categories', 'CategoryController');

            //Products routes
            Route::get('/products/data', 'ProductController@data')->name('products.data');
            Route::delete('/products/bulk_delete', 'ProductController@bulkDelete')->name('products.bulk_delete');
            Route::resource('products', 'ProductController');

            //Service routes
            Route::get('/services/data', 'ServiceController@data')->name('services.data');
            Route::delete('/services/bulk_delete', 'ServiceController@bulkDelete')->name('services.bulk_delete');
            Route::resource('services', 'ServiceController');

            //Press routes
            Route::get('/presses/data', 'PressController@data')->name('presses.data');
            Route::delete('/presses/bulk_delete', 'PressController@bulkDelete')->name('presses.bulk_delete');
            Route::resource('presses', 'PressController');
            Route::get('/presses/upload-image', 'PressController@upload')->name('presses.upload.image');

            //Pages routes
            Route::get('/pages/data', 'PageController@data')->name('pages.data');
            Route::delete('/pages/bulk_delete', 'PageController@bulkDelete')->name('pages.bulk_delete');
            Route::resource('pages', 'PageController');


            //Contact Us routes
            Route::get('/contacts/data', 'ContactController@data')->name('contacts.data');
            Route::delete('/contacts/bulk_delete', 'ContactController@bulkDelete')->name('contacts.bulk_delete');
            Route::get('/contacts/{contact}', 'ContactController@reply')->name('contacts.reply');
            Route::post('/contacts/{contact}', 'ContactController@store_reply')->name('contacts.reply.store');
            Route::resource('contacts', 'ContactController');

            //setting routes
            Route::get('/settings/general', 'SettingController@general')->name('settings.general');
            // Route::get('/settings/social_links', 'SettingController@socialLinks')->name('settings.social_links');
            // Route::get('/settings/mobile_links', 'SettingController@mobileLinks')->name('settings.mobile_links');
            Route::resource('settings', 'SettingController')->only(['store']);

            //profile routes
            Route::get('/profile/edit', 'ProfileController@edit')->name('profile.edit');
            Route::put('/profile/update', 'ProfileController@update')->name('profile.update');

            Route::name('profile.')->namespace('Profile')->group(function () {

                //password routes
                Route::get('/password/edit', 'PasswordController@edit')->name('password.edit');
                Route::put('/password/update', 'PasswordController@update')->name('password.update');

            });

        });

    });
