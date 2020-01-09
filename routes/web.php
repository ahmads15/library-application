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
    if (Auth::guest()) {
        $books = \App\Book::inRandomOrder()->limit(4)->get();
    } else {
        $books = \App\Book::paginate(15);
        $carts = \App\Cart::whereRaw('user_id = ?', [Auth::user()->id])->get();
    }
    $flag = 0;

    return view('home', compact('books', 'carts', 'flag'));
});

Route::get('seeAllBooks', function () {
    $books = \App\Book::paginate(15);

    $flag = 1;

    return view('home', compact('books', 'flag'));
});

Auth::routes();




Route::get('/home', 'HomeController@index')->name('home');
// route untuk search book
Route::post('books-search', 'BookController@search');
Route::post('Managebooks-search', 'BookController@searchbook');

//  route untuk search user
Route::post('users-search', 'UserController@searchuser');

// route untuk edit profile dan edit account
Route::post('update-profile/{id}', 'UserController@doUpdateUser');
Route::get('update-profile/{id}', 'UserController@updateUser');
Route::get('update-account/{id}', 'UserController@updateAccount');
Route::post('update-account/{id}', 'UserController@doUpdateAccount');

// route untuk book detail
Route::get('book-detail/{id}', 'BookController@detail');
// route untuk borrow page
Route::get('borrow-page/{id}', 'BookController@borrowhistory');

// route untuk manage user (Admin)
Route::get('manage-user', 'UserController@manageUser');
Route::get('delete-user/{id}', 'UserController@deleteUser');
//  route untuk edit user (Admin)
Route::get('edit-member/{id}', 'UserController@edituser');
Route::post('edit-member/{id}', 'UserController@doedituser');

// route untuk add new member (Admin)
Route::post('add-member', 'UserController@addmember');
Route::get('add-member', function () {
    return view('admin.add-member');
});

// route untuk add new book (admin)
Route::get('add-book', 'BookController@addbook');
Route::post('add-book', 'BookController@doAddBook');

// route untuk cart
Route::get('cart', 'TransaksiController@carts');
Route::get('delete-cart/{id}', 'TransaksiController@deletecart');
// route untuk manage book
Route::get('manage-book', 'BookController@manageBook');
Route::delete('delete-book/{id}', 'BookController@deleteBook');
Route::get('edit-book/{id}', 'BookController@editbook');
Route::post('edit-book/{id}', 'BookController@doeditbook');

// route untuk book category
Route::get('manage-category', 'CategoryController@manageCategory');
Route::post('add-category', 'CategoryController@addcategory');
Route::get('add-category', function () {
    return view('book.add-category');
});
Route::get('delete-category/{id}', 'CategoryController@deleteCategory');
Route::post('category-search', 'CategoryController@searchcategory');
Route::get('edit-category/{id}', 'CategoryController@editcategory');
Route::post('edit-category/{id}', 'CategoryController@doeditcategory');


// route untuk shelf
Route::get('manage-shelf', 'ShelfController@manageShelf');
Route::post('shelf-search', 'ShelfController@searchshelf');
Route::post('add-shelf', 'ShelfController@addshelf');
Route::get('add-shelf', function () {
    return view('shelf.add-shelf');
});
Route::get('delete-shelf/{id}', 'ShelfController@deleteShelf');
Route::get('edit-shelf/{id}', 'ShelfController@editshelf');
Route::post('edit-shelf/{id}', 'ShelfController@doeditshelf');


// route untuk user blacklisted
Route::get('user-blacklisted', 'UserController@userBlacklisted');
Route::post('userblacklisted-search', 'UserController@searchblacklisted');
Route::get('add-userblacklisted', 'UserController@adduser');
Route::post('add-userblacklisted', 'UserController@doAddUser');
Route::get('delete-userBlacklist/{id}', 'UserController@deleteUserBlacklist');
Route::get('edit-userblacklisted/{id}', 'UserController@editUserBlacklist');
Route::post('edit-userblacklisted/{id}', 'UserController@doeditUserBlacklist');

Route::get('borrow-book/{id}', 'TransaksiController@borrowbook');

Route::post('confirm-borrow', 'TransaksiController@confirmborrow');
Route::get('borrow-history', 'TransaksiController@borrowhistory');

Route::post('return-book/{id}', 'TransaksiController@returnbook');

Route::get('manage-transaction', 'TransaksiController@managetransaction');
Route::post('transaction-search', 'TransaksiController@searchtransaction');
Route::get('delete-transaction/{id}', 'TransaksiController@deleteTransaction');