<?php

namespace Tests\Feature\Http\Controllers;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Lesson;
use Illuminate\Http\Response;
use Tests\TestCase;

class LessonControllerTest extends TestCase
{
    use RefreshDatabase;

    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testShow()
    {
        $lesson = factory(Lesson::class)->create(['name' => '楽しいヨガレッスン']);

        $response = $this->get("/lessons/{$lesson->id}");

        $response->assertStatus(Response::HTTP_OK);
        $response->assertSee($lesson->name);
        $response->assertSee('空き状況: ×');
    }
}
