<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\NotificationsController;
use App\Http\Controllers\Admin\HelperController;
use App\Http\Controllers\Admin\TestController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\ArticleController;
use App\Http\Controllers\Admin\SiteMapController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\ContactController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RedirectionController;
use App\Http\Controllers\Admin\SupervisorController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\Admin\TrafficsController;
use App\Http\Controllers\Admin\SkillController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\ProjectController;


//Route::get('/test', function () {
//    return \App\Models\Book::find(1)->status;
//});



Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => ['localeSessionRedirect', 'localizationRedirect', 'localeViewPath']
    ], function () {


    Auth::routes();
    Route::get('/', function () {
        return view('front.index');
    })->name('home');
//Route::get('/test',[TestController::class,'index']);


    Route::prefix('admin')->middleware(['auth', 'ActiveAccount'])->name('admin.')->group(function () {
        Route::get('/', [AdminController::class, 'index'])->name('index');
        //Route::get('/profile',[AdminController::class,'upload_image']);

        Route::group(['prefix' => 'attributes'], function () {
            Route::get('/', [\App\Http\Controllers\Admin\AttributeController::class, 'index'])->name('attribute.index');
            Route::get('/getAttribute', [\App\Http\Controllers\Admin\AttributeController::class, 'getAttribute'])->name('getAttribute');
            Route::post('/', [\App\Http\Controllers\Admin\AttributeController::class, 'store'])->name('attribute.store');
            Route::post('/update', [\App\Http\Controllers\Admin\AttributeController::class, 'update'])->name('attribute.update');
            Route::post('/delete', [\App\Http\Controllers\Admin\AttributeController::class, 'delete'])->name('attribute.delete');
        });
        Route::group(['prefix' => 'option', ], function () {
            Route::get('/', [\App\Http\Controllers\Admin\OptionController::class, 'index'])->name('option.index');
            Route::get('/getOption', [\App\Http\Controllers\Admin\OptionController::class, 'getOption'])->name('getOption');
            Route::post('/', [\App\Http\Controllers\Admin\OptionController::class, 'store'])->name('option.store');
            Route::post('/update', [\App\Http\Controllers\Admin\OptionController::class, 'update'])->name('option.update');
            Route::post('/delete', [\App\Http\Controllers\Admin\OptionController::class, 'delete'])->name('option.delete');
        });

        Route::resource('contacts', ContactController::class);
        Route::resource('redirections', RedirectionController::class);
//        Route::resource('supervisors',SupervisorController::class);



        Route::group(['prefix' => 'categories'], function () {
            Route::get('/', [CategoryController::class, 'index'])->name('categories.index');
            Route::get('/getCategory', [CategoryController::class, 'getCategory'])->name('categories.getCategory');
            Route::get('/create', [CategoryController::class, 'create'])->name('categories.create');
            Route::post('/', [CategoryController::class, 'store'])->name('categories.store');
            Route::get('/edit/{id}', [CategoryController::class, 'edit'])->name('categories.edit');
            Route::post('/update', [CategoryController::class, 'update'])->name('categories.update');
            Route::post('/delete', [CategoryController::class, 'delete'])->name('categories.delete');
            Route::get('/getOption/{id}', [CategoryController::class, 'getOption'])->name('categories.getOption');
            Route::post('/delete/option', [CategoryController::class, 'deleteOption'])->name('categories.option.delete');
            Route::get('/test/{id}', [CategoryController::class, 'test'])->name('categories.option.getSitioPadre');

        });



        Route::group(['prefix' => 'supervisors'], function () {
            Route::get('/', [SupervisorController::class, 'index'])->name('supervisors.index');
            Route::get('/getSupervisor', [SupervisorController::class, 'getSupervisor'])->name('supervisors.getSupervisor');
            Route::get('/create', [SupervisorController::class, 'create'])->name('supervisors.create');
            Route::post('/', [SupervisorController::class, 'store'])->name('supervisors.store');
            Route::get('/edit/{id}', [SupervisorController::class, 'edit'])->name('supervisors.edit');
            Route::post('/update', [SupervisorController::class, 'update'])->name('supervisors.update');
            Route::post('/delete', [SupervisorController::class, 'delete'])->name('supervisors.delete');
        });
        Route::group(['prefix' => 'projects'], function () {
            Route::get('/', [ProjectController::class, 'index'])->name('projects.index');
            Route::get('/getProject', [ProjectController::class, 'getProject'])->name('projects.getProject');
            Route::get('/create', [ProjectController::class, 'create'])->name('projects.create');
            Route::post('/', [ProjectController::class, 'store'])->name('projects.store');
            Route::get('/edit/{id}', [ProjectController::class, 'edit'])->name('projects.edit');
            Route::post('/update', [ProjectController::class, 'update'])->name('projects.update');
            Route::post('/delete', [ProjectController::class, 'delete'])->name('projects.delete');
        });

        Route::get('traffics', [TrafficsController::class, 'index'])->name('traffics.index');
        Route::get('traffics/{traffic}/logs', [TrafficsController::class, 'logs'])->name('traffics.logs');
        Route::get('error-reports', [TrafficsController::class, 'error_reports'])->name('traffics.error-reports');
        Route::get('error-reports/{report}', [TrafficsController::class, 'error_report'])->name('traffics.error-report');

        Route::prefix('upload')->name('upload.')->group(function () {
            Route::post('/image', [HelperController::class, 'upload_image'])->name('image');
            Route::post('/file', [HelperController::class, 'upload_file'])->name('file');
            Route::post('/remove-file', [HelperController::class, 'remove_files'])->name('remove-file');
        });
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('/', [ProfileController::class, 'index'])->name('index');
            Route::get('/edit', [ProfileController::class, 'edit'])->name('edit');
            Route::put('/update', [ProfileController::class, 'update'])->name('update');
            Route::put('/update-password', [ProfileController::class, 'update_password'])->name('update-password');
            Route::put('/update-email', [ProfileController::class, 'update_email'])->name('update-email');
        });
        Route::prefix('notifications')->name('notifications.')->group(function () {
            Route::get('/', [NotificationsController::class, 'index'])->name('index');
            Route::get('/ajax', [NotificationsController::class, 'notifications_ajax'])->name('ajax');
            Route::post('/see', [NotificationsController::class, 'notifications_see'])->name('see');
        });
        Route::prefix('settings')->name('settings.')->group(function () {
            Route::get('/', [SettingController::class, 'index'])->name('index');
            Route::put('/update', [SettingController::class, 'update'])->name('update');
        });

        Route::group(['prefix' => 'roles'], function () {
            Route::get('/', '\App\Http\Controllers\Admin\RoleController@index')->name('roles.index');
            Route::get('create', '\App\Http\Controllers\Admin\RoleController@create')->name('roles.create');
            Route::post('store', '\App\Http\Controllers\Admin\RoleController@saveRole')->name('roles.store');
            Route::get('/edit/{id}', '\App\Http\Controllers\Admin\RoleController@edit')->name('roles.edit');
            Route::post('update/{id}', '\App\Http\Controllers\Admin\RoleController@update')->name('roles.update');
        });

        Route::prefix('skills')->name('skills.')->group(function () {
            Route::get('/', [SkillController::class, 'index'])->name('index');
            Route::get('/getSkills', [SkillController::class, 'getSkills'])->name('getSkills');
            Route::get('/create', [SkillController::class, 'create'])->name('create');
            Route::post('/', [SkillController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [SkillController::class, 'edit'])->name('edit');
            Route::post('/update', [SkillController::class, 'update'])->name('update');
            Route::post('/delete/', [SkillController::class, 'delete'])->name('delete');

        });


        Route::prefix('users')->name('users.')->group(function () {
            Route::get('/', [UserController::class, 'index'])->name('index');
            Route::get('/create', [UserController::class, 'create'])->name('create');
            Route::post('/', [UserController::class, 'store'])->name('store');
            Route::get('/edit/{id}', [UserController::class, 'edit'])->name('edit');
            Route::post('/update', [UserController::class, 'update'])->name('update');
            Route::post('/destroy', [UserController::class, 'destroy'])->name('destroy');
        });
    });


    Route::get('blocked', [HelperController::class, 'blocked_user'])->name('blocked');
    Route::get('robots.txt', [HelperController::class, 'robots']);
    Route::get('manifest.json', [HelperController::class, 'manifest']);
    Route::get('sitemap.xml', [SiteMapController::class, 'sitemap']);
    Route::get('sitemaps/links', 'SiteMapController@custom_links');
    Route::get('sitemaps/{name}/{page}/sitemap.xml', [SiteMapController::class, 'viewer']);


//pages
    Route::get('about', [FrontController::class, 'about']);
    Route::view('privacy', 'front.pages.privacy');
    Route::view('terms', 'front.pages.terms');
    Route::view('contact', 'front.pages.contact');
    Route::get('article/', [FrontController::class, 'article'])->name('article.show');
    Route::get('blog', [FrontController::class, 'blog'])->name('blog');
    Route::post('contact', [FrontController::class, 'contact_post'])->name('contact-post');

    Route::get('category/{id}', [FrontController::class, 'category'])->name('front.category');
    Route::get('attribute/{id}', [FrontController::class, 'attribute'])->name('front.attribute');
    Route::post('option/', [FrontController::class, 'option'])->name('front.option');


    });
