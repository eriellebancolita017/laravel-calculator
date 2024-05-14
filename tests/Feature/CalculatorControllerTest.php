<?php

namespace Tests\Feature;

use App\Http\Controllers\CalculatorController;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class CalculatorControllerTest extends TestCase
{
    public function testAddition()
    {
        $controller = new CalculatorController();
        $request = new Request(['expression' => '2+2']);
        $response = $controller->calculate($request);
        $this->assertEquals(4, $response->getData()->result);
    }

    public function testSubtraction()
    {
        $controller = new CalculatorController();
        $request = new Request(['expression' => '5-3']);
        $response = $controller->calculate($request);
        $this->assertEquals(2, $response->getData()->result);
    }

    public function testMultiplication()
    {
        $controller = new CalculatorController();
        $request = new Request(['expression' => '3*3']);
        $response = $controller->calculate($request);
        $this->assertEquals(9, $response->getData()->result);
    }

    public function testDivision()
    {
        $controller = new CalculatorController();
        $request = new Request(['expression' => '10/2']);
        $response = $controller->calculate($request);
        $this->assertEquals(5, $response->getData()->result);
    }

    public function testSquareRoot()
    {
        $controller = new CalculatorController();
        $request = new Request(['expression' => 'sqrt16']);
        $response = $controller->calculate($request);
        $this->assertEquals(4, $response->getData()->result);
    }

    public function testDivisionByZero()
    {
        $this->expectException(ValidationException::class);
        $controller = new CalculatorController();
        $request = new Request(['expression' => '10/0']);
        $controller->calculate($request);
    }

    public function testInvalidOperator()
    {
        $this->expectException(ValidationException::class);
        $controller = new CalculatorController();
        $request = new Request(['expression' => '10^2']);
        $controller->calculate($request);
    }
}