<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAdminUserRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class UserManagementController extends Controller
{
    public function index(Request $request): View
    {
        $search = trim((string) $request->string('q'));

        $users = User::query()
            ->when($search !== '', function ($query) use ($search) {
                $query->where(function ($innerQuery) use ($search) {
                    $innerQuery
                        ->where('name', 'like', "%{$search}%")
                        ->orWhere('email', 'like', "%{$search}%")
                        ->orWhere('phone', 'like', "%{$search}%")
                        ->orWhere('role', 'like', "%{$search}%");
                });
            })
            ->latest()
            ->paginate(10)
            ->withQueryString();

        $editingUser = null;

        if ($request->filled('edit')) {
            $editingUser = User::query()->find($request->integer('edit'));
        }

        return view('admin.users', [
            'users' => $users,
            'editingUser' => $editingUser,
            'search' => $search,
        ]);
    }

    public function update(UpdateAdminUserRequest $request, User $user): RedirectResponse
    {
        $validated = $request->validated();
        $status = $validated['status'];
        unset($validated['status']);

        $user->fill($validated);
        $user->email_verified_at = $status === 'active' ? ($user->email_verified_at ?? now()) : null;
        $user->save();

        return redirect()
            ->route('admin.users', array_filter([
                'q' => $request->query('q'),
            ]))
            ->with('status', "تم تحديث بيانات {$user->name} بنجاح.");
    }

    public function destroy(Request $request, User $user): RedirectResponse
    {
        if ($request->user()->id === $user->id) {
            return redirect()
                ->route('admin.users', array_filter([
                    'q' => $request->query('q'),
                ]))
                ->with('error', 'لا يمكن حذف حسابك الحالي.');
        }

        $deletedUserName = $user->name;
        $user->delete();

        return redirect()
            ->route('admin.users', array_filter([
                'q' => $request->query('q'),
            ]))
            ->with('status', "تم حذف المستخدم {$deletedUserName} بنجاح.");
    }
}
