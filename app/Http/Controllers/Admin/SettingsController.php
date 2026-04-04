<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateAdminSettingsRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;

class SettingsController extends Controller
{
    public function edit(Request $request): View
    {
        return view('admin.settings', [
            'user' => $request->user(),
        ]);
    }

    public function update(UpdateAdminSettingsRequest $request): RedirectResponse
    {
        $user = $request->user();

        $user->fill([
            'name' => $request->string('name')->toString(),
            'email' => $request->string('email')->toString(),
            'phone' => $request->string('phone')->toString() ?: null,
            'address' => $request->string('address')->toString() ?: null,
        ]);

        if ($user->isDirty('email')) {
            $user->email_verified_at = null;
        }

        if ($request->filled('new_password')) {
            $user->password = Hash::make($request->string('new_password')->toString());
        }

        $user->save();

        return redirect()
            ->route('admin.settings')
            ->with('status', 'تم تحديث بيانات الحساب بنجاح.');
    }
}
