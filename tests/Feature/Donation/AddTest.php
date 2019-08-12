<?php
namespace Tests\Feature\Donation;
use App\Charity;
use App\Donation;
use App\User;
use Tests\TestCase;


class AddTest extends TestCase
{
    public function test_user_can_add_donation_page()
    {
        $charity = factory(Charity::class)->create();

        $user = $this->loginWithFakeUser();

        $donation = factory(Donation::class)->create($charity,$user);

        $response = $this->get('/charities/'.$charity->id);
        $response->assertSuccessful();
        $response->assertViewIs('charities.show');
    }

    public function loginWithFakeUser()
    {
        $user = new User([
            'id' => 1
        ]);

        $this->be($user);
    }


}
