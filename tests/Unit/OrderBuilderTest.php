<?php

namespace Tests\Unit;

use App\Services\OrderBuilderService as OrderBuilder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class OrderBuilderTest extends TestCase
{
    // use RefreshDatabase;

    public function testValidRequestPasses(): void
    {
        // $this->seed();

        $orderBuilder = new OrderBuilder([
            'cart' => '{"items":[{"id":1,"name":"Margherita","size":"small","price":"6.00","quantity":1},{"id":5,"name":"Quattro Stagioni","size":"medium","price":"8.00","quantity":1}],"jsTotalPrice":15}',
            'first_name' => 'John',
            'last_name' => 'Doe',
            'address' => '1234 Main St',
            'city' => 'Springfield',
            'phone' => '123 456 7890'
        ]);
        $orderBuilder->build();

        $this->assertTrue($orderBuilder->isValidCart);
        $this->assertTrue($orderBuilder->isNotEmptyCart);
        $this->assertTrue($orderBuilder->areValidItems);
        $this->assertTrue($orderBuilder->isValidDelivery);
    }

    public function testCartIsInvalid(): void
    {
        $orderBuilder = new OrderBuilder([
            'cart' => 'asd'
        ]);
        $orderBuilder->build();

        $this->assertNotTrue($orderBuilder->isValidCart);
    }

    public function testCartIsEmpty(): void
    {
        $orderBuilder = new OrderBuilder([
            'cart' => '{"items": []}'
        ]);
        $orderBuilder->build();

        $this->assertNotTrue($orderBuilder->isNotEmptyCart);
    }

    public function testItemIsInvalid(): void
    {
        $orderBuilder = new OrderBuilder([
            'cart' => '{"items":[{"id":-1,"name":"Margherita","size":"small","price":"6.00","quantity":1},{"id":5,"name":"Quattro Stagioni","size":"medium","price":"8.00","quantity":1}],"jsTotalPrice":15}'
        ]);
        $orderBuilder->build();

        $this->assertNotTrue($orderBuilder->areValidItems);
    }

    public function testDeliveryIsInvalid(): void
    {
        $orderBuilder = new OrderBuilder([
            'cart' => '{"items":[{"id":1,"name":"Margherita","size":"small","price":"6.00","quantity":1},{"id":5,"name":"Quattro Stagioni","size":"medium","price":"8.00","quantity":1}],"jsTotalPrice":15}',
            'first_name' => 'John',
            'last_name' => 'Doe',
            // other delivery data missing...
        ]);
        $orderBuilder->build();

        $this->assertNotTrue($orderBuilder->isValidDelivery);
    }
}
