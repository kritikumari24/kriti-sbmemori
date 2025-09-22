<?php

namespace Tests\Feature\Admin;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    /**
     * Indicates whether the default seeder should run before each test.
     *
     * @var bool
     */
    protected $seed = true;

    /**
     * Indicates whether the Admin logged in.
     *
     */
    private function LoginAsfunction()
    {
        // Get Admin deatils from database
        $admin = User::find(1);
        //Logged in as Admin using admin guard
        Auth::guard('admin')->login($admin);

        return $this->actingAs($admin);
    }

    public function test_admin_can_access_user_management(): void
    {
        //Find Admin from database
        $admin = User::find(1);
        //Logged in as Admin using admin guard
        $this->LoginAsfunction();
        //without Exception Handling
        $this->withoutExceptionHandling();
        // Create user for check users lis, create,edit,delete,status functionlity
        $user = User::factory()->create();
        // Ensure admin can access user management routes
        //login as admin and checking route users list working or not
        $response = $this->actingAs($admin)->get(route('admin.users.index'));
        $response->assertStatus(200);
        //login as admin and checking route user create form working or not
        $response = $this->actingAs($admin)->get(route('admin.users.create'));
        $response->assertStatus(200);
        //login as admin and checking route user edit form working or not
        $response = $this->actingAs($admin)->get(route('admin.users.edit', $user->id));
        $response->assertStatus(200);
        //login as admin and checking route user delete working or not
        $response = $this->actingAs($admin)->delete(route('admin.users.destroy', $user->id));
        $response->assertStatus(200);
    }
    public function test_admin_can_see_list_user(): void
    {
        //Logged in as Admin using admin guard
        $this->LoginAsfunction();
        //without Exception Handling
        $this->withoutExceptionHandling();
        // Create user for check users list view show or not
        $user = User::factory()->create();
        //checking route for user list working or not
        $response = $this->get(route('admin.users.index'));
        $response->assertStatus(200);
    }
    public function test_admin_can_create_user(): void
    {
        //Logged in as Admin using admin guard
        $this->LoginAsfunction();
        //without Exception Handling
        $this->withoutExceptionHandling();
        // Create user for check user create form view show or not
        $user = User::factory()->create();
        //checking route for user create form working or not
        $response = $this->get(route('admin.users.create'));
        $response->assertStatus(200);
    }
    public function test_admin_can_store_user(): void
    {
        //Logged in as Admin using admin guard
        $this->LoginAsfunction();
        //without Exception Handling
        $this->withoutExceptionHandling();
        // Create user for check user store functionlity
        $response = $this->post(route('admin.users.store'), [
            '_token' => csrf_token(),
            'name' => 'Azad Singh',
            'email' => 'azad@singh.com',
            'password' => bcrypt('12345678'),
            'mobile_no' => '7412589633',
            'roles' => 'Customer'
        ]);
        //after create user check redirect functionality
        $response->assertRedirect(route('admin.users.index'));
        $response->assertStatus(302);
    }

    public function test_admin_can_edit_user(): void
    {
        //Logged in as Admin using admin guard
        $this->LoginAsfunction();
        //without Exception Handling
        $this->withoutExceptionHandling();
        //create user for checking edit form form view show or not
        $user = User::factory()->create();
        $response = $this->get(route('admin.users.edit', $user->id));
        $response->assertStatus(200);
    }
    public function test_admin_can_update_user(): void
    {
        //Logged in as Admin using admin guard
        $this->LoginAsfunction();
        //without Exception Handling
        $this->withoutExceptionHandling();
        //create user for checking update user functionality
        $user = User::factory()->create();
        //update user code
        $this->patch(route('admin.users.update', $user->id), [
            '_token' => csrf_token(),
            'name' => 'Azad',
            'email' => 'updated@email.com',
            'password' => bcrypt('123456'),
            'mobile_no' => '8523697412',
            'roles' => 'Customer'
        ]);
        //request role validation error
        $user->refresh();
        //check updated record equal or not
        $this->assertEquals('Azad', $user->name);
    }

    public function test_admin_can_change_user_status(): void
    {
        //Logged in as Admin using admin guard
        $this->LoginAsfunction();
        //without Exception Handling
        $this->withoutExceptionHandling();
        //create user for updating status of user
        $user = User::factory()->create();
        $response = $this->get(url('/admin/users/status/' . $user->id . '/' . ($user->is_active == 1 ? 0 : 1)));
        $response->assertStatus(200);
    }

    public function test_regular_user_cannot_access_user_management()
    {
        //create user for checking user except admin can access user management or not
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.users.index'));
        $response->assertStatus(302);
        $response = $this->actingAs($user)->get(route('admin.users.create'));
        $response->assertStatus(302);
        $response = $this->actingAs($user)->get(route('admin.users.edit', $user->id));
        $response->assertStatus(302);
        $response = $this->actingAs($user)->delete(route('admin.users.destroy', $user->id));
        $response->assertStatus(302);
    }
}
