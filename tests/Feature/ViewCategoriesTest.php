<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class ViewCategoriesTest extends TestCase
{
    use DatabaseMigrations;
 
    /** @test */
    function 全てのカテゴリを表示できる()
    {
        $category = $this->create('App\Category');

        $this->get('/categories')->assertSee($category->name);
    }
}
