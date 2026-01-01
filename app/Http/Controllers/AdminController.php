<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.index', compact('users'));
    }

    public function toggleApproval($id)
    {
        $user = User::findOrFail($id);
        $user->is_approved = !$user->is_approved;
        $user->save();
        return back()->with('success', 'User status updated.');
    }

    public function destroy($id)
    {
        User::destroy($id);
        return back()->with('success', 'User deleted.');
    }
}
