<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Backend\team\teamController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Backend\Blog\blogcategoryController;
// use Illuminate\Support\Facades\App;
use App\Http\Controllers\Backend\subscriber\emailtosubscriberController;

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
    return redirect('admin');
});

Route::group(['prefix' => 'admin', 'as' => 'admin.'], function () {
    Route::get('/', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('admin-main');
    Route::get('/dashboard', [App\Http\Controllers\Backend\DashboardController::class, 'index'])->name('admin-dashboard');

    //PRODUCT-CATEGORY........................................................................................
    Route::get('product/category', [App\Http\Controllers\Backend\Product\CategoryController::class, 'index'])->name('product-category');
    Route::post('/product/category/insert', [App\Http\Controllers\Backend\Product\CategoryController::class, 'save'])->name('category-insert');
    Route::post('/product/category/list', [App\Http\Controllers\Backend\Product\CategoryController::class, 'list'])->name('category-list');
    Route::post('/product/category/delete', [App\Http\Controllers\Backend\Product\CategoryController::class, 'delete'])->name('category-delete');
    Route::post('/product/category/edit', [App\Http\Controllers\Backend\Product\CategoryController::class, 'get_detail'])->name('category-edit');

    // SUBCATEGORY...........................................................................................
    Route::get('product/subcategory', [App\Http\Controllers\Backend\Product\SubcategoryController::class, 'index'])->name('product-subcategory');
    Route::post('product/subcategory/insert', [App\Http\Controllers\Backend\Product\SubcategoryController::class, 'save'])->name('subcategory-insert');
    Route::post('/product/subcategory/list', [App\Http\Controllers\Backend\Product\SubcategoryController::class, 'list'])->name('subcategory-list');
    Route::post('/product/subcategory/delete', [App\Http\Controllers\Backend\Product\SubcategoryController::class, 'delete'])->name('subcategory-delete');
    Route::post('/product/subcategory/edit', [App\Http\Controllers\Backend\Product\SubcategoryController::class, 'get_detail'])->name('subcategory-edit');

    // BLOG CATEGORY...........................................................................................
    Route::get('blog/category', [App\Http\Controllers\Backend\Blog\CategoryController::class, 'index'])->name('blog-category');
    Route::post('blog/category/insert', [App\Http\Controllers\Backend\Blog\CategoryController::class, 'save'])->name('category_insert');
    Route::post('/blog/category/list', [App\Http\Controllers\Backend\Blog\CategoryController::class, 'list'])->name('categorylist');
    Route::post('/blog/category/delete', [App\Http\Controllers\Backend\Blog\CategoryController::class, 'delete'])->name('categoy-delete');
    Route::post('/blog/category/edit', [App\Http\Controllers\Backend\Blog\CategoryController::class, 'get_detail'])->name('categoy-edit');

    // BLOG SUBCATEGORY...........................................................................................
    Route::get('blog/subcategory', [App\Http\Controllers\Backend\Blog\SubcategoryController::class, 'index'])->name('blog-subcategory');
    Route::post('blog/subcategory/insert', [App\Http\Controllers\Backend\Blog\SubcategoryController::class, 'save'])->name('subcategoy-insert');
    Route::post('/blog/subcategory/list', [App\Http\Controllers\Backend\Blog\SubcategoryController::class, 'list'])->name('subcategoy-list');
    Route::post('/blog/subcategory/delete', [App\Http\Controllers\Backend\Blog\SubcategoryController::class, 'delete'])->name('subcategoy-delete');
    Route::post('/blog/subcategory/edit', [App\Http\Controllers\Backend\Blog\SubcategoryController::class, 'get_detail'])->name('subcategoy-edit');

    // Blog......................................................................................................
    Route::get('blog', [App\Http\Controllers\Backend\Blog\BlogController::class, 'index'])->name('blog');
    Route::post('/blog/insert', [App\Http\Controllers\Backend\Blog\BlogController::class, 'save'])->name('blog_insert');
    Route::post('/blog/list', [App\Http\Controllers\Backend\Blog\BlogController::class, 'list'])->name('bloglist');
    Route::post('/blog/delete', [App\Http\Controllers\Backend\Blog\BlogController::class, 'delete'])->name('blog_delete');
    Route::post('/blog/edit', [App\Http\Controllers\Backend\Blog\BlogController::class, 'get_detail'])->name('blog_edit');

    // AllSUBSCRIBER...............................................................................................
    Route::get('subscriber', [App\Http\Controllers\Backend\Subscriber\SubscriberController::class, 'index'])->name('subscriber');
    Route::post('/subscriber/insert', [App\Http\Controllers\Backend\Subscriber\SubscriberController::class, 'save'])->name('subscriber-insert');
    Route::post('/subscriber/list', [App\Http\Controllers\Backend\Subscriber\SubscriberController::class, 'list'])->name('subscriber-list');
    Route::post('/subscriber/delete', [App\Http\Controllers\Backend\Subscriber\SubscriberController::class, 'delete'])->name('/subscriber-delete');
    Route::post('/subscriber/edit', [App\Http\Controllers\Backend\Subscriber\SubscriberController::class, 'get_detail'])->name('/subscriber-edit');
    Route::post('/checkemail', [App\Http\Controllers\Backend\Subscriber\SubscriberController::class, 'checkemail'])->name('/checkemail');

    // TESTIMONIAL...................................................................................................
    Route::get('testimonial', [App\Http\Controllers\Backend\Testimonial\TestimonialController::class, 'index'])->name('testimonial');
    Route::post('/testimonial/list', [App\Http\Controllers\Backend\Testimonial\TestimonialController::class, 'list'])->name('testimonial.list');
    Route::post('/testimonial/insert', [App\Http\Controllers\Backend\Testimonial\TestimonialController::class, 'save'])->name('testimonial.insert');
    Route::post('/testimonial/delete', [App\Http\Controllers\Backend\Testimonial\TestimonialController::class, 'delete'])->name('testimonial.delete');
    Route::post('/testimonial/edit', [App\Http\Controllers\Backend\Testimonial\TestimonialController::class, 'get_detail'])->name('testimonial.edit');

    //Email To Subscriber.....................................................................................
    Route::get('emailtosubscriber', [App\Http\Controllers\Backend\Subscriber\EmailtosubscriberController::class, 'index'])->name('emailto-subscriber');
    Route::post('/getdata', [App\Http\Controllers\Backend\Subscriber\EmailtosubscriberController::class, 'getdata'])->name('getdata');
    // Route::post('/getdata', 'App\Http\Controllers\Backend\subscriber\emailtosubscriberController@getdata')->name('getdata');

    //Team.....................................................................................
    Route::get('team', [App\http\Controllers\Backend\team\TeamController::class, 'index'])->name('team');
    Route::post('team/insert', [App\http\Controllers\Backend\team\TeamController::class, 'save'])->name('team-insert');
    Route::post('/team/list', [App\http\Controllers\Backend\team\TeamController::class, 'list'])->name('team-list');
    Route::post('/team/delete', [App\http\Controllers\Backend\team\TeamController::class, 'delete'])->name('team-delete');
    Route::post('/team/edit', [App\http\Controllers\Backend\team\TeamController::class, 'get_detail'])->name('team-edit');


    //GenralSetting.....................................................................................
    Route::get('setting', [App\Http\Controllers\Backend\setting\Genralsetting\GeneralSettingControllers::class, 'index'])->name('setting');
    Route::post('setting/logo/insert', [App\Http\Controllers\Backend\setting\Genralsetting\GeneralSettingControllers::class, 'logoinsert'])->name('logo-insert');
    Route::post('setting/favicon/insert', [App\Http\Controllers\Backend\setting\Genralsetting\GeneralSettingControllers::class, 'faviconinsert'])->name('favicon-insert');
    Route::post('setting/topbar/insert', [App\Http\Controllers\Backend\setting\Genralsetting\GeneralSettingControllers::class, 'topbarinsert'])->name('topbar-insert');
    Route::post('setting/email', [App\Http\Controllers\Backend\setting\Genralsetting\GeneralSettingControllers::class, 'emailsendinsert'])->name('email-insert');
    Route::post('setting/color_insert', [App\Http\Controllers\Backend\setting\Genralsetting\GeneralSettingControllers::class, 'colorinsert'])->name('color-insert');
    Route::post('/social_media/insert', [App\Http\Controllers\Backend\setting\Genralsetting\GeneralSettingControllers::class, 'social_media_insert'])->name('social_media_insert');

    // SMTP SETTTING.............................................................................................
    Route::get('smtp_settings', [App\Http\Controllers\Backend\Setting\Smtp\SmtpSettiingController::class, 'index'])->name('smtp_settings');
    Route::post('/smtp/insert', [App\Http\Controllers\Backend\Setting\Smtp\SmtpSettiingController::class, 'save'])->name('smtp.insert');
    Route::post('/smtp/mail', [App\Http\Controllers\Backend\Setting\Smtp\SmtpSettiingController::class, 'mail'])->name('smtp.mail');

    // PRODUCT.......................................................................................................
    Route::get('products', [App\Http\Controllers\Backend\product\ProductsController::class, 'index'])->name('products');
    Route::post('/product/insert', [App\Http\Controllers\Backend\product\ProductsController::class, 'save'])->name('product.insert');
    Route::get('/product/list', [App\Http\Controllers\Backend\product\ProductsController::class, 'list'])->name('product.list');
    Route::post('/product/delete', [App\Http\Controllers\Backend\product\ProductsController::class, 'delete'])->name('product.delete');
    Route::post('/product/edit', [App\Http\Controllers\Backend\product\ProductsController::class, 'get_detail'])->name('product.edit');

    // PRODUCT IMAGE..............................................................................................
    Route::post('/product/image/delete', [App\Http\Controllers\Backend\product\ProductsController::class, 'image_delete'])->name('product.image.delete');
    Route::get('/product/image/view/{id}', [App\Http\Controllers\Backend\product\ProductsController::class, 'image_view'])->name('product.image.view');

    // PRODUCT IMAGE LIST..........................................................................................
    Route::post('/product/image/list', [App\Http\Controllers\Backend\product\ProductImageController::class, 'list'])->name('product.image.list');
    Route::post('/product/image/view/delete', [App\Http\Controllers\Backend\product\ProductImageController::class, 'delete'])->name('product.image.view.delete');
    Route::post('/product/image/view/insert', [App\Http\Controllers\Backend\product\ProductImageController::class, 'save'])->name('product.image.view.insert');

    // Portfolio Categories.....................................................................................
    Route::get('portfolio-categories', [App\Http\Controllers\Backend\PortfolioCategories\PortfolioCategoriesController::class, 'index'])->name('portfolioCategories');
    Route::post('/portfolio-categories/insert', [App\Http\Controllers\Backend\PortfolioCategories\PortfolioCategoriesController::class, 'save'])->name('portfolioCategories.insert');
    Route::post('/portfolio-categories/list', [App\Http\Controllers\Backend\PortfolioCategories\PortfolioCategoriesController::class, 'list'])->name('portfolioCategories.list');
    Route::post('/portfolio-categories/delete', [App\Http\Controllers\Backend\PortfolioCategories\PortfolioCategoriesController::class, 'delete'])->name('portfolioCategories.delete');
    Route::post('/portfolio-categories/edit', [App\Http\Controllers\Backend\PortfolioCategories\PortfolioCategoriesController::class, 'get_detail'])->name('portfolioCategories.edit');

    // Portfolio.............................................................................................
    Route::get('portfolio', [App\Http\Controllers\Backend\Portfolio\PortfolioController::class, 'index'])->name('portfolio');
    Route::post('/portfolio/insert', [App\Http\Controllers\Backend\Portfolio\PortfolioController::class, 'save'])->name('portfolio.insert');
    Route::post('/portfolio/list', [App\Http\Controllers\Backend\Portfolio\PortfolioController::class, 'list'])->name('portfolio.list');
    Route::post('/portfolio/delete', [App\Http\Controllers\Backend\Portfolio\PortfolioController::class, 'delete'])->name('portfolio.delete');
    Route::post('/portfolio/edit', [App\Http\Controllers\Backend\Portfolio\PortfolioController::class, 'get_detail'])->name('portfolio.edit');
    Route::post('/portfolio/image/delete', [App\Http\Controllers\Backend\Portfolio\PortfolioController::class, 'image_delete'])->name('portfolio.image.delete');

    // CLIENT ROUTE................................................................................................
    Route::get('client', [App\Http\Controllers\Backend\Client\ClientController::class, 'index'])->name('client');
    Route::post('/client/insert', [App\Http\Controllers\Backend\Client\ClientController::class, 'save'])->name('client-insert');
    Route::post('/client/list', [App\Http\Controllers\Backend\Client\ClientController::class, 'list'])->name('client-list');
    Route::post('/client/delete', [App\Http\Controllers\Backend\Client\ClientController::class, 'delete'])->name('client-delete');
    Route::post('/client/edit', [App\Http\Controllers\Backend\Client\ClientController::class, 'get_detail'])->name('client-edit');

    // FAQ ROUTE........................................................................................
    Route::get('faq', [App\Http\Controllers\Backend\Faq\FaqController::class, 'index'])->name('faq');
    Route::post('/faq/insert', [App\Http\Controllers\Backend\Faq\FaqController::class, 'save'])->name('faq-insert');
    Route::post('/faq/list', [App\Http\Controllers\Backend\Faq\FaqController::class, 'list'])->name('faq-list');
    Route::post('/faq/delete', [App\Http\Controllers\Backend\Faq\FaqController::class, 'delete'])->name('faq-delete');
    Route::post('/faq/edit', [App\Http\Controllers\Backend\Faq\FaqController::class, 'get_detail'])->name('faq-edit');

    // FEATURES...................................................................................................
    Route::get('feature', [App\Http\Controllers\Backend\Feature\FeatureController::class, 'index'])->name('feature');
    Route::post('/feature/insert', [App\Http\Controllers\Backend\Feature\FeatureController::class, 'save'])->name('feature-insert');
    Route::post('/feature/list', [App\Http\Controllers\Backend\Feature\FeatureController::class, 'list'])->name('feature-list');
    Route::post('/feature/delete', [App\Http\Controllers\Backend\Feature\FeatureController::class, 'delete'])->name('feature-delete');
    Route::post('/feature/edit', [App\Http\Controllers\Backend\Feature\FeatureController::class, 'get_detail'])->name('feature-edit');

    // Service.....................................................................................................
    Route::get('service', [App\Http\Controllers\Backend\Service\ServiceController::class, 'index'])->name('service');
    Route::post('/service/insert', [App\Http\Controllers\Backend\Service\ServiceController::class, 'save'])->name('service.insert');
    Route::post('/service/list', [App\Http\Controllers\Backend\Service\ServiceController::class, 'list'])->name('service.list');
    Route::post('/service/delete', [App\Http\Controllers\Backend\Service\ServiceController::class, 'delete'])->name('service.delete');
    Route::post('/service/edit', [App\Http\Controllers\Backend\Service\ServiceController::class, 'get_detail'])->name('service.edit');

    //slider...................................................................................................
    Route::get('slider', [App\Http\Controllers\Backend\Slider\SliderController::class, 'index'])->name('slider');
    Route::post('/slider/save', [App\Http\Controllers\Backend\Slider\SliderController::class, 'save'])->name('/slider.save');
    Route::post('/slider/list', [App\Http\Controllers\Backend\Slider\SliderController::class, 'list'])->name('/slider.list');
    Route::post('/slider/delete', [App\Http\Controllers\Backend\Slider\SliderController::class, 'delete'])->name('/slider.delete');
    Route::post('/slider/edit', [App\Http\Controllers\Backend\Slider\SliderController::class, 'get_detail'])->name('/slider.detail');
});
