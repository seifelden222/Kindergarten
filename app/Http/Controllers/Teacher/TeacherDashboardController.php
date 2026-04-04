<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdateTeacherProfileRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\View\View;

class TeacherDashboardController extends Controller
{
    public function index(Request $request): View
    {
        $teacher = $request->user();
        $nameParts = preg_split('/\s+/u', trim((string) $teacher->name)) ?: [];
        $firstName = $nameParts[0] ?? '';
        $lastName = count($nameParts) > 1
            ? implode(' ', array_slice($nameParts, 1))
            : '';

        return view('teacher.teacherdashboard', [
            'teacher' => $teacher,
            'teacherFirstName' => $firstName,
            'teacherLastName' => $lastName,
        ]);
    }

    public function updateProfile(UpdateTeacherProfileRequest $request): RedirectResponse
    {
        $teacher = $request->user();
        $validated = $request->validated();
        $fullName = trim($validated['first_name'].' '.$validated['last_name']);

        if (Str::lower($teacher->email) !== Str::lower($validated['email'])) {
            $teacher->email_verified_at = null;
        }

        $teacher->update([
            'name' => $fullName,
            'email' => $validated['email'],
            'phone' => $validated['phone'],
        ]);

        return redirect()
            ->route('teacher.teacherdashboard')
            ->with('status', 'تم تحديث الملف الشخصي بنجاح.');
    }
}
