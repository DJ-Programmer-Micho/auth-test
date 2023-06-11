<?php

namespace App\Http\Controllers\setting;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Artisan;

class EnvController extends Controller
{
    public function index()
    {
        $envFilePath = base_path('.env');
        $envVariables = [];
    
        // Read the .env file and extract the desired variables
        $envContents = File::get($envFilePath);
        $envLines = Str::of($envContents)->explode("\n");
    
        foreach ($envLines as $line) {
            $line = Str::of($line)->trim();
    
            if ($line->isNotEmpty() && !$line->startsWith('#')) {
                [$key, $value] = $line->explode('=');
                $envVariables[$key] = $value;
            }
        }

        return view('admin.setting.smtp.index')->with('envVariables', $envVariables);;
    }
    public function store(Request $request)
    {
        $validatedData  = $request->validate([
            'MAIL_MAILER' => 'required',
            'MAIL_HOST' => 'required',
            'MAIL_PORT' => 'required',
            'MAIL_USERNAME' => 'required',
            'MAIL_PASSWORD' => 'required',
            'MAIL_ENCRYPTION' => 'required',
            'MAIL_FROM_ADDRESS' => 'required',
            'MAIL_FROM_NAME' => 'required',
        ]);

        // Read the current .env file
        $envFilePath = base_path('.env');
        $envContent = file_get_contents($envFilePath);

        // Update the environment variables
        foreach ($validatedData as $key => $value) {
            $key = strtoupper($key);
            $envContent = preg_replace('/^' . $key . '=.*/m', $key . '=' . $value, $envContent);
        }

        // Save the updated .env file
        File::put($envFilePath, $envContent);

        // Redirect or return a response
        // Artisan::call('migrate');
        return redirect()->back()->with('success', 'Environment variables updated successfully.');
    }

}
