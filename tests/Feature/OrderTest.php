<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class OrderTest extends TestCase
{
    use WithFaker;

    public function testCreateOrderAsGuest(): void
    {
        $response = $this->post(route('order.checkout'), [
            'cart' => '{"items":[{"id":1,"name":"Margherita","size":"small","price":"6.00","quantity":1},{"id":2,"name":"Margherita","size":"medium","price":"8.00","quantity":1},{"id":3,"name":"Margherita","size":"large","price":"12.00","quantity":1}]}',
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'phone' => $this->faker->phoneNumber,
            'notes' => $this->faker->sentence,
        ]);
        $response->assertOk();

        $response = $this->post(route('order.pay'));
        $response->assertStatus(302);
    }

    public function testCreateOrderAsUser(): void
    {
        $this->actingAs(User::first());
        $response = $this->post(route('order.checkout'), [
            'cart' => '{"items":[{"id":1,"name":"Margherita","size":"small","price":"6.00","quantity":1},{"id":2,"name":"Margherita","size":"medium","price":"8.00","quantity":1},{"id":3,"name":"Margherita","size":"large","price":"12.00","quantity":1}]}',
            'first_name' => $this->faker->firstName,
            'last_name' => $this->faker->lastName,
            'address' => $this->faker->address,
            'city' => $this->faker->city,
            'phone' => $this->faker->phoneNumber,
            'notes' => $this->faker->sentence,
        ]);
        $response->assertOk();

        $response = $this->post(route('order.pay'));
        $response->assertStatus(302);
    }

    public function testAuthUserCanAccessOrderHistory(): void
    {
        $this->actingAs(User::first())->get(route('order.history'))->assertOk();
    }

    public function testNonAuthCannotAccessOrderHistory(): void
    {
        $this->get(route('order.history'))->assertRedirect(route('login'));
    }
}
