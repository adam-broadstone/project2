<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProjectsTest extends TestCase
{

    use WithFaker, RefreshDatabase;

/** @test */
  public function a_user_can_create_a_project()
  {

      $this->withoutExceptionHandling(); //STOPS LARAVEL EXCEPTION HANDLING AND GIVES PROPER EXCEPTION HANDLING

      $attributes = [ // ASSOCIATIVE ARRAY

          'title' => $this->faker->sentence, // TITLE IS FAKER SENTENCE - WE GUESS THAT 'THIS' IS PART OF THE CLASS
          'description' => $this->faker->paragraph // DESCRIPTION IS FAKER PARAGRAPH - WE GUESS THAT 'THIS' IS PART OF THE CLASS

      ];

    $this->post('/projects', $attributes)->assertRedirect('/projects'); // INSTANCE OF CLASS - POST METHOD TO PROJECTS USING ATTRIBUTES - WILL ASSERT THAT REDIRECT TO PROJECTS PAGE

    $this->assertDatabaseHas('projects',$attributes); // WILL ASSERT THAT DATABASE TABLE PROJECTS HAS BEEN GIVEN ATTRIBUTES

    $this->get('/projects')->assertSee($attributes['title']); // GET METHOD FOR PROJECTS URL WILL CHECK TO SEE IF ATTRIBUTES TITLE IS THERE
  }


    /** @test */
  public function a_user_can_view_a_project()
  {

      $this->withoutExceptionHandling();

   $project = factory('App\Project')->create();

   $this->get('/projects/' . $project->id)
           ->assertSee($project->title)
           ->assertSee($project->description);

  }




    /** @test */
  public function a_project_requires_a_title()
  {
    $attributes = factory('App\Project')->raw(['title' => '']); //  USES FACTORY MODEL TO CREATE ARRAY WITH ALL VARIABLES SET BUT RESETS TITLE TO UNDEFINED

      $this->post('/projects', $attributes)->assertSessionHasErrors('title'); // GIVE POST REQUEST EMPTY ARRAY AND CHECK TO SEE IF AN ERROR IS GIVEN BACK FOR TITLE AS THERE IS NO TITLE GIVEN
  }

    /** @test */
    public function a_project_requires_a_description()
    {

        $attributes = factory('App\Project')->raw(['description' => '']); //  USES FACTORY MODEL TO CREATE ARRAY WITH ALL VARIABLES SET BUT RESETS DESCRIPTION TO UNDEFINED

        $this->post('/projects', $attributes)->assertSessionHasErrors('description'); // GIVE POST REQUEST EMPTY ARRAY AND CHECK TO SEE IF AN ERROR IS GIVEN BACK FOR DESCRIPTION AS THERE IS NO DESCRIPTION GIVEN
    }

    /** @test */
    public function a_project_requires_an_owner()
    {

        $attributes = factory('App\Project')->raw();

        $this->post('/projects', $attributes)->assertSessionHasErrors('owner'); // GIVE POST REQUEST EMPTY ARRAY AND CHECK TO SEE IF AN ERROR IS GIVEN BACK FOR DESCRIPTION AS THERE IS NO DESCRIPTION GIVEN
    }

}
