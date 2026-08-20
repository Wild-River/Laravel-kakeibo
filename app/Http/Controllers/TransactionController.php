<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Transaction;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TransactionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        // $transactions = Transaction::all(); // all()でも関連カテゴリは呼び出せる（都度SQLアクセス）
        $transactions = Transaction::with('category')->latest('occurred_at')->get();

        // とってきたデータをViewに渡す
        return view('transactions.index', [
            'transactions' => $transactions, // 左がフロントで使うkey / 右が取得したデータ
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        // $cagetories = Category::all(); // 変数に代入しなくても大丈夫

        return view('transactions.create', [
            'categories' => Category::all(),
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'occurred_at' => 'required|date',
            'type' => 'required|in:income,expense',
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|integer|min:1',
            'note' => 'nullable|string|max:255',
        ]);

        // dd($validated); //データ確認できる

        Transaction::create($validated);

        return redirect('/transactions');
    }

    /**
     * Display the specified resource.
     */
    public function show(Transaction $transaction): void
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Transaction $transaction): View
    {
        return view('transactions.edit', [
            'transaction' => $transaction,
            'categories' => Category::all(),
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Transaction $transaction): RedirectResponse
    {
        $validated = $request->validate([
            'occurred_at' => 'required|date',
            'type' => 'required|in:income,expense',
            'category_id' => 'required|exists:categories,id',
            'amount' => 'required|integer|min:1',
            'note' => 'nullable|string|max:255',
        ]);

        $transaction->update($validated);

        return redirect('/transactions');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Transaction $transaction): RedirectResponse
    {
        $transaction->delete();

        return redirect('/transactions');
    }
}
