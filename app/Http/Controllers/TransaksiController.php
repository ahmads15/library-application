<?php

namespace App\Http\Controllers;

use App\Book;
use App\Cart;
use App\User;
use App\Transaction;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\UserBlacklist;

class TransaksiController extends Controller
{
    // Cart
    public function carts()
    {

        $datacart = Cart::selectRaw('carts.id as id , b.name as name, b.id as book_id')
            ->join('books as b', 'b.id', '=', 'carts.book_id')
            ->whereRaw('carts.user_id', Auth::user()->id)
            ->paginate(15);

        return view('transaksi.cart', ['carts' => $datacart]);
    }
    public function deletecart($id)
    {

        $cart = Cart::find($id);

        $cart->delete();
        return redirect("cart")->with('danger', 'Data has been deleted.');
    }
    // ini untuk search shelf manage (Admin)
    public function searchtransaction(Request $request)
    {

        $transactions = Transaction::selectRaw('transactions.id, transactions.status,transactions.lend_start,transactions.lend_due')
            ->join('users as u', 'u.id', '=', 'transactions.user_id')
            ->whereRaw(
                'transactions.status = ?',
                [$request->search]
            )
            ->paginate(15);

        $search = $request->search;

        return view('transaksi.manage-transaction', compact('transactions', 'search'));
    }
    public function deleteTransaction($id)
    {
        $transaction = Transaction::find($id);
        $transaction->delete();
        return redirect("manage-transaction")->with('danger', 'Transactions has been deleted.');
    }
    public function confirmborrow(Request $request)
    {
        $books = $request->books;

        Cart::whereIn('book_id', $books)->delete();

        $dateNow = date('Y-m-d H:i:s', strtotime('now'));
        $datePlus = date('Y-m-d H:i:s', strtotime('now + 7 days'));

        foreach ($books as $b) {
            $transaction = new Transaction();
            $transaction->book_id = $b;
            $transaction->user_id = Auth::user()->id;
            $transaction->lend_start = $dateNow;
            $transaction->lend_due = $datePlus;
            $transaction->status = 'Waiting for Approval';
            $transaction->save();
        }

        return back();
    }
    //  boorrow histrory
    public function borrowhistory()
    {
        if (Auth::user()->role == 'admin') {
            $check = Transaction::whereRaw('status = "Waiting for Approval"')->get();

            if (count($check) > 0) {
                $transactions = Transaction::selectRaw('transactions.id as id, b.name as name, status, lend_start')
                    ->join('books as b', 'b.id', '=', 'transactions.book_id')
                    ->paginate(15);
            } else {
                Transaction::whereRaw('1=1')->update([
                    'status' => 'Completed'
                ]);

                $transactions = Transaction::selectRaw('transactions.id as id, b.name as name, status, lend_start')
                    ->join('books as b', 'b.id', '=', 'transactions.book_id')->paginate(15);
            }
        } else {
            $transactions = Transaction::selectRaw('transactions.id as id, b.name as name, status, lend_start')
                ->where('user_id', Auth::user()->id)
                ->join('books as b', 'b.id', '=', 'transactions.book_id')
                ->paginate(15);
        }

        return view('transaksi.borrow-history', compact('transactions'));
    }
    // untuk return book
    public function returnbook($id)
    {
        $transaction = Transaction::find($id);
        $transaction->status = "Returned";
        $transaction->save();

        $check = Transaction::whereRaw('status = "Waiting for Approval"')->get();

        if (count($check) == 0) {
            Transaction::whereRaw('1=1')->update([
                'status' => 'Completed'
            ]);
        }

        return back();
    }
    // untuk view manage transaksi
    public function managetransaction()
    {
        $transactions = Transaction::selectRaw('transactions.id, lend_start, lend_due, name, status')
            ->join('users as u', 'u.id', '=', 'transactions.user_id')->get();

        return view('transaksi.manage-transaction', compact('transactions'));
    }
    //  ini untuk borrow booook
    public function borrowbook($id)
    {
        $ub = UserBlacklist::where('user_id', Auth::user()->id)->first();

        if (count($ub) > 0) {
            return back()->with('danger', 'User has been blacklisted.');
        }

        $cart = new Cart();
        $cart->book_id = $id;
        $cart->user_id = Auth::user()->id;
        $cart->save();

        return back();
    }
}
