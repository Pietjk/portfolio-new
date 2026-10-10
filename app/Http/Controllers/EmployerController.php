<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class EmployerController extends Controller
{
    public function create(): View
    {
        return view('employers.create');
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ], [
            'name.required' => 'Naam is verplicht.',
        ]);

        Employer::create($validated);

        return redirect()->route('dashboard');
    }

    public function edit(Employer $employer): View
    {
        return view('employers.edit', compact('employer'));
    }

    public function update(Request $request, Employer $employer): RedirectResponse
    {
        $validated = $request->validate([
            'name' => ['required', 'string', 'max:255'],
        ], [
            'name.required' => 'Naam is verplicht.',
        ]);

        $employer->update($validated);

        return redirect()->route('dashboard');
    }

    public function destroy(Employer $employer): RedirectResponse
    {
        $employer->delete();

        return redirect()->route('dashboard');
    }
}
