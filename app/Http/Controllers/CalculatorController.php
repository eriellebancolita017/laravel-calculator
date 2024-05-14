<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CalculatorController extends Controller
{
    public function calculate(Request $request)
    {
        $input = $request->input('expression');
        $result = null;

        // Parse the input expression
        $tokens = explode(' ', $input);
        $operator = $tokens[1] ?? null;

        // Perform the corresponding operation
        switch ($operator) {
            case '+':
                $result = $tokens[0] + $tokens[2];
                break;
            case '-':
                $result = $tokens[0] - $tokens[2];
                break;
            case '*':
                $result = $tokens[0] * $tokens[2];
                break;
            case '/':
                $result = $tokens[0] / $tokens[2];
                break;
            case 'sqrt':
                $result = sqrt($tokens[0]);
                break;
            default:
                $result = 'Invalid operator';
                break;
        }

        return response()->json([
            'result' => $result
        ]);
    }
}