<?php

namespace App\Http\Controllers\Teacher;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreLevelRequest;
use App\Http\Requests\UpdateLevelRequest;
use App\Models\Level;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class LevelController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $teacher = auth()->user();
        $levels = $teacher->levels()->with('user')->latest()->get();

        $editingLevel = null;
        $selectedLevel = null;

        if (request()->filled('edit')) {
            $editingLevel = $levels->firstWhere('id', (int) request()->integer('edit'));
        }

        if (request()->filled('selected')) {
            $selectedLevel = $levels->firstWhere('id', (int) request()->integer('selected'));
        }

        return view('teacher.levels', [
            'levels' => $levels,
            'editingLevel' => $editingLevel,
            'selectedLevel' => $selectedLevel,
            'showCreateForm' => request()->boolean('create') || old('_form') === 'create',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function store(StoreLevelRequest $request): RedirectResponse
    {
        $request->user()->levels()->create($request->validated());

        return redirect()
            ->route('teacher.levels.index')
            ->with('status', 'تمت إضافة الفصل بنجاح.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Level $level): RedirectResponse
    {
        abort_unless($level->user_id === auth()->id(), 404);

        return redirect()->route('teacher.levels.index', [
            'selected' => $level,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Level $level): RedirectResponse
    {
        abort_unless($level->user_id === auth()->id(), 404);

        return redirect()->route('teacher.levels.index', [
            'edit' => $level,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLevelRequest $request, Level $level): RedirectResponse
    {
        abort_unless($level->user_id === auth()->id(), 404);

        $level->update($request->validated());

        return redirect()
            ->route('teacher.levels.index', [
                'selected' => $level,
            ])
            ->with('status', 'تم تحديث بيانات الفصل بنجاح.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Level $level): RedirectResponse
    {
        abort_unless($level->user_id === auth()->id(), 404);

        $level->delete();

        return redirect()
            ->route('teacher.levels.index')
            ->with('status', 'تم حذف الفصل بنجاح.');
    }
}
