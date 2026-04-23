<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index()
    {
        $users = User::with('providerProfile')
            ->latest()
            ->paginate(20);

        return view('admin.users.index', compact('users'));
    }

    public function suspend(Request $request, User $user)
    {
        $user->update(['status' => $user->status === 'suspended' ? 'active' : 'suspended']);
        return back()->with('success', 'User status updated.');
    }
}