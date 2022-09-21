<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UpdateTransactionsTest extends TestCase
{
    use DatabaseMigrations;

    /** @test */
    function 取引を更新できる()
    {
        $transaction = $this->create('App\Transaction');
        $new_transaction = $this->make('App\Transaction');

        $this->put("/transactions/{$transaction->id}", $new_transaction->toArray())->assertRedirect('/transactions');
        $this->get('/transactions')->assertSee($new_transaction->description);
    }

    /** @test */
    function 詳細なしでは取引を更新できない()
    {
        $this->updateTransaction(['description' => null])->assertSessionHasErrors('description');
    }

    /** @test */
    function カテゴリなしでは取引を更新できない()
    {
        $this->updateTransaction(['category_id' => null])->assertSessionHasErrors('category_id');
    }

    /** @test */
    function 金額なしでは取引を更新できない()
    {
        $this->updateTransaction(['amount' => null])->assertSessionHasErrors('amount');
    }

    /** @test */
    function 有効な金額でないと取引を更新できない()
    {
        $this->updateTransaction(['amount' => 'abc'])->assertSessionHasErrors('amount');
    }

    public function updateTransaction($overrides = [])
    {
        $transaction = $this->create('App\Transaction');
        $new_transaction = $this->make('App\Transaction', $overrides);

        return $this->withExceptionHandling()->put("/transactions/{$transaction->id}", $new_transaction->toArray());
    }
}
