<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Zone;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;


class UserController extends Controller
{
    /**
     * Admin Dashboard – only for role = 'Admin'
     */
    public function dashboard(Request $request)
    {
        if ($request->user()->role !== 'admin') {
            return redirect()
                ->route('dashboard')
                ->with('error', 'You do not have admin access.');
        }

        return view('admin.dashboard');
    }

    /**
     * Regular user home page
     */
    public function home()
    {
        return view('dashboard');
    }

    /**
     * Show form to create a new user (Admin only)
     */
    public function create()
    {
        $zones = Zone::orderBy('zone_name')->get();
        return view('admin.users.create', compact('zones'));
    }

    /**
     * Store new user (Admin only)
     */
   public function store(Request $request)
{
    $request->validate([
        'name'     => 'required|string|max:100',
        'email'    => 'required|email|unique:users,email',
        'password' => 'required|min:6|confirmed',
        'role'     => 'required|in:admin,zonal director,accountant,user',
        'zone_id'  => 'nullable|exists:zones,id',
    ]);

    User::create([
        'name'     => $request->name,
        'email'    => $request->email,
        'password' => Hash::make($request->password),
        'role'     => $request->role,
        'zone_id'  => $request->zone_id,
    ]);

    return redirect()
        ->route('admin.users.index')
        ->with('success', 'User created successfully.');
}

    /**
     * List all users (Admin only)
     */
    public function index()
    {
        $users = User::with('zone')->latest()->paginate(20);
        $query = User::with('zone');

    // Show trashed users if ?trashed=1
    if (request()->boolean('trashed')) {
        $query->onlyTrashed();
    }

    $users = $query->latest()->paginate(20);

    return view('admin.users.index', compact('users'));
        return view('admin.users.index', compact('users'));
    }
    
    public function edit($id)
{
    $user = User::withTrashed()->findOrFail($id);
    $zones = Zone::orderBy('zone_name')->get();
    return view('admin.users.edit', compact('user', 'zones'));
}

public function update(Request $request, $id)
{
    $user = User::withTrashed()->findOrFail($id);

    $request->validate([
        'name'     => 'required|string|max:100',
        'email'    => 'required|email|unique:users,email,' . $id . ',user_id',
        'password' => 'nullable|min:6|confirmed',
        'role'     => 'required|in:admin,zonal director,accountant,user',
        'zone_id'  => 'nullable|exists:zones,zone_id',
    ]);

    $data = [
        'name'    => $request->name,
        'email'   => $request->email,
        'role'    => $request->role,
        'zone_id' => $request->zone_id,
    ];

    if ($request->filled('password')) {
        $data['password'] = Hash::make($request->password);
    }

    $user->update($data);

    return redirect()->route('admin.users.index')
                     ->with('success', 'User updated successfully.');
}

public function destroy($id)
{
    $user = User::findOrFail($id);
    $user->delete();
    return back()->with('success', 'User moved to trash.');
}

public function restore($id)
{
    $user = User::withTrashed()->findOrFail($id);
    $user->restore();
    return back()->with('success', 'User restored successfully.');
}

public function forceDelete($id)
{
    $user = User::withTrashed()->findOrFail($id);
    $user->forceDelete();
    return back()->with('success', 'User permanently deleted.');
}
}