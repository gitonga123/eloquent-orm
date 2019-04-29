<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Http\Controllers\FizzBuzzController as FizzBuzz;

class FizzBuzzTest extends TestCase
{
    public function inputDataProvider()
    {
        return [
           'Number 1 should return 1' => [1, 1],
           'Number 4 should return 4' => [4, 4],
           'Number 3 is divisible by 3 so it should return Fizz' => [3, "Fizz"],
           'Number 6 is divisible by 3 so it should return Fizz' => [6, "Fizz"],
           'Number 5 is divisible by 5 so it should return Buzz' => [5, "Buzz"],
           'Number 10 is divisible by 5 so it should return Buzz' => [10, "Buzz"],
           'Number 15 is divisible by 3 and 5 so it should return FizzBuzz'
             => [15, "FizzBuzz"],
           'Number 30 is divisible by 3 and 5 so it should return FizzBuzz'
             => [30, "FizzBuzz"],
            
        ];
    }

    /**
     * A basic test example.
     * 
     * @param int $input //
     * @param int $expected //
     * 
     * @dataProvider inputDataProvider
     * 
     * @return void
     */
    public function testInputReturnsExpectedOutput($input, $expected)
    {
        $fizz_buzz = new FizzBuzz();
        $result = $fizz_buzz->generate($input);
        $this->assertEquals($expected, $result, "Input Must Match The Output");
    }
}
