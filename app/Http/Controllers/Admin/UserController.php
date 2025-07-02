<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\DeleteUserRequest;
use App\Http\Requests\RestoreUserRequest;
use App\Enums\Auth\AdminPermissionEnum;
use App\Models\User;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:' . AdminPermissionEnum::VIEW_USERS->value)->only('index');
        $this->middleware('permission:' . AdminPermissionEnum::DELETE_USERS->value)->only('destroy');
        $this->middleware('permission:' . AdminPermissionEnum::RESTORE_USERS->value)->only('restore');
    }

    public function index()
    {
        $users = User::latest()->paginate(10);
        return view('admin.users.index', compact('users'));
    }

    public function destroy(DeleteUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back()->with('success', 'User soft-deleted successfully.');
    }

    public function restore(RestoreUserRequest $request, $id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();

        return back()->with('success', 'User restored successfully.');
    }
}
