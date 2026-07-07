<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MercadoPagoController;
use App\Http\Middleware\IsAdmin;
use Illuminate\Support\Facades\Route;

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/juegos', [GameController::class, 'index'])->name('games.index');
Route::get('/juego/{id}', [GameController::class, 'show'])->name('games.show');

Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
Route::get('/blog/{id}', [BlogController::class, 'show'])->name('blogs.show');

// ---------------  SECCIÓN ADMIN  --------------- //
Route::middleware(['auth', IsAdmin::class])->group(function () {
    Route::get('/admin/dashboard', [HomeController::class, 'adminIndex'])->name('admin.dashboard');
    Route::get('/admin/blogs', [BlogController::class, 'panel'])->name('admin.blogs');
    Route::get('/admin/blogs/crear', [BlogController::class, 'create'])->name('admin.blogs.create');
    Route::post('/admin/blogs/crear', [BlogController::class, 'store'])->name('admin.blogs.store');
    Route::get('/admin/blogs/editar/{id}', [BlogController::class, 'edit'])->name('admin.blogs.edit');
    Route::post('/admin/blogs/editar/{id}', [BlogController::class, 'update'])->name('admin.blogs.update');
    Route::get('/admin/blogs/borrar/{id}', [BlogController::class, 'delete'])->name('admin.blogs.delete');
    Route::post('/admin/blogs/borrar/{id}', [BlogController::class, 'destroy'])->name('admin.blogs.destroy');
    Route::get('/admin/usuarios', [UsersController::class, 'adminIndex'])->name('admin.users');
    Route::get('/admin/usuarios/{id}', [UsersController::class, 'show'])->name('admin.users.show');
    Route::get('/admin/usuarios/borrar/{id}', [UsersController::class, 'delete'])->name('admin.users.delete');
    Route::post('/admin/usuarios/borrar/{id}', [UsersController::class, 'destroy'])->name('admin.users.destroy');
});

// ---------------  SECCIÓN AUTENTICADO  --------------- //
Route::middleware(['auth'])->group(function () {
    Route::get('/cuenta/{id}', [UsersController::class, 'index'])->name('user.index');
    Route::post('/cuenta/cambiar_contraseña/{id}', [UsersController::class, 'changePassword'])->name('user.changePassword');
    Route::get('/carrito', [CartController::class, 'index'])->name('cart.index');
    Route::post('/carrito/agregar', [CartController::class, 'addToCart'])->name('cart.add');
    Route::get('/carrito/quitar/{id}', [CartController::class, 'removeFromCart'])->name('cart.remove');
    Route::get('/carrito/vaciar', [CartController::class, 'clearCart'])->name('cart.clear');
    Route::get('/carrito/sum/{id}', [CartController::class, 'addQuantity'])->name('cart.addQuantity');
    Route::get('/carrito/min/{id}', [CartController::class, 'removeQuantity'])->name('cart.removeQuantity');

    // Checkout con Mercado Pago
    Route::get('/checkout/procesar', [MercadoPagoController::class, 'process'])->name('checkout.process');
    Route::get('/checkout/exito', [MercadoPagoController::class, 'success'])->name('mp.success');
    Route::get('/checkout/pendiente', [MercadoPagoController::class, 'pending'])->name('mp.pending');
    Route::get('/checkout/error', [MercadoPagoController::class, 'failure'])->name('mp.failure');
});


// ---------------  SECCIÓN AUTH  --------------- //
Route::get('/iniciar-sesion', [AuthController::class, 'showLogin'])->name('auth.showLogin');
Route::post('/iniciar-sesion', [AuthController::class, 'doLogin'])->name('auth.doLogin');
Route::get('/registrarse', [AuthController::class, 'showRegister'])->name('auth.showRegister');
Route::post('/registrarse', [AuthController::class, 'doRegister'])->name('auth.doRegister');
Route::post('/cerrar-sesion', [AuthController::class, 'logout'])->name('auth.logout');
