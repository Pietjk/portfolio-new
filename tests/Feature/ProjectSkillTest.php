<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Employer;
use App\Models\Project;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Tests\TestCase;

class ProjectSkillTest extends TestCase
{
    use RefreshDatabase;

    private function makeSkills(int $count): array
    {
        $category = Category::create(['name' => 'Cat']);
        $skills = [];

        for ($i = 1; $i <= $count; $i++) {
            $skills[] = Skill::create(['name' => "Skill{$i}", 'category_id' => $category->id]);
        }

        return $skills;
    }

    private function makeProject(bool $isSmall = false): Project
    {
        return Project::create([
            'title' => 'Proj', 'slug' => 'proj', 'text' => 'text', 'image_path' => 'x.jpg', 'is_small' => $isSmall,
        ]);
    }

    public function test_skills_can_be_attached_when_creating_a_project(): void
    {
        [$a, $b] = $this->makeSkills(2);

        $this->actingAs(User::factory()->create())
            ->post(route('project.store'), [
                'title' => 'New project',
                'text' => 'Some text',
                'is_small' => 0,
                'year' => 2024,
                'image_path' => UploadedFile::fake()->image('a.jpg'),
                'skills' => [$a->id, $b->id],
            ])
            ->assertRedirect('dashboard');

        $this->assertCount(2, Project::firstOrFail()->skills);
    }

    public function test_skills_can_be_synced_and_removed_when_editing(): void
    {
        [$a, $b] = $this->makeSkills(2);
        $project = $this->makeProject();
        $project->skills()->attach($a);
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route('project.edit', $project))
            ->assertOk()
            ->assertSee('value="'.$a->id.'" checked', false);

        $this->actingAs($user)
            ->patch(route('project.update', $project), ['title' => 'Proj', 'text' => 'text', 'year' => 2024, 'skills' => [$b->id]])
            ->assertRedirect('dashboard');

        $this->assertSame([$b->id], $project->skills()->pluck('skills.id')->all());

        $this->actingAs($user)
            ->patch(route('project.update', $project), ['title' => 'Proj', 'text' => 'text', 'year' => 2024])
            ->assertRedirect('dashboard');

        $this->assertCount(0, $project->skills()->get());
    }

    public function test_projects_are_ordered_by_year_and_employer_is_optional(): void
    {
        $employer = Employer::create(['name' => 'Acme']);
        $old = Project::create(['title' => 'Old', 'slug' => 'old', 'text' => 't', 'image_path' => 'x.jpg', 'is_small' => false, 'year' => 2020]);
        $new = Project::create(['title' => 'New', 'slug' => 'new', 'text' => 't', 'image_path' => 'x.jpg', 'is_small' => false, 'year' => 2024, 'employer_id' => $employer->id]);

        $this->assertSame([$new->id, $old->id], Project::recentFirst()->pluck('id')->all());
        $this->assertSame('Acme', $new->employer->name);
        $this->assertNull($old->employer);

        $employer->delete();
        $this->assertNull($new->fresh()->employer_id);
    }

    public function test_home_shows_persoonlijk_when_project_has_no_employer(): void
    {
        Project::create(['title' => 'Solo', 'slug' => 'solo', 'text' => 't', 'image_path' => 'x.jpg', 'is_small' => false, 'year' => 2023]);

        $this->get(route('home'))->assertOk()->assertSee('2023 · Persoonlijk', false);
    }

    public function test_year_is_required_and_employer_must_exist(): void
    {
        $this->actingAs(User::factory()->create())
            ->post(route('project.store'), [
                'title' => 'New project', 'text' => 'Some text', 'is_small' => 0,
                'image_path' => UploadedFile::fake()->image('a.jpg'), 'employer_id' => 999,
            ])
            ->assertSessionHasErrors(['year', 'employer_id']);
    }

    public function test_invalid_skill_is_rejected(): void
    {
        $project = $this->makeProject();

        $this->actingAs(User::factory()->create())
            ->patch(route('project.update', $project), ['title' => 'Proj', 'text' => 'text', 'skills' => [999]])
            ->assertSessionHasErrors('skills.0');
    }

    public function test_home_shows_at_most_three_skill_pills_per_project(): void
    {
        $skills = $this->makeSkills(4);
        $project = $this->makeProject();
        $small = Project::create([
            'title' => 'Small', 'slug' => 'small', 'text' => 't', 'image_path' => 'y.jpg', 'is_small' => true,
        ]);

        foreach ([$project, $small] as $p) {
            $p->skills()->attach(collect($skills)->pluck('id'));
        }

        $html = $this->get(route('home'))->assertOk()->getContent();

        $this->assertSame(6, substr_count($html, 'px-3 py-1 rounded-full border-2 border-secondary text-secondary text-sm"'));
    }
}
