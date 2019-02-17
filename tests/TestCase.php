<?php

namespace Tests;

use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    protected $apiRoot = '/api/v1';

    public function setUp()
    {
        parent::setUp();
    }

    protected function signIn($user = null, $guard = null)
    {
        $user = $user ? $user : create('App\User');

        $this->actingAs($user, $guard);
        
        Passport::actingAs(
            $user
        );

        return $this;
    }
}
