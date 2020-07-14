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


use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/',[
    'uses' => 'FrontEndController@index',
    'as' => 'homePage'
]
);

Route::get('/post/{slug}',[
    'uses' => 'FrontEndController@singlePost',
    'as' => 'post.single'
]
);

Route::get('/category/{id}',[
    'uses' => 'FrontEndController@category',
    'as' => 'category'
]
);

Route::get('/tag/{id}',[
    'uses' => 'FrontEndController@tag',
    'as' => 'tag.single'
]
);

Route::get('/results' , function(){
    $post = \App\Post::where('title' , 'like' , '%'. request('query'). '%')->get();

    return view('results')->with('posts', $post)
    ->with('title', 'search result for :' .request('query'))
    ->with('setting' , \App\Setting::first())
    ->with('categories' , \App\Category::take(5)->get())
    ->with('query', request('query'));
});

Auth::routes();


Route::group(['prefix'=>'admin' , 'middleware'=>'auth'], function(){

    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/post/create',[
    'uses' => 'PostController@create',
    'as' => 'post.create'
    ]);

    Route::get('/post',[
        'uses' => 'PostController@index',
        'as' => 'post.index'
        ]);

    Route::get('/post/trashed',[
        'uses' => 'PostController@trashed',
        'as' => 'post.trashed'
            ]);

    Route::get('/post/kill/{id}',[
        'uses' => 'PostController@kill',
        'as' => 'post.kill'
                    ]);
        
    Route::get('/post/restore/{id}',[
    'uses' => 'PostController@restore',
    'as' => 'post.restore'
    ]);

    Route::get('/post/edit/{id}',[
        'uses' => 'PostController@edit',
        'as' => 'post.edit'
        ]);

        Route::post('/post/update/{id}',[
            'uses' => 'PostController@update',
            'as' => 'post.update'
            ]);

    Route::post('/post/store',[
    'uses' => 'PostController@store',
    'as' => 'post.store'
    ]);

    Route::get('/post/delete/{id}',[
        'uses' => 'PostController@destroy',
        'as' => 'post.delete'
        ]);

    Route::get('/category/create',[
        'uses' => 'categoriesController@create',
        'as' => 'category.create'
        ]);

        Route::get('/categories',[
            'uses' => 'categoriesController@index',
            'as' => 'category.index'
            ]);

    Route::post('/category/store',[
    'uses' => 'categoriesController@store',
    'as' => 'category.store'
    ]);

    Route::get('/category/edit/{id}',[
        'uses' => 'categoriesController@edit',
        'as' => 'category.edit'
        ]);

    Route::get('/category/delete/{id}',[
        'uses' => 'categoriesController@destroy',
        'as' => 'category.delete'
     ]);

     Route::post('/category/update/{id}',[
        'uses' => 'categoriesController@update',
        'as' => 'category.update'
     ]);

     Route::get('/tags',[
        'uses' => 'TagsController@index',
        'as' => 'tag.index'
     ]);
    
     Route::get('/tags/create',[
        'uses' => 'TagsController@create',
        'as' => 'tag.create'
     ]);

     Route::post('/tags/store',[
        'uses' => 'TagsController@store',
        'as' => 'tag.store'
     ]);

     Route::get('/tags/edit/{id}',[
        'uses' => 'TagsController@edit',
        'as' => 'tag.edit'
     ]);

     Route::post('/tags/update/{id}',[
        'uses' => 'TagsController@update',
        'as' => 'tag.update'
     ]);

     Route::get('/tags/delete/{id}',[
        'uses' => 'TagsController@destroy',
        'as' => 'tag.delete'
     ]);

     Route::get('/users',[
         'uses' => 'UsersController@index',
         'as' => 'users' 
     ]);

     Route::get('/users/create',[
        'uses' => 'UsersController@create',
        'as' => 'user.create' 
    ]);

    Route::post('/users/store',[
        'uses' => 'UsersController@store',
        'as' => 'user.store' 
    ]);

    Route::get('/users/admin/{id}',[
        'uses' => 'UsersController@admin',
        'as' => 'user.admin' 
    ]);

    Route::get('/users/Nadmin/{id}',[
        'uses' => 'UsersController@Notadmin',
        'as' => 'user.Nadmin' 
    ]);

    Route::get('/users/profiles',[
        'uses' => 'ProfilesController@index',
        'as' => 'user.profile' 
    ]);

    Route::get('/users/delete/{id}',[
        'uses' => 'UsersController@destroy',
        'as' => 'user.delete' 
    ]);

    Route::post('/users/profile/update',[
        'uses' => 'ProfilesController@update',
        'as' => 'profile.update' 
    ]);

    Route::get('/settings',[
        'uses' => 'SettingsController@index',
        'as' => 'settings' 
    ]);

    Route::post('/settings/update',[
        'uses' => 'SettingsController@update',
        'as' => 'setting.update' 
    ]);

});


