<?php

namespace DanTheCoder\Installer\Http\Controllers;

use App\Models\Team;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use DanTheCoder\Installer\Installer;

class CreateUserController extends Controller
{
    public function index()
    {
        return view('installer::create-user');
    }

    public function store(Request $request)
    {
        // Validate the request
        $validator = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255',
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        if ($validator->fails()) {
            return redirect(route('installer::create-user.store'))->withErrors($validator)->withInput();
        }

        // Register the user
        DB::transaction(function () use ($request) {
            return tap(User::create([
                'name' => $request['name'],
                'email' => $request['email'],
                'password' => Hash::make($request['password']),
                'email_verified_at' => now(),
            ]), function (User $user) {

                if (config('installer.jetstream_teams')) {
                    // Create a personal team for the user.
                    $user->ownedTeams()->save(Team::forceCreate([
                        'user_id' => $user->id,
                        'name' => explode(' ', $user->name, 2)[0] . "'s Team",
                        'personal_team' => true,
                    ]));
                }

                // Login the user
                Auth::login($user);
            });
        });

        // Write to env
        Installer::setEnvVariable('INSTALLER_COMPLETED', 'true');

        return redirect('/');
    }
}
