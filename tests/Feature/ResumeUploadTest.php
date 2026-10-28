<?php

use App\Models\User;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

test('guest cannot open the upload page', function () {
    $this->get(route('resumes.create'))
        ->assertRedirect(route('login'));
});

test('logged in users can open the upload page', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->get(route('resumes.create'))
        ->assertOk();
});

test('non pdf files are rejected', function () {
    $user = User::factory()->create();
    $file = UploadedFile::fake()->create('photo.jpg', 100);

    $this->actingAs($user)
        ->post(route('resumes.store'), ['resume' => $file])
        ->assertSessionHasErrors('resume');
});

test('a file is required', function () {
    $user = User::factory()->create();

    $this->actingAs($user)
        ->post(route('resumes.store'), ['resume' => null])
        ->assertSessionHasErrors('resume');
});

test('user can upload a pdf resume', function () {
    Storage::fake();

    $user = User::factory()->create();
    $file = UploadedFile::fake()->createWithContent(
        'resume.pdf',
        file_get_contents(base_path('tests/fixtures/sample-resume.pdf'))
    );

    $this->actingAs($user)
        ->post(route('resumes.store'), ['resume' => $file])
        ->assertRedirect(route('resumes.create'))
        ->assertSessionHas('status');

    $this->assertDatabaseHas('resumes', [
        'user_id' => $user->id,
        'original_filename' => 'resume.pdf',
    ]);
});
