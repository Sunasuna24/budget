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
        $transaction = factory('App\Transaction')->create();

        $this->get('/transactions')
            ->assertSee($transaction->description)
            ->assertSee($transaction->category->name);
    }
}
