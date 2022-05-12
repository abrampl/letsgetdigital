<?php

namespace App\Http\Controllers\Auth\Actions;

use App\Http\Requests\RegistrationRequest;
use App\Http\Support\SpikklClient;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class RegisterAction
{
    public function __invoke(RegistrationRequest $request, SpikklClient $spikklClient)
    {
        $validated = $request->validated();

        $lookup = $spikklClient->lookup($validated['zipcode'], $validated['house_number']);

        $user = User::query()->create([
            'initials' => $validated['initials'],
            'first_name' => $validated['first_name'],
            'last_name' => $validated['last_name'],
            'zipcode' => $validated['zipcode'],
            'house_number' => $validated['house_number'],
            'email' => $validated['email'],
            'phone' => $validated['phone'],
            'password' => Hash::make($validated['password']),
            'geo' => $lookup->results ? $lookup->results[0] : null,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
