<?php

namespace Tests\Feature;

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
}
