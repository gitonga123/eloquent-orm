<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FizzBuzzController extends Controller
{
    /**
     * This function Generates a number
     *
     * @param int $number //
     * 
     * @return mixed
     */
    public function generate(int $number)
    {
        
        if ($this->isFizz($number) && $this->isBuzz($number)) {
            return "FizzBuzz";
        } else if ($this->isFizz($number)) {
            return 'Fizz';
        } else if ($this->isBuzz($number)) {
            return "Buzz";
        }

        return $number;
    }

    /**
     * Check if number is a fizz
     *
     * @param int $number //
     * 
     * @return boolean
     */
    protected function isFizz(int $number)
    {
        return $number % 3 == 0;
    }

    /**
     * Check if number is a Buzz
     *
     * @param int $number //
     * 
     * @return boolean
     */
    protected function isBuzz(int $number)
    {
        return $number % 5 == 0;
    }
}
