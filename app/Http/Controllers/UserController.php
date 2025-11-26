<?php

namespace App\Http\Controllers;


use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {


        $users = User::query()
            ->when($request->search, function ($q) use ($request) {
                $q->where(function ($query) use ($request) {
                    $query->where('name', 'like', "%{$request->search}%")
                        ->orWhere('email', 'like', "%{$request->search}%");
                });
            })
            ->when(
                $request->role,
                fn($q) =>
                $q->where('role', $request->role)
            )
            ->latest()
            ->paginate(3);

        $data = [
            'users' => $users
        ];


        return view('users.index', $data);
    }
}
