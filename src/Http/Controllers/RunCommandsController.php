<?php

namespace DanTheCoder\Installer\Http\Controllers;

use App\Http\Controllers\Controller;
use DanTheCoder\Installer\Installer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;

class RunCommandsController extends Controller
{
    public function __invoke(Request $request)
    {
        // Generate the application key
        Artisan::call('key:generate', [
            '--force' => true,
        ]);

        // Link the storage folder
        Artisan::call('storage:link', [
            '--force' => true,
        ]);

        // Migrate the database
        Artisan::call('migrate:fresh', [
            '--force' => true,
        ]);

        // set the session driver
        Installer::setEnvVariable('SESSION_DRIVER', config('installer.session_driver'));

        return redirect(route('installer::create-user.index'));
    }
}
