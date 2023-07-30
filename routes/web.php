<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\FrontpageController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\OrderController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/



Route::get('/', [FrontpageController::class, 'index'])->name('home');
Route::get('/about', [FrontpageController::class, 'aboutshow'])->name('about');
Route::get('/testmonials', [FrontpageController::class, 'testmonialsshow'])->name('testmonials');
Route::get('/product', [FrontpageController::class, 'productshow'])->name('product');
Route::get('/blog', [FrontpageController::class, 'blogshow'])->name('blog');
Route::get('/contact', [FrontpageController::class, 'contactshow'])->name('contact');
Route::post('/add_cart/{id}', [FrontpageController::class, 'add_cart'])->name('add_cart');
Route::get('/show_cart', [FrontpageController::class, 'show_cart'])->name('show_cart');
Route::delete('/remove-from-cart/{id}', [FrontpageController::class, 'remove_from_cart'])->name('remove-from-cart');
Route::get('/checkout-cash', [FrontpageController::class, 'checkout_cash'])->name('checkout-cash');
Route::get('/stripe/{totleprice}', [FrontpageController::class, 'stripe'])->name('stripe');
Route::post('stripe/{totleprice}', [FrontpageController::class,'stripePost'])->name('stripe.post');
Route::get('/Orders', [FrontpageController::class,'show_orders'])->name('show_orders');
Route::delete('/Orders/remove/{id}', [FrontpageController::class,'remove_order'])->name('remove_order');
Route::post('/Comment', [CommentController::class,'add_comment'])->name('add_comment');
Route::post('/Replay/{id}', [CommentController::class,'add_replay'])->name('add_replay');




//Admin
Route::group(['prefix' => 'admin','namespace'=>'Admin', 'middleware' => ['auth', 'isAdmin'], 'as' => 'admin.'], function () {
    
    Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('Categorie', 'CategorieController');
    Route::resource('Products', 'ProductController');
    Route::resource('Orders', 'OrderController');
    Route::post('Orders/delivred/{id}', [OrderController::class, 'delivred'])->name('Orders.delivred');
    Route::post('Orders/exportPdf', [OrderController::class, 'exportPdf'])->name('Orders.export-pdf');
    Route::get('Orders/sendEamil/{id}', [OrderController::class, 'sendemail'])->name('sendEmail');
    Route::post('Orders/send_user_email/{id}', [OrderController::class, 'send_user_email'])->name('send_user_email');
    Route::post('Orders/Searche_Order', [OrderController::class, 'searche_order'])->name('Orders.Searche');

});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
