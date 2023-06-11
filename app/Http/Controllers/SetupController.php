<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Validator;


class SetupController extends Controller
{
    public function index(){
        $phpOutput = [];
        $phpReturnCode = 0;
        exec('php -v', $phpOutput, $phpReturnCode);
        // Check if Composer is installed
        $composerOutput = [];
        $composerReturnCode = 0;
        exec('composer --version', $composerOutput, $composerReturnCode);
        // Check if Node.js is installed
        $nodeOutput = [];
        $nodeReturnCode = 0;
        exec('node --version', $nodeOutput, $nodeReturnCode);
        return view('setup.setup', compact('phpReturnCode', 'composerReturnCode', 'nodeReturnCode'));
    }

    public function createDB(Request $request){
        $validatedData = $request->validate([
            'DB_CONNECTION' => 'required',
            'DB_HOST' => 'required',
            'DB_PORT' => 'required',
            'DB_DATABASE' => 'required',
            'DB_USERNAME' => 'required',
            'DB_PASSWORD' => '',
        ]);
    
        // Set the database configuration dynamically
        config([
            'database.connections.mysql.host' => $validatedData['DB_HOST'],
            'database.connections.mysql.port' => $validatedData['DB_PORT'],
            'database.connections.mysql.database' => null, // Set to null to connect to the default database
            'database.connections.mysql.username' => $validatedData['DB_USERNAME'],
            'database.connections.mysql.password' => $validatedData['DB_PASSWORD'],
        ]);
        // Establish a new database connection
        $connection = DB::reconnect('mysql');
        // Create the new database
        $databaseName = $validatedData['DB_DATABASE'];
        $connection->statement("CREATE DATABASE IF NOT EXISTS $databaseName");
        $connection->statement("USE `$databaseName`");
        // Switch to the newly created database
        config(['database.connections.mysql.database' => $databaseName]);
        $connection->statement("USE `$databaseName`");
        // Run migrations on the new database
        // dd($connection);
        Artisan::call('migrate', [
            '--force' => true,
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

        $notification = array(
            "message" => "Database Installed Successfully",
            "alert-type" => "success"
        );
        // BREAK
        return redirect()->route('setup.met.last')->with($notification);;
    }


    public function final(){
        return view('setup.setup-2');
    }


    public function createUser(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'max:255'],
            'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
            'password' => ['required'],
        ]);
        
        if ($validator->fails()) {
            // Validation failed
            $errors = $validator->errors()->all();
            return redirect()->back()->withErrors($errors)->withInput();
            // return redirect()->back()->withErrors($validator)->withInput();
        }
        
        // Validation passed, proceed with the rest of the logic
        $user = User::create([
            'name' => $request->name,
            'username' => $request->username,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            // 'email_verified_at' => Carbon::now(),
        ]);

        $user->email_verified_at = Carbon::now();
        $user->save();

        event(new Registered($user));
    
        Auth::login($user);
        // Redirect or perform any additional actions
        return redirect()->route('dashboard');
    }
}
