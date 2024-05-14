<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function calculate(Request $request)
    {
        $input = $request->input('expression');
        $result = null;
        $operator = null;

        // Check if the input contains a valid operator
        if (strpos($input, '+') !== false) {
            $operator = '+';
        } elseif (strpos($input, '-') !== false) {
            $operator = '-';
        } elseif (strpos($input, '*') !== false) {
            $operator = '*';
        } elseif (strpos($input, '/') !== false) {
            $operator = '/';
        } elseif (strpos($input, 'sqrt') !== false) {
            $operator = 'sqrt';
        }

        // Perform the corresponding operation
        if ($operator === 'sqrt') {
            $number = (float) str_replace('sqrt', '', $input);
            $result = sqrt($number);
        } elseif ($operator) {
            $operands = explode($operator, $input);
            $operand1 = (float) $operands[0];
            $operand2 = (float) $operands[1];

            switch ($operator) {
                case '+':
                    $result = $operand1 + $operand2;
                    break;
                case '-':
                    $result = $operand1 - $operand2;
                    break;
                case '*':
                    $result = $operand1 * $operand2;
                    break;
                case '/':
                    $result = $operand1 / $operand2;
                    break;
            }
        } else {
            $result = 'Invalid operator';
        }

        return response()->json([
            'result' => $result
        ]);
    }
}