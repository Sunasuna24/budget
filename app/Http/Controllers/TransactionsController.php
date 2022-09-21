<?php

namespace App\Http\Controllers;

use App\Category;
use App\Transaction;
use Illuminate\Http\Request;

class TransactionsController extends Controller
{
    public function index(Category $category = null)
    {
        $transactions = $category->exists ? Transaction::where('category_id', $category->id)->get() : Transaction::all();
        return view('transactions.index', compact('transactions'));
    }
}
