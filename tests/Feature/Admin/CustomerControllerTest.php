<?php

namespace Tests\Feature\Admin;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerControllerTest extends TestCase
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

    public function test_admin_can_access_customer_management(): void
    {
        //Find Admin from database
        $admin = User::find(1);
        //Logged in as Admin using admin guard
        $this->LoginAsfunction();
        //without Exception Handling
        $this->withoutExceptionHandling();
        // Create customer for check customers list, create,edit,delete,status functionlity
        $customer = User::factory()->create();
        // Ensure admin can access customer management routes
        //login as admin and checking route customers list working or not
        $response = $this->actingAs($admin)->get(route('admin.customers.index'));
        $response->assertStatus(200);
        //login as admin and checking route customer create form working or not
        $response = $this->actingAs($admin)->get(route('admin.customers.create'));
        $response->assertStatus(200);
        //login as admin and checking route customer edit form working or not
        $response = $this->actingAs($admin)->get(route('admin.customers.edit', $customer->id));
        $response->assertStatus(200);
        //login as admin and checking route customer delete working or not
        $response = $this->actingAs($admin)->delete(route('admin.customers.destroy', $customer->id));
        $response->assertStatus(200);
    }
    public function test_admin_can_see_list_customer(): void
    {
        //Logged in as Admin using admin guard
        $this->LoginAsfunction();
        //without Exception Handling
        $this->withoutExceptionHandling();
        // Create customer for check customers list view show or not
        $customer = User::factory()->create();
        //checking route for customer list working or not
        $response = $this->get(route('admin.customers.index'));
        $response->assertStatus(200);
    }
    public function test_admin_can_create_customer(): void
    {
        //Logged in as Admin using admin guard
        $this->LoginAsfunction();
        //without Exception Handling
        $this->withoutExceptionHandling();
        // Create customer for check customer create form view show or not
        $customer = User::factory()->create();
        //checking route for customer create form working or not
        $response = $this->get(route('admin.customers.create'));
        $response->assertStatus(200);
    }
    public function test_admin_can_store_customer(): void
    {
        //Logged in as Admin using admin guard
        $this->LoginAsfunction();
        //without Exception Handling
        $this->withoutExceptionHandling();
        // Create customer for check customer store functionlity
        $response = $this->post(route('admin.customers.store'), [
            '_token' => csrf_token(),
            'name' => 'Azad Singh',
            'email' => 'azad@singh.com',
            'password' => bcrypt('12345678'),
            'mobile_no' => '7412589633',
            'roles' => 'Customer'
        ]);
        //after create customer check redirect functionality
        $response->assertRedirect(route('admin.customers.index'));
        $response->assertStatus(302);
    }

    public function test_admin_can_edit_customer(): void
    {
        //Logged in as Admin using admin guard
        $this->LoginAsfunction();
        //without Exception Handling
        $this->withoutExceptionHandling();
        //create customer for checking edit form form view show or not
        $customer = User::factory()->create();
        $response = $this->get(route('admin.customers.edit', $customer->id));
        $response->assertStatus(200);
    }
    public function test_admin_can_update_customer(): void
    {
        //Logged in as Admin using admin guard
        $this->LoginAsfunction();
        //without Exception Handling
        $this->withoutExceptionHandling();
        //create customer for checking update customer functionality
        $customer = User::factory()->create();
        //update customer code
        $this->patch(route('admin.customers.update', $customer->id), [
            '_token' => csrf_token(),
            'name' => 'Azad',
            'email' => 'updated@email.com',
            'password' => bcrypt('123456'),
            'mobile_no' => '8523697412',
            'roles' => 'Customer'
        ]);
        //request role validation error
        $customer->refresh();
        //check updated record equal or not
        $this->assertEquals('Azad', $customer->name);
    }

    public function test_admin_can_change_customer_status(): void
    {
        //Logged in as Admin using admin guard
        $this->LoginAsfunction();
        //without Exception Handling
        $this->withoutExceptionHandling();
        //create customer for updating status of customer
        $customer = User::factory()->create();
        $response = $this->get(url('/admin/customers/status/' . $customer->id . '/' . ($customer->is_active == 1 ? 0 : 1)));
        $response->assertStatus(200);
    }

    public function test_regular_user_cannot_access_customer_management()
    {
        //create user for checking user except admin can access customer management or not
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('admin.customers.index'));
        $response->assertStatus(302);
        $response = $this->actingAs($user)->get(route('admin.customers.create'));
        $response->assertStatus(302);
        $response = $this->actingAs($user)->get(route('admin.customers.edit', $user->id));
        $response->assertStatus(302);
        $response = $this->actingAs($user)->delete(route('admin.customers.destroy', $user->id));
        $response->assertStatus(302);
    }
}
