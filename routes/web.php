<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\User\UserController;
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

Route::get('/', function () {
    return view('frontend.home');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('user.home');

//User Route

Route::group(['prefix'=>'user'],function(){

        Route::post('/update',[UserController::class,'UserUpdate'])->name('user.update');
        Route::get('/image',[UserController::class,'userImage'])->name('user.image');
        Route::post('/image',[UserController::class,'UserImageUpdate'])->name('user.ImageUpdate');
        Route::get('/password',[UserController::class,'UserPassword'])->name('user.password');
        Route::post('/password',[UserController::class,'userPasswordUpdate'])->name('update.password');
});
//user route end

//admin route start

Route::group(['prefix'=>'/admin','middleware'=>'admin'],function(){

    Route::get('/home',[AdminController::class,'index'])->name('admin.home');

    //admin profile route start
    Route::get('/profile',[AdminController::class,'ProfileHome'])->name('profile');
    Route::post('/profile',[AdminController::class,'updateProfile']);
    Route::get('/profileImage',[AdminController::class,'showImage'])->name('admin.image');
    Route::post('/profileImage',[AdminController::class,'updateImage']);
    Route::get('/password',[AdminController::class,'showPassword'])->name('admin.password');
    Route::post('/password',[AdminController::class,'updatePassword'])->name('password.update');
    //admin profile route end

    //category route start
    Route::get('/category',[CategoryController::class,'index'])->name('category');
    Route::post('/category',[CategoryController::class,'store'])->name('category.store');
    Route::get('/category-edit/{category_id}',[CategoryController::class,'categoryEdit'])->name('category.edit');
    Route::post('/category-edit/{category_id}',[CategoryController::class,'categoryUpdate'])->name('category.update');
    route::get('/category-delete/{category_id}',[CategoryController::class,'categoryDelete'])->name('category.delete');
    //category route end

    //sub category route start
    Route::get('/sub-category',[CategoryController::class,'subIndex'])->name('sub-category');
    Route::post('/sub-category',[CategoryController::class,'subCategoryStore'])->name('sub.store');
    Route::get('/sub-category/edit/{cat_id}',[CategoryController::class,'subCategoryEdit'])->name('sub.edit');
    Route::post('/sub-category/edit/{cat_id}',[CategoryController::class,'subCategoryUpdate'])->name('sub.update');
    Route::get('/sub-category/delete/{cat_id}',[CategoryController::class,'subCategoryDelete'])->name('sub.delete');
    //sub category route end

  //sub-sub-category route start
     Route::get('/sub-sub-category',[CategoryController::class,'subSubIndex'])->name('sub-sub-category');
     Route::get('/subcategory/ajax/{cat_id}',[CategoryController::class,'getSubCat']);
     Route::post('/subsub-category',[CategoryController::class,'subsubCategoryStore'])->name('subsub.store');
     Route::get('/sub-subcategory/edit/{subsubcat_id}',[CategoryController::class,'subSubCategoryEdit'])->name('subsub.edit');
     Route::post('/sub-subcategory/update/{subsubcat_id}',[CategoryController::class,'subSubCategoryUpdate'])->name('subsub.update');
     Route::get('/sub-subcategory/delete/{subsubcat_id}',[CategoryController::class,'subSubCategoryDelete'])->name('subsub.delete');
  //sub-sub-category route end

  //product route

  Route::get('/add-products',[ProductController::class,'addProduct'])->name('add.products');
  Route::post('/add-products',[ProductController::class,'storeProduct'])->name('store.products');
  Route::get('/subsubcategory/ajax/{subcat_id}',[ProductController::class,'getSubSubCat']);
    
});

//admin route end

