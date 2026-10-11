<?php

namespace Tests\Feature;

use App\Models\Hobby;
use App\Models\HobbyPost;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class HobbyTest extends TestCase
{
    use RefreshDatabase;

    public function test_guests_cannot_manage_hobbies(): void
    {
        $hobby = Hobby::factory()->create();
        $post = HobbyPost::factory()->for($hobby)->create();

        $this->get(route('hobby.create'))->assertRedirect(route('login'));
        $this->post(route('hobby.store'), [])->assertRedirect(route('login'));
        $this->delete(route('hobby.destroy', $hobby))->assertRedirect(route('login'));
        $this->get(route('hobbyPost.create'))->assertRedirect(route('login'));
        $this->post(route('hobbyPost.store'), [])->assertRedirect(route('login'));
        $this->delete(route('hobbyPost.destroy', $post))->assertRedirect(route('login'));
    }

    public function test_hobby_can_be_created_without_nullable_fields(): void
    {
        $this->actingAs(User::factory()->create())
            ->post(route('hobby.store'), ['name' => 'Gamen', 'description' => 'Veel gamen.'])
            ->assertRedirect(route('dashboard'));

        $this->assertDatabaseHas('hobbies', ['name' => 'Gamen', 'icon' => null, 'image_path' => null, 'link' => null]);
    }

    public function test_hobby_validation_fails(): void
    {
        $this->actingAs(User::factory()->create())
            ->post(route('hobby.store'), ['link' => 'geen-url', 'image_path' => UploadedFile::fake()->create('a.pdf', 10)])
            ->assertSessionHasErrors(['name', 'description', 'link', 'image_path']);
    }

    public function test_hobby_image_can_be_uploaded_replaced_and_removed(): void
    {
        Storage::fake('public');
        $user = User::factory()->create();

        $this->actingAs($user)->post(route('hobby.store'), [
            'name' => 'Foto',
            'description' => 'Foto’s',
            'image_path' => UploadedFile::fake()->image('a.jpg'),
        ]);
        $hobby = Hobby::firstOrFail();
        $first = str_replace('storage/', '', $hobby->image_path);
        Storage::disk('public')->assertExists($first);

        $this->actingAs($user)->patch(route('hobby.update', $hobby), [
            'name' => 'Foto',
            'description' => 'Foto’s',
            'image_path' => UploadedFile::fake()->image('b.jpg'),
        ]);
        Storage::disk('public')->assertMissing($first);
        $second = str_replace('storage/', '', $hobby->refresh()->image_path);
        Storage::disk('public')->assertExists($second);

        $this->actingAs($user)->delete(route('hobby.image.destroy', $hobby));
        Storage::disk('public')->assertMissing($second);
        $this->assertNull($hobby->refresh()->image_path);
    }

    public function test_hobby_post_can_be_created_without_nullable_fields(): void
    {
        $hobby = Hobby::factory()->create();

        $this->actingAs(User::factory()->create())
            ->post(route('hobbyPost.store'), ['hobby_id' => $hobby->id, 'name' => 'Post'])
            ->assertRedirect(route('dashboard'));

        $this->assertDatabaseHas('hobby_posts', ['name' => 'Post', 'description' => null, 'image_path' => null, 'link' => null]);
    }

    public function test_hobby_post_validation_fails(): void
    {
        $this->actingAs(User::factory()->create())
            ->post(route('hobbyPost.store'), ['hobby_id' => 999, 'link' => 'nope'])
            ->assertSessionHasErrors(['hobby_id', 'name', 'link']);
    }

    public function test_deleting_hobby_removes_posts_and_their_images(): void
    {
        Storage::fake('public');
        Storage::disk('public')->put('images/p.jpg', 'x');
        $hobby = Hobby::factory()->create();
        HobbyPost::factory()->for($hobby)->create(['image_path' => 'storage/images/p.jpg']);

        $this->actingAs(User::factory()->create())->delete(route('hobby.destroy', $hobby));

        $this->assertDatabaseCount('hobby_posts', 0);
        Storage::disk('public')->assertMissing('images/p.jpg');
    }

    public function test_dashboard_lists_hobbies_and_posts(): void
    {
        $post = HobbyPost::factory()->create(['name' => 'Mijn post']);

        $this->actingAs(User::factory()->create())
            ->get(route('dashboard'))
            ->assertOk()
            ->assertSee('Mijn post')
            ->assertSee($post->hobby->name);
    }

    public function test_home_renders_hobbies_with_and_without_images_and_html_in_modal(): void
    {
        $hobby = Hobby::factory()->create(['name' => 'Fotografie']);
        HobbyPost::factory()->for($hobby)->create(['name' => 'Zonder foto', 'description' => '<strong>Vet</strong> tekst']);
        HobbyPost::factory()->for($hobby)->create(['name' => 'Met foto', 'image_path' => 'storage/images/x.jpg']);
        Hobby::factory()->create(['name' => 'Leeg']);

        $this->get(route('home'))
            ->assertOk()
            ->assertSee("Hobby's")
            ->assertSee('Fotografie')
            ->assertSee('Zonder foto')
            ->assertSee('storage/images/x.jpg', false)
            ->assertSee('<strong>Vet</strong> tekst', false)
            ->assertSee('Nog geen berichten bij deze hobby.');
    }
}
