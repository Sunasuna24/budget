<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewTransactionsTest extends TestCase
{
    use DatabaseMigrations;
 
    /** @test */
    function 全てのトランザクションを表示する()
    {
        $transaction = $this->create('App\Transaction');

        $this->get('/transactions')
            ->assertSee($transaction->description)
            ->assertSee($transaction->category->name);
    }

    /** @test */
    function カテゴリで取引をフィルタできる()
    {
        $category = create('App\Category');
        $transaction = $this->create('App\Transaction', ['category_id' => $category->id]);
        $other_transaction = $this->create('App\Transaction');

        $this->get('/transactions/' . $category->slug)
            ->assertSee($transaction->description)
            ->assertDontSee($other_transaction->description);
    }

    /** @test */
    function 月別で取引をフィルタできる()
    {
        $current_transaction = $this->create('App\Transaction');
        $past_transaction = $this->create('App\Transaction', ['created_at' => Carbon::now()->subMonth(2)]);

        $this->get('/transactions?month=' . Carbon::now()->subMonth(2)->format('M'))
            ->assertSee($past_transaction->description)
            ->assertDontSee($current_transaction->description);
    }

    /** @test */
    function デフォルトでは当月で取引をフィルタする()
    {
        $current_transaction = $this->create('App\Transaction');
        $past_transaction = $this->create('App\Transaction', ['created_at' => Carbon::now()->subMonth(2)]);

        $this->get('/transactions')
            ->assertSee($current_transaction->description)
            ->assertDontSee($past_transaction->description);
    }
}
