<?php

namespace App\Http\Controllers\Guardian;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreChildRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class ChildController extends Controller
{
    public function store(StoreChildRequest $request): RedirectResponse
    {
        $validated = $request->validated();
        $birthDate = Carbon::parse($validated['birth_date']);
        $fullName = trim($validated['first_name'].' '.$validated['last_name']);

        User::create([
            'name' => $fullName,
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
            'role' => 'child',
            'guardian_id' => $request->user()->id,
            'gender' => $validated['gender'],
            'birth_date' => $birthDate->toDateString(),
            'age' => max(0, $birthDate->age),
            'level_name' => $validated['level_name'],
            'classroom_name' => $validated['classroom_name'],
            'allergies' => $validated['allergies'] ?: null,
            'chronic_diseases' => $validated['chronic_diseases'] ?: null,
            'medications' => $validated['medications'] ?: null,
            'registration_date' => now()->toDateString(),
        ]);

        return redirect()
            ->route('parent.addchild')
            ->with('status', "تم حفظ بيانات {$fullName} وإنشاء بيانات دخول الطفل بنجاح.");
    }
}
