<?php

namespace App\Http\Controllers;

use App\Book;
use App\Cart;
use App\Category;
use App\Shelf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Transaction;

class BookController extends Controller
{

    // ini function untuk search books
    public function search(Request $request)
    {
        $carts = Cart::whereRaw('user_id = ?', [Auth::user()->id])->get();

        $books = Book::selectRaw('books.id, books.name, books.description')
            ->join('categories as c', 'c.id', '=', 'books.category_id')
            ->join('shelves as s', 's.id', '=', 'books.shelf_id')
            ->whereRaw(
                'books.name = ? or books.description = ? or c.name = ? or s.name = ?',
                [$request->search, $request->search, $request->search, $request->search]
            )
            ->paginate(15);

        $search = $request->search;

        return view('home', compact('books', 'carts', 'search'));
    }

    public function searchbook(Request $request)
    {

        $books = Book::selectRaw('books.id, books.name, books.description,c.name as category, books.stock, s.name as location')
            ->join('categories as c', 'c.id', '=', 'books.category_id')
            ->join('shelves as s', 's.id', '=', 'books.shelf_id')
            ->whereRaw(
                'books.name = ? or books.description = ? or c.name = ? or s.name = ?',
                [$request->search, $request->search, $request->search, $request->search]
            )
            ->paginate(15);

        $search = $request->search;

        return view('book.manage-book', compact('books', 'search'));
    }




    // ini untuk show detail

    public function detail($id)
    {
        $book = Book::selectRaw('books.id, books.name, books.description, c.name as category, books.stock, s.name as location')
            ->join('categories as c', 'c.id', '=', 'books.category_id')
            ->join('shelves as s', 's.id', '=', 'books.shelf_id')
            ->whereRaw('books.id = ?', [$id])
            ->first();

        return view('book.detail', compact('book'));
    }
    

    // Manage Book (Admin)
    public function manageBook()
    {

        $databook = Book::selectRaw('books.id as id ,books.name, books.description, c.name as category , books.stock, s.name as location')
            ->join('categories as c', 'c.id', '=', 'books.category_id')
            ->join('shelves as s', 's.id', '=', 'books.shelf_id')
            ->paginate(15);

        return view('book.manage-book', ['books' => $databook]);
    }
    // delete book
    public function deleteBook($id)
    {

        $book = Book::find($id);

        $book->delete();
        return redirect("manage-book")->with('danger', 'Data has been deleted.');
    }
    // Edit book
    public function editbook($id)
    {
        $categories = Category::all();
        $shelves = Shelf::all();
        $databook = Book::selectRaw('books.id as id ,books.name, books.description, c.id as category_id , books.stock, s.id as shelf_id')
        ->join('categories as c', 'c.id', '=', 'books.category_id')
        ->join('shelves as s', 's.id', '=', 'books.shelf_id')
        ->where('books.id',$id)
        ->first();

        return view('book.edit-book',  compact('databook','categories', 'shelves'));
    }

    public function doeditbook(Request $request, $id)
    {

        $rules = [
            'category' => 'required',
            'shelf' => 'required',
            'name' => 'required',
            'description' => 'required',
            'stock' => 'required',
        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect("edit-book/$id")->withErrors($validator)->withInput();
        }

        $book = Book::find($id);
        // ini untuk validasi
        $book->category_id = $request['category'];
        $book->shelf_id = $request['shelf'];
        $book->name = $request['name'];
        $book->description = $request['description'];
        $book->stock = $request['stock'];
        $book->save();
        // untuk meredirect dan memberikan notif sukses
        return redirect("edit-book/$id")->with('success', 'Data account has been updated.');
    }

    // ini untuk show borrow history
    public function borrowhistory($id)
    {
        $transaction = Transaction::selectRaw('transacions.id, transactions.status', 'transactions.created_at', 'b.name as books')
            ->join('books as b', 'b.id', '=', 'books.name')
            ->whereRaw('transactions.id = ?', [$id])
            ->first();

        return view('book.borrow-page', compact('transaction'));
    }




    // Add Book Page
    public function addbook()
    {
        $categories = Category::all();
        $shelves = Shelf::all();

        return view('book.add-book', compact('categories', 'shelves'));
    }

    // Do Add Book
    public function doAddBook(Request $request)
    {
        //validasi
        $rules = [
            'category' => 'required',
            'shelf' => 'required',
            'name' => 'required',   
            'description' => 'required',
            'stock' => 'required',

        ];
        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return redirect("add-book")->withErrors($validator)->withInput();
        }

        $book = new Book();
        $book->category_id = $request->category;
        $book->shelf_id = $request->shelf;
        $book->name = $request->name;
        $book->description = $request->description;
        $book->stock = $request->stock;
        $book->save();

        return back()->with('success', 'Book has been created.');
    }
}
