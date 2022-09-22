<?php

namespace App\Http\Controllers;

use App\Category;
use App\Transaction;
use Carbon\Carbon;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Request $request, Category $category)
    {
        $transactions_query = Transaction::byCategory($category);
        $current_month = request('month') ?: Carbon::now()->format('M');
        $month = request()->has('month') ? request('month') : null;
        $transactions_query->byMonth($month);
        $transactions = $transactions_query->paginate();

        return view('transactions.index', compact('transactions', 'current_month'));
    }

    public function create()
    {
        $categories = Category::all();
        $transaction = new Transaction();

        return view('transactions.create', compact('categories', 'transaction'));
    }

    public function store(Request $request)
    {
        $this->validate(request(), [
            'description' => 'required',
            'amount' => 'required|numeric',
            'category_id' => 'required'
        ]);

        Transaction::create($request->all());
        return redirect('/transactions');
    }

    public function update(Transaction $transaction)
    {
        $this->validate(request(), [
            'description' => 'required',
            'amount' => 'required|numeric',
            'category_id' => 'required'
        ]);

        $transaction->update(request()->all());

        return redirect('/transactions');
    }

    public function edit(Transaction $transaction)
    {
        $categories = Category::all();

        return view('transactions.edit', compact('transaction', 'categories'));
    }

    public function destroy(Transaction $transaction)
    {
        $transaction->delete();

        return redirect('/transactions');
    }
}
