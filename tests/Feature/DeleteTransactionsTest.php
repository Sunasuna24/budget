<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class DeleteTransactionsTest extends TestCase
{
    use DatabaseMigrations;
    
    /** @test */
    function 取引を削除できる()
    {
        $transaction = $this->create('App\Transaction');

        $this->delete("/transactions/{$transaction->id}")->assertRedirect('/transactions');
        $this->get('/transactions')->assertDontSee($transaction->description);
    }
}
