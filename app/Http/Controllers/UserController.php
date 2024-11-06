<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    // Index
    public function index(Request $request){
            // Search by name, pagination 10
            $users = User::where('name', 'like', '%' . $request->input('name') . '%')
            ->orderBy('id', 'desc')
            ->paginate(10);
            return view('pages.user.index', compact('users'));
    }

    // Create
    public function create(){
        return view('pages.user.create');
    }


    // Store
    public function store(Request $request){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required|min:8',
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'roles' => $request->roles,
            'password' => Hash::make($request->password),
            'position' => $request->position,
            'department' => $request->department,
        ]);

        return redirect()->route('user.index')->with('success', 'User created successfully');
    }

     //edit
    public function edit(User $user){
        return view('pages.user.edit', compact('user'));
    }

     //update
    public function update(Request $request, User $user){
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
        ]);

        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'roles' => $request->roles,
            'position' => $request->position,
            'department' => $request->department,
        ]);

         //if password filled
        if ($request->password) {
            $user->update([
                'password' => Hash::make($request->password),
            ]);
        }

        return redirect()->route('user.index')->with('success', 'User updated successfully');
    }

     //destroy
    public function destroy(User $user){
        $user->delete();
        return redirect()->route('user.index')->with('success', 'User deleted successfully');
    }
}
