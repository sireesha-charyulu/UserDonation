<?php
namespace Tests\Feature\Charity;
use App\Charity;
use Tests\TestCase;


class ListTest extends TestCase
{
    public function test_guest_user_can_view_a_charities_page()
    {
        $response = $this->get('/charities');
        $response->assertSuccessful();
        $response->assertViewIs('charities.index');
    }

    public function test_can_see_charity()
    {
        $charity = factory(Charity::class)->create();
        $this->get(route('charities/'. $charity->id))
            ->assertStatus(200);
    }

}
