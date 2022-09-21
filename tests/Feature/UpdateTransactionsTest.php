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
}
