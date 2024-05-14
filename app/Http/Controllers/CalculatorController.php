<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function calculate(Request $request)
    {
        $input = $request->input('expression');
        $result = null;

        // Check if the input contains a valid operator
        $operator = $this->getOperator($input);

        if (!$operator) {
            throw ValidationException::withMessages(['expression' => 'Invalid operator']);
        }

        // Perform the corresponding operation
        if ($operator === 'sqrt') {
            $number = (float) str_replace('sqrt', '', $input);
            $result = sqrt($number);
        } else {
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
                    if ($operand2 == 0) {
                        throw ValidationException::withMessages(['expression' => 'Division by zero']);
                    }
                    $result = $operand1 / $operand2;
                    break;
            }
        }

        return response()->json([
            'result' => $result
        ]);
    }

    // function to get operator
    private function getOperator($expression)
    {
        $operators = ['+', '-', '*', '/', 'sqrt'];

        foreach ($operators as $operator) {
            if (strpos($expression, $operator) !== false) {
                return $operator;
            }
        }

        return null;
    }
}