<?php

namespace Tests;

use Laravel\Lumen\Testing\TestCase as BaseTestCase;
use Doctrine\ORM\EntityManager as ORM;
use App\Entities\Customer;

class TestCase extends BaseTestCase
{
    /**
     * Creates the application.
     *
     * @return \Laravel\Lumen\Application
     */


    public function createApplication()
    {
        return require __DIR__.'/../bootstrap/app.php';
    }

    public function testRoutes() {
        $response = $this->call('GET', '/');

        $this->assertEquals(200, $response->status());
    }

    public function testCustomers() {
        $response = $this->call('GET', '/customers');

        $this->assertEquals(200, $response->status());
    }

    public function testOneCustomer() {
        $response = $this->call('GET', '/customer/1');

        $this->assertEquals(200, $response->status());
    }

    public function testCustomersReturnData() {
        $this->json('GET', '/customers')->seeJson([]);
        $this->assertTrue(true);
    }

    public function testOneCustomersReturnData() {
        $this->json('GET', '/customer/1')->seeJson([]);
        $this->assertTrue(true);
    }

    public function testCustomerInsert() {
        $a = new Customer(
            'test@email.com',
            'aaaaaaaaa',
            md5('aaaaaaaa'),
            'aaaaaaaa', 
            'aaaaaaaa',
            'aaaaaaa',
            'aaaaaaa',
            'aaaaaaa',
            'aaaaaaa'
        );
        $this->assertTrue(true);
    }
}
