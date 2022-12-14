<?php

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
  return view('welcome');
});

Route::get('/insert', function () {
  $stuRef = app('firebase.firestore')->database()->collection('products')->newDocument();
  $stuRef->set([

    // here u can insert examples

    'name' => 'Vanilla',
    'price' => '1.20',
    // 'expiry'    => '2022-12-20'
    // 'expiry'    => '2022-12-20'
    // 'expiry'    => '2022-12-20'
    // ...
  ]);
  echo "<h1>" . 'inserted' . "</h1>";
});

Route::get('/display', function () {
  $product = app('firebase.firestore')->database()->collection('products')->document('XVlhBy1essYr9HNGJRh0')->snapshot();
  print_r('Product ID =' . $product->id());
  print_r("<br>" . ' Name = ' . $product->data()['name']);
  print_r("<br>" . ' Price = ' . $product->data()['price']);
});

Route::get('/update', function () {
  $product = app('firebase.firestore')->database()->collection('invoices')->document('166f34ea1c9641dab0a0')
    ->update([
      ['path' => 'price', 'value' => '18']
    ]);
  echo "<h1>" . 'updated' . "</h1>";
});

Route::get('/delete', function () {
  app('firebase.firestore')->database()->collection('products')->document('XVlhBy1essYr9HNGJRh0')->delete();
  echo "<h1>" . 'deleted' . "</h1>";
});

Route::resource('/crud', App\Http\Controllers\CrudController::class);
