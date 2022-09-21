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
            ->assertRedirect($transaction->description);
    }
}
