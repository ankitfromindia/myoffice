<?php

// --------------------------
// Custom Backpack Routes
// --------------------------
// This route file is loaded automatically by Backpack\Base.
// Routes you generate using Backpack\Generators will be placed here.

Route::group([
    'prefix'     => config('backpack.base.route_prefix', 'admin'),
    'middleware' => ['web', config('backpack.base.middleware_key', 'admin')],
    'namespace'  => 'App\Http\Controllers\Admin',
], function () { // custom admin routes
    CRUD::resource('tag', 'TagCrudController');
    CRUD::resource('testcase', 'TestCaseCrudController')->with(function(){
        Route::get('/testcase/import', 'TestCaseCrudController@import')->name('admin.testcase.import');
        Route::post('/testcase/importParse', 'TestCaseCrudController@importParse')->name('admin.testcase.importParse');
        Route::post('/testcase/importProcess', 'TestCaseCrudController@importProcess')->name('admin.testcase.importProcess');
        Route::get('/testcase/importFormatDownload', 'TestCaseCrudController@importFormatDownload')->name('admin.testcase.importFormatDownload');
        //Route::get('/testcase/bulkEdit', 'TestCaseCrudController@bulkEdit')->name('admin.testcase.bulkEdit');
        CRUD::resource('/testcase/bulkUpdate', 'BulkUpdateCrudController')->with(function(){
            Route::post('/testcase/bulkUpdate/bulk-clone', 'BulkUpdateCrudController@bulkClone');
            Route::post('/testcase/bulkUpdate/bulk-delete', 'BulkUpdateCrudController@bulkDelete');
        });
        
    });

    CRUD::resource('module', 'ModuleCrudController')->with(function(){
        Route::get('/module/getMyModules', 'ModuleCrudController@getMyModules')->name('admin.module.myModule');
    });
    
    Route::group(['middleware' => \App\Http\Middleware\Restricted::class], function(){
        CRUD::resource('permission', 'PermissionCrudController');
        CRUD::resource('role', 'RoleCrudController');
        CRUD::resource('user', 'UserCrudController');
    });
    
    
}); // this should be the absolute last line of this file