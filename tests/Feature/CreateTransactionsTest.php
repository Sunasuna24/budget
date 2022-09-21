<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class CreateTransactionsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function 取引を作成する()
    {
        $transaction = make('App\Transaction');

        $this->post('/transactions', $transaction->toArray())
            ->assertRedirect('/transactions');
        $this->get('/transactions')
            ->assertSee($transaction->description); 
    }

    /** @test */
    function 詳細なしでは取引を作成できない()
    {
        $this->postTransaction(['description' => null])->assertSessionHasErrors('description');
    }

    /** @test */
    function カテゴリなしでは取引を作成できない()
    {
        $this->postTransaction(['category_id' => null])->assertSessionHasErrors('category_id');
    }

    /** @test */
    function 金額なしでは取引を作成できない()
    {
        $this->postTransaction(['amount' => null])->assertSessionHasErrors('amount');
    }

    /** @test */
    function 有効な金額でないと取引を作成できない()
    {
        $this->postTransaction(['amount' => 'abc'])->assertSessionHasErrors('amount');
    }

    public function postTransaction($overrides = [])
    {
        $transaction = make('App\Transaction', $overrides);
        return $this->withExceptionHandling()->post('/transactions', $transaction->toArray());
    }
}
