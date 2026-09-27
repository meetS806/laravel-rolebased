<?php

namespace App\Http\Controllers;

use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class UserManagementController extends Controller
{
    public function index()
    {
        $loggedInUser = auth()->user();

        if ($loggedInUser->hasRole('super_admin')) {

            $users = User::where('id', '!=', $loggedInUser->id)
                ->with('role')
                ->latest()
                ->paginate(10);

        } else {

            $users = User::where('parent_id', $loggedInUser->id)
                ->with('role')
                ->latest()
                ->paginate(10);
        }

        return view('users.index', compact('users'));
    }


   public function create()
    {
        $loggedInUser = auth()->user();

        $roleSlug = match ($loggedInUser->role->slug) {
            'super_admin' => 'admin',
            'admin'       => 'user',
            'user'        => 'sub_user',
            default       => null,
        };

        if (!$roleSlug) {
            abort(403, 'You are not allowed to create users.');
        }

        $role = Role::where('slug', $roleSlug)->firstOrFail();

        return view('users.create', compact('role'));
    }



    public function store(Request $request)
    {
        $loggedInUser = auth()->user();

        $roleSlug = match ($loggedInUser->role->slug) {
            'super_admin' => 'admin',
            'admin'       => 'user',
            'user'        => 'sub_user',
            default       => null,
        };

        if (!$roleSlug) {
            abort(403, 'You are not allowed to create users.');
        }

        $role = Role::where('slug', $roleSlug)->firstOrFail();

        $validated = $request->validate([
            'name' => [
                'required',
                'string',
                'max:255',
            ],

            'email' => [
                'required',
                'email',
                'unique:users,email',
            ],

            'password' => [
                'required',
                'string',
                'min:8',
                'confirmed',
            ],
        ]);

        User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => $validated['password'],
            'role_id' => $role->id,

            // Very important
            'parent_id' => $loggedInUser->id,

            'status' => true,
        ]);

        return redirect()
            ->back()
            ->with(
                'success',
                $role->name . ' created successfully.'
            );
    }


    private function allowedRoles()
    {
        $user = auth()->user();

        return match ($user->role->slug) {

            'super_admin' =>
                Role::whereIn('slug', [
                    'admin',
                    'user'
                ])->get(),

            'admin' =>
                Role::where('slug', 'user')->get(),

            'user' =>
                Role::where('slug', 'sub_user')->get(),

            default => collect(),
        };
    }
    public function edit(User $user)
    {
        $this->authorize('update', $user);

        $allowedRoles = $this->allowedRoles();

        return view(
            'users.edit',
            compact('user', 'allowedRoles')
        );
    }
    public function destroy(User $user)
    {
        $this->authorize('delete', $user);

        $user->delete();

        return back()
            ->with('success', 'User deleted successfully.');
    }
}