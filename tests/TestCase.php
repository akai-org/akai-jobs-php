<?php

namespace Tests;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;
use Faker\Factory as Faker;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication, DatabaseMigrations, DatabaseTransactions;

    protected $faker, $adminToken, $user1Token, $user2Token, $standardJsonFormat;

    public function setUp()
    {
        parent::setUp();
        $this->faker = Faker::create();
        $this->standardJsonFormat = [
            'message',
            'data'
        ];
    }

    public function tearDown()
    {
        $this->artisan('migrate:reset');
        parent::tearDown();
    }
}
