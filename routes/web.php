<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\Post\CreateController;
use App\Http\Controllers\Post\DestroyController;
use App\Http\Controllers\Post\EditController;
use App\Http\Controllers\Post\IndexController;
use App\Http\Controllers\Post\ShowController;
use App\Http\Controllers\Post\StoreController;
use App\Http\Controllers\Post\UpdateController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Post;
use App\Http\Controllers;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|welcome
*/
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/', function () {
//    return view('about');
//});

Route::get('/', function () {
    return view('welcome');
});
//Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/login', [App\Http\Controllers\Auth\LoginController::class, 'showLoginForm'])->name('login');
//POST запрос аутентификации на сайте
Route::post('/login', [App\Http\Controllers\Auth\LoginController::class, 'login']);
//POST запрос на выход из системы (логаут)
Route::post('/logout', [App\Http\Controllers\Auth\LoginController::class, 'logout'])->name('logout');
/**
 * Маршруты регистрации...
 */
//страница с формой Laravel регистрации пользователей
Route::get('/register', [App\Http\Controllers\Auth\RegisterController::class, 'showRegistrationForm'])->name('register');
//Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
//POST запрос регистрации на сайте
Route::post('register', [App\Http\Controllers\Auth\RegisterController::class,'register']);
/**
 * URL для сброса пароля...
 */
////POST запрос для отправки email письма пользователю для сброса пароля
//Route::post('password/email', 'Auth\ForgotPasswordController@sendResetLinkEmail')->name('password.email');
////ссылка для сброса пароля (можно размещать в письме)
//Route::get('password/reset', 'Auth\ForgotPasswordController@showLinkRequestForm')->name('password.request');
////страница с формой для сброса пароля
//Route::get('password/reset/{token}', 'Auth\ResetPasswordController@showResetForm')->name('password.reset');
////POST запрос для сброса старого и установки нового пароля
//Route::post('password/reset', 'Auth\ResetPasswordController@reset');

// ---------------------------
Route::namespace('App\Http\Controllers\Post')->group(function (){
    Route::get('/posts', IndexController::class)->name('post.index');
    Route::get('/posts/create', CreateController::class)->name('post.create');
    Route::post('/posts', StoreController::class)->name('post.store');
    Route::get('/posts/{post}', ShowController::class)->name('post.show');
    Route::get('/posts/{post}/edit', EditController::class)->name('post.edit');
    Route::patch('/posts/{post}', UpdateController::class)->name('post.update');
    Route::delete('/posts/{post}', DestroyController::class)->name('post.delete');
});

Route::group(['namespace' => 'App\Http\Controllers\Admin\Post', 'prefix' => 'admin'], function (){
    Route::get('/post', Controllers\Admin\Post\IndexController::class)->name('admin.post.index');
});


Route::get('/main', [MainController::class, 'index'])->name('main.index');
Route::get('/contacts', [ContactController::class, 'index'])->name('contact.index');
Route::get('/about', [AboutController::class, 'index'])->name('about.index');
//Route::get('/', [HomeController::class, 'index'])->name('profile');
//Auth::routes();

//Route::get('/', function () {
//    return 'Привет! Вода камень точит!';
//});
//App\Http\Controllers\Post\
//Route::group(['namespace' => 'Post'], function () {   // По видео так, но как-то работать не хочет. Видео 25


    //Route::group(['namespace' => 'Post'], function (){
//});
//    Route::get('/posts/create', [PostController::class, 'create'])->name('post.create');
//    Route::post('/posts', [PostController::class, 'store'])->name('post.store');
//    Route::get('/posts/{post}', [PostController::class, 'show'])->name('post.show');
//    Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('post.edit');
//    Route::patch('/posts/{post}', [PostController::class, 'update'])->name('post.update');
//    Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('post.delete');


//Route::get('/posts', 'IndexController::class')->name('post.index');




//Route::get('/posts/update', [PostController::class, 'update']);
//Route::get('/posts/delete', [PostController::class, 'delete']);
//Route::get('/posts/first_or_create', [PostController::class, 'firstOrCreate']);
//Route::get('/posts/update_or_create', [PostController::class, 'updateOrCreate']);
//


