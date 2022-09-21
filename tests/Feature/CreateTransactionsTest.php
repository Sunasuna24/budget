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
    function ログインしているユーザーのみ利用できる()
    {
        $this->withExceptionHandling()->signOut()->get('/transactions')->assertRedirect('/login');
    }

    /** @test */
    function ログインしているユーザーの取引のみ表示する()
    {
        $other_user = create('App\User');
        $transaction = create('App\Transaction', ['user_id' => $this->user->id]);
        $other_transaction = create('App\Transaction', ['user_id' => $other_user->id]);

        $this->get('/transactions')->assertSee($transaction->description)->assertDontSee($other_transaction->description);
    }

    /** @test */
    function 取引を作成する()
    {
        $transaction = $this->make('App\Transaction');

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
