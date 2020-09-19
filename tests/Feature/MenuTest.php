<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class MenuTest extends TestCase
{
    public function testMenuPageReturnsOkStatus(): void
    {
        $response = $this->get(route('menu'));
        $response->assertOk();
    }

    public function testSearchPageReturnsOkStatus(): void
    {
        $response = $this->get(route('menu.search'));
        $response->assertOk();

        $response = $this->get(route('menu.search', ['q' => 'a']));
        $response->assertOk();
    }
}
