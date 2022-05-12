<?php

namespace App\Http\Controllers;

use App\Http\Resources\UserResource;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function show(Request $request)
    {
        return view('dashboard')->with([
            'users' => UserResource::collection(User::query()->orderByDesc('created_at')->get())->toArray($request),
        ]);
    }
}
