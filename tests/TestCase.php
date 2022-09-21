<?php

namespace Tests;

use App\User;
use Exception;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use App\Exceptions\Handler;
use Illuminate\Contracts\Debug\ExceptionHandler;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $user;

    protected function setUp ()
    {
        parent::setUp();
        $this->user = create('App\User');
        $this->signIn($this->user)->disableExceptionHandling();
    }

    protected function disableExceptionHandling ()
    {
        $this->oldExceptionHandler = app()->make(ExceptionHandler::class);
        app()->instance(ExceptionHandler::class, new PassThroughHandler);
    }

    protected function withExceptionHandling ()
    {
        app()->instance(ExceptionHandler::class, $this->oldExceptionHandler);
        return $this;
    }

    protected function signIn(User $user)
    {
        $this->actingAs($user);
        return $this;
    }

    protected function signOut()
    {
        $this->post('/logout');
        return $this;
    }
}

class PassThroughHandler extends Handler
{
    public function __construct () {}

    public function report (Exception $e) {}

    public function render ($request, Exception $e)
    {
        throw $e;
    }
}