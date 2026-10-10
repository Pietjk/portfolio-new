<?php

namespace Tests\Feature;

use App\Models\Category;
use App\Models\Employer;
use App\Models\Experience;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Str;
use Tests\TestCase;

class ExperienceTest extends TestCase
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

    /**
     * @return array<string, mixed>
     */
    private function payload(Employer $employer, array $overrides = []): array
    {
        return array_merge([
            'employer_id' => $employer->id,
            'function' => 'Developer',
            'description' => 'Bouwde dingen.',
            'start_date' => '2022-03-17',
            'end_date' => '2023-06-25',
        ], $overrides);
    }

    public function test_guests_cannot_manage_experiences_or_employers(): void
    {
        $employer = Employer::factory()->create();
        $experience = Experience::factory()->for($employer)->create();

        $this->get(route('experience.create'))->assertRedirect(route('login'));
        $this->post(route('experience.store'), [])->assertRedirect(route('login'));
        $this->delete(route('experience.destroy', $experience))->assertRedirect(route('login'));
        $this->get(route('employer.create'))->assertRedirect(route('login'));
        $this->delete(route('employer.destroy', $employer))->assertRedirect(route('login'));
    }

    public function test_employer_can_be_created_updated_and_validated(): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('employer.store'), ['name' => 'Acme'])->assertRedirect(route('dashboard'));
        $employer = Employer::firstOrFail();

        $this->actingAs($user)->patch(route('employer.update', $employer), ['name' => 'Acme B.V.']);
        $this->assertSame('Acme B.V.', $employer->fresh()->name);

        $this->actingAs($user)->post(route('employer.store'), ['name' => ''])->assertSessionHasErrors('name');
    }

    public function test_experience_can_be_created_with_skills_and_stored_as_first_of_month(): void
    {
        [$a, $b] = $this->makeSkills(2);
        $employer = Employer::factory()->create();

        $this->actingAs(User::factory()->create())
            ->post(route('experience.store'), $this->payload($employer, ['skills' => [$a->id, $b->id]]))
            ->assertRedirect(route('dashboard'));

        $experience = Experience::firstOrFail();
        $this->assertCount(2, $experience->skills);
        $this->assertSame('2022-03-01', $experience->start_date->toDateString());
        $this->assertSame('2023-06-01', $experience->end_date->toDateString());
    }

    public function test_end_date_in_same_month_as_start_date_is_accepted(): void
    {
        $employer = Employer::factory()->create();

        $this->actingAs(User::factory()->create())
            ->post(route('experience.store'), $this->payload($employer, ['start_date' => '2022-03-20', 'end_date' => '2022-03-05']))
            ->assertSessionHasNoErrors();

        $this->assertSame('2022-03-01', Experience::firstOrFail()->end_date->toDateString());
    }

    public function test_invalid_date_is_rejected(): void
    {
        $employer = Employer::factory()->create();

        $this->actingAs(User::factory()->create())
            ->post(route('experience.store'), $this->payload($employer, ['start_date' => 'not-a-date']))
            ->assertSessionHasErrors('start_date');
    }

    public function test_description_is_optional(): void
    {
        $employer = Employer::factory()->create();

        $this->actingAs(User::factory()->create())
            ->post(route('experience.store'), $this->payload($employer, ['description' => null]))
            ->assertSessionHasNoErrors();

        $this->assertNull(Experience::firstOrFail()->description);
    }

    public function test_current_flag_clears_end_date(): void
    {
        $employer = Employer::factory()->create();

        $this->actingAs(User::factory()->create())
            ->post(route('experience.store'), $this->payload($employer, ['is_current' => 1]))
            ->assertSessionHasNoErrors();

        $experience = Experience::firstOrFail();
        $this->assertNull($experience->end_date);
        $this->assertTrue($experience->isCurrent());
    }

    public function test_end_date_before_start_date_is_rejected(): void
    {
        $employer = Employer::factory()->create();

        $this->actingAs(User::factory()->create())
            ->post(route('experience.store'), $this->payload($employer, ['end_date' => '2021-01-10']))
            ->assertSessionHasErrors('end_date');

        $this->assertDatabaseCount('experiences', 0);
    }

    public function test_required_fields_and_unknown_relations_are_rejected(): void
    {
        $this->actingAs(User::factory()->create())
            ->post(route('experience.store'), ['employer_id' => 999, 'skills' => [999]])
            ->assertSessionHasErrors(['employer_id', 'function', 'start_date', 'skills.0']);
    }

    public function test_experience_skills_can_be_synced_and_removed_when_editing(): void
    {
        [$a, $b] = $this->makeSkills(2);
        $employer = Employer::factory()->create();
        $experience = Experience::factory()->for($employer)->create();
        $experience->skills()->attach($a);
        $user = User::factory()->create();

        $this->actingAs($user)
            ->patch(route('experience.update', $experience), $this->payload($employer, ['skills' => [$b->id]]))
            ->assertRedirect(route('dashboard'));
        $this->assertSame([$b->id], $experience->fresh()->skills->pluck('id')->all());

        $this->actingAs($user)->patch(route('experience.update', $experience), $this->payload($employer));
        $this->assertCount(0, $experience->fresh()->skills);
    }

    public function test_edit_and_create_forms_render(): void
    {
        $employer = Employer::factory()->create();
        $experience = Experience::factory()->for($employer)->create();
        $user = User::factory()->create();

        $this->actingAs($user)->get(route('experience.create'))->assertOk();
        $this->actingAs($user)->get(route('experience.edit', $experience))->assertOk()->assertSee($experience->function);
        $this->actingAs($user)->get(route('employer.edit', $employer))->assertOk()->assertSee($employer->name);
        $this->actingAs($user)->get(route('dashboard'))->assertOk()->assertSee($employer->name);
    }

    public function test_deleting_an_employer_cascades_to_experiences(): void
    {
        $employer = Employer::factory()->create();
        Experience::factory()->for($employer)->create();

        $this->actingAs(User::factory()->create())->delete(route('employer.destroy', $employer));

        $this->assertDatabaseCount('experiences', 0);
    }

    public function test_home_limits_skills_to_five_and_renders_description_html(): void
    {
        $skills = $this->makeSkills(6);
        $experience = Experience::factory()->create(['description' => 'Met <strong>vet</strong> woord']);
        $experience->skills()->attach(collect($skills)->pluck('id'));

        $html = $this->get(route('home'))
            ->assertSee('<strong>vet</strong>', false)
            ->getContent();

        $section = Str::before(Str::after($html, '<section id="experience">'), '</section>');
        $this->assertStringContainsString('Skill5', $section);
        $this->assertStringNotContainsString('Skill6', $section);
    }

    public function test_home_groups_experiences_by_employer_with_present_label(): void
    {
        $employer = Employer::factory()->create(['name' => 'Acme']);
        Experience::factory()->for($employer)->create(['function' => 'Junior', 'start_date' => '2020-01-01', 'end_date' => '2021-12-01']);
        Experience::factory()->for($employer)->create(['function' => 'Senior', 'start_date' => '2022-01-01', 'end_date' => null]);
        Employer::factory()->create(['name' => 'Empty Corp']);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee('Ervaringen')
            ->assertSee('Acme')
            ->assertSeeInOrder(['Senior', 'Heden', 'Junior'])
            ->assertDontSee('Empty Corp');
    }
}
