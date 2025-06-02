<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UsersController extends Controller
{
    public function index()
    {
        $users = User::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.manage-users.index', compact('users'));
    }

    public function create()
    {
        return view('admin.manage-users.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'username' => 'required|string|max:255|unique:users,username',
            'role' => 'required|string|in:admin,default',
            'password' => 'required|string|min:6|confirmed',
        ]);

        $data['password'] = bcrypt($data['password']);

        User::create($data);

        return redirect()->route('admin.manage-users.index')->with('success', 'User created successfully.');
    }

    public function edit(User $manageUser)
    {
        return view('admin.manage-users.edit', ['user' => $manageUser]);
    }

    public function update(Request $request, User $manageUser)
    {
        $data = $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required','email', Rule::unique('users')->ignore($manageUser->id)],
            'username' => ['required', 'string', 'max:255', Rule::unique('users')->ignore($manageUser->id)],
            'role' => 'required|string|in:admin,default',
            'password' => 'nullable|string|min:6|confirmed',
        ]);

        if (!empty($data['password'])) {
            $data['password'] = bcrypt($data['password']);
        } else {
            unset($data['password']);
        }

        $manageUser->update($data);

        return redirect()->route('admin.manage-users.index')->with('success', 'User updated successfully.');
    }

    public function destroy(User $manageUser)
    {
        $manageUser->delete();
        return redirect()->route('admin.manage-users.index')->with('success', 'User deleted successfully.');
    }
}
