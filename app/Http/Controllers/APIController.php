<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use App\Models\ApiResult;
use Illuminate\Support\Facades\Session;

class ApiController extends Controller
{
    public function showForm()
    {
        return view('api_form');
    }

    public function getApiResult(Request $request)
    {
        $number = $request->input('number');

        // Record the start time
        $startTime = microtime(true);

        // Construct the API URL with the user-inputted number
        $apiEndpoint = "https://squareroot.netlify.app/.netlify/functions/square-root/?number=$number";

        // Make the API request
        $response = Http::get($apiEndpoint);

        // Calculate the execution time
        $executionTime = (float) (microtime(true) - $startTime);
        
        // Extract the numeric value from the API response
        $numericValue = isset($response->json()['result']) ? $response->json()['result'] : null;

        // Save data to the database
        ApiResult::create([
            'user_input' => $number,
            'api_result' => $numericValue !== null ? $numericValue : null,
            'execution_time' => $executionTime,
            'type' => "API",
        ]);

        
        // Pass the response data and execution time back to the form view
        return view('api_form', [
            'number' => $number,
            'response' => $response->json(),
            'executionTime' => $executionTime,
        ]);
    }

    public function executeStoredProcedure(Request $request)
    {
        $inputNumber = $request->input('number');
        
        // Call the stored procedure and capture the results
        DB::select('CALL calculate_square_root_sql(?, @outputSquareRoot, @outputExecutionTime)', [$inputNumber]);

        // Retrieve the output parameters
        $results = DB::select('SELECT @outputSquareRoot AS squareRoot, @outputExecutionTime AS executionTime');
        $squareRoot = $results[0]->squareRoot;
        $executionTime = $results[0]->executionTime;

        ApiResult::create([
            'user_input' => $inputNumber,
            'api_result' => $squareRoot,
            'execution_time' => $executionTime,
            'type' => "SP SQL",
        ]);

        // Pass the results to the view
        return view('api_form', [
            'inputNumber' => $inputNumber,
            'squareRoot' => $squareRoot,
            'executionTime' => $executionTime,
        ]);
    }
}
