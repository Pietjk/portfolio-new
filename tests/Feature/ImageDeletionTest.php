<?php

namespace Tests\Feature;

use App\Models\AboutText;
use App\Models\Category;
use App\Models\Project;
use App\Models\ProjectDetail;
use App\Models\Skill;
use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class ImageDeletionTest extends TestCase
{
    use RefreshDatabase;

    private function storeImage(): string
    {
        Storage::fake('public');
        Storage::disk('public')->put('images/test.jpg', 'content');

        return 'storage/images/test.jpg';
    }

    private function assertImageRemoved(Model $model, string $editRoute, string $deleteRoute): void
    {
        $user = User::factory()->create();

        $this->actingAs($user)
            ->get(route($editRoute, $model->getKey()))
            ->assertOk()
            ->assertSee($model->image_path)
            ->assertSee(route($deleteRoute, $model->getKey()));

        $this->actingAs($user)
            ->delete(route($deleteRoute, $model->getKey()))
            ->assertRedirect();

        Storage::disk('public')->assertMissing('images/test.jpg');
        $this->assertNull($model->fresh()->image_path);

        $this->actingAs($user)
            ->get(route($editRoute, $model->getKey()))
            ->assertOk()
            ->assertDontSee(route($deleteRoute, $model->getKey()));
    }

    public function test_about_text_image_can_be_deleted(): void
    {
        $model = AboutText::create(['title' => 'Title', 'text' => 'Text', 'image_path' => $this->storeImage()]);

        $this->assertImageRemoved($model, 'aboutText.edit', 'aboutText.image.destroy');
    }

    public function test_project_detail_image_can_be_deleted(): void
    {
        $project = Project::create([
            'title' => 'P', 'slug' => 'p', 'text' => 't', 'image_path' => 'x', 'is_small' => false,
        ]);
        $model = ProjectDetail::create([
            'project_id' => $project->id, 'title' => 'Title', 'text' => 'Text', 'image_path' => $this->storeImage(),
        ]);

        $this->assertImageRemoved($model, 'projectDetail.edit', 'projectDetail.image.destroy');
    }

    public function test_category_image_can_be_deleted(): void
    {
        $model = Category::create(['name' => 'Cat', 'image_path' => $this->storeImage()]);

        $this->assertImageRemoved($model, 'category.edit', 'category.image.destroy');
    }

    public function test_skill_image_can_be_deleted(): void
    {
        $category = Category::create(['name' => 'Cat']);
        $model = Skill::create(['name' => 'Skill', 'category_id' => $category->id, 'image_path' => $this->storeImage()]);

        $this->assertImageRemoved($model, 'skill.edit', 'skill.image.destroy');
    }

    public function test_guests_cannot_delete_images(): void
    {
        $category = Category::create(['name' => 'Cat', 'image_path' => $this->storeImage()]);

        $this->delete(route('category.image.destroy', $category->getKey()))->assertRedirect('login');

        $this->assertNotNull($category->fresh()->image_path);
    }
}