//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Auth::routes();

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


//  В ларавел 9 можно группировать роуты в рамках одного контроллера.
//  Route::controller(PostController::class)->group(function (){
//      Route::get('posts', 'index');
//      Route::get('posts/{post}', 'show');
//      Route::delete('posts/{post}', 'destroy');
//  });

//  В ларавел 9 появился метод scopeBindings()
//  Route::get('/users/{user}/{post}', [UserController::class, 'userPosts'])->scopeBindings();

//  Передача параметра id по умолчанию. Если например в строке запроса не указано.
//  Route::get('user/{id?}', function ($id = null) {
//      return 'Вы указали: '. $id;
//  });

//  Передача параметра id по умолчанию. Если например в строке запроса не указано.
//  А если указан, то что он является числом
//  Route::get('user/{id?}', function ($id = null) {
//      return 'Вы указали :'. $id;
//  })->where('id', '[0-9]+');

//  Проверка того, что id число, а name строка
//  Route::get('user/{id?}/{name?}', function ($id = null, $name = null) {
//      return 'Имя : '. $name .'Вы указали :'. $id;
//  })->where('id', '[0-9]+')->where('name', '[A-Za-z]+');
//
//  // Если мы проверяем id в RouteServiceProvider.php на то , что это число, проверку id здесь можно не указывать
//  Route::get('user/{id?}/{name?}', function ($id = null, $name = null) {
//      return 'Имя : '. $name .'Вы указали :'. $id;
//  })->where('name', '[A-Za-z]+');
//
//
//  Route::get('post/{id?}', function ($id = null) {
//       return 'Вы указали post:'. $id;
//  });

//  Роут будет обрабатываться если после subcategory есть слеш и следующая subcategory или т.п.
//  Route::get('post/{subcategory?}', function ($subcategory = null) {
//      return 'Вы указали post:'. $subcategory;
//  })->where('subcategory', '.+');

//  Роут будет обрабатываться если после subcategory нет слеша
//  Route::get('post/{subcategory?}', function ($subcategory = null) {
//         return 'Вы указали post:'. $subcategory;
//  })->where('subcategory', '[^/]+');

//  Route::get('user/{id?}/{name?}', function ($id = null, $name = null) {
//      return 'Имя : '. $name .'Вы указали :'. $id;
//  })->name('user');

//  Route::view('/', 'index');

//  Редрект на роут 'user'.
//  Route::get('redirect/{id?}/{name?}', function ($id=null, $name=null) {
//     return redirect()->route('user', ['id' => $id, 'name' => $name]);
//  });
// группировка маршрутов. Например если их необходимо пропустить через один middleware
//  Route::middleware('jsonprettify:1')->group(function () {
//      Route::get('/json/{data}', function ($data){
//            return ['data' => $data];
//      });
//       Route::get('/test/{data}', function ($data){
//            return ['test_data' => $data];
//        });
//  });
//  Группировка маршрутов. По одному префиксу.
//  Route::middleware('jsonprettify:1')->prefix('my')->group(function () {
//        Route::get('/json/{data}', function ($data){
//            return ['data' => $data];
//      });
//      Route::get('test/{data}', function ($data){
//            return ['test_data' => $data];
//      });
//  });
// Группируем роуты только для определенного домена.
//Route::domain('{subdomain}.example.com')->group(function (){
//    Route::get('user/{id}', function ($subdomain, $id){
//
//    })
//});
//  Группировка по имени
//  Route::name('user.')->group(function (){
//        Route::get('settings/{id?}', function ($id = null) {
//            return 'Настойки для ID: '. $id;
//        })->name('settings');
//        Route::get('user/{id?}/{name?}', function ($id = null, $name = null) {
//            return 'Имя : '. $name .'Вы указали :'. $id;
//        })->name('profile');
//  });
//  Route::middleware('jsonprettify:1')->group(function (){
//      Route::get('projects/{project}', function (\App\Models\Project $project){
//           return $project;
//      });
//       Route::get('project/{project}', function ($project){
//          return $project;
//      })
//  });

//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//
//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//
//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
//
//Auth::routes();
//
//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
