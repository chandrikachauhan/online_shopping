<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\loginController;
use App\Http\Controllers\admin\adminController;
use App\Http\Controllers\admin\categoriesController;
use App\Http\Controllers\admin\subcategoriesController;
use App\Http\Controllers\admin\brandControllers;
use App\Http\Controllers\admin\productController;
use App\Http\Controllers\admin\productSubcategoriesController;
use App\Http\Controllers\front\homeController;
use App\Http\Controllers\front\shopController;



//front of site route
route::get('/',[homeController::class,'index'])->name('home.index');
route::get('/shop/{categorySlug?}/{subcategorySlug?}',[shopController::class,'index'])->name('shop.index');
route::get('/single/{slug}',[shopController::class,'product_front'])->name('shop.product');
// admin login route
route::get('/admin',[loginController::class,'index'])->name('admin.login');
route::post('/admincreate',[loginController::class,'create'])->name('admin.create');
route::get('/adminlogout',[loginController::class,'logout'])->name('admin.logout');
route::group(['middleware' => 'admin'],function(){
    route::get('/dashboard',[adminController::class,'index'])->name('admin.dashboard');
    // admin categories route
    route::get('/admin/categories',[categoriesController::class,'index'])->name('categories');
    route::post('/admin/categories/create',[categoriesController::class,'create'])->name('categories.create');
    route::get('/categories/update/{id}',[categoriesController::class,'update']);
    route::post('/categories/store',[categoriesController::class,'store']);
    route::get('/admin/categories/delete/{id}',[categoriesController::class,'delete']);
    //create subCategories route
    route::get('/subcategories',[subcategoriesController::class,'index'])->name('subcategories');
    route::post('/subcategories/create',[subcategoriesController::class,'create'])->name('subcategories.create');
    route::post('/subcategories/store',[subcategoriesController::class,'store']);
    route::get('/subcategories/delete/{id}',[subcategoriesController::class,'delete']);
    route::get('/subcategories/update/{id}',[subcategoriesController::class,'update']);
    // create brand route
    route::get('/brand',[brandControllers::class,'index'])->name('brand');
    route::post('/brand/create',[brandControllers::class,'create'])->name('brand.create');
    route::get('/brand/delete/{id}',[brandControllers::class,'delete']);
    route::get('/brand/update/{id}',[brandControllers::class,'update']);
    route::post('/brand/store',[brandControllers::class,'store']);
    // create product route
    route::get('/productsubcate',[productSubcategoriesController::class,'index']);
    route::get('/product/create',[productController::class,'create'])->name('product.create');
    route::post('/product/store',[productController::class,'store']);
    route::get('/product',[productController::class,'index'])->name('all.product');
    route::get('/product/delete/{id}',[productController::class,'delete']);
    route::get('/product/update/{id}',[productController::class,'update']);
    route::post('/product/finalUpdate',[productController::class,'finalUpdate']);
    
});