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
        // $validatedData = $request->validate([
        //     'DB_CONNECTION' => 'required',
        //     'DB_HOST' => 'required',
        //     'DB_PORT' => 'required',
        //     'DB_DATABASE' => 'required',
        //     'DB_USERNAME' => 'required',
        //     'DB_PASSWORD' => '',
        // ]);
    
        // config([
        //     'database.connections.mysql.host' => $validatedData['DB_HOST'],
        //     'database.connections.mysql.port' => $validatedData['DB_PORT'],
        //     'database.connections.mysql.database' => null, // Set to null to connect to the default database
        //     'database.connections.mysql.username' => $validatedData['DB_USERNAME'],
        //     'database.connections.mysql.password' => $validatedData['DB_PASSWORD'],
        // ]);

        // $connection = DB::reconnect('mysql');
        // $databaseName = $validatedData['DB_DATABASE'];
        // $connection->statement("CREATE DATABASE IF NOT EXISTS $databaseName");
        // $connection->statement("USE `$databaseName`");

        // config(['database.connections.mysql.database' => $databaseName]);
        // $connection->statement("USE `$databaseName`");

        // Artisan::call('migrate', [
        //     '--force' => true,
        // ]);

        // $envFilePath = base_path('.env');
        // $envContent = file_get_contents($envFilePath);

        // foreach ($validatedData as $key => $value) {
        //     $key = strtoupper($key);
        //     $envContent = preg_replace('/^' . $key . '=.*/m', $key . '=' . $value, $envContent);
        // }
        // File::put($envFilePath, $envContent);

        // $notification = array(
        //     "message" => "Database Installed Successfully",
        //     "alert-type" => "success"
        // );

        // return redirect()->route('setup.met.last')->with($notification);;
    }


    public function final(){
        return view('setup.setup-2');
    }


    public function createUser(Request $request)
    {
        // $validator = Validator::make($request->all(), [
        //     'name' => ['required', 'string', 'max:255'],
        //     'username' => ['required', 'string', 'max:255', 'unique:'.User::class],
        //     'email' => ['required', 'string', 'email', 'max:255', 'unique:'.User::class],
        //     'password' => ['required'],
        // ]);
        
        // if ($validator->fails()) {
        //     // Validation failed
        //     $errors = $validator->errors()->all();
        //     return redirect()->back()->withErrors($errors)->withInput();
        // }
        
        // $user = User::create([
        //     'name' => $request->name,
        //     'username' => $request->username,
        //     'email' => $request->email,
        //     'password' => Hash::make($request->password),
        // ]);

        // $user->email_verified_at = Carbon::now();
        // $user->save();

        // event(new Registered($user));
    
        // Auth::login($user);
        // // Redirect or perform any additional actions
        // return redirect()->route('dashboard');
    }
}
