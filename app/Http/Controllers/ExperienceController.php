<?php

namespace App\Http\Controllers;

use App\Models\Employer;
use App\Models\Experience;
use App\Models\Skill;
use Carbon\Carbon;
use Carbon\Exceptions\InvalidFormatException;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ExperienceController extends Controller
{
    public function create(): View
    {
        $employers = Employer::orderBy('name')->get();
        $skills = Skill::orderBy('name')->get();

        return view('experiences.create', compact('employers', 'skills'));
    }

    public function store(Request $request): RedirectResponse
    {
        $request->merge([
            'start_date' => $this->firstOfMonth($request->input('start_date')),
            'end_date' => $request->boolean('is_current') ? null : $this->firstOfMonth($request->input('end_date')),
        ]);

        $validated = $request->validate([
            'employer_id' => ['required', 'integer', 'exists:employers,id'],
            'function' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'start_date' => ['required', 'date_format:Y-m-d'],
            'end_date' => ['nullable', 'date_format:Y-m-d', 'after_or_equal:start_date'],
            'skills' => ['nullable', 'array'],
            'skills.*' => ['integer', 'exists:skills,id'],
        ], [
            'employer_id.required' => 'Kies een werkgever.',
            'employer_id.exists' => 'Deze werkgever bestaat niet.',
            'function.required' => 'Functie is verplicht.',
            'start_date.required' => 'Startdatum is verplicht.',
            'start_date.date_format' => 'Startdatum moet een geldige datum zijn.',
            'end_date.date_format' => 'Einddatum moet een geldige datum zijn.',
            'end_date.after_or_equal' => 'Einddatum mag niet voor de startdatum liggen.',
            'skills.*.exists' => 'Een gekozen vaardigheid bestaat niet.',
        ]);

        $skillIds = $validated['skills'] ?? [];
        unset($validated['skills']);

        Experience::create($validated)->skills()->sync($skillIds);

        return redirect()->route('dashboard');
    }

    public function edit(Experience $experience): View
    {
        $employers = Employer::orderBy('name')->get();
        $skills = Skill::orderBy('name')->get();
        $experience->load('skills');

        return view('experiences.edit', compact('experience', 'employers', 'skills'));
    }

    public function update(Request $request, Experience $experience): RedirectResponse
    {
        $request->merge([
            'start_date' => $this->firstOfMonth($request->input('start_date')),
            'end_date' => $request->boolean('is_current') ? null : $this->firstOfMonth($request->input('end_date')),
        ]);

        $validated = $request->validate([
            'employer_id' => ['required', 'integer', 'exists:employers,id'],
            'function' => ['required', 'string', 'max:255'],
            'description' => ['nullable', 'string', 'max:5000'],
            'start_date' => ['required', 'date_format:Y-m-d'],
            'end_date' => ['nullable', 'date_format:Y-m-d', 'after_or_equal:start_date'],
            'skills' => ['nullable', 'array'],
            'skills.*' => ['integer', 'exists:skills,id'],
        ], [
            'employer_id.required' => 'Kies een werkgever.',
            'employer_id.exists' => 'Deze werkgever bestaat niet.',
            'function.required' => 'Functie is verplicht.',
            'start_date.required' => 'Startdatum is verplicht.',
            'start_date.date_format' => 'Startdatum moet een geldige datum zijn.',
            'end_date.date_format' => 'Einddatum moet een geldige datum zijn.',
            'end_date.after_or_equal' => 'Einddatum mag niet voor de startdatum liggen.',
            'skills.*.exists' => 'Een gekozen vaardigheid bestaat niet.',
        ]);

        $skillIds = $validated['skills'] ?? [];
        unset($validated['skills']);

        $experience->update($validated);
        $experience->skills()->sync($skillIds);

        return redirect()->route('dashboard');
    }

    public function destroy(Experience $experience): RedirectResponse
    {
        $experience->delete();

        return redirect()->route('dashboard');
    }

    /**
     * Reduce a submitted date to the first day of its month.
     */
    private function firstOfMonth(mixed $value): mixed
    {
        if (! is_string($value) || $value === '') {
            return null;
        }

        try {
            return Carbon::createFromFormat('Y-m-d', $value)->startOfMonth()->toDateString();
        } catch (InvalidFormatException) {
            return $value;
        }
    }
}
