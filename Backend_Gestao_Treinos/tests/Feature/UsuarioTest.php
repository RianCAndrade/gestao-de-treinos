<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\TestCase;

class UsuarioTest extends TestCase
{
    use RefreshDatabase;

    public function test_banco()
    {
        $this->assertTrue(true);
    }
}